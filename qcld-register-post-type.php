<?php

add_action('init', 'qcld_portfolio_register');
add_action('init', 'qcld_portfolio_items_register');

//Register Post Type
function qcld_portfolio_register()
{
    $labels = array(
        'name' => __('Portfolios'),
        'singular_name' => __('Portfolio'),
        'add_new' => __('Add Portfolio'),
        'add_new_item' => __('Add New Portfolio'),
        'edit_item' => __('Edit Portfolio'),
        'new_item' => __('New Portfolio'),
        'view_item' => __('View Portfolio'),
        'search_items' => __('Search Portfolio'),
        'not_found' => __('No Portfolio Items found'),
        'not_found_in_trash' => __('No Portfolio Items found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => __('Portfolio X')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'qcpx_portfolio'),
        'has_archive' => true,
        'supports' => array(
            'title',
        ),
        'menu_position' => 23,
        'menu_icon' => 'dashicons-camera',
    );
	
    register_post_type('qcpx_portfolio', $args);
	
}

function qcld_portfolio_items_register()
{
    $labels = array(
        'name' => __('Portfolio Item'),
        'singular_name' => __('Portfolio Item'),
        'add_new' => __('Add Portfolio Item'),
        'add_new_item' => __('Add New Portfolio Item'),
        'edit_item' => __('Edit Portfolio Item'),
        'new_item' => __('New Portfolio Item'),
        'view_item' => __('View Portfolio Item'),
        'search_items' => __('Search Portfolio Item'),
        'not_found' => __('No Portfolio Items found'),
        'not_found_in_trash' => __('No Portfolio Items found in Trash'),
        'parent_item_colon' => '',
        'menu_name' => __('Portfolio Items')
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'portfolio-x'),
        'has_archive' => true,
        'show_in_menu' => 'edit.php?post_type=portfolio',
        'supports' => array(
            'title',
            'thumbnail',
            'editor',
            'page-attributes'
        ),
    );
	
    register_post_type('portfolio-x', $args);
	
}


add_action( 'init', 'qcld_create_portfolio_taxonomies', 0 );


function qcld_create_portfolio_taxonomies() {

	$labels = array(
		'name'              => _x( 'Project Types', 'Project Types', 'portfolio-x' ),
		'singular_name'     => _x( 'Project Type', 'Project Type', 'portfolio-x' ),
		'search_items'      => __( 'Search Project Type', 'portfolio-x' ),
		'all_items'         => __( 'All Project Type', 'portfolio-x' ),
		'parent_item'       => __( 'Parent Portfolio Type', 'portfolio-x' ),
		'parent_item_colon' => __( 'Parent Project Type:', 'portfolio-x' ),
		'edit_item'         => __( 'Edit Project Type', 'portfolio-x' ),
		'update_item'       => __( 'Update Portfolio Type', 'portfolio-x' ),
		'add_new_item'      => __( 'Add New Project Type', 'portfolio-x' ),
		'new_item_name'     => __( 'New Project Type', 'portfolio-x' ),
		'menu_name'         => __( 'Project Type', 'portfolio-x' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'portfolio_type' ),
	);

	register_taxonomy( 'portfolio_type', array( 'portfolio-x' ), $args );

	//Tags
	$labels = array(
		'name'                       => _x( 'Technologies', 'Technologies', 'portfolio-x' ),
		'singular_name'              => _x( 'Technology', 'Technology', 'portfolio-x' ),
		'search_items'               => __( 'Search Technology', 'portfolio-x' ),
		'popular_items'              => __( 'Popular Technology', 'portfolio-x' ),
		'all_items'                  => __( 'All Technologies', 'portfolio-x' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Technology', 'portfolio-x' ),
		'update_item'                => __( 'Update Technology', 'portfolio-x' ),
		'add_new_item'               => __( 'Add New Technology', 'portfolio-x' ),
		'new_item_name'              => __( 'New Technology Name', 'portfolio-x' ),
		'separate_items_with_commas' => __( 'Separate technology with commas', 'portfolio-x' ),
		'add_or_remove_items'        => __( 'Add or remove technology', 'portfolio-x' ),
		'choose_from_most_used'      => __( 'Choose from the most used technologies', 'portfolio-x' ),
		'not_found'                  => __( 'No Technology found.', 'portfolio-x' ),
		'menu_name'                  => __( 'Technologies', 'portfolio-x' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'portfolio_technology' ),
	);

	register_taxonomy( 'portfolio_technology', 'portfolio-x', $args );
}

/*
* Metabox : If already not active, then require it.
*/

if( function_exists('is_plugin_active') )
{

    if(!is_plugin_active('CMB2/init.php'))
	{
        if (file_exists(dirname(__FILE__) . '/inc/cmb2/init.php')) {
			require_once dirname(__FILE__) . '/inc/cmb2/init.php';
		} elseif (file_exists(dirname(__FILE__) . '/inc/CMB2/init.php')) {
			require_once dirname(__FILE__) . '/inc/CMB2/init.php';
		}
    }
	
}
else
{

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    
	if(!is_plugin_active('CMB2/init.php'))
	{
        if (file_exists(dirname(__FILE__) . '/inc/cmb2/init.php')) {
			require_once dirname(__FILE__) . '/inc/cmb2/init.php';
		} elseif (file_exists(dirname(__FILE__) . '/inc/CMB2/init.php')) {
			require_once dirname(__FILE__) . '/inc/CMB2/init.php';
		}
    }
	
}

/*
* Declare metabox fields through filter
*/

add_action('cmb2_admin_init', 'qc_portfolio_items_register_metaboxes');

function qc_portfolio_items_register_metaboxes()
{
    $prefix = 'qc_portfolio_';

    $qc_meta_box = new_cmb2_box(array(
        'id' => $prefix . 'metabox',
        'title' => esc_html__('Portfolio Details', 'cmb2'),
        'object_types' => array('portfolio-x',), // Post type
        'cmb_styles' => true,
    ));
	
	$assign = new_cmb2_box(array(
        'id' => $prefix . 'assignportfolio',
        'title' => esc_html__('Assign', 'cmb2'),
        'object_types' => array('portfolio-x',), // Post type
        'cmb_styles' => true,
    ));

    $qc_meta_box->add_field(array(
        'name' => esc_html__('Short Description', 'cmb2'),
        'desc' => esc_html__('', 'cmb2'),
        'id' => $prefix . 'wysiwyg',
        'type' => 'wysiwyg',
        'options' => array('media_buttons' => false, 'textarea_rows' => 5,),
    ));

    $qc_meta_box->add_field(array(
        'name' => esc_html__('Live Project URL', 'cmb2'),
        'desc' => esc_html__('Your project URL.', 'cmb2'),
        'id' => $prefix . 'url',
        'type' => 'text_url',
    ));
	
	$qc_meta_box->add_field(array(
        'name' => esc_html__('Display Project URL', 'cmb2'),
		'desc' => esc_html__('Dispay project URL under listing page.', 'cmb2'),
        'id' => $prefix . 'disp_url',
        'type' => 'checkbox',
    ));

    $qc_meta_box->add_field(array(
        'name' => 'Choose Start Date',
        'id' => 'qcld_start_date',
        'type' => 'text_date_timestamp',
    ));

    $qc_meta_box->add_field(array(
        'name' => 'Choose End Date',
        'id' => 'qcld_end_date',
        'type' => 'text_date_timestamp',
    ));


    $qc_meta_box->add_field(array(
        'name' => esc_html__('Gallery Images', 'cmb2'),
        'desc' => esc_html__('Upload or add multiple images.', 'cmb2'),
        'id' => $prefix . 'gallery_images',
        'type' => 'file_list',
        'preview_size' => array(100, 100),
    ));
	
	$assign->add_field( array(
		'name'       => __( 'Assign Portfolio', 'cmb2' ),
		'desc'       => __( 'Please select portfolio (one or more) to assign current portfolio item under them.', 'cmb2' ),
		'id'         => $prefix . 'portfolio_assigned',
		'type'       => 'multicheck',
		'options_cb' => 'cmb2_get_portfolio_post_options',
		
	) );

}

add_action('cmb2_admin_init', 'qcld_portfolios_register_metaboxes');

function qcld_portfolios_register_metaboxes()
{
    $prefix = 'qc_port_settings_';

    $tpl_settings = new_cmb2_box(array(
        'id' => $prefix . 'tplsettings',
        'title' => esc_html__('Template Settings', 'cmb2'),
        'object_types' => array('qcpx_portfolio',), // Post type
        'cmb_styles' => true,
    ));

    $tpl_settings->add_field( array(
		'name'             => 'Select Template',
		'desc'             => 'Please select a predefined template.',
		'id'               => $prefix . 'template',
		'type'             => 'select',
		'show_option_none' => false,
		'default'          => 'template-01',
		'options'          => array(
			'template-01' => __( 'Template 01', 'portfolio-x' ),
			'template-02'   => __( 'Template 02', 'portfolio-x' ),
			'template-03'   => __( 'Template 03', 'portfolio-x' ),
			'template-04'   => __( 'Template 04', 'portfolio-x' ),
		),
	) );
	
	$tpl_settings->add_field( array(
		'name'             => 'Order By',
		'desc'             => 'Please select preferred orderby parameter.',
		'id'               => $prefix . 'orderby',
		'type'             => 'select',
		'show_option_none' => false,
		'default'          => 'title',
		'options'          => array(
			'title' => __( 'Title', 'portfolio-x' ),
			'ID' => __( 'Item ID', 'portfolio-x' ),
			'date' => __( 'Date', 'portfolio-x' ),
			'rand' => __( 'Random', 'portfolio-x' ),
			'menu_order' => __( 'Menu Order', 'portfolio-x' ),
		),
	) );
	
	$tpl_settings->add_field( array(
		'name'             => 'Order',
		'desc'             => 'Please select preferred order.',
		'id'               => $prefix . 'order',
		'type'             => 'select',
		'show_option_none' => false,
		'default'          => 'ASC',
		'options'          => array(
			'ASC' => __( 'Ascending', 'portfolio-x' ),
			'DESC' => __( 'Descending', 'portfolio-x' ),
		),
	) );   

}

//Admin Dashboard Listing Portfolio Columns Title
function qcld_portfolio_item_add_new_column()
{
    $columns['cb'] = '<input type="checkbox" />';
    $columns['title'] = __('Title', 'portfolio-x');
    $columns['thumbnail'] = __('Thumbnail', 'portfolio-x');
	$columns['portfolio_category'] = __('Project Types', 'portfolio-x');
    $columns['author'] = __('Author', 'portfolio-x');
    $columns['date'] = __('Date', 'portfolio-x');
    return $columns;
}

//Admin Dashobord Listing Portfolio Columns Manage
function qcld_portfolio_item_manage_custom_columns($columns)
{
    global $post;
    switch ($columns) {
        case 'thumbnail':
            if (get_the_post_thumbnail($post->ID, 'thumbnail')) {
                echo get_the_post_thumbnail($post->ID, 'thumbnail');
            } else {
                echo '<img width="150" height="150" src="' . PORTFOLIO_URL . '/images/no_images.jpg" class="attachment-thumbnail wp-post-image" alt="Penguins">';
            }
            break;
        case 'portfolio_category':
            $terms = wp_get_post_terms($post->ID, 'portfolio_type');
            foreach ($terms as $term) {
                echo $term->name . '&nbsp;&nbsp; ';
            }
            break;
    }
}


//Method And Action Are Call
add_filter('manage_edit-portfolio_item_columns', 'qcld_portfolio_item_add_new_column');
add_action('manage_portfolio_item_posts_custom_column', 'qcld_portfolio_item_manage_custom_columns', 5, 2);


//Admin Dashboard Listing Portfolio Columns Title
function qcld_portfolio_add_new_column()
{
    $columns['cb'] = '<input type="checkbox" />';
    $columns['title'] = __('Title', 'portfolio-x');
    $columns['shortcode'] = __('Shortcode', 'portfolio-x');
    $columns['date'] = __('Date', 'portfolio-x');
    return $columns;
}

//Admin Dashobord Listing Portfolio Columns Manage
function qcld_portfolio_manage_custom_columns($columns)
{
    global $post;
    switch ($columns) {
        case 'shortcode':
			echo '[portfolio-x portfolio="'.$post->ID.'"]';
            break;
    }
}

//Method And Action Are Call
add_filter('manage_edit-portfolio_columns', 'qcld_portfolio_add_new_column');
add_action('manage_portfolio_posts_custom_column', 'qcld_portfolio_manage_custom_columns', 5, 2);

/*Register Custom CMB*/
/**
 * Gets a number of posts and displays them as options
 * @param  array $query_args Optional. Overrides defaults.
 * @return array             An array of options that matches the CMB2 options array
 */
function cmb2_get_post_options( $query_args ) {

    $args = wp_parse_args( $query_args, array(
        'post_type'   => 'post',
    ) );

    $posts = get_posts( $args );

    $post_options = array();
    if ( $posts ) {
        foreach ( $posts as $post ) {
          $post_options[ $post->ID ] = $post->post_title;
        }
    }

    return $post_options;
}

/**
 * Gets posts for portfolio and displays them as options
 * @return array An array of options that matches the CMB2 options array
 */
function cmb2_get_portfolio_post_options() {
    return cmb2_get_post_options( array( 'post_type' => 'qcpx_portfolio' ) );
}

/*******************************
 * Remove Menu Page
 *******************************/
function qcld_portfolio_menu_page_removing() {
    //remove_submenu_page( '' );
    remove_submenu_page( 'edit.php?post_type=qcpx_portfolio', 'post-new.php?post_type=qcpx_portfolio' );
}

add_action( 'admin_menu', 'qcld_portfolio_menu_page_removing' );


function qcld_portfolio_add_new_portfolio_sub() {
    
    add_submenu_page(
        'edit.php?post_type=qcpx_portfolio',
        'Portfolio Items',
        'Portfolio Items',
        'manage_options',
        'edit.php?post_type=portfolio-x'
    );

    add_submenu_page(
        'edit.php?post_type=qcpx_portfolio',
        'Add Portfolio Item',
        'Add Portfolio Item',
        'manage_options',
        'post-new.php?post_type=portfolio-x'
    );
    
}

add_action('admin_menu', 'qcld_portfolio_add_new_portfolio_sub');
