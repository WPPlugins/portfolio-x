<!--Adding Template Specific Style -->

<link rel="stylesheet" href="<?php echo PORTFOLIO_THEME_URL . "/" . $theme . "/css/layout-catalog.css"; ?>">
<script src="<?php echo PORTFOLIO_THEME_URL . "/" . $theme . "/js/script.js"; ?>"></script>

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
                h1.qc-portfolio-x-title, .qc-portfolio-x-extend-info p:first-child, .qc-portfolio-x-extend-info p:last-child, .qc-portfolio-x-info, .qc-portfolio-x-info p{
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
                        h1.qc-portfolio-x-title, .qc-portfolio-x-extend-info p:first-child, .qc-portfolio-x-extend-info p:last-child, .qc-portfolio-x-info, .qc-portfolio-x-info p{
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
    .qc-portfolio-x-title-area a h1 {
        color: <?php echo qcpx_get_option('qcpo_tpl4_title_color'); ?>;
    }

    .qc-portfolio-x-item-inner:hover .qc-portfolio-x-title-area a h1, .qc-portfolio-x-title-area:hover a h1, .qc-portfolio-x-title-area a:hover h1 {
        color: <?php echo qcpx_get_option('qcpo_tpl4_title_color_hover'); ?>;
    }

    .qc-portfolio-x-title-area {
      background-color: <?php echo qcpx_get_option('qcpo_tpl4_title_bg_color'); ?>;
    }

    .qc-portfolio-x-item-inner:hover .qc-portfolio-x-title-area {
      background-color: <?php echo qcpx_get_option('qcpo_tpl4_title_bg_color_hover'); ?>;
    }

    .qc-portfolio-x-extend-info p:first-child {
      color: <?php echo qcpx_get_option('qcpo_tpl4_popup_txt1_color'); ?>;
    }

    .qc-portfolio-x-extend-info p:last-child {
      color: <?php echo qcpx_get_option('qcpo_tpl4_popup_txt2_color'); ?>;
    }

    .qc-portfolio-x-title {
      font-size: <?php echo qcpx_get_option('qcpo_tpl4_title_font_si'); ?>px !important;
    }

    .qc-portfolio-x-description {
      font-size: <?php echo qcpx_get_option('qcpo_tpl4_des_font_si'); ?>px !important;
    }

    .qc-portfolio-x-extend-info p {
      font-size: <?php echo qcpx_get_option('qcpo_tpl4_date_font_si'); ?>px !important;
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
<div class="portfolio-row portfolio-filter-row" <?php echo $list_width_style; ?> >
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

<!-- Template Markup --> 
<!-- qcpx_tpl_04 -->  
<div class="qcpx_tpl_04">
    
    <div class="qc-portfolio-x-container" <?php echo $list_width_style; ?> >
        
        <ul class="qc-portfolio-x-listing">
            
            <?php 
                //while-loop start
                while( $custom_query->have_posts() ) {

                $randomNum = substr(sha1(mt_rand() . microtime()), mt_rand(0,35), 5);

                $custom_query->the_post();
            ?>

            <li class="qc-portfolio-x-item">

                <div class="qc-portfolio-x-item-inner">
                    <div class="qc-portfolio-x-title-area">
                        <?php if( $target_open == 'separate-page' ) : ?>
                        <a class="qcld_box" href="<?php echo get_permalink(); ?>">
                        <?php else : ?>
                        <a class="qcld_box load-content-inlb" data-pid="<?php echo get_the_ID(); ?>" href="#inline-<?php echo get_the_ID(); ?>-<?php echo $randomNum; ?>" data-rand="<?php echo $randomNum; ?>">
                        <?php endif; ?>
                            <h1 class="qc-portfolio-x-title">
                                <?php the_title(); ?>
                            </h1>
                        </a>
                    </div>
                    <!--qc-portfolio-x-title-area-->

                    <div class="qc-portfolio-x-img">
                        <?php if( $target_open == 'separate-page' ) : ?>
                        <a class="qcld_box" href="<?php echo get_permalink(); ?>">
                        <?php else : ?>
                        <a class="qcld_box load-content-inlb" data-pid="<?php echo get_the_ID(); ?>" href="#inline-<?php echo get_the_ID(); ?>-<?php echo $randomNum; ?>" data-rand="<?php echo $randomNum; ?>">
                        <?php endif; ?>
                            <?php 
                                echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'portfolio_img')); 
                            ?>
                        </a>
                    </div>

                    <!--qc-portfolio-img-->
                    <div class="qc-portfolio-x-info">

                        <p class="qc-portfolio-x-description">
                            <?php 
                                echo $short_description = get_post_meta(get_the_ID(), 'qc_portfolio_wysiwyg', true); 
                            ?>
                        </p>
                    </div>
                    <!--qc-portfolio-info-->

                    <div class="qc-portfolio-x-extend-info">
                        <?php 
                            $startDate = get_post_meta(get_the_ID(), 'qcld_start_date', true);
                            $endDate = get_post_meta(get_the_ID(), 'qcld_end_date', true);
                        ?>
                        <p>
                            <?php echo get_the_title(); ?>
                        </p>
                        <hr>
                        <p>
                            <?php 

                                $techs = get_the_terms( get_the_ID(), 'portfolio_technology' );
                                $total = count( $techs );
                                $serial = 1;

                                if( $techs && $total > 0 ){
                                
                                    echo '<span class="info-techs">';

                                    foreach( $techs as $tech )
                                    {
                                        echo $tech->name;
                                        if( $serial != $total ){
                                            echo " / ";
                                        }
                                        $serial++;

                                    }

                                    echo '</span>';
                                }

                            ?>
                        </p>
                    </div>
                    <!--qc-portfolio-extend-info-->

                </div>
                <!--qc-portfolio-item-inner-->

                <!--lightbox-content-->
                <!-- #dump-content -->
                <div style="display: none;">
                   <!-- Contents Will be dumpped here --> 
                   <div class="inside-popup-details" id="inline-<?php echo get_the_ID(); ?>-<?php echo $randomNum; ?>">
                        <div id="dump-content-<?php echo get_the_ID(); ?>-<?php echo $randomNum; ?>">
                           
                       </div>
                   </div>
                </div>
                <!-- /#dump-content -->
                <!--/lightbox-content-->

            </li>
            <!-- /qc-portfolio-x-item -->

            <?php } //End of While Loop ?>

        </ul>
        <!-- /qc-portfolio-x-listing -->

        <div class="portfolio-row portfolio-pagination">
            <?php

                $maxNumPage = $custom_query->max_num_pages;

                qcld_custom_pagination( $maxNumPage, "", $paged );

            ?>
        </div>
        
        <div class="clear"></div>

    </div>
    <!--/qc-portfolio-x-container-->

</div>
<!-- /qcpx_tpl_04 -->

