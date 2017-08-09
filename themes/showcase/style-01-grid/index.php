<?php

	wp_enqueue_style('qcld-showcase-01-css', PORTFOLIO_THEME_URL . '/showcase/' . $template . '/css/style.css');
	
?>

<?php 
    $link_title = false;
    $link_title = qcpx_get_option('qcld_link_title'); 
?>

<div class="showcase-container">

    <?php 
        while ( $portfolio->have_posts() ) :
            $portfolio->the_post();
    ?>

    <div class="qc-grid-showcase-item">
        <div class="qc-grid-showcase-img">
            
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
        <!--qc-grid-showcase-img-->
        <div class="qc-grid-showcase-info">
            <h3>
            	<?php if( $link_title ) : ?>
                    <a href="<?php echo get_permalink(); ?>">
                        <?php echo get_the_title(); ?>
                    </a>
                <?php else: ?>
                    <?php echo get_the_title(); ?>
                <?php endif; ?>
            </h3>
        </div>
        <!--qc-grid-showcase-info-->
    </div>
    <!--qc-grid-showcase-item-->

    <?php endwhile; wp_reset_postdata(); ?>

    <div class="clear"></div>

</div>
<!--container-ex-->