<?php

/*******************************
 * Admin Option : For Filtering
 *******************************/
add_action( 'restrict_manage_posts', 'qcld_portfolio_admin_posts_filter_restrict_manage_posts' );
/**
 * First create the dropdown
 * make sure to change POST_TYPE to the name of your custom post type
 * 
 * @author Ohad Raz
 * 
 * @return void
 */
function qcld_portfolio_admin_posts_filter_restrict_manage_posts(){
    $type = 'portfolio-x';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    //only add filter to post type you want
    if ('portfolio-x' == $type){

        global $_portfolio_kv_options;

        $values = $_portfolio_kv_options;

        ?>
        <select name="ADMIN_FILTER_FIELD_VALUE">
        <option value=""><?php _e('Filter By Portfolio', 'portfolio-x'); ?></option>
        <?php
            $current_v = isset($_GET['ADMIN_FILTER_FIELD_VALUE'])? $_GET['ADMIN_FILTER_FIELD_VALUE']:'';
            foreach ($values as $label => $value) {
                printf
                    (
                        '<option value="%s"%s>%s</option>',
                        $value,
                        $value == $current_v? ' selected="selected"':'',
                        $label
                    );
                }
        ?>
        </select>
        <?php
    }
}


add_filter( 'parse_query', 'qcld_admin_portfolio_posts_filter' );
/**
 * if submitted filter by post meta
 * 
 * make sure to change META_KEY to the actual meta key
 * and POST_TYPE to the name of your custom post type
 * @author Ohad Raz
 * @param  (wp_query object) $query
 * 
 * @return Void
 */
function qcld_admin_portfolio_posts_filter( $query ){
    global $pagenow;
    $type = 'portfolio-x';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }
    if ( 'portfolio-x' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != '') {
        $query->query_vars['meta_key'] = 'qc_portfolio_portfolio_assigned';
        $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_FIELD_VALUE'];
        $query->query_vars['meta_compare'] = 'LIKE';
    }
}