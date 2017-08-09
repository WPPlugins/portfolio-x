<!--Adding Template Specific Style -->

<?php

	wp_enqueue_style( 'qcld-tpl2-layout-catalog-css', PORTFOLIO_THEME_URL . "/" . $theme . "/css/layout-catalog.css" );

?>

<!-- Customized CSS -->
<style>
    .portfolio-tpl2-container {
        background-color: <?php echo qcpx_get_option('qcpo_tpl2_container_bg_color'); ?>;
    }

    .portfolio-tpl2-container .qc-grid-portfolio-info a {
      color: <?php echo qcpx_get_option('qcpo_tpl2_title_txt_color'); ?>;
    }

    .portfolio-tpl2-container .qc-grid-portfolio-item {
      -moz-border-radius: <?php echo qcpx_get_option('qcpo_tpl2_item_border_radius'); ?>px;
      -webkit-border-radius: <?php echo qcpx_get_option('qcpo_tpl2_item_border_radius'); ?>px;
      border-radius: <?php echo qcpx_get_option('qcpo_tpl2_item_border_radius'); ?>px;
    }

    .portfolio-tpl2-container .qc-grid-portfolio-item {
        margin-right: <?php echo qcpx_get_option('qcpo_tpl2_item_margin_rt'); ?>px;
        margin-bottom: <?php echo qcpx_get_option('qcpo_tpl2_item_margin_bt'); ?>px;
        margin-top: <?php echo qcpx_get_option('qcpo_tpl2_item_margin_tp'); ?>px;
        margin-left: <?php echo qcpx_get_option('qcpo_tpl2_item_margin_lt'); ?>px;
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

$link_title = false;
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

<div class="portfolio-container portfolio-tpl2-container" id="portfolio-container" <?php echo $list_width_style; ?> >

    <?php
    $i = 1;
    $j = 1;

    global $post;

    $currentLoopCount = 1;
    $rowCount = 0;

    //while-loop start
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
	
	<div class="qc-grid-portfolio-item portfolio-fire-hover">
        <div class="qc-grid-portfolio-img">
            <?php 
                echo get_the_post_thumbnail($post->ID, 'tpl2-thumb', array('class' => 'portfolio_img')); 
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
                            <a class="third-anchor" class="qcld_box" href="#inline-<?php echo $post->ID; ?>" title="<?php _e('View Details'); ?>">
                                <i class="fa fa-plus-circle"></i>
                            </a> 
                        <?php endif; ?>

                    </div>
                    <!--/qc-circle-grid-button-area-->
                </div>
            </div>
            <!--/new hover effect-->
			
        </div>
        <!--/qc-grid-portfolio-img-->
        <div class="qc-grid-portfolio-info">
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

            <?php 
                $techs = get_the_terms( get_the_ID(), 'portfolio_technology' );
                $total = count( $techs );
                $serial = 1;

                if( $techs && $total > 0 ){
                
                    echo '<div class="info-techs">';

                    foreach( $techs as $tech )
                    {
                        echo $tech->name;
                        if( $serial != $total ){
                            echo " / ";
                        }
                        $serial++;

                    }

                    echo '</div>';
                }

            ?>

        </div>
        <!--/qc-grid-portfolio-info-->
		
		<!--lightbox-content-->
		<div style="display: none;">
                <div class="inside-popup-details" id="inline-<?php echo $post->ID; ?>">
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
                                    <div class="portfolio-single-content fancy-fixed-content">
                                        <div class="single-portfolio-header">
                                            <h2 class="single-portfolio-title"><?php the_title(); ?> </h2>
                                            <div class="category">
                                                <h4>
                                                    <?php 
                                                        _e("Types: ", 'portfilio-x'); 
                                                    ?>
                                                </h4>
                                                <p>
                                                <?php 
                                                    $types = get_the_terms( get_the_ID(), 'portfolio_type' );
                                                    $total = count( $types );
                                                    $serial = 1;
                                                    
                                                    if( $types && $total > 0 ){

                                                        foreach( $types as $type )
                                                        {
                                                            echo $type->name;
                                                            if( $serial != $total ){
                                                                echo ", ";
                                                            }
                                                            $serial++;

                                                        }
                                                    }

                                                ?>
                                                </p>
                                            </div>

                                            <div class="single-portfolio-description">
                                                <p><?php echo $short_description; ?></p>
                                            </div>
                                            <div>
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
                                            </div>
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
                                            <h4>
                                                <?php 
                                                    _e("Technology Used: ", 'portfilio-x'); 
                                                ?>
                                            </h4>
                                            <div class="category">
                                                <?php 
                                                    $techs = get_the_terms( get_the_ID(), 'portfolio_technology' );
                                                    $total = count( $techs );
                                                    $serial = 1;

                                                    if( $techs && $total > 0 ){
                                                    
                                                        foreach( $techs as $tech )
                                                        {
                                                            echo $tech->name;
                                                            if( $serial != $total ){
                                                                echo ", ";
                                                            }
                                                            $serial++;

                                                        }
                                                    }

                                                ?>
                                            </div>
                                            
                                            <!--portfolio-projects-nav-->
                                        </div>

                                        <!--single-portfolio-footer-->
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
			<!--/lightbox-content-->
    </div>
	<!--/qc-grid-portfolio-item-->
	
	<?php } //while-loop end ?>

        

    <div class="portfolio-row portfolio-pagination">
        <?php

            $maxNumPage = $custom_query->max_num_pages;

            qcld_custom_pagination( $maxNumPage, "", $paged );

        ?>
    </div>
	
	<div class="clear"></div>
	
</div>
<!--end portfolio-container-->
<!---->

