<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/custom/marketplace/templates/page.html.twig */
class __TwigTemplate_df75baddf2f046a8a68c1cbac5dc151ce811b751922545533ade554c60eb6ee6 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 64];
        $filters = ["escape" => 60, "raw" => 62, "t" => 75];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'raw', 't'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 59
        echo "
<a href=\"";
        // line 60
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["front_page"] ?? null)), "html", null, true);
        echo "\" id=\"base-path\" style=\"display: none;\"></a>
<div id=\"page-wrapper\">
  <div id=\"page\" class=\"page\" ";
        // line 62
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->sandbox->ensureToStringAllowed(($context["page_css"] ?? null)));
        echo ">

  \t";
        // line 64
        if ($this->getAttribute(($context["page"] ?? null), "show_skins_menu", [])) {
            // line 65
            echo "    ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "show_skins_menu", [])));
            echo "
 \t";
        }
        // line 67
        echo "
    ";
        // line 68
        if ($this->getAttribute(($context["page"] ?? null), "headline", [])) {
            // line 69
            echo "      <section id=\"headline\" class=\"headline\">
        <div class=\"section container\">
          ";
            // line 71
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "headline", [])), "html", null, true);
            echo "
        </div>
      </section>
    ";
        }
        // line 75
        echo "    <header id=\"header\" class=\"header\" role=\"banner\" aria-label=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Site header"));
        echo "\">
      <div class=\"section container\">
\t\t  <a id=\"button-main-menu\" href=\"#\" class=\"navbar-toggle collapsed\" >
\t\t\t  <span class=\"sr-only\">Toggle navigation</span>
\t\t\t  <span class=\"icon-bar\"></span>
\t\t\t  <span class=\"icon-bar\"></span>
\t\t\t  <span class=\"icon-bar\"></span>
\t\t  </a>
        ";
        // line 83
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "secondary_menu", [])), "html", null, true);
        echo "
        ";
        // line 84
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header", [])), "html", null, true);
        echo "
        ";
        // line 85
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "primary_menu", [])), "html", null, true);
        echo "

      </div>
    </header>
    ";
        // line 89
        if ($this->getAttribute(($context["page"] ?? null), "featured_top", [])) {
            // line 90
            echo "      <div class=\"featured-top\">
        <aside class=\"featured-top__inner section clearfix\" role=\"complementary\">
          ";
            // line 92
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "featured_top", [])), "html", null, true);
            echo "
        </aside>
      </div>
    ";
        }
        // line 96
        echo "    ";
        if ($this->getAttribute(($context["page"] ?? null), "breadcrumb", [])) {
            // line 97
            echo "        <div class=\"section-breadcrumb\">
            <div class=\"container\">
                ";
            // line 99
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "breadcrumb", [])), "html", null, true);
            echo "
            </div>
        </div>
    ";
        }
        // line 103
        echo "    <div id=\"main-wrapper\" class=\"layout-main-wrapper clearfix\">
      <div id=\"main\" class=\"layout-main clearfix\">
        <div class=\"container\">
\t\t\t<div class=\"row\">
\t\t\t\t";
        // line 107
        if ($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])) {
            // line 108
            echo "\t\t\t\t\t<div id=\"sidebar-first\" class=\"column sidebar col-md-";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebar_first_width"] ?? null)), "html", null, true);
            echo " col-sm-12\">
\t\t\t\t\t\t<aside class=\"section\" role=\"complementary\">
\t\t\t\t\t\t\t";
            // line 110
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])), "html", null, true);
            echo "
\t\t\t\t\t\t</aside>
\t\t\t\t\t</div>
\t\t\t\t";
        }
        // line 114
        echo "
\t\t\t\t<div class=\"col-md-";
        // line 115
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["main_content_width"] ?? null)), "html", null, true);
        echo " col-sm-12\">
\t\t\t\t\t<div id=\"highlighted\" class=\"highlighted\">
\t\t\t\t\t\t<div class=\"row\" role=\"complementary\">
\t\t\t\t\t\t\t";
        // line 118
        if ($this->getAttribute(($context["page"] ?? null), "highlighted_first", [])) {
            // line 119
            echo "\t\t\t\t\t\t\t\t<div class=\"panel-column page-highlighted-first col-md-4\">
\t\t\t\t\t\t\t\t\t";
            // line 120
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "highlighted_first", [])), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
        }
        // line 123
        echo "\t\t\t\t\t\t\t";
        if ($this->getAttribute(($context["page"] ?? null), "highlighted_second", [])) {
            // line 124
            echo "\t\t\t\t\t\t\t\t<div class=\"panel-column page-highlighted-second col-md-8\">
\t\t\t\t\t\t\t\t\t";
            // line 125
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "highlighted_second", [])), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
        }
        // line 128
        echo "\t\t\t\t\t\t\t";
        if ($this->getAttribute(($context["page"] ?? null), "highlighted_third", [])) {
            // line 129
            echo "\t\t\t\t\t\t\t\t<div class=\"panel-column page-highlighted-third col-md-4\">
\t\t\t\t\t\t\t\t\t";
            // line 130
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "highlighted_third", [])), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
        }
        // line 133
        echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t";
        // line 135
        if ($this->getAttribute(($context["page"] ?? null), "panel_first", [])) {
            // line 136
            echo "\t\t\t\t\t\t<div class=\"panel-top\">
\t\t\t\t\t\t\t<aside class=\"clearfix\" role=\"complementary\">
\t\t\t\t\t\t\t\t";
            // line 138
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "panel_first", [])), "html", null, true);
            echo "
\t\t\t\t\t\t\t</aside>
\t\t\t\t\t\t</div>
\t\t\t\t\t";
        }
        // line 142
        echo "\t\t\t\t\t<main id=\"content\" class=\"column main-content\" role=\"main\">
\t\t\t\t\t\t<section class=\"section\">
\t\t\t\t\t\t\t<a id=\"main-content\" tabindex=\"-1\"></a>
\t\t\t\t\t\t\t";
        // line 145
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
        echo "
\t\t\t\t\t\t</section>
\t\t\t\t\t</main>
\t\t\t\t</div>

\t\t\t\t";
        // line 150
        if ($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])) {
            // line 151
            echo "\t\t\t\t\t<div id=\"sidebar-second\" class=\"column sidebar col-md-";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebar_second_width"] ?? null)), "html", null, true);
            echo " col-sm-12\">
\t\t\t\t\t\t<aside class=\"section\" role=\"complementary\">
\t\t\t\t\t\t\t";
            // line 153
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])), "html", null, true);
            echo "
\t\t\t\t\t\t</aside>
\t\t\t\t\t</div>
\t\t\t\t";
        }
        // line 157
        echo "\t\t\t</div>
\t\t</div>
      </div>
    </div>
    ";
        // line 161
        if (($this->getAttribute(($context["page"] ?? null), "panel_second", []) || $this->getAttribute(($context["page"] ?? null), "panel_third", []))) {
            // line 162
            echo "\t\t<div class=\"panel-bottom\">
\t\t\t<div class=\"container\">
\t\t\t\t";
            // line 164
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "panel_second", [])), "html", null, true);
            echo "
\t\t\t</div>
\t\t\t";
            // line 166
            if ($this->getAttribute(($context["page"] ?? null), "panel_third", [])) {
                // line 167
                echo "\t\t\t\t<div class=\"panel-third\">
\t\t\t\t\t<div class=\"container\">
\t\t\t\t\t\t";
                // line 169
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "panel_third", [])), "html", null, true);
                echo "
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t";
            }
            // line 173
            echo "\t\t</div>
    ";
        }
        // line 175
        echo "    <footer class=\"site-footer\">
      <div class=\"container\">
        ";
        // line 177
        if (((($this->getAttribute(($context["page"] ?? null), "footer_first", []) || $this->getAttribute(($context["page"] ?? null), "footer_second", [])) || $this->getAttribute(($context["page"] ?? null), "footer_third", [])) || $this->getAttribute(($context["page"] ?? null), "footer_fourth", []))) {
            // line 178
            echo "          <div class=\"site-footer__top\">
            ";
            // line 179
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_first", [])), "html", null, true);
            echo "
            ";
            // line 180
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_second", [])), "html", null, true);
            echo "
            ";
            // line 181
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_third", [])), "html", null, true);
            echo "
            ";
            // line 182
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_fourth", [])), "html", null, true);
            echo "
          </div>
        ";
        }
        // line 185
        echo "        ";
        if ($this->getAttribute(($context["page"] ?? null), "footer", [])) {
            // line 186
            echo "          <div class=\"site-footer__bottom\">
            ";
            // line 187
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer", [])), "html", null, true);
            echo "
          </div>
        ";
        }
        // line 190
        echo "      </div>
    </footer>
    <a title=\"Back to Top\" class=\"btn-btt\" href=\"#Top\"></a>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/marketplace/templates/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  329 => 190,  323 => 187,  320 => 186,  317 => 185,  311 => 182,  307 => 181,  303 => 180,  299 => 179,  296 => 178,  294 => 177,  290 => 175,  286 => 173,  279 => 169,  275 => 167,  273 => 166,  268 => 164,  264 => 162,  262 => 161,  256 => 157,  249 => 153,  243 => 151,  241 => 150,  233 => 145,  228 => 142,  221 => 138,  217 => 136,  215 => 135,  211 => 133,  205 => 130,  202 => 129,  199 => 128,  193 => 125,  190 => 124,  187 => 123,  181 => 120,  178 => 119,  176 => 118,  170 => 115,  167 => 114,  160 => 110,  154 => 108,  152 => 107,  146 => 103,  139 => 99,  135 => 97,  132 => 96,  125 => 92,  121 => 90,  119 => 89,  112 => 85,  108 => 84,  104 => 83,  92 => 75,  85 => 71,  81 => 69,  79 => 68,  76 => 67,  70 => 65,  68 => 64,  63 => 62,  58 => 60,  55 => 59,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/marketplace/templates/page.html.twig", "/home/freshfoodnearby/public_html/ffnstore/web/themes/custom/marketplace/templates/page.html.twig");
    }
}
