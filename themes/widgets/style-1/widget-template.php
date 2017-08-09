<?php

	wp_enqueue_style('qcld-widget-01-css', PORTFOLIO_THEME_URL . '/widgets/' . $style . '/css/style.css');
	
?>

<?php 
    $link_title = false;
    $link_title = qcpx_get_option('qcld_link_title'); 
?>

<div class="qc-portfolio-widget-wrapper wtpl-1">
    <ul>
        <?php 
            while ( $item_query->have_posts() ) :
                $item_query->the_post();
        ?>
        <li>
            <?php
                $short_description = get_post_meta(get_the_ID(), 'qc_portfolio_wysiwyg', true);
            ?>
            <div class="qc-portfolio-widget-listing-image">
                <a href="<?php echo get_permalink(); ?>">
                    <?php 
                        echo get_the_post_thumbnail( get_the_ID(), 'thumbnail', array('class' => 'portfolio_img') ); 
                    ?>
                </a>
            </div>
            <!--/qc-portfolio-widget-listing-image-->
            <div class="qc-portfolio-widget-listing-content">
                <h3>
                    <?php if( $link_title ) : ?>
                        <a href="<?php echo get_permalink(); ?>">
                            <?php echo get_the_title(); ?>
                        </a>
                    <?php else: ?>
                        <?php echo get_the_title(); ?>
                    <?php endif; ?>
                </h3>
                <p>
                    <?php 
                        $stripped = strip_tags($short_description); 
                        echo substr($stripped, 0, 40) . '...';
                    ?>
                </p>
            </div>
            <!--/qc-portfolio-widget-listing-content-->
        </li>
        <?php endwhile; wp_reset_postdata(); ?>
    </ul>
</div>