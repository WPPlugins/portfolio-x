<?php

define('PXF_PROMO_SUBMENU_SLUG', 'edit.php?post_type=qcpx_portfolio');

/**
 * Register a custom promo menu page.
 */
function qcpro_pxf_add_promo_menu_page(){

	add_submenu_page(
        PXF_PROMO_SUBMENU_SLUG,
        __( 'More WordPress Goodies for You!', 'quantumcloud' ),
        __( 'More', 'quantumcloud' ),
        'manage_options',
        'qcpro-promo-page',
        'qcpromo_pxf_add_promo_page_callaback'
    );
	
}

add_action( 'admin_menu', 'qcpro_pxf_add_promo_menu_page' );
 
/**
 * Display promo page content
 */
function qcpromo_pxf_add_promo_page_callaback()
{
    //Include Part File
	require_once('main-part-file.php');  
}