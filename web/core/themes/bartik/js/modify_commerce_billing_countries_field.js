jQuery( document ).ready(function() {
    jQuery(function() {
        if ( document.location.href.indexOf('store/') > -1 ) {
            if ( document.location.href.indexOf('add') > -1 || document.location.href.indexOf('edit') > -1 ) {
            jQuery("select option[value='USD']").attr("selected","selected");
            jQuery("select option[value='US']").attr("selected","selected");
            }
            jQuery("#edit-default-currency-wrapper").css("display","none");
            jQuery("#edit-billing-countries-wrapper").css("display","none");
            jQuery("#edit-tax-settings").css("display","none");
        }
    });
});