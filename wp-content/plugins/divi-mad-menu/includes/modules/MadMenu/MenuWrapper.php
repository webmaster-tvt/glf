<?php

// Die if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Menu Wrapper.
 * 
 * Generates the menu wrapper(.dvmm_menu__wrap) CSS classes and data attributes.
 *
 * @since   1.0.0 
 * 
 */
class DVMM_Menu_Wrapper {

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
	 * Horizontal Menu.
	 * Returns the horizontal menu class instance.
	 * 
	 * @since	1.0.0
	 * 
	 * @return	DVMM_Horizontal_Menu
	 */
	public function horizontal_menu(){
		return dvmm_horizontal_menu_class_instance();
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
			'dvmm_enable_menu' => array(
				'label'           => esc_html__( 'Enable Desktop Menu', 'dvmm-divi-mad-menu' ),
				'description'     => esc_html__( 'Add the Desktop Menu element to the header.', 'dvmm-divi-mad-menu' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'affects'		=> $module->helpers()->dvmm_enable_element__affects('menu'),
				'default'       => 'on',
				'tab_slug'      => 'general',
				'toggle_slug'	=> 'header_elements',
			),
			'dvmm_show_menu' => array(
				'label'           => esc_html__( 'Show Desktop Menu', 'dvmm-divi-mad-menu' ),
				'description'     => esc_html__( 'Set the Desktop Menu element responsive visibility.', 'dvmm-divi-mad-menu' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'show_if'			=> array(
					'dvmm_enable_menu'	=> 'on',
				),
				'mobile_options'  => true,
				'responsive'      => true,
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'       => 'on',
				'tab_slug'		=> 'custom_css',
				'toggle_slug'	=> 'visibility',
			),
			'dvmm_dd_direction' => array(
				'label'           	=> esc_html__( 'Dropdown Direction', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Here you can choose the direction that your submenus will open(downwards or upwards).', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'basic_option',
				// 'show_if_not'			=> array(
				// 	'dvmm_enable_menu'	=> 'off',
				// 	'dvmm_enable_mobile_menu'	=> 'off',
				// ),
				'options'         	=> array(
					'downwards'	=> esc_html__( 'Downwards', 'dvmm-divi-mad-menu' ),
					'upwards'	=> esc_html__( 'Upwards', 'dvmm-divi-mad-menu' ),
					'auto'		=> esc_html__( 'Auto', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'downwards',
				'priority'          => 100,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'general_layout',
			),
			'dvmm_menu_order' => array(
				'label'			=> esc_html__( 'Desktop Menu Order', 'dvmm-divi-mad-menu' ),
				'description'	=> esc_html__( 'Here you can set the element order. Element order is set relatively to other enabled elements, a higher order number moves the element closer to the right hand side of the header.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'range',
                'mobile_options'	=> true,
                'responsive'		=> true,
				'option_category'	=> 'layout',
				'show_if'			=> array(
					'dvmm_enable_menu' => 'on',
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

		);

		/**
		 * Add the element column layout fields.
		 * 
		 * dvmm_menu_col_width
		 * dvmm_menu_col_width_f
		 * dvmm_menu_col_max_width
		 * dvmm_menu_col_max_width_f
		 */
		$element_column_layout_fields = $module->helpers()->add_element_column_layout_fields( 
			array(
				'element_name' 	=> "Desktop Menu",
				'element_slug' 	=> "menu",
				'tab_slug'		=> 'advanced',
				'toggle_slug'	=> 'elements_layout',
				'sub_toggle'	=> 'menu',
			)
		);

		/**
		 * Add the element column design fields.
		 * 
		 * dvmm_menu_col_bg_color
		 * dvmm_menu_col_bg_color_f
		 */
		$element_column_design_fields = $module->helpers()->add_element_column_design_fields( 
			array(
				'element_name' 	=> "Menu",
				'element_slug' 	=> "menu",
				'tab_slug'		=> 'advanced',
				'toggle_slug'	=> 'menu_design',
			)
		);

		/**
		 * Add the element warning fields.
		 * 
		 * dvmm_menu_disabled__layout
		 * dvmm_menu_disabled__layout_f
		 */
		$element_warning_fields = $module->helpers()->add_element_warning_fields( 
			array(
				'element_name' 	=> "Desktop Menu",
				'element_slug' 	=> "menu",
				// 'tab_slug'		=> 'advanced',
				// 'toggle_slug'	=> 'elements_layout',
			)
		);

		// merge fields arrays
		$fields = array_merge(
			$element_column_layout_fields,
			$element_column_design_fields,
			$element_warning_fields,
			$fields
		);

        return $fields;
    }

    /**
	 * Advanced fields.
	 * 
	 * @since v1.0.0 
	 * 
	 * @param	object	$module		Module object.
	 * 
	 */
	public function get_advanced_fields_config($module) {

		// selectors
		$dvmm_menu_inner_container = "{$module->main_css_element} .dvmm_menu_inner_container";
		$dvmm_fixed 		= "{$module->main_css_element} .dvmm_fixed"; // fixed header
		$dvmm_menu 			= "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu"; // menu <ul> tag
		$dvmm_menu__fixed 	= "{$dvmm_fixed} .dvmm_menu__menu .dvmm_menu"; // fixed menu <ul> tag
		$dvmm_mobile_menu 			= "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu"; // mobile menu <ul> tag
		$dvmm_mobile_menu__fixed 	= "{$dvmm_fixed} .dvmm_mobile__menu .dvmm_menu"; // fixed mobile menu <ul> tag

		// advanced fields
        $advanced_fields = array(
			'fonts'      => array(
				'dvmm_menu' => array(
					'label'           => esc_html__( 'Menu Items', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$dvmm_menu} li a",
						'limited_main' 	=> "{$dvmm_menu} li a",
						'hover'        	=> "{$dvmm_menu} li:hover > a",
						'font_size'		=> "{$dvmm_menu} li",
					),
					'line_height'     => array(
						'default' => '1em',
					),
					'font_size'       => array(
						'default'        => '14px',
						'range_settings' => array(
							'min'  => '12',
							'max'  => '24',
							'step' => '1',
						),
					),
					'letter_spacing'  => array(
						'default'        => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					'hide_text_align' => true,
					'hide_text_shadow' => true, // HIDE for now
					'depends_show_if'	=> 'on',
					'depends_on'      => array(
						'dvmm_enable_menu',
					),
					// 'show_if' => array( 		// DOESN'T WORK
					// 	'dvmm_enable_menu' => 'on',
					// ),
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'menu_text',
					'sub_toggle'  => 'normal',
				),
				'dvmm_menu_f' => array(
					'label'           => esc_html__( 'Menu Items (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$dvmm_menu__fixed} li a",
						'limited_main' 	=> "{$dvmm_menu__fixed} li a",
						'hover'        	=> "{$dvmm_menu__fixed} li:hover > a",
						'font_size'		=> "{$dvmm_menu__fixed} li",
					),
					'line_height'     => array(
						'default' => '1em',
					),
					'font_size'       => array(
						'default'        => '14px',
						'range_settings' => array(
							'min'  => '12',
							'max'  => '24',
							'step' => '1',
						),
					),
					'letter_spacing'  => array(
						'default'        => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					'hide_text_align' 	=> true,
					'hide_text_shadow' 	=> true,
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_menu',
						// 'dvmm_enable_fixed_header'
					),
					'tab_slug'    		=> 'advanced',
					'toggle_slug' 		=> 'menu_text',
					'sub_toggle'  		=> 'fixed',
				),
				'dvmm_submenu' => array(
					'label'           => esc_html__( 'Submenu Items', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$dvmm_menu} li li a",
						'limited_main' 	=> "{$dvmm_menu} li li a",
						'hover'        	=> "{$dvmm_menu} li li:hover > a",
						'font_size'		=> "{$dvmm_menu} li li",
					),
					'line_height'     => array(
						'default' => '1em',
					),
					'font_size'       => array(
						'default'        => '14px',
						'range_settings' => array(
							'min'  => '12',
							'max'  => '24',
							'step' => '1',
						),
					),
					'letter_spacing'  => array(
						'default'        => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					'hide_text_align' 	=> true,
					'hide_text_shadow' 	=> true,
					'depends_show_if'	=> 'on', // SEEMS TO WORK WITHOUT THIS. WHY?
					'depends_on'      => array(  // SEEMS TO WORK WITHOUT THIS. WHY?
						'dvmm_enable_menu',
					),
					'tab_slug'    		=> 'advanced',
					'toggle_slug' 		=> 'submenu_text',
					'sub_toggle'  		=> 'normal',
				),
				'dvmm_submenu_f' => array(
					'label'           => esc_html__( 'Submenu Items (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$dvmm_menu__fixed} li li a",
						'limited_main' 	=> "{$dvmm_menu__fixed} li li a",
						'hover'        	=> "{$dvmm_menu__fixed} li li:hover > a",
						'font_size'		=> "{$dvmm_menu__fixed} li li",
					),
					'line_height'     => array(
						'default' => '1em',
					),
					'font_size'       => array(
						'default'        => '14px',
						'range_settings' => array(
							'min'  => '12',
							'max'  => '24',
							'step' => '1',
						),
					),
					'letter_spacing'  => array(
						'default'        => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					'hide_text_align' => true,
					'hide_text_shadow' => true,
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'submenu_text',
					'sub_toggle'  => 'fixed',
				),
				'dvmm_menu_toggle_text' => array(
					'label'           => esc_html__( 'Menu Toggle Label', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$module->main_css_element} .dvmm_toggle_text",
						'limited_main' 	=> "{$module->main_css_element} .dvmm_toggle_text",
						'hover'        	=> "{$module->main_css_element} .dvmm_mobile_menu_toggle:hover .dvmm_toggle_text",
						'font_size'		=> "{$module->main_css_element} .dvmm_toggle_text",
					),
					'line_height'     => array(
						'default' => '1em',
					),
					'font_size'       => array(
						'default'        => '16px',
						'range_settings' => array(
							'min'  => '10',
							'max'  => '120',
							'step' => '1',
						),
					),
					'letter_spacing'  => array(
						'default'        => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					'hide_text_align' => true,
					'hide_text_shadow' => true,
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'menu_toggle_text',
					'sub_toggle'  => 'normal',
				),
				'dvmm_menu_toggle_text_f' => array(
					'label'           => esc_html__( 'Menu Toggle Label (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$module->main_css_element} .dvmm_fixed .dvmm_toggle_text",
						'limited_main' 	=> "{$module->main_css_element} .dvmm_fixed .dvmm_toggle_text",
						'hover'        	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle:hover .dvmm_toggle_text",
						'font_size'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_toggle_text",
					),
					'line_height'     => array(
						'default' => '1em',
					),
					'font_size'       => array(
						'default'        => '',
						'range_settings' => array(
							'min'  => '10',
							'max'  => '120',
							'step' => '1',
						),
					),
					'letter_spacing'  => array(
						'default'        => '',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					'hide_text_align' => true,
					'hide_text_shadow' => true,
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'menu_toggle_text',
					'sub_toggle'  => 'fixed',
				),
				'dvmm_mobile_menu' => array(
					'label'           => esc_html__( 'Mobile Menu Items', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$dvmm_mobile_menu} li a, {$module->main_css_element} .dvmm_mobile__menu .dvmm_back_text, {$module->main_css_element} .dvmm_mobile__menu .dvmm_go_back",
						'limited_main' 	=> "{$dvmm_mobile_menu} li a, {$module->main_css_element} .dvmm_mobile__menu .dvmm_back_text, {$module->main_css_element} .dvmm_mobile__menu .dvmm_go_back",
						'hover'        	=> "{$dvmm_mobile_menu} li:hover > a, {$module->main_css_element} .dvmm_mobile__menu li a:hover .dvmm_back_text, {$module->main_css_element} .dvmm_mobile__menu a:hover .dvmm_back, {$module->main_css_element} .dvmm_mobile__menu .dvmm_back_home:hover",
						'font_size'		=> "{$dvmm_mobile_menu} li a, {$module->main_css_element} .dvmm_mobile__menu .dvmm_back_text",
						'text_align'	=> "{$dvmm_mobile_menu} li a, {$module->main_css_element} .dvmm_mobile__menu .dvmm_back_text",
						'line_height'	=> "{$dvmm_mobile_menu} li a, {$module->main_css_element} .dvmm_mobile__menu .dvmm_back_text",
					),
					'line_height'     => array(
						'default' => '2em',
					),
					'font_size'       => array(
						'default'        => '14px',
						'range_settings' => array(
							'min'  => '10',
							'max'  => '100',
							'step' => '1',
						),
					),
					'letter_spacing'  => array(
						'default'        => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					// 'hide_text_align' => true,
					'hide_text_shadow' => true,
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'mobile_menu_text',
					'sub_toggle'  => 'normal',
				),
				'dvmm_mobile_menu_f' => array(
					'label'           => esc_html__( 'Mobile Menu Items (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$dvmm_mobile_menu__fixed} li a, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_back_text, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_go_back",
						'limited_main' 	=> "{$dvmm_mobile_menu__fixed} li a, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_back_text, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_go_back",
						'hover'        	=> "{$dvmm_mobile_menu__fixed} li:hover > a, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu li a:hover .dvmm_back_text, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu a:hover .dvmm_back, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_back_home:hover",
						'font_size'		=> "{$dvmm_mobile_menu__fixed} li a, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_back_text",
						'text_align'	=> "{$dvmm_mobile_menu__fixed} li a, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_back_text",
						'line_height'	=> "{$dvmm_mobile_menu__fixed} li a, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_back_text",
					),
					'line_height'     => array(
						'default' => '2em',
					),
					'font_size'       => array(
						'default'        => '14px',
						'range_settings' => array(
							'min'  => '12',
							'max'  => '24',
							'step' => '1',
						),
					),
					'letter_spacing'  => array(
						'default'        => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					// 'hide_text_align' => true,
					'hide_text_shadow' => true,
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'mobile_menu_text',
					'sub_toggle'  => 'fixed',
				),
				'dvmm_mobile_submenu' => array(
					'label'           => esc_html__( 'Mobile Submenu Items', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$dvmm_mobile_menu} li li a",
						'limited_main' 	=> "{$dvmm_mobile_menu} li li a",
						'hover'        	=> "{$dvmm_mobile_menu} li li:hover > a",
						'font_size'		=> "{$dvmm_mobile_menu} li li a",
						'text_align'	=> "{$dvmm_mobile_menu} li li a",
					),
					'line_height'     => array(
						'default' => '2em',
					),
					'font_size'       => array(
						'default'        => '14px',
						'range_settings' => array(
							'min'  => '10',
							'max'  => '100',
							'step' => '1',
						),
					),
					'letter_spacing'  => array(
						'default'        => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					// 'hide_text_align' => true,
					'hide_text_shadow' => true,
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'mobile_submenu_text',
					'sub_toggle'  => 'normal',
				),
				'dvmm_mobile_submenu_f' => array(
					'label'           => esc_html__( 'Mobile Submenu Items (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$dvmm_mobile_menu__fixed} li li a",
						'limited_main' 	=> "{$dvmm_mobile_menu__fixed} li li a",
						'hover'        	=> "{$dvmm_mobile_menu__fixed} li li:hover > a",
						'font_size'		=> "{$dvmm_mobile_menu__fixed} li li a",
						'text_align'	=> "{$dvmm_mobile_menu__fixed} li li a",
					),
					'line_height'     => array(
						'default' => '2em',
					),
					'font_size'       => array(
						'default'        => '14px',
						'range_settings' => array(
							'min'  => '10',
							'max'  => '100',
							'step' => '1',
						),
					),
					'letter_spacing'  => array(
						'default'        => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					// 'hide_text_align' => true,
					'hide_text_shadow' => true,
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'mobile_submenu_text',
					'sub_toggle'  => 'fixed',
				),
				'dvmm_button_one' => array(
					'label'           => esc_html__( 'Button One', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$module->main_css_element} .dvmm_button_one .dvmm_button_text",
						// 'limited_main' 	=> "{$module->main_css_element} .dvmm_button_one .dvmm_button_text",
						'hover'        	=> "{$module->main_css_element} .dvmm_button_one:hover .dvmm_button_text",
						'font_size'		=> "{$module->main_css_element} .dvmm_button_one .dvmm_button_text",
						'line_height'	=> "{$module->main_css_element} .dvmm_button_one .dvmm_button_text",
					),
					'line_height'     => array(
						'default' => '1em',
					),
					'font_size'       => array(
						'default'        => '20px',
						'range_settings' => array(
							'min'  => '10',
							'max'  => '120',
							'step' => '1',
						),
					),
					'letter_spacing'  => array(
						'default'        => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					'hide_text_align' => true,
					'hide_text_shadow' => true,
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'button_one_text',
					'sub_toggle'  => 'normal',
				),
				'dvmm_button_one_f' => array(
					'label'           => esc_html__( 'Button One (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$module->main_css_element} .dvmm_fixed .dvmm_button_one .dvmm_button_text",
						// 'limited_main' 	=> "{$module->main_css_element} .dvmm_fixed .dvmm_button_one .dvmm_button_text",
						'hover'        	=> "{$module->main_css_element} .dvmm_fixed .dvmm_button_one:hover .dvmm_button_text",
						'font_size'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_button_one .dvmm_button_text",
						'line_height'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_button_one .dvmm_button_text",
					),
					'line_height'     => array(
						'default' => '',
					),
					'font_size'       => array(
						'default'        => '',
						'range_settings' => array(
							'min'  => '12',
							'max'  => '24',
							'step' => '1',
						),
					),
					'letter_spacing'  => array(
						'default'        => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					'hide_text_align' => true,
					'hide_text_shadow' => true,
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'button_one_text',
					'sub_toggle'  => 'fixed',
				),
				'dvmm_button_two' => array(
					'label'           => esc_html__( 'Button Two', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$module->main_css_element} .dvmm_button_two .dvmm_button_text",
						// 'limited_main' 	=> "{$module->main_css_element} .dvmm_button_two .dvmm_button_text",
						'hover'        	=> "{$module->main_css_element} .dvmm_button_two:hover .dvmm_button_text",
						'font_size'		=> "{$module->main_css_element} .dvmm_button_two .dvmm_button_text",
						'line_height'	=> "{$module->main_css_element} .dvmm_button_two .dvmm_button_text",
					),
					'line_height'     => array(
						'default' => '1em',
					),
					'font_size'       => array(
						'default'        => '20px',
						'range_settings' => array(
							'min'  => '10',
							'max'  => '120',
							'step' => '1',
						),
					),
					'letter_spacing'  => array(
						'default'        => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					'hide_text_align' => true,
					'hide_text_shadow' => true,
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'button_two_text',
					'sub_toggle'  => 'normal',
				),
				'dvmm_button_two_f' => array(
					'label'           => esc_html__( 'Button Two (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$module->main_css_element} .dvmm_fixed .dvmm_button_two .dvmm_button_text",
						// 'limited_main' 	=> "{$module->main_css_element} .dvmm_fixed .dvmm_button_two .dvmm_button_text",
						'hover'        	=> "{$module->main_css_element} .dvmm_fixed .dvmm_button_two:hover .dvmm_button_text",
						'font_size'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_button_two .dvmm_button_text",
						'line_height'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_button_two .dvmm_button_text",
					),
					'line_height'     => array(
						'default' => '',
					),
					'font_size'       => array(
						'default'        => '',
						'range_settings' => array(
							'min'  => '12',
							'max'  => '24',
							'step' => '1',
						),
					),
					'letter_spacing'  => array(
						'default'        => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					'hide_text_align' => true,
					'hide_text_shadow' => true,
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'button_two_text',
					'sub_toggle'  => 'fixed',
				),
				'dvmm_cart' => array(
					'label'           => esc_html__( 'Cart Contents', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$module->main_css_element} .dvmm_cart_contents",
						// 'limited_main' 	=> "{$module->main_css_element} .dvmm_cart_contents",
						'hover'        	=> "{$module->main_css_element} .dvmm_cart__button:hover .dvmm_cart_contents",
						'font_size'		=> "{$module->main_css_element} .dvmm_cart_contents",
						'line_height'	=> "{$module->main_css_element} .dvmm_cart_contents",
					),
					'line_height'     => array(
						'default' => '1em',
					),
					'font_size'       => array(
						'default'        => '14px',
						'range_settings' => array(
							'min'  => '10',
							'max'  => '120',
							'step' => '1',
						),
					),
					'letter_spacing'  => array(
						'default'        => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					'hide_text_align' => true,
					'hide_text_shadow' => true,
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'cart_text',
					'sub_toggle'  => 'normal',
				),
				'dvmm_cart_f' => array(
					'label'           => esc_html__( 'Cart Contents (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$module->main_css_element} .dvmm_fixed .dvmm_cart_contents",
						// 'limited_main' 	=> "{$module->main_css_element} .dvmm_fixed .dvmm_cart_contents",
						'hover'        	=> "{$module->main_css_element} .dvmm_fixed .dvmm_cart__button:hover .dvmm_cart_contents",
						'font_size'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_cart_contents",
						'line_height'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_cart_contents",
					),
					'line_height'     => array(
						'default' => '',
					),
					'font_size'       => array(
						'default'        => '',
						'range_settings' => array(
							'min'  => '12',
							'max'  => '24',
							'step' => '1',
						),
					),
					'letter_spacing'  => array(
						'default'        => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					'hide_text_align' => true,
					'hide_text_shadow' => true,
					'tab_slug'    => 'advanced', 
					'toggle_slug' => 'cart_text',
					'sub_toggle'  => 'fixed',
				),
			),
		);

        return $advanced_fields;

	}

	/**
	 * Menu Wrapper CSS styles.
	 * 
	 * @since	v1.0.0
	 * 
	 * @param	object	$module			Module object.
	 * @param	string	$render_slug	Module slug.
	 */
	public static function css( $module, $render_slug ){

		$dvmm_menu__wrap = "{$module->main_css_element} .dvmm_menu__wrap";

		// Menu order (range)
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_menu_order',
			'selector' 			=> $dvmm_menu__wrap,
			'property' 			=> 'order',
			'additional_css'	=> '',
			'field_type'		=> '', // don't set for 'range' field type
			'priority'			=> ''
		));

		// Menu column width
		$module->helpers()->declare_element_column_width_css( $module->props, $render_slug, array( 
			'setting' 		=> 'dvmm_menu_col_width',
			'setting_fixed'	=> 'dvmm_menu_col_width_f',
			'selector' 		=> array(
				'normal'	=> "{$module->main_css_element} .dvmm_menu__wrap",
				'fixed'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__wrap",
			),
		));

		// Menu column max-width
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_menu_col_max_width',
			'setting_fixed'		=> 'dvmm_menu_col_max_width_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'	=> "{$module->main_css_element} .dvmm_menu__wrap",
				'fixed'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__wrap",
			),
			'property' 			=> 'max-width',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Menu column background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_menu_col_bg_color',
			'setting_fixed'		=> 'dvmm_menu_col_bg_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_menu__wrap",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_menu__wrap:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__wrap",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__wrap:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));
	}
    
    /**
     * Manage the menu wrapper classes.
	 * Manages the CSS classes of the .dvmm_menu__wrap container.
     * 
     * @since   v1.0.0
     * 
	 * @param	object	$module				Module object.
	 * @param	array	$processed_props	Processed props.
     * @return	array	$menu_wrap_classes  Menu wrapper CSS classes.
     */
	static function css_classes( $module, $processed_props = array() ){

		/**
		 * PROPS
		 */
		// horizontal menu
		$_h_menu_id 			= $processed_props['dvmm_h_menu_id']['desktop'];
		$_h_menu_id_tablet 		= $processed_props['dvmm_h_menu_id']['tablet'];
		$_h_menu_id_phone 		= $processed_props['dvmm_h_menu_id']['phone'];
		$_h_menu_id_responsive 	= $processed_props['dvmm_h_menu_id']['responsive'];
        $menu_breakpoint	    = $processed_props['menu_breakpoint'];
        $dd_direction			= $processed_props['dd_direction'];
		$dvmm_search_hide_elems = $processed_props['dvmm_search_hide_elems'];
		
		// breakpoint CSS class
        $breakpoint_class = 'dvmm_breakpoint--default';
        
		if ( $menu_breakpoint >= 981 ) {
			$breakpoint_class = 'dvmm_breakpoint--increased';
		} elseif ( $menu_breakpoint <= 979 ){
			$breakpoint_class = 'dvmm_breakpoint--decreased';
        }

		// menu wrapper classes array (.dvmm_menu__wrap)
		$menu_wrap_classes = ['dvmm_element', 'dvmm_menu__wrap'];

		// Add the breakpoint class
		$menu_wrap_classes[] = $breakpoint_class;

		// Assigned horizontal menu CSS classes
		$horizontal_desktop_class = 'dvmm_menu--desktop';
		$horizontal_tablet_class = 'dvmm_menu--tablet';
		$horizontal_phone_class = 'dvmm_menu--phone';

		// Add the 'desktop' horizontal menu class
		$menu_wrap_classes[] = $horizontal_desktop_class;

		// if responsive menus enabled
		if ( $_h_menu_id_responsive === 'on' ){

			// if tablet menu is assigned: add Tablet menu class
			if ( isset($_h_menu_id_tablet) && $_h_menu_id_tablet !== '' ){
				if ( $menu_breakpoint <= 979 ) {
					// add the Tablet menu class
					$menu_wrap_classes[] = $horizontal_tablet_class;
				}
			}

			// if phone menu assigned: add Phone menu class
			if ( isset($_h_menu_id_phone) && $_h_menu_id_phone !== '' ){
				if( $menu_breakpoint <= 767 ){
					$menu_wrap_classes[] = $horizontal_phone_class;
				}
			}
        }

		/**
		 * Dropdown menu direction class.
		 * If $dd_direction IS NOT equal to 'auto' then
		 * add the 'dvmm_dd--...' class directly.
		 * 
		 * But if $dd_direction IS equal to 'auto' then
		 * toggle the 'dvmm_dd--downwards' and 'dvmm_dd--upwards' classes
		 * on scroll using the JavaScript IntersectionObserver API
		 * 
		 * @see dvmm_manage_dropdown_direction() function in frontend.js file
		 */
		if( $dd_direction !== 'auto' ){
			$dd_direction_class = sprintf( 'dvmm_dd--%s', esc_attr( $dd_direction ) );
			// add dropdown direction class to menu wrapper classes array
			array_push( $menu_wrap_classes, $dd_direction_class );
		}

		// Maybe hide this element when search form appears
		$search_hide_elems_class = $module->helpers()->maybe_hide_element_when_search_opens($processed_props, 'menu');

		// add menu wrapper classes
		array_push( $menu_wrap_classes,
			$search_hide_elems_class
		);

		return $menu_wrap_classes;
    }
    
    /**
     * Manage the menu wrapper data attributes.
	 * Manages the data attributes of the .dvmm_menu__wrap container.
     * 
     * @since   v1.0.0
     * 
	 * @param	array	$props		Props
     * @return	array				Menu wrapper data attributes.
     */
	static function data_attributes( $props = array() ){

		// props
		$dd_direction			= $props['dd_direction'];

		// menu wrapper data attributes array (.dvmm_menu__wrap)
		$menu_wrap_data_attributes 	= [];
		$dd_direction_data			= '';

		/**
		 * Add the dropdown direction data attribute
		 * only if the dropdown direction is set to "auto",
		 * otherwise add direction classes
		 * 
		 * @see self::css_classes() function
		 */ 
		if ( $dd_direction === 'auto' ){
			// data-dd_direction="auto"
			$dd_direction_data = sprintf( 'data-dd_direction="%1$s"', esc_attr( $dd_direction ) );
		}

		$menu_wrap_data_attributes[] = $dd_direction_data;

		return $menu_wrap_data_attributes;

	}

	/**
	 * Render menu wrapper.
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

		// return empty if this element is disabled or not visible
        if ( ! $module->helpers()->maybe_render_element( $module->props, 'menu' ) ) {
			return '';
		}

		// get the menu wrapper classes
		$menu_wrap_classes = implode(' ', self::css_classes( $module, $processed_props ) );

		// get the menu wrapper data attributes
		$menu_wrap_data_attrs = implode(' ', self::data_attributes( $processed_props ) );

		// get the desktop menu(s)
		$all_horizontal_menus = self::horizontal_menu()->menus( $module, $processed_props, array( $module, 'get_the_menu') );

		return sprintf(
			'<div class="%1$s" %2$s>
				<!-- dvmm_menu__menu -->
				%3$s
			</div>',
			esc_attr( $menu_wrap_classes ),
			$menu_wrap_data_attrs,
			et_core_esc_previously( $all_horizontal_menus )
		);
	}
}

/**
 * Intstantiates the DVMM_Menu_Wrapper class.
 * 
 * @since   1.0.0
 * 
 * @return  Instance of the DVMM_Menu_Wrapper class.
 * 
 */
function dvmm_menu_wrapper_class_instance( ) {
	return DVMM_Menu_Wrapper::instance( );
}