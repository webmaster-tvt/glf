<?php

// Die if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Modules helper methods.
 * 
 * Includes methods used by all modules.
 *
 * @since   v1.0.0 
 * 
 */
class DVMM_Divi_Modules_Helper {

    /**
     * Props.
     * 
     * @since   v1.0.0
     * 
     */
    public $props = array();

    /**
     * Returns instance of the class.
     * 
     * @since   v1.0.0
     * 
     */
	public static function instance(  ) {

		static $instance;
        return $instance ? $instance : $instance = new self(  );
        
	}

    /**
     * Constructor.
     */ 
	private function __construct(  ) {

    }

    /**
     * Process the breakpoint value.
     * Ensures that it is not less than 0(zero).
     * 
     * @since   v1.0.0
     * 
     * @param   string      $breakpoint_value   The breakpoint value.
     * @return  integer     $breakpoint         The processed breakpoint value.
     */
    public function process_breakpoint_value( $props, $breakpoint_value ) {

        // remove the 'px' part from the breakpoint value
        $breakpoint = isset( $props[$breakpoint_value] ) ? intval($props[$breakpoint_value]) : intval('981');
            
        // prevent a negative breakpoint value
		$breakpoint = $breakpoint >= 0 ? $breakpoint : 0;

        return $breakpoint;
	}

	/**
	 * Generates the responsive css.
	 *
	 * @uses	et_pb_responsive_options()->generate_responsive_css() 
	 * 			which is a copy of et_pb_generate_responsive_css() 
	 * 			with some modifications to improve.
	 *
	 * @since	v1.0.0
	 * 
	 * @param   array   $props                  Module props.
	 * @param 	string 	$render_slug    		Module slug.
	 * @param 	array  	$args					All arguments.
	 * 			string 	$args['setting']		Setting name.
	 * 			string 	$args['setting_fixed']	Fixed header setting name. The setting for fixed header has the '_f' suffix, 
	 * 											Eg. 'dvmm_main_padding_f' is the fixed header equivalent of the 'dvmm_main_padding' setting.
	 * 
     *          string  $args['default']        Default value of the setting. Must be equal to the default value 
     *                                          specified for the setting. Needed to prevent the CSS from being
     *                                          generated with default values which normally should not happen.
     *                                          
	 * 			mixed	$args['selector']   	CSS selector(s). Can be either array or a string value.
	 * 											Eg. 'selector' => '.dvmm_menu_inner_container',
	 * 											or
	 * 											Eg. 'selector' => array (
	 * 													'normal'    	=> '.dvmm_menu_inner_container',
	 * 													'normal_hover' 	=> '.dvmm_menu_inner_container:hover',
	 * 													'fixed' 		=> '.dvmm_menu_inner_container.dvmm_fixed',
	 * 													'fixed_hover' 	=> '.dvmm_menu_inner_container.dvmm_fixed:hover'
	 * 												)
	 * 
	 * 			string 	$args['property']   	CSS property.
	 * 			string 	$args['additional_css']	Additional CSS.
	 * 			string 	$args['field_type']     Value type to determine need filter or not.
	 * 			string 	$args['priority']       CSS style declaration priority.
	 * 
	 */
	public function generate_responsive_css( $props, $render_slug, $args = [] ){

		$setting 		= isset ( $args['setting'] ) ? $args['setting'] : '';
		$setting_f 		= isset ( $args['setting_fixed'] ) ? $args['setting_fixed'] : '';
		$default        = isset ( $args['default'] ) ? $args['default'] : '';
		$selector 		= isset ( $args['selector'] ) ? $args['selector'] : '';
		$property		= isset ( $args['property'] ) ? $args['property'] : '';
		$additional_css = isset ( $args['additional_css'] ) ? $args['additional_css'] : '';
		$type 			= isset ( $args['field_type'] ) ? $args['field_type'] : '';
		$priority 		= isset ( $args['priority'] ) ? $args['priority'] : '';

		// is fixed header enabled
		$_is_fixed_header_enabled = $props['dvmm_enable_fixed_header'] === 'on' ? true : false;
		
		/**
		 * If the selector is not an array but a string 
		 * make it an array containing only the 'normal' key.
		 */
		if( is_string( $selector )){
			$selector = array(
				'normal' => $selector,
			);
		}

		// css property
		$css_property = $property;

		/**
		 * NORMAL HEADER
		 */
		// css selectors
		$css_selector 		= isset ( $selector['normal'] ) ? $selector['normal'] : '';
		$css_selector_h 	= isset ( $selector['normal_hover'] ) ? $selector['normal_hover'] : '';

		// get all values of the property (normal)
		$prop_values = $this->get_property_values_all( $props, $setting, $default, false );
	
		// values
		$desktop    = $prop_values['desktop'];
		$hover    	= $prop_values['hover'];
		$tablet     = $prop_values['tablet'];
		$phone	    = $prop_values['phone'];
		$responsive = $prop_values['responsive'];

		$_is_responsive_active 	= $responsive === 'on' ? true : false;
		$_is_hover_enabled  	= et_pb_hover_options()->is_enabled( $setting, $props );

		// HOVER
		if( $_is_hover_enabled && '' !== $hover && '' !== $css_selector_h ){
			// normal-hover styles need to override the normal and fixed styles, that's why using " !important"
			$additional_css_h = " !important;";
			// normal header hover value
			$values_array_h = array(
				'desktop_only' => $hover,
			);
			// Generate the responsive CSS for hovered state.
			et_pb_responsive_options()->generate_responsive_css( $values_array_h, $css_selector_h, $css_property, $render_slug, $additional_css_h, $type, $priority );
		}

		// RESPONSIVE
		if ( ('' !== $desktop || '' !== $tablet || '' !== $phone)  && '' !== $css_selector ) {
			// normal header values
			$values_array = array(
				'desktop' => $desktop,
				'tablet'  => $_is_responsive_active ? $tablet : '',
				'phone'   => $_is_responsive_active ? $phone : '',
			);

			// Generate the responsive CSS for normal state.
			et_pb_responsive_options()->generate_responsive_css( $values_array, $css_selector, $css_property, $render_slug, $additional_css, $type, $priority );
		}

		/**
		 * FIXED HEADER
		 * Repeat the same process of CSS generation for the fixed header if 
		 * the setting for fixed header has been passed in.
		 */
		if( $_is_fixed_header_enabled === true && $setting_f !== '' ){

			// css selectors (fixed)
			$css_selector_f 	= isset ( $selector['fixed'] ) ? $selector['fixed']  : '';
			$css_selector_f_h 	= isset ( $selector['fixed_hover'] ) ? $selector['fixed_hover'] : '';

			// get all values of the property (fixed)
			$prop_values_f = $this->get_property_values_all( $props, $setting_f, $default, false );

			// values
			$desktop_f    	= $prop_values_f['desktop'];
			$hover_f		= $prop_values_f['hover'];
			$tablet_f     	= $prop_values_f['tablet'];
			$phone_f	  	= $prop_values_f['phone'];
			$responsive_f 	= $prop_values_f['responsive'];

			$_is_responsive_active_f = $responsive_f === 'on' ? true : false;
			$_is_hover_enabled_f	 = et_pb_hover_options()->is_enabled( $setting_f, $props );

			// get the "dvmm_fixed_header" property values
			$dvmm_fixed_header = $this->get_property_values_all( $props, "dvmm_fixed_header", "none", true );

			// HOVER (FIXED)
			if( $_is_hover_enabled_f && '' !== $hover_f && '' !== $css_selector_f_h ){
				// fixed-hover styles need to override the normal, fixed and normal-hover styles, that's why using " !important"
				$additional_css_f_h = " !important;";
				// fixed header hover value
				$values_array_f_h = array(
					'desktop_only' => $dvmm_fixed_header['desktop'] !== 'none' && $hover_f !== $hover ? $hover_f : '',
				);
				// Generate the responsive CSS for the current side.
				et_pb_responsive_options()->generate_responsive_css( $values_array_f_h, $css_selector_f_h, $css_property, $render_slug, $additional_css_f_h, $type, $priority );
			}

			// RESPONSIVE (FIXED)
			if ( ('' !== $desktop_f || '' !== $tablet_f || '' !== $phone_f) && '' !== $css_selector_f ) {
				// fixed header values
				$values_array_f = array(
					'desktop' => $dvmm_fixed_header['desktop'] !== 'none' && $desktop_f !== $desktop ? $desktop_f : '',
					'tablet'  => $_is_responsive_active_f ? $tablet_f : '',
					'phone'   => $_is_responsive_active_f ? $phone_f : '',
				);
				// Generate the responsive CSS for the current side.
				et_pb_responsive_options()->generate_responsive_css( $values_array_f, $css_selector_f, $css_property, $render_slug, $additional_css, $type, $priority );
			}
		}

	}

	/**
	 * Generate responsive and hover CSS for the 'custom_margin' and 'custom_padding' fields.
	 * 
	 * Generates CSS for the Normal header and also for 
	 * the Fixed header(if the fixed header setting name has been passed with the $args array).
	 * 
	 * @since	v1.0.0
	 * 
     * @param   array   $props                  Module props.
	 * @param 	string 	$render_slug    		Module slug.
	 * @param 	array  	$args					All arguments.
	 * 			string 	$args['setting']		Setting name.
	 * 			string 	$args['setting_fixed']	Fixed header setting name. The setting for fixed header has the '_f' suffix, 
	 * 											Eg. 'dvmm_main_padding_f' is the fixed header equivalent of the 'dvmm_main_padding' setting.
	 * 
     *          string  $args['default']        Default value of the setting. Must be equal to the default value 
     *                                          specified for the setting. Needed to prevent the CSS from being
     *                                          generated with default values which normally should not happen.
     *                                          
	 * 			array	$args['selector']   	CSS selector.
	 * 											Eg. 'selector' => array (
	 * 													'normal'    	=> '.dvmm_menu_inner_container',
	 * 													'normal_hover' 	=> '.dvmm_menu_inner_container:hover',
	 * 													'fixed' 		=> '.dvmm_menu_inner_container.dvmm_fixed',
	 * 													'fixed_hover' 	=> '.dvmm_menu_inner_container.dvmm_fixed:hover'
	 * 												)
	 * 
	 * 			string 	$args['property']   	CSS property.
	 * 			string 	$args['additional_css']	Additional CSS.
	 * 			string 	$args['field_type']     Value type to determine need filter or not.
	 * 			string 	$args['priority']       CSS style declaration priority.
	 * 
	 */
	public function generate_responsive_css__spacing( $props, $render_slug, $args = [] ){

		$setting 		= isset ( $args['setting'] ) ? $args['setting'] : '';
		$setting_f 		= isset ( $args['setting_fixed'] ) ? $args['setting_fixed'] : '';
		$default        = isset ( $args['default'] ) ? $args['default'] : '';
		$selector 		= isset ( $args['selector'] ) ? $args['selector'] : '';
		$property 	    = isset ( $args['property'] ) ? $args['property'] : '';
		$additional_css = isset ( $args['additional_css'] ) ? $args['additional_css'] : '';
		$type 			= isset ( $args['field_type'] ) ? $args['field_type'] : '';
		$priority 		= isset ( $args['priority'] ) ? $args['priority'] : '';
		
		// is fixed header enabled
		$_is_fixed_header_enabled = $props['dvmm_enable_fixed_header'] === 'on' ? true : false;

		/**
		 * If the selector is not an array but a string 
		 * make it an array containing only the 'normal' key.
		 */
		if( is_string( $selector )){
			$selector = array(
				'normal' => $selector,
			);
		}

		/**
		 * NORMAL HEADER
		 */
		// css selectors
		$css_selector 		= isset ( $selector['normal'] ) ? $selector['normal'] : '';
		$css_selector_h 	= isset ( $selector['normal_hover'] ) ? $selector['normal_hover'] : '';

		// get spacing property values (normal)
		$prop_values = $this->get_property_values_all( $props, $setting, $default, false );

		// Explode the string value into array for each device.
		$desktop    = explode( "|", $prop_values['desktop'] );
		$hover    	= explode( "|", $prop_values['hover'] );
		$tablet     = explode( "|", $prop_values['tablet'] );
		$phone	    = explode( "|", $prop_values['phone'] );
		$responsive = $prop_values['responsive'];

		$_is_responsive_active 	= $responsive === 'on' ? true : false;
		$_is_hover_enabled  	= et_pb_hover_options()->is_enabled( $setting, $props ); 
		
		/**
		 * FIXED HEADER
		 */
		// if the setting for fixed header has been passed
		if( $_is_fixed_header_enabled === true && $setting_f !== '' ){

			// css selectors (fixed)
			$css_selector_f 	= isset ( $selector['fixed'] ) ? $selector['fixed']  : '';
			$css_selector_f_h 	= isset ( $selector['fixed_hover'] ) ? $selector['fixed_hover'] : '';

			// get spacing property values (fixed)
			$prop_values_f = $this->get_property_values_all( $props, $setting_f, $default, false );

			// Explode the string value into array for each device (fixed).
			$desktop_f    	= explode( "|", $prop_values_f['desktop'] );
			$hover_f    	= explode( "|", $prop_values_f['hover'] );
			$tablet_f     	= explode( "|", $prop_values_f['tablet'] );
			$phone_f	    = explode( "|", $prop_values_f['phone'] );
			$responsive_f	= $prop_values_f['responsive'];

			$_is_responsive_active_f = $responsive_f === 'on' ? true : false;
			$_is_hover_enabled_f	 = et_pb_hover_options()->is_enabled( $setting_f, $props );

			// get the "dvmm_fixed_header" property values
			$dvmm_fixed_header = $this->get_property_values_all( $props, "dvmm_fixed_header", "none", true );
		}

		// Explode the default value into array. Used by both normal and fixed headers.
		$default_values = explode( "|", $default );

		// Loop 4 times to generate CSS for each side (top, right, bottom, left).
		for( $i=0; $i<=3; $i++ ){

			// Generate the CSS property for each side. Eg: padding-top
			switch($i){
				case 0:
					$side = 'top';
					break;
				case 1:
					$side = 'right';
					break;
				case 2:
					$side = 'bottom';
					break;
				case 3:
					$side = 'left';
					break;
			}
			$css_property = "{$property}-{$side}";

			/**
			 * NORMAL HEADER
			 */
			// Get values for the current side for all devices.
			$_default	= isset( $default_values[$i] ) ? $default_values[$i] : '';
			$_desktop 	= isset( $desktop[$i] ) && $desktop[$i] !== $_default ? $desktop[$i] : '';
			$_hover 	= isset( $hover[$i] ) && $hover[$i] !== $_desktop ? $hover[$i] : '';
			$_tablet 	= isset( $tablet[$i] ) ? $tablet[$i] : '';
			$_phone 	= isset( $phone[$i] ) ? $phone[$i] : '';

			// HOVER
			if( $_is_hover_enabled && '' !== $_hover && '' !== $css_selector_h ){
				// normal-hover styles need to override the normal and fixed styles, that's why using " !important"
				$additional_css_h = " !important;";
				// normal header hover value
				$values_array_h = array(
					'desktop_only' => $_hover,
				);

				// Generate the responsive CSS for the current side.
				et_pb_responsive_options()->generate_responsive_css( $values_array_h, $css_selector_h, $css_property, $render_slug, $additional_css_h, $type, $priority );
			}

			// RESPONSIVE
			if ( ( '' !== $_desktop || '' !== $_tablet || '' !== $_phone ) && '' !== $css_selector  ) {
				// normal header values
				$values_array = array(
					'desktop' => $_desktop,
					'tablet'  => $_is_responsive_active ? $_tablet : '',
					'phone'   => $_is_responsive_active ? $_phone : '',
				);
				// Generate the responsive CSS for the current side.
				et_pb_responsive_options()->generate_responsive_css( $values_array, $css_selector, $css_property, $render_slug, $additional_css, $type, $priority );
			}

			/**
			 * FIXED HEADER
			 * Repeat the same process of CSS generation for the fixed header if 
			 * the setting for fixed header has been passed in.
			 */
			if( $_is_fixed_header_enabled === true && $setting_f !== '' ){
				
				// Get values for the current side for all devices.
				$_default	= isset( $default_values[$i] ) ? $default_values[$i] : '';
				$_desktop_f = isset( $desktop_f[$i] ) && $desktop_f[$i] !== $_default ? $desktop_f[$i] : '';
				$_hover_f 	= isset( $hover_f[$i] ) && $hover_f[$i] !== $_desktop_f ? $hover_f[$i] : '';
				$_tablet_f 	= isset( $tablet_f[$i] ) ? $tablet_f[$i] : '';
				$_phone_f 	= isset( $phone_f[$i] ) ? $phone_f[$i] : '';

				// HOVER (FIXED)
				if( $_is_hover_enabled_f && '' !== $_hover_f && '' !== $css_selector_f_h ){
					// fixed-hover styles need to override the normal, fixed and normal-hover styles, that's why using " !important"
					$additional_css_f_h = " !important;";
					// fixed header hover value
					$values_array_f_h = array(
						'desktop_only' => $dvmm_fixed_header['desktop'] !== 'none' && $_hover_f !== $_hover ? $_hover_f : '',
					);
					// Generate the responsive CSS for the current side.
					et_pb_responsive_options()->generate_responsive_css( $values_array_f_h, $css_selector_f_h, $css_property, $render_slug, $additional_css_f_h, $type, $priority );
				}

				// RESPONSIVE (FIXED)
				if ( ( '' !== $_desktop_f || '' !== $_tablet_f || '' !== $_phone_f ) && '' !== $css_selector_f ) {
					// fixed header values
					$values_array_f = array(
						'desktop' => $dvmm_fixed_header['desktop'] !== 'none' && $_desktop_f !== $_desktop ? $_desktop_f : '',
						'tablet'  => $_is_responsive_active_f ? $_tablet_f : '',
						'phone'   => $_is_responsive_active_f ? $_phone_f : '',
					);
					// Generate the responsive CSS for the current side.
					et_pb_responsive_options()->generate_responsive_css( $values_array_f, $css_selector_f, $css_property, $render_slug, $additional_css, $type, $priority );
				}
			}
        }
	}

	/**
	 * Get hover value.
	 * 
	 * Copy of the same function of the ET_Builder_Element class with some modifications.
	 * 
	 * @since	v1.0.0 
	 * 
	 * @param	array	$props		Module props.
	 * @param	string	$option		The option name.
	 * @return	mixed	$value		The hover value if exists.
	 */
	public function get_hover_value( $props, $option ) {

		$enabled_option = $option === 'background_color' ? 'background' : $option;
		$hover_enabled  = et_pb_hover_options()->is_enabled( $enabled_option, $props );
		$value          = et_pb_hover_options()->get_value( $option, $props );

		return ( ! $hover_enabled ) ? null : $value;
	}

	/**
	 * Determine if setting is enabled for any mode(desktop, hover, tablet and phone).
	 * Used with the 'yes_no_button' field.
	 *
	 * @since	v1.0.0 
	 *
	 * @param	array	$props	Module props.
	 * @param	string	$prop	Prop name.
	 *
	 * @return boolean
	 */
	public function is_any_enabled( $props, $prop ) {

		$values		= array_values( et_pb_responsive_options()->get_property_values( $props, $prop, 'off', true ) );
		$values[]	= $this->get_hover_value( $props, $prop );

		return false !== strpos( join( $values ), 'on' );
	}

	/**
	 * Gets the Yes/No field's values array.
	 * 
	 * Returns an array of the 'yes_no_button' field type values for all modes 
	 * and responsiveness status.
	 * Used to generate a data attribute string value with all values separated by a pipe 
	 * in the following order: desktop|hover|tablet|phone|responsive
	 * ( for example: on|off|off|on|on )
	 *
	 * @since	v1.0.0 
	 *
	 * @param	array	$props		Module props.
	 * @param	string	$prop_name	Prop name.
	 *
	 * @return	array				All values.
	 */
	public function get_yes_no_values( $props, $prop_name ) {

		// values per device in the following order: desktop, table, phone
		$device_values	= array_values( et_pb_responsive_options()->get_property_values( $props, $prop_name, 'off', true ) );
		// hover value
		$hover_value	= $this->get_hover_value( $props, $prop_name );
		// responsiveness status
		$is_responsive	= et_pb_responsive_options()->is_responsive_enabled( $props, $prop_name );

		$values['desktop'] 	= $device_values[0];
		$values['hover']	= $hover_value;
		$values['tablet'] 	= $device_values[1];
		$values['phone'] 	= $device_values[2];
		$values['responsive'] = $is_responsive === true ? 'on' : 'off';

		return $values;
	}

	/**
	 * Get all property values for all devices + hover + responsive.
	 *
	 * This function is a modified version of the et_pb_responsive_options()->get_property_values()
	 * which returns only device values(desktop, tablet and phone) array,
	 * whereas this function returns desktop, hover, tablet, phone and responsiveness values array.
	 * 
	 * @todo	maybe replace the legacy $this->get_yes_no_values() method occurances with this method because 
	 * 			both methods do the same thing.
	 *
	 * @since v1.0.0 
	 *
	 * @param array   $props			List of all props and values.
	 * @param string  $prop_name     	Property name.
	 * @param mixed   $default_value 	Default value.
	 * @param boolean $force_return  	Force to return any values found.
	 *
	 * @return array Pair of devices/hover/responsive and the values.
	 */
	public function get_property_values_all( $props, $prop_name, $default_value = '', $force_return = false ){

		// values per device in the following order: desktop, table, phone
		$device_values	= et_pb_responsive_options()->get_property_values( $props, $prop_name, $default_value, $force_return );
		// hover value
		$hover_value	= $this->get_hover_value( $props, $prop_name );
		// responsiveness status
		$is_responsive	= et_pb_responsive_options()->is_responsive_enabled( $props, $prop_name );

		$values['desktop'] 	= $device_values['desktop'];
		$values['hover']	= $hover_value;
		$values['tablet'] 	= $device_values['tablet'];
		$values['phone'] 	= $device_values['phone'];
		$values['responsive'] = $is_responsive === true ? 'on' : 'off';

		return $values;

	}

	/**
	 * Maybe hide the element when search opens.
	 * 
	 * Hide or don't hide the element when search form appears.
	 * 
	 * @uses the $props['dvmm_search_hide_elems'] prop's value which is a 'multiple_checkboxes' field value
	 * containing the on/off values for each device like so: on|on|off|on|off|off 
	 * in the following order: logo|menu|search|cart|button_one|button_two (order is IMPORTANT!).
	 * ('on' = hide element, 'off' = don't hide element)
	 * 
	 * @since	v1.0.0
	 * 
	 * @param	array	$props		Module props.
	 * @param	string	$element	Element name (eg. 'logo', 'menu', 'search', 'cart', 'button_one', 'button_two').
	 * 
	 * @return	string				CSS class('dvmm_search_hides') or empty string 
	 * 								for controlling the element visibility 
	 * 								when search form is opened/closed.
	 * 
	 */
	public function maybe_hide_element_when_search_opens( $props, $element ){

		// element's index
		switch( $element ){
			case 'logo':
				$item = 0;
			break;
			case 'menu':
				$item = 1;
			break;
			case 'mobile_menu':
				$item = 2;
			break;
			case 'search':
				$item = 3;
			break;
			case 'cart':
				$item = 4;
			break;
			case 'button_one':
				$item = 5;
			break;
			case 'button_two':
				$item = 6;
			break;
			default:
				$item = 100; // random number
		}

		// explode values string into array
		$values = explode("|", $props['dvmm_search_hide_elems']);

		// get the element's value
		$value = isset($values[$item]) ? $values[$item] : 'off';

		// return the CSS class if the element should be hidden
		$css_class = $value === 'on' ? 'dvmm_search_hides' : '';

		return $css_class;
	}

	/**
	 * Render the element if it is enabled and is visible.
	 * 
	 * @since	v1.0.0
	 * 
	 * @param	array	$props		Module props.
	 * @param	string	$element	Element name (eg. 'menu', 'search', 'cart', 'button_one', 'button_two').
	 * 
	 * @return	boolean				
	 * 
	 */
	public function maybe_render_element( $props, $element ){

		// select the element to work with
		switch($element){
			case 'menu':
				$enable_element_prop = "dvmm_enable_menu";
				$show_element_prop = "dvmm_show_menu";
			break;
			case 'mobile_menu':
				$enable_element_prop = "dvmm_enable_mobile_menu";
				$show_element_prop = "dvmm_show_mobile_menu";
			break;
			case 'search':
				$enable_element_prop = "dvmm_enable_search";
				$show_element_prop = "dvmm_show_search_icon";
			break;
			case 'cart':
				$enable_element_prop = "dvmm_enable_cart";
				$show_element_prop = "dvmm_show_cart_icon";
			break;
			case 'button_one':
				$enable_element_prop = "dvmm_enable_button_one";
				$show_element_prop = "dvmm_show_button_one";
			break;
			case 'button_two':
				$enable_element_prop = "dvmm_enable_button_two";
				$show_element_prop = "dvmm_show_button_two";
			break;
			default:
				$enable_element_prop = "";
				$show_element_prop = "";
		}

		// checks if any of the hover+devices has a value of 'on' (returns boolean)
		$_is_enabled = $this->is_any_enabled( $props, $enable_element_prop ); // not responsive field
		$_is_visible = $this->is_any_enabled( $props, $show_element_prop );   // responsive field

		return false !== $_is_enabled && $_is_visible;

	}

	/**
	 * Process font icon. -> IS IT STILL RELEVANT ???
	 * 
	 * Includes temporary fix for the bug in Divi icons rendering.
	 * @see https://github.com/elegantthemes/create-divi-extension/issues/64 
	 * 
	 * @uses et_pb_process_font_icon()
	 * 
	 * @param   string		$icon    	Icon code. Eg. "%%7%%".
	 * @param   boolean		$for_css    If the processed icon code needs to be 
	 * 									prepared for using in CSS "content" property
	 * 									rather than HTML "data-" attribute. 
	 * 									(Eg. "&#x35;" has to be converted into "\35").
	 * 
	 * @return  string					Processed icon code.
	 */
	function process_font_icon( $icon, $for_css = false ){

		// some icon codes need to be adjusted/fixed before processing
        $adjusted_icon = str_replace( 
			array( '&#091;', '\\', '&#093;', '&quot;' ), 
			array( '%91', '%92', '%93', '%22' ), 
			$icon );

		// process adjusted icon code (eg. result: &#x35; )
		$processed_icon = et_pb_process_font_icon($adjusted_icon);
 
		/**
		 * If the icon needs to be processed for CSS
		 * replace the "&#x" chars with the "\" (no need to add 00 after \ )
		 * and remove the ";" at the end of the icon code.
		 * 
		 * Eg.: "&#x35;" needs to be turned into "\35" in order to be usable
		 * for the CSS 'content' property. 
		 */
		if( $for_css === true ){
			$processed_icon = str_replace( array( '&#x', ';' ), array( '\\', '' ), esc_attr($processed_icon) );
		}

		return $processed_icon;
	}

	/**
	 * Is Divi older than the passed in version.
	 * 
	 * @since	v1.7.3
	 * 
	 * @param	string	$version	Version to compare against (eg.: "4.13.0").
	 * 
	 * @return	bool				Returns true if Divi is older, and false if Divi's version is equal to or greater than the passed in version value.
	 */
	function is_divi_older_than($version){
		return (bool)version_compare(ET_BUILDER_PRODUCT_VERSION, $version, "<");
	}

	/**
     * Font icon default value.
     * 
     * Use different font icon value formats depending on Divi version.
     * If Divi is older than 4.13.0 then use the old format (eg.: '%%20%%'),
     * otherwise use the new extended format (eg.: '&#x35;||divi||400').
     * 
     * @since   v1.7.4
     * 
     * @param   string  $old_format The font icon old format.
     * @param   string  $new_format The font icon new extended format (introduced in Divi v4.13.0).
     * 
     * @return  string              The font icon default value in correct format.
     */
    public function default_font_icon($old_format, $new_format){
        return $this->is_divi_older_than("4.13.0") ? $old_format : $new_format;
    }

	/**
	 * Checking if the passed icon value is in the old Divi icon format
	 * (copy of the @see et_pb_maybe_old_divi_font_icon() PHP function).
	 *
	 * @since v1.7.4
	 *
	 * @param string $icon_data icon value from shortcode or presets.
	 *
	 * @return bool
	 */
	function maybe_old_divi_font_icon( $icon_data ) {
		return 1 === preg_match( '/^%%[0-9]{1,3}%%$/', trim( $icon_data ) );
	}

	/**
	 * Checking if the passed icon value is extended icon type ( like a '&#x30;||divi' )
	 * (copy of the @see et_pb_maybe_extended_icon() PHP function).
	 *
	 * @since v1.7.4
	 *
	 * @param string $icon icon data.
	 *
	 * @return bool
	 */
	function maybe_extended_icon( $icon ) {
		return ! empty( $icon ) && false !== strpos( $icon, '||' );
	}

	/**
	 * Depending on the $icon_data_type, returns string unicode icon value or icon type.
	 * (copy of the @see et_pb_get_extended_icon_data() PHP function).
	 *
	 * @since v1.7.4
	 *
	 * @param string $icon_data      the string value of the icon.
	 * @param string $icon_data_type could be either 'icon_value' or 'icon_type'.
	 *
	 * @return string
	 */
	function get_extended_icon_data( $icon_data, $icon_data_type ) {
		if ( $this->maybe_extended_icon( $icon_data ) ) {
			$extended_icon_data = explode( '||', $icon_data );
			if ( ! empty( $extended_icon_data ) ) {
				switch ( $icon_data_type ) {
					case 'icon_value':
						return ( ! empty( $extended_icon_data[0] ) ) ? $extended_icon_data[0] : false;
					case 'icon_type':
						return ( ! empty( $extended_icon_data[1] ) ) ? $extended_icon_data[1] : false;
					case 'font_weight':
						return ( ! empty( $extended_icon_data[2] ) ) ? $extended_icon_data[2] : false;
				}
			}
		}
	}
	
	/**
	 * Get icon type ('fa' or 'divi')
	 * (copy of the @see et_pb_get_extended_font_icon_type() PHP function).
	 *
	 * @since v1.7.4
	 *
	 * @param string $icon_data icon data.
	 *
	 * @return string may be either 'fa' or 'divi'.
	 */
	function get_extended_font_icon_type( $icon_data ) {
		return esc_attr( $this->get_extended_icon_data( $icon_data, 'icon_type' ) );
	}

	/**
	 * Checking if the passed icon value is Divi type
	 * (copy of the @see et_pb_maybe_divi_font_icon() PHP function).
	 *
	 * @since v1.7.4
	 *
	 * @param string $icon_data extended icon value from shortcode or presets.
	 *
	 * @return bool
	 */
	function maybe_divi_font_icon( $icon_data ) {
		return ( $this->maybe_extended_icon( $icon_data ) && 'divi' === $this->get_extended_font_icon_type( $icon_data ) ) || $this->maybe_old_divi_font_icon( $icon_data );
	}

	/**
	 * Processes the icon raw data with backwards compatibility for Divi < 4.13.0 .
	 * 
	 * Backwards compatibility:
	 * If an accordion with font icons is created in Divi v4.13.x
	 * and is used in an older Divi then make sure the Divi icons are
	 * rendered properly(both old and extended formats),
	 * and no icons displayed if the FontAwesome icons used
	 * (because old Divi(< 4.13.0) does not have FA icons integrated).
	 * 
	 * @since v1.7.4
	 * 
	 * @param   string  $icon_raw_data		Icon raw data (eg.: "%%20%%" or the new extended format "&#x30;||divi||900")
	 * @param   string  $default_icon     	Font icon default value (for Button elements it's "%%20%%")
	 * @return	array						Processed icon data.
	 */
	function processed_font_icon_data( $icon_raw_data, $default_icon = '%%20%%' ){
		// Icon data object
		$icon = [];

		// If the icon value is of the old format ( eg.: '%%20%%' )
		$icon['fontFamily'] = 'ETmodules';
		$icon['fontWeight'] = '400';

		// Backwards compatibility
		if( $this->is_divi_older_than("4.13.0") ){

			$divi_icon_value = '';

			// If it's a Divi icon of old format
			if( $this->maybe_old_divi_font_icon( $icon_raw_data ) ){
				$icon['code'] = $this->process_font_icon( $icon_raw_data, true );
				return $icon;
			}

			// If it's a Divi icon of extended format
			if( $this->maybe_extended_icon( $icon_raw_data ) ){
			$divi_icon_value = 'divi' === $this->get_extended_icon_data( $icon_raw_data, 'icon_type' )
								? $this->get_extended_icon_data( $icon_raw_data, 'icon_value' )
								: $default_icon; // show the default icon if it's a FontAwesome icon
			}

			$icon['code'] = $this->process_font_icon( $divi_icon_value, true );
			return $icon;
		}

		// get the icon value
		$icon['code'] = et_pb_maybe_old_divi_font_icon( $icon_raw_data ) 
						? $this->process_font_icon( $icon_raw_data, true )  // old format value
						: $this->process_font_icon( et_pb_get_extended_font_icon_value( $icon_raw_data, true ) );  // extended format value 

		// if the icon data is of the new extended format ( eg.: '&#x30;||divi||900' )
		if( et_pb_maybe_extended_icon( $icon_raw_data ) ){
			$icon['fontFamily'] = et_pb_get_icon_font_family( $icon_raw_data );
			$icon['fontWeight'] = et_pb_get_icon_font_weight( $icon_raw_data );
		}

		return $icon;
	}

  	/**
	 * Generate font icon CSS declaration
	 * including the "content", "font-family" and "font-weight" CSS properties.
	 *
	 * @since v1.7.4
	 *
	 * @param	string 	$icon_value		Font icon value.
	 *
	 * @return 	string 					May be either '' or eg.: 'content: "5"; font-family: ETmodules !important; font-weight: 400 !important;'.
	 */
	function generate_font_icon_css_declaration( $icon_value ) {
		return $icon_value !== '' ? sprintf(
			'content: "%1$s"; font-family: %2$s !important; font-weight: %3$s !important;',
			esc_attr( $this->processed_font_icon_data( $icon_value )['code'] ),
			esc_attr( $this->processed_font_icon_data( $icon_value )['fontFamily'] ),
			esc_attr( $this->processed_font_icon_data( $icon_value )['fontWeight'] )
		) : '';
	}

	/**
	 * Declare font icon responsive CSS.
	 * 
	 * Checks if the selected icon value is of the old format (eg.: "%%20%%") or the extended format ( eg.: '&#x30;||divi||900' )
	 * and sets the 'content', 'font-family' and 'font-weight' properties for the selected icon.
	 * 
	 * @todo Does not generate the font icon hover CSS.
	 * 
	 * @since	v1.7.3
	 * @since	v1.7.4 - Added the hover icon CSS declaration.
	 * 
	 * @param	object	$processed_props	Processed props.
	 * @param	string	$render_slug		Module slug.
	 * @param	array	$args				Arguments.
	 * 			string 	$args['setting']			The font icon setting(prop) name.
	 * 			string 	$args['selector']			The icon CSS selector.
	 * 			string 	$args['hover_selector']		The icon hover CSS selector.
	 * 
	 */
	function declare_font_icon_css($props, $render_slug, $args){

		$setting 		= isset($args['setting']) ? $args['setting'] : '';
		$selector 		= isset($args['selector']) ? $args['selector'] : '';
		$hover_selector	= isset($args['hover_selector']) ? $args['hover_selector'] : '';
		$default_icon	= $this->default_font_icon('%%20%%', '&#x35;||divi||400');
		$icon_values 	= $this->get_property_values_all( $props, $setting, $default_icon, true );
		$_icon_desktop 	= isset($icon_values['desktop']) ? $icon_values['desktop'] : '';
		$_icon_hover 	= isset($icon_values['hover']) ? $icon_values['hover'] : '';
		$_icon_responsive 	= isset($icon_values['responsive']) ? $icon_values['responsive'] : '';
		$_icon_tablet 	= isset($icon_values['tablet']) ? $icon_values['tablet'] : '';
		$_icon_phone 	= isset($icon_values['phone']) ? $icon_values['phone'] : '';

		$icon = '';
		$declarations = [];
		
		// create the array to iterate and create the responsive declarations array
		$icon_values = ['desktop' => $_icon_desktop, 'tablet' => $_icon_tablet, 'phone' => $_icon_phone];

		// RESPONSIVE
		if( $_icon_responsive !== 'on' ){

			// Desktop declaration
			$declarations['desktop'] = $this->generate_font_icon_css_declaration( $_icon_desktop );

		} else {

			// Responsive declarations
			foreach ( $icon_values as $device => $icon_value ){
				$declarations[$device] = $this->generate_font_icon_css_declaration( $icon_value );
			}
		}

		// Declare the font icon responsive CSS 
		et_pb_responsive_options()->declare_responsive_css( $declarations, $selector, $render_slug );

		// HOVER
		if( $_icon_hover !== NULL ){

			$declarations_h = array(
				'desktop_only' => $this->generate_font_icon_css_declaration( $_icon_hover ),
			);

			// Declare the font icon hover CSS 
			et_pb_responsive_options()->declare_responsive_css( $declarations_h, $hover_selector, $render_slug );
		}
	}

	/**
	 * Declare responsive transition styles.
	 * 
	 * @since	v1.0.0 
	 * 
	 * @param 	object 	$module 				Module object.
	 * @param 	string 	$module 				Module slug.
	 * @param 	array  	$args					All arguments.
	 * 			array 	$args['properties']		CSS properties array for which the transition style needs to be declared.
	 * 			string 	$args['selector']		CSS selector.
	 * 			string 	$args['additional_css']	Additional CSS (eg. 'important').
	 * 
	 */
	function declare_responsive_transition_styles( $module, $render_slug, $args = array() ){

		$properties 	= isset($args['properties']) ? $args['properties'] : array();
		$selector		= isset($args['selector']) ? $args['selector'] : '';
		$additional_css	= isset($args['additional_css']) ? $args['additional_css'] : '';

		$style 			= $module->get_transition_style( $properties );
		$style_tablet 	= $module->get_transition_style( $properties, 'tablet' );
		$style_phone 	= $module->get_transition_style( $properties, 'phone' );

		if( $additional_css === 'important' ){
			$style 			= str_replace(';', ' !important;', $style);
			$style_tablet 	= str_replace(';', ' !important;', $style_tablet);
			$style_phone 	= str_replace(';', ' !important;', $style_phone);
		}
		
		// Desktop
		$module::set_style( $render_slug, array(
			'selector'    => $selector,
			'declaration' => esc_html( $style ),
		) );

		// Tablet.
		if ( $style_tablet !== $style ) {
			$module::set_style( $render_slug, array(
				'selector'    => $selector,
				'declaration' => esc_html( $style_tablet ),
				'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
			) );
		}

		// Phone.
		if ( $style_phone !== $style || $style_phone !== $style_tablet ) {
			$module::set_style( $render_slug, array(
				'selector'    => $selector,
				'declaration' => esc_html( $style_phone ),
				'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
			) );
		}
	}

	/**
	 * Generate margin/padding CSS declarations for declaring CSS
	 * using the @see et_pb_responsive_options()->declare_responsive_css() method.
	 * 
	 * @since v1.0.0 
	 *
	 * @param object  $module			Module object.
	 * @param string  $prop_name     	Property name.
	 * @param string  $default		 	Default value (eg.: '5px|5px|5px|5px|false|false').
	 * @param boolean $force_return  	Force to return any values found.
	 * @param string  $css_property     CSS property name(must be 'margin' or 'padding').
	 * 
	 * @return	array					Margin/padding CSS declaration(s) array.
	 * 
	 * The returned array looks like this:
	 * array(
	 * 	'desktop' => array(
	 * 		'top' 	=> 'padding-top: 10px;',
	 * 		'right' => 'padding-right: 10px;',
	 * 		'bottom'=> 'padding-bottom: 10px;',
	 * 		'left' 	=> 'padding-left: 10px;',
	 * 	),
	 * 	'tablet' => array( ... ),
	 * 	'phone' => array( ... )
	 * );
	 * 
	 */
	function generate_css_declarations__spacing($module, $prop_name, $default, $force_return, $css_property){

		// margin or padding declarations array of ALL devices
		$responsive_spacing = array();

		$prop_values = $this->get_property_values_all( $module->props, $prop_name, $default, $force_return );

		foreach ($prop_values as $key => $value){
			// filter out the 'responsive' and 'hover' keys leaving just devices ('desktop', 'tablet' and 'phone')
			if( $key !== 'responsive' && $key !== 'hover' ){

				// margin or padding declarations array of the device
				$spacing = array();

				$value = explode("|", $value);

				$spacing['top'] 	= !empty($value[0]) ? "{$css_property}-top: {$value[0]};" : '';
				$spacing['right'] 	= !empty($value[1]) ? "{$css_property}-right: {$value[1]};" : '';
				$spacing['bottom'] 	= !empty($value[2]) ? "{$css_property}-bottom: {$value[2]};" : '';
				$spacing['left']	= !empty($value[3]) ? "{$css_property}-left: {$value[3]};" : '';

				$responsive_spacing[$key] = $spacing;
			}
		}

		return $responsive_spacing;
	}

	/**
	 * Mobile menu parent arrow(toggle) alignment.
	 * Aligns the mobile menu parent arrow to LEFT 
	 * when the mobile menu item text is aligned to RIGHT.
	 * 
	 * @since	v1.0.0
	 * 
	 * @param array  	$props			Module props.
	 * @param string  	$prop_name     	Property name.
	 * @param string  	$css_selector	CSS selector.
	 * @param boolean 	$render_slug  	Slug.
	 * 
	 */
	function mobile_parent_arrow_alignment( $props, $prop_name, $css_selector, $render_slug ){

		$toggle_alignment_declarations = array();

		// get prop values
		$text_align_values = et_pb_responsive_options()->get_property_values( $props, $prop_name );
		
		foreach ( $text_align_values as $device => $value ) {
			// If text is not right aligned.
			if ( 'right' !== $value ) {
				// Move submenu toggle to right
				$toggle_alignment_declarations[ $device ] = '' !== $value ? 'right: 0; left: auto;' : '';
			} else {
				// Move submenu toggle to left
				$toggle_alignment_declarations[ $device ] = 'right: auto; left: 0;';
			}
		}

		// Generate style for desktop, tablet, and phone.
		et_pb_responsive_options()->declare_responsive_css(
			$toggle_alignment_declarations,
			$css_selector,
			$render_slug
		);
	}

	/**
	 * Declares the CSS for controlling the 
	 * element's visibility per device using the "yes_no_button" field.
	 * 
	 * @since	v1.0.0
	 * 
	 * @param array  	$props			Module props.
	 * @param string  	$prop_name     	Property name.
	 * @param string  	$css_selector	CSS selector.
	 * @param boolean 	$render_slug  	Slug.
	 * 
	 */
	function declare_element_responsive_visibility_css( $props, $prop_name, $css_selector, $render_slug ){

		$css_declarations = array();

		// get prop values
		$yes_no_values = et_pb_responsive_options()->get_property_values( $props, $prop_name );
		
		foreach ( $yes_no_values as $device => $value ) {
			// If not enabled.
			if ( 'on' !== $value ) {
				// Hide the element
				$css_declarations[ $device ] = '' !== $value ? 'display: none;' : '';
			} else {
				// Show the element
				$css_declarations[ $device ] = 'display: flex;';
			}
		}

		// Generate style for desktop, tablet, and phone.
		et_pb_responsive_options()->declare_responsive_css(
			$css_declarations,
			$css_selector,
			$render_slug
		);
	}

	/**
	 * Declares the CSS for controlling the 
	 * cart contents visibility per device using the "select" field ("dvmm_cart_show_contents" prop).
	 * 
	 * @since	v1.3
	 * 
	 * @param array  	$module			Module object.
	 * @param string  	$prop_name     	Property name.
	 * @param boolean 	$render_slug  	Slug.
	 * 
	 */
	function declare_cart_contents_responsive_visibility_css( $module, $prop_name, $render_slug ){

		// get prop values
		$select_values_all = $this->get_property_values_all( $module->props, $prop_name, "count_text_price", true );

		foreach ( $select_values_all as $device => $value ) {

			$css_declarations_hide = array();
			$css_selector_hide = '';

			$css_declarations_show = array();
			$css_selector_show = '';

			// Decide which element(s) to show/hide
			switch ($value) {
				case 'none':
					// hide all cart contents
					$css_selector_hide = "{$module->main_css_element} .dvmm_cart_contents";
					// 
					$css_selector_show = "";
					break;
				case 'count_only':
					// hide the Item(s) text and the total amount
					$css_selector_hide = "{$module->main_css_element} .dvmm_cart_items_text, {$module->main_css_element} .dvmm_cart_total_amount";
					// show
					$css_selector_show = "{$module->main_css_element} .dvmm_cart_contents, {$module->main_css_element} .dvmm_cart_items_count";
					break;
				case 'count_and_text':
					// hide the total amount
					$css_selector_hide = "{$module->main_css_element} .dvmm_cart_total_amount";
					// show
					$css_selector_show = "{$module->main_css_element} .dvmm_cart_contents, {$module->main_css_element} .dvmm_cart_items_count, {$module->main_css_element} .dvmm_cart_items_text";
					break;
				case 'count_text_price':
					/**
					 * Don't hide cart contents.
					 * Applying the selector so that the ".et-db #et-boc .et-l" doesn't get affected(it's added by default if the selector is empty but the declaration has a value). 
					 * That's why the $css_declarations_hide should be empty in this case (when the value is 'count_text_price' - the default value)
					 * so that the CSS does not get generated.
					 */ 
					$css_selector_hide = "{$module->main_css_element} .dvmm_cart_contents";
					// $css_selector_hide = "";
					// show
					$css_selector_show = "{$module->main_css_element} .dvmm_cart_contents, {$module->main_css_element} .dvmm_cart_items_count, {$module->main_css_element} .dvmm_cart_items_text, {$module->main_css_element} .dvmm_cart_total_amount";
					break;
				case 'count_and_price':
					// hide the Item(s) text
					$css_selector_hide = "{$module->main_css_element} .dvmm_cart_items_text";
					// show
					$css_selector_show = "{$module->main_css_element} .dvmm_cart_contents, {$module->main_css_element} .dvmm_cart_items_count, {$module->main_css_element} .dvmm_cart_total_amount";
					break;
				case 'price_only':
					// hide the items count(both the number and the Item(s) text)
					$css_selector_hide = "{$module->main_css_element} .dvmm_cart_items_count";
					// show
					$css_selector_show = "{$module->main_css_element} .dvmm_cart_contents, {$module->main_css_element} .dvmm_cart_total_amount";
					break;														
				default:
					/**
					 * Don't hide cart contents.
					 * Same as for the 'count_text_price' value.
					 */ 
					$css_selector_hide = "{$module->main_css_element} .dvmm_cart_contents";  
					// $css_selector_hide = "";  
					// show
					$css_selector_show = "";
					break;
			}

			//
			switch ($device) {
				case 'desktop':
					$css_declarations_hide[ 'desktop' ] = $value !== 'count_text_price' ? 'display: none;' : '';
					$css_declarations_show[ 'desktop' ] = $value !== 'none' ? 'display: flex;' : '';
					break;
				case 'tablet':
					if($select_values_all['responsive'] === 'on'){
						$css_declarations_hide[ 'tablet' ] = $value !== 'count_text_price' ? 'display: none;' : '';
						$css_declarations_show[ 'tablet' ] = $value !== 'none' ? 'display: flex;' : '';
					} else {
						$css_declarations_hide[ 'tablet' ] = '';
						$css_declarations_show[ 'tablet' ] = '';
					}
					break;
				case 'phone':
					if($select_values_all['responsive'] === 'on'){
						$css_declarations_hide[ 'phone' ] = $value !== 'count_text_price' ? 'display: none;' : '';
						$css_declarations_show[ 'phone' ] = $value !== 'none' ? 'display: flex;' : '';
					} else {
						$css_declarations_hide[ 'phone' ] = '';
						$css_declarations_show[ 'phone' ] = '';
					}
					break;
				default:
					$css_declarations_hide[ 'phone' ] = '';
					$css_declarations_show[ 'phone' ] = '';
					break;
			}

			/**
			 * Generate style for desktop, tablet and phone.
			 * Need to hide the element(s) that were(probably) set to show on other device(s)
			 * and show the element(s) that were(probably) set to hide on other device(s).
			 */
			// Hide element(s)
			et_pb_responsive_options()->declare_responsive_css(
				$css_declarations_hide,
				$css_selector_hide,
				$render_slug
			);
			// Show element(s)
			et_pb_responsive_options()->declare_responsive_css(
				$css_declarations_show,
				$css_selector_show,
				$render_slug
			);
		}
	}

	/**
	 * Declares the CSS for controlling the element COLUMN RESPONSIVE WIDTH.
	 * 
	 * The reason to declare this CSS is that we need the "auto" value to stretch the column 
	 * by unsetting the width property (width: unset;) 
	 * and setting the flex property to auto (flex: auto;), 
	 * rather than applying it to the width property (width: auto;) which does not stretch the column but 
	 * makes it have the same width as it's content.
	 * 
	 * Values other than "auto" unset the flex property (flex: unset;) 
	 * and are applied to the width property (width: value;).
	 * 
	 * @since	v1.0.0
	 * 
	 * @param 	array  	$props					Module props.
	 * @param 	boolean	$render_slug  			Slug.
	 * @param 	array  	$args					Arguments.
	 * 
	 */
	function declare_element_column_width_css( $props, $render_slug, $args = array() ){

		$setting 	= isset($args['setting']) ? $args['setting'] : '';
		$setting_f 	= isset($args['setting_fixed']) ? $args['setting_fixed'] : '';
		$selector 	= isset($args['selector']) ? $args['selector'] : array();

		$_is_fixed_header_enabled = $props['dvmm_enable_fixed_header'] === 'on' ? true : false;

		/**
		 * NORMAL HEADER
		 */
		$css_declarations 	= array();

		// get prop values
		$prop_values = et_pb_responsive_options()->get_property_values( $props, $setting );
		
		foreach ( $prop_values as $device => $value ) {

			$value = trim($value);

            if('auto' !== $value){
                $css_declarations[ $device ] = $value !== '' ? "width: {$value}; flex: unset;" : "";
            } else {
                $css_declarations[ $device ] = "flex: {$value}; width: unset;";
			}

		}

		// Generate style for desktop, tablet, and phone.
		et_pb_responsive_options()->declare_responsive_css(
			$css_declarations,
			$selector['normal'],
			$render_slug
		);

		/**
		 * FIXED HEADER
		 */
		if($_is_fixed_header_enabled === true && $setting_f !== ''){
			
			$css_declarations_f	= array();

			// get prop values
			$prop_values_f = et_pb_responsive_options()->get_property_values( $props, $setting_f );
			
			foreach ( $prop_values_f as $device => $value ) {

				$value = trim($value);

				if('auto' !== $value){
					$css_declarations_f[ $device ] = $value !== '' ? "width: {$value}; flex: unset;" : "";
				} else {
					$css_declarations_f[ $device ] = "flex: {$value}; width: unset;";
				}
			}

			// Generate style for desktop, tablet, and phone.
			et_pb_responsive_options()->declare_responsive_css(
				$css_declarations_f,
				$selector['fixed'],
				$render_slug
			);
		}
	}

	/**
	 * Declares the CSS for element's content HORIZONTAL ALIGNMENT.
	 * 
	 * This CSS is declared because we need to apply
	 * the flexbox horizontal alignment values (justify-content: value;) to the element COLUMN
	 * whereas to STRETCH the element content horizontally it(the element content, not the column) 
	 * needs to be applied the "auto" value to the "flex" property (flex:auto;). 
	 * 
	 * So, we need to use two different selectors: one for the column and the other for the content(for the "flex:auto" value).
	 * Eg.: for the Menu element all "justify-content" values are applied to the "ul.dvmm_menu"(the menu items container)
	 * whereas the "flex: auto;" (the "Stretch" option) is applied to the "ul.dvmm_menu > li" (main menu items).
	 * 
	 * (CSS Flexbox provides the "stretch" option for vertical alignment(align-items) but not for horizontal(justify-content),
	 * that's why this workaround is needed).
	 * 
	 * @since	v1.0.0
	 * 
	 * @param 	array  	$props					Module props.
	 * @param 	boolean	$render_slug  			Slug.
	 * @param 	array  	$args					Arguments.
	 * 
	 */
	function declare_element_content_horizontal_alignment_css( $props, $render_slug, $args = array() ){

		$setting 	= isset($args['setting']) ? $args['setting'] : '';
		$setting_f 	= isset($args['setting_fixed']) ? $args['setting_fixed'] : '';
		$selectors 	= isset($args['selector']) ? $args['selector'] : array();

		$_is_fixed_header_enabled = $props['dvmm_enable_fixed_header'] === 'on' ? true : false;

		/**
		 * NORMAL HEADER
		 */
		// get prop values
		$prop_values = et_pb_responsive_options()->get_property_values( $props, $setting );
		
		foreach ( $prop_values as $device => $value ) {

			$css_declarations = array();
			$value = trim($value);

			// If non-Stretch option selected
			if('auto' !== $value){
				$selector = $selectors['normal'];
				$css_declarations[ $device ] = $value !== '' ? "justify-content: {$value};" : "";

				// for disabling the 'flex: auto;' possibly set for other devices for the Normal header element content
				$declarations[$device] = $value !== '' ? "flex: unset;" : "";

			} else {
				$selector = $selectors['normal_stretch'];
				$css_declarations[ $device ] = "flex: {$value};";
			}

			// Generate style for desktop, tablet, and phone.
			et_pb_responsive_options()->declare_responsive_css(
				$css_declarations,
				$selector,
				$render_slug
			);
		}

		/**
		 * Disable the 'flex: auto;' possibly set for a device
		 * to prevent it from interfering with the non-Stretch option selected for another device.
		 */
		// Generate style for desktop, tablet, and phone.
		et_pb_responsive_options()->declare_responsive_css(
			$declarations,
			$selectors['normal_stretch'],
			$render_slug
		);

		/**
		 * FIXED HEADER
		 */
		if($_is_fixed_header_enabled === true && $setting_f !== ''){

			// get prop values
			$prop_values_f = et_pb_responsive_options()->get_property_values( $props, $setting_f );
			
			foreach ( $prop_values_f as $device => $value ) {

				$css_declarations_f	= array();
				$value = trim($value);

				// If non-Stretch option selected
				if('auto' !== $value){
					$selector_f = $selectors['fixed'];
					$css_declarations_f[ $device ] = $value !== '' ? "justify-content: {$value};" : "";

					// for disabling the 'flex: auto;' possibly set for "normal_stretch" selector (for Normal header element content)
					$declarations_f[$device] = $prop_values[$device] === 'auto' && $value !== '' ? "flex: unset;" : "";

				} else {
					$selector_f = $selectors['fixed_stretch'];
					$css_declarations_f[ $device ] = "flex: {$value};";
				}

				// Generate style for desktop, tablet, and phone.
				et_pb_responsive_options()->declare_responsive_css(
					$css_declarations_f,
					$selector_f,
					$render_slug
				);

			}

			/**
			 * Disable the 'flex: auto;' possibly set for "normal_stretch" selector (Normal header Element content)
			 * to prevent it from interfering with the non-Stretch option selected for the Fixed Header.
			 * 
			 * For example, if the Desktop menu items are set to Stretch for Normal header but
			 * a different option is set for the Fixed header then this option will have no effect and
			 * the menu items will still be "stretched" on Fixed header too 
			 * because the Stretch value is applied to the menu items (flex: auto;) 
			 * whereas the rest of the options are applied to their container (justify-content: value;).
			 * 
			 */
			// Generate style for desktop, tablet, and phone.
			et_pb_responsive_options()->declare_responsive_css(
				$declarations_f,
				$selectors['fixed_stretch'],
				$render_slug
			);
		}
	}

	/**
	 * Get alignment options.
	 * 
	 * Difference between the Horizontal and Vertical "Stretch" options:
	 *  - Horizontal: the Stretch option has value "auto" (flex: auto;)
	 *  - Vertical: the Stretch option has value "stretch" (align-items: stretch;)
	 * 
	 * @since v1.0.0
	 * 
	 * @param 	string	$alignment		Alignment type (vertical or horizontal).
	 * @param 	string	$options		Requested options (eg. "general", etc.).
	 * 
	 * @return 	array 					Alignment options.
	 * 
	 */
	function get_alignment_options( $alignment = '', $options = '' ) {
		$options_sets = apply_filters( 'dvmm_mad_menu_alignment_options', array(
			'vertical' => array(
				'general' => array(
					''				=> esc_html__( 'Default', 'dvmm-divi-mad-menu' ),
					'flex-start'	=> esc_html__( 'Top', 'dvmm-divi-mad-menu' ),
					'center' 		=> esc_html__( 'Center', 'dvmm-divi-mad-menu' ),
					'flex-end' 		=> esc_html__( 'Bottom', 'dvmm-divi-mad-menu' ),
					'stretch' 		=> esc_html__( 'Stretch', 'dvmm-divi-mad-menu' ),
				),
			),
			'horizontal' => array(
				'general' => array(
					''				=> esc_html__( 'Default', 'dvmm-divi-mad-menu' ),
					'flex-start'	=> esc_html__( 'Left', 'dvmm-divi-mad-menu' ),
					'center' 		=> esc_html__( 'Center', 'dvmm-divi-mad-menu' ),
					'flex-end' 		=> esc_html__( 'Right', 'dvmm-divi-mad-menu' ),
					'auto' 			=> esc_html__( 'Stretch', 'dvmm-divi-mad-menu' ),
				),
				'logo' => array(
					''				=> esc_html__( 'Default', 'dvmm-divi-mad-menu' ),
					'flex-start'	=> esc_html__( 'Left', 'dvmm-divi-mad-menu' ),
					'center' 		=> esc_html__( 'Center', 'dvmm-divi-mad-menu' ),
					'flex-end' 		=> esc_html__( 'Right', 'dvmm-divi-mad-menu' ),
				),
				'menu_items' => array(
					''				=> esc_html__( 'Default', 'dvmm-divi-mad-menu' ),
					'flex-start'	=> esc_html__( 'Left', 'dvmm-divi-mad-menu' ),
					'center' 		=> esc_html__( 'Center', 'dvmm-divi-mad-menu' ),
					'flex-end' 		=> esc_html__( 'Right', 'dvmm-divi-mad-menu' ),
					'space-between' => esc_html__( 'Space-between', 'dvmm-divi-mad-menu' ),
					'space-around' 	=> esc_html__( 'Space-around', 'dvmm-divi-mad-menu' ),
					'space-evenly' 	=> esc_html__( 'Space-evenly', 'dvmm-divi-mad-menu' ),
					'auto' 			=> esc_html__( 'Stretch', 'dvmm-divi-mad-menu' ),
				),
			)
		) );

		if ( '' === $alignment || '' === $options ) {
			return array();
		}

		return isset( $options_sets[$alignment][$options] ) ? $options_sets[$alignment][$options] : array();
	}

	/**
	 * Add the element column layout fields.
	 * 
	 * Field priorities are set so that the "column width" layout fields render after the
	 * "alignment" layout fields while preventing the "Normal" and "Fixed" header layout settings
	 * from mixing with each other(@see the add_element_alignment_fields() method).
	 * 
	 * @todo Add other column settings using this function as well (eg. the "order" fields).
	 * 
	 * @since	v1.0.0 (updated in v1.7)
	 * 
	 * @param	array  	$args					Element data.
	 * @param	string  $args['element_name']	Element name (Eg. "Logo").
	 * @param	string  $args['element_slug']	Element slug (Eg. "logo").
	 * @param	string  $args['tab_slug']		Element tab slug (Eg. "advanced").
	 * @param	string  $args['toggle_slug']	Element toggle slug (Eg. "logo_design").
	 * 
	 * @return	array							Element's column fields.
	 * 
	 */
	function add_element_column_layout_fields( $args = array() ){

		$element_name 	= isset($args['element_name']) ? $args['element_name'] : '';
		$element_slug 	= isset($args['element_slug']) ? $args['element_slug'] : '';
		$tab_slug 		= isset($args['tab_slug']) ? $args['tab_slug'] : 'advanced';
		$toggle_slug 	= isset($args['toggle_slug']) ? $args['toggle_slug'] : '';
		$sub_toggle 	= isset($args['sub_toggle']) ? $args['sub_toggle'] : '';

		$fields = array();

		if( '' !== $element_name && '' !== $element_slug ){

			$fields["dvmm_{$element_slug}_col_width"] = array(
				'label'           => sprintf( esc_html__( '%1$s Column Width', 'dvmm-divi-mad-menu' ), $element_name ),
				'description'     => sprintf( esc_html__( 'Adjust the width of the %1$s element column. To stretch the column apply the "auto" value.', 'dvmm-divi-mad-menu' ), $element_name ),
				'type'            => 'range',
				'mobile_options'  => true,
				'responsive'      => true,
				'option_category' => 'layout',
				'show_if'			=> array(
					"dvmm_enable_{$element_slug}" => 'on',
				),
				'default'         => '',
				'default_on_front'=> '',
				'allowed_values'  => et_builder_get_acceptable_css_string_values( 'width' ),
				'allow_empty'     => true,
				'default_unit'    => '%',
				'allowed_units'   => array( '%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
				'validate_unit'   => true,
				'range_settings'  => array(
					'min'  => '0',
					'max'  => '100',
					'step' => '1',
				),
				'priority'		    => 30,
				'tab_slug'          => $tab_slug,
				'toggle_slug'       => $toggle_slug,
				'sub_toggle'	    => $sub_toggle,
			);
			
			$fields["dvmm_{$element_slug}_col_max_width"] = array(
				'label'           => sprintf( esc_html__( '%1$s Column Max Width', 'dvmm-divi-mad-menu' ), $element_name ),
				'description'     => sprintf( esc_html__( 'Adjust the max width of the %1$s element column.', 'dvmm-divi-mad-menu' ), $element_name ),
				'type'            => 'range',
				'mobile_options'  => true,
				'responsive'      => true,
				'option_category' => 'layout',
				'show_if'			=> array(
					"dvmm_enable_{$element_slug}" => 'on',
				),
				'default'         => '',
				'default_on_front'=> '',
				'allowed_values'  => et_builder_get_acceptable_css_string_values( 'max-width' ),
				'allow_empty'     => true,
				'default_unit'    => '%',
				'allowed_units'   => array( '%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
				'validate_unit'   => true,
				'range_settings'  => array(
					'min'  => '0',
					'max'  => '100',
					'step' => '1',
				),
				'priority'		    => 40,
				'tab_slug'          => $tab_slug,
				'toggle_slug'       => $toggle_slug,
				'sub_toggle'	    => $sub_toggle,
			);
 
			/**
			 * Separate visually the "Normal" header layout settings from the "Fixed" header layout settings.
			 * 
			 * Priority is set so that it appears in between the "Normal" and "Fixed" header layout settings
			 * (10>20>30>40> 45 <50<60<70<80).
			 * 
			 * @since	v1.7
			 */
			$fields["dvmm_{$element_slug}_fixed_header_settings"] = array(
				'label'           => '',
				'type'            => 'warning',
				'value'           => true,
				'display_if'      => true,
				'message'         => esc_html__( '<p style="line-height: 1.7em; padding: 10px 10px 5px 0px; border-bottom: 2px solid #2b87da; border-radius: 0px; color: #2b87da; background-color: #ffffff; font-size: 15px;">Fixed Header Layout Settings</p>', 'dvmm-divi-mad-menu' ),
				'option_category' => 'configuration',
				'show_if'     => array(
					'dvmm_enable_fixed_header'		=> 'on',
					"dvmm_enable_{$element_slug}" 	=> 'on',
				),
				'bb_support'      => false,
				'priority'		  => 45,
				'tab_slug'        => $tab_slug,
				'toggle_slug'     => $toggle_slug,
				'sub_toggle' 	  => $sub_toggle
			);

			$fields["dvmm_{$element_slug}_col_width_f"] = array(
				'label'           => sprintf( esc_html__( '%1$s Column Width (Fixed)', 'dvmm-divi-mad-menu' ), $element_name ),
				'description'     => sprintf( esc_html__( 'Adjust the width of the fixed header %1$s element column. To stretch the column apply the "auto" value.', 'dvmm-divi-mad-menu' ), $element_name ),
				'type'            => 'range',
				'mobile_options'  => true,
				'responsive'      => true,
				'option_category' => 'layout',
				'show_if'			=> array(
					'dvmm_enable_fixed_header' 		=> 'on',
					"dvmm_enable_{$element_slug}" 	=> 'on',
				),
				'default'         => '',
				'default_on_front'=> '',
				'allowed_values'  => et_builder_get_acceptable_css_string_values( 'width' ),
				'allow_empty'     => true,
				'default_unit'    => '%',
				'allowed_units'   => array( '%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
				'validate_unit'   => true,
				'range_settings'  => array(
					'min'  => '0',
					'max'  => '100',
					'step' => '1',
				),
				'priority'		    => 70,
				'tab_slug'          => $tab_slug,
				'toggle_slug'	  	=> "{$toggle_slug}",
				'sub_toggle'	    => $sub_toggle,
			);

			$fields["dvmm_{$element_slug}_col_max_width_f"] = array(
				'label'           => sprintf( esc_html__( '%1$s Column Max Width (Fixed)', 'dvmm-divi-mad-menu' ), $element_name ),
				'description'     => sprintf( esc_html__( 'Adjust the max width of the fixed header %1$s element column.', 'dvmm-divi-mad-menu' ), $element_name ),
				'type'            => 'range',
				'mobile_options'  => true,
				'responsive'      => true,
				'option_category' => 'layout',
				'show_if'			=> array(
					'dvmm_enable_fixed_header' => 'on',
					"dvmm_enable_{$element_slug}" => 'on',
				),
				'default'         => '',
				'default_on_front'=> '',
				'allowed_values'  => et_builder_get_acceptable_css_string_values( 'max-width' ),
				'allow_empty'     => true,
				'default_unit'    => '%',
				'allowed_units'   => array( '%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
				'validate_unit'   => true,
				'range_settings'  => array(
					'min'  => '0',
					'max'  => '100',
					'step' => '1',
				),
				'priority'		    => 80,
				'tab_slug'          => $tab_slug,
				'toggle_slug'	  	=> "{$toggle_slug}",
				'sub_toggle'	    => $sub_toggle,
			);

		}

		return $fields;
	}

	/**
	 * Add the element column design fields.
	 * 
	 * @todo Maybe add other column design settings using this function.
	 * 
	 * @since	v1.0.0 (updated in v1.7)
	 * 
	 * @param	array  	$args					Element data.
	 * @param	string  $args['element_name']	Element name (Eg. "Logo").
	 * @param	string  $args['element_slug']	Element slug (Eg. "logo").
	 * @param	string  $args['tab_slug']		Element tab slug (Eg. "advanced").
	 * @param	string  $args['toggle_slug']	Element toggle slug (Eg. "logo_design").
	 * 
	 * @return	array							Element's column fields.
	 * 
	 */
	function add_element_column_design_fields( $args = array() ){

		$element_name 	= isset($args['element_name']) ? $args['element_name'] : '';
		$element_slug 	= isset($args['element_slug']) ? $args['element_slug'] : '';
		$tab_slug 		= isset($args['tab_slug']) ? $args['tab_slug'] : 'advanced';
		$toggle_slug 	= isset($args['toggle_slug']) ? $args['toggle_slug'] : '';

		$fields = array();

		if( '' !== $element_name && '' !== $element_slug ){
			
			$fields["dvmm_{$element_slug}_col_bg_color"] = array(
				'label'           => sprintf( esc_html__( '%1$s Column Background Color', 'dvmm-divi-mad-menu' ), $element_name ),
				'description'     => sprintf( esc_html__( 'Set the %1$s element column background color.', 'dvmm-divi-mad-menu' ), $element_name ),
				'type'            => 'color-alpha',
				'option_category' => 'basic_option',
				'show_if'         => array(
					"dvmm_enable_{$element_slug}" => 'on',
				),
				'mobile_options'  => true,
				'responsive'      => true,
				'hover'           => 'tabs',
				'custom_color'    => true,
				'default'         => '',
				'tab_slug'        => $tab_slug,
				'toggle_slug'     => $toggle_slug,
				'sub_toggle'   	  => 'normal',
			);

			$fields["dvmm_{$element_slug}_col_bg_color_f"] = array(
				'label'           => sprintf( esc_html__( '%1$s Column Background Color (Fixed)', 'dvmm-divi-mad-menu' ), $element_name ),
				'description'     => sprintf( esc_html__( 'Set the fixed header %1$s element column background color.', 'dvmm-divi-mad-menu' ), $element_name ),
				'type'            => 'color-alpha',
				'option_category' => 'basic_option',
				'show_if'         => array(
					'dvmm_enable_fixed_header' => 'on',
					"dvmm_enable_{$element_slug}" => 'on',
				),
				'mobile_options'  => true,
				'responsive'      => true,
				'hover'           => 'tabs',
				'custom_color'    => true,
				'default'         => '',
				'tab_slug'		  => $tab_slug,
				'toggle_slug'	  => "{$toggle_slug}",
				'sub_toggle'   	  => 'fixed',
			);

		}

		return $fields;
	}

	/**
	 * Add the element fields.
	 * 
	 * Field priorities are set so that the "column width" layout fields render after the
	 * "alignment" layout fields while preventing the "Normal" and "Fixed" header layout settings
	 * from mixing with each other(@see the add_element_column_layout_fields() method).
	 * 
	 * @todo Add other element settings using this function as well (eg. the "color" fields).
	 * 
	 * @since	v1.0.0 (updated in v1.7)
	 * 
	 * @param	array  	$args					Element data.
	 * @param	string  $args['element_name']	Element name (Eg. "Logo").
	 * @param	string  $args['element_slug']	Element slug (Eg. "logo").
	 * @param	string  $args['setting_base']	Setting base (Eg. "items" in "dvmm_items_vertical_alignment").
	 * @param	string  $args['tab_slug']		Field tab slug (Eg. "advanced").
	 * @param	string  $args['toggle_slug']	Field toggle slug (Eg. "logo_design").
	 * 
	 * @return	array							Element's fields.
	 * 
	 */
	function add_element_alignment_fields( $args = array() ){

		$element_name 	= isset($args['element_name']) ? $args['element_name'] : '';
		$element_slug 	= isset($args['element_slug']) ? $args['element_slug'] : '';
		$setting_base 	= isset($args['setting_base']) ? $args['setting_base'] : '';
		$vertical_options 	= isset($args['vertical_options']) ? $args['vertical_options'] : '';
		$horizontal_options = isset($args['horizontal_options']) ? $args['horizontal_options'] : '';
		$tab_slug 		= isset($args['tab_slug']) ? $args['tab_slug'] : 'advanced';
		$toggle_slug 	= isset($args['toggle_slug']) ? $args['toggle_slug'] : '';
		$sub_toggle 	= isset($args['sub_toggle']) ? $args['sub_toggle'] : '';

		$fields = array();

		if( '' !== $element_name && '' !== $element_slug && '' !== $setting_base ){

			$fields["dvmm_{$setting_base}_vertical_alignment"] = array(
				'label'           => sprintf( esc_html__( '%1$s Vertical Alignment', 'dvmm-divi-mad-menu' ), $element_name ),
				'description'     => sprintf( esc_html__( 'Align the %1$s vertically.', 'dvmm-divi-mad-menu' ), $element_name ),
				'type'            => 'select',
				'mobile_options'  => true,
				'responsive'      => true,
				'option_category' => 'layout',
				'show_if'			=> array(
					"dvmm_enable_{$element_slug}" => 'on',
				),
				'default'         => 'center',
				'options' 		  => $this->get_alignment_options('vertical', $vertical_options),
				'priority'		  => 10,
				'tab_slug'        => $tab_slug,
				'toggle_slug'     => $toggle_slug,
				'sub_toggle'	  => $sub_toggle,
			);
			
			$fields["dvmm_{$setting_base}_horizontal_alignment"] = array(
				'label'           => sprintf( esc_html__( '%1$s Horizontal Alignment', 'dvmm-divi-mad-menu' ), $element_name ),
				'description'     => sprintf( esc_html__( 'Align the %1$s horizontally.', 'dvmm-divi-mad-menu' ), $element_name ),
				'type'            => 'select',
				'mobile_options'  => true,
				'responsive'      => true,
				'option_category' => 'layout',
				'show_if'			=> array(
					"dvmm_enable_{$element_slug}" => 'on',
				),
				'default'         => 'center',
				'options' 		  => $this->get_alignment_options('horizontal', $horizontal_options),
				'priority'		  => 20,
				'tab_slug'        => $tab_slug,
				'toggle_slug'     => $toggle_slug,
				'sub_toggle'	  => $sub_toggle,
			);

			$fields["dvmm_{$setting_base}_vertical_alignment_f"] = array(
				'label'           => sprintf( esc_html__( '%1$s Vertical Alignment (Fixed)', 'dvmm-divi-mad-menu' ), $element_name ),
				'description'     => sprintf( esc_html__( 'Align the fixed header %1$s vertically.', 'dvmm-divi-mad-menu' ), $element_name ),
				'type'            => 'select',
				'mobile_options'  => true,
				'responsive'      => true,
				'option_category' => 'layout',
				'show_if'			=> array(
					'dvmm_enable_fixed_header' 		=> 'on',
					"dvmm_enable_{$element_slug}" 	=> 'on',
				),
				'default'         => '',
				'options' 		  => $this->get_alignment_options('vertical', $vertical_options),
				'priority'		  => 50,
				'tab_slug'        => $tab_slug,
				'toggle_slug'	  => "{$toggle_slug}",
				'sub_toggle'	  => $sub_toggle,
			);

			$fields["dvmm_{$setting_base}_horizontal_alignment_f"] = array(
				'label'           => sprintf( esc_html__( '%1$s Horizontal Alignment (Fixed)', 'dvmm-divi-mad-menu' ), $element_name ),
				'description'     => sprintf( esc_html__( 'Align the fixed header %1$s horizontally.', 'dvmm-divi-mad-menu' ), $element_name ),
				'type'            => 'select',
				'mobile_options'  => true,
				'responsive'      => true,
				'option_category' => 'layout',
				'show_if'			=> array(
					'dvmm_enable_fixed_header' 		=> 'on',
					"dvmm_enable_{$element_slug}" 	=> 'on',
				),
				'default'         => '',
				'options' 		  => $this->get_alignment_options('horizontal', $horizontal_options),
				'priority'		  => 60,
				'tab_slug'        => $tab_slug,
				'toggle_slug'	  => "{$toggle_slug}",
				'sub_toggle'	  => $sub_toggle,
			);

		}

		return $fields;
	}

	/**
	 * Add the element WARNING fields.
	 * 
	 * Adds the notice about the element being disabled to the sub_toggles
	 * of the "Layout: Elements" and "Layout: Elements (Fixed)" toggles.
	 * 
	 * Serves two purposes:
	 * 	1 - to inform the user that the element settings are hidden because it has been disabled;
	 * 	2 - to avoid the entire toggle from disappearing when any of the subtoggles is empty
	 * 		and clicked (looks like a bug in Divi fields conditional visibility feature);
	 * 
	 * @since	v1.0.0 (updated in v1.7)
	 * 
	 * @param	array  	$args					Element data.
	 * @param	string  $args['element_name']	Element name (Eg. "Logo").
	 * @param	string  $args['element_slug']	Element slug (Eg. "logo").
	 * @param	string  $args['tab_slug']		Field tab slug (Eg. "advanced").
	 * @param	string  $args['toggle_slug']	Field toggle slug (Eg. "logo_design").
	 * 
	 * @return	array							Element's fields.
	 * 
	 */
	function add_element_warning_fields( $args = array() ){

		$element_name 	= isset($args['element_name']) ? $args['element_name'] : '';
		$element_slug 	= isset($args['element_slug']) ? $args['element_slug'] : '';
		$tab_slug 		= isset($args['tab_slug']) ? $args['tab_slug'] : 'advanced';
		$toggle_slug 	= isset($args['toggle_slug']) ? $args['toggle_slug'] : 'elements_layout';
		$sub_toggle 	= isset($args['sub_toggle']) ? $args['sub_toggle'] : $element_slug;

		$fields = array();

		if( '' !== $element_name && '' !== $element_slug ){

			// For the Layout:Elements settings
			$fields["dvmm_{$element_slug}_disabled__layout"] = array(
				'label'           => '',
				'type'            => 'warning',
				'value'           => true,
				'display_if'      => true,
				'message'         => sprintf( esc_html__( '<p style="line-height: 1.7em; padding: 10px; border: 2px solid #ff9232; border-radius: 4px; color: #ff7700; background-color: #fffaf6;">The %1$s element is DISABLED. <br />To enable it go to Content->Elements and click the Enable %1$s.</p>', 'dvmm-divi-mad-menu' ), $element_name ),
				'option_category' => 'configuration',
				'show_if'     => array(
					"dvmm_enable_{$element_slug}" => 'off',
				),
				'bb_support'      => false,
				'tab_slug'        => $tab_slug,
				'toggle_slug'     => $toggle_slug,
				'sub_toggle' 	  => $sub_toggle
			);
		}

		return $fields;
	}

	/**
	 * Add the Fixed Header Disabled warning fields.
	 * 
	 * Adds a notice about the Fixed header being disabled to the FIXED sub_toggle
	 * of the "Text: ..." toggles.
	 * 
	 * Serves two purposes:
	 * 	1 - to inform the user that the element settings are hidden because the Fixed Header
	 * 		has been disabled;
	 * 	2 - to avoid the entire "Text: ..." toggle from disappearing when the "Fixed" sub_toggle 
	 * 		is empty and clicked (looks like a bug in Divi fields conditional visibility feature);
	 * 
	 * @since	v1.0.0 (updated in v1.7)
	 * 
	 * @return	array	Warning fields.
	 * 
	 */
	function add_fixed_header_disabled_warning_fields(){

		$fields = array();

		// Toggles having the "Fixed" sub_toggle
		$toggle_slugs = [
			'menu_text',
			'submenu_text',
			'menu_toggle_text',
			'mobile_menu_text',
			'mobile_submenu_text',
			'button_one_text',
			'button_two_text',
			'cart_text',
			'menu_design',
			'menu_items',
			'submenu',
			'submenu_items',
			'menu_toggle_design',
			'mobile_menu_design',
			'mobile_items_design',
			'mobile_submenu_design',
			'mobile_sub_items_design',
			'logo_design',
			'search_design',
			'cart_design',
			'button_one_design',
			'button_two_design',
			// 'background', 	// TBU
			'margin_padding',
			'sizing',
			'borders',
			'box_shadow',
		];

		foreach($toggle_slugs as $toggle_slug){

			// element slug
			$element_slug = '';

			// get element slug
			switch($toggle_slug){
				case 'menu_text':
				case 'submenu_text':
				case 'menu_design':
				case 'menu_items':
				case 'submenu':
				case 'submenu_items':
					$element_slug = 'menu';
					break;
				case 'menu_toggle_text':
				case 'mobile_menu_text':
				case 'mobile_submenu_text':
				case 'menu_toggle_design':
				case 'mobile_menu_design':
				case 'mobile_items_design':
				case 'mobile_submenu_design':
				case 'mobile_sub_items_design':
					$element_slug = 'mobile_menu';
					break;
				case 'logo_design':
					$element_slug = 'logo';
					break;
				case 'search_design':
					$element_slug = 'search';
					break;
				case 'button_one_text':
				case 'button_one_design':
					$element_slug = 'button_one';
					break;
				case 'button_two_text':
				case 'button_two_design':
					$element_slug = 'button_two';
					break;
				case 'cart_text':
				case 'cart_design':
					$element_slug = 'cart';
					break;
				default:
					$element_slug = '';
			}

			// Toggle slug
			if($toggle_slug === 'margin_padding' || $toggle_slug === 'sizing'
					// || $toggle_slug === 'background' 	// TBU
					|| $toggle_slug === 'borders'
					|| $toggle_slug === 'box_shadow'	
				){

				$show_if = array(
					'dvmm_enable_fixed_header' 	  => 'off',
				);
			} else {
				$show_if = array(
					"dvmm_enable_{$element_slug}" => 'on',
					'dvmm_enable_fixed_header' 	  => 'off',
				);
			}

			// Tab slug - TBU
			$tab_slug = $toggle_slug === 'background' ? 'general' : 'advanced';

			// For "Fixed" sub_toggle of the design settings.
			$fields["dvmm_fixed_header_disabled__{$toggle_slug}"] = array(
				'label'           => '',
				'type'            => 'warning',
				'value'           => true,
				'display_if'      => true,
				'message'         => esc_html__( '<p style="line-height: 1.7em; padding: 10px; border: 2px solid #ff9232; border-radius: 4px; color: #ff7700; background-color: #fffaf6;">Fixed Header is DISABLED. <br />To enable it go to Advanced->Position and click the Enable Fixed Header.</p>', 'dvmm-divi-mad-menu' ),
				'option_category' => 'configuration',
				'show_if'     	  => $show_if,
				'bb_support'      => false,
				'tab_slug'        => $tab_slug,
				'toggle_slug'     => $toggle_slug,
				'sub_toggle' 	  => 'fixed'
			);
		}

		return $fields;
	}

	/**
	 * Generate the array of fields that are dependant on the
	 * "dvmm_enable_{$element}" field. E.g "dvmm_enable_menu", "dvmm_enable_cart", etc.
	 * 
	 * @since	v1.0.0 (updated in v1.3)
	 * 
	 * @param	string	$element_slug	Element slug ('menu', 'mobile_menu', 'cart')
	 * @return	array					Array of field names.
	 * 
	 */
	function dvmm_enable_element__affects( $element_slug = '' ){

		if( $element_slug !== 'menu' && $element_slug !== 'mobile_menu' && $element_slug !== 'cart' ){
			return;
		}

		// FONT FIELDS added to the 'fonts' advanced field.
		// Desktop Menu element's Font Fields
		if( $element_slug === 'menu' ){
			$font_fields = [
				'dvmm_menu',
				'dvmm_submenu',
			];
		} 

		// Mobile Menu element's Font Fields
		if( $element_slug === 'mobile_menu' ){
			$font_fields = [
				'dvmm_menu_toggle_text',
				'dvmm_mobile_menu',
				'dvmm_mobile_submenu',
			];
		}

		// Cart element's Font Fields
		if( $element_slug === 'cart' ){
			$font_fields = [
				'dvmm_cart',
			];
		}

		//
		$affected_fields = array();

		// generate font fields names
		foreach($font_fields as $font_field){

			// affected fields
			$affected_font_fields = [
				// normal
				"{$font_field}_font",
				"{$font_field}_text_color",
				"{$font_field}_font_size",
				"{$font_field}_letter_spacing",
				"{$font_field}_line_height",
				"{$font_field}_text_align",
 
				/**
				 * Text shadow fields do not get hidden, apparently there is a bug, 
				 * so, disable them for now.
				 * 
				 * @see https://github.com/elegantthemes/create-divi-extension/issues/372
				 */
				// "{$font_field}_text_shadow_style",
				// "{$font_field}_text_shadow_horizontal_length",
				// "{$font_field}_text_shadow_vertical_length",
				// "{$font_field}_text_shadow_blur_strength",
				// "{$font_field}_text_shadow_color",
				
				// fixed
				"{$font_field}_f_font",
				"{$font_field}_f_text_color",
				"{$font_field}_f_font_size",
				"{$font_field}_f_letter_spacing",
				"{$font_field}_f_line_height",
				"{$font_field}_f_text_align",
				
				// "{$font_field}_f_text_shadow_style",
				// "{$font_field}_f_text_shadow_horizontal_length",
				// "{$font_field}_f_text_shadow_vertical_length",
				// "{$font_field}_f_text_shadow_blur_strength",
				// "{$font_field}_f_text_shadow_color",
			];

			$affected_fields = array_merge( $affected_fields, $affected_font_fields );
		}

		// BORDER FIELDS added to the 'borders' advanced field
		// Desktop Menu element's Border Fields
		if( $element_slug === 'menu' ){
			$affected_border_fields = [
				'border_radii_dvmm_item',
				'border_radii_dvmm_item_f',
				'border_radii_dvmm_sub_item',
				'border_radii_dvmm_sub_item_f',
				'border_radii_dvmm_submenu',
				'border_radii_dvmm_submenu_f',
			];
		} 

		// Mobile Menu element's Border Fields
		if( $element_slug === 'mobile_menu' ){
			$affected_border_fields = [
				'border_radii_dvmm_mobile_menu',
				'border_radii_dvmm_mobile_menu_f',
				'border_radii_dvmm_mobile_item',
				'border_radii_dvmm_mobile_item_f',
				'border_radii_dvmm_mobile_submenu',
				'border_radii_dvmm_mobile_submenu_f',
				'border_radii_dvmm_mobile_sub_item',
				'border_radii_dvmm_mobile_sub_item_f',
				'border_radii_dvmm_menu_toggle',
				'border_radii_dvmm_menu_toggle_f',
			];
		}

		// Cart element's Border Fields
		if( $element_slug === 'cart' ){
			$affected_border_fields = [
				'border_radii_dvmm_cart_btn',
				'border_radii_dvmm_cart_btn_f',
			];
		}

		$affected_fields = array_merge( $affected_fields, $affected_border_fields );

		return $affected_fields;
	}

	/**
	 * Generate the responsive values data string.
	 * 
	 * Ex.: Generate the string containing the menu animations data ("open", "close", "open_duration" and "close_duration")
	 * which is used as the value of the "data-dd_animation" data attribute 
	 * ( data-dd_animation="{"open":"on|fadeIn|default|flipInX", "close":"off|fadeOutLeft", "open_duration":"off|700", "close_duration":"off|700"}" )
	 * 
	 * The string is generated depending on whether the responsive setting is enabled or not,
	 * - if responsive then the result looks like this: "on|value|value|value"
	 * - otherwise like this: "off|value"
	 * 
	 * @since	v1.2
	 * 
	 * @param	array	$props			Module props.
	 * 
	 * @param	string	$setting		Prop name.
	 * @param	mixed	$default		Prop default value.
	 * 
	 * @return	string					The responsive values data string.
	 * 
	 */
	function _generate_responsive_values_data_string( $props, $setting, $default = '' ){

		// get the prop values (devices, hover and responsive) array with $force_return = true (return any value)
		$prop_values = $this->get_property_values_all( $props, $setting, $default, true );

		if($prop_values['responsive'] === "on"){
			$values_string = sprintf(
				'on|%1$s|%2$s|%3$s',
				esc_attr( $prop_values['desktop'] ),
				esc_attr( $prop_values['tablet'] ),
				esc_attr( $prop_values['phone'] )
			);
		} 
		
		if($prop_values['responsive'] === "off"){
			$values_string = sprintf(
				'off|%1$s',
				esc_attr( $prop_values['desktop'] )
			);
		}

		return $values_string;
	}

	/**
	 * Get the OPENING animation options.
	 * 
	 * @since	v1.2
	 * 
	 * @param	$element	Element type.
	 * 						(Values used so far: "popup", "desktop" and "mobile").
	 * @return	array
	 */
	function get_animation_options__open( $element ){

		// Mobile menu specific animation option(s)
		$mobile = array(
			'default' => esc_html__( 'Default', 'dvmm-divi-mad-menu' ),
		);

		// General animation options
		$animations = array( 
			'fadeIn'			=> esc_html__( 'Fade In', 'dvmm-divi-mad-menu' ),
			'fadeLeft' 			=> esc_html__( 'Fade In Left', 'dvmm-divi-mad-menu' ),
			'fadeRight' 		=> esc_html__( 'Fade In Right', 'dvmm-divi-mad-menu' ),
			'fadeTop' 			=> esc_html__( 'Fade In Top', 'dvmm-divi-mad-menu' ),
			'fadeBottom' 		=> esc_html__( 'Fade In Bottom', 'dvmm-divi-mad-menu' ),
			'fadeInLeft'		=> esc_html__( 'Fade In Left Big', 'dvmm-divi-mad-menu' ),
			'fadeInRight'		=> esc_html__( 'Fade In Right Big', 'dvmm-divi-mad-menu' ),  
			'fadeInTop'			=> esc_html__( 'Fade In Top Big', 'dvmm-divi-mad-menu' ),  
			'fadeInBottom'		=> esc_html__( 'Fade In Bottom Big', 'dvmm-divi-mad-menu' ),
			'flipInX'			=> esc_html__( 'Flip In X', 'dvmm-divi-mad-menu' ),  
			'flipInY'			=> esc_html__( 'Flip In Y', 'dvmm-divi-mad-menu' ),
			'dvmm_zoomIn'		=> esc_html__( 'Zoom In', 'dvmm-divi-mad-menu' ),
			'dvmm_Expand'		=> esc_html__( 'Expand', 'dvmm-divi-mad-menu' ),
			'dvmm_expandTop'	=> esc_html__( 'Expand Top', 'dvmm-divi-mad-menu' ),
			'dvmm_expandBottom'	=> esc_html__( 'Expand Bottom', 'dvmm-divi-mad-menu' ),
			'dvmm_lightSpeedIn'	=> esc_html__( 'Lightspeed In', 'dvmm-divi-mad-menu' ),
			'dvmm_bounceIn'		=> esc_html__( 'Bounce In', 'dvmm-divi-mad-menu' ),
			'dvmm_bounceInUp'	=> esc_html__( 'Bounce In Up', 'dvmm-divi-mad-menu' ),
			'dvmm_bounceInDown'	=> esc_html__( 'Bounce In Down', 'dvmm-divi-mad-menu' ),
			// 'unset'				=> esc_html__( 'None', 'dvmm-divi-mad-menu' ),
		);

		// Popup specific animations
		$popup = array(
			'dvmm_slideInLeft' 	 => esc_html__( 'Slide In Left', 'dvmm-divi-mad-menu' ),
			'dvmm_slideInRight'  => esc_html__( 'Slide In Right', 'dvmm-divi-mad-menu' ),
			'dvmm_slideInTop' 	 => esc_html__( 'Slide In Top', 'dvmm-divi-mad-menu' ),
			'dvmm_slideInBottom' => esc_html__( 'Slide In Bottom', 'dvmm-divi-mad-menu' ),
		);

		// Add the mobile menu specific animation(s)
		if($element === "mobile"){
			$animations = array_merge( $mobile, $animations );
		}

		// Add the popup specific animations
		if($element === "popup"){
			$animations = array_merge( $popup, $animations );
		}

		return $animations;
	}

	/**
	 * Get the CLOSING animation options.
	 * 
	 * @since	v1.2
	 * 
	 * @param	$element		Element type.
	 * 							(Values used so far: "popup", "desktop" and "mobile").
	 * @return	array
	 */
	function get_animation_options__close( $element ){

		// Mobile menu specific animation option(s)
		$mobile = array(
			'default' => esc_html__( 'Default', 'dvmm-divi-mad-menu' ),
		);

		// General animation options
		$animations = array( 
			'dvmm_fadeOut'		=> esc_html__( 'Fade Out', 'dvmm-divi-mad-menu' ),
			'dvmm_fadeLeftOut' 	=> esc_html__( 'Fade Out Left', 'dvmm-divi-mad-menu' ),
			'dvmm_fadeRightOut' => esc_html__( 'Fade Out Right', 'dvmm-divi-mad-menu' ),
			'dvmm_fadeTopOut' 	=> esc_html__( 'Fade Out Top', 'dvmm-divi-mad-menu' ),
			'dvmm_fadeBottomOut'=> esc_html__( 'Fade Out Bottom', 'dvmm-divi-mad-menu' ),
			'fadeOutLeft'		=> esc_html__( 'Fade Out Left Big', 'dvmm-divi-mad-menu' ),
			'fadeOutRight'		=> esc_html__( 'Fade Out Right Big', 'dvmm-divi-mad-menu' ),
			'fadeOutTop'		=> esc_html__( 'Fade Out Top Big', 'dvmm-divi-mad-menu' ),
			'fadeOutBottom'		=> esc_html__( 'Fade Out Bottom Big', 'dvmm-divi-mad-menu' ),
			'dvmm_flipOutX'		=> esc_html__( 'Flip Out X', 'dvmm-divi-mad-menu' ),
			'dvmm_flipOutY'		=> esc_html__( 'Flip Out Y', 'dvmm-divi-mad-menu' ),
			'dvmm_zoomOut'      => esc_html__( 'Zoom Out', 'dvmm-divi-mad-menu' ),
			'dvmm_Shrink'		=> esc_html__( 'Shrink', 'dvmm-divi-mad-menu' ),
			'dvmm_shrinkTop'	=> esc_html__( 'Shrink Top', 'dvmm-divi-mad-menu' ),
			'dvmm_shrinkBottom'	=> esc_html__( 'Shrink Bottom', 'dvmm-divi-mad-menu' ),
			'dvmm_lightSpeedOut'=> esc_html__( 'Lightspeed Out', 'dvmm-divi-mad-menu' ),
			'dvmm_bounceOut'	=> esc_html__( 'Bounce Out', 'dvmm-divi-mad-menu' ),
			'dvmm_bounceOutUp'	=> esc_html__( 'Bounce Out Up', 'dvmm-divi-mad-menu' ),
			'dvmm_bounceOutDown'=> esc_html__( 'Bounce Out Down', 'dvmm-divi-mad-menu' ),
			// 'unset'          	=> esc_html__( 'None', 'dvmm-divi-mad-menu' ),
		);

		// Popup specific animations
		$popup = array(
			'dvmm_slideOutLeft' => esc_html__( 'Slide Out Left', 'dvmm-divi-mad-menu' ),
			'dvmm_slideOutRight' => esc_html__( 'Slide Out Right', 'dvmm-divi-mad-menu' ),
			'dvmm_slideOutTop' => esc_html__( 'Slide Out Top', 'dvmm-divi-mad-menu' ),
			'dvmm_slideOutBottom' => esc_html__( 'Slide Out Bottom', 'dvmm-divi-mad-menu' ),
		);

		// Add the mobile menu specific animation(s)
		if($element === "mobile"){
			$animations = array_merge( $mobile, $animations );
		}

		// Add the popup specific animations
		if($element === "popup"){
			$animations = array_merge( $popup, $animations );
		}

		return $animations;
	}

	/**
	 * Get the "_auth" suffix for the "Auth" settings names 
	 * if the user is logged in.
	 * 
	 * The "_auth" is used as suffix for the "Auth" settings.
	 * 
	 * Eg.: ["{$elementName}_type{$_auth}"] setting can be either
	 *      ["{$elementName}_type"] (if the user is logged out) or
	 *      ["{$elementName}_type_auth"] (if the user is logged in).
	 * 
	 * @since   v1.6
	 * 
	 * @param   object    $props          Props.
	 * @param   string    elementName     Element name (Eg.: "button_one").
	 * 
	 * @return 	string                    The "_auth" or "".  
	 * 
	 */
	function _auth_suffix( $props, $elementName ){

		// If the user is logged in and the "Authenticated User Content" is enabled
		$_enable_auth = $props["dvmm_{$elementName}_enable_auth"];
		$isAuth = is_user_logged_in() && $_enable_auth === 'on';

		// The "_auth" suffix for adding to the setting name if isAuth
		$_auth = $isAuth ? '_auth' : '';

		// The "_auth" suffix for adding to the setting name if isAuth
		return $isAuth === true ? '_auth' : '';
	}

	/**
	 * Check if the page is a WooCommerce page.
	 * 
	 * @since	v1.6.2
	 * 
	 * @deprecated	since v1.8.1 // TBR
	 *
	 * @return bool  True - if it is a WooCommerce page
	 */
	function is_woo_page(){
		if ( ! et_is_woocommerce_plugin_active() ) {
			return false;
		} else {
			return is_shop() || is_product_category() || is_product() || is_product_tag() ? true : false;
		}
	}

	/**
	 * Check if the style processor allowed to be executed.
	 * Currently, we only use a custom processor from the method inside `DVMM_Module_Helper_Style_Processor`,
	 *
	 * NOTE: If there are more processors introduced, this needs to be updated
	 *
	 * Copy of the core _is_style_processor_allowed() method (@see ET_Builder_Element class)
	 * 
	 * @since v1.9.0
	 *
	 * @param array $processor Style processor.
	 *
	 * @return bool
	 */
	protected static function _is_style_processor_allowed( $processor ) {
		$allow_list = array(
			'DVMM_Module_Helper_Style_Processor',
		);

		return in_array( et_()->array_get( $processor, '0' ), $allow_list, true );
	}

	/**
	 * Generate responsive + hover + sticky style using the same configuration at once
	 * {
	 *
	 *    @type string       $mode
	 *    @type string       $render_slug
	 *    @type string       $base_attr_name
	 *    @type array        $attrs
	 *    @type string       $css_property
	 *    @type string       $selector
	 *    @type bool         $is_sticky_module
	 *    @type bool|array   $important Allowed value ​​is boolean or array of mode, e.g ['sticky', 'hover'].
	 *    @type string       $additional_css
	 *    @type int          $priority
	 *    @type bool         $responsive
	 *    @type bool         $hover
	 *    @type string       $hover_selector
	 *    @type string       $hover_pseudo_selector_location
	 *    @type bool         $sticky
	 *    @type string       $sticky_pseudo_selector_location
	 *    @type string       $utility_arg
	 * }
	 *
	 * NOTE: If there are more mode besides sticky and hover introduced, this needs to be updated.
	 * 
	 * Copy of the core generate_styles() method (@see ET_Builder_Element class)
	 *
	 * @since v1.9.0
	 *
	 * @param	object 	$module 	Module.
	 * @param	array 	$args 		Function arguments.
	 *
	 * @return void
	 */
	public function generate_styles( $module, $args = array() ) {
		$defaults       = array(
			'mode'                            => 'sticky',
			'render_slug'                     => '',
			'base_attr_name'                  => '',
			'attrs'                           => $module->props,
			'css_property'                    => '',
			'selector'                        => '%%order_class%%',
			// 'is_sticky_module'                => $this->is_sticky_module,
			'is_sticky_module'                => false,
			'important'                       => false,
			'additional_css'                  => '',
			'type'                            => '',
			'priority'                        => '',
			'responsive'                      => true,
			'hover'                           => true,
			'hover_selector'                  => '',
			'hover_pseudo_selector_location'  => 'order_class',
			'sticky'                          => true,
			'sticky_pseudo_selector_location' => 'order_class',
			'processor'                       => false,
			'responsive_processor'            => false,
			'hover_processor'                 => false,
			'sticky_processor'                => false,
			'processor_declaration_format'    => '',
			'utility_arg'                     => '',
		);
		$args           = wp_parse_args( $args, $defaults );
		$attrs          = $args['attrs'];
		$base_attr_name = $args['base_attr_name'];
		$selector       = $args['selector'];

		// Responsive Options.
		if ( $args['responsive'] ) {
			$responsive           = et_pb_responsive_options();
			$responsive_values    = $responsive->get_property_values( $attrs, $base_attr_name );
			$responsive_processor = $args['responsive_processor'];

			// Custom processor fallback, if there's any.
			if ( ! $responsive_processor && $args['processor'] ) {
				$responsive_processor = $args['processor'];
			}

			if ( $responsive_processor && self::_is_style_processor_allowed( $responsive_processor ) ) {
				// @phpcs:ignore Generic.PHP.ForbiddenFunctions.Found -- Need to be able to use a custom processor, the callback function is checked in the _is_style_processor_allowed
				call_user_func(
					$responsive_processor,
					$module,
					$selector,
					$responsive_values,
					$args,
					'responsive'
				);
			} else {
				// Append important tag to responsive's additional css.
				$responsive_additional_css = '; ' . $args['additional_css'];
				$responsive_important      = is_array( $args['important'] ) ? in_array( 'responsive', $args['important'], true ) : $args['important'];
				if ( $responsive_important ) {
					$responsive_additional_css = ' !important;' . $args['additional_css'];
				}

				// Responsive Options.
				$responsive->generate_responsive_css(
					$responsive_values,
					$selector,
					$args['css_property'],
					$args['render_slug'],
					$responsive_additional_css,
					$args['type'],
					$args['priority']
				);
			}
		}

		// Hover Option.
		if ( $args['hover'] ) {
			$hover           = et_pb_hover_options();
			$hover_value     = $hover->get_value( $base_attr_name, $attrs );
			$hover_processor = $args['hover_processor'];
			$hover_important = is_array( $args['important'] ) ? in_array( 'hover', $args['important'], true ) : $args['important'];

			// Custom processor fallback, if there's any.
			if ( ! $hover_processor && $args['processor'] ) {
				$hover_processor = $args['processor'];
			}

			// Generate hover selector.
			if ( '' !== $args['hover_selector'] ) {
				$hover_selector = $args['hover_selector'];
			} elseif ( 'order_class' === $args['hover_pseudo_selector_location'] ) {
				$hover_selector = $hover->add_hover_to_order_class( $selector );
			} else {
				$hover_selector = $hover->add_hover_to_selectors( $selector );
			}

			if ( $hover_processor && self::_is_style_processor_allowed( $hover_processor ) ) {
				// @phpcs:ignore Generic.PHP.ForbiddenFunctions.Found -- Need to be able to use a custom processor, the callback function is checked in the _is_style_processor_allowed
				call_user_func(
					$hover_processor,
					$module,
					$hover_selector,
					$hover_value,
					$args,
					'hover'
				);
			} elseif ( ! empty( $hover_value ) ) {
				$declaration = $module->generate_declaration(
					$args['css_property'],
					$hover_value,
					$hover_important,
					$args['additional_css']
				);
				$el_style    = array(
					'selector'    => $hover_selector,
					'declaration' => $declaration,
				);
				ET_Builder_Element::set_style( $args['render_slug'], $el_style );
			}
		}

		// Sticky Option.
		if ( $args['sticky'] ) {
			$sticky           = et_pb_sticky_options();
			$sticky_value     = $sticky->get_value( $base_attr_name, $attrs );
			$sticky_processor = $args['sticky_processor'];
			$sticky_important = is_array( $args['important'] ) ? in_array( 'sticky', $args['important'], true ) : $args['important'];

			// Custom processor fallback, if there's any.
			if ( ! $sticky_processor && $args['processor'] ) {
				$sticky_processor = $args['processor'];
			}

			// If generate_styles() is called multiple times, check for it once then pass
			// it down as param to skip sticky module check on this method level.
			$is_sticky_module = null === $args['is_sticky_module'] ?
				$sticky->is_sticky_module( $attrs ) :
				$args['is_sticky_module'];

			// Generate sticky selector.
			if ( 'order_class' === $args['sticky_pseudo_selector_location'] ) {
				$sticky_selector = $sticky->add_sticky_to_order_class( $selector, $is_sticky_module );
			} else {
				$sticky_selector = $sticky->add_sticky_to_selectors( $selector, $is_sticky_module );
			}

			if ( $sticky_processor && self::_is_style_processor_allowed( $sticky_processor ) ) {
				// @phpcs:ignore Generic.PHP.ForbiddenFunctions.Found -- Need to be able to use a custom processor, the callback function is checked in the _is_style_processor_allowed
				call_user_func(
					$sticky_processor,
					$module,
					$sticky_selector,
					$sticky_value,
					$args,
					'sticky'
				);
			} elseif ( ! empty( $sticky_value ) ) {
				$sticky_declaration = $module->generate_declaration(
					$args['css_property'],
					$sticky_value,
					$sticky_important,
					$args['additional_css']
				);
				$el_style           = array(
					'selector'    => $sticky_selector,
					'declaration' => $sticky_declaration,
				);
				ET_Builder_Element::set_style( $args['render_slug'], $el_style );
			}
		}
	}
}

/**
 * Intstantiates the DVMM_Divi_Modules_Helper class.
 * 
 * @since   1.0.0
 * 
 * @return  Instance of the DVMM_Divi_Modules_Helper class.
 * 
 */
function dvmm_modules_helper_methods() {
	return DVMM_Divi_Modules_Helper::instance();
}
