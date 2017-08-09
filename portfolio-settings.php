<?php

if( !function_exists('ot_register_settings') ){
  require_once 'inc/option-tree/ot-loader.php';	
}

add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );

add_filter( 'ot_header_version_text', 'qcpx_ot_version_text_custom' );

function qcpx_ot_version_text_custom()
{
	$text = 'Developed by <a href="http://www.quantumcloud.com" target="_blank">Web Design Company - QuantumCloud</a>';
	
	return $text;
}

/**
 * Hook to register admin pages 
 */
add_action( 'init', 'qcpx_register_options_pages' );

/**
 * Registers all the required admin pages.
 */
function qcpx_register_options_pages() {

  // Only execute in admin & if OT is installed
  if ( is_admin() && function_exists( 'ot_register_settings' ) ) {

    // Register the pages
    ot_register_settings( 
      array(
        array( 
          'id'              => 'qcpx_plugin_options',
          'pages'           => array(
            array(
              'id'              => 'qcpx_options',
              'parent_slug'     => 'edit.php?post_type=qcpx_portfolio',
              'page_title'      => 'Portfolio-X Settings',
              'menu_title'      => 'Settings',
              'capability'      => 'edit_theme_options',
              'menu_slug'       => 'qcpx-options-page',
              'icon_url'        => null,
              'position'        => null,
              'updated_message' => 'Portfolio Options Updated.',
              'reset_message'   => 'Portfolio Options Reset.',
              'button_text'     => 'Save Changes',
              'show_buttons'    => true,
              'screen_icon'     => 'options-general',
              'contextual_help' => null,
              'sections'        => array(
                array(
                  'id'          => 'qcld_settings',
                  'title'       => __( 'Settings', 'portfolio-x' )
                ),
				array(
                  'id'          => 'tpl_customizer_section',
                  'title'       => __( 'Template Customizer', 'portfolio-x' ),
				  
                ),
				array(
                  'id'          => 'qcld_custom_css',
                  'title'       => __( 'Custom CSS ', 'portfolio-x' )
                ),
				array(
                  'id'          => 'help_tab',
                  'title'       => __( ' Help', 'portfolio-x' )
                )
              ),
			  
              'settings'        => array(
                  array(
                      'id'          => 'qc_single_open_opt',
                      'label'       => 'How to View Portfolio Details?',
                      'desc'        => 'Opening option for portfolio details.',
                      'std'         => '',
                      'type'        => 'select',
                      'section'     => 'qcld_settings',
                      'class'       => '',
                      'choices'     => array(
                          array(
                              'value'       => 'separate-page',
                              'label'       => __( 'In a Separate Single Page', 'portfolio-x' ),
                          ),
                      )
                  ),
                  array(
                      'id'          => 'qcpx_details_page_width',
                      'label'       => 'Single Page Width for Details Page',
                      'desc'        => 'Single Page width option for portfolio details.',
                      'std'         => '',
                      'type'        => 'select',
                      'section'     => 'qcld_settings',
                      'class'       => '',
                      'choices'     => array(
                          array(
                              'value'       => 'single_full',
                              'label'       => __( 'Full Width for Details Page', 'portfolio-x' ),
                          ),
                          array(
                              'value'       => 'single_box',
                              'label'       => __( 'Boxed Width for Details Page', 'portfolio-x' ),
                          )
                      )
                  ),
                  array(
                      'id'          => 'qcpx_details_page_width_val',
                      'label'       => 'Box Width Value for Details Page',
                      'desc'        => 'Enter value for single page width for details page , Example: 1170, 850,1050 etc.',
                      'std'         => '1170',
                      'type'        => 'text',
                      'section'     => 'qcld_settings',
                      'class'       => ''
                  ),
                array(
                  'id'          => 'qcld_template_links',
                  'label'       => 'Show All Portfolio Links at Top',
                  'desc'        => 'Enable/Disable portfolio links at the top of the listing page',
                  'std'         => 'off',
                  'type'        => 'on-off',
                  'section'     => 'qcld_settings',
                  'class'       => ''
                ),
                  array(
                      'id'          => 'qcpx_list_page_width',
                      'label'       => 'Filtered Listing Page Width',
                      'desc'        => 'Filtered Listing Page Width option for portfolio details.',
                      'std'         => '',
                      'type'        => 'select',
                      'section'     => 'qcld_settings',
                      'class'       => '',
                      'choices'     => array(
                          array(
                              'value'       => 'list_full',
                              'label'       => __( 'Full Width for Filtered Listing Page', 'portfolio-x' ),
                          ),
                          array(
                              'value'       => 'list_box',
                              'label'       => __( 'Boxed Width for Filtered Listing Page', 'portfolio-x' ),
                          )
                      )
                  ),
                  array(
                      'id'          => 'qcpx_list_page_width_val',
                      'label'       => 'Box Width Value for Filtered Listing Page',
                      'desc'        => 'Enter value for Filtered Listing Page, Example: 1170, 850,1050 etc.',
                      'std'         => '1170',
                      'type'        => 'text',
                      'section'     => 'qcld_settings',
                      'class'       => ''
                  ),
				array(
                  'id'          => 'qcld_post_per_page',
                  'label'       => 'Items Per Page',
                  'desc'        => 'Enter number of items to display on per page listing. Only even numbers are preferred, Example: 2, 4, 6 etc.',
                  'std'         => '6',
                  'type'        => 'text',
                  'section'     => 'qcld_settings',
                  'class'       => ''
                ),
				array(
                  'id'          => 'qcld_link_title',
                  'label'       => 'Link Listing Title',
                  'desc'        => 'Link title to open portfolio details.',
                  'std'         => 'on',
                  'type'        => 'on-off',
                  'section'     => 'qcld_settings',
                  'class'       => ''
                ),
				//END of SETTINS TAB
				
				//TAB or Template - 01
				array(
                  'id'          => 'tpl_customizer_tab_01',
                  'label'       => 'Template 01',
                  'type'        => 'tab',
                  'section'     => 'tpl_customizer_section',
                ),
				
				array(
                  'id'          => 'qcpo_tpl1_serial_number',
                  'label'       => 'Show/Hide Item Serial Number',
                  'desc'        => 'Display item serial number on listing page.',
                  'std'         => 'on',
                  'type'        => 'on-off',
                  'section'     => 'tpl_customizer_section',
                ),
				
				array(
                  'id'          => 'qcpo_tpl1_color_scheme',
                  'label'       => 'Select A Color Scheme',
                  'desc'        => '',
                  'std'         => '1',
                  'type'        => 'select',
                  'section'     => 'tpl_customizer_section',
                  'class'       => '',
				  'choices'     => array( 
					  array(
						'value'       => '1',
						'label'       => __( 'Light', 'portfolio-x' ),
					  ),
					  array(
						'value'       => '2',
						'label'       => __( 'Dark', 'portfolio-x' ),
					  ),
					)
                ),
				
				array(
                  'id'          => 'qcpo_tpl1_img_shading_color',
                  'label'       => 'Choose Shadow Color',
                  'desc'        => '',
                  'std'         => '#ffbc00',
                  'type'        => 'colorpicker',
                  'section'     => 'tpl_customizer_section',
                ),
				
				array(
                  'id'          => 'qcpo_tpl1_qcld_img_border_radius',
                  'label'       => 'Image Border Radius',
                  'desc'        => '',
                  'std'         => '10',
                  'type'        => 'text',
                  'section'     => 'tpl_customizer_section',
                ),
				
				
				
				//TAB or Template - 02
				array(
                  'id'          => 'tpl_customizer_tab_02',
                  'label'       => 'Template 02',
                  'type'        => 'tab',
                  'section'     => 'tpl_customizer_section',
                ),
				
				array(
                  'id'          => 'qcpo_tpl2_container_bg_color',
                  'label'       => 'Container Background Color',
                  'desc'        => '',
                  'std'         => '#F5F5F5',
                  'type'        => 'colorpicker',
                  'section'     => 'tpl_customizer_section',
                ),
				
				array(
                  'id'          => 'qcpo_tpl2_title_txt_color',
                  'label'       => 'Choose Title Color',
                  'desc'        => '',
                  'std'         => '#2a2a2a',
                  'type'        => 'colorpicker',
                  'section'     => 'tpl_customizer_section',
                ),
				
				array(
                  'id'          => 'qcpo_tpl2_item_border_radius',
                  'label'       => 'Item Border Radius',
                  'desc'        => '',
                  'std'         => '0',
                  'type'        => 'text',
                  'section'     => 'tpl_customizer_section',
                ),
				
				array(
                  'id'          => 'qcpo_tpl2_item_margin_tp',
                  'label'       => 'Item Margin: Top',
                  'desc'        => '',
                  'std'         => '0',
                  'type'        => 'text',
                  'section'     => 'tpl_customizer_section',
                ),
				
				array(
                  'id'          => 'qcpo_tpl2_item_margin_rt',
                  'label'       => 'Item Margin: Right',
                  'desc'        => '',
                  'std'         => '8',
                  'type'        => 'text',
                  'section'     => 'tpl_customizer_section',
                ),
				
				array(
                  'id'          => 'qcpo_tpl2_item_margin_bt',
                  'label'       => 'Item Margin: Bottom',
                  'desc'        => '',
                  'std'         => '8',
                  'type'        => 'text',
                  'section'     => 'tpl_customizer_section',
                ),
				
				array(
                  'id'          => 'qcpo_tpl2_item_margin_lt',
                  'label'       => 'Item Margin: Left',
                  'desc'        => '',
                  'std'         => '0',
                  'type'        => 'text',
                  'section'     => 'tpl_customizer_section',
                ),
				
				//TAB or Template - 03
				array(
                  'id'          => 'tpl_customizer_tab_03',
                  'label'       => 'Template 03',
                  'type'        => 'tab',
                  'section'     => 'tpl_customizer_section',
                ),
				
				array(
                  'id'          => 'qcpo_tpl3_tb',
                  'label'       => 'Coming Soon',
				  'desc'        => '<h3>Coming Soon</h3>',
                  'type'        => 'textblock',
                  'section'     => 'tpl_customizer_section',
                ),
				
				//TAB or Template - 04
				array(
                  'id'          => 'tpl_customizer_tab_04',
                  'label'       => 'Template 04',
                  'type'        => 'tab',
                  'section'     => 'tpl_customizer_section',
                ),
				
				array(
                  'id'          => 'qcpo_tpl4_tb',
                  'label'       => 'Coming Soon',
				  'desc'        => '<h3>Coming Soon</h3>',
                  'type'        => 'textblock',
                  'section'     => 'tpl_customizer_section',
                ),
				
				//END of TEMPLATE CUSTOMIZER
				
				array(
                  'id'          => 'qcld_port_custom_css',
                  'label'       => 'Custom CSS',
                  'desc'        => 'You can paste or write your custom css here.',
                  'std'         => '',
                  'type'        => 'textarea-simple',
                  'section'     => 'qcld_custom_css',
                  'class'       => ''
                ),
				
				//END of Custom CSS
								
				array(
                  'id'          => 'help_block',
                  'label'       => 'Help',
                  'type'        => 'textblock',
                  'section'     => 'help_tab',
                  'class'       => '',
                  'desc'       => '<div>
								<p>
									<strong><u>Example of Shortcode to Display any Portfolio:</u></strong>
									<br>
									[portfolio-x portfolio="99"] 
									<br>
									<br>
									Here, 99 is portfolio ID, which should be replaced in your case. You can also copy shortcode from portfolio list (Portfolio-X) page.
									<br>
									<br>

									<strong><u>Example of Shortcode to Display Portfoli Showcase:</u></strong>
									<br>
									[portfolio-x-showcase template="style-01" limit="5" orderby="title" order="ASC"]
									<br>
									<br>
									<strong><u>Available Parameters For Showcase Shortcode:</u></strong>
									<br>
								</p>
								<p>
									<strong>1. orderby</strong>
									<br>
									Compatible order by values: "ID", "author", "title", "name", "type", "date", "modified", "rand" and "menu_order".
									
								</p>
							    <p>
									<strong>2. order</strong>
									<br>
									Value for this option can be set as "ASC" for Ascending or "DESC" for Descending order.
								</p>
								<p>
									<strong>3. template</strong>
									<br>
									Supported values: "style-01", "style-02"
								</p>
								<p>
									<strong>4. limit</strong>
									<br>
									Specify the number of items you want to show. Default value is 5.
								</p>

					          </div>
					          <div>
								<p>
									<strong><u>Available Widgets:</u></strong>
									<br>
									<br>
									Two widget variations are avilable in this version:
									<br>
									<br>
									You can check "Appearence --> Widgets" menu. Then "Portfolio-X : Latest Items". Tune config options then save the widget. 
								</p>
					          </div>'
                ),
				
              )
            )
          )
        )
      )
    );

  }

}


