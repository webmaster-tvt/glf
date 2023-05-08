<?php

// Die if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Mobile Menu Wrapper.
 * 
 * Generates the Mobile Menu Element (the mobile menu wrapper - .dvmm_mobile_menu__wrap).
 *
 * @since   1.0.0 
 * 
 */
class DVMM_Mobile_Menu_Wrapper {

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
	 * Mobile Menu.
	 * Returns the mobile menu class instance.
	 * 
	 * @since	1.0.0
	 * 
	 * @return	DVMM_Mobile_Menu
	 */
	public function mobile_menu(){
		return dvmm_mobile_menu_class_instance();
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
			'dvmm_enable_mobile_menu' => array(
				'label'           => esc_html__( 'Enable Mobile Menu', 'dvmm-divi-mad-menu' ),
				'description'     => esc_html__( 'Add the Mobile Menu element to the header.', 'dvmm-divi-mad-menu' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'affects'		=> $module->helpers()->dvmm_enable_element__affects('mobile_menu'),
				'default'       => 'on',
				'tab_slug'      => 'general',
				'toggle_slug'	=> 'header_elements',
			),
			'dvmm_show_mobile_menu' => array(
				'label'           => esc_html__( 'Show Mobile Menu', 'dvmm-divi-mad-menu' ),
				'description'     => esc_html__( 'Set the Mobile Menu element responsive visibility.', 'dvmm-divi-mad-menu' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
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
			'dvmm_mobile_menu_order' => array(
				'label'			=> esc_html__( 'Mobile Menu Order', 'dvmm-divi-mad-menu' ),
				'description'	=> esc_html__( 'Here you can set the element order. Element order is set relatively to other enabled elements, a higher order number moves the element closer to the right hand side of the header.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'range',
                'mobile_options'	=> true,
                'responsive'		=> true,
				'option_category'	=> 'layout',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu' => 'on',
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
		 * dvmm_mobile_menu_col_width
		 * dvmm_mobile_menu_col_width_f
		 * dvmm_mobile_menu_col_max_width
		 * dvmm_mobile_menu_col_max_width_f
		 */
		$element_column_layout_fields = $module->helpers()->add_element_column_layout_fields( 
			array(
				'element_name' 	=> "Mobile Menu",
				'element_slug' 	=> "mobile_menu",
				'tab_slug'		=> 'advanced',
				'toggle_slug'	=> 'elements_layout',
				'sub_toggle'	=> 'mobile_menu',
			)
		);

		/**
		 * Add the element column design fields.
		 * 
		 * dvmm_mobile_menu_col_bg_color
		 * dvmm_mobile_menu_col_bg_color_f
		 */
		$element_column_design_fields = $module->helpers()->add_element_column_design_fields( 
			array(
				'element_name' 	=> "Mobile Menu",
				'element_slug' 	=> "mobile_menu",
				'tab_slug'		=> 'advanced',
				'toggle_slug'	=> 'mobile_menu_design',
			)
		);

		/**
		 * Add the element warning fields.
		 * 
		 * dvmm_mobile_menu_disabled__layout
		 * dvmm_mobile_menu_disabled__layout_f
		 */
		$element_warning_fields = $module->helpers()->add_element_warning_fields( 
			array(
				'element_name' 	=> "Mobile Menu",
				'element_slug' 	=> "mobile_menu",
				'tab_slug'		=> 'advanced',
				'toggle_slug'	=> 'elements_layout',
				'sub_toggle'	=> 'mobile_menu',
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
		$dvmm_menu_inner_container 	= "{$module->main_css_element} .dvmm_menu_inner_container";
		$dvmm_fixed 				= "{$module->main_css_element} .dvmm_fixed"; // fixed header
		$dvmm_mobile_menu 			= "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu"; // mobile menu <ul> tag
		$dvmm_mobile_menu__fixed 	= "{$dvmm_fixed} .dvmm_mobile__menu .dvmm_menu"; // fixed mobile menu <ul> tag

		// advanced fields
        $advanced_fields = array(
			
		);

        return $advanced_fields;

	}

	/**
	 * Mobile Menu Wrapper CSS styles.
	 * 
	 * @since	v1.0.0
	 * 
	 * @param	object	$module			Module object.
	 * @param	string	$render_slug	Module slug.
	 */
	public static function css( $module, $render_slug ){

		$dvmm_mobile_menu__wrap = "{$module->main_css_element} .dvmm_mobile_menu__wrap";

		// Mobile Menu order (range)
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_menu_order',
			'selector' 			=> $dvmm_mobile_menu__wrap,
			'property' 			=> 'order',
			'additional_css'	=> '',
			'field_type'		=> '', // don't set for 'range' field type
			'priority'			=> ''
		));

		// Mobile Menu column width
		$module->helpers()->declare_element_column_width_css( $module->props, $render_slug, array( 
			'setting' 		=> 'dvmm_mobile_menu_col_width',
			'setting_fixed'	=> 'dvmm_mobile_menu_col_width_f',
			'selector' 		=> array(
				'normal'	=> "{$module->main_css_element} .dvmm_mobile_menu__wrap",
				'fixed'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu__wrap",
			),
		));

		// Mobile Menu column max-width
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_menu_col_max_width',
			'setting_fixed'		=> 'dvmm_mobile_menu_col_max_width_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'	=> "{$module->main_css_element} .dvmm_mobile_menu__wrap",
				'fixed'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu__wrap",
			),
			'property' 			=> 'max-width',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Menu column background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_menu_col_bg_color',
			'setting_fixed'		=> 'dvmm_mobile_menu_col_bg_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile_menu__wrap",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile_menu__wrap:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu__wrap",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu__wrap:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));
	}
    
    /**
     * Manage the mobile menu wrapper classes.
	 * Manages the CSS classes of the .dvmm_mobile_menu__wrap container.
     * 
     * @since   v1.0.0
     * 
	 * @param	object	$module				        Module object.
	 * @param	array	$processed_props	        Processed props.
     * @return	array	$mobile_menu_wrap_classes   Mobile Menu wrapper CSS classes.
     */
	static function css_classes( $module, $processed_props = array() ){

		/**
		 * PROPS
		 */

		// mobile menu
		$_m_menu_id 			= $processed_props['dvmm_m_menu_id']['desktop'];
		$_m_menu_id_tablet 		= $processed_props['dvmm_m_menu_id']['tablet'];
		$_m_menu_id_phone 		= $processed_props['dvmm_m_menu_id']['phone'];
		$_m_menu_id_responsive 	= $processed_props['dvmm_m_menu_id']['responsive'];

		$mobile_menu_breakpoint	= $processed_props['mobile_menu_breakpoint'];
		$collapse_submenus 		= $processed_props['collapse_submenus'];
		$mobile_parent_links 	= $processed_props['mobile_parent_links'];
		$accordion_mode			= $processed_props['accordion_mode'];
		$dd_direction			= $processed_props['dd_direction'];
		$dvmm_search_hide_elems = $processed_props['dvmm_search_hide_elems'];
		$close_on_outside_click = $module->props['close_on_outside_click'];
		$submenu_style 			= $module->props['submenu_style'];
		
		// breakpoint CSS class
		$breakpoint_class = 'dvmm_breakpoint--default';
		if ( $mobile_menu_breakpoint >= 981 ) {
			$breakpoint_class = 'dvmm_breakpoint--increased';
		} elseif ( $mobile_menu_breakpoint <= 979 ){
			$breakpoint_class = 'dvmm_breakpoint--decreased';
		}
		// collapse submenus class
		$collapse_submenus_class = $collapse_submenus === 'on' ? 'dvmm_submenus--collapsed' : 'dvmm_submenus--default';

		// collapsed submenus dependent classes
		if ( $collapse_submenus === 'on' ){
			// mobile menu parent links mode class
			$mobile_parent_links_class = $mobile_parent_links === 'on' ? 'dvmm_parents--clickable' : 'dvmm_parents--disabled';
			// accordion mode class
			$accordion_mode_class = $submenu_style === 'expand' && $accordion_mode === 'on' ? 'dvmm_accordion--on' : 'dvmm_accordion--off';
			// submenu style class (dvmm_submenus--expand OR dvmm_submenus--slide_right)
			$submenu_style_class = "dvmm_submenus--{$submenu_style}";
		} else {
			$mobile_parent_links_class = '';
			$accordion_mode_class = '';
			$submenu_style_class = '';
		}

		// mobile menu wrapper classes array (.dvmm_mobile_menu__wrap)
		$mobile_menu_wrap_classes = ['dvmm_element', 'dvmm_mobile_menu__wrap'];

		// Add the breakpoint class
		$mobile_menu_wrap_classes[] = $breakpoint_class;

		// Assigned mobile menu CSS classes
		$mobile_desktop_class = 'dvmm_mobile--desktop';
		$mobile_tablet_class = 'dvmm_mobile--tablet';
		$mobile_phone_class = 'dvmm_mobile--phone';

		// Add the 'desktop' mobile menu class
		$mobile_menu_wrap_classes[] = $mobile_desktop_class;

		// if responsive menus enabled
		if ( $_m_menu_id_responsive === 'on' ){

			// if tablet menu is assigned: remove Default and add Tablet menu class
			if ( isset($_m_menu_id_tablet) && $_m_menu_id_tablet !== '' ){

				// remove default menu only if the breakpoint is less than 981px
				if ( $mobile_menu_breakpoint <= 980 ) {
					$mobile_menu_wrap_classes = array_diff( $mobile_menu_wrap_classes, [$mobile_desktop_class] );
				}
				// add the Tablet menu class
				$mobile_menu_wrap_classes[] = $mobile_tablet_class;

			}

			// if phone menu assigned: add Phone menu class
			if ( isset($_m_menu_id_phone) && $_m_menu_id_phone !== '' ){

				// remove both the Default&Tablet menus if breakpoint is less than 768px
				if( $mobile_menu_breakpoint <= 768 ){
					$mobile_menu_wrap_classes = array_diff( $mobile_menu_wrap_classes, [$mobile_desktop_class, $mobile_tablet_class] );
				}
				// add the Phone menu class
				if( $mobile_menu_breakpoint > 0 ) {
					$mobile_menu_wrap_classes[] = $mobile_phone_class;
				}

			}

		} else {
			// remove the Default menu only if the breakpoint is 0(zero)px
			if( $mobile_menu_breakpoint <= 0 ) {
				$mobile_menu_wrap_classes = array_diff( $mobile_menu_wrap_classes, [$mobile_desktop_class] );
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
			// add dropdown direction class to mobile menu wrapper classes array
			array_push( $mobile_menu_wrap_classes, $dd_direction_class );
		}

		// Maybe hide this element when search form appears
		$search_hide_elems_class = $module->helpers()->maybe_hide_element_when_search_opens($processed_props, 'mobile_menu');

		// close mobile dropdown menu on outside click - @since v1.4
		$close_on_outside_click_class = $close_on_outside_click === 'on' ? 'dvmm_dd_close_on_outside_click' : '';

		// add menu wrapper classes
		array_push( $mobile_menu_wrap_classes,
			$collapse_submenus_class,
			$submenu_style_class,
			$mobile_parent_links_class,
			$accordion_mode_class,
			$search_hide_elems_class,
			$close_on_outside_click_class
		);

		return $mobile_menu_wrap_classes;
    }
    
    /**
     * Manage the mobile menu wrapper data attributes.
	 * Manages the data attributes of the .dvmm_mobile_menu__wrap container.
     * 
     * @since   v1.0.0
     * 
	 * @param	object	$module					Module object.
	 * @param	array	$processed_props		Processed Props
	 * 
     * @return	array   						Mobile Menu wrapper data attributes.
     */
	static function data_attributes( $module, $processed_props = array() ){

		// props
		$collapse_submenus 		= $processed_props['collapse_submenus'];
		$mobile_parent_links 	= $processed_props['mobile_parent_links'];
		$accordion_mode			= $processed_props['accordion_mode'];
		$dd_direction			= $processed_props['dd_direction'];

		// mobile menu wrapper data attributes array (.dvmm_mobile_menu__wrap)
		$mobile_menu_wrap_data_attributes 	= [];
		$mobile_parent_links_data 	= '';
		$accordion_mode_data		= '';
		$dd_direction_data			= '';

		// collapsed submenus dependent data attributes
		if ( $collapse_submenus === 'on' ){
			// mobile menu parent item links mode (enabled/disabled)
			$mobile_parent_links_data 	= sprintf( 'data-mobile_parent_links="%1$s"', esc_attr( $mobile_parent_links ) );
			// mobile accordion mode (enabled/disabled)
			$accordion_mode_data 		= sprintf( 'data-accordion_mode="%1$s"', esc_attr( $accordion_mode ) );
		}

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

		/**
		 * Add the mobile menu animations data attribute
		 * 
		 * @since	v1.2
		 */
		$animation_open_data	= $module->helpers()->_generate_responsive_values_data_string($module->props, 'mobile_menu_animation_open', 'default');
		$animation_close_data	= $module->helpers()->_generate_responsive_values_data_string($module->props, 'mobile_menu_animation_close', 'default');
		$animation_open_duration_data	= $module->helpers()->_generate_responsive_values_data_string($module->props, 'mobile_menu_animation_open_duration', '700ms');
		$animation_close_duration_data	= $module->helpers()->_generate_responsive_values_data_string($module->props, 'mobile_menu_animation_close_duration', '700ms');

		$mobile_animation = sprintf(
			'{"open":"%1$s", "close":"%2$s", "open_duration":"%3$s", "close_duration":"%4$s"}',
			esc_attr( $animation_open_data ),
			esc_attr( $animation_close_data ),
			esc_attr( $animation_open_duration_data ),
			esc_attr( $animation_close_duration_data )
		);

		$dd_animation_data = sprintf( 'data-dd_animation="%1$s"', esc_attr( $mobile_animation ) );

		/**
		 * Mobile dropdown placement data attribute.
		 * 
		 * Includes the data for placement and alignment of the 
		 * mobile dropdown menu.
		 * 
		 * @since   v1.4
		 * 
		 */
		$dd_place	= $module->helpers()->_generate_responsive_values_data_string($module->props, 'mobile_menu_placement', 'static');
		$dd_align	= $module->helpers()->_generate_responsive_values_data_string($module->props, 'mobile_menu_alignment', 'center');

		// make the placement value more meaningful :)
		$dd_place = str_replace( ['static', 'relative'], ['default', 'attached'], $dd_place);

		$dd_placement = sprintf( 
			'{"place":"%1$s", "align":"%2$s"}',
			esc_attr( $dd_place ),
			esc_attr( $dd_align )
		);

		$dd_placement_data	= sprintf( 'data-dd_placement="%1$s"', esc_attr( $dd_placement ) );

		$mobile_menu_wrap_data_attributes[] = $dd_placement_data;
		$mobile_menu_wrap_data_attributes[] = $dd_direction_data;
		$mobile_menu_wrap_data_attributes[] = $dd_animation_data;
		$mobile_menu_wrap_data_attributes[] = $mobile_parent_links_data;
		$mobile_menu_wrap_data_attributes[] = $accordion_mode_data;

		return $mobile_menu_wrap_data_attributes;

	}

	/**
	 * Render mobile menu wrapper.
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
        if ( ! $module->helpers()->maybe_render_element( $module->props, 'mobile_menu' ) ) {
			return '';
		}

		// get the mobile menu wrapper classes
		$mobile_menu_wrap_classes = implode(' ', self::css_classes( $module, $processed_props ) );

		// get the mobile menu wrapper data attributes
		$mobile_menu_wrap_data_attrs = implode(' ', self::data_attributes( $module, $processed_props ) );

		// get the mobile menu(s)
		$all_mobile_menus = self::mobile_menu()->menus( $module, $processed_props, $render_slug, array( $module, 'get_the_menu') );

		return sprintf(
			'<div class="%1$s" %2$s>
				<!-- dvmm_mobile__menu -->
				%3$s
			</div>',
			esc_attr( $mobile_menu_wrap_classes ),
			$mobile_menu_wrap_data_attrs,
			et_core_esc_previously( $all_mobile_menus )
		);
	}
}

/**
 * Intstantiates the DVMM_Mobile_Menu_Wrapper class.
 * 
 * @since   1.0.0
 * 
 * @return  Instance of the DVMM_Mobile_Menu_Wrapper class.
 * 
 */
function dvmm_mobile_menu_wrapper_class_instance( ) {
	return DVMM_Mobile_Menu_Wrapper::instance( );
}