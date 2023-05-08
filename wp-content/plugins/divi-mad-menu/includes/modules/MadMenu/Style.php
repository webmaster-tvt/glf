<?php

// Die if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Module Styles.
 * 
 * Generates the module styles that cannot be generated using Divi API.
 *
 * @since   1.0.0 
 * 
 */
class DVMM_Menu_Module_Styles {

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
	 * Get header position CSS.
	 * 
	 * Returns the CSS for header positioning(top, bottom or none).
	 *
	 * @since	v1.0.0
	 *
	 * @param	string		$position	Position of the header
	 * 									(top, bottom and none).
	 *
	 * @return	string					The CSS for different positioning of the header
	 * 									(fixed or relative)
	 */
	static function get_header_position_css( $position = '' ) {
		switch ( $position ) {
			case 'top_push' :
			case 'top' :
				return 'position: fixed !important; top: 0; bottom: auto;';
			case 'bottom' :
				return 'position: fixed !important; top: auto; bottom: 0;';
			case 'none' :
				return 'position: relative !important; top: auto; bottom: auto;';
			default :
				return '';
		}
    }
    
    /**
	 * Dynamic breakpoint CSS.
	 * CSS for the menu dynamic breakpoint.
	 * 
	 * @since	v1.0.0
	 * 
	 * @param	array	$args			Arguments.
	 * @return	string	$module_styles	The <style></style> tags containing the module styles.
	 */
	static function styles( $args = array() ){

		$module_classes 	= explode(' ', $args['module_classname']);
		$module_selector 	= '.' . implode('.', $module_classes);
		/**
		 * remove the '.et_animated' class added to the module classes when animation is enabled,
		 * this class gets removed form module as soon as the animation ends but it remains 
		 * in the generated styles selector thus disabling them.
		 */
		$module_selector	= str_replace([".et_pb_module", ".et_animated", ".et_pb_with_border"],"", $module_selector);
		$_is_DB_plugin 		= et_is_builder_plugin_active();
		$fixed_header			= $args['fixed_header']['desktop'];
		$fixed_header_tablet	= $args['fixed_header']['tablet'];
		$fixed_header_phone		= $args['fixed_header']['phone'];
		$is_fixed_responsive	= $args['fixed_header']['responsive'];
		$is_fixed_enabled		= $args['is_fixed_enabled'];

		// style
		$style = '';
		$fixed_header_style = '';

		// make CSS selectors stronger if the Divi Builder plugin is active
		$_DB_plugin_selector = $_is_DB_plugin ? '.et_divi_builder #et_builder_outer_content' : '';

		// Cross-browser display: flex; declaration
		$display_flex = "display: -webkit-box; display: -ms-flexbox; display: flex;";

		/**
		 * Desktop Menu breakpoint CSS.
		 */
		$menu_breakpoint			= $args['menu_breakpoint'];
		$desktop_menu_visibility 	= '';
		$dvmm_show_menu 			= $args['dvmm_show_menu'];

		if( $dvmm_show_menu['desktop'] === 'off' ){
			$desktop_menu_visibility .= sprintf(
				'@media all and (min-width: 981px){
					%2$s %1$s .dvmm_menu__wrap {
						display: none;
					}
				}',
				esc_attr( $module_selector ),
				esc_attr( $_DB_plugin_selector )
			);
		}

		if( $menu_breakpoint >= 981 ){
			$desktop_menu_visibility .= sprintf(
				'@media all and (min-width: 981px) and (max-width: %1$spx){ 
					%3$s %2$s .dvmm_menu__wrap {
						display: none;
					}
				}',
				esc_attr( $menu_breakpoint ),
				esc_attr( $module_selector ),
				esc_attr( $_DB_plugin_selector )
			);
		} elseif ( $menu_breakpoint >= 768 && $menu_breakpoint <= 979 ) {
			if( ($dvmm_show_menu['responsive'] === 'off' && $dvmm_show_menu['desktop'] === 'on') 
				|| ($dvmm_show_menu['responsive'] === 'on' && $dvmm_show_menu['tablet'] === 'on') ){

				$desktop_menu_visibility .= sprintf(
					'@media all and (min-width: %1$spx) and (max-width: 980px){ 
						%3$s %2$s .dvmm_menu__wrap,
						%3$s %2$s .dvmm_menu__wrap:not(.dvmm_menu--tablet) .dvmm_menu__desktop,
						%3$s %2$s .dvmm_menu__wrap.dvmm_menu--tablet .dvmm_menu__tablet { %4$s }
					}',
					esc_attr( $menu_breakpoint ),
					esc_attr( $module_selector ),
					esc_attr( $_DB_plugin_selector ),
					esc_attr( $display_flex )
				);

			}
		} elseif ( $menu_breakpoint <= 767 ) {
			if( ($dvmm_show_menu['responsive'] === 'off' && $dvmm_show_menu['desktop'] === 'on') 
				|| ($dvmm_show_menu['responsive'] === 'on' && $dvmm_show_menu['tablet'] === 'on') ){

				$desktop_menu_visibility .= sprintf(
					'@media all and (min-width: 768px) and (max-width: 980px){ 
						%3$s %2$s .dvmm_menu__wrap,
						%3$s %2$s .dvmm_menu__wrap:not(.dvmm_menu--tablet) .dvmm_menu__desktop,
						%3$s %2$s .dvmm_menu__tablet { %4$s }
					}
					',
					esc_attr( $menu_breakpoint ),
					esc_attr( $module_selector ),
					esc_attr( $_DB_plugin_selector ),
					esc_attr( $display_flex )
				);

			}
			if( ($dvmm_show_menu['responsive'] === 'off' && $dvmm_show_menu['desktop'] === 'on') 
				|| ($dvmm_show_menu['responsive'] === 'on' && $dvmm_show_menu['phone'] === 'on') ){

				$desktop_menu_visibility .= sprintf(
					'@media all and (min-width: %1$spx) and (max-width: 767px){ 
						%3$s %2$s .dvmm_menu__wrap,
						%3$s %2$s .dvmm_menu__wrap:not(.dvmm_menu--phone) .dvmm_menu__desktop,
						%3$s %2$s .dvmm_menu__phone { %4$s }
					}
					',
					esc_attr( $menu_breakpoint ),
					esc_attr( $module_selector ),
					esc_attr( $_DB_plugin_selector ),
					esc_attr( $display_flex )
				);

			}
		}

		/**
		 * Mobile Menu breakpoint CSS.
		 */
		$mobile_menu_breakpoint			= $args['mobile_menu_breakpoint'];
		$mobile_menu_visibility = '';
		$dvmm_show_mobile_menu = $args['dvmm_show_mobile_menu'];

		if( ($dvmm_show_mobile_menu['responsive'] === 'off' && $dvmm_show_mobile_menu['desktop'] === 'off') 
			|| ($dvmm_show_mobile_menu['responsive'] === 'on' && $dvmm_show_mobile_menu['tablet'] === 'off') ){

			$mobile_menu_visibility .= sprintf(
				'@media all and (max-width: 980px){
					%2$s %1$s .dvmm_mobile_menu__wrap {
						display: none;
					}
				}',
				esc_attr( $module_selector ),
				esc_attr( $_DB_plugin_selector )
			);

		}

		if( $dvmm_show_mobile_menu['responsive'] === 'on' && $dvmm_show_mobile_menu['phone'] === 'on' ){

			$mobile_menu_visibility .= sprintf(
				'@media all and (max-width: 767px){
					%2$s %1$s .dvmm_mobile_menu__wrap { %3$s }
				}',
				esc_attr( $module_selector ),
				esc_attr( $_DB_plugin_selector ),
				esc_attr( $display_flex )
			);

		}

		if( ($dvmm_show_mobile_menu['responsive'] === 'off' && $dvmm_show_mobile_menu['desktop'] === 'off') 
			|| ($dvmm_show_mobile_menu['responsive'] === 'on' && $dvmm_show_mobile_menu['phone'] === 'off') ){

			$mobile_menu_visibility .= sprintf(
				'@media all and (max-width: 767px){
					%2$s %1$s .dvmm_mobile_menu__wrap {
						display: none;
					}
				}',
				esc_attr( $module_selector ),
				esc_attr( $_DB_plugin_selector )
			);

		}

		if( $mobile_menu_breakpoint >= 981 ){
			if( $dvmm_show_mobile_menu['desktop'] === 'on' ){

				$mobile_menu_visibility .= sprintf(
					'@media all and (min-width: 981px) and (max-width: %1$spx){
						%3$s %2$s .dvmm_mobile_menu__wrap { %4$s } 
					}',
					esc_attr( $mobile_menu_breakpoint ),
					esc_attr( $module_selector ),
					esc_attr( $_DB_plugin_selector ),
					esc_attr( $display_flex )
				);

			}
		} elseif ( $mobile_menu_breakpoint <= 979 ) {
			$mobile_menu_visibility .= sprintf(
				'@media all and (min-width: %1$spx) and (max-width: 980px){ 
					%3$s %2$s .dvmm_mobile_menu__wrap {
						display: none;
					} 
				}',
				esc_attr( $mobile_menu_breakpoint ),
				esc_attr( $module_selector ),
				esc_attr( $_DB_plugin_selector )
			);
		} else {
			$mobile_menu_visibility .= '';
		}

		/**
		 * Fixed header CSS.
		 */
		// if fixed header is enabled
		if( $is_fixed_enabled === true ){
			// if responsive fixed headers are not enabled
			if( $is_fixed_responsive !== 'on' ){
				// applies to all devices (desktop, tablet and phone)
				if ( $fixed_header !== 'none' ){
					// add to fixed header styles
					$fixed_header_style .= sprintf(' %2$s %1$s { %3$s } ',
						esc_attr( $module_selector ),
						esc_attr( $_DB_plugin_selector ),
						esc_attr( self::get_header_position_css( $fixed_header ) )
					);
				}
			} else {
				// desktop
				if ( $fixed_header !== 'none' ){
					// add to fixed header styles
					$fixed_header_style .= sprintf(' %2$s %1$s { %3$s } ',
						esc_attr( $module_selector ),
						esc_attr( $_DB_plugin_selector ),
						esc_attr( self::get_header_position_css( $fixed_header ) )
					);
				}
				// tablet
				if ( $fixed_header_tablet !== $fixed_header ) {
					// add to fixed header styles
					$fixed_header_style .= sprintf(' @media all and (max-width: 980px){ %2$s %1$s { %3$s } } ',
						esc_attr( $module_selector ),
						esc_attr( $_DB_plugin_selector ),
						esc_attr( self::get_header_position_css( $fixed_header_tablet ) )
					);
				}
				// phone
				if ( $fixed_header_phone !== $fixed_header_tablet ) {
					// add to fixed header styles
					$fixed_header_style .= sprintf(' @media all and (max-width: 767px){ %2$s %1$s { %3$s } } ',
						esc_attr( $module_selector ),
						esc_attr( $_DB_plugin_selector ),
						esc_attr( self::get_header_position_css( $fixed_header_phone ) )
					);
				}
			}
		}

		// unify CSS styles
		$style .= $desktop_menu_visibility;
		$style .= $mobile_menu_visibility;
		$style .= $fixed_header_style;

		// populate the <style> tag with styles
		$style_tag_markup = sprintf(
			'<style type="text/css">
				%1$s
			</style>',
			esc_attr( $style )
		);

		// return module styles if any
		$module_styles = $style !== '' ? $style_tag_markup : '';

		return $module_styles;
	}
    
}

/**
 * Intstantiates the DVMM_Menu_Module_Styles class.
 * 
 * @since   1.0.0
 * 
 * @return  Instance of the DVMM_Menu_Module_Styles class.
 * 
 */
function dvmm_menu_module_styles_class_instance( ) {
	return DVMM_Menu_Module_Styles::instance( );
}

