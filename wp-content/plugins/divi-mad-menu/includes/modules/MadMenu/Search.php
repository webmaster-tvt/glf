<?php

// Die if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Search.
 * 
 * Generates the search icon and search form.
 *
 * @since   1.0.0 
 * 
 */
class DVMM_Menu_Search {

    /**
     * Returns instance of the class.
     * 
     * @since   1.0.0
     * 
     */
	public static function instance( ) {

		static $instance;
        return $instance ? $instance : $instance = new self( );
        
	}

    /**
     * Constructor.
     * 
     */ 
	private function __construct( ) {

    }

	/**
	 * Fields.
	 * 
	 * @since	v1.0.0 
	 * 
	 * @param	object	$module		Module.
	 * 
	 */
	public function get_fields( $module ) {
        $fields = array(
			'dvmm_enable_search' => array(
				'label'           => esc_html__( 'Enable Search', 'dvmm-divi-mad-menu' ),
				'description'     => esc_html__( 'Add the search element to the header.', 'dvmm-divi-mad-menu' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'affects'		=> array(
					'border_radii_dvmm_search_btn',
					'border_radii_dvmm_search_btn_f',
				),
				'default'       => 'off',
				'tab_slug'      => 'general',
				'toggle_slug'	=> 'header_elements',
			),	
			'dvmm_show_search_icon' => array(
				'label'           => esc_html__( 'Show Search', 'dvmm-divi-mad-menu' ),
				'description'     => esc_html__( 'Set the Search element responsive visibility.', 'dvmm-divi-mad-menu' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'show_if'         => array(
					'dvmm_enable_search' => 'on',
				),
				'mobile_options'  => true,
				'responsive'      => true,
				'hover'           => 'tabs',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'       => 'on',
				'tab_slug'          => 'custom_css',
				'toggle_slug'       => 'visibility',
			),
			'dvmm_search_order' => array(
				'label'			=> esc_html__( 'Search Order', 'dvmm-divi-mad-menu' ),
				'description'	=> esc_html__( 'Here you can set the element order. Element order is set relatively to other enabled elements, a higher order number moves the element closer to the right hand side of the header.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'range',
                'mobile_options'	=> true,
                'responsive'		=> true,
				'option_category'	=> 'layout',
				'show_if'			=> array(
					'dvmm_enable_search' => 'on',
				),
				'range_settings'   	=> array(
					'min'       => 0,
					'max'       => 25,
					'step'      => 1,
					'min_limit' => 0,
					'max_limit' => 25,
				),
				'validate_unit' 	=> false,
				// 'unitless'        	=> true,
				'default'           => '0',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'general_layout',
			),
			'dvmm_search_icon_image' => array(
				'label'           	=> esc_html__( 'Search Icon/Image', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Use either the default font icon or upload a custom image icon for the search.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'basic_option',
				'show_if'         => array(
					'dvmm_enable_search' => 'on',
				),
				// 'mobile_options'  	=> true,
				// 'responsive'      	=> true,
				'options'         	=> array(
					'icon'		=> esc_html__( 'Icon', 'dvmm-divi-mad-menu' ),
					'image'		=> esc_html__( 'Image', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'icon',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'search',
			),
			'dvmm_search_img' => array(
				'label'             => esc_html__( 'Search Image', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Upload an image to use as a search icon.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'upload',
				'option_category'	=> 'basic_option',
				'show_if'			=> array(
					'dvmm_enable_search' => 'on',
					'dvmm_search_icon_image' => 'image',
				),
				'mobile_options'    => true,
				'hover'             => 'tabs',
				'upload_button_text'=> esc_attr__( 'Upload an image', 'dvmm-divi-mad-menu' ),
				'choose_text'       => esc_attr__( 'Choose an Image', 'dvmm-divi-mad-menu' ),
				'update_text'       => esc_attr__( 'Set As Search Icon', 'dvmm-divi-mad-menu' ),
				// 'dynamic_content'   => 'image',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'search',
			),
			'dvmm_use_fixed_search_img' => array(
				'label'				=> esc_html__( 'Use Fixed Header Search Image', 'dvmm-divi-mad-menu' ),
				'description'		=> esc_html__( 'Use a different image for the fixed header.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'yes_no_button',
				'option_category' 	=> 'configuration',
				'show_if'			=> array(
					'dvmm_enable_search' 		=> 'on',
					'dvmm_search_icon_image' 	=> 'image',
					'dvmm_enable_fixed_header' 	=> 'on',
				),
				'options'         	=> array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'			=> 'off',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'search',
			),
			'dvmm_search_img_f' => array(
				'label'             => esc_html__( 'Search Image (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Upload the fixed header search image.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'upload',
				'option_category'	=> 'basic_option',
				'show_if'			=> array(
					'dvmm_enable_search' 		=> 'on',
					'dvmm_search_icon_image' 	=> 'image',
					'dvmm_enable_fixed_header' 	=> 'on',
					'dvmm_use_fixed_search_img'	=> 'on',
				),
				'mobile_options'    => true,
				'hover'             => 'tabs',
				'upload_button_text'=> esc_attr__( 'Upload an image', 'dvmm-divi-mad-menu' ),
				'choose_text'       => esc_attr__( 'Choose an Image', 'dvmm-divi-mad-menu' ),
				'update_text'       => esc_attr__( 'Set As Search Icon', 'dvmm-divi-mad-menu' ),
				'dynamic_content'   => 'image',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'search',
			),
			// @since 1.9.1 
			'placeholder_text' 	=> array(
				'label'            	=> esc_html__( 'Placeholder Text', 'dvmm-divi-mad-menu' ),
				'description'      	=> esc_html__( 'Add the search field placeholder text.', 'dvmm-divi-mad-menu' ),
				'type'             	=> 'text',
				'option_category'  	=> 'basic_option',
				'show_if'			=> array(
					'dvmm_enable_search' => 'on',
				),
				'default'       	=> esc_html__( 'Search ...', 'dvmm-divi-mad-menu' ),
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'search',
			),
			'dvmm_search_btn_margin' => array(
				'label'             => esc_html__( 'Search Margin', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         => array(
					'dvmm_enable_search' => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           => 'tabs',
				'default'           => '0px|5px|0px|5px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'search_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_search_btn_margin_f' => array(
				'label'             => esc_html__( 'Search Margin (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         => array(
					'dvmm_enable_fixed_header' => 'on',
					'dvmm_enable_search' => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           => 'tabs',
				// 'default'           => '0px|5px|0px|5px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'search_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_search_btn_padding' => array(
				'label'             => esc_html__( 'Search Padding', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'show_if'         => array(
					'dvmm_enable_search' => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           => 'tabs',
				'default'           => '20px|20px|20px|20px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'search_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_search_btn_padding_f' => array(
				'label'             => esc_html__( 'Search Padding (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'show_if'         => array(
					'dvmm_enable_fixed_header' => 'on',
					'dvmm_enable_search' => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           => 'tabs',
				// 'default'           => '20px|20px|20px|20px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'search_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_search_icon_size' => array(
				'label'             => esc_html__( 'Search Icon Size', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Here you can control the size of the search icon.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           => 'tabs',
				'show_if'			=> array(
					'dvmm_enable_search'	=> 'on',
					'dvmm_search_icon_image' => 'icon',
				),
				'allowed_units'     => array( 'px' ),
				'default_unit'      => 'px',
				// 'validate_unit' 	=> false,
				'default'           => '18px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'search_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_search_icon_size_f' => array(
				'label'             => esc_html__( 'Search Icon Size (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Here you can control the size of the fixed header search icon.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           => 'tabs',
				'show_if'			=> array(
					'dvmm_enable_search'	=> 'on',
					'dvmm_search_icon_image' => 'icon',
					'dvmm_enable_fixed_header' => 'on',
				),
				'allowed_units'     => array( 'px' ),
				'default_unit'      => 'px',
				// 'validate_unit' 	=> false,
				'default'           => '',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'search_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_search_icon_color' => array(
				'label'           	=> esc_html__( 'Search Icon Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the search icon color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_search'	=> 'on',
					'dvmm_search_icon_image' => 'icon',
				),
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '#666666',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'search_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_search_icon_color_f' => array(
				'label'           	=> esc_html__( 'Search Icon Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header search icon color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_search'	=> 'on',
					'dvmm_search_icon_image' => 'icon',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'       => 'search_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_search_btn_background_color' => array(
				'label'           	=> esc_html__( 'Search Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the search button background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_search'	=> 'on',
				),
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> 'rgba(0,0,0,0)',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'search_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_search_btn_background_color_f' => array(
				'label'           	=> esc_html__( 'Search Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header search button background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_search'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'       => 'search_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_search_form_background_color' => array(
				'label'           	=> esc_html__( 'Search Form Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the search form background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_search'	=> 'on',
				),
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> 'rgba(0,0,0,0)',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'search_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_search_form_background_color_f' => array(
				'label'           	=> esc_html__( 'Search Form Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header search form background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_search'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'       => 'search_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_search_x_icon_size' => array(
				'label'             => esc_html__( 'Search X Icon Size', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Here you can control the size of the search close icon.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'show_if'			=> array(
					'dvmm_enable_search'	=> 'on',
				),
				'allowed_units'     => array( 'px' ),
				'default_unit'      => 'px',
				// 'validate_unit' 	=> false,
				'default'           => '32px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'search_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_search_x_icon_size_f' => array(
				'label'             => esc_html__( 'Search X Icon Size (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Here you can control the size of the fixed header search close icon.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'show_if'			=> array(
					'dvmm_enable_search'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'allowed_units'     => array( 'px' ),
				'default_unit'      => 'px',
				// 'validate_unit' 	=> false,
				'default'           => '',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'search_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_search_x_icon_color' => array(
				'label'           	=> esc_html__( 'Search X Icon Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the search close icon color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_search'	=> 'on',
				),
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '#666666',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'search_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_search_x_icon_color_f' => array(
				'label'           	=> esc_html__( 'Search X Icon Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header search close icon color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_search'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'       => 'search_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_search_text_size' => array(
				'label'             => esc_html__( 'Search Text Size', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Here you can control the font size of the search text.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           => 'tabs',
				'show_if'			=> array(
					'dvmm_enable_search'	=> 'on',
				),
				'allowed_units'     => array( 'px' ),
				'default_unit'      => 'px',
				// 'validate_unit' 	=> false,
				'default'           => '18px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'search_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_search_text_size_f' => array(
				'label'             => esc_html__( 'Search Text Size (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Here you can control the font size of the fixed header search text.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'show_if'			=> array(
					'dvmm_enable_search'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'allowed_units'     => array( 'px' ),
				'default_unit'      => 'px',
				// 'validate_unit' 	=> false,
				'default'           => '',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'search_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_search_text_color' => array(
				'label'           	=> esc_html__( 'Search Text Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the search input field text color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_search'	=> 'on',
				),
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '#333333',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'search_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_search_text_color_f' => array(
				'label'           	=> esc_html__( 'Search Text Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header search input field text color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_search'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'       => 'search_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_search_field_bg_color' => array(
				'label'           	=> esc_html__( 'Search Field Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the search input field background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_search'	=> 'on',
				),
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> 'rgba(255, 255, 255, 0.3)',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'search_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_search_field_bg_color_f' => array(
				'label'           	=> esc_html__( 'Search Field Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header search input field background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_search'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'       => 'search_design',
				'sub_toggle'		=> 'fixed',
			),

		);

		/**
		 * Add the element column layout fields.
		 * 
		 * dvmm_search_col_width
		 * dvmm_search_col_width_f
		 * dvmm_search_col_max_width
		 * dvmm_search_col_max_width_f
		 */
		$element_column_layout_fields = $module->helpers()->add_element_column_layout_fields( 
			array(
				'element_name' 	=> "Search",
				'element_slug' 	=> "search",
				'tab_slug'		=> 'advanced',
				'toggle_slug'	=> 'elements_layout',
				'sub_toggle'	=> 'search',
			)
		);

		/**
		 * Add the element column design fields.
		 * 
		 * dvmm_search_col_bg_color
		 * dvmm_search_col_bg_color_f
		 */
		$element_column_design_fields = $module->helpers()->add_element_column_design_fields( 
			array(
				'element_name' 	=> "Search",
				'element_slug' 	=> "search",
				'tab_slug'		=> 'advanced',
				'toggle_slug'	=> 'search_design',
			)
		);

		/**
		 * Add the element alignment fields.
		 * 
		 * dvmm_search_vertical_alignment
		 * dvmm_search_vertical_alignment_f
		 * dvmm_search_horizontal_alignment
		 * dvmm_search_horizontal_alignment_f
		 */
		$element_fields = $module->helpers()->add_element_alignment_fields( 
			array(
				'element_name' 		 => "Search",
				'element_slug' 		 => "search", /* required, do not change */
				'setting_base' 		 => "search",
				'vertical_options' 	 => "general",
				'horizontal_options' => "general",
				'tab_slug'			 => 'advanced',
				'toggle_slug'		 => 'elements_layout',
				'sub_toggle'		 => 'search',
			)
		);

		/**
		 * Add the element warning fields.
		 * 
		 * dvmm_search_disabled__layout
		 * dvmm_search_disabled__layout_f
		 */
		$element_warning_fields = $module->helpers()->add_element_warning_fields( 
			array(
				'element_name' 	=> "Search",
				'element_slug' 	=> "search",
				// 'tab_slug'		=> 'advanced',
				// 'toggle_slug'	=> 'elements_layout',
			)
		);

		// merge fields arrays
		$fields = array_merge(
			$element_fields,
			$element_column_layout_fields,
			$element_column_design_fields,
			$element_warning_fields,
			$fields
		);

        return $fields;
    }

    /**
	 * Advanced fields.
	 */
	public function get_advanced_fields_config() {
        
        // module class
		$this->main_css_element = '%%order_class%%';

		// advanced fields
        $advanced_fields = array();

        return $advanced_fields;

	}

	/**
	 * Custom CSS fields.
	 *
	 * @since v1.0.0
	 *
	 * @param	object	$module		Module object.
	 * 
	 * @return array
	 */
    public function get_custom_css_fields_config( $module ) {

		// selectors
		$dvmm_menu_inner_container = "{$module->main_css_element} .dvmm_menu_inner_container";

		$custom_css_fields = array(
			'dvmm_search_field_css' => array(
				'label'    => esc_html__( 'Search Field', 'dvmm-divi-mad-menu' ),
				'selector' => "{$dvmm_menu_inner_container} .dvmm_search__form-input",
				'show_if'         => array(
					'dvmm_enable_search'	=> 'on',
				),
			),
			'dvmm_search_field_css_f' => array(
				'label'    => esc_html__( 'Search Field (Fixed)', 'dvmm-divi-mad-menu' ),
				'selector' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__form-input",
				'show_if'         => array(
					'dvmm_enable_search'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
			),
			'dvmm_search_x_icon_css' => array(
				'label'    => esc_html__( 'Search X Icon', 'dvmm-divi-mad-menu' ),
				'selector' => "{$dvmm_menu_inner_container} .dvmm_search__button-close",
				'show_if'         => array(
					'dvmm_enable_search'	=> 'on',
				),
			),
			'dvmm_search_x_icon_css_f' => array(
				'label'    => esc_html__( 'Search X Icon (Fixed)', 'dvmm-divi-mad-menu' ),
				'selector' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__button-close",
				'show_if'         => array(
					'dvmm_enable_search'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
			),
		);

		return $custom_css_fields;
    }

	/**
	 * Search CSS styles.
	 * 
	 * @since	v1.0.0
	 * 
	 * @param	object	$module			Module object.
	 * @param	string	$render_slug	Module slug.
	 */
	public function css( $module, $render_slug ){

		// SELECTORS
		$dvmm_menu_inner_container 	= "{$module->main_css_element} .dvmm_menu_inner_container";
		$dvmm_search_button__wrap 	= "{$module->main_css_element} .dvmm_search_button__wrap";
		$placeholder_normal			= "{$dvmm_menu_inner_container} .dvmm_search__form-input::placeholder";
		$placeholder_normal_hover	= "{$dvmm_menu_inner_container} .dvmm_search__form-input:hover::placeholder";
		$placeholder_fixed			= "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__form-input::placeholder";
		$placeholder_fixed_hover	= "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__form-input:hover::placeholder";

		// Search visibility
		$module->helpers()->declare_element_responsive_visibility_css( 
			$module->props, 
			"dvmm_show_search_icon",
			"{$dvmm_search_button__wrap}",
			$render_slug
		);

		// Search order (range)
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_search_order',
			'selector' 			=> $dvmm_search_button__wrap,
			'property' 			=> 'order',
			'additional_css'	=> '',
			'field_type'		=> '', // don't set for 'range' field type
			'priority'			=> ''
		));

		// Search column width
		$module->helpers()->declare_element_column_width_css( $module->props, $render_slug, array( 
			'setting' 		=> 'dvmm_search_col_width',
			'setting_fixed'	=> 'dvmm_search_col_width_f',
			'selector' 		=> array(
				'normal'	=> "{$module->main_css_element} .dvmm_search_button__wrap",
				'fixed'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_search_button__wrap",
			),
		));

		// Search column max-width
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_search_col_max_width',
			'setting_fixed'		=> 'dvmm_search_col_max_width_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'	=> "{$module->main_css_element} .dvmm_search_button__wrap",
				'fixed'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_search_button__wrap",
			),
			'property' 			=> 'max-width',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Search column background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_search_col_bg_color',
			'setting_fixed'		=> 'dvmm_search_col_bg_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_search_button__wrap",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_search_button__wrap:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_search_button__wrap",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_search_button__wrap:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Search vertical alignment
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_search_vertical_alignment',
			'setting_fixed'		=> 'dvmm_search_vertical_alignment_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'	=> "{$module->main_css_element} .dvmm_search_button__wrap",
				'fixed'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_search_button__wrap",
			),
			'property' 			=> 'align-items',
			'additional_css'	=> '',
			'field_type'		=> 'select',
			'priority'			=> ''
		));

		// Search horizontal alignment
		$module->helpers()->declare_element_content_horizontal_alignment_css( $module->props, $render_slug, array( 
			'setting' 		=> 'dvmm_search_horizontal_alignment',
			'setting_fixed'	=> 'dvmm_search_horizontal_alignment_f',
			'selector' 		=> array(
				'normal'			=> "{$module->main_css_element} .dvmm_search_button__wrap", // container
				'normal_stretch'	=> "{$module->main_css_element} .dvmm_search_button__wrap .dvmm_search__button", // item(content)
				'fixed'				=> "{$module->main_css_element} .dvmm_fixed .dvmm_search_button__wrap",
				'fixed_stretch'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_search_button__wrap .dvmm_search__button",
			),
		));

		// Search button margin
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_search_btn_margin',
			'setting_fixed'		=> 'dvmm_search_btn_margin_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$dvmm_menu_inner_container} .dvmm_search__button",
				'normal_hover'	=> "{$dvmm_menu_inner_container} .dvmm_search__button:hover",
				'fixed'			=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__button",
				'fixed_hover'	=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__button:hover",
			),
			'property' 			=> 'margin',
			'additional_css'	=> '',
			'field_type'		=> 'custom_margin',
			'priority'			=> ''
		));	
		// Search button padding
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_search_btn_padding',
			'setting_fixed'		=> 'dvmm_search_btn_padding_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$dvmm_menu_inner_container} .dvmm_search__button",
				'normal_hover'	=> "{$dvmm_menu_inner_container} .dvmm_search__button:hover",
				'fixed'			=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__button",
				'fixed_hover'	=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__button:hover",
			),
			'property' 			=> 'padding',
			'additional_css'	=> '',
			'field_type'		=> 'custom_padding',
			'priority'			=> ''
		));
		// Search icon size (open)
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_search_icon_size',
			'setting_fixed'		=> 'dvmm_search_icon_size_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$dvmm_menu_inner_container} .dvmm_icon.dvmm_search__button",
				'normal_hover'	=> "{$dvmm_menu_inner_container} .dvmm_icon.dvmm_search__button:hover",
				'fixed'			=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_icon.dvmm_search__button",
				'fixed_hover'	=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_icon.dvmm_search__button:hover",
			),
			'property' 			=> 'font-size',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));
		// Search icon color (open)
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_search_icon_color',
			'setting_fixed'		=> 'dvmm_search_icon_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$dvmm_menu_inner_container} .dvmm_icon.dvmm_search__button",
				'normal_hover'	=> "{$dvmm_menu_inner_container} .dvmm_icon.dvmm_search__button:hover",
				'fixed'			=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_icon.dvmm_search__button",
				'fixed_hover'	=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_icon.dvmm_search__button:hover",
			),
			'property' 			=> 'color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));
		// Search button background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_search_btn_background_color',
			'setting_fixed'		=> 'dvmm_search_btn_background_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$dvmm_menu_inner_container} .dvmm_search__button",
				'normal_hover'	=> "{$dvmm_menu_inner_container} .dvmm_search__button:hover",
				'fixed'			=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__button",
				'fixed_hover'	=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__button:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));
		// Search form background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_search_form_background_color',
			'setting_fixed'		=> 'dvmm_search_form_background_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$dvmm_menu_inner_container} .dvmm_search__wrap",
				'normal_hover'	=> "{$dvmm_menu_inner_container} .dvmm_search__wrap:hover",
				'fixed'			=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__wrap",
				'fixed_hover'	=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__wrap:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));
		// Search X icon size (close)
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_search_x_icon_size',
			'setting_fixed'		=> 'dvmm_search_x_icon_size_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$dvmm_menu_inner_container} .dvmm_search__button-close",
				'normal_hover'	=> "{$dvmm_menu_inner_container} .dvmm_search__button-close:hover",
				'fixed'			=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__button-close",
				'fixed_hover'	=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__button-close:hover",
			),
			'property' 			=> 'font-size',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));
		// Search X icon color (close)
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_search_x_icon_color',
			'setting_fixed'		=> 'dvmm_search_x_icon_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$dvmm_menu_inner_container} .dvmm_search__button-close",
				'normal_hover'	=> "{$dvmm_menu_inner_container} .dvmm_search__button-close:hover",
				'fixed'			=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__button-close",
				'fixed_hover'	=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__button-close:hover",
			),
			'property' 			=> 'color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));
		// Search text size
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_search_text_size',
			'setting_fixed'		=> 'dvmm_search_text_size_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$dvmm_menu_inner_container} .dvmm_search__form-input",
				'normal_hover'	=> "{$dvmm_menu_inner_container} .dvmm_search__form-input:hover",
				'fixed'			=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__form-input",
				'fixed_hover'	=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__form-input:hover",
			),
			'property' 			=> 'font-size',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));
		// Search text color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_search_text_color',
			'setting_fixed'		=> 'dvmm_search_text_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$dvmm_menu_inner_container} .dvmm_search__form-input, {$placeholder_normal}",
				'normal_hover'	=> "{$dvmm_menu_inner_container} .dvmm_search__form-input:hover, {$placeholder_normal_hover}",
				'fixed'			=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__form-input, {$placeholder_fixed}",
				'fixed_hover'	=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__form-input:hover, {$placeholder_fixed_hover}",
			),
			'property' 			=> 'color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));
		// Search field background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_search_field_bg_color',
			'setting_fixed'		=> 'dvmm_search_field_bg_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$dvmm_menu_inner_container} .dvmm_search__form-input",
				'normal_hover'	=> "{$dvmm_menu_inner_container} .dvmm_search__form-input:hover, {$dvmm_menu_inner_container} .dvmm_search__form-input:focus",
				'fixed'			=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__form-input",
				'fixed_hover'	=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__form-input:hover, {$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__form-input:focus",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));
	}

	/**
	 * Manage the search button wrap classes.
	 * Manages the CSS classes of the .dvmm_search_button__wrap.
	 * 
	 * @since   v1.0.0
	 * 
	 * @param	object	$module				Module object.
     * @param   array	$processed_props	Processed props.
	 * 
	 * @return	array						Menu search button wrapper CSS classes.
	 */
	public function manage_search_wrap_classes( $module, $processed_props ){

		// props
		$is_fixed_enabled 		= $processed_props['is_fixed_enabled'];
		$use_fixed_search_img 	= $module->props['dvmm_use_fixed_search_img'];

		$search_hide_class = '';

		// menu search button wrapper classes array (.dvmm_search_button__wrap)
		$search_wrap_classes = ['dvmm_element', 'dvmm_search_button__wrap'];

		// Maybe hide this element when search form appears
		$search_hide_elems_class = $module->helpers()->maybe_hide_element_when_search_opens($module->props, 'search');

		// add fixed header search image class if enabled
		if( $is_fixed_enabled === true && $use_fixed_search_img === 'on' ){
			$use_fixed_search_img_class = 'dvmm_fixed_image_enabled';
			$search_wrap_classes[] = $use_fixed_search_img_class;
		}

		// add to search button wrapper classes array
		$search_wrap_classes[] = $search_hide_class;
		$search_wrap_classes[] = $search_hide_elems_class;

		return $search_wrap_classes;
	}

    /**
     * Manage the search button classes.
	 * Manages the CSS classes of the .dvmm_search__button.
     * 
     * @since   v1.0.0
     * 
	 * @param   array	$module		Module object.
     * @return	array				Menu search button CSS classes.
     */
	public function manage_search_classes( $module ){

		$search_icon_image = $module->props['dvmm_search_icon_image'];

		// menu search button classes array (.dvmm_search__button)
		$search_classes = ['dvmm_icon', 'dvmm_search__button'];

		// search icon/image class
		$search_icon_image_class = $search_icon_image === 'image' ? "dvmm_search--image" : "dvmm_search--icon";

		// add to search button classes array
		$search_classes[] = $search_icon_image_class;

		return $search_classes;
	}
    
    /**
	 * Render search button.
	 *
	 * @since v1.0.0
	 *
	 * @param   array       $module             Module object.
     * @param   array       $processed_props	Processed props.
     * @param   string      $render_slug        Module slug.
	 * 
	 * @return string							Search button HTML.
	 */
	public function render_search( $module, $processed_props, $render_slug ) {

		// return empty if this element is disabled or not visible
        if ( ! $module->helpers()->maybe_render_element( $module->props, 'search' ) ) {
			return '';
		}

		// get search button wrapper classes
		$search_wrap_classes = implode(' ', $this->manage_search_wrap_classes( $module, $processed_props ) );

		// get search button classes
		$search_classes = implode(' ', $this->manage_search_classes( $module ) );

		// normal header search image icon
		$multi_view	= et_pb_multi_view_options( $module );
		$search_img_html = $multi_view->render_element( array(
			'tag'            => 'img',
			'attrs'          => array(
				'src' => '{{dvmm_search_img}}',
			),
			'classes'		 => array(
				'dvmm_search_img' => array(
					'dvmm_enable_search' 	 => 'on',
					'dvmm_search_icon_image' => 'image',
				)
			),
			'required'       => array(
				'dvmm_enable_search' 	 => 'on',
				'dvmm_search_icon_image' => 'image',
			),
			'hover_selector' => '%%order_class%% .dvmm_menu_inner_container .dvmm_search__button',
		) );

		// fixed header search image icon
		$multi_view_f	= et_pb_multi_view_options( $module );
		$search_img_html .= $multi_view_f->render_element( array(
			'tag'            => 'img',
			'attrs'          => array(
				'src' => '{{dvmm_search_img_f}}',
			),
			'classes'		 => array(
				'dvmm_search_img__fixed' 	=> array(
					'dvmm_enable_fixed_header' 	=> 'on',
					'dvmm_search_icon_image' 	=> 'image',
					'dvmm_use_fixed_search_img' => 'on',
				)
			),
			'required'       => array(
				'dvmm_enable_search' 	 	=> 'on',
				'dvmm_enable_fixed_header' 	=> 'on',
				'dvmm_search_icon_image' 	=> 'image',
				'dvmm_use_fixed_search_img' => 'on',
			),
			'hover_selector' => '%%order_class%% .dvmm_menu_inner_container .dvmm_search__button',
		) );

		return sprintf(
			'<div class="%1$s">
				<button type="button" class="%2$s">%3$s</button>
			</div>',
			esc_attr( $search_wrap_classes ),
			esc_attr( $search_classes ),
			et_core_esc_previously( $search_img_html )
		);
	}

	/**
	 * Render search form.
	 *
	 * @since v1.0.0
	 *
	 * @param   array       $module             Module object.
     * @param   array       $processed_props	Processed props.
     * @param   string      $render_slug        Module slug.
	 * 
	 * @return string
	 */
	public function render_search_form( $module, $processed_props, $render_slug ) {

		// return empty if this element is disabled or not visible
        if ( ! $module->helpers()->maybe_render_element( $module->props, 'search' ) ) {
			return '';
		}

		return sprintf(
			'<div class="dvmm_search__wrap dvmm--disabled">
				<div class="dvmm_search">
					<form role="search" method="get" class="dvmm_search__form" action="%1$s">
						<input type="search" class="dvmm_search__form-input" placeholder="%2$s" name="s" title="%3$s" />
					</form>
					<button type="button" class="dvmm_icon dvmm_search__button-close"></button>
				</div>
			</div>',
			esc_url( home_url( '/' ) ),
			esc_attr__( $module->props['placeholder_text'], 'dvmm-divi-mad-menu' ),
			esc_attr__( 'Search for:', 'dvmm-divi-mad-menu' )
		);
	}
}

/**
 * Intstantiates the DVMM_Menu_Search class.
 * 
 * @since   1.0.0
 * 
 * @return  Instance of the DVMM_Menu_Search class.
 * 
 */
function dvmm_menu_search_class_instance( ) {
	return DVMM_Menu_Search::instance( );
}

