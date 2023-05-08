<?php

// Die if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Mobile Menu.
 * 
 * Generates the mobile menu markup.
 *
 * @since   1.0.0 
 * 
 */
class DVMM_Mobile_Menu {

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
     * Element Data.
     * 
     * The data that will be added to the inline JS script.
     * 
     * @since	v1.8.0
     * 
     * @param	object	$module				Module object.
     * @param	string	$processed_props	Processed props.
     * @param	string	$render_slug		Module slug.
     * @param	string	$element_name		Element name ('mobile_menu').
     * 
     * @return  string                      Element's data.
     */
    public function inline_script_data( $module, $processed_props, $render_slug, $element_name ){

		$is_element_enabled = $module->props["dvmm_enable_{$element_name}"];

        if($is_element_enabled === 'off'){
            return '';
        }

		$element_type 		= 'default'; // hardcoded till the "element_type" prop is introduced for the Mobile Menu element
		$collapse_submenus 	= $module->props['collapse_submenus'];

		// Submenus data
        if($element_type !== 'default' || $collapse_submenus !== 'on'){
            $submenusData = '';
        } else {
			$mobile_parent_links	 = $module->props["mobile_parent_links"];
			$accordion_mode			 = $module->props["accordion_mode"];
			$submenu_style 			 = $module->props["submenu_style"];
			$use_submenu_header_text = $module->props["use_submenu_header_text"];
			$submenu_header_text 	 = $module->props["submenu_header_text"];

			// Maybe clickable parent links
			$parentClickable = sprintf('parentClickable: "%1$s",', esc_attr( $mobile_parent_links ));

			if($submenu_style === 'expand'){
				$accordionMode			= sprintf('accordionMode: "%1$s",', esc_attr( $accordion_mode ));;
				$useSubmenuHeaderText	= '';
				$submenuHeaderText		= '';
			} else {
				$accordionMode			= '';
				$useSubmenuHeaderText	= sprintf('useSubmenuHeaderText: "%1$s",', esc_attr( $use_submenu_header_text ));
				$submenuHeaderText		= $use_submenu_header_text === 'custom' ? sprintf('submenuHeaderText: "%1$s",', esc_attr( $submenu_header_text )) : '';
			}

			$submenusData = sprintf('submenus: {%1$s submenuStyle:"%2$s",%3$s%4$s%5$s},',
				et_core_esc_previously( $parentClickable ),			// %1$s
				esc_attr( $submenu_style ),							// %2$s
				et_core_esc_previously( $accordionMode ),			// %3$s
				et_core_esc_previously( $useSubmenuHeaderText ),	// %4$s
				et_core_esc_previously( $submenuHeaderText )		// %5$s
			);
		}

        /**
         * All data.
         */
        $data = sprintf('%1$s: {element_type: "%2$s",collapseSubmenus: "%3$s",%4$s}',
            esc_attr( $element_name ),              // %1$s
			esc_attr( $element_type ),              // %2$s
			esc_attr( $collapse_submenus ),      	// %3$s
            et_core_esc_previously( $submenusData )	// %4$s
        );

        return $data;
    }

	/**
	 * Mobile Menu Toggle.
	 * Returns the mobile menu toggle class instance.
	 * 
	 * @since	1.0.0
	 * 
	 * @return	DVMM_Mobile_Menu_Toggle
	 */
	static function mobile_menu_toggle(){
		return dvmm_mobile_menu_toggle_class_instance();
	}

	/**
	 * Fields.
	 * 
	 * @since	v1.0.0 
	 * 
	 * @param	object	$module		Module object.
	 * 
	 */
	public function get_fields( $module ) {

        $fields = array(
			'mobile_menu_breakpoint' => array(
				'label'             => esc_html__( 'Mobile Menu Breakpoint', 'dvmm-divi-mad-menu' ),
				'description'     => sprintf(
					'<p class="et-fb-form__description">%1$s.</p>',
					esc_html__( 'Apply a different breakpoint for the mobile menu. The mobile menu will be visible on the screens having a width equal to and less than the value set here', 'dvmm-divi-mad-menu' )
				),
				'type'              => 'range',
				'option_category'   => 'layout',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'allowed_units'     => array( 'px' ),
				'default_unit'      => 'px',
				// 'validate_unit' 	=> false,
				'default'           => '980',
				'tab_slug'          => 'general',
				'toggle_slug'       => 'mobile_menu',
			),
			'collapse_submenus' => array(
				'label'			  => esc_html__( 'Collapse Submenus', 'dvmm-divi-mad-menu' ),
				'description'	  => esc_html__( 'Collapse mobile menu submenus', 'dvmm-divi-mad-menu' ),
				'type'			  => 'yes_no_button',
				'option_category' => 'configuration',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'			=> 'off',
				'tab_slug'         => 'general',
				'toggle_slug'      => 'mobile_menu',
			),
			
			/**
			 * @since v1.8.0
			 */
			'submenu_style' => array(
				'label'				=> esc_html__( 'Submenu Style', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Select the collapsed submenu reveal style.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'configuration',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'collapse_submenus' 		=> 'on',
				),
				'options' 			=> array(
					'expand'		=> esc_html__( 'Expand', 'dvmm-divi-mad-menu' ),		// dvmm_submenus--expand
					'slide_right'	=> esc_html__( 'Slide Right', 'dvmm-divi-mad-menu' ), 	// dvmm_submenus--slide_right
					'slide_left'	=> esc_html__( 'Slide Left', 'dvmm-divi-mad-menu' ), 	// dvmm_submenus--slide_left
				),
				'default'         	=> 'expand',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'mobile_menu',
			),
			'use_submenu_header_text' => array(
				'label'				=> esc_html__( 'Use Submenu Header Text', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Here you can enable the mobile menu submenu header text.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'configuration',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'collapse_submenus' 		=> 'on',
				),
				'show_if_not'		=> array(
					'submenu_style'	=> 'expand',
				),
				'options' 			=> array(
					'parent_item'	=> esc_html__( 'Parent Item Text', 'dvmm-divi-mad-menu' ),
					'custom'		=> esc_html__( 'Custom Text', 'dvmm-divi-mad-menu' ),
					'none'			=> esc_html__( 'No Text', 'dvmm-divi-mad-menu' ), 
				),
				'default'         	=> 'parent_item',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'mobile_menu',
			),
			'submenu_header_text' 	=> array(
				'label'            	=> esc_html__( 'Submenu Header Text', 'dvmm-divi-mad-menu' ),
				'description'      	=> esc_html__( 'Add the mobile menu submenu header text.', 'dvmm-divi-mad-menu' ),
				'type'             	=> 'text',
				'option_category'  	=> 'basic_option',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'collapse_submenus' 		=> 'on',
					'use_submenu_header_text'	=> 'custom',
				),
				'show_if_not'		=> array(
					'submenu_style'	=> 'expand',
				),
				'default'       	=> esc_html__( 'Back', 'dvmm-divi-mad-menu' ),
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'mobile_menu',
			),
			// end

			'mobile_parent_links' => array(
				'label'           	=> esc_html__( 'Parent Links Clickable', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Make the parent item links clickable', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'yes_no_button',
				'option_category' 	=> 'configuration',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'collapse_submenus' 		=> 'on',
				),
				'options'         	=> array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'off',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'mobile_menu',
			),
			'accordion_mode' => array(
				'label'           	=> esc_html__( 'Accordion Mode', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Allow only one open submenu at a time. If enabled, expanding a submenu will collapse all other opened submenus of the same level', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'yes_no_button',
				'option_category' 	=> 'configuration',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'collapse_submenus' 		=> 'on',
					'submenu_style' 			=> 'expand',
				),
				'options'         	=> array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'off',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'mobile_menu',
			),

			/**
			 * @since v1.4
			 */	
			'close_on_outside_click' => array(
				'label'			  => esc_html__( 'Close On Outside Click', 'dvmm-divi-mad-menu' ),
				'description'	  => esc_html__( 'Close the mobile dropdown menu when clicked outside the dropdown menu and the Mobile Menu Toggle.', 'dvmm-divi-mad-menu' ),
				'type'			  => 'yes_no_button',
				'option_category' => 'configuration',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'			=> 'off',
				'tab_slug'         => 'general',
				'toggle_slug'      => 'mobile_menu',
			),

			/**
			 * Is used to add a CSS class to the mobile menu wrap contaner
			 * (dvmm_dd_placement--default & dvmm_dd_placement--attached).
			 * 
			 * @since v1.4
			 */
			'mobile_menu_placement' => array(
				'label'				=> esc_html__( 'Dropdown Menu Placement', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Select the mobile dropdown menu placement. The "Default" option keeps the dropdown menu in the same place independently from the position change of the Mobile Menu Toggle, while the "Attached to Menu Toggle" option makes the dropdown menu move "attached" to the Mobile Menu Toggle.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'option_category'	=> 'configuration',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'options' 			=> array(
					'static'	=> esc_html__( 'Default', 'dvmm-divi-mad-menu' ),					// --default
					'relative'	=> esc_html__( 'Attached to Menu Toggle', 'dvmm-divi-mad-menu' ), 	// --attached
				),
				'default'         	=> 'static',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'mobile_menu',
			),
			'mobile_menu_animation_open' => array(
				'label'				=> esc_html__( 'Opening Animation', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Select the mobile menu opening animation.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'option_category'	=> 'configuration',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'options' 			=> $module->helpers()->get_animation_options__open("mobile"),
				'default'         	=> 'default',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'mobile_menu',
			),
			'mobile_menu_animation_open_duration' => array(
				'label'				=> esc_html__( 'Opening Animation Duration', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Set the mobile menu opening animation duration.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'configuration',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'default'           => '700ms',
				'allowed_units'     => array( 'ms' ),
				'default_unit'      => 'ms',
				'validate_unit' 	=> true,
				// 'unitless'			=> true,
				'fixed_range'       => true,
				'range_settings'    => array(
					'min'  => 0,
					'max'  => 2000,
					'step' => 50,
				),
				'tab_slug'          => 'general',
				'toggle_slug'       => 'mobile_menu',
			),
			'mobile_menu_animation_close' => array(
				'label'				=> esc_html__( 'Closing Animation', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Select the mobile menu closing animation.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'option_category'	=> 'configuration',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'options'			=> $module->helpers()->get_animation_options__close("mobile"),
				'default'         	=> 'default',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'mobile_menu',
			),
			'mobile_menu_animation_close_duration' => array(
				'label'				=> esc_html__( 'Closing Animation Duration', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Set the mobile menu closing animation duration.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'configuration',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'default'           => '700ms',
				'allowed_units'     => array( 'ms' ),
				'default_unit'      => 'ms',
				'fixed_unit'        => 'ms',
				'validate_unit' 	=> true,
				// 'unitless'			=> true,
				'fixed_range'       => true,
				'range_settings'    => array(
					'min'  => 0,
					'max'  => 2000,
					'step' => 50,
				),
				'tab_slug'          => 'general',
				'toggle_slug'       => 'mobile_menu',
			),
			'dvmm_mobile_link_color_active' => array(
				'label'           	=> esc_html__( 'Mobile Active Link Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the active link color. An active link is the page currently being visited. You can pick a color to be applied to active links to differentiate them from other links. The color will be applied to the active link\'s parent and ancestor links as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_menu_text',
				'sub_toggle'  		=> 'normal',
			),
			'dvmm_mobile_link_color_active_f' => array(
				'label'           	=> esc_html__( 'Mobile Active Link Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header active link color. An active link is the page currently being visited. You can pick a color to be applied to active links to differentiate them from other links. The color will be applied to the active link\'s parent and ancestor links as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_menu_text',
				'sub_toggle'  		=> 'fixed',
			),
			'dvmm_mobile_sub_link_color_active' => array(
				'label'           	=> esc_html__( 'Mobile Submenu Active Link Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the submenu active link color. An active link is the page currently being visited. You can pick a color to be applied to active links to differentiate them from other links. The color will be applied to the active link\'s parent and ancestor links as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_submenu_text',
				'sub_toggle'  		=> 'normal',
			),
			'dvmm_mobile_sub_link_color_active_f' => array(
				'label'           	=> esc_html__( 'Mobile Submenu Active Link Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header submenu active link color. An active link is the page currently being visited. You can pick a color to be applied to active links to differentiate them from other links. The color will be applied to the active link\'s parent and ancestor links as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_submenu_text',
				'sub_toggle'  		=> 'fixed',
			),
			'dvmm_mobile_bg_color' => array(
				'label'           	=> esc_html__( 'Mobile Menu Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the mobile menu background color.', 'dvmm-divi-mad-menu' ),
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
				'toggle_slug'     	=> 'mobile_menu_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mobile_bg_color_f' => array(
				'label'           	=> esc_html__( 'Mobile Menu Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header mobile menu background color.', 'dvmm-divi-mad-menu' ),
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
				'toggle_slug'     	=> 'mobile_menu_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mobile_sub_bg_color' => array(
				'label'           	=> esc_html__( 'Mobile Submenu Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the mobile submenu background color.', 'dvmm-divi-mad-menu' ),
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
				'toggle_slug'     	=> 'mobile_submenu_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mobile_sub_bg_color_f' => array(
				'label'           	=> esc_html__( 'Mobile Submenu Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header mobile submenu background color.', 'dvmm-divi-mad-menu' ),
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
				'toggle_slug'     	=> 'mobile_submenu_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mobile_item_bg_color' => array(
				'label'           	=> esc_html__( 'Mobile Item Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the mobile menu item background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_items_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mobile_item_bg_color_f' => array(
				'label'           	=> esc_html__( 'Mobile Item Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header mobile menu item background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_items_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mobile_sub_item_bg_color' => array(
				'label'           	=> esc_html__( 'Mobile Submenu Item Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the mobile submenu item background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_sub_items_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mobile_sub_item_bg_color_f' => array(
				'label'           	=> esc_html__( 'Mobile Submenu Item Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header mobile submenu item background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_sub_items_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mobile_parent_bg_color' => array(
				'label'           	=> esc_html__( 'Mobile Parent Item Bg Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the mobile menu parent item background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_items_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mobile_parent_bg_color_f' => array(
				'label'           	=> esc_html__( 'Mobile Parent Item Bg Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header mobile menu parent item background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_items_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mobile_item_bg_color_active' => array(
				'label'           	=> esc_html__( 'Mobile Active Item Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the mobile menu active item background color. An active item/link is the page currently being visited. You can pick a color to be applied to active items background to differentiate them from other items. The background color will be applied to the active item\'s parent and ancestor items as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_items_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mobile_item_bg_color_active_f' => array(
				'label'           	=> esc_html__( 'Mobile Active Item Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header mobile menu active item background color. An active item/link is the page currently being visited. You can pick a color to be applied to active items background to differentiate them from other items. The background color will be applied to the active item\'s parent and ancestor items as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_items_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mobile_sub_item_bg_color_active' => array(
				'label'           	=> esc_html__( 'Mobile Submenu Active Item Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the mobile menu submenu active item background color. An active item/link is the page currently being visited. You can pick a color to be applied to active items background to differentiate them from other items. The background color will be applied to the active item\'s parent and ancestor items as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_sub_items_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mobile_sub_item_bg_color_active_f' => array(
				'label'           	=> esc_html__( 'Mobile Submenu Active Item Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header mobile menu submenu active item background color. An active item/link is the page currently being visited. You can pick a color to be applied to active items background to differentiate them from other items. The background color will be applied to the active item\'s parent and ancestor items as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_sub_items_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mob_parent_arrow_color' => array(
				'label'           	=> esc_html__( 'Mobile Parent Arrow Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the mobile menu parent item arrow color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_items_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mob_parent_arrow_color_f' => array(
				'label'           	=> esc_html__( 'Mobile Parent Arrow Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header mobile menu parent item arrow color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_items_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mob_parent_arrow_bg_color' => array(
				'label'           	=> esc_html__( 'Mobile Parent Arrow Bg Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the mobile menu parent item arrow background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_items_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mob_parent_arrow_bg_color_f' => array(
				'label'           	=> esc_html__( 'Mobile Parent Arrow Bg Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header mobile menu parent item arrow background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_items_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mob_parent_arrow_size' => array(
				'label'             => esc_html__( 'Mobile Parent Arrow Size', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the mobile menu parent item arrow size.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           => 'tabs',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'allowed_units'     => array( 'px' ),
				'default_unit'      => 'px',
				// 'validate_unit' 	=> false,
				'default'           => '16px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'mobile_items_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mob_parent_arrow_size_f' => array(
				'label'             => esc_html__( 'Mobile Parent Arrow Size (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header mobile menu parent item arrow size.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           => 'tabs',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'allowed_units'     => array( 'px' ),
				'default_unit'      => 'px',
				// 'validate_unit' 	=> false,
				'default'           => '',
				'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'mobile_items_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mob_sub_parent_arrow_size' => array(
				'label'             => esc_html__( 'Mobile Submenu Parent Arrow Size', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the mobile submenu parent item arrow size.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           => 'tabs',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'allowed_units'     => array( 'px' ),
				'default_unit'      => 'px',
				// 'validate_unit' 	=> false,
				'default'           => '',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'mobile_sub_items_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mob_sub_parent_arrow_size_f' => array(
				'label'             => esc_html__( 'Mobile Submenu Parent Arrow Size (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header mobile submenu parent item arrow size.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           => 'tabs',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'allowed_units'     => array( 'px' ),
				'default_unit'      => 'px',
				// 'validate_unit' 	=> false,
				'default'           => '',
				'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'mobile_sub_items_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mobile_wrapper_padding' => array(
				'label'             => esc_html__('Mobile Menu Padding', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_padding',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'default'           => '15px|15px|15px|15px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'mobile_menu_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mobile_wrapper_padding_f' => array(
				'label'             => esc_html__('Mobile Menu Padding (Fixed)', 'dvmm-divi-mad-menu'),
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
				// 'default'           => '15px|15px|15px|15px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'mobile_menu_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mobile_wrapper_top_offset' => array(
				'label'             => esc_html__( 'Mobile Menu Top Offset', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the mobile dropdown menu top offset (for the dropdown menu expanding downwards).', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           => 'tabs',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'show_if_not'			=> array(
					'dvmm_dd_direction'	=> 'upwards',
				),
				'allowed_units'     => array( '%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
				'default_unit'      => '%',
				// 'validate_unit' 	=> false,
				'default'           => '100%',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'mobile_menu_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mobile_wrapper_top_offset_f' => array(
				'label'             => esc_html__( 'Mobile Menu Top Offset (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header mobile dropdown menu top offset (for the dropdown menu expanding downwards).', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'show_if_not'			=> array(
					'dvmm_dd_direction'	=> 'upwards',
				),
				'allowed_units'     => array( '%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
				'default_unit'      => '%',
				// 'validate_unit' 	=> false,
				'default'           => '',
				'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'mobile_menu_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mobile_wrapper_bottom_offset' => array(
				'label'             => esc_html__( 'Mobile Menu Bottom Offset', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the mobile dropdown menu bottom offset (for the dropdown menu expanding upwards).', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           => 'tabs',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'show_if_not'			=> array(
					'dvmm_dd_direction'	=> 'downwards',
				),
				'allowed_units'     => array( '%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
				'default_unit'      => '%',
				// 'validate_unit' 	=> false,
				'default'           => '100%',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'mobile_menu_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mobile_wrapper_bottom_offset_f' => array(
				'label'             => esc_html__( 'Mobile Menu Bottom Offset (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header mobile dropdown menu bottom offset (for the dropdown menu expanding upwards).', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           => 'tabs',
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'show_if_not'			=> array(
					'dvmm_dd_direction'	=> 'downwards',
				),
				'allowed_units'     => array( '%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
				'default_unit'      => '%',
				// 'validate_unit' 	=> false,
				'default'           => '',
				'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'mobile_menu_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mobile_item_padding' => array(
				'label'             => esc_html__('Mobile Item Padding', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_padding',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'default'           => '10px|20px|10px|20px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'mobile_items_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mobile_item_padding_f' => array(
				'label'             => esc_html__('Mobile Item Padding (Fixed)', 'dvmm-divi-mad-menu'),
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
				// 'default'           => '10px|20px|10px|20px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'mobile_items_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mobile_item_margin' => array(
				'label'             => esc_html__('Mobile Item Margin', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__('Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu'),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'mobile_items_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mobile_item_margin_f' => array(
				'label'             => esc_html__('Mobile Item Margin (Fixed)', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__('Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu'),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				// 'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'mobile_items_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mobile_sub_item_padding' => array(
				'label'             => esc_html__('Mobile Submenu Item Padding', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_padding',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				// 'default'           => '10px|20px|10px|20px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'mobile_sub_items_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mobile_sub_item_padding_f' => array(
				'label'             => esc_html__('Mobile Submenu Item Padding (Fixed)', 'dvmm-divi-mad-menu'),
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
				// 'default'           => '10px|20px|10px|20px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'mobile_sub_items_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mobile_sub_item_margin' => array(
				'label'             => esc_html__('Mobile Submenu Item Margin', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__('Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu'),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				// 'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'mobile_sub_items_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mobile_sub_item_margin_f' => array(
				'label'             => esc_html__('Mobile Submenu Item Margin (Fixed)', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__('Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu'),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				// 'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'mobile_sub_items_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mobile_sub_padding' => array(
				'label'             => esc_html__('Mobile Submenu Padding', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_padding',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'submenu_style' 			=> 'expand',
				),
				'default'           => '0px|0px|0px|10px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'mobile_submenu_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mobile_sub_padding_f' => array(
				'label'             => esc_html__('Mobile Submenu Padding (Fixed)', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_padding',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' 	=> 'on',
					'submenu_style' 			=> 'expand',
				),
				// 'default'           => '0px|0px|0px|10px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'mobile_submenu_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_mobile_sub_margin' => array(
				'label'             => esc_html__('Mobile Submenu Margin', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'submenu_style' 			=> 'expand',
				),
				'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'mobile_submenu_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_mobile_sub_margin_f' => array(
				'label'             => esc_html__('Mobile Submenu Margin (Fixed)', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' 	=> 'on',
					'submenu_style' 			=> 'expand',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				// 'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'mobile_submenu_design',
				'sub_toggle'		=> 'fixed',
			),

			/**
			 * The CSS for the mobile dropdown menu is generated dynamically using a JS function 
			 * (but not the generate_responsive_css() PHP function).
			 * @see dvmm_generate_mobile_dropdown_menu_alignment_css() JS function
			 * 
			 * @since v1.4
			 */
			'mobile_menu_alignment'	=> array(
				'label'           	=> esc_html__( 'Mobile Menu Alignment', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Align the dropdown menu to the left, right or center.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'align',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'options'         	=> et_builder_get_text_orientation_options( array( 'justified' ) ),
				'default'			=> 'center',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_menu_design',
				'sub_toggle'		=> 'normal',
			),
			'mobile_menu_min_width' => array(
				'label'				=> esc_html__( 'Mobile Menu Min Width', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Set the mobile dropdown menu minimum width.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'configuration',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
				),
				'default_unit'      => 'px',
				'validate_unit' 	=> true,
				'default'           => '240px',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_menu_design',
				'sub_toggle'		=> 'normal',
			),
			'mobile_menu_min_width_f' => array(
				'label'				=> esc_html__( 'Mobile Menu Min Width (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Set the fixed header mobile dropdown menu minimum width.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'configuration',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'show_if'			=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'default_unit'      => 'px',
				'validate_unit' 	=> true,
				'default'           => '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'mobile_menu_design',
				'sub_toggle'		=> 'fixed',
			),
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
			'mob_slide_sub_header_css' => array(
				'label'    => esc_html__( 'Mobile Submenu Header', 'dvmm-divi-mad-menu' ),
				'selector' => "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li.dvmm_submenu_header",
				'show_if'		=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'collapse_submenus' 		=> 'on',
				),
				'show_if_not'	=> array(
					'submenu_style'	=> 'expand',
				),
			),
			'mob_slide_sub_header_text_css' => array(
				'label'    => esc_html__( 'Mobile Submenu Header Text', 'dvmm-divi-mad-menu' ),
				'selector' => "{$module->main_css_element} .dvmm_mobile__menu .dvmm_back_text",
				'show_if'		=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'collapse_submenus' 		=> 'on',
				),
				'show_if_not'	=> array(
					'submenu_style'				=> 'expand',
					'use_submenu_header_text' 	=> 'none',
				),
			),
			'mob_slide_sub_header_back_css' => array(
				'label'    => esc_html__( 'Mobile Submenu Header "Back" Button', 'dvmm-divi-mad-menu' ),
				'selector' => "{$module->main_css_element} .dvmm_mobile__menu .dvmm_go_back.dvmm_back",
				'show_if'		=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'collapse_submenus' 		=> 'on',
				),
				'show_if_not'	=> array(
					'submenu_style'				=> 'expand',
				),
			),
			'mob_slide_sub_header_back_home_css' => array(
				'label'    => esc_html__( 'Mobile Submenu Header "Home" Button', 'dvmm-divi-mad-menu' ),
				'selector' => "{$module->main_css_element} .dvmm_mobile__menu .dvmm_go_back.dvmm_back_home",
				'show_if'		=> array(
					'dvmm_enable_mobile_menu'	=> 'on',
					'collapse_submenus' 		=> 'on',
				),
				'show_if_not'	=> array(
					'submenu_style'				=> 'expand',
				),
			),
		);

		return $custom_css_fields;
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

		// CSS selectors
		$dvmm_mobile_menu_wrapper = "{$module->main_css_element} .dvmm_mobile_menu_wrapper";

		// active/current item (normal) 
		$current_item_ancestor 	= "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li.current-menu-ancestor";
		$current_item_parent 	= "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li.current-menu-parent";
		$current_item 			= "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li.current-menu-item";

		// active/current item (fixed)
		$current_item_ancestor_f	= "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li.current-menu-ancestor";
		$current_item_parent_f 		= "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li.current-menu-parent";
		$current_item_f				= "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li.current-menu-item";

		// active/current submenu item (normal) 
		$current_sub_item_ancestor 	= "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li li.current-menu-ancestor";
		$current_sub_item_parent 	= "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li li.current-menu-parent";
		$current_sub_item 			= "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li li.current-menu-item";

		// active/current submenu item (fixed)
		$current_sub_item_ancestor_f	= "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li li.current-menu-ancestor";
		$current_sub_item_parent_f 		= "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li li.current-menu-parent";
		$current_sub_item_f				= "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li li.current-menu-item";
		
		$dvmm_mobile_menu 			= "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu"; // mobile menu <ul> tag
		$dvmm_mobile_menu__fixed 	= "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu"; // fixed mobile menu <ul> tag

		// Align mobile menu parent arrow (normal)
		$module->helpers()->mobile_parent_arrow_alignment( 
			$module->props, 
			'dvmm_mobile_menu_text_align', // $advanced_fields['fonts']['dvmm_mobile_menu']
			"{$dvmm_mobile_menu} .dvmm_submenu_toggle",
			$render_slug
		);
		// Align mobile menu parent arrow (fixed)
		$module->helpers()->mobile_parent_arrow_alignment( 
			$module->props, 
			'dvmm_mobile_menu_f_text_align',
			"{$dvmm_mobile_menu__fixed} .dvmm_submenu_toggle",
			$render_slug
		);
		// Align mobile submenu parent arrow (normal)
		$module->helpers()->mobile_parent_arrow_alignment( 
			$module->props, 
			'dvmm_mobile_submenu_text_align',
			"{$dvmm_mobile_menu} li li .dvmm_submenu_toggle",
			$render_slug
		);
		// Align mobile submenu parent arrow (fixed)
		$module->helpers()->mobile_parent_arrow_alignment( 
			$module->props, 
			'dvmm_mobile_submenu_f_text_align',
			"{$dvmm_mobile_menu__fixed} li li .dvmm_submenu_toggle",
			$render_slug
		);

		/**
		 * Mobile Dropdown menu min-width.
		 * 
		 * @since	v1.4
		 */
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'mobile_menu_min_width',
			'setting_fixed'		=> 'mobile_menu_min_width_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile_menu_wrapper",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile_menu_wrapper:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_wrapper",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_wrapper:hover",
			),
			'property' 			=> 'min-width',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Menu OPENING animation name
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'mobile_menu_animation_open',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mob_open--custom .open .dvmm_mobile_menu_wrapper",
			),
			'property' 			=> 'animation-name',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Menu OPENING animation duration
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'mobile_menu_animation_open_duration',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mob_open--custom .open .dvmm_mobile_menu_wrapper",
			),
			'property' 			=> 'animation-duration',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Menu CLOSING animation name
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'mobile_menu_animation_close',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mob_close--custom .closed .dvmm_mobile_menu_wrapper",
			),
			'property' 			=> 'animation-name',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Menu CLOSING animation duration
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'mobile_menu_animation_close_duration',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mob_close--custom .closed .dvmm_mobile_menu_wrapper",
			),
			'property' 			=> 'animation-duration',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Menu background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_bg_color',
			'setting_fixed'		=> 'dvmm_mobile_bg_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile_menu_wrapper",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile_menu_wrapper:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_wrapper",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_wrapper:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Submenu background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_sub_bg_color',
			'setting_fixed'		=> 'dvmm_mobile_sub_bg_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li ul",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li ul:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li ul",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li ul:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Menu Item background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_item_bg_color',
			'setting_fixed'		=> 'dvmm_mobile_item_bg_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li a, {$module->main_css_element} .dvmm_mobile__menu li.dvmm_submenu_header",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li:hover > a, {$module->main_css_element} .dvmm_mobile__menu li.dvmm_submenu_header:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li a, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu li.dvmm_submenu_header",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li:hover > a, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu li.dvmm_submenu_header:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Submenu Item background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_sub_item_bg_color',
			'setting_fixed'		=> 'dvmm_mobile_sub_item_bg_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li li a",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li li:hover > a",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li li a",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li li:hover > a",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Menu Parent Item background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_parent_bg_color',
			'setting_fixed'		=> 'dvmm_mobile_parent_bg_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li.menu-item-has-children > a, {$module->main_css_element} .dvmm_mobile__menu .menu-item-has-children li.dvmm_submenu_header",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li.menu-item-has-children:hover > a, {$module->main_css_element} .dvmm_mobile__menu .menu-item-has-children li.dvmm_submenu_header:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li.menu-item-has-children > a, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .menu-item-has-children li.dvmm_submenu_header",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li.menu-item-has-children:hover > a, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .menu-item-has-children li.dvmm_submenu_header:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Menu Parent Arrow color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mob_parent_arrow_color',
			'setting_fixed'		=> 'dvmm_mob_parent_arrow_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_submenu_toggle, {$module->main_css_element} .dvmm_mobile__menu .dvmm_go_back",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_submenu_toggle:hover, {$module->main_css_element} .dvmm_mobile__menu a:hover .dvmm_back, {$module->main_css_element} .dvmm_mobile__menu .dvmm_back_home:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_submenu_toggle, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_go_back",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_submenu_toggle:hover, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu a:hover .dvmm_back, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_back_home:hover",
			),
			'property' 			=> 'color',
			'additional_css'	=> '!important;',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Menu Parent Arrow background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mob_parent_arrow_bg_color',
			'setting_fixed'		=> 'dvmm_mob_parent_arrow_bg_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_submenu_toggle, {$module->main_css_element} .dvmm_mobile__menu .dvmm_go_back",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_submenu_toggle:hover, {$module->main_css_element} .dvmm_mobile__menu a:hover .dvmm_back, {$module->main_css_element} .dvmm_mobile__menu .dvmm_back_home:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_submenu_toggle, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_go_back",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_submenu_toggle:hover, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu a:hover .dvmm_back, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_back_home:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));
		
		// Mobile Menu Parent Arrow size
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mob_parent_arrow_size',
			'setting_fixed'		=> 'dvmm_mob_parent_arrow_size_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_submenu_toggle, {$module->main_css_element} .dvmm_mobile__menu .dvmm_go_back",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_submenu_toggle:hover, {$module->main_css_element} .dvmm_mobile__menu a:hover .dvmm_back, {$module->main_css_element} .dvmm_mobile__menu .dvmm_back_home:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_submenu_toggle, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_go_back",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_submenu_toggle:hover, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu a:hover .dvmm_back, {$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_back_home:hover",
			),
			'property' 			=> 'font-size',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Submenu Parent Arrow size
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mob_sub_parent_arrow_size',
			'setting_fixed'		=> 'dvmm_mob_sub_parent_arrow_size_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile__menu li li .dvmm_submenu_toggle",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile__menu li li .dvmm_submenu_toggle:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu li li .dvmm_submenu_toggle",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu li li .dvmm_submenu_toggle:hover",
			),
			'property' 			=> 'font-size',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Active Item background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_item_bg_color_active',
			'setting_fixed'		=> 'dvmm_mobile_item_bg_color_active_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$current_item_ancestor} > a, {$current_item_parent} > a, {$current_item} > a",
				'normal_hover'	=> "{$current_item_ancestor}:hover > a, {$current_item_parent}:hover > a, {$current_item}:hover > a",
				'fixed'			=> "{$current_item_ancestor_f} > a, {$current_item_parent_f} > a, {$current_item_f} > a",
				'fixed_hover'	=> "{$current_item_ancestor_f}:hover > a, {$current_item_parent_f}:hover > a, {$current_item_f}:hover > a",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '!important;',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Submenu Active Item background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_sub_item_bg_color_active',
			'setting_fixed'		=> 'dvmm_mobile_sub_item_bg_color_active_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$current_sub_item_ancestor} > a, {$current_sub_item_parent} > a, {$current_sub_item} > a",
				'normal_hover'	=> "{$current_sub_item_ancestor}:hover > a, {$current_sub_item_parent}:hover > a, {$current_sub_item}:hover > a",
				'fixed'			=> "{$current_sub_item_ancestor_f} > a, {$current_sub_item_parent_f} > a, {$current_sub_item_f} > a",
				'fixed_hover'	=> "{$current_sub_item_ancestor_f}:hover > a, {$current_sub_item_parent_f}:hover > a, {$current_sub_item_f}:hover > a",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '!important;',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile active link color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_link_color_active',
			'setting_fixed'		=> 'dvmm_mobile_link_color_active_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$current_item_ancestor} > a, {$current_item_parent} > a, {$current_item} > a",
				'normal_hover'	=> "{$current_item_ancestor}:hover > a, {$current_item_parent}:hover > a, {$current_item}:hover > a",
				'fixed'			=> "{$current_item_ancestor_f} > a, {$current_item_parent_f} > a, {$current_item_f} > a",
				'fixed_hover'	=> "{$current_item_ancestor_f}:hover > a, {$current_item_parent_f}:hover > a, {$current_item_f}:hover > a",
			),
			'property' 			=> 'color',
			'additional_css'	=> '!important;',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile submenu active link color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_sub_link_color_active',
			'setting_fixed'		=> 'dvmm_mobile_sub_link_color_active_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$current_sub_item_ancestor} > a, {$current_sub_item_parent} > a, {$current_sub_item} > a",
				'normal_hover'	=> "{$current_sub_item_ancestor}:hover > a, {$current_sub_item_parent}:hover > a, {$current_sub_item}:hover > a",
				'fixed'			=> "{$current_sub_item_ancestor_f} > a, {$current_sub_item_parent_f} > a, {$current_sub_item_f} > a",
				'fixed_hover'	=> "{$current_sub_item_ancestor_f}:hover > a, {$current_sub_item_parent_f}:hover > a, {$current_sub_item_f}:hover > a",
			),
			'property' 			=> 'color',
			'additional_css'	=> '!important;',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Menu wrapper padding
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_wrapper_padding',
			'setting_fixed'		=> 'dvmm_mobile_wrapper_padding_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile_menu_wrapper",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile_menu_wrapper:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_wrapper",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile_menu_wrapper:hover",
			),
			'property' 			=> 'padding',
			'additional_css'	=> '',
			'field_type'		=> 'custom_padding',
			'priority'			=> ''
		));	

		// Mobile Menu wrapper top offset
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_wrapper_top_offset',
			'setting_fixed'		=> 'dvmm_mobile_wrapper_top_offset_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_dd--downwards .dvmm_mobile_menu_wrapper",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_dd--downwards .dvmm_mobile_menu_wrapper:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_dd--downwards .dvmm_mobile_menu_wrapper",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_dd--downwards .dvmm_mobile_menu_wrapper:hover",
			),
			'property' 			=> 'top',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Mobile Menu wrapper bottom offset
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_wrapper_bottom_offset',
			'setting_fixed'		=> 'dvmm_mobile_wrapper_bottom_offset_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_dd--upwards .dvmm_mobile_menu_wrapper",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_dd--upwards .dvmm_mobile_menu_wrapper:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_dd--upwards .dvmm_mobile_menu_wrapper",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_dd--upwards .dvmm_mobile_menu_wrapper:hover",
			),
			'property' 			=> 'bottom',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// generate this for "Expand" submenus only
		if($module->props['submenu_style'] === 'expand'){

			// Mobile Submenu padding
			$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
				'setting' 			=> 'dvmm_mobile_sub_padding',
				'setting_fixed'		=> 'dvmm_mobile_sub_padding_f',
				'default'			=> '',
				'selector' 			=> array(
					'normal'		=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li ul",
					'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li ul:hover",
					'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li ul",
					'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li ul:hover",
				),
				'property' 			=> 'padding',
				'additional_css'	=> '',
				'field_type'		=> 'custom_padding',
				'priority'			=> ''
			));

		}

		// Mobile Item padding
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_item_padding',
			'setting_fixed'		=> 'dvmm_mobile_item_padding_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li a",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li a:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li a",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li a:hover",
			),
			'property' 			=> 'padding',
			'additional_css'	=> '',
			'field_type'		=> 'custom_padding',
			'priority'			=> ''
		));

		// Mobile Submenu Item padding
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_sub_item_padding',
			'setting_fixed'		=> 'dvmm_mobile_sub_item_padding_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li li a",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li li a:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li li a",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li li a:hover",
			),
			'property' 			=> 'padding',
			'additional_css'	=> '',
			'field_type'		=> 'custom_padding',
			'priority'			=> ''
		));

		// Mobile Item margin
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_item_margin',
			'setting_fixed'		=> 'dvmm_mobile_item_margin_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li:hover",
			),
			'property' 			=> 'margin',
			'additional_css'	=> '',
			'field_type'		=> 'custom_margin',
			'priority'			=> ''
		));

		// Mobile Submenu Item margin
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_mobile_sub_item_margin',
			'setting_fixed'		=> 'dvmm_mobile_sub_item_margin_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li li",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li li:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li li",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li li:hover",
			),
			'property' 			=> 'margin',
			'additional_css'	=> '',
			'field_type'		=> 'custom_margin',
			'priority'			=> ''
		));

		// Generate mobile submenu margin CSS for the 'Expand' style
		if($module->props['submenu_style'] === 'expand'){
			// Mobile Submenu margin
			$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
				'setting' 			=> 'dvmm_mobile_sub_margin',
				'setting_fixed'		=> 'dvmm_mobile_sub_margin_f',
				'default'			=> '',
				'selector' 			=> array(
					'normal'		=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li ul",
					'normal_hover'	=> "{$module->main_css_element} .dvmm_mobile__menu .dvmm_menu li ul:hover",
					'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li ul",
					'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li ul:hover",
				),
				'property' 			=> 'margin',
				'additional_css'	=> '',
				'field_type'		=> 'custom_margin',
				'priority'			=> ''
			));
		}

	}

	/**
	 * Generate mobile menu markup.
	 * 
	 * @since	v1.0.0
	 * 
	 * @param	object		$module				Module object.
	 * @param	array		$processed_props	Processed props.
	 * @param	string		$render_slug		Module slug.
	 * @param	array	    $args	        	Arguments
     * @param	function	$get_the_menu		Get the menu markup by its ID (<ul>...</ul>).
	 * 
	 * @return	string			            	Mobile menu HTML
	 * 
	 */
	static function menu_markup( $module, $processed_props, $render_slug, $args, $get_the_menu ){

		// get the menu HTML (<ul>...</ul>)
		$menu = $get_the_menu( $args );

		$menu_mobile_HTML = sprintf(
			'%1$s',
			$menu
		);

		return $menu_mobile_HTML;
	}

	/**
     * Manage the assigned mobile menus.
	 * 
	 * Outputs the assigned mobile menus
	 * taking into account the breakpoint value.
     * 
     * @since   v1.0.0
	 * 
	 * @param	object		$module				Module object.
	 * @param	array		$processed_props	Processed props.
	 * @param	string		$render_slug		Module slug.
     * @param	function	$get_the_menu		Get the menu markup by its ID (<ul>...</ul>).
	 * 
     * @return  string                      Updated assigned mobile menus (desktop, tablet and phone).
	 * 
     */
	static function menus( $module, $processed_props, $render_slug, $get_the_menu ){

		// props
		$menu_id 				= $processed_props['dvmm_m_menu_id']['desktop'];
		$menu_id_tablet 		= $processed_props['dvmm_m_menu_id']['tablet'];
		$menu_id_phone 			= $processed_props['dvmm_m_menu_id']['phone'];
		$menu_id_responsive 	= $processed_props['dvmm_m_menu_id']['responsive'];
		$mobile_menu_breakpoint	= $processed_props['mobile_menu_breakpoint'];

		// mobile menus html
		$all_mobile_menus = '';
		$menu_mobile_desktop = '';
		$menu_mobile_tablet = '';
		$menu_mobile_phone = '';

		// don't render duplicate menus if the same menu is set to more than one device
		$render_tablet_menu = $menu_id_tablet !== $menu_id ? true : false;
		$render_phone_menu = $menu_id_phone !== $menu_id_tablet && $menu_id_phone !== $menu_id ? true : false;

		// add the mobile 'tablet' menu
		$menu_mobile_desktop = self::menu_markup( $module, $processed_props, $render_slug, array(
			'menu_id'   => $menu_id,
			'menu_type' => 'desktop',
		), $get_the_menu );

		// if responsive menus enabled
		if ( $menu_id_responsive === 'on' ){

			// if tablet menu is assigned: remove 'Desktop' and add Tablet menu
			if ( isset($menu_id_tablet) && $menu_id_tablet !== '' && $render_tablet_menu === true ){

				// remove the 'desktop' mobile menu only if the breakpoint is less than 981px
				if ( $mobile_menu_breakpoint <= 980 ) {
					$menu_mobile_desktop = '';
				}

				// add the Tablet menu
				$menu_mobile_tablet = self::menu_markup( $module, $processed_props, $render_slug, array(
					'menu_id'	=> $menu_id_tablet,
					'menu_type'	=> 'tablet',
				), $get_the_menu );
			}

			// if phone menu assigned: add Phone menu
			if ( isset($menu_id_phone) && $menu_id_phone !== '' && $render_phone_menu === true ){

				// remove both the 'Desktop' and Tablet menus if breakpoint is less than 768px
				if( $mobile_menu_breakpoint <= 768 ){
					$menu_mobile_desktop = '';
					$menu_mobile_tablet = '';
				}

				// add the Phone menu
				if( $mobile_menu_breakpoint > 0 ) {
					$menu_mobile_phone = self::menu_markup( $module, $processed_props, $render_slug, array(
						'menu_id'	=> $menu_id_phone,
						'menu_type'	=> 'phone',
					), $get_the_menu );
				}
			}
		} 

		// remove the 'Desktop' mobile menu only if the breakpoint is/less than 0(zero)px
		if( $mobile_menu_breakpoint <= 0 ) {
			$menu_mobile_desktop = '';
		}

		// Generate the mobile menu(s) HTML markup
		$all_mobile_menus .= $menu_mobile_desktop;
		$all_mobile_menus .= $menu_mobile_tablet;
        $all_mobile_menus .= $menu_mobile_phone;

		// mobile menu default CSS classes array
		$mobileClasses = array('dvmm_mobile__menu', 'closed');

		// add mobile menu classes
		// array_push( $mobileClasses,
		//     
		// );

		// mobile menu classes array to string
		$mobileClasses = implode(" ", $mobileClasses);

		// get the mobile menu toggle
		$mobile_menu_toggle = self::mobile_menu_toggle()->render( $module, $processed_props, $render_slug );

		$mobile_menus = sprintf(
			'<div class="%1$s">
				%2$s
				<nav class="dvmm_mobile_nav">
					<div class="dvmm_mobile_menu_wrapper">
						%3$s
					</div>
				</nav>
			</div>',
			esc_attr( $mobileClasses ),
			$mobile_menu_toggle,
			$all_mobile_menus
		);

		return $mobile_menus;

	}
    
}

/**
 * Intstantiates the DVMM_Mobile_Menu class.
 * 
 * @since   1.0.0
 * 
 * @return  Instance of the DVMM_Mobile_Menu class.
 * 
 */
function dvmm_mobile_menu_class_instance( ) {
	return DVMM_Mobile_Menu::instance( );
}