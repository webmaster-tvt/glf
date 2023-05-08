<?php

// Die if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Mobile Menu Toggle (Hamburger).
 * 
 * Generates the menu toggle(.dvmm_mobile_menu_toggle), it's CSS classes and data attributes.
 *
 * @since   1.0.0 
 * 
 */
class DVMM_Mobile_Menu_Toggle {

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
			'dvmm_toggle_format' => array(
				'label'           	=> esc_html__( 'Toggle Format', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Select the mobile menu toggle format.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'basic_option',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'options'         	=> array(
					'icon_only'			=> esc_html__( 'Icon', 'dvmm-divi-mad-menu' ),
					'label_only'		=> esc_html__( 'Label', 'dvmm-divi-mad-menu' ),
					'icon_and_label'	=> esc_html__( 'Icon and Label', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'icon_only',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'mobile_menu_toggle',
			),
			'dvmm_toggle_text' 	=> array(
				'label'            	=> esc_html__( 'Toggle Label (Closed)', 'dvmm-divi-mad-menu' ),
				'description'      	=> esc_html__( 'Input the text you would like to appear next to the closed mobile menu toggle icon.', 'dvmm-divi-mad-menu' ),
				'type'             	=> 'text',
				'mobile_options'   	=> true,
				'hover'            	=> 'tabs',
				'option_category'  	=> 'basic_option',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu' => 'on',
				),
				'show_if_not'			=> array(
					'dvmm_toggle_format' => 'icon_only',
				),
				'default'       	=> esc_html__( 'Menu', 'dvmm-divi-mad-menu' ),
				// 'dynamic_content'  	=> 'text',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'mobile_menu_toggle',
			),
			'dvmm_toggle_text_open' 	=> array(
				'label'            	=> esc_html__( 'Toggle Label (Opened)', 'dvmm-divi-mad-menu' ),
				'description'      	=> esc_html__( 'Input the text you would like to appear next to the open mobile menu toggle icon.', 'dvmm-divi-mad-menu' ),
				'type'             	=> 'text',
				'mobile_options'   	=> true,
				'hover'            	=> 'tabs',
				'option_category'  	=> 'basic_option',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu' => 'on',
				),
				'show_if_not'			=> array(
					'dvmm_toggle_format' => 'icon_only',
				),
				'default'       	=> esc_html__( 'Close', 'dvmm-divi-mad-menu' ),
				// 'dynamic_content'  	=> 'text',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'mobile_menu_toggle',
			),
			'dvmm_toggle_text_position' => array(
				'label'           	=> esc_html__( 'Toggle Label Position', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Here you can change the toggle label position relative to the toggle icon (hamburger icon).', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'option_category'	=> 'basic_option',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_toggle_format'		=> 'icon_and_label',
				),
				'options'         	=> array(
					'column'			=> esc_html__( 'Above', 'dvmm-divi-mad-menu' ),
					'row-reverse'     	=> esc_html__( 'Right', 'dvmm-divi-mad-menu' ),
					'column-reverse'	=> esc_html__( 'Below', 'dvmm-divi-mad-menu' ),
					'row'      			=> esc_html__( 'Left', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'row',
				'priority'          => 100,
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'mobile_menu_toggle',
			),
			'dvmm_toggle_icon_size' => array(
				'label'				=> esc_html__( 'Menu Toggle Icon Size', 'dvmm-divi-mad-menu' ),
				'description'		=> esc_html__( 'Set the mobile menu toggle icon size.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'range',
				'mobile_options'	=> true,
				'responsive'		=> true,
				'hover'           	=> 'tabs',
				'option_category'	=> 'font_option',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu' => 'on',
				),
				'default'           => '32px',
				'default_unit'     	=> 'px',
				'range_settings'   	=> array(
					'min'  => '1',
					'max'  => '120',
					'step' => '1',
				),
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'menu_toggle_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_toggle_icon_size_f' => array(
				'label'				=> esc_html__( 'Menu Toggle Icon Size (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'		=> esc_html__( 'Set the fixed header mobile menu toggle icon size.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'range',
				'mobile_options'	=> true,
				'responsive'		=> true,
				'hover'           	=> 'tabs',
				'option_category'	=> 'font_option',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu' => 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'default'           => '',
				'default_unit'     	=> 'px',
				'range_settings'   	=> array(
					'min'  => '1',
					'max'  => '120',
					'step' => '1',
				),
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'menu_toggle_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_toggle_icon_color' => array(
				'label'           	=> esc_html__( 'Menu Toggle Icon Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the mobile menu toggle icon color (the hamburger icon color).', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'menu_toggle_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_toggle_icon_color_f' => array(
				'label'           	=> esc_html__( 'Menu Toggle Icon Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header mobile menu toggle icon color (the hamburger icon color).', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'       => 'menu_toggle_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_toggle_bg_color' => array(
				'label'           	=> esc_html__( 'Menu Toggle Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the mobile menu toggle background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'menu_toggle_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_toggle_bg_color_f' => array(
				'label'           	=> esc_html__( 'Menu Toggle Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header mobile menu toggle background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'       => 'menu_toggle_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_toggle_margin' => array(
				'label'             => esc_html__('Menu Toggle Margin', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'default'           => '5px|5px|5px|5px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'menu_toggle_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_toggle_margin_f' => array(
				'label'             => esc_html__('Menu Toggle Margin (Fixed)', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				// 'default'           => '5px|5px|5px|5px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'menu_toggle_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_toggle_padding' => array(
				'label'             => esc_html__('Menu Toggle Padding', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_padding',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'default'           => '2px|2px|2px|2px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'menu_toggle_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_toggle_padding_f' => array(
				'label'             => esc_html__('Menu Toggle Padding (Fixed)', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_padding',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				// 'default'           => '2px|2px|2px|2px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'menu_toggle_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_toggle_text_margin' => array(
				'label'             => esc_html__('Menu Toggle Text Margin', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'show_if_not'			=> array(
					'dvmm_toggle_format' => 'icon_only',
				),
				'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'menu_toggle_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_toggle_text_margin_f' => array(
				'label'             => esc_html__('Menu Toggle Text Margin (Fixed)', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'show_if_not'			=> array(
					'dvmm_toggle_format' => 'icon_only',
				),
				// 'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'menu_toggle_design',
				'sub_toggle'		=> 'fixed',
			),
		);

		/**
		 * Add the element alignment fields.
		 * 
		 * dvmm_toggle_vertical_alignment
		 * dvmm_toggle_vertical_alignment_f
		 * dvmm_toggle_horizontal_alignment
		 * dvmm_toggle_horizontal_alignment_f
		 */
		$element_fields = $module->helpers()->add_element_alignment_fields( 
			array(
				'element_name' 		 => "Mobile Menu Toggle",
				'element_slug' 		 => "mobile_menu", /* required, do not change */
				'setting_base' 		 => "toggle",
				'vertical_options' 	 => "general",
				'horizontal_options' => "general",
				'tab_slug'			 => 'advanced',
				'toggle_slug'		 => 'elements_layout',
				'sub_toggle'		 => 'mobile_menu',
			)
		);

		// merge fields arrays
		$fields = array_merge(
			$element_fields,
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
	 * @return 	array
	 */
    public function get_custom_css_fields_config( $module ) {

		// selectors
		$dvmm_menu_inner_container = "{$module->main_css_element} .dvmm_menu_inner_container";

		$custom_css_fields = array(
			'dvmm_toggle_text_css' => array(
				'label'    => esc_html__( 'Menu Toggle Label', 'dvmm-divi-mad-menu' ),
				'selector' => "{$module->main_css_element} .dvmm_toggle_text",
				'show_if'         => array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'show_if_not'			=> array(
					'dvmm_toggle_format' => 'icon_only',
				),
			),
			'dvmm_toggle_text_css_f' => array(
				'label'    => esc_html__( 'Menu Toggle Label (Fixed)', 'dvmm-divi-mad-menu' ),
				'selector' => "{$module->main_css_element} .dvmm_fixed .dvmm_toggle_text",
				'show_if'         => array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'show_if_not'			=> array(
					'dvmm_toggle_format' => 'icon_only',
				),
			),
			'dvmm_toggle_icon_css' => array(
				'label'    => esc_html__( 'Menu Toggle Icon', 'dvmm-divi-mad-menu' ),
				'selector' => "{$module->main_css_element} .dvmm_mobile_menu_toggle_icon",
				'show_if'         => array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'show_if_not'			=> array(
					'dvmm_toggle_format' => 'label_only',
				),
			),
			'dvmm_toggle_icon_css_f' => array(
				'label'    => esc_html__( 'Menu Toggle Icon (Fixed)', 'dvmm-divi-mad-menu' ),
				'selector' => "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle_icon",
				'show_if'         => array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'show_if_not'			=> array(
					'dvmm_toggle_format' => 'label_only',
				),
			),
		);

		return $custom_css_fields;
    }

	/**
	 * Menu Toggle CSS styles.
	 * 
	 * @since	v1.0.0 (updated in v1.3.3)
	 * 
	 * @param	object	$module				Module object.
	 * @param	array	$processed_props	Processed props.
	 * @param	string	$render_slug		Module slug.
	 */ 
	public static function css( $module, $processed_props, $render_slug ){

		/**
		 * Processed props
		 */
		$additional_css	= isset($processed_props['additional_css']) ? $processed_props['additional_css'] : '';

		/**
		 * Selectors
		 */
		$dvmm_mobile_menu_toggle = "{$module->main_css_element} .dvmm_mobile_menu_toggle";

		// Menu toggle label position
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_toggle_text_position',
			'selector' 			=> $dvmm_mobile_menu_toggle,
			'property' 			=> 'flex-flow',
			'additional_css'	=> '',
			'field_type'		=> 'select',
			'priority'			=> ''
		));

		// Menu toggle vertical alignment
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_toggle_vertical_alignment',
			'setting_fixed'		=> 'dvmm_toggle_vertical_alignment_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'	=> "{$module->main_css_element} .dvmm_mobile__menu",
				'fixed'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu",
			),
			'property' 			=> 'align-items',
			'additional_css'	=> '',
			'field_type'		=> 'select',
			'priority'			=> ''
		));

		// Menu toggle horizontal alignment
		$module->helpers()->declare_element_content_horizontal_alignment_css( $module->props, $render_slug, array( 
			'setting' 		=> 'dvmm_toggle_horizontal_alignment',
			'setting_fixed'	=> 'dvmm_toggle_horizontal_alignment_f',
			'selector' 		=> array(
				'normal'			=> "{$module->main_css_element} .dvmm_mobile__menu", // container
				'normal_stretch'	=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_mobile_menu_toggle", // item(content)
				'fixed'				=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu",
				'fixed_stretch'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_mobile_menu_toggle",
			),
		));

		// Mobile Menu Toggle icon size
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_toggle_icon_size',
			'setting_fixed'		=> 'dvmm_toggle_icon_size_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile_menu_toggle_icon",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile_menu_toggle:hover .dvmm_mobile_menu_toggle_icon",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle_icon",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle:hover .dvmm_mobile_menu_toggle_icon",
			),
			'property' 			=> 'font-size',
			'additional_css'	=> '',
			'field_type'		=> '', // don't set for 'range' field type
			'priority'			=> ''
		));

		// Mobile Menu Toggle icon color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_toggle_icon_color',
			'setting_fixed'		=> 'dvmm_toggle_icon_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile_menu_toggle_icon",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile_menu_toggle:hover .dvmm_mobile_menu_toggle_icon",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle_icon",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle:hover .dvmm_mobile_menu_toggle_icon",
			),
			'property' 			=> 'color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Menu Toggle background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_toggle_bg_color',
			'setting_fixed'		=> 'dvmm_toggle_bg_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile_menu_toggle",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile_menu_toggle:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Menu Toggle margin
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_toggle_margin',
			'setting_fixed'		=> 'dvmm_toggle_margin_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile_menu_toggle",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile_menu_toggle:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle:hover",
			),
			'property' 			=> 'margin',
			'additional_css'	=> '',
			'field_type'		=> 'custom_margin',
			'priority'			=> ''
		));

		// Mobile Menu Toggle padding
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_toggle_padding',
			'setting_fixed'		=> 'dvmm_toggle_padding_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile_menu_toggle",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile_menu_toggle:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle:hover",
			),
			'property' 			=> 'padding',
			// 'additional_css'	=> '',
			'additional_css'	=> "{$additional_css}", // for DBP
			'field_type'		=> 'custom_padding',
			'priority'			=> ''
		));

		// Mobile Menu Toggle Text margin
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_toggle_text_margin',
			'setting_fixed'		=> 'dvmm_toggle_text_margin_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile_menu_toggle .dvmm_toggle_text",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile_menu_toggle:hover .dvmm_toggle_text",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle .dvmm_toggle_text",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle:hover .dvmm_toggle_text",
			),
			'property' 			=> 'margin',
			'additional_css'	=> '',
			'field_type'		=> 'custom_margin',
			'priority'			=> ''
		));

	}
    
    /**
     * Manage the menu toggle classes.
	 * Manages the CSS classes of the .dvmm_mobile_menu_toggle container.
     * 
     * @since   v1.0.0
     * 
	 * @param	object	$module				    Module object.
	 * @param	array	$processed_props	    Processed props.
     * @return	array	$menu_toggle_classes    Menu toggle CSS classes.
     */
	static function css_classes( $module, $processed_props = array() ){
		
		// menu toggle classes array (.dvmm_mobile_menu_toggle)
        $menu_toggle_classes = ['dvmm_mobile_menu_toggle'];

		// add menu toggle classes
		// array_push( $menu_toggle_classes,
		// 	
		// );

		return $menu_toggle_classes;
    }
    
    /**
     * Manage the menu toggle data attributes.
	 * Manages the data attributes of the .dvmm_mobile_menu_toggle container.
     * 
     * @since   v1.0.0
     * 
	 * @param	array	$processed_props	    		Processed props.
	 * 
     * @return	array	$menu_toggle_data_attributes  	Menu toggle data attributes.
     */
	static function data_attributes( $processed_props = array() ){

		/**
         * PROPS
         */
		$menu_id 				= $processed_props['dvmm_m_menu_id']['desktop'];
		$menu_id_tablet 		= $processed_props['dvmm_m_menu_id']['tablet'];
		$menu_id_phone 			= $processed_props['dvmm_m_menu_id']['phone'];
		$menu_id_responsive 	= $processed_props['dvmm_m_menu_id']['responsive'];

		// menu toggle data attributes array (.dvmm_mobile_menu_toggle)
        $menu_toggle_data_attributes 	= [];
        
		// selected mobile menu ids for each device: desktop|tablet|phone|responsive
		$selected_menu_ids = $menu_id_responsive === 'on' ? "{$menu_id}|{$menu_id_tablet}|{$menu_id_phone}|{$menu_id_responsive}" : "{$menu_id}|{$menu_id_responsive}";
		$selected_menu_ids_data = sprintf( 'data-selected_menu_ids="%1$s"', esc_attr( $selected_menu_ids ) );

		// add menu toggle data attributes
		array_push( $menu_toggle_data_attributes,
			$selected_menu_ids_data
		);

		return $menu_toggle_data_attributes;

	}

	/**
	 * Render menu toggle.
	 *
	 * @since v1.0.0
	 * 
	 * @param	object	$module				Module object.
	 * @param	array	$processed_props	Processed props.
	 * @param	string	$render_slug		Module slug.
	 *
	 * @return string
	 */
	public function render( $module, $processed_props, $render_slug ) {

		/**
		 * Props
		 */
		// mobile menu toggle format
		$dvmm_toggle_format = $module->props['dvmm_toggle_format'];

		// multi view
		$multi_view	= et_pb_multi_view_options( $module );

		// CLOSED mobile menu toggle label
		$toggle_text = $multi_view->render_element( array(
			// 'tag'	  => 'span',
			'content' => '{{dvmm_toggle_text}}',
			'attrs'	  => array(
				'class' => 'dvmm_toggle_text--closed',
			),
			'required'	=> array(
				'dvmm_enable_mobile_menu'	=> 'on',
			),
			'hover_selector' => '%%order_class%% .dvmm_mobile_menu_toggle',
		) );

		// OPEN mobile menu toggle label
		$toggle_text_open = $multi_view->render_element( array(
			// 'tag'	  => 'span',
			'content' => '{{dvmm_toggle_text_open}}',
			'attrs'	  => array(
				'class' => 'dvmm_toggle_text--open',
			),
			'required'	=> array(
				'dvmm_enable_mobile_menu'	=> 'on',
			),
			'hover_selector' => '%%order_class%% .dvmm_mobile_menu_toggle',
		) );

		// menu toggle label container
		$dvmm_toggle_text_container = $dvmm_toggle_format !== 'icon_only' ? sprintf(
			'<span class="dvmm_toggle_text">%1$s%2$s</span>',
			et_core_esc_previously( $toggle_text ),
			et_core_esc_previously( $toggle_text_open )
		) : '';

		// menu toggle icon container
		$dvmm_toggle_icon_container = $dvmm_toggle_format !== 'label_only' ? '<span class="dvmm_mobile_menu_toggle_icon"></span>' : '';

		// get the menu toggle classes
		$menu_toggle_classes = implode(' ', self::css_classes( $module, $processed_props ) );

		// get the menu toggle data attributes
		$menu_toggle_data_attrs = implode(' ', self::data_attributes( $processed_props ) );

		return sprintf(
			'<a href="#" class="%1$s" %2$s> %3$s %4$s </a>',
			esc_attr( $menu_toggle_classes ),
			$menu_toggle_data_attrs,
			et_core_esc_previously( $dvmm_toggle_text_container ),
			et_core_esc_previously( $dvmm_toggle_icon_container )
		);
	}
}

/**
 * Intstantiates the DVMM_Mobile_Menu_Toggle class.
 * 
 * @since   1.0.0
 * 
 * @return  Instance of the DVMM_Mobile_Menu_Toggle class.
 * 
 */
function dvmm_mobile_menu_toggle_class_instance( ) {
	return DVMM_Mobile_Menu_Toggle::instance( );
}