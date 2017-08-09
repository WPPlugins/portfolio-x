<?php

//Register ShortCode
add_shortcode('portfolio-x', 'qcld_portfolio_get_all');

//Get All portfolio
function qcld_portfolio_get_all( $atts = array() )
{
    
    ob_start();

    qcld_show_all_portfolio( $atts );

    $content = ob_get_clean();

    return $content;

}

function qcld_show_all_portfolio( $atts = array() )
{

    //Defaults & Set Parameters
    extract( shortcode_atts(
        array(
            'orderby' => '',
            'order' => '',
            'template' => 'default',
            'limit' => '',
            'portfolio' => '',
            'theme' => 'template-01',
            'theme_style' => '',
        ), $atts
    ));

    //If there is a Portfolio ID supplied with SC
    if( $portfolio != "" )
    {

        //Query & Get Portfolio Settings First
        $args = array(
            'post_type' => 'qcpx_portfolio',
            'p' => (int)$portfolio,
        );

        $portfolio = new WP_Query( $args );

        //Portfolio Configs to Fill
        $conf['title'] = "";
        $conf['template'] = "";
        $conf['orderby'] = "";
        $conf['order'] = "";
        $conf['tpl_id'] = "";

        //Check if the supplied portfolio ID is Valid
        if ( $portfolio->have_posts() ) 
        {

            while ( $portfolio->have_posts() ) 
            {
                
                $portfolio->the_post();

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

        if( $orderby == "" ){
            $orderby = $conf['orderby'];
        }

        if( $orderby == "" ){
            $orderby = $conf['order'];
        }

        if( $conf['template'] != "" ){
            $theme = $conf['template'];
        }

        if( $theme_style != "" && $theme_style != "default" ){
            $theme = $theme_style;
        }

        //Now Query and Get Portfolio Items

        $paged = (get_query_var('page')) ? get_query_var('page') : 1;

        $perPage = qcpx_get_option('qcld_post_per_page');

        if( $limit != '' ){
            $perPage = $limit;
        }

        $qVars = array(
            'orderby' => $orderby, 
            'order' => $order, 
            'post_type' => 'portfolio-x', 
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

    }
    else
    {
        _e("Invalid Portfolio ID. Please provide a correct Portfolio ID.", 'portfolio-x');
    }


} // end of qcld_show_all_portfolio