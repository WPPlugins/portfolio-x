<?php
/**
 * Plugin Name: Portfolio X
 * Plugin URI: https://www.quantumcloud.com/
 * Description: Portfolio X is an advanced portfolio manager with streamlined workflow & unique designs to showcase your works. Slideshow and Widgets included.
 * Version: 1.8.0
 * Author: QuantumCloud
 * Author URI: https://www.quantumcloud.com/
 * Requires at least: 3.0
 * Tested up to: 4.8.0
 * Text Domain: portfolio-x
 * Domain Path: /lang/
 * License: GPL2
 */

defined('ABSPATH') or die("No direct script access!");

define('PORTFOLIO_DIR', dirname(__FILE__));
define('PORTFOLIO_THEMES_DIR', PORTFOLIO_DIR . "/themes");

define('PORTFOLIO_URL', plugin_dir_url(__FILE__));
define('PORTFOLIO_THEME_URL', PORTFOLIO_URL . "/themes/");

define('QC_PORTFOLIO_VER', '1.6.3');


/*******************************
 * Settings Framework and Configs
 *******************************/
require_once('portfolio-settings.php');

/*******************************
 * Function to get Settings Items
 *******************************/
if( !function_exists('qcpx_get_option') )
{

  function qcpx_get_option($field_id = null)
  {

    $parent_id = 'qcpx_plugin_options';
    $options = get_option($parent_id);

    $data = "";

    if( $field_id != null && isset($options[$field_id]) ){
      $data = $options[$field_id];
    }

    return $data;

  }

}

/*******************************
 * Other Inc Files
 *******************************/
require_once('qcld-register-post-type.php');
require_once('qcld-functions.php');
require_once('qcld-register-shortcodes.php');
require_once('qcld-scripts.php');
require_once('qcld-admin-end-functions.php');
require_once('qcld-widgets.php');
require_once('qcld-shortcode-2.php');
require_once('qcld-shortcode-generator.php');
require_once('qc-support-promo-page/class-qc-support-promo-page.php');

require_once('qcld-upgrade-posttype.php');

/*******************************
 * Custom Thumb Size
 *******************************/

if ( function_exists( 'add_image_size' ) ) 
{ 
  add_image_size( 'tpl5-thumb', 400, 450, array( 'center', 'top' ) );
  add_image_size( 'tpl9-thumb', 610, 400, array( 'center', 'top' ) );
  add_image_size( 'qc-portfolio', 666, 783, array( 'center', 'top' ) );
  add_image_size( 'tpl2-thumb', 650, 650, array( 'center', 'top' ) );
  add_image_size( 'tpl7-thumb', 950, 475, array( 'center', 'top' ) );
  add_image_size( 'tpl11-thumb', 1700, 860, array( 'center', 'top' ) );
  add_image_size( 'tpl12-thumb', 450, 485, array( 'center', 'top' ) );
}

//Get All Portfolio Category
function qcld_portfolio_list_portfolios()
{

    $args = array(
      'post_type'   => 'qcpx_portfolio',
      'posts_per_page'   => -1,
      'orderby'   => 'title',
      'order'   => 'ASC',
    );
     
    $portfolio = new WP_Query( $args );
    
    while ( $portfolio->have_posts() ) {

            $portfolio->the_post();
        ?>

        <li>
            <a title="View all portfolio items filed under <?php echo get_the_title(); ?>"
               href="<?php echo get_permalink(); ?>">
               <?php echo get_the_title(); ?>
           </a>
        </li>

    <?php }

    wp_reset_postdata();

}

/*******************************
 * Portfolio_Item Single Page Template
 *******************************/

add_action('template_include', 'qcld_portfolio_item_template_detail_page');

//Portfolio Details Page
function qcld_portfolio_item_template_detail_page( $template )
{
    global $post, $posts;

    if ( 'portfolio-x' == get_post_type() && is_single() ) 
    {
        $template = PORTFOLIO_THEMES_DIR . "/qcld-portfolio-single-view.php";
    }

    return $template;
}

/*******************************
 * Set Taxonomy Page Template
 *******************************/

add_filter('template_include', 'qcld_portfolio_set_tax_template');

function qcld_portfolio_set_tax_template($template)
{

    if ( is_archive() && 'portfolio-x' == get_post_type() ) 
    {
        $template = PORTFOLIO_THEMES_DIR . "/qcld-category-template.php";
    }

    return $template;

}

/*******************************
 * Load Scripts in Archive Page
 *******************************/

function qcld_load_scripts()
{
    if ( ( is_archive() && 'qcpx_portfolio' == get_post_type() ) || ( is_single() && 'portfolio' == get_post_type() ) ) {
    }
}

add_action('wp_enqueue_scripts', 'qcld_load_scripts');

/*******************************
 * Per Page Item - Reset
 *******************************/
add_action( 'pre_get_posts',  'qcld_set_per_page_items_in_portfolio'  );

function qcld_set_per_page_items_in_portfolio( $query ) 
{

  global $wp_the_query;

  if ( !is_admin() ) 
  {
    if( is_post_type_archive('qcpx_portfolio' ) || is_tax( 'portfolio_type' ) )
    {
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;

        $query->set( 'posts_per_page', qcpx_get_option('qcld_post_per_page') );
        $query->set( 'paged', $paged );
    }
  }

  return $query;

}

/*******************************
 * Add Support: Menu Order 
 *******************************/
add_action( 'admin_init', 'qcld_portfolio_order_wpse_attr' );

function qcld_portfolio_order_wpse_attr() 
{
    add_post_type_support( 'portfolio-x', 'page-attributes' );
}

/*******************************
 * Load Scripts in Archive Page
 *******************************/
add_filter('template_include', 'qcld_qcpx_portfolio_set_single_template');

function qcld_qcpx_portfolio_set_single_template($template)
{
    if ( ( is_archive() && 'qcpx_portfolio' == get_post_type() ) || ( is_single() && 'qcpx_portfolio' == get_post_type() ) ) 
    {    
      $template = PORTFOLIO_THEMES_DIR . "/qcld-single-qcpx_portfolio.php";
    }

    return $template;
}


/**
 * Submenu filter function. Tested with Wordpress 4.1.1
 * Sort and order submenu positions to match your custom order.
 *
 * @author Hendrik Schuster <contact@deviantdev.com>
 */
function qcpx_order_index_catalog_menu_page( $menu_ord ) 
{

  global $submenu;

  // Enable the next line to see all menus and their orders
  //echo '<pre>'; print_r( $submenu ); echo '</pre>'; exit();

  // Enable the next line to see a specific menu and it's order positions
  //echo '<pre>'; print_r( $submenu['edit.php?post_type=qcpx_portfolio'] ); echo '</pre>'; exit();

  // Sort the menu according to your preferences
  //Original order was 5,11,12,13,14,15

  $arr = array();

  $arr[] = $submenu['edit.php?post_type=qcpx_portfolio'][5];
  $arr[] = $submenu['edit.php?post_type=qcpx_portfolio'][11];
  $arr[] = $submenu['edit.php?post_type=qcpx_portfolio'][12];
  $arr[] = $submenu['edit.php?post_type=qcpx_portfolio'][14];
  $arr[] = $submenu['edit.php?post_type=qcpx_portfolio'][15];
  $arr[] = $submenu['edit.php?post_type=qcpx_portfolio'][13];

  $submenu['edit.php?post_type=qcpx_portfolio'] = $arr;

  return $menu_ord;

}

// add the filter to wordpress
add_filter( 'custom_menu_order', 'qcpx_order_index_catalog_menu_page' );
