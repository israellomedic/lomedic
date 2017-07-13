require(['datepicker','datatables','multiselect'], function(datepicker, datatables, multiselect) {
    jQuery(function() {
        jQuery("#txtFecha").datepicker();
        jQuery("#example").DataTable({ "scrollY" : "200px" });
        jQuery("#mselectmultiple").multiselect();
        jQuery("#mselectmultiplegrp").multiselect();
        jQuery("#selectmenu").selectmenu();
        jQuery("select[name='selectmenu2']").selectmenu();
    });
});