<!--Adding Template Specific Style -->

<?php

	wp_enqueue_style('qcld-tpl1-hover-css', PORTFOLIO_THEME_URL . "/" . $theme . "/css/hover.css");
	wp_enqueue_style('qcld-tpl1-layout-css', PORTFOLIO_THEME_URL . "/" . $theme . "/css/layout.css");
	
	if (qcpx_get_option('qcpo_tpl1_color_scheme') == 2) 
	{
		wp_enqueue_style('qcld-tpl1-style-dark-css', PORTFOLIO_THEME_URL . "/" . $theme . "/css/portfolio-style-dark.css");
	}
	else
	{
		wp_enqueue_style('qcld-tpl1-style-white-css', PORTFOLIO_THEME_URL . "/" . $theme . "/css/portfolio-style-white.css");
	}
	
?>

<!-- Customized CSS -->
<style>
    .portfolio-parallax-section img {
        box-shadow: 7px 9px 35px -2px <?php echo qcpx_get_option('qcpo_tpl1_img_shading_color'); ?>;
    }
	
	.portfolio-image-holder, .portfolio-image-holder img {
	    -moz-border-radius: <?php echo qcpx_get_option('qcpo_tpl1_qcld_img_border_radius'); ?>px;
		-webkit-border-radius: <?php echo qcpx_get_option('qcpo_tpl1_qcld_img_border_radius'); ?>px;
		border-radius: <?php echo qcpx_get_option('qcpo_tpl1_qcld_img_border_radius'); ?>px;
    }
</style>

<?php

$itemsPerPage = qcpx_get_option('qcld_post_per_page');

$counterStarter = 1;

if( $paged > 1 )
{
   $counterStarter = ( $paged - 1 ) * $itemsPerPage + 1;
}

$target_open = 'popup-window';
$target_open = qcpx_get_option('qc_single_open_opt');

$link_title = 'off';
$link_title = qcpx_get_option('qcld_link_title');

$numberOfPostsInLoop = $custom_query->post_count;
$isEven = ($numberOfPostsInLoop % 2 == 0);
//To handle width of portfolio list nav width
$qcpx_all_options=get_option('qcpx_plugin_options');
if($qcpx_all_options['qcld_template_links']=='on' && $qcpx_all_options['qcpx_list_page_width']=='list_box'){
    $list_width_style='style="text-align:center;max-width:'.$qcpx_all_options['qcpx_list_page_width_val'].'px;margin: 0 auto;"';
} else{
    $list_width_style="";
}
?>

<div class="portfolio-container portfolio-tpl-01" <?php echo $list_width_style; ?> id="portfolio-container">
    
    <div class="portfolio-row portfolio-filter-row">
        <ul class="qc_filter qc_group">
            <?php 

                if( qcpx_get_option('qcld_template_links') == 'on' )
                {
                    qcld_portfolio_list_portfolios();
                }

            ?>
        </ul>
    </div>

    <!-- portfolio-row -->

    <?php
    $i = 1;
    $j = 1;

    global $post;

    $currentLoopCount = 1;
    $rowCount = 0;

    while( $custom_query->have_posts() ) {

        $custom_query->the_post();

        $appendedClass = "";

        if( $isEven == false && $currentLoopCount == $numberOfPostsInLoop ){
          $appendedClass = "hasOnlySingleItem";  
        }
                
        $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "Portfolio Size");

        $portfoliourl = get_post_meta($post->ID, 'qc_portfolio_url', true); 

        $fullImgUrl = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full");
        
    ?>

        <?php 
            $ptop = '180px';
            $pclass = "";
            if( $currentLoopCount == 1 ){
                $ptop = '120px';
                $pclass = "pfirst-item";
            }
        ?>

        <?php if ($rowCount == 0) { ?>

            <div class="mix portfolio-row">

            <div class="portfolio-parallax-section parallax-section-01 <?php echo $appendedClass .' ' . $pclass; ?>" <?php if ($rowCount == 0) {
                echo 'style="top: '.$ptop.';"';
            } ?> >

            <?php
        }
        ?>

        <div class="portfolio-parallax-number-layout-0<?php echo $rowCount + 1; ?> portfolio-parallax-number parallax-element"
            data-bottom-top="transform[customEase]:translateY(30px)"
            data-top-bottom="transform[customEase]:translateY(-100px)">
            <?php if( qcpx_get_option('qcpo_tpl1_serial_number') == 'on' ) : ?>
            <div>
                <h1>
                    <?php 
                        echo sprintf("%02d", $counterStarter); 
                    ?>
                </h1>
            </div>
            <?php endif; ?>
        </div>
        <!-- portfolio-parallax-number-->
        <div
            class="portfolio-parallax-text-holder portfolio-parallax-text-holder-layout-0<?php echo $rowCount + 1; ?> parallax-element parallax-text-holder"
            data-bottom-top="transform[customEase]:translateY(30px)"
            data-top-bottom="transform[customEase]:translateY(-100px)">

            <?php if( $link_title == 'on' ) : ?>

                <?php if( $target_open == 'separate-page' ) : ?>
                    <a class="qcld_box" href="<?php echo get_permalink(); ?>">
                        <h3>
                            <?php the_title(); ?>
                        </h3>
                    </a>
                <?php else : ?>
                   <a class="qcld_box" href="#inline-<?php echo $post->ID; ?>">
                        <h3>
                            <?php the_title(); ?>
                        </h3>
                    </a> 
                <?php endif; ?>

            <?php else: ?>
                <h3>
                    <?php the_title(); ?>
                </h3>
            <?php endif; ?>

            <p>
                <?php $short_description = get_post_meta( get_the_ID(), 'qc_portfolio_wysiwyg', true);
                echo $short_description;
                ?>
            </p>

            <?php 
                $disp_stat = get_post_meta( get_the_ID(), 'qc_portfolio_disp_url', true);
                $url = get_post_meta( get_the_ID(), 'qc_portfolio_url', true);
            ?>
            <?php if( $disp_stat == 'on' ) : ?>
            <p>
                <a href="<?php echo $url; ?>" target="_blank">
                    <strong>
                        <?php _e('Visit Website', 'portfolio-x'); ?>
                    </strong>
                </a>
            </p>
            <?php endif; ?>

        </div>
        <!-- parallax-text-holder-->
        <div class="portfolio-image-holder portfolio-image-holder-layout-0<?php echo $rowCount + 1; ?> parallax-element parallax-img-holder portfolio-fire-hover"
            data-bottom-top="transform[customEase]:translateY(30px)"
            data-top-bottom="transform[customEase]:translateY(-150px)">


            <?php echo get_the_post_thumbnail($post->ID, 'qc-portfolio', array('class' => 'portfolio_img')); ?>

            <!--new hover effect-->
            <div class="qc-grid-hover-effect">
                <div class="qc-grid-hover-effect-button">
                    <div class="qc-grid-hover-effect-button-area">
                        <a class="first-anchor" href="<?php echo $fullImgUrl[0]; ?>" data-lity title="<?php _e('Zoom Image'); ?>">
                            <i class="fa fa-search"></i>
                        </a>

                        <?php if( isset($portfoliourl) && $portfoliourl != "" ) : ?>
                            <a class="second-anchor" href="<?php echo $portfoliourl; ?>" target="_blank" title="Visit Link"><i class="fa fa-link"></i></a>
                        <?php endif; ?>
                        
                        <?php if( $target_open == 'separate-page' ) : ?>
                            <a class="third-anchor" href="<?php echo get_permalink(); ?>" title="<?php _e('View Details'); ?>">
                                <i class="fa fa-plus-circle"></i>
                            </a>
                        <?php else : ?>
                            <a class="third-anchor" class="qcld_box" href="#inline-<?php echo $post->ID; ?>" title="<?php _e('View Details'); ?>">
                                <i class="fa fa-plus-circle"></i>
                            </a> 
                        <?php endif; ?>

                    </div>
                    <!--/qc-circle-grid-button-area-->
                </div>
            </div>
            <!--/new hover effect-->


            <div style="display: none;">

                <div class="inside-popup-details" id="inline-<?php echo $post->ID; ?>">
                    <?php

                    $short_description = get_post_meta(get_the_ID(), 'qc_portfolio_wysiwyg', true);
                    $portfoliourl = get_post_meta(get_the_ID(), 'qc_portfolio_url', true);
                    $techUsed = get_post_meta(get_the_ID(), 'qc_portfolio_technology', true);
                    $projectDate = get_post_meta(get_the_ID(), 'qc_portfolio_project_date', true);
                    $projectGallery = get_post_meta(get_the_ID(), 'qc_portfolio_gallery_images', true);
                    $startDate = get_post_meta(get_the_ID(), 'qcld_start_date', true);
                    $endDate = get_post_meta(get_the_ID(), 'qcld_end_date', true);
                    ?>


                    <div class="portfolio-single-container portfolio-fancy-container">
                        <div class="portfolio-row">

                            <div class="portfolio-single-col single-content-area">
                                <div class="padding-content">
                                    <div class="portfolio-single-content fancy-fixed-content">
                                        <div class="single-portfolio-header">

                                            <h2 class="single-portfolio-title">
                                                <?php the_title(); ?> 
                                            </h2>

                                            <div>
                                                <?php the_content(); ?>
                                            </div>

                                            <br>
                                            
                                            <p>
                                                <strong>Project Date</strong>
                                            </p>

                                            <?php if (!empty($startDate)){ ?>
                                               <p>
                                                   <?php 
                                                        _e("Start Date: ", 'portfilio-x'); 
                                                    ?>
                                                   <?php echo gmdate('Y-m-d', $startDate); ?>
                                               </p>
                                            <?php } ?>
                                            <?php if (!empty($endDate)){ ?>
                                                <p>
                                                    <?php 
                                                        _e("End Date: ", 'portfilio-x'); 
                                                    ?>
                                                    <?php echo gmdate('Y-m-d', $endDate); ?>
                                                </p>

                                                <br>

                                            <?php } ?>

                                            <div class="web-link">
                                                <a target="_blank" href="<?php echo $portfoliourl; ?>">
                                                    <?php 
                                                        _e("Visit Website", 'portfilio-x'); 
                                                    ?>

                                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <!--web-link-->

                                        </div>
                                        <!--/single-portfolio-header-->

                                        <div class="single-portfolio-footer">
                                            <?php
                                                $types = get_the_terms( get_the_ID(), 'portfolio_type' );
                                                $total = count( $types );
                                                $serial = 1;

                                                if( $types && $total > 0 ){

                                            ?>

                                                <div class="category">
                                                    <p>
                                                    <strong>
                                                    <?php 
                                                        _e("Types: ", 'portfilio-x'); 
                                                    ?>
                                                    </strong>
                                                    <?php
                                                        
                                                        

                                                            foreach( $types as $type )
                                                            {
                                                                echo $type->name;
                                                                if( $serial != $total ){
                                                                    echo ", ";
                                                                }
                                                                $serial++;

                                                            }

                                                    ?>

                                                    </p>
                                                </div>

                                            <?php } ?>

                                            <?php 
                                                $techs = get_the_terms( get_the_ID(), 'portfolio_technology' );
                                                $total = count( $techs );
                                                $serial = 1;

                                                if( $techs && $total > 0 ){
                                            ?>
                                                    
                                                    <div class="category">
                                                        
                                                        <strong>
                                                        <?php 
                                                            _e("Technology Used: ", 'portfilio-x'); 
                                                        ?>
                                                        </strong>
                                                        <?php
                                                            
                                                            foreach( $techs as $tech )
                                                            {
                                                                echo $tech->name;
                                                                if( $serial != $total ){
                                                                    echo ", ";
                                                                }
                                                                $serial++;

                                                            }

                                                        ?>

                                                    </div>

                                            <?php } ?>

                                            <div class="portfolio-projects-nav">
                                                <?php previous_post_link('%link', '<div class="icon">
                                                        <i class="fa fa-arrow-left"></i>
                                                        <span>prev</span>' . _x('', 'Previous post link', '') . '</div>'); ?>

                                                <?php next_post_link('%link', '<div class="icon">
                                                        <i class="fa fa-arrow-right"></i>
                                                        <span>next</span>' . _x('', 'Next post link', '') . '</div>'); ?>
                                            </div>
                                            <!--portfolio-projects-nav-->
                                        </div>
                                        <!--/single-portfolio-footer-->

                                        <div class="clear"></div>
                                    </div>
                                    <!--portfolio-single-content-->
                                </div>
                                <!--padding-content-->
                                <div class="clear"></div>
                            </div>
                            <!--portfolio-single-col-->
                            <div class="portfolio-single-col single-image-area">
                                <div class="single-image-container">
                                    <?php if (!empty($projectGallery)) { ?>

                                        <?php foreach ($projectGallery as $gallery_image): ?>


                                            <a class="single_image" rel="gallery-<?php echo $post->ID; ?>" href="<?php echo $gallery_image ?>">
                                                <img class="hvr-grow-shadow" src="<?php echo $gallery_image ?>" alt="">
                                            </a>


                                        <?php endforeach; ?>

                                    <?php } else { ?>

                                        <img width="150" height="150" class="attachment-thumbnail wp-post-image"
                                             src="<?php echo PORTFOLIO_URL; ?>/images/no_images.jpg"/>
                                             
                                    <?php } ?>

                                </div>


                            </div>
                            <!--portfolio-single-col-->
                            <div class="clear"></div>
                        </div>
                        <!--portfolio-row-->
                        <div class="clear"></div>

                    </div>
                    <!--                    portfolio-single-container-->
                </div>
            </div>

        </div>
        <!--            parallax-img-holder-->

        <?php
        if ($rowCount == 1) {
            ?>
            </div>
            <!--portfolio-parallax-section-->
            <div class="clear"></div>
            </div>
            <!--portfolio-row-->
            <div class="clear"></div>
            <?php
        }

        if( ($isEven == false && $currentLoopCount == $numberOfPostsInLoop) ){
            echo '</div>
            <!--/portfolio-parallax-section-->
            <div class="clear"></div>
            </div>
            <!--/portfolio-row-->
            <div class="clear"></div></div>';
        }

        $rowCount++;
        $currentLoopCount++;
        $counterStarter++;

        if ($rowCount == 2) {
            $rowCount = 0;
        }

        ?>

        <?php
    }
    ?>

    <div class="portfolio-row portfolio-pagination">
        <?php

            $maxNumPage = $custom_query->max_num_pages;

            qcld_custom_pagination( $maxNumPage, "", $paged );

        ?>
    </div>
</div>
<!--end portfolio-container-->
<!---->

