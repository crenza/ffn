<?php

namespace Drupal\state_machine\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\TypedData\OptionsProviderInterface;
use Drupal\Core\Validation\Plugin\Validation\Constraint\AllowedValuesConstraint;
use Drupal\state_machine\Event\WorkflowTransitionEvent;
use Drupal\state_machine\Plugin\Workflow\WorkflowState;
use Drupal\state_machine\Plugin\Workflow\WorkflowTransition;

/**
 * Plugin implementation of the 'state' field type.
 *
 * @FieldType(
 *   id = "state",
 *   label = @Translation("State"),
 *   description = @Translation("Stores the current workflow state."),
 *   default_widget = "options_select",
 *   default_formatter = "list_default"
 * )
 */
class StateItem extends FieldItemBase implements StateItemInterface, OptionsProviderInterface {

  /**
   * The original value, used to validate state changes.
   *
   * @var string
   */
  protected $originalValue;

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'value' => [
          'type' => 'varchar_ascii',
          'length' => 255,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('State'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints() {
    $constraints = parent::getConstraints();
    // Replace the 'AllowedValuesConstraint' constraint with the 'State' one.
    foreach ($constraints as $key => $constraint) {
      if ($constraint instanceof AllowedValuesConstraint) {
        unset($constraints[$key]);
      }
    }
    $manager = \Drupal::typedDataManager()->getValidationConstraintManager();
    $constraints[] = $manager->create('State', []);

    return $constraints;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    return [
      'workflow' => '',
      'workflow_callback' => '',
    ] + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
    $element = [];
    // Allow the workflow to be changed if it's not determined by a callback.
    if (!$this->getSetting('workflow_callback')) {
      $workflow_manager = \Drupal::service('plugin.manager.workflow');
      $workflows = $workflow_manager->getGroupedLabels($this->getEntity()->getEntityTypeId());

      $element['workflow'] = [
        '#type' => 'select',
        '#title' => $this->t('Workflow'),
        '#options' => $workflows,
        '#default_value' => $this->getSetting('workflow'),
        '#required' => TRUE,
      ];
    }

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    // Note that in this field's case the value will never be empty
    // because of the default returned in applyDefaultValue().
    return $this->value === NULL || $this->value === '';
  }

  /**
   * {@inheritdoc}
   */
  public function applyDefaultValue($notify = TRUE) {
    if ($workflow = $this->getWorkflow()) {
      $states = $workflow->getStates();
      $initial_state = reset($states);
      $this->setValue(['value' => $initial_state->getId()], $notify);
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setValue($values, $notify = TRUE) {
    if (empty($this->originalValue)) {
      // If no array is given, then the method received just the state value.
      if (isset($values) && !is_array($values)) {
        $values = ['value' => $values];
      }
      // Track the original field value to allow isValid() to validate changes
      // and to react to transitions.
      $this->originalValue = $values['value'];
    }
    parent::setValue($values, $notify);
  }

  /**
   * {@inheritdoc}
   */
  public function isValid() {
    $allowed_states = $this->getAllowedStates($this->originalValue);
    return isset($allowed_states[$this->value]);
  }

  /**
   * {@inheritdoc}
   */
  public function getPossibleValues(AccountInterface $account = NULL) {
    return array_keys($this->getPossibleOptions($account));
  }

  /**
   * {@inheritdoc}
   */
  public function getPossibleOptions(AccountInterface $account = NULL) {
    $workflow = $this->getWorkflow();
    if (!$workflow) {
      // The workflow is not known yet, the field is probably being created.
      return [];
    }
    $state_labels = array_map(function (WorkflowState $state) {
      return $state->getLabel();
    }, $workflow->getStates());

    return $state_labels;
  }

  /**
   * {@inheritdoc}
   */
  public function getSettableValues(AccountInterface $account = NULL) {
    return array_keys($this->getSettableOptions($account));
  }

  /**
   * {@inheritdoc}
   */
  public function getSettableOptions(AccountInterface $account = NULL) {
    // $this->value is unpopulated due to https://www.drupal.org/node/2629932
    $field_name = $this->getFieldDefinition()->getName();
    $value = $this->getEntity()->get($field_name)->value;
    $allowed_states = $this->getAllowedStates($value);
    $state_labels = array_map(function (WorkflowState $state) {
      return $state->getLabel();
    }, $allowed_states);

    return $state_labels;
  }

  /**
   * Gets the next allowed states for the given field value.
   *
   * @param string $value
   *   The field value, representing the state ID.
   *
   * @return \Drupal\state_machine\Plugin\Workflow\WorkflowState[]
   *   The allowed states.
   */
  protected function getAllowedStates($value) {
    $workflow = $this->getWorkflow();
    if (!$workflow) {
      // The workflow is not known yet, the field is probably being created.
      return [];
    }
    $allowed_states = [];
    if (!empty($value) && ($current_state = $workflow->getState($value))) {
      $allowed_states[$value] = $current_state;
    }

    $transitions = $workflow->getAllowedTransitions($value, $this->getEntity());
    foreach ($transitions as $transition) {
      $state = $transition->getToState();
      $allowed_states[$state->getId()] = $state;
    }

    return $allowed_states;
  }

  /**
   * {@inheritdoc}
   */
  public function getWorkflow() {
    if ($callback = $this->getSetting('workflow_callback')) {
      $workflow_id = call_user_func($callback, $this->getEntity());
    }
    else {
      $workflow_id = $this->getSetting('workflow');
    }
    if (empty($workflow_id)) {
      return FALSE;
    }
    $workflow_manager = \Drupal::service('plugin.manager.workflow');

    return $workflow_manager->createInstance($workflow_id);
  }

  /**
   * {@inheritdoc}
   */
  public function getOriginalId() {
    return $this->originalValue;
  }

  /**
   * {@inheritdoc}
   */
  public function getId() {
    return $this->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    $label = $this->value;
    if ($workflow = $this->getWorkflow()) {
      $state = $workflow->getState($this->value);
      if ($state) {
        $label = $state->getLabel();
      }
    }

    return $label;
  }

  /**
   * {@inheritdoc}
   */
  public function getTransitions() {
    $transitions = [];
    if ($workflow = $this->getWorkflow()) {
      $transitions = $workflow->getAllowedTransitions($this->value, $this->getEntity());
    }
    return $transitions;
  }

  /**
   * {@inheritdoc}
   */
  public function applyTransition(WorkflowTransition $transition) {
    $this->setValue(['value' => $transition->getToState()->getId()]);
  }

  /**
   * {@inheritdoc}
   */
  public function applyTransitionById($transition_id) {
    $transition = NULL;
    if ($workflow = $this->getWorkflow()) {
      $transition = $workflow->getTransition($transition_id);
    }
    if (!$transition) {
      throw new \InvalidArgumentException(sprintf('Unknown transition ID "%s".', $transition_id));
    }

    $this->applyTransition($transition);
  }

  /**
   * {@inheritdoc}
   */
  public function preSave() {
    if ($this->value != $this->originalValue) {
      $this->dispatchTransitionEvent('pre_transition');
    }
  }

  /**
   * {@inheritdoc}
   */
  public function postSave($update) {
    if ($this->value != $this->originalValue) {
      $this->dispatchTransitionEvent('post_transition');
    }
    $this->originalValue = $this->value;
  }

  /**
   * Dispatches a transition event for the given phase.
   *
   * @param string $phase
   *   The phase: pre_transition OR post_transition.
   */
  protected function dispatchTransitionEvent($phase) {
    /** @var \Drupal\state_machine\Plugin\Workflow\WorkflowInterface $workflow */
    $workflow = $this->getWorkflow();
    $transition = $workflow->findTransition($this->originalValue, $this->value);
    if ($transition) {
      $field_name = $this->getFieldDefinition()->getName();
      $group_id = $workflow->getGroup();
      $transition_id = $transition->getId();
      $event_dispatcher = \Drupal::getContainer()->get('event_dispatcher');
      $event = new WorkflowTransitionEvent($transition, $workflow, $this->getEntity(), $field_name);
      $events = [
        // For example: 'commerce_order.place.pre_transition'.
        $group_id . '.' . $transition_id . '.' . $phase,
        // For example: 'commerce_order.pre_transition'.
        $group_id . '.' . $phase,
        // For example: 'state_machine.pre_transition'.
        'state_machine.' . $phase,
      ];
      foreach ($events as $event_id) {
        $event_dispatcher->dispatch($event_id, $event);
      }
    }
  }

}
