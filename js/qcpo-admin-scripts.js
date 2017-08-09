jQuery(document).ready(function ($) {
    jQuery('.projectDate').datepicker({dateFormat: 'yy-mm-dd'});
    //Single detial page width settings
    if(jQuery('#qcpx_details_page_width').val()=='single_full'){
        jQuery("#setting_qcpx_details_page_width_val").css({'display':'none'});
    }
    jQuery('#qcpx_details_page_width').change(function() {
        if (this.value == 'single_box') {
            jQuery("#setting_qcpx_details_page_width_val").css({'display':'block'});
        }
        else{
            jQuery("#setting_qcpx_details_page_width_val").css({'display':'none'});
        }
    });
    //Filttered listing page width settings
    if(jQuery('input[type=radio][name="qcpx_plugin_options[qcld_template_links]"]:checked').val()=='off'){
        jQuery("#setting_qcpx_list_page_width").css({'display':'none'});
        jQuery("#setting_qcpx_list_page_width_val").css({'display':'none'});
    } else if(jQuery('input[type=radio][name="qcpx_plugin_options[qcld_template_links]"]:checked').val()=='on'){
        if (this.value == 'list_full') {
            jQuery("#setting_qcpx_list_page_width_val").css({'display':'none'});
        }
    }

    jQuery('input[type=radio][name="qcpx_plugin_options[qcld_template_links]"]').change(function() {
        if (this.value == 'on' ) {
            jQuery("#setting_qcpx_list_page_width").css({'display':'block'});
        }
        else if (this.value == 'off' ){
            jQuery("#setting_qcpx_list_page_width").css({'display':'none'});
            jQuery("#setting_qcpx_list_page_width_val").css({'display':'none'});
        }
    });
    jQuery('#qcpx_list_page_width').change(function() {
        if (this.value == 'list_box') {
            jQuery("#setting_qcpx_list_page_width_val").css({'display':'block'});
        }
        else{
            jQuery("#setting_qcpx_list_page_width_val").css({'display':'none'});
        }
    });

});