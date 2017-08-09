<?php

	wp_enqueue_style('qcld-showcase-02-css', PORTFOLIO_THEME_URL . '/showcase/' . $template . '/css/style.css');
	wp_enqueue_style('qcld-showcase-02-slick-css', PORTFOLIO_THEME_URL . '/showcase/' . $template . '/css/slick.css');
	
?>

<?php 
    $link_title = false;
    $link_title = qcpx_get_option('qcld_link_title'); 
?>

<div class="showcase-slider">
 <?php 
        while ( $portfolio->have_posts() ) :
            $portfolio->the_post();
    ?>

    <div>
        <div class="showcase-slider-item-inner">
            <a href="<?php echo get_permalink(); ?>">
                <?php 
                    echo get_the_post_thumbnail( get_the_ID(), 'full', array('class' => 'portfolio_img') );
                ?>
            </a>
            <div class="hover-effect1">
                <a class="qcld_box" href="<?php echo get_permalink(); ?>">
                    <i class="fa fa-search-plus" aria-hidden="true"></i>
                </a>
            </div>
        </div> 
    </div>

    <?php endwhile; 
	wp_reset_postdata(); ?>

</div>
<!--container-ex-->

<?php
	wp_enqueue_script('showcase-02-slick-js', PORTFOLIO_THEME_URL . '/showcase/' . $template . '/js/slick.js');
?>

<script type="text/javascript">
    jQuery(document).on('ready', function ($) {
        jQuery('.showcase-slider').slick({
            centerMode: true,
            slidesToShow: 3,
            useTransform: true,
            variableWidth: false,
            centerPadding:'0',
            responsive: [
            {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        useCSS: false,
                        variableWidth: false,
                        centerPadding:'0',
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        useCSS: false,
                        variableWidth: false,
                        centerPadding:'0',
                    }
                }
            ]

        });
    });
</script>