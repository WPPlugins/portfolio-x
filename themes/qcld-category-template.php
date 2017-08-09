<?php get_header(); ?>

<div class="portfolio-container" id="portfolio-container">

    <ul class="qc_filter qc_group">

        <?php qcld_portfolio_list_categories(); ?>

    </ul>
    <div class="portfolio-container" id="portfolio-container">
        <!--portfolio-row -->

        <?php

        $i = 1;
        $j = 1;
        $serial = 1;
        $rowCount = 0;

        global $paged, $posts;

        $numberOfPostsInLoop = count($posts);
        $isEven = ($numberOfPostsInLoop % 2 == 0);
        
        $itemsPerPage = qcpx_get_option('qcld_post_per_page');

        $counterStarter = 1;

        if( $paged > 1 )
        {
           $counterStarter = ( $paged - 1 ) * $itemsPerPage + 1;
        }

        $target_open = 'popup-window';
        $target_open = qcpx_get_option('qc_single_open_opt');

        $link_title = false;
        $link_title = qcpx_get_option('qcld_link_title');

        if (have_posts()) {

            while (have_posts()) {

                the_post(); 

                ?>

                <?php 
                    $imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "Portfolio Size");

                    $portfoliourl = get_post_meta($post->ID, '_qc_portfoliourl', true); 
                ?>

                <?php 

                    $terms = get_the_terms($post->ID, 'portfolio_category');


                        $classes = "";

                        foreach ($terms as $item) {
                            $classes .= $item->slug . " ";
                        }
                
                $appendedClass = "";

                if( $isEven == false && $serial == $numberOfPostsInLoop ){
                  $appendedClass = "hasOnlySingleItem";  
                }

                ?>

                <?php if ($rowCount == 0) { ?>
                    <div class="<?php echo $classes; ?> portfolio-row">


                    <div class="portfolio-parallax-section parallax-section-01 <?php echo $appendedClass; ?>" <?php if ($rowCount == 0) {
                        echo 'style="top: 180px;"';
                    } ?> >
                    <?php
                }
                ?>

                <div class="portfolio-parallax-number-layout-0<?php echo $rowCount + 1; ?> portfolio-parallax-number parallax-element"
                    data-bottom-top="transform[customEase]:translateY(30px)"
                    data-top-bottom="transform[customEase]:translateY(-100px)">
                    <div>
                        <?php 
                            echo sprintf("%02d", $counterStarter); 
                        ?>
                    </div>
                </div>
                <!-- portfolio-parallax-number-->
                <div class="portfolio-parallax-text-holder portfolio-parallax-text-holder-layout-0<?php echo $rowCount + 1; ?> parallax-element parallax-text-holder"
                    data-bottom-top="transform[customEase]:translateY(30px)"
                    data-top-bottom="transform[customEase]:translateY(-100px)">
                    <?php if( $link_title ) : ?>

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
                        <?php $short_description = get_post_meta(get_the_ID(), 'qc_portfolio_wysiwyg', true);
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
                <!-- parallax-text-holder -->
                <div class="portfolio-image-holder portfolio-image-holder-layout-0<?php echo $rowCount + 1; ?> parallax-element parallax-img-holder"
                    data-bottom-top="transform[customEase]:translateY(30px)"
                    data-top-bottom="transform[customEase]:translateY(-150px)">
                    <?php echo get_the_post_thumbnail($post->ID, 'qc-portfolio', array('class' => 'portfolio_img')); ?>

                    <div class="hover-effect1">
                        
                        <?php if( $target_open == 'separate-page' ) : ?>
                            <a class="qcld_box" href="<?php echo get_permalink(); ?>">
                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                            </a>
                        <?php else : ?>
                           <a class="qcld_box" href="#inline-<?php echo $post->ID; ?>">
                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                            </a> 
                        <?php endif; ?>
                    </div>
                    <!--hover-effect1-->
                    <div class="inside-popup-details" style="display: none;">
                        <div id="inline-<?php echo $post->ID; ?>">
                            <?php

                            $short_description = get_post_meta(get_the_ID(), 'qc_portfolio_wysiwyg', true);
                            $portfoliourl = get_post_meta(get_the_ID(), 'qc_portfolio_url', true);
                            $techUsed = get_post_meta(get_the_ID(), 'qc_portfolio_technology', true);
                            $projectDate = get_post_meta(get_the_ID(), 'qc_portfolio_project_date', true);
                            $projectGallery = get_post_meta(get_the_ID(), 'qc_portfolio_gallery_images', true);
                            ?>


                            <div class="portfolio-single-container portfolio-fancy-container">
                                <div class="portfolio-row">

                                    <div class="portfolio-single-col single-content-area">
                                        <div class="padding-content">
                                            <div class="portfolio-single-content">
                                                <div class="single-portfolio-header">
                                                    <h2 class="single-portfolio-title"><?php the_title(); ?> </h2>
                                                    <div class="category">
                                                        <ul>
                                                            <li><?php echo $techUsed; ?></li>
                                                        </ul>
                                                    </div>

                                                    <div class="single-portfolio-description">
                                                        <p><?php echo $short_description; ?></p>
                                                    </div>
                                                    <div class="web-link">
                                                        <a target="_blank" href="">visit website <i
                                                                class="fa fa-arrow-right"
                                                                aria-hidden="true"></i></a>
                                                    </div>
                                                    <!--web-link-->
                                                </div>
                                                <!--single-portfolio-header-->
                                                <div class="single-portfolio-footer">
                                                    <h3> Filed under</h3>
                                                    <div class="category">
                                                        <?php $terms = wp_get_object_terms($post->ID, 'portfolio_category'); ?>
                                                        <ul>
                                                            <li><?php foreach ($terms as $val) {
                                                                    echo $val->name . '&nbsp;';
                                                                } ?></li>
                                                        </ul>
                                                    </div>

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


                                                <a class="single_image" rel="gallery"
                                                   href="<?php echo $gallery_image ?>">
                                                   <img class="hvr-grow-shadow" src="<?php echo $gallery_image ?>" alt="">
                                                </a>


                                            <?php endforeach; ?>
                                        <?php } else { ?>
                                            <img width="150" height="150" class="attachment-thumbnail wp-post-image"
                                                 src="<?php echo PORTFOLIO_URL; ?>/images/no_images.jpg"/>
                                        <?php } ?>

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
                    <!--                    popup-container-->
                </div>
                <!--            parallax-img-holder-->
                <?php
                if ($rowCount == 1) {
                    ?>
                    </div>
                    <!--            portfolio-parallax-section-->
                    <div class="clear"></div>
                    </div>
                    <!--            portfolio-row-->
                    <div class="clear"></div>
                    <?php
                }

                if( $isEven == false && $serial == $numberOfPostsInLoop ){
                    echo '</div>';
                }

                $rowCount++;
                $serial++;
                $counterStarter++;

                if ($rowCount == 2) {
                    $rowCount = 0;
                }

                ?>
            <?php } // end while
        } // end if
        ?>


        <div class="portfolio-row portfolio-pagination">
            <?php

                global $paged;

                qcld_custom_pagination($wp_query->max_num_pages, "", $paged); 

            ?>
        </div>
    </div>
</div>


<script>
    jQuery(document).ready(function () {
        var category_name = '<?php single_cat_title();?>';
        jQuery('li[data-value]').each(function () {
            var data_value = jQuery(this).data("value");
            if (data_value == category_name) {
                jQuery(this).addClass('qcld_portfolio_activate');
            }
        });
    })
</script>

<?php get_footer(); ?>
