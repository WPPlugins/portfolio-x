<?php

/* Template For: QC Portfolio Single Page */

get_header(); 

?>

<?php

$short_description = get_post_meta(get_the_ID(), 'qc_portfolio_wysiwyg', true);
$portfoliourl = get_post_meta(get_the_ID(), 'qc_portfolio_url', true);
$projectDate = get_post_meta(get_the_ID(), 'qc_portfolio_project_date', true);
$projectGallery = get_post_meta(get_the_ID(), 'qc_portfolio_gallery_images', true);
$startDate = get_post_meta(get_the_ID(), 'qcld_start_date', true);
$endDate = get_post_meta(get_the_ID(), 'qcld_end_date', true);

?>

<!--Adding Template Specific Style -->

<link rel="stylesheet" type="text/css" href="<?php echo PORTFOLIO_URL . "/css/hover.css" ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo PORTFOLIO_URL . "/css/layout.css" ?>" />

<?php if (qcpx_get_option('qcpo_tpl1_color_scheme') == 2) { ?>

<link rel="stylesheet" type="text/css" href="<?php echo PORTFOLIO_URL . "/css/portfolio-style-dark.css" ?>" />

<?php }else{ ?>

<link rel="stylesheet" type="text/css" href="<?php echo PORTFOLIO_URL . "/css/portfolio-style-white.css" ?>" />

<?php } ?>


<div class="portfolio-single-container"
    <?php
    $qcpx_all_options=get_option('qcpx_plugin_options');
    if($qcpx_all_options['qcpx_details_page_width']=='single_box'){
        ?>
        style="max-width:<?php echo $qcpx_all_options['qcpx_details_page_width_val'] ;?>px;margin: 0 auto; "
        <?php
    }
    ?>

>

    <?php while (have_posts()) :the_post(); ?>

        <div class="portfolio-row">

            <div class="portfolio-single-col single-content-area">
                <div class="padding-content">
                    
                    <div class="portfolio-single-content">
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
                        <!--single-portfolio-header-->

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

                        <!--single-portfolio-footer-->

                    </div>
                    <!--portfolio-single-content-->

                </div>
                <!--padding-content-->

            </div>
            <!--portfolio-single-col-->
            <div class="portfolio-single-col single-image-area">
                <?php if (!empty($projectGallery)) { ?>
                    <?php foreach ($projectGallery as $gallery_image): ?>

                        <a class="fancy_single_image" rel="gallery" href="<?php echo $gallery_image ?>" data-lity>
                            <img class="hvr-grow-shadow" src="<?php echo $gallery_image ?>" alt="">
                        </a>

                    <?php endforeach; ?>
                <?php } else { ?>
                    <a class="fancy_single_image" rel="gallery" href="<?php echo PORTFOLIO_URL; ?>/images/no_images.jpg" data-lity>
                        <img width="150" height="150" class="attachment-thumbnail wp-post-image"
                         src="<?php echo PORTFOLIO_URL; ?>/images/no_images.jpg"/>
                    </a>
                <?php } ?>

            </div>
            <!--portfolio-single-col-->
            <div class="clear"></div>
        </div>
        <!--portfolio-row-->
        <div class="clear"></div>
    <?php endwhile; ?>
</div>

<!--portfolio-single-container-->

<?php get_footer(); ?>
