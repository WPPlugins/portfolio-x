<?php

function qcpxshow_admin_notice__error() 
{
	global $wpdb;
	$updatePageLink = admin_url( 'edit.php?post_type=qcpx_portfolio&page=qcpx-portfolio-update-pt' );
	$class = 'notice notice-error';
	$message = __( 'Important! Please update <strong>Portfolio-X</strong> post type by <a href="'.$updatePageLink.'">clicking here</a>, otherwise you may find nothing under <strong>Portfolio Items</strong> menu.', 'qcpx-portfolio' );

	$rowcount = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'portfolio_item'");
	$updateable = ( isset($rowcount) && $rowcount != 0) ? $rowcount : 0;

	if( $updateable > 0 )
	{
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message );
	} 
}

add_action( 'admin_notices', 'qcpxshow_admin_notice__error' );



add_action('admin_menu', 'qcpx_register_pt_update_menu');

/**
 * Adds a submenu page under a custom post type parent.
 */
function qcpx_register_pt_update_menu() {
    add_submenu_page(
        'edit.php?post_type=qcpx_portfolio',
        __( 'Update Post Type', 'qcpx-portfolio' ),
        __( 'Update Post Type', 'qcpx-portfolio' ),
        'manage_options',
        'qcpx-portfolio-update-pt',
        'qcpx_portfolio_item_update_post_type'
    );
}
 
/**
 * Display callback for the submenu page.
 */
function qcpx_portfolio_item_update_post_type() { 

	global $wpdb;

    ?>
    <div class="wrap">
        <h1><?php _e( 'Post Type Update', 'qcpx-portfolio' ); ?></h1>
        
		
		<?php 

			$rowcount = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'portfolio_item'");
			$updateable = ( isset($rowcount) && $rowcount != 0) ? $rowcount : 0;

		?>

		<?php 
			if( isset($_POST['pt-update']) && $_POST['pt-update'] == 'true' ) :
		?>

		<?php 

			if( $updateable > 0 ) :

				$wpdb->update( 
					$wpdb->posts, 
					array( 
						'post_type' => 'portfolio-x',
					), 
					array( 'post_type' => 'portfolio_item' )
				);


		?>

			<div class="updated notice">
			    <p>Awesome! Post Type updated successfully.</p>
			</div>

			<?php endif; ?>

		<?php endif; ?>

        <div>
        	<p style="color: #f00;">
        		This process is only applicable if you updated this plugin from version 1.5 or older to version 1.6 or newer.
        	</p>
        	<p>If you are using this plugin from version 1.6 or newer, then you do not require to follow this page. Please just ignore.</p>
        </div>
        <hr>
        <div>
        	<p>
        		<strong>Old Post Type: </strong> portfolio_item
        	</p>
        	<p>
        		<strong>New Post Type: </strong> portfolio-x
        	</p>
        </div>
        <div>
        	<p>
        		With the update of verion <strong>1.6</strong>, we have changed Portfolio-X post type from <strong>'portfolio_item'</strong> to <strong>'portfolio-x'</strong>.
        	</p>
        	<p>
        		If you are upgrading Portfolio-X version from 1.5 or below, then you need to update post type by clicking the below button. We advise you take full back up of your system first in case anything goes wrong.
        	</p>
        	<?php 

				$rowcount = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'portfolio_item'");
				$updateable = ( isset($rowcount) && $rowcount != 0) ? $rowcount : 0;

			?>
        	<p>
        		<strong>Upgradeable Post Items: </strong> <?php echo $updateable; ?>
        	</p>
        	<form action="<?php echo admin_url( 'edit.php?post_type=qcpx_portfolio&page=qcpx-portfolio-update-pt' ); ?>" method="POST">
        		<input type="hidden" name="pt-update" value="true">
        		<input type="submit" class="button button-primary" name="update-btn" value="Update Post Type">
        	</form>
        </div>
        <hr>
    </div>
    <?php
}