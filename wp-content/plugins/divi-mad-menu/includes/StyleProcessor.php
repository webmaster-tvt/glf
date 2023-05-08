<?php
/**
 * Style Processor
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * Style processor helper methods.
 *
 * @since 1.9.0
 *
 * Class DVMM_Module_Helper_Style_Processor
 */
class DVMM_Module_Helper_Style_Processor extends ET_Builder_Module_Helper_Style_Processor {
	
    /**
     * Process spacing styles (margin and padding).
     * Generates CSS using the 'longhand' version of the 'margin' and 'padding' CSS properties (eg.: margin-top, padding-top, etc.).
     * 
     * @since   v1.9.0
     * 
     * @param   object          $module         Module.
     * @param   string          $selector       Selector. // ??? TBR
     * @param   array|string    $option_value   Prop values. (array for 'responsive' and string for 'hover' and 'sticky' options).
     * @param   array           $args           Arguments.
     * @param   string          $option_type    Option type. Possible values: 'responsive', 'hover' and 'sticky'.
     * 
     */
    public static function process_margin_padding_styles( $module, $selector, $option_value, $args, $option_type ){

        $attrs          = $args['attrs'];
        $base_attr_name	= $args['base_attr_name'];
        $selector 		= $args['selector'];
        $hover_selector	= $args['hover_selector'];
        $type 	    	= $args['type'];
        $css_property	= $args['css_property'];
        $render_slug	= $args['render_slug'];
        $important 		= $args['important'];
        $additional_css = $args['additional_css'];
        $priority 		= $args['priority'];
        $default        = isset ( $args['default'] ) ? $args['default'] : '';
        
        // Default values.
        $default = explode( "|", $default );

        // Responsive values
        if( $args['responsive'] && $option_type === 'responsive' ){
            $responsive = et_pb_responsive_options();

            // Explode the string value into array for each device.
            $desktop    = explode( "|", $option_value['desktop'] );
            $tablet	    = explode( "|", $option_value['tablet'] );
            $phone	    = explode( "|", $option_value['phone'] );

            // Get the last edited device.
            $last_edited = explode( "|", $attrs["{$base_attr_name}_last_edited"] );

            // Check if responsive CSS is enabled.
            $responsive_active = et_pb_responsive_options()->get_responsive_status( $last_edited[0] );

            // Append important tag to responsive's additional css.
            $responsive_additional_css = '; ' . $args['additional_css'];
            $responsive_important      = is_array( $args['important'] ) ? in_array( 'responsive', $args['important'], true ) : $args['important'];
            if ( $responsive_important ) {
                $responsive_additional_css = ' !important;' . $args['additional_css'];
            }
        }

        // Hover values
        if( $args['hover'] && $option_type === 'hover' ){
            $hover          = et_pb_hover_options();
            $hover_values   = explode( "|", $option_value );
            $hover_important = is_array( $args['important'] ) ? in_array( 'hover', $args['important'], true ) : $args['important'];
            // Generate hover selector.
            if ( '' !== $args['hover_selector'] ) {
                $hover_selector = $args['hover_selector'];
            } elseif ( 'order_class' === $args['hover_pseudo_selector_location'] ) {
                $hover_selector = $hover->add_hover_to_order_class( $selector );
            } else {
                $hover_selector = $hover->add_hover_to_selectors( $selector );
            }
        }

        // Sticky values
        if( $args['sticky'] && $option_type === 'sticky' ){
            $sticky			= et_pb_sticky_options();
            $sticky_values = explode( "|", $option_value );
            $sticky_important = is_array( $args['important'] ) ? in_array( 'sticky', $args['important'], true ) : $args['important'];

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
        }

        // Loop 4 times to generate CSS for each side (top, right, bottom, left).
        for( $i=0; $i<=3; $i++ ){

            // Generate the CSS property for each side.
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
            $_css_property = "{$css_property}-{$side}";

            // Responsive Options.
            if ( $args['responsive'] && $option_type === 'responsive' ) {

                // Get values for the current side for all devices.
                $_default   = isset( $default[$i] ) ? $default[$i] : '';
                $_desktop 	= isset( $desktop[$i] ) && $desktop[$i] !== $_default ? $desktop[$i] : '';
                $_tablet 	= isset( $tablet[$i] ) ? $tablet[$i] : '';
                $_phone 	= isset( $phone[$i] ) ? $phone[$i] : '';

                if ( '' !== $_tablet || '' !== $_phone || '' !== $_desktop ) {
        
                    $responsive_values = array(
                        'desktop' => $_desktop,
                        'tablet'  => $responsive_active ? $_tablet : '',
                        'phone'   => $responsive_active ? $_phone : '',
                    );

                    // Responsive Options.
                    $responsive->generate_responsive_css(
                        $responsive_values,
                        $selector,
                        $_css_property,
                        $render_slug,
                        $responsive_additional_css,
                        $type,
                        $priority
                    );
                }
            }

            // Hover Option.
            if ( $args['hover'] && $option_type === 'hover' ) {
                
                $_hover_value   = isset( $hover_values[$i] ) ? $hover_values[$i] : '';

                if ( ! empty( $_hover_value ) ) {
                    $declaration = $module->generate_declaration(
                        $_css_property,
                        $_hover_value,
                        $hover_important,
                        $additional_css
                    );
                    $el_style    = array(
                        'selector'    => $hover_selector,
                        'declaration' => $declaration,
                    );
                    ET_Builder_Element::set_style( $render_slug, $el_style );
                }
            }

            // Sticky Option.
            if ( $args['sticky'] && $option_type === 'sticky' ) {
                
                $_sticky_value  = isset( $sticky_values[$i] ) ? $sticky_values[$i] : '';

                if ( ! empty( $_sticky_value ) ) {
                    $sticky_declaration = $module->generate_declaration(
                        $_css_property,
                        $_sticky_value,
                        $sticky_important,
                        $additional_css
                    );
                    $el_style           = array(
                        'selector'    => $sticky_selector,
                        'declaration' => $sticky_declaration,
                    );
                    ET_Builder_Element::set_style( $render_slug, $el_style );
                }
            }
        }
    }
}
