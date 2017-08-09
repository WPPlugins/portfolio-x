<?php

// Admin end css and jsThe plugin does not have a valid header
add_action('admin_enqueue_scripts', 'qcld_portfolio_admin_enque_script');

function qcld_portfolio_admin_enque_script()
{
    $screen = get_current_screen();
	
	if( $screen->id == 'portfolio-x' ) {
		wp_enqueue_style('jquery-datepicker', plugins_url('css/jquery-datepicker.css', __FILE__));
    }
    wp_enqueue_script(
        'qcpo-admin-scripts',
        plugins_url('/js/qcpo-admin-scripts.js', __FILE__),
        array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker'),
        time(),
        true
    );
}


add_action('wp_footer', 'qcld_footer_js_loader');

function qcld_footer_js_loader()
{
    wp_enqueue_script('qc_portfolio_custom_script', PORTFOLIO_URL . '/js/script.js', array('jquery'), QC_PORTFOLIO_VER);
}


//All js and Css Are call
function qcld_portfolio_scripts()
{
    wp_enqueue_script('skrollr', PORTFOLIO_URL . '/js/skrollr.min.js');

    wp_enqueue_style('qc_font_awesome', PORTFOLIO_URL . '/css/font-awesome.css');

    wp_enqueue_style('qc_lity_css', PORTFOLIO_URL . '/css/lity.min.css');

    wp_enqueue_style('qcpo_commom_stylesheet', PORTFOLIO_URL . '/css/common-style.css');


    wp_enqueue_script('jquery');

    wp_enqueue_script('qc_lity_js', PORTFOLIO_URL . '/js/lity.min.js', array('jquery'));
    
}

add_action('wp_enqueue_scripts', 'qcld_portfolio_scripts');

//Custom CSS

add_action('wp_head', 'qcld_add_custom_css_in_head');

function qcld_add_custom_css_in_head()
{
    $customCss = qcpx_get_option('qcld_port_custom_css');

    if( trim($customCss) != "" ){
        ?>
        <style>
            <?php echo trim($customCss); ?>
        </style>
        <?php
    }
}