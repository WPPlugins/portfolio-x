<?php

/*TinyMCE Shortcode Generator Button, For Portfolio-X - 02-10-2017*/

/*******************************
 * Shortcode Generator
 * For Portfolio-X
 *******************************/

function qcpx_tinymce_shortcode_button_function_cmn() {
	add_filter ("mce_external_plugins", "qcpx_shortcode_generator_btn_js_cmn");
	add_filter ("mce_buttons", "qcpx_shortcode_generator_btn_cmn");
}

function qcpx_shortcode_generator_btn_js_cmn($plugin_array) {
	$plugin_array['qcpx_shortcode_cmn'] = plugins_url('js/qcpx-tinymce-sc-generator-1.js', __FILE__);
	return $plugin_array;
}

function qcpx_shortcode_generator_btn_cmn($buttons) {
	array_push ($buttons, 'qcpx_shortcode_cmn');
	return $buttons;
}

add_action ('init', 'qcpx_tinymce_shortcode_button_function_cmn');

function qcpx_load_custom_wp_admin_style_cmn() {
        wp_register_style( 'px_shortcode_gerator_css_cmn', PORTFOLIO_URL . '/css/shortcode-modal.css', false, '1.0.0' );
        wp_enqueue_style( 'px_shortcode_gerator_css_cmn' );
}

add_action( 'admin_enqueue_scripts', 'qcpx_load_custom_wp_admin_style_cmn' );


function qcpx_render_shortcode_modal_cmn() {

	?>

	<div id="sm-modal" class="modal">

		<!-- Modal content -->
		<div class="modal-content">
		
			<span class="close">
				<span class="dashicons dashicons-no"></span>
			</span>
			<h3> 
				<?php _e( 'Portfolio-X : Shortcode Generator' , 'qc-opd' ); ?></h3>
			<hr/>
			
			<div class="sm_shortcode_list">

				<div class="qcpx_single_field_shortcode">
					<label style="width: 200px;display: inline-block;">
						Mode
					</label>
					<select style="width: 225px;" id="qcpx_mode">
						<option value="">Please Select Mode</option>
						<option value="portfolio">Portfolio</option>
						<option value="showcase">Showcase</option>
					</select>
				</div>
				
				<div id="field_portfolio" class="qcpx_single_field_shortcode">
					<label style="width: 200px;display: inline-block;">
						Select Portfolio
					</label>
					<select style="width: 225px;" id="qcpx_portfolio_id">
					
						<option value="">Please Select Portfolio</option>
						
						<?php
						
							$qcpx_posts = new WP_Query( array( 'post_type' => 'qcpx_portfolio', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC') );
							if( $qcpx_posts->have_posts()){
								while( $qcpx_posts->have_posts() ){
									$qcpx_posts->the_post();
						?>
						
						<option value="<?php echo get_the_ID(); ?>"><?php echo get_the_title(); ?></option>
						
						<?php } } ?>
						
					</select>
				</div>
				
				<div id="field_portfolio_tpls" class="qcpx_single_field_shortcode">
					<label style="width: 200px;display: inline-block;">
						Portfolio Template
					</label>
					<select style="width: 225px;" id="qcpx_portfolio_tpl">
						<option value="default">Default Template</option>
						<option value="template-01">Template 01</option>
						<option value="template-02">Template 02</option>
						<option value="template-03">Template 03</option>
						<option value="template-04">Template 04</option>
					</select>
				</div>
				
				<div id="field_showcase_tpls" class="qcpx_single_field_shortcode">
					<label style="width: 200px;display: inline-block;">
						Showcase Style
					</label>
					<select style="width: 225px;" id="qcpx_showcase_style">
						<option value="style-01">Style 01</option>
						<option value="style-02">Style 02</option>
					</select>
				</div>
				
				<div class="qcpx_single_field_shortcode">
					<label style="width: 200px;display: inline-block;">
						Order By
					</label>
					<select style="width: 225px;" id="qcpx_orderby">
						<option value="date">Date</option>
						<option value="ID">ID</option>
						<option value="title">Title</option>
						<option value="modified">Date Modified</option>
						<option value="rand">Random</option>
						<option value="menu_order">Menu Order</option>
					</select>
				</div>
				
				<div class="qcpx_single_field_shortcode">
					<label style="width: 200px;display: inline-block;">
						Order
					</label>
					<select style="width: 225px;" id="qcpx_order">
						<option value="ASC">Ascending</option>
						<option value="DESC">Descending</option>
					</select>
				</div>
				
				<div class="qcpx_single_field_shortcode">
					<label style="width: 200px;display: inline-block;">
						Limit
					</label>
					<input type="text" id="qcpx_limit" name="qcpx_showcase_limit">
					<p>
						Numric Limit: e.g. 10
					</p>
				</div>
				
				<div class="qcpx_single_field_shortcode">
					<label style="width: 200px;display: inline-block;">
					</label>
					<input class="sld-sc-btn" type="button" id="qcpx_add_shortcode_cmn" value="Add Shortcode" />
				</div>
				
			</div>
		</div>

	</div>
	<?php
	exit;
}

add_action( 'wp_ajax_show_qcpx_shortcode_cmn', 'qcpx_render_shortcode_modal_cmn');
