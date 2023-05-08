<?php

// Die if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Menu Inner Container.
 * 
 * Generates the menu inner container(.dvmm_menu_inner_container) CSS classes and data attributes.
 *
 * @since   1.0.0 
 * 
 */
class DVMM_Menu_Inner_Container {

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
     * Manage the menu inner container classes.
	 * Manages the CSS classes of the .dvmm_menu_inner_container.
     * 
     * @since   v1.0.0 (updated in v1.3.3)
     * 
	 * @param	array	$processed_props            Processed Props
     * @return	array	$inner_container_classes    Menu inner container CSS classes.
     */
	static function css_classes( $processed_props = array() ){

		/**
		 * Processed props.
		 */
		$is_dbp	= isset($processed_props['is_dbp']) ? $processed_props['is_dbp'] : false;

		// menu inner container classes array (.dvmm_menu_inner_container)
		$inner_container_classes = ['dvmm_menu_inner_container', 'dvmm-fe'];

		// Add the DB Plugin class if it is activated (@since v1.3.3).
		$is_dbp_class = $is_dbp ? 'dvmm-dbp' : '';

		$inner_container_classes[] = $is_dbp_class;

		return $inner_container_classes;
	}

    /**
     * Manage the menu inner container data attributes.
	 * Manages the data attributes of the .dvmm_menu_inner_container .
     * 
     * @since   v1.0.0
     * 
	 * @param	object	$module                             Module object.
	 * @param	array	$props                              Processed props.
     * @return	array	$inner_container_data_attributes    Menu inner container data attributes.
     */
	static function data_attributes( $module, $props = array() ){

		// processed props
		$module_order_class 	= $props['module_order_class'];
		$fixed_header			= $props['fixed_header']['desktop'];
		$fixed_header_tablet	= $props['fixed_header']['tablet'];
		$fixed_header_phone		= $props['fixed_header']['phone'];
		$is_fixed_responsive	= $props['fixed_header']['responsive'];
		$is_fixed_enabled		= $props['is_fixed_enabled'];
		$fixed_headers			= "{$fixed_header}|{$fixed_header_tablet}|{$fixed_header_phone}|{$is_fixed_responsive}";

		// menu inner container data attributes array (.dvmm_menu_inner_container)
		$inner_container_data_attributes = [];
		$module_order_class_data = '';
		$fixed_headers_data = '';

		// module order class data attribute
		$module_order_class_data = sprintf( 'data-order_class="%1$s"', esc_attr( $module_order_class ) );

		// fixed headers data attribute
		if( $is_fixed_enabled === true ){
			if( $is_fixed_responsive !== 'on' ){
				// add the 'data-fixed_headers' attribute or nothing
				$fixed_headers_data = $fixed_header !== 'none' ? sprintf( 'data-fixed_headers="%1$s"', esc_attr( $fixed_header ) ) : '';
			} else {
				// add the 'data-fixed_headers' attribute
				$fixed_headers_data = sprintf( 'data-fixed_headers="%1$s"', esc_attr( $fixed_headers ) );
			}
		}

		// add to data attributes array
		$inner_container_data_attributes[] = $module_order_class_data;
		$inner_container_data_attributes[] = $fixed_headers_data;

		return $inner_container_data_attributes;

	}
    
}

/**
 * Intstantiates the DVMM_Menu_Inner_Container class.
 * 
 * @since   1.0.0
 * 
 * @return  Instance of the DVMM_Menu_Inner_Container class.
 * 
 */
function dvmm_menu_inner_container_class_instance( ) {
	return DVMM_Menu_Inner_Container::instance( );
}
