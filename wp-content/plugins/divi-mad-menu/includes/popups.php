<?php

// Die if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Popups.
 *
 * @since   v1.6 
 * 
 */
class DVMM_MadMenu_Popups {

    /**
     * Returns instance of the class.
     * 
     * @since   v1.6
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
	 * Helper methods.
	 * Returns the helper methods class instance.
	 * 
	 * @since	v1.6
	 * 
	 * @return	DVMM_Divi_Modules_Helper
	 */
	public function helpers(){
		return dvmm_modules_helper_methods();
	}

    /**
     * Element Popup Data.
     * 
     * The data that will be added to the inline JS script.
     * 
     * @todo    Maybe implement a similar function for all other elements 
     *          and make their data available here instead of using "data-" attributes.
     * 
     * @since	v1.6
     * 
     * @param	object	$module				Module object.
     * @param	string	$processed_props	Processed props.
     * @param	string	$render_slug		Module slug.
     * @param	string	$element_name		Element name ('button_one' or 'button_two').
     * 
     * @return  string                      Element's popup data.
     */
    public function inline_script_data( $module, $processed_props, $render_slug, $element_name ){

        // module order class
        // $module_order_class = ET_Builder_Element::get_module_order_class( $render_slug );

        //
        $data = '';
        $popupData = '';

        $is_element_enabled = $module->props["dvmm_enable_{$element_name}"];

        if($is_element_enabled === 'off'){
            return '';
        }

        // If the user is logged in and the "Authenticated User Content" is enabled
        $_auth = $module->helpers()->_auth_suffix( $module->props, $element_name );
 
        $element_type = $module->props["{$element_name}_type{$_auth}"];

        // Check if the element type is 'popup' or not. If not then don't add the popup data.
        if($element_type !== 'popup'){

            $popupData = '';

        } else {

            $popup_id = $module->props["{$element_name}_pp_id{$_auth}"];
            $pp_trigger_type    = $module->props["{$element_name}_pp_toggle{$_auth}"];

            /**
             * Check if the popup trigger type is 'secondary' or not. 
             * If yes then don't add the popup location and animation data.
             */
            if($pp_trigger_type === 'secondary'){

                /**
                 * Popup data.
                 */
                $popupData = sprintf('popup: {popup_id: "%1$s",pp_trigger_type: "%2$s",},',
                    esc_attr( $popup_id ),          // %1$s
                    esc_attr( $pp_trigger_type )    // %2$s
                );

            } else {
                
                // Animation values
                $duration = $module->helpers()->_generate_responsive_values_data_string(
                    $module->props,
                    "{$element_name}_pp_animation_duration{$_auth}",
                    400, 
                    false
                );
                $duration_close = $module->helpers()->_generate_responsive_values_data_string(
                    $module->props,
                    "{$element_name}_pp_animation_duration_close{$_auth}",
                    400, 
                    false
                );
                $animation_open = $module->helpers()->_generate_responsive_values_data_string(
                    $module->props,
                    "{$element_name}_pp_animation_open{$_auth}",
                    'fadeIn', 
                    false
                );
                $animation_close = $module->helpers()->_generate_responsive_values_data_string(
                    $module->props,
                    "{$element_name}_pp_animation_close{$_auth}",
                    'dvmm_fadeOut', 
                    false
                );
                
                // Get the popup location data
                $location_data = $this->_generate_responsive_location_data_strings( $module, $element_name );

                // Popup close button (the 'X' icon)
                $close_button = $module->props["{$element_name}_pp_x{$_auth}"];

                // Popup overlay
                $popup_overlay = $module->props["{$element_name}_pp_overlay{$_auth}"];

                // Close on outside click
                $close_on_outside_click = $module->props["{$element_name}_pp_x_out_click{$_auth}"];

                /**
                 * Popup data.
                 */
                $popupData = sprintf('popup: {popup_id: "%1$s",pp_trigger_type: "%2$s",location: "%3$s",left: "%4$s",right: "%5$s",top: "%6$s",bottom: "%7$s",translateX: "%8$s",translateY: "%9$s",closeButton: "%10$s",popupOverlay: "%11$s",closeOnOutsideClick: "%12$s",animation: {name: "%13$s",nameClose: "%14$s",duration: "%15$s",durationClose: "%16$s",slideOutData: "",},},',
                    esc_attr( $popup_id ),                      // %1$s
                    esc_attr( $pp_trigger_type ),               // %2$s
                    esc_attr( $location_data['location'] ),     // %3$s
                    esc_attr( $location_data['left'] ),         // %4$s
                    esc_attr( $location_data['right'] ),        // %5$s
                    esc_attr( $location_data['top'] ),          // %6$s
                    esc_attr( $location_data['bottom'] ),       // %7$s
                    esc_attr( $location_data['translateX'] ),   // %8$s
                    esc_attr( $location_data['translateY'] ),   // %9$s
                    esc_attr( $close_button ),                  // %10$s
                    esc_attr( $popup_overlay ),                 // %11$s
                    esc_attr( $close_on_outside_click ),        // %12$s
                    esc_attr( $animation_open ),                // %13$s
                    esc_attr( $animation_close ),               // %14$s
                    esc_attr( $duration ),                      // %15$s
                    esc_attr( $duration_close )                 // %16$s
                );
            }
        }

        /**
         * All data.
         */
        $data = sprintf('%1$s: {element_type: "%2$s",%3$s}',
            esc_attr( $element_name ),              // %1$s
            esc_attr( $element_type ),              // %2$s
            et_core_esc_previously( $popupData )    // %3$s
        );

        return $data;
    }

    /**
     * Generates the popup location data.
     * 
     * @since v1.6
     * 
     * @param 	object 	$module             Module object.
     * @param 	array  	$element_name       Element name.
     * 
     * @return  array                       The popup location data.
     */
    public function get_popup_location_data( $module, $element_name ){

        // If the user is logged in and the "Authenticated User Content" is enabled
        $_auth = $module->helpers()->_auth_suffix( $module->props, $element_name );

        // Location data
        $data = array();

        // Get popup position values
        $position_values = $module->helpers()->get_property_values_all( $module->props, "{$element_name}_pp_location{$_auth}", 'center_center', true );

        $_position_values = array();

        if($position_values['responsive'] === 'on'){
            $_position_values['desktop'] = $position_values['desktop'];
            $_position_values['tablet'] = $position_values['tablet'];
            $_position_values['phone'] = $position_values['phone'];
        } else {
            $_position_values['desktop'] = $position_values['desktop'];
        }

        foreach ( $_position_values as $device => $location ) {
            
            if($device === 'desktop' || $device === 'tablet' || $device === 'phone' ){
                switch($location){
                    // Top
                    case "top_left":
                        $top    = '0px';
                        $right  = 'auto';
                        $bottom = 'auto';
                        $left   = '0px';
                        $transform  = 'none';
                        $translateX = 0;
                        $translateY = 0;
                        break;
                    case "top_center":
                        $top    = '0px';
                        $right  = 'auto';
                        $bottom = 'auto';
                        $left   = '50%';
                        $transform  = 'translateX(-50%)';
                        $translateX = -50;
                        $translateY = 0;
                        break;
                    case "top_right":
                        $top    = '0px';
                        $right  = '0px';
                        $bottom = 'auto';
                        $left   = 'auto';
                        $transform  = 'none';
                        $translateX = 0;
                        $translateY = 0;
                        break;

                    // Center
                    case "center_left":
                        $top    = '50%';
                        $right  = 'auto';
                        $bottom = 'auto';
                        $left   = '0px';
                        $transform  = 'translateY(-50%)';
                        $translateX = 0;
                        $translateY = -50;
                        break;
                    case "center_center":
                        $top    = '50%';
                        $right  = 'auto';
                        $bottom = 'auto';
                        $left   = '50%';
                        $transform = 'translateX(-50%) translateY(-50%)';
                        $translateX  = -50;
                        $translateY  = -50;
                        break;
                    case "center_right":
                        $top    = '50%';
                        $right  = '0px';
                        $bottom = 'auto';
                        $left   = 'auto';
                        $transform  = 'translateY(-50%)';
                        $translateX = 0;
                        $translateY = -50;
                        break;

                    // Bottom
                    case "bottom_left":
                        $top    = 'auto';
                        $right  = 'auto';
                        $bottom = '0px';
                        $left   = '0px';
                        $transform  = 'none';
                        $translateX = 0;
                        $translateY = 0;
                        break;
                    case "bottom_center":
                        $top    = 'auto';
                        $right  = 'auto';
                        $bottom = '0px';
                        $left   = '50%';
                        $transform  = 'translateX(-50%)';
                        $translateX = -50;
                        $translateY = 0;
                        break;
                    case "bottom_right":
                        $top    = 'auto';
                        $right  = '0px';
                        $bottom = '0px';
                        $left   = 'auto';
                        $transform  = 'none';
                        $translateX = 0;
                        $translateY = 0;
                        break;

                    // Default
                    default:
                        $top    = 'auto';
                        $right  = 'auto';
                        $bottom = 'auto';
                        $left   = 'auto';
                        $transform   = 'none';
                        $translateX  = 0;
                        $translateY  = 0;
                }

                $data[$device]['location']  = $location;
                $data[$device]['top']       = $top;
                $data[$device]['right']     = $right;
                $data[$device]['bottom']    = $bottom;
                $data[$device]['left']      = $left;
                $data[$device]['translateX'] = $translateX;
                $data[$device]['translateY'] = $translateY;
                $data[$device]['transform']  = $transform;
            }
            
        }

        $data['responsive'] = $position_values['responsive'];

        return $data;
    }

    /**
     * Generate the popup responsive location values data string.
     * 
     * The string is generated depending on whether the responsive setting for the popup location is enabled or not,
     * - if responsive then the result looks like this: "on|value|value|value"
     * - otherwise like this: "off|value"
     * 
     * @since	v1.6
     * 
     * @param	array	$module         Module object.
     * @param	array	$element_name   Element name (eg.: 'button_one' or 'button_two').
     * 
     * @return	string					The responsive values data string.
     */
    public function _generate_responsive_location_data_strings( $module, $element_name ){

        // Get the popup location data
        $location_data = $this->get_popup_location_data( $module, $element_name );

        $locations = array(
            'location'   => '',
            'left'       => '',
            'right'      => '',
            'top'        => '',
            'bottom'     => '',
            'translateX' => '',
            'translateY' => '',
        );

        if($location_data['responsive'] === "on"){

            foreach($locations as $location => $value){
                $locations[$location] = sprintf(
                    'on|%1$s|%2$s|%3$s',
                    esc_attr( $location_data['desktop'][$location] ),
                    esc_attr( $location_data['tablet'][$location] ),
                    esc_attr( $location_data['phone'][$location] )
                );
            }
        } 

        if($location_data['responsive'] === "off"){
            foreach($locations as $location => $value){
                $locations[$location] = sprintf(
                    'off|%1$s',
                    esc_attr( $location_data['desktop'][$location] )
                );
            }
        }

        return $locations;
    }

    /**
     * Animation data.
     * 
     * Generates the animation data containing the animation CSS and
     * the animation name generated using the values of "translateX" and "translateY".
     * 
     * @since v1.6
     * 
     * @param 	object 	$module 				Module object.
     * @param 	array  	$element_name           Element name.
     * @param 	string  $device                 Device.
     * @param   string  $animation              Popup animation.
     * @param   string  $duration               Animation duration.
     * @param   string  $openClose              Is it for the opening or closing animation?
     * 
     * @return  array                           The popup animation data.
     */
    public function get_popup_animation_data( $module, $element_name, $device, $animation, $duration, $openClose ){

        /**
         * If the user is logged in and the "Authenticated User Content" is enabled
         * @since v1.6
         */
        $_auth = $module->helpers()->_auth_suffix( $module->props, $element_name );

        // Get the popup location data
        $location_data = $this->get_popup_location_data( $module, $element_name );

        if($location_data['responsive'] === 'on'){
            $location   = $location_data[$device]['location'];
            $translateX = $location_data[$device]['translateX'];
            $translateY = $location_data[$device]['translateY'];
        } else {
            $location   = $location_data['desktop']['location'];
            $translateX = $location_data['desktop']['translateX'];
            $translateY = $location_data['desktop']['translateY'];
        }

        $popup_id   = $module->props["{$element_name}_pp_id{$_auth}"];

        // Animation Data
        $animationData  = array();
        $selector       = '';
        $declaration    = '';
        $defaultAnimation    = $openClose === 'open' ? 'fadeIn' : 'dvmm_fadeOut';
        $animationStateClass = $openClose === 'open' ? 'dvmm_opened' : 'dvmm_closing';
    
        /**
         * Selector to apply the popup animation to.
         * If the CLOSING animation is a "Slide Out" animation then apply it to the "closed" popup as well.
         * Otherwise apply to the "closing" popup only(followed by "display: none;" for the "closed" popup).
         */
        $selector = "#{$popup_id}.{$animationStateClass}";

        // backface-visibility property
        $backfaceVisibility;

        switch($animation){
            case 'flipInX':
            case 'flipInY':
            case 'dvmm_flipOutX':
            case 'dvmm_flipOutY':
                $backfaceVisibility = '-webkit-backface-visibility: visible; backface-visibility: visible;';
                break;

            default:
                $backfaceVisibility = '';
        }

        // transform-origin property
        $transformOrigin;

        switch($animation){
            case 'dvmm_Expand':
            case 'dvmm_Shrink':
                $transformOrigin = '-webkit-transform-origin: center; transform-origin: center;';
                break;
            
            case 'dvmm_expandTop':
            case 'dvmm_shrinkTop':
                $transformOrigin = '-webkit-transform-origin: top; transform-origin: top;';
                break;

            case 'dvmm_expandBottom':
            case 'dvmm_shrinkBottom':
                $transformOrigin = '-webkit-transform-origin: bottom; transform-origin: bottom;';
                break;

            default:
                $transformOrigin = '';
        }

        /**
         * Generate the animation name by appending the "translateX", "translateY" and popup location values.
         */
        $animationName = $animation !== $defaultAnimation ? "{$animation}__{$translateX}__{$translateY}__{$location}" : $animation;

        // Generate the animation CSS rules
        $declaration = "
            -webkit-animation-name: {$animationName};
            animation-name: {$animationName};
            -webkit-animation-duration: {$duration};
            animation-duration: {$duration};
            {$backfaceVisibility} 
            {$transformOrigin}";

        $animationData['name']          = $animationName;
        $animationData['selector']      = $selector;
        $animationData['declaration']   = $declaration;

        return $animationData;
    }

    /**
     * Declare the popup animation CSS.
     * 
     * @since v1.6
     * 
     * @param 	object 	$module 				Module object.
     * @param 	string 	$render_slug 			Module slug.
     * @param 	array  	$args					All arguments.
     * 			array 	$args['element']		Element name ('button_one' or 'button_two').
     */
    public function declare_popup_animation_css( $module, $render_slug, $args = [] ){

        // Arguments
        $element_name = isset ( $args['element'] ) ? $args['element'] : '';

        /**
         * If the user is logged in and the "Authenticated User Content" is enabled
         * @since v1.6
         */
        $_auth = $module->helpers()->_auth_suffix( $module->props, $element_name );

        // Props
        $element_type       = $module->props["{$element_name}_type{$_auth}"];
        $popup_id           = $module->props["{$element_name}_pp_id{$_auth}"];
        $pp_trigger_type    = $module->props["{$element_name}_pp_toggle{$_auth}"];

        // Do not generate the popup CSS
        if( $element_type !== 'popup' || empty($popup_id) || $pp_trigger_type === 'secondary' ){
            return;
        }

        // Get the popup animation data (responsive)
        $animation_open     = $module->helpers()->get_property_values_all( $module->props, "{$element_name}_pp_animation_open{$_auth}", 'fadeIn', true );
        $animation_close    = $module->helpers()->get_property_values_all( $module->props, "{$element_name}_pp_animation_close{$_auth}", 'dvmm_fadeOut', true );
        $animation_duration = $module->helpers()->get_property_values_all( $module->props, "{$element_name}_pp_animation_duration{$_auth}", 400, false );
        $animation_duration_close = $module->helpers()->get_property_values_all( $module->props, "{$element_name}_pp_animation_duration_close{$_auth}", 400, false );

        $devices = array('desktop', 'tablet', 'phone');

        foreach ( $devices as $device ) {

            // Popup animation CSS selectors
            $_selector_open  = '';
            $_selector_close = '';

            // Popup animation CSS declarations for all devices
            $_declarations_open  = array();
            $_declarations_close = array();

            // Animation data
            $_animation_open        = $animation_open['responsive'] === 'on' ? $animation_open[$device] : $animation_open['desktop'];
            $_animation_close       = $animation_close['responsive'] === 'on' ? $animation_close[$device] : $animation_close['desktop'];
            $_animation_duration    = $animation_duration['responsive'] === 'on' ? $animation_duration[$device] : $animation_duration['desktop'];
            $_animation_duration_close = $animation_duration_close['responsive'] === 'on' ? $animation_duration_close[$device] : $animation_duration_close['desktop'];
            $animation_open_data    = $this->get_popup_animation_data( $module, $element_name, $device, $_animation_open, $_animation_duration, 'open' );
            $animation_close_data   = $this->get_popup_animation_data( $module, $element_name, $device, $_animation_close, $_animation_duration_close, 'close' );

            // Declarations
            $_declarations_open[ $device ]  = $animation_open_data['declaration'];
            $_declarations_close[ $device ] = $animation_close_data['declaration'];

            // Selectors
            $_selector_open  = $animation_open_data['selector'];
            $_selector_close = $animation_close_data['selector'];

            // Generate style for the opening popup (desktop, tablet, and phone).
            et_pb_responsive_options()->declare_responsive_css(
                $_declarations_open,
                $_selector_open,
                $render_slug
            );

            // Generate style for the closing popup (desktop, tablet, and phone).
            et_pb_responsive_options()->declare_responsive_css(
                $_declarations_close,
                $_selector_close,
                $render_slug
            );
        }
    }

    /**
     * Declare the popup positioning CSS.
     * 
     * @since v1.6
     * 
     * @param 	object 	$module 				Module object.
     * @param 	string 	$render_slug 			Module slug.
     * @param 	array  	$args					All arguments.
     * 			array 	$args['element']		Element name ('button_one' or 'button_two').
     * 			string 	$args['selector']		Popup CSS selector.
     */
    public function declare_popup_position_css( $module, $render_slug, $args = [] ){

        // Arguments
        $element_name = isset ( $args['element'] ) ? $args['element'] : '';
        $selector     = isset ( $args['selector'] ) ? $args['selector'] : '';

        // If the user is logged in and the "Authenticated User Content" is enabled
        $_auth = $module->helpers()->_auth_suffix( $module->props, $element_name );

        // Props
        $element_type       = $module->props["{$element_name}_type{$_auth}"];
        $popup_id           = $module->props["{$element_name}_pp_id{$_auth}"];
        $pp_trigger_type    = $module->props["{$element_name}_pp_toggle{$_auth}"];

        // Do not generate the popup CSS
        if( $element_type !== 'popup' || empty($popup_id) || $pp_trigger_type === 'secondary' ){
            return;
        }

        // Popup location CSS declarations for all devices
        $_declarations = array();

        // Get the popup location data
        $location_data = $this->get_popup_location_data( $module, $element_name );

        $devices = array('desktop', 'tablet', 'phone');

        foreach ( $devices as $device ) {
            /**
             * Generate the location CSS only for the existing devices.
             * So, if the popup location is not responsive then the CSS is generated for the ['desktop'] device only.
             * (we could achieve the same by checking for the location setting responsiveness like so: if($location_data['responsive'] === 'on') ).
             */
            if(isset($location_data[$device])){
                $_declarations[ $device ] = "position: fixed !important; top: {$location_data[$device]['top']}; right: {$location_data[$device]['right']}; bottom: {$location_data[$device]['bottom']}; left: {$location_data[$device]['left']}; transform: {$location_data[$device]['transform']}; -webkit-transform: {$location_data[$device]['transform']};";
            }
        }

        // Generate style for desktop, tablet, and phone.
        et_pb_responsive_options()->declare_responsive_css(
            $_declarations,
            $selector,
            $render_slug
        );
    }

    /**
     * Declare the popup background overlay z-index CSS.
     * 
     * The popup overlay z-index value must be at least by 1 less than the popup's z-index
     * so that the popup overlay always stays "behind" the popup.
     * 
     * @since v1.6
     * 
     * @param 	object 	$module 				Module object.
     * @param 	string 	$render_slug 			Module slug.
     * @param 	array  	$args					All arguments.
     * 			array 	$args['element']		Element name ('button_one' or 'button_two').
     * 			string 	$args['selector']		Popup CSS selector.
     */
    public function declare_popup_overlay_zindex_css( $module, $render_slug, $args = [] ){

        // Arguments
        $element_name = isset ( $args['element'] ) ? $args['element'] : '';
        $selector     = isset ( $args['selector'] ) ? $args['selector'] : '';

        /**
         * If the user is logged in and the "Authenticated User Content" is enabled
         * @since v1.6
         */
        $_auth = $module->helpers()->_auth_suffix( $module->props, $element_name );

        // Props
        $pp_overlay = $module->props["{$element_name}_pp_overlay{$_auth}"];

        // Do not generate the popup CSS
        if( $pp_overlay === 'off' ){
            return;
        }

        // Popup location CSS declarations for all devices
        $_declarations = array();

        // Get popup position values
        $pp_zindex_values = $module->helpers()->get_property_values_all( $module->props, "{$element_name}_pp_zindex{$_auth}", '99999', true );
        
        $devices = array('desktop', 'tablet', 'phone');
        
        if( $pp_zindex_values['responsive'] === 'on' ){
            foreach ( $devices as $device ) {
                // z-index declaration
                $pp_overlay_zindex = intval($pp_zindex_values[$device]) - 1;
                $_declarations[ $device ] = "z-index: {$pp_overlay_zindex};";
            }
        } else {
            // z-index declaration
            $pp_overlay_zindex = intval($pp_zindex_values['desktop']) - 1;
            $_declarations['desktop'] = "z-index: {$pp_overlay_zindex};";
        }

        // Generate style for desktop, tablet, and phone.
        et_pb_responsive_options()->declare_responsive_css(
            $_declarations,
            $selector,
            $render_slug
        );
    }

    /**
     * Calculate the "translateX" property value.
     * 
     * Adjusts the "translateX" value of the animation 
     * by taking into account the popup's position "translateX" value.
     * 
     * @since   v1.6
     * 
     * @param   number $originalX   The animation's translateX value.
     * @param   number $positionX   The popup's location translateX value.
     * @param   string $unit        The translateX unit.
     * 
     * @return  string              The "translateX" value. Eg. "translateX(-50%)".
     */
    public function _translateX($originalX, $positionX, $unit = '%') {
        // 
        $translateX = $originalX + $positionX;

        return "translateX({$translateX}{$unit})";
    }

    /**
     * Calculate the "translateY" property value.
     * 
     * Adjusts the "translateY" value of the animation 
     * by taking into account the popup's position "translateY" value.
     * 
     * @since   v1.6
     * 
     * @param   number $originalY   The animation's translateY value.
     * @param   number $positionY   The popup's location translateY value.
     * @param   string $unit        The translateX unit.
     * 
     * @return  string              The "translateY" value. Eg. translateY(-50%).
     */
    public function _translateY($originalY, $positionY, $unit = '%') {
        // 
        $translateY = $originalY + $positionY;

        return "translateY({$translateY}{$unit})";
    }

    /**
     * Generate the popup location data for the popups that are applied a "Slide Out" animation.
     * 
     * Used for hiding the popup after the "Slide Out" animation has ended ( @see _displayNone() )
     * as well as for the "Slide Out" animation's @keyframes ( @see slide_out_animations() ).
     * 
     * @since   v1.6
     * 
     * @param 	object 	$module 				Module object.
     * @param 	string 	$element_name 			Element name.
     * @param 	string  $closeAnimationName		The closing "Slide Out" animation name.
     * @param 	string  $device         		Device ('desktop', 'tablet' or 'phone').
     * 
     * @return  array
     */
    public function slide_out_animation_data($module, $element_name, $closeAnimationName, $device){

        // If the element is "undefined" and the animation applied is not a "Slide Out" animation
        if(empty($element_name) || strpos($closeAnimationName, 'dvmm_slideOut') === false){
            return '';
        }

        $data = array();

        // Get the popup location data
        $location_data = $this->get_popup_location_data( $module, $element_name );

        /**
         * Generate the location CSS data only for the existing devices.
         * If the popup location is not responsive then the CSS is generated for the ['desktop'] device only.
         */
        $device = $location_data['responsive'] === 'on' ? $device : 'desktop';

        // Popup location
        $location = $location_data[$device]['location'];

        // The @keyframes START and END values
        $leftEnd     = '';
        $rightEnd    = '';
        $topEnd      = '';
        $bottomEnd   = '';
        $leftStart   = $location_data[$device]['left'];
        $rightStart  = $location_data[$device]['right'];
        $topStart    = $location_data[$device]['top'];
        $bottomStart = $location_data[$device]['bottom'];
        $transformEnd = '';
        $transformStartX = $this->_translateX(0, $location_data[$device]['translateX']);
        $transformStartY = $this->_translateY(0, $location_data[$device]['translateY']);
        $transformStart  = "{$transformStartX} {$transformStartY}";

        // Calculate the @keyframes START and END values depending on the selected animation
        switch ( $closeAnimationName ) {
            case "dvmm_slideOutLeft":
                $transformEndY  = $this->_translateY(0, $location_data[$device]['translateY']);
                $transformEnd   = "translateX(-100%) {$transformEndY}";
                $leftEnd    = '0';
                $rightEnd   = 'auto';

                // Right aligned popup
                if($location === 'top_right' || $location === 'center_right' || $location === 'bottom_right'){
                    $transformEnd = "translateX(0%) {$transformEndY}";
                    $leftEnd     = 'auto';
                    $rightEnd    = '100%';
                }
                break;

            case "dvmm_slideOutRight":
                $transformEndY  = $this->_translateY(0, $location_data[$device]['translateY']);
                $transformEnd   = "translateX(-100%) {$transformEndY}";
                $leftEnd    = 'auto';
                $rightEnd   = '0';

                // Left aligned popup
                if($location === 'top_left' || $location === 'center_left' || $location === 'bottom_left'){
                    $transformEnd = "translateX(0%) {$transformEndY}";
                    $leftEnd     = '100%';
                    $rightEnd    = 'auto';
                    $leftStart   = '0';
                    $rightStart  = 'auto';
                }

                // Reverse the "left" and "right" property values if the popup is centered to ensure smooth animation from right
                if($location === 'top_center' || $location === 'center_center' || $location === 'bottom_center'){
                    $transformStartX = $this->_translateX(100, $location_data[$device]['translateX']);
                    $transformStartY = $this->_translateY(0, $location_data[$device]['translateY']);
                    $transformStart  = "{$transformStartX} {$transformStartY}";
                    $transformEnd    = "translateX(100%) {$transformEndY}";
                    $leftStart  = $location_data[$device]['right'];
                    $rightStart = $location_data[$device]['left'];
                }

                // Right aligned popup
                if($location === 'top_right' || $location === 'center_right' || $location === 'bottom_right'){
                    $transformEnd = "translateX(100%) {$transformEndY}";
                }
                break;

            case "dvmm_slideOutTop":
                $transformEndX  = $this->_translateX(0, $location_data[$device]['translateX']);
                $transformEnd   = "{$transformEndX} translateY(-100%)";
                $topEnd     = $location_data[$device]['top'];
                $bottomEnd  = 'auto';

                // Centered popup
                if($location === 'center_left' || $location === 'center_center' || $location === 'center_right'){
                    $topEnd  = '0px';
                }

                // Bottom aligned popup
                if($location === 'bottom_left' || $location === 'bottom_center' || $location === 'bottom_right'){
                    $topEnd      = 'auto';
                    $bottomEnd   = $location_data[$device]['bottom'];
                    $topStart    = 'auto';
                    $bottomStart = $location_data[$device]['bottom'];
                    $transformEndX  = $this->_translateX(0, $location_data[$device]['translateX']);
                    $transformEnd   = "{$transformEndX} translateY(100%)";
                }
                break;

            case "dvmm_slideOutBottom":
                $transformEndX  = $this->_translateX(0, $location_data[$device]['translateX']);
                $transformEnd   = "{$transformEndX} translateY(100%)";
                $topEnd     = 'auto';
                $bottomEnd  = $location_data[$device]['bottom'];

                // Top aligned popup
                if($location === 'top_left' || $location === 'top_center' || $location === 'top_right'){
                    $transformEndX  = $this->_translateX(0, $location_data[$device]['translateX']);
                    $transformEnd   = "{$transformEndX} translateY(100%)";
                    $topStart    = $location_data[$device]['top'];
                    $bottomStart = 'auto';
                    $topEnd      = '100%';
                    $bottomEnd   = 'auto';
                }

                // Centered popup
                if($location === 'center_left' || $location === 'center_center' || $location === 'center_right'){
                    $transformEndX  = $this->_translateX(0, $location_data[$device]['translateX']);
                    $transformEnd   = "{$transformEndX} translateY(100%)";
                    $topStart    = $location_data[$device]['top'];
                    $bottomStart = 'auto';
                    $topEnd      = 'auto';
                    $bottomEnd   = '0px';
                }
                break;

            default:
                $transformEnd = '';
        }
        
        // Start values
        $data['leftStart']      = $leftStart !== '' ? "left: {$leftStart};" : '';
        $data['rightStart']     = $rightStart !== '' ? "right: {$rightStart};" : '';
        $data['topStart']       = $topStart !== '' ? "top: {$topStart};" : '';
        $data['bottomStart']    = $bottomStart !== '' ? "bottom: {$bottomStart};" : '';
        $data['transformStart'] = "-webkit-transform: {$transformStart}; transform: {$transformStart};";
        // End values
        $data['leftEnd']      = $leftEnd !== '' ? "left: {$leftEnd};" : '';
        $data['rightEnd']     = $rightEnd !== '' ? "right: {$rightEnd};" : '';
        $data['topEnd']       = $topEnd !== '' ? "top: {$topEnd};" : '';
        $data['bottomEnd']    = $bottomEnd !== '' ? "bottom: {$bottomEnd};" : '';
        $data['transformEnd'] = "-webkit-transform: {$transformEnd}; transform: {$transformEnd};";

        return $data;
    }

    /**
     * Check if the "Normal" popup is valid.
     * 
     * @since   v1.6
     * 
     * @param   string $element_type        Element type('url' or 'popup').
     * @param   string $popup_id            Popup ID.
     * @param   string $pp_trigger_type     Popup toggle type('primary' or 'secondary').
     * 
     * @return  boolean
     */
    public function is_normal_popup_valid($element_type, $popup_id, $pp_trigger_type){
        return $element_type === 'popup' && !empty($popup_id) && $pp_trigger_type === 'primary' ? true : false;
    }

    /**
     * Check if the "Auth" popup is valid.
     * 
     * @since   v1.6
     * 
     * @param   string $enable_auth         If the user is logged in.
     * @param   string $element_type        Element type('url' or 'popup').
     * @param   string $popup_id            Popup ID.
     * @param   string $pp_trigger_type     Popup toggle type('primary' or 'secondary').
     * 
     * @return  boolean
     */
    public function is_auth_popup_valid($enable_auth, $element_type, $popup_id, $pp_trigger_type){
        return $enable_auth === 'on' && $element_type === 'popup' && !empty($popup_id) && $pp_trigger_type === 'primary' ? true : false;
    }

    /**
     * Check if the "Normal" and/or "Auth" popup(s) set.
     * 
     * @since   v1.6
     * 
     * @param 	object 	$module             Module object.
     * @param 	string 	$element_name       Element name.
     * 
     * @return  string
     */
    public function normal_vs_auth_popups($module, $element_name){

        // Normal props
        $element_type       = $module->props["{$element_name}_type"];
        $pp_trigger_type    = $module->props["{$element_name}_pp_toggle"];
        $popup_id           = $module->props["{$element_name}_pp_id"];

        // Auth props
        $enable_auth            = $module->props["dvmm_{$element_name}_enable_auth"];
        $element_type_auth      = $module->props["{$element_name}_type_auth"];
        $pp_trigger_type_auth   = $module->props["{$element_name}_pp_toggle_auth"];
        $popup_id_auth          = $module->props["{$element_name}_pp_id_auth"];
        
        // Popups validity
        $is_normal_popup_valid 	= $this->is_normal_popup_valid($element_type, $popup_id, $pp_trigger_type);
        $is_auth_popup_valid 	= $this->is_auth_popup_valid($enable_auth, $element_type_auth, $popup_id_auth, $pp_trigger_type_auth);

        if($element_type === 'url' && $enable_auth === 'off'){
            return 'url_vs_none';
        } 
            
        if($is_normal_popup_valid === true && $enable_auth === 'off'){
            return 'popup_vs_none';
        }

        if($is_normal_popup_valid === true && $enable_auth === 'on' && $element_type_auth === 'url'){
            return 'popup_vs_url';
        }

        // if($is_normal_popup_valid === true && $is_auth_popup_valid === true){
        if($is_normal_popup_valid === true && $enable_auth === 'on' && $element_type_auth === 'popup' && $pp_trigger_type_auth === 'primary'){
            return 'popup_vs_popup';
        }

        if($element_type === 'url' && $is_auth_popup_valid === true){
            return 'url_vs_popup';
        }
        
        if($element_type === 'url' && $enable_auth === 'on' && $element_type_auth === 'url'){
            return 'url_vs_url';
        }
    }

    /**
     * Hide all popups on page load to prevent potential CLS 
     * or when the popups need to be hidden all together
     * (the 'dvmm_popup' CSS class is not available on page load but is added later using JS).
     * 
     * @since   v1.6
     * 
     * @param 	object 	$module         Module object.
     * @param 	string 	$popupID        Popup ID.
     * @param 	string 	$displayNone    CSS to hide all popups("display: none;").
     * @param   string  $render_slug    Module slug.
     */
    public function hide_popups__none($module, $popupID, $displayNone, $render_slug){

        $declarations = array();
        $selector = ""; 
        $declarations['desktop'] = $displayNone;
        $selector = "#{$popupID}:not(.dvmm_popup)";

        // Generate CSS.
        et_pb_responsive_options()->declare_responsive_css( $declarations, $selector, $render_slug );
    }

    /**
     * Hide popups either setting to "display: none;" 
     * or applying the "Slide Out" animation END values 
     * if the popup is applied a "Slide Out" animation
     * (applies after the 'dvmm_popup' CSS class is added to all popups using JS).
     * 
     * @since   v1.6
     * 
     * @param 	object 	$module         Module object.
     * @param 	string 	$element_name   Element name.
     * @param   string  $render_slug    Module slug.
     * @param 	string 	$popupID        Popup ID.
     * @param 	string 	$displayNone    CSS to hide popups("display: none;").
     * @param 	string 	$_auth          Is it for the "logged in" or "logged out" popup('_auth' or '').
     */
    public function hide_popups__slide_out_or_none($module, $element_name, $render_slug, $popupID, $displayNone, $_auth = ''){

        // Get the CLOSING animation value
        $popupAnimationClose = et_pb_responsive_options()->get_property_values( $module->props, "{$element_name}_pp_animation_close{$_auth}", 'dvmm_fadeOut' );

        // Is the closing animation responsive
        $is_responsive	= et_pb_responsive_options()->is_responsive_enabled( $module->props, "{$element_name}_pp_animation_close{$_auth}" );

        if($is_responsive === true){

            // DO NOT set the popup to "display: none;" if it's CLOSING animation is a "Slide Out" animation
            foreach ( $popupAnimationClose as $device => $closeAnimationName ) {

                // Reset values
                $declarations = array();
                $selector = "#{$popupID}.dvmm_popup.dvmm--{$device}.dvmm_closed";

                if(strpos($closeAnimationName, 'dvmm_slideOut') !== false){

                    // Get the location data for the popup with a "Slide Out" animation
                    $slideOutData = $this->slide_out_animation_data($module, $element_name, $closeAnimationName, $device);

                    // Use the @keyframes END values to keep the popup where the "Slide Out" animation ended
                    $topEnd         = $slideOutData['topEnd'];
                    $rightEnd       = $slideOutData['rightEnd'];
                    $bottomEnd      = $slideOutData['bottomEnd'];
                    $leftEnd        = $slideOutData['leftEnd'];
                    $transformEnd   = $slideOutData['transformEnd'];

                    $declarations[$device] = "{$leftEnd} {$rightEnd} {$topEnd} {$bottomEnd} {$transformEnd}";

                } else {
                    $declarations[$device] = $displayNone;
                }

                // Generate CSS for the current device.
                et_pb_responsive_options()->declare_responsive_css( $declarations, $selector, $render_slug );
            }

        } else {

            $selector = "#{$popupID}.dvmm_popup.dvmm_closed";

            if(strpos($popupAnimationClose['desktop'], 'dvmm_slideOut') !== false){

                // Get the location data for the popup with a "Slide Out" animation
                $slideOutData = $this->slide_out_animation_data($module, $element_name, $popupAnimationClose['desktop'], 'desktop');

                // Use the @keyframes END values to keep the popup where the "Slide Out" animation ended
                $topEnd         = $slideOutData['topEnd'];
                $rightEnd       = $slideOutData['rightEnd'];
                $bottomEnd      = $slideOutData['bottomEnd'];
                $leftEnd        = $slideOutData['leftEnd'];
                $transformEnd   = $slideOutData['transformEnd'];

                $declarations['desktop'] = "{$leftEnd} {$rightEnd} {$topEnd} {$bottomEnd} {$transformEnd}";

            } else {
                $declarations['desktop'] = $displayNone;
            }

            // Generate CSS.
            et_pb_responsive_options()->declare_responsive_css( $declarations, $selector, $render_slug );
        }
    }

    /**
     * Hide the popups.
     * 
     * Decide which popup to show/hide.
     * Eg.: If different popups are set for the same Button for "logged in" and "logged out" modes
     * then the popup of the "logged in" mode should not be visible when the user
     * is logged out and viseversa.
     * 
     * Popups with a "Slide Out" CLOSING animation should not be set to "display: none;" after the closing animation ends
     * because these popups should still remain "visible" even when closed to allow "self toggling"
     * popups where the popup toggle (the MadMenu module element) is inside the popup itself.
     * That's why set the "display: none;" rule conditionally only if the popup's CLOSING animation
     * is not a "Slide Out" animation.
     * 
     * @since   v1.6
     * 
     * @param 	object 	$module         Module object.
     * @param   string  $render_slug    Module slug.
     * @param 	string 	$element_name   Element name.
     * @param   string  $dvmm_closed    CSS class ("dvmm_closed" or ""). ???
     * 
     * @return  string                  CSS to hide the element. 
     */
    public function _displayNone($module, $render_slug, $element_name, $dvmm_closed = ''){

        $displayNone = 'display: none !important;';

        // Normal props
        $popup_id = $module->props["{$element_name}_pp_id"];

        // Auth props
        $enable_auth    = $module->props["dvmm_{$element_name}_enable_auth"];
        $popup_id_auth  = $module->props["{$element_name}_pp_id_auth"];

        // Enabled popups
        $normal_vs_auth_popups = $this->normal_vs_auth_popups($module, $element_name);

        // Are normal and auth popups' IDs same ?
        $normal_and_auth_same = $popup_id === $popup_id_auth ? true : false;

        if( !is_user_logged_in() ){
            switch ($normal_vs_auth_popups) {
                case 'url_vs_none':
                    // DON'T generate any CSS for popups
                    break;

                case 'popup_vs_none':
                    // hide the normal popup initially to avoid possible CLS
                    $this->hide_popups__none($module, $popup_id, $displayNone, $render_slug);
                    // show the normal popup
                    $this->hide_popups__slide_out_or_none($module, $element_name, $render_slug, $popup_id, $displayNone, '');
                    break;

                case 'popup_vs_url':
                    // hide the normal popup initially to avoid possible CLS
                    $this->hide_popups__none($module, $popup_id, $displayNone, $render_slug);
                    // show the normal popup
                    $this->hide_popups__slide_out_or_none($module, $element_name, $render_slug, $popup_id, $displayNone, '');
                    break;

                case 'popup_vs_popup':
                    // hide the normal popup initially to avoid possible CLS
                    $this->hide_popups__none($module, $popup_id, $displayNone, $render_slug);
                    // hide the auth popup
                    $this->hide_popups__none($module, $popup_id_auth, $displayNone, $render_slug);
                    // show the normal popup
                    $this->hide_popups__slide_out_or_none($module, $element_name, $render_slug, $popup_id, $displayNone, '');
                    break;

                case 'url_vs_popup':
                    // DON'T generate the normal popup CSS
                    // hide the auth popup
                    $this->hide_popups__none($module, $popup_id_auth, $displayNone, $render_slug);
                    break;

                case 'url_vs_url':
                    // DON'T generate any CSS for popups
                    break;
                
                default:
                    // DON'T generate any CSS for popups
                    break;
            }
        } else {
            switch ($normal_vs_auth_popups) {
                case 'url_vs_none':
                    // DON'T generate any CSS for popups
                    break;

                case 'popup_vs_none':
                    // hide the normal popup initially to avoid possible CLS
                    $this->hide_popups__none($module, $popup_id, $displayNone, $render_slug);
                    // show the normal popup (use the normal popup's settings)
                    $this->hide_popups__slide_out_or_none($module, $element_name, $render_slug, $popup_id, $displayNone, '');
                    break;

                case 'popup_vs_url':
                    // hide the normal popup
                    $this->hide_popups__none($module, $popup_id, $displayNone, $render_slug);
                    break;

                case 'popup_vs_popup':
                    // hide the auth popup initially to avoid possible CLS
                    $this->hide_popups__none($module, $popup_id_auth, $displayNone, $render_slug);
                    if($normal_and_auth_same){
                        // show the auth popup (use the auth popup's settings)
                        // DON'T hide the normal popup because it has the same ID as the auth popup
                        $this->hide_popups__slide_out_or_none($module, $element_name, $render_slug, $popup_id_auth, $displayNone, '_auth');
                    } else {
                        // hide the normal popup
                        $this->hide_popups__none($module, $popup_id, $displayNone, $render_slug);
                        // show the auth popup
                        $this->hide_popups__slide_out_or_none($module, $element_name, $render_slug, $popup_id_auth, $displayNone, '_auth');
                    }
                    break;

                case 'url_vs_popup':
                    // DON'T generate the normal popup CSS
                    // show the auth popup
                    $this->hide_popups__slide_out_or_none($module, $element_name, $render_slug, $popup_id_auth, $displayNone, '_auth');
                    break;

                case 'url_vs_url':
                    // DON'T generate any CSS for popups
                    break;
                
                default:
                    // DON'T generate any CSS for popups
                    break;
            }
        }
    }

    /**
     * Declare the popup visibility CSS.
     * 
     * @since   v1.6
     * 
     * @param 	object 	$module 				Module object.
     * @param 	string 	$render_slug 			Module slug.
     * @param 	array  	$args					All arguments.
     * 			array 	$args['element']		Element name ('button_one' or 'button_two').
     * 			string 	$args['selector']		Popup CSS selector.
     */
    public function declare_popup_visibility_css( $module, $render_slug, $args = [] ){

        // Arguments
        $element_name = isset ( $args['element'] ) ? $args['element'] : '';
        $selector     = isset ( $args['selector'] ) ? $args['selector'] : '';
        
        // Skip element if it's not enabled
        if( $module->props["dvmm_enable_{$element_name}"] === 'off' ){
            return;
        }

        $this->_displayNone( $module, $render_slug, $element_name, '');
    }
}

/**
 * Intstantiates the DVMM_MadMenu_Popups class.
 * 
 * @since   1.6
 * 
 * @return  Instance of the DVMM_MadMenu_Popups class.
 * 
 */
function dvmm_madmenu_popups() {
	return DVMM_MadMenu_Popups::instance();
}