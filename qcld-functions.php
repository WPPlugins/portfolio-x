<?php

// Register Custom image size for portfolio plugin while uploading images

add_filter('image_size_names_choose', 'qc_portfolio_image_size');

function qc_portfolio_image_size($sizes)
{
    $addsizes = array(
        "qc-portfolio" => __("Portfolio Size"),
    );
    $newsizes = array_merge($sizes, $addsizes);
    return $newsizes;
}


add_filter('next_post_link', 'next_post_link_attributes');
add_filter('previous_post_link', 'post_link_attributes');

function post_link_attributes($output)
{
    $injection = 'class="prev"';
    return str_replace('<a href=', '<a ' . $injection . ' href=', $output);
}


function next_post_link_attributes($output)
{
    $injection = 'class="next"';
    return str_replace('<a href=', '<a ' . $injection . ' href=', $output);
}


add_action('wp_ajax_sort-posts', 'qcld_custom_sort_posts');

function qcld_custom_sort_posts()
{
    if (empty($_POST['action'])) {
        return;
    }

    $data = array_map('sanitize_text_field', $_POST['sort']);
    $messages = array();

    foreach ($data as $k => $v) {
        $id = ltrim($v, 'post-'); //Trim the "post-" prefix from the id
        $index = ($k + 1); //Make sure our sorting index starts at #1

        update_post_meta($id, '_custom_sort_post_order', $index);
    }

    exit();
}


//add_action('pre_get_posts', 'qcld_custom_sort_orderby');

function qcld_custom_sort_orderby($query)
{
    global $pagenow;

    if (!is_admin()) {
        return;
    } //If we're not in the backend, quit

    if (isset($_GET['post_type'])) //Make sure post type is set
    {
        //Make sure we're on the All Post Screen
        if ('edit.php' === $pagenow && 'portfolio-x' === $_GET['post_type']) {
            $query->set('meta_key', '_custom_sort_post_order');
            $query->set('orderby', 'meta_value');
            $query->set('order', 'ASC');
        }
    }
}


function qcld_custom_pagination($numpages = '', $pagerange = '', $paged = '')
{

    if (empty($pagerange)) {
        $pagerange = 2;
    }

    /**
     * This first part of our function is a fallback
     * for custom pagination inside a regular loop that
     * uses the global $paged and global $wp_query variables.
     *
     * It's good because we can now override default pagination
     * in our theme, and use this function in default quries
     * and custom queries.
     */
    
    //global $paged;

    if (empty($paged)) {
        $paged = 1;
    }

    if ($numpages == '') {
        global $wp_query;
        $numpages = $wp_query->max_num_pages;
        if (!$numpages) {
            $numpages = 1;
        }
    }

    /**
     * We construct the pagination arguments to enter into our paginate_links
     * function.
     */
    /*$pagination_args = array(
        'base'            => get_pagenum_link(1) . '%_%',
        'format'          => 'page/%#%',
        'total'           => $numpages,
        'current'         => $paged,
        'show_all'        => False,
        'end_size'        => 1,
        'mid_size'        => $pagerange,
        'prev_next'       => True,
        'prev_text'       => __('&laquo;'),
        'next_text'       => __('&raquo;'),
        'type'            => 'plain',
        'add_args'        => false,
        'add_fragment'    => ''
    );
    */

   //str_replace('%_%', 1 == $paged ? '' : "?page=%#%", "?page=%#%")

    $pagination_args = array(
        'base'               => str_replace('%_%', 1 == $paged ? '' : "?page=%#%", "?page=%#%"),
        'format'             => '?page=%#%',
        'total'              => $numpages,
        'current'            => $paged,
        'show_all'           => false,
        'end_size'           => 1,
        'mid_size'           => 2,
        'prev_next'          => true,
        'prev_text'          => __('&laquo;'),
        'next_text'          => __('&raquo;'),
        'type'               => 'plain',
        'add_args'           => false,
        'add_fragment'       => '',
        'before_page_number' => '',
        'after_page_number'  => ''
    );

    $paginate_links = paginate_links($pagination_args);

    if ($paginate_links) {
        echo "<nav class='custom-pagination'>";
        echo $paginate_links;
        echo "</nav>";
    }

}

//Get Portfolio Title and ID as Key => Value

global $_portfolio_kv_options;

add_action('init', 'get_portfolio_as_kv_pair');

function get_portfolio_as_kv_pair()
{
    global $_portfolio_kv_options;

    $values = array();

    global $wpdb;

    $portolios = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_type = 'qcpx_portfolio' AND post_status = 'publish'", ARRAY_A );

    if( $portolios ){

        foreach ( $portolios as $item ) {
            $values[$item['post_title']] = $item['ID'];
        }

    }

    $_portfolio_kv_options = $values;

}





