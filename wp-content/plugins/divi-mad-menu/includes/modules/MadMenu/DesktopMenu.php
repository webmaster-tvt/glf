<?php

// Die if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Horizontal Menu.
 * 
 * Generates the horizontal(desktop) menu markup.
 *
 * @since   1.0.0 
 * 
 */
class DVMM_Horizontal_Menu {

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
			'menu_breakpoint' => array(
				'label'             => esc_html__( 'Menu Breakpoint', 'dvmm-divi-mad-menu' ),
				'description'     => sprintf( 
					'<p class="et-fb-form__description">%1$s.</p>',
					esc_html__( 'Apply a different breakpoint for the desktop menu. The desktop menu will be visible on the screens having a width greater than the value set here', 'dvmm-divi-mad-menu' )
				),
				'type'              => 'range',
				'option_category'   => 'layout',
				'show_if'			=> array(
					'dvmm_enable_menu'	=> 'on',
				),
				'allowed_units'     => array( 'px' ),
				'default_unit'      => 'px',
				// 'validate_unit' 	=> false,
				'default'           => '980',
				'tab_slug'          => 'general',
				'toggle_slug'       => 'horizontal_menu',
			),
			'dvmm_horizontal_dd_animation' => array(
				'label'           	=> esc_html__( 'Submenu Animation', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Set an animation to be used when submenus appear. Submenus appear when hovering over the links with sub items.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_menu' => 'on',
				),
				// 'mobile_options'  	=> true,
				// 'responsive'      	=> true,
				'options' 			=> $module->helpers()->get_animation_options__open("desktop"),
				'default'         	=> 'fadeIn',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'horizontal_menu',
			),
			'horizontal_dd_open_duration' => array(
				'label'				=> esc_html__( 'Submenu Animation Duration', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Set the desktop menu submenus opening animation duration.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'configuration',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'show_if'			=> array(
					'dvmm_enable_menu'	=> 'on',
				),
				'default'           => '400ms',
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
				'toggle_slug'       => 'horizontal_menu',
			),
			'dvmm_link_color_active' => array(
				'label'           	=> esc_html__( 'Active Link Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the active link color. An active link is the page currently being visited. You can pick a color to be applied to active links to differentiate them from other links. The color will be applied to the active link\'s parent and ancestor links as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'menu_text',
				'sub_toggle'  		=> 'normal',
			),
			'dvmm_link_color_active_f' => array(
				'label'           	=> esc_html__( 'Active Link Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header active link color. An active link is the page currently being visited. You can pick a color to be applied to active links to differentiate them from other links. The color will be applied to the active link\'s parent and ancestor links as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'menu_text',
				'sub_toggle'  		=> 'fixed',
			),
			'dvmm_sub_link_color_active' => array(
				'label'           	=> esc_html__( 'Submenu Active Link Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the submenu active link color. An active link is the page currently being visited. You can pick a color to be applied to active links to differentiate them from other links. The color will be applied to the active link\'s parent and ancestor links as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'submenu_text',
				'sub_toggle'  		=> 'normal',
			),
			'dvmm_sub_link_color_active_f' => array(
				'label'           	=> esc_html__( 'Submenu Active Link Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header submenu active link color. An active link is the page currently being visited. You can pick a color to be applied to active links to differentiate them from other links. The color will be applied to the active link\'s parent and ancestor links as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'submenu_text',
				'sub_toggle'  		=> 'fixed',
			),
			'dvmm_item_bg_color' => array(
				'label'           	=> esc_html__( 'Item Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the menu item background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'menu_items',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_item_bg_color_f' => array(
				'label'           	=> esc_html__( 'Item Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header menu item background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'menu_items',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_sub_item_bg_color' => array(
				'label'           	=> esc_html__( 'Submenu Item Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the submenu item background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'submenu_items',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_sub_item_bg_color_f' => array(
				'label'           	=> esc_html__( 'Submenu Item Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header submenu item background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'submenu_items',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_item_bg_color_active' => array(
				'label'           	=> esc_html__( 'Active Item Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the active item background color. An active item/link is the page currently being visited. You can pick a color to be applied to active items background to differentiate them from other items. The background color will be applied to the active item\'s parent and ancestor items as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'menu_items',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_item_bg_color_active_f' => array(
				'label'           	=> esc_html__( 'Active Item Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header active item background color. An active item/link is the page currently being visited. You can pick a color to be applied to active items background to differentiate them from other items. The background color will be applied to the active item\'s parent and ancestor items as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'menu_items',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_sub_item_bg_color_active' => array(
				'label'           	=> esc_html__( 'Submenu Active Item Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the submenu active item background color. An active item/link is the page currently being visited. You can pick a color to be applied to active items background to differentiate them from other items. The background color will be applied to the active item\'s parent and ancestor items as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'submenu_items',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_sub_item_bg_color_active_f' => array(
				'label'           	=> esc_html__( 'Submenu Active Item Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header submenu active item background color. An active item/link is the page currently being visited. You can pick a color to be applied to active items background to differentiate them from other items. The background color will be applied to the active item\'s parent and ancestor items as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'submenu_items',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_submenu_bg_color' => array(
				'label'           	=> esc_html__( 'Submenu Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the submenu background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'submenu',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_submenu_bg_color_f' => array(
				'label'           	=> esc_html__( 'Submenu Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header submenu background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'submenu',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_item_margin' => array(
				'label'             => esc_html__('Item Margin', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'menu_items',
				'sub_toggle'		=> 'normal',
			),
            'dvmm_item_padding' => array(
                'label'             => esc_html__('Item Padding', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
                'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
				),
                'mobile_options'    => true,
                'responsive'        => true,
				'hover'           	=> 'tabs',
				'default'           => '12px|12px|12px|12px|false|false',
                'default_unit'      => 'px',
                'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'menu_items',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_item_margin_f' => array(
				'label'             => esc_html__('Item Margin (Fixed)', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				// 'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'menu_items',
				'sub_toggle'		=> 'fixed',
			),
            'dvmm_item_padding_f' => array(
                'label'             => esc_html__('Item Padding (Fixed)', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
                'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
                'mobile_options'    => true,
                'responsive'        => true,
				'hover'           	=> 'tabs',
				// 'default'           => '12px|12px|12px|12px|false|false',
                'default_unit'      => 'px',
                'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'menu_items',
				'sub_toggle'		=> 'fixed',
			),
            'dvmm_submenu_padding' => array(
                'label'             => esc_html__('Submenu Padding', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
                'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
				),
                'mobile_options'    => true,
                'responsive'        => true,
				// 'hover'           	=> 'tabs',
				'default'           => '20px|20px|20px|20px|false|false',
                'default_unit'      => 'px',
                'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'submenu',
				'sub_toggle'		=> 'normal',
			),
            'dvmm_submenu_padding_f' => array(
                'label'             => esc_html__('Submenu Padding (Fixed)', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
                'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
                'mobile_options'    => true,
                'responsive'        => true,
				// 'hover'           	=> 'tabs',
				// 'default'           => '20px|20px|20px|20px|false|false',
                'default_unit'      => 'px',
                'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'submenu',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_sub_item_margin' => array(
				'label'             => esc_html__('Submenu Item Margin', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				// 'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'submenu_items',
				'sub_toggle'		=> 'normal',
			),
            'dvmm_sub_item_padding' => array(
                'label'             => esc_html__('Submenu Item Padding', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
                'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
				),
                'mobile_options'    => true,
                'responsive'        => true,
				'hover'           	=> 'tabs',
				// 'default'           => '12px|12px|12px|12px|false|false',
                'default_unit'      => 'px',
                'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'submenu_items',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_sub_item_margin_f' => array(
				'label'             => esc_html__('Submenu Item Margin (Fixed)', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				// 'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'submenu_items',
				'sub_toggle'		=> 'fixed',
			),
            'dvmm_sub_item_padding_f' => array(
                'label'             => esc_html__('Submenu Item Padding (Fixed)', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
                'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_menu'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
                'mobile_options'    => true,
                'responsive'        => true,
				'hover'           	=> 'tabs',
				// 'default'           => '12px|12px|12px|12px|false|false',
                'default_unit'      => 'px',
                'tab_slug'          => 'advanced',
				'toggle_slug'     	=> 'submenu_items',
				'sub_toggle'		=> 'fixed',
			),
		);
		 
		/**
		 * Add the element alignment fields.
		 * 
		 * dvmm_items_vertical_alignment
		 * dvmm_items_vertical_alignment_f
		 * dvmm_items_horizontal_alignment
		 * dvmm_items_horizontal_alignment_f
		 */
		$element_fields = $module->helpers()->add_element_alignment_fields( 
			array(
				'element_name' 		 => "Desktop Menu Items",
				'element_slug' 		 => "menu", /* required, do not change */
				'setting_base' 		 => "items",
				'vertical_options' 	 => "general",
				'horizontal_options' => "menu_items",
				'tab_slug'			 => 'advanced',
				'toggle_slug'		 => 'elements_layout',
				'sub_toggle'		 => 'menu',
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
	 * 
	 * @since v1.0.0 
	 * 
	 * @param	object	$module			Module object.
	 * 
	 */
	public function get_advanced_fields_config($module) {
        
		// selectors
		$dvmm_menu_inner_container = "{$module->main_css_element} .dvmm_menu_inner_container";
		$dvmm_fixed 		= "{$module->main_css_element} .dvmm_fixed"; // fixed header
		$dvmm_menu 			= "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu"; // menu <ul> tag
		$dvmm_menu__fixed 	= "{$dvmm_fixed} .dvmm_menu__menu .dvmm_menu"; // fixed menu <ul> tag

		// advanced fields
        $advanced_fields = array(
			
		);

        return $advanced_fields;
	}

	/**
	 * Horizontal Menu CSS styles.
	 * 
	 * @since	v1.0.0
	 * 
	 * @param	object	$module			Module object.
	 * @param	string	$render_slug	Module slug.
	 */
	public static function css( $module, $render_slug ){
		
		// SELECTORS
		$dvmm_menu_inner_container = "{$module->main_css_element} .dvmm_menu_inner_container";

		// horizontal menu main items <ul> wrapper
		$dvmm_menu = "{$module->main_css_element} .dvmm_menu__menu > nav > ul.dvmm_menu";

		// active/current item (normal) 
		$current_item_ancestor 	= "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li.current-menu-ancestor";
		$current_item_parent 	= "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li.current-menu-parent";
		$current_item 			= "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li.current-menu-item";

		// active/current item (fixed)
		$current_item_ancestor_f	= "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li.current-menu-ancestor";
		$current_item_parent_f 		= "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li.current-menu-parent";
		$current_item_f				= "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li.current-menu-item";

		// active/current submenu item (normal) 
		$current_sub_item_ancestor 	= "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li li.current-menu-ancestor";
		$current_sub_item_parent 	= "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li li.current-menu-parent";
		$current_sub_item 			= "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li li.current-menu-item";

		// active/current submenu item (fixed)
		$current_sub_item_ancestor_f	= "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li li.current-menu-ancestor";
		$current_sub_item_parent_f 		= "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li li.current-menu-parent";
		$current_sub_item_f				= "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li li.current-menu-item";

		/**
		 * >>>> SUBMENU PADDING
		 * Top&bottom padding is applied to submenu <ul> tag.
		 * Left&right padding is applied to submenu item <li> tag.
		 * 
		 * @todo maybe move this to a separate function
		 */
		$dvmm_submenu_padding = $module->helpers()->generate_css_declarations__spacing( $module, 'dvmm_submenu_padding', '||||false|false', false, 'padding' );
		$dvmm_submenu_padding_f = $module->helpers()->generate_css_declarations__spacing( $module, 'dvmm_submenu_padding_f', '||||false|false', false, 'padding' );
		foreach ($dvmm_submenu_padding as $key => $value){
			$top_bottom_declaration[$key] = "{$value['top']} {$value['bottom']}"; // for <ul>
			$left_right_declaration[$key] = "{$value['left']} {$value['right']}"; // for <li>
		}
		foreach ($dvmm_submenu_padding_f as $key => $value){
			$top_bottom_declaration_f[$key] = "{$value['top']} {$value['bottom']}"; // for <ul>
			$left_right_declaration_f[$key] = "{$value['left']} {$value['right']}"; // for <li>
		}
		// Declare submenu top&bottom padding (<ul>) (normal)
		et_pb_responsive_options()->declare_responsive_css(
			$top_bottom_declaration,
			"{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li ul",
			$render_slug
		);
		// Declare submenu item left&right padding (<li>) (normal)
		et_pb_responsive_options()->declare_responsive_css(
			$left_right_declaration,
			"{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li li",
			$render_slug
		);
		// Declare submenu top&bottom padding (<ul>) (fixed)
		et_pb_responsive_options()->declare_responsive_css(
			$top_bottom_declaration_f,
			"{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li ul",
			$render_slug
		);
		// Declare submenu item left&right padding (<li>) (fixed)
		et_pb_responsive_options()->declare_responsive_css(
			$left_right_declaration_f,
			"{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li li",
			$render_slug
		);
		// >>>> END SUBMENU PADDING

		// Items vertical alignment
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_items_vertical_alignment',
			'setting_fixed'		=> 'dvmm_items_vertical_alignment_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'	=> "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu",
				'fixed'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu",
			),
			'property' 			=> 'align-items',
			'additional_css'	=> '',
			'field_type'		=> 'select',
			'priority'			=> ''
		));

		// Items horizontal alignment
		$module->helpers()->declare_element_content_horizontal_alignment_css( $module->props, $render_slug, array( 
			'setting' 		=> 'dvmm_items_horizontal_alignment',
			'setting_fixed'	=> 'dvmm_items_horizontal_alignment_f',
			'selector' 		=> array(
				'normal'			=> "{$module->main_css_element} .dvmm_menu__menu > nav > ul.dvmm_menu", // container
				'normal_stretch'	=> "{$module->main_css_element} .dvmm_menu__menu > nav > ul.dvmm_menu > li", // item(content)
				'fixed'				=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu > nav > ul.dvmm_menu",
				'fixed_stretch'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu > nav > ul.dvmm_menu > li",
			),
		));

		// Item background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_item_bg_color',
			'setting_fixed'		=> 'dvmm_item_bg_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li a",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li:hover > a",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li a",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li:hover > a",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Submenu item background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_sub_item_bg_color',
			'setting_fixed'		=> 'dvmm_sub_item_bg_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li li a",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li li:hover > a",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li li a",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li li:hover > a",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Submenu background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_submenu_bg_color',
			'setting_fixed'		=> 'dvmm_submenu_bg_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li ul",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li ul:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li ul",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li ul:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Item margin (top level <li>, not <a>)
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_item_margin',
			'setting_fixed'		=> 'dvmm_item_margin_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_menu__menu > nav > ul > li",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_menu__menu > nav > ul > li:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu > nav > ul > li",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu > nav > ul > li:hover",
			),
			'property' 			=> 'margin',
			'additional_css'	=> '',
			'field_type'		=> 'custom_margin',
			'priority'			=> ''
		));

		// Item link padding (<a></a>)
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_item_padding',
			'setting_fixed'		=> 'dvmm_item_padding_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li a",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li a:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li a",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li a:hover",
			),
			'property' 			=> 'padding',
			'additional_css'	=> '',
			'field_type'		=> 'custom_padding',
			'priority'			=> ''
		));

		// Submenu item margin (<li></li>)
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_sub_item_margin',
			'setting_fixed'		=> 'dvmm_sub_item_margin_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li li",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li li:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li li",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li li:hover",
			),
			'property' 			=> 'margin',
			'additional_css'	=> '',
			'field_type'		=> 'custom_margin',
			'priority'			=> ''
		));

		// Submenu item link padding (<a></a>)
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_sub_item_padding',
			'setting_fixed'		=> 'dvmm_sub_item_padding_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li li a",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_menu__menu .dvmm_menu li li a:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li li a",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_menu__menu .dvmm_menu li li a:hover",
			),
			'property' 			=> 'padding',
			'additional_css'	=> '',
			'field_type'		=> 'custom_padding',
			'priority'			=> ''
		));
		
		// Active link color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_link_color_active',
			'setting_fixed'		=> 'dvmm_link_color_active_f',
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

		// Submenu active link color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_sub_link_color_active',
			'setting_fixed'		=> 'dvmm_sub_link_color_active_f',
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

		// Active item background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_item_bg_color_active',
			'setting_fixed'		=> 'dvmm_item_bg_color_active_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$current_item_ancestor} > a, {$current_item_parent} > a, {$current_item} > a",
				'normal_hover'	=> "{$current_item_ancestor}:hover > a, {$current_item_parent}:hover > a, {$current_item}:hover > a",
				'fixed'			=> "{$current_item_ancestor_f} > a, {$current_item_parent_f} > a, {$current_item_f} > a",
				'fixed_hover'	=> "{$current_item_ancestor_f}:hover > a, {$current_item_parent_f}:hover > a, {$current_item_f}:hover > a",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Submenu active item background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_sub_item_bg_color_active',
			'setting_fixed'		=> 'dvmm_sub_item_bg_color_active_f',
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

		// Submenu OPENING animation duration
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'horizontal_dd_open_duration',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_menu__menu ul li:hover > ul",
			),
			'property' 			=> 'animation-duration',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));
		
	}

	/**
     * Manage the horizontal menu classes.
	 * Manages the CSS classes of the .dvmm_menu__menu container.
     * 
     * @since   v1.0.0
     * 
	 * @param	object	$module		Module object.
	 * @param	array	$args		Arguments.
	 * 
     * @return	array				Horizontal menu CSS classes.
	 * 
     */
	static function css_classes( $module, $args = array() ){

		// PROPS
		$dd_animation = isset($module->props['dvmm_horizontal_dd_animation']) ? $module->props['dvmm_horizontal_dd_animation'] : 'none';

		// ARGS
		// get the menu device (possible options: desktop, tablet and phone)
		$menu_type	= isset($args['menu_type']) ? $args['menu_type'] : 'desktop';

		// menu default CSS classes array (.dvmm_menu__menu)
		$menu_classes = ['dvmm_menu__menu'];

		// menu classes
		$active_menu_class 	= sprintf( 'dvmm_menu__%s', esc_attr( $menu_type ) );
		$dd_animation_class = sprintf( 'dvmm_dd_animation--%s', esc_attr( $dd_animation ) );

		// add to menu classes
		array_push( $menu_classes,
			$active_menu_class,
			$dd_animation_class
		);

		return $menu_classes;
	}

	/**
	 * Generate horizontal menu markup.
	 * 
	 * @since	v1.0.0
	 * 
	 * @param	object		$module			Module object.
	 * @param	array		$args			Arguments.
	 * @param	function	$get_the_menu	Get the menu markup by its ID (<ul>...</ul>).
	 * 
	 * @return	string						Horizontal menu HTML.
	 */
	static function menu_markup( $module, $args, $get_the_menu ){

		// get the horizontal menu CSS classes
		$menu_classes = implode(' ', self::css_classes( $module, $args ));

		// get the menu HTML (<ul>...</ul>)
		$menu = $get_the_menu( $args );

		$menu_HTML = sprintf(
			'<div class="%2$s">
				<nav class="dvmm_menu_nav">
					%1$s
				</nav>
			</div>',
			$menu,
			esc_attr( $menu_classes )
		);

		return $menu_HTML;
	}

	/**
     * Manage the assigned horizontal menus.
	 * 
	 * Outputs the assigned horizontal menus
	 * taking into account the breakpoint value.
     * 
     * @since   v1.0.0
     * 
	 * @param	object		$module				Module object.
	 * @param	array		$processed_props	Processed props.
	 * @param	function	$get_the_menu		Get the menu markup by its ID (<ul>...</ul>).
	 * 
     * @return  string  						Updated assigned horizontal menus (desktop, tablet and phone).
	 * 
     */
	static function menus( $module, $processed_props, $get_the_menu ){

		// PROCESSED PROPS
		$menu_id			= $processed_props['dvmm_h_menu_id']['desktop'];
		$menu_id_tablet		= $processed_props['dvmm_h_menu_id']['tablet'];
		$menu_id_phone		= $processed_props['dvmm_h_menu_id']['phone'];
		$menu_id_responsive	= $processed_props['dvmm_h_menu_id']['responsive'];
		$menu_breakpoint	= $processed_props['menu_breakpoint'];

		// menus html
		$all_horizontal_menus = '';
		$menu_desktop = '';
		$menu_tablet = '';
		$menu_phone = '';

		// add the Desktop horizontal menu
		$menu_desktop = self::menu_markup( $module, array(
			'menu_id'			=> $menu_id,
			'menu_type'			=> 'desktop',
		), $get_the_menu );

		// if responsive menus enabled
		if ( $menu_id_responsive === 'on' ){

			// if tablet menu is assigned: add Tablet menu
			if ( isset($menu_id_tablet) && $menu_id_tablet !== '' ){
				if ( $menu_breakpoint <= 979 ) {
					$menu_tablet = self::menu_markup( $module, array(
						'menu_id'	=> $menu_id_tablet,
						'menu_type'	=> 'tablet',
					), $get_the_menu );
				}
			}

			// if phone menu assigned: add Phone menu
			if ( isset($menu_id_phone) && $menu_id_phone !== '' ){
				if( $menu_breakpoint <= 767 ){
					$menu_phone = self::menu_markup( $module, array(
						'menu_id'	=> $menu_id_phone,
						'menu_type'	=> 'phone',
					), $get_the_menu );
				}
			}

		}

		// Generate the horizontal menu(s) HTML markup
		$all_horizontal_menus .= $menu_desktop;
		$all_horizontal_menus .= $menu_tablet;
		$all_horizontal_menus .= $menu_phone;

		return $all_horizontal_menus;
	}
    
}

/**
 * Intstantiates the DVMM_Horizontal_Menu class.
 * 
 * @since   1.0.0
 * 
 * @return  Instance of the DVMM_Horizontal_Menu class.
 * 
 */
function dvmm_horizontal_menu_class_instance( ) {
	return DVMM_Horizontal_Menu::instance( );
}