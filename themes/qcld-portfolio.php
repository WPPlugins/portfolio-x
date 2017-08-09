<?php
/*******************************
 * If post type is PORTFOLIO
 *******************************/

get_header();

?>

<?php

		//Portfolio Configs to Fill
        $conf['title'] = "";
        $conf['template'] = "";
        $conf['orderby'] = "";
        $conf['order'] = "";
        $conf['tpl_id'] = "";

        $calledFromTplPage = true;

        //Check if the supplied portfolio ID is Valid
        if ( have_posts() ) 
        {

            while ( have_posts() ) 
            {
                
                the_post();

                $meta = get_post_meta( get_the_ID() );
                
                //Portfolio Configs to Fill
                $conf['tpl_id'] = get_the_ID();
                $conf['title'] = get_the_title();
                $conf['template'] = get_post_meta( get_the_ID(), 'qc_port_settings_template', true );
                $conf['orderby'] = get_post_meta( get_the_ID(), 'qc_port_settings_orderby', true );
                $conf['order'] = get_post_meta( get_the_ID(), 'qc_port_settings_order', true );

            }

            /* Restore original Post Data */
            wp_reset_postdata();
        } 
        else 
        {
            _e("No valid portfolio was found according to your supplied portfolio ID.", "portfolio-x");
            return;
        }

        if( isset( $conf['orderby'] ) ){
            $orderby = $conf['orderby'];
        }

        if( isset( $conf['order'] ) ){
            $orderby = $conf['order'];
        }

        if( $conf['template'] != "" ){
            $theme = $conf['template'];
        }

        //Now Query and Get Portfolio Items


        $paged = (get_query_var('page')) ? get_query_var('page') : 1;

        $perPage = qcpx_get_option('qcld_post_per_page');

        $qVars = array(
            'orderby' => $orderby, 
            'order' => $order, 
            'post_type' => 'portfolio_item', 
            'posts_per_page' => $perPage, 
            'post_status' => 'publish', 
            'paged' => $paged,
            'meta_query' => array(
                array(
                    'key'     => 'qc_portfolio_portfolio_assigned',
                    'value'   => $conf['tpl_id'],
                    'compare' => 'LIKE',
                ),
            ),
        );
        
        $custom_query = new WP_Query( $qVars );

        require( PORTFOLIO_THEMES_DIR . "/" . $theme . "/qcld-portfolio-template.php" );

?>

<?php

get_footer();

?>