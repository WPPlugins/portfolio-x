<!--Adding Template Specific Style -->

<?php

	wp_enqueue_style( 'qcld-tpl9-layout-catalog-css', PORTFOLIO_THEME_URL . "/" . $theme . "/css/layout-catalog.css" );

?>

<!-- Font Settings -->
<?php
 
    $google_font = qcpx_get_option('qcpx_use_pre_google_font');
    $custom_google_font = qcpx_get_option('qcpx_use_custom_google_font');
    $theme_font = qcpx_get_option('qcpx_use_theme_font');

    if( isset($theme_font) && $theme_font != 'on' )
    {
        if( isset($custom_google_font) && $custom_google_font != '' )
        {
            
            $qcpxgetfamily = explode('family=', $custom_google_font);

            $qcpxfamily = $qcpxgetfamily[1];

            ?>

            <link href="https://fonts.googleapis.com/css?family=<?php echo str_replace(" ", "+", $qcpxfamily); ?>" rel="stylesheet">

            <style type="text/css">
                .qc-paper-portfolio-extend-info p:first-child, .qc-paper-portfolio-extend-info p:last-child{
                    font-family: '<?php echo $qcpxfamily; ?>' !important;
                }
            </style>

            <?php
        }
        else
        {
            if( isset($google_font) && $google_font != '' )
            {
                ?>
                    <link href="https://fonts.googleapis.com/css?family=<?php echo str_replace(" ", "+", $google_font); ?>" rel="stylesheet">

                    <style type="text/css">
                        .qc-paper-portfolio-extend-info p:first-child, .qc-paper-portfolio-extend-info p:last-child{
                            font-family: '<?php echo $google_font; ?>' !important;
                        }
                    </style>
                <?php
            }
        }
    }

?>
<!-- End of Font Settings -->

<!-- Customized CSS -->
<style>
    .portfolio-container::after, .qc-portfolio-row::before{
        background-color: <?php echo qcpx_get_option('qcpo_tpl9_bar_color'); ?>;
    }

    .qc-portfolio-item::before {
      border: 1px solid <?php echo qcpx_get_option('qcpo_tpl9_bar_color'); ?>;
    }

</style>

<?php

$itemsPerPage = qcpx_get_option('qcld_post_per_page');

$target_open = 'popup-window';
$target_open = qcpx_get_option('qc_single_open_opt');

$link_title = false;
$link_title = qcpx_get_option('qcld_link_title');
//To handle width of portfolio list nav width
$qcpx_all_options=get_option('qcpx_plugin_options');
if($qcpx_all_options['qcld_template_links']=='on' && $qcpx_all_options['qcpx_list_page_width']=='list_box'){
    $list_width_style='style="text-align:center;max-width:'.$qcpx_all_options['qcpx_list_page_width_val'].'px;margin: 0 auto;"';
} else{
    $list_width_style="";
}

?>

<!-- filter-row -->
<div class="portfolio-row portfolio-filter-row" <?php echo $list_width_style; ?>>
    <ul class="qc_filter qc_group">
        <?php 

            if( qcpx_get_option('qcld_template_links') == 'on' )
            {
                qcld_portfolio_list_portfolios();
            }

        ?>
    </ul>
</div>
<!-- /filter-row -->


<div class="portfolio-container portfolio-tpl9-container" <?php echo $list_width_style; ?>>

    <?php 
        //while-loop start
        while( $custom_query->have_posts() ) {

        $randomNum = substr(sha1(mt_rand() . microtime()), mt_rand(0,35), 5);

        $custom_query->the_post();

        $portfoliourl = get_post_meta(get_the_ID(), 'qc_portfolio_url', true); 

        $fullImgUrl = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "full");

    ?>

    <div class="qc-portfolio-row">
        <div class="qc-portfolio-item portfolio-fire-hover">
            <div class="qc-portfolio-item-box qc-portfolio-image-box">

                <div class="qc-portfolio-img">

                    <?php 
                        echo get_the_post_thumbnail(get_the_ID(), 'tpl9-thumb', array('class' => 'portfolio_img')); 
                    ?>

                    <!--new hover effect-->
                    <div class="qc-grid-hover-effect">
                        <div class="qc-grid-hover-effect-button">
                            <div class="qc-grid-hover-effect-button-area">
                                
                                <a class="first-anchor" href="<?php echo $fullImgUrl[0]; ?>" data-lity title="<?php _e('Zoom Image'); ?>">
                                    <i class="fa fa-search"></i>
                                </a>

                                <?php if( isset($portfoliourl) && $portfoliourl != "" ) : ?>
                                    <a class="second-anchor" href="<?php echo $portfoliourl; ?>" target="_blank" title="Visit Link">
                                        <i class="fa fa-link"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if( $target_open == 'separate-page' ) : ?>
                                    <a class="third-anchor" href="<?php echo get_permalink(); ?>" title="<?php _e('View Details'); ?>">
                                        <i class="fa fa-plus-circle"></i>
                                    </a>
                                <?php else : ?>
                                    <a class="third-anchor" class="qcld_box" href="#inline-<?php echo get_the_ID(); ?>" title="<?php _e('View Details'); ?>">
                                        <i class="fa fa-plus-circle"></i>
                                    </a> 
                                <?php endif; ?>

                            </div>
                            <!--/qc-circle-grid-button-area-->
                        </div>
                    </div>
                    <!--/new hover effect-->

                </div>
                <!--qc-portfolio-img-->

            </div>
            <!--qc-portfolio-item-box-->
            <div class="qc-portfolio-item-box qc-portfolio-content-box">
                <div class="qc-portfolio-content">
                    <h1>
                    <?php if( $target_open == 'separate-page' ) : ?>
                        <a class="qcld_box" href="<?php echo get_permalink(); ?>">
                    <?php else : ?>
                        <a class="qcld_box load-content-inlb" data-pid="<?php echo get_the_ID(); ?>" href="#inline-<?php echo get_the_ID(); ?>-<?php echo $randomNum; ?>" data-rand="<?php echo $randomNum; ?>">
                    <?php endif; ?>

                    <?php echo get_the_title(); ?>
                  </a>
                   </h1>

                    <div class="p9-sp-content">
                        <?php the_excerpt(); ?>
                    </div>

                </div>
                <!--qc-portfolio-img-->

            </div>
            <!--qc-portfolio-item-box-->
            <div class="clear"></div>
        </div>
        <!--qc-portfolio-item-->

        <!-- #dump-content -->
        <div style="display: none;">
           <!-- Contents Will be dumpped here --> 
           <div class="inside-popup-details" id="inline-<?php echo get_the_ID(); ?>-<?php echo $randomNum; ?>">
               <div id="dump-content-<?php echo get_the_ID(); ?>-<?php echo $randomNum; ?>">
                   
               </div>
           </div>
        </div>
        <!-- /#dump-content -->

    </div>
    <!--qc-portfolio-row-->


    <?php } //end while ?> 

</div> 
<!--end portfolio-container-->

<div>
    <div class="portfolio-row portfolio-pagination">
        <?php

            $maxNumPage = $custom_query->max_num_pages;

            qcld_custom_pagination( $maxNumPage, "", $paged );

        ?>
    </div>
    
    <div class="clear"></div>
</div>

<script>
   

</script>