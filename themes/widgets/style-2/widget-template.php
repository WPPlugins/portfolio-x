<?php

	wp_enqueue_style('qcld-widget-02-css', PORTFOLIO_THEME_URL . '/widgets/' . $style . '/css/style.css');
	wp_enqueue_style('qcld-widget-02-bxslider-css', PORTFOLIO_THEME_URL . '/widgets/' . $style . '/js/jquery.bxslider.css');
	
	wp_enqueue_script('qcld-widget-02-bxslider-js', PORTFOLIO_THEME_URL . '/widgets/' . $style . '/js/jquery.bxslider.min.js');
	
?>

<script>
    jQuery(document).ready(function($){
        $('.widgetBxSlider').bxSlider({
          auto: true,
          pager: false
        });
    });
</script>

<?php 
    $link_title = false;
    $link_title = qcpx_get_option('qcld_link_title');
?>

<div class="wtpl-2">
    <ul class="widgetBxSlider">
        <?php 
            while ( $item_query->have_posts() ) :
                $item_query->the_post();
        ?>
        <li>
            <a href="<?php echo get_permalink(); ?>">
                <?php 
                    echo get_the_post_thumbnail( get_the_ID(), 'thumbnail', array('class' => 'portfolio_img') ); 
                ?>
            </a>
        </li>
        <?php endwhile; wp_reset_postdata(); ?>
    </ul>
</div>