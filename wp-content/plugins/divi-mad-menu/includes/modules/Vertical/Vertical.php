<?php
// Die if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

// Style processors.
require_once DVMM_PLUGIN_DIR_PATH . 'includes/StyleProcessor.php';

/**
 * Module main class.
 *
 * @since   1.9.0 
 * 
 */
class DVMMV_MadMenu_Vertical extends ET_Builder_Module {

	// Module slug
	public $slug = 'dvmmv_madmenu_vertical';

	// Full Visual Builder support
	public $vb_support = 'on';

	// Module credits
	protected $module_credits = array(
		'module_uri' => 'https://divicio.us',
		'author'     => 'Ivan Chiurcci',
		'author_uri' => 'https://divicio.us',
	);

	public function init() {

		// module name
		$this->name = esc_html__( 'MadMenu Vertical Menu', 'dvmm-divi-mad-menu' );
		
		// module order class
		$this->main_css_element = '%%order_class%%';

		// module icon
		$this->icon_path = DVMM_PLUGIN_DIR_PATH . 'includes/modules/MadMenu/divi-madmenu.svg';

		// Toggle settings
		$this->settings_modal_toggles  = array(
			'general' => array(
				'toggles' => array(
					'menu' => esc_html__( 'Menu', 'dvmm-divi-mad-menu' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'menu_text' => array(
						'title'      => esc_html__( 'Text: Item', 'dvmm-divi-mad-menu' ),
						'priority'   => 60,
					),
					'submenu_text' => array(
						'title'      => esc_html__( 'Text: Submenu Item', 'dvmm-divi-mad-menu' ),
						'priority'   => 60,
					),
					'menu_design' => array(
						'title'      => esc_html__( 'Menu', 'dvmm-divi-mad-menu' ),
						'priority'   => 60,
					),
					'items_design' => array(
						'title'      => esc_html__( 'Item', 'dvmm-divi-mad-menu' ),
						'priority'   => 60,
					),
					'submenu_design' => array(
						'title'      => esc_html__( 'Submenu', 'dvmm-divi-mad-menu' ),
						'priority'   => 60,
					),
					'sub_items_design' => array(
						'title'      => esc_html__( 'Submenu Item', 'dvmm-divi-mad-menu' ),
						'priority'   => 60,
					),
					'parent_items_design' => array(
						'title'      => esc_html__( 'Parent Item', 'dvmm-divi-mad-menu' ),
						'priority'   => 60,
					),
					'sub_parent_items_design' => array(
						'title'      => esc_html__( 'Submenu Parent Item', 'dvmm-divi-mad-menu' ),
						'priority'   => 60,
					),
				),
			),
			'custom_css' => array(
				'toggles' => array(
					
				)
			)
		);
	}

	/**
	 * Helper methods.
	 * Returns the helper methods class instance.
	 * 
	 * @since	1.9.0
	 * 
	 * @return	DVMM_Divi_Modules_Helper
	 */
	public function helpers(){
		return dvmm_modules_helper_methods();
	}

	/**
     * Manage the menu inner container classes.
	 * Manages the CSS classes of the ".dvmmv_inner" container.
     * 
     * @since   v1.9.0
     * 
	 * @param	obj		$module            			Module.
	 * @param	array	$processed_props            Processed props.
	 * 
     * @return	array	$inner_container_classes    Menu inner container CSS classes.
     */
	static function css_classes( $module, $processed_props = array() ){

		/**
		 * Processed props.
		 */
		$is_dbp				= isset($processed_props['is_dbp']) ? $processed_props['is_dbp'] : false;
		$menu_id 			= $processed_props['menu_id']['desktop'];
		$menu_id_tablet		= $processed_props['menu_id']['tablet'];
		$menu_id_phone 		= $processed_props['menu_id']['phone'];
		$menu_id_responsive	= $processed_props['menu_id']['responsive'];
		$collapse_submenus 	= $processed_props['collapse_submenus'];
		$parent_links 		= $processed_props['parent_links'];
		$accordion_mode		= $processed_props['accordion_mode'];
		$submenu_style 		= $module->props['submenu_style'];
		$animate_icon 		= $module->props['animate_icon'];

		// menu inner container classes array (.dvmmv_inner)
		$inner_container_classes = ['dvmmv_inner', 'dvmm-fe'];

		// Add the DB Plugin class if it is activated.
		$is_dbp_class = $is_dbp ? 'dvmm-dbp' : '';

		$inner_container_classes[] = $is_dbp_class;

		// collapse submenus class
		$collapse_submenus_class = $collapse_submenus === 'on' ? 'dvmm_submenus--collapsed' : 'dvmm_submenus--default';

		// collapsed submenus dependent classes
		if ( $collapse_submenus === 'on' ){

			// menu parent links mode class
			$parent_links_class = $parent_links === 'on' ? 'dvmm_parents--clickable' : 'dvmm_parents--disabled';

			// accordion mode class
			$accordion_mode_class = $submenu_style === 'expand' && $accordion_mode === 'on' ? 'dvmm_accordion--on' : 'dvmm_accordion--off';

			// submenu style class (dvmm_submenus--expand OR dvmm_submenus--slide_right)
			$submenu_style_class = "dvmm_submenus--{$submenu_style}";

			// animate parent item icon class
			$animate_icon_class = "dvmm_animate_icon--{$animate_icon}";

		} else {
			$parent_links_class = '';
			$accordion_mode_class = '';
			$submenu_style_class = '';
			$animate_icon_class = '';
		} 

		// Assigned menu CSS classes
		$mobile_desktop_class 	= 'dvmm_menu--desktop';
		$mobile_tablet_class 	= 'dvmm_menu--tablet';
		$mobile_phone_class 	= 'dvmm_menu--phone';

		// Add the 'desktop' menu class
		$inner_container_classes[] = $mobile_desktop_class;

		// if responsive menus enabled
		if ( $menu_id_responsive === 'on' ){
			// if tablet menu is assigned: remove Default and add Tablet menu class
			if ( isset($menu_id_tablet) && $menu_id_tablet !== '' ){
				// add the Tablet menu class
				$inner_container_classes[] = $mobile_tablet_class;
			}

			// if phone menu assigned: add Phone menu class
			if ( isset($menu_id_phone) && $menu_id_phone !== '' ){
				// add the Phone menu class
				$inner_container_classes[] = $mobile_phone_class;
			}
		}

		// add menu wrapper classes
		array_push( $inner_container_classes,
			$collapse_submenus_class,
			$submenu_style_class,
			$parent_links_class,
			$accordion_mode_class,
			$animate_icon_class
		);

		return $inner_container_classes;
	}

    /**
     * Manage the menu inner container data attributes.
	 * Manages the data attributes of the ".dvmmv_inner" container.
     * 
     * @since   v1.9.0
     * 
	 * @param	object	$module                             Module object.
	 * @param	array	$processed_props                    Processed props.
     * @return	array	$inner_container_data_attributes    Menu inner container data attributes.
     */
	static function data_attributes( $module, $processed_props = array() ){

		// processed props
		$module_order_class	= $processed_props['module_order_class'];
		$menu_id 			= $processed_props['menu_id']['desktop'];
		$menu_id_tablet 	= $processed_props['menu_id']['tablet'];
		$menu_id_phone 		= $processed_props['menu_id']['phone'];
		$menu_id_responsive = $processed_props['menu_id']['responsive'];
		$collapse_submenus	= $processed_props['collapse_submenus'];
		$parent_links 		= $processed_props['parent_links'];
		$accordion_mode		= $processed_props['accordion_mode'];

		// menu inner container data attributes array (.dvmmv_inner)
		$inner_container_data_attributes = [];
		$module_order_class_data = '';
		$parent_links_data 		= '';
		$accordion_mode_data	= '';

		// module order class data attribute
		$module_order_class_data = sprintf( 'data-order_class="%1$s"', esc_attr( $module_order_class ) );

		// selected menu ids for each device: desktop|tablet|phone|responsive
		$selected_menu_ids = $menu_id_responsive === 'on' ? "{$menu_id}|{$menu_id_tablet}|{$menu_id_phone}|{$menu_id_responsive}" : "{$menu_id}|{$menu_id_responsive}";
		$selected_menu_ids_data = sprintf( 'data-selected_menu_ids="%1$s"', esc_attr( $selected_menu_ids ) );

		// collapsed submenus dependent data attributes
		if ( $collapse_submenus === 'on' ){

			// menu parent item links mode (enabled/disabled)
			$parent_links_data 	= sprintf( 'data-parent_links="%1$s"', esc_attr( $parent_links ) );

			// accordion mode (enabled/disabled)
			$accordion_mode_data = sprintf( 'data-accordion_mode="%1$s"', esc_attr( $accordion_mode ) );
		}

		// add to data attributes array
		$inner_container_data_attributes[] = $module_order_class_data;
		$inner_container_data_attributes[] = $selected_menu_ids_data;
		$inner_container_data_attributes[] = $parent_links_data;
		$inner_container_data_attributes[] = $accordion_mode_data;

		return $inner_container_data_attributes;
	}

	// Fields
	public function get_fields() {
		$fields = array(
			'menu_id' => array(
				'label'           => esc_html__( 'Menu', 'dvmm-divi-mad-menu' ),
				'description'     => sprintf(
					'<p class="et-fb-form__description">%2$s. <a href="%1$s" target="_blank">%3$s</a>.</p>',
					esc_url( admin_url( 'nav-menus.php' ) ),
					esc_html__( 'Select a menu that should be used as vertical menu. You can set different menus for Desktop, Tablet and Phone devices.', 'dvmm-divi-mad-menu' ),
					esc_html__( 'Click here to create new menu', 'dvmm-divi-mad-menu' )
				),
				'type'            => 'select',
				'option_category' => 'basic_option',
                'mobile_options'  => true,
                'responsive'      => true,
				'options'		=> et_builder_get_nav_menus_options(),
				'default'		=> 'none',
				'tab_slug'		=> 'general',
				'toggle_slug'	=> 'menu',
			),
			'collapse_submenus' => array(
				'label'			  	=> esc_html__( 'Collapse Submenus', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Collapse menu submenus', 'dvmm-divi-mad-menu' ),
				'type'			  	=> 'yes_no_button',
				'option_category' 	=> 'configuration',
				'options'         	=> array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'			=> 'off',
				'tab_slug'    		=> 'general',
				'toggle_slug'		=> 'menu',
			),
			'submenu_style' => array(
				'label'				=> esc_html__( 'Submenu Style', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Select the collapsed submenu reveal style.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'configuration',
				'show_if'			=> array(
					'collapse_submenus'	=> 'on',
				),
				'options' 			=> array(
					'expand'		=> esc_html__( 'Expand', 'dvmm-divi-mad-menu' ),		// dvmm_submenus--expand
					'slide_right'	=> esc_html__( 'Slide Right', 'dvmm-divi-mad-menu' ), 	// dvmm_submenus--slide_right
					'slide_left'	=> esc_html__( 'Slide Left', 'dvmm-divi-mad-menu' ), 	// dvmm_submenus--slide_left
				),
				'default'         	=> 'expand',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'menu',
			),
			'use_submenu_header_text' => array(
				'label'				=> esc_html__( 'Use Submenu Header Text', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Here you can enable the submenu header text.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'configuration',
				'show_if'			=> array(
					'collapse_submenus'	=> 'on',
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
				'toggle_slug'      	=> 'menu',
			),
			'submenu_header_text' 	=> array(
				'label'            	=> esc_html__( 'Submenu Header Text', 'dvmm-divi-mad-menu' ),
				'description'      	=> esc_html__( 'Add the submenu header text.', 'dvmm-divi-mad-menu' ),
				'type'             	=> 'text',
				'option_category'  	=> 'basic_option',
				'show_if'			=> array(
					'collapse_submenus' 		=> 'on',
					'use_submenu_header_text'	=> 'custom',
				),
				'show_if_not'		=> array(
					'submenu_style'	=> 'expand',
				),
				'default'       	=> esc_html__( 'Back', 'dvmm-divi-mad-menu' ),
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'menu',
			),
			'parent_links' => array(
				'label'           	=> esc_html__( 'Parent Links Clickable', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Make the parent item links clickable', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'yes_no_button',
				'option_category' 	=> 'configuration',
				'show_if'			=> array(
					'collapse_submenus' 		=> 'on',
				),
				'options'         	=> array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'off',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'menu',
			),
			'accordion_mode' => array(
				'label'           	=> esc_html__( 'Accordion Mode', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Allow only one open submenu at a time. If enabled, expanding a submenu will collapse all other opened submenus of the same level.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'yes_no_button',
				'option_category' 	=> 'configuration',
				'show_if'			=> array(
					'collapse_submenus'	=> 'on',
					'submenu_style'		=> 'expand',
				),
				'options'         	=> array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'off',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'menu',
			),
			'parent_icon' => array(
				'label'             => esc_html__( 'Parent Item Icon', 'chiac-divi-accordions' ),
				'description'       => esc_html__( 'Select the parent menu item icon.', 'chiac-divi-accordions' ),
				'type'              => 'select_icon',                
				'mobile_options'    => true,
				// 'default'           => '&#x33;||divi||400',
				'default'           => '',
				'show_if'           => array(
					'collapse_submenus'	=> 'on',
				),
				'tab_slug'          => 'general',
				'toggle_slug'       => 'menu',
			),
			'animate_icon' => array(
				'label'				=> esc_html__( 'Animate Parent Item Icon', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Keep the parent item icon static, rotate or flip it when opening/closing the submenu.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'configuration',
				'show_if'			=> array(
					'collapse_submenus'	=> 'on',
					'submenu_style'		=> 'expand',
				),
				'options' 			=> array(
					'off'		=> esc_html__( 'No', 'dvmm-divi-mad-menu' ),		// dvmm_animate_icon--off
					'rotate'	=> esc_html__( 'Rotate', 'dvmm-divi-mad-menu' ), 	// dvmm_animate_icon--rotate
					'flipX'		=> esc_html__( 'Flip-X', 'dvmm-divi-mad-menu' ),	// dvmm_animate_icon--flipX
					'flipY'		=> esc_html__( 'Flip-Y', 'dvmm-divi-mad-menu' ),	// dvmm_animate_icon--flipY
				),
				'default'         	=> 'off',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'menu',
			),
			'sub_header_icon_home' => array(
				'label'             => esc_html__( 'Submenu Header "Home" Icon', 'chiac-divi-accordions' ),
				'description'       => esc_html__( 'Select the slide submenu header "Home" icon.', 'chiac-divi-accordions' ),
				'type'              => 'select_icon',                
				'mobile_options'    => true,
				'default'           => '',
				'show_if'           => array(
					'collapse_submenus'	=> 'on',
				),
				'show_if_not'		=> array(
					'submenu_style' => 'expand',
				),
				'tab_slug'          => 'general',
				'toggle_slug'       => 'menu',
			),
			'sub_header_icon_back' => array(
				'label'             => esc_html__( 'Submenu Header "Back" Icon', 'chiac-divi-accordions' ),
				'description'       => esc_html__( 'Select the slide submenu header "Back" icon.', 'chiac-divi-accordions' ),
				'type'              => 'select_icon',                
				'mobile_options'    => true,
				'default'           => '',
				'show_if'           => array(
					'collapse_submenus'	=> 'on',
				),
				'show_if_not'		=> array(
					'submenu_style'	=> 'expand',
				),
				'tab_slug'          => 'general',
				'toggle_slug'       => 'menu',
			),
			// Menu items text color (replaces the ['fonts']['menu_item']['text_color'] advanced field setting)
			'menu_item_text_color' => array(
				'label'           	=> esc_html__( 'Menu Items Text Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the menu items text color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'menu_text',
			),
			'link_color_active' => array(
				'label'           	=> esc_html__( 'Active Link Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the active link color. An active link is the page currently being visited. You can pick a color to be applied to active links to differentiate them from other links. The color will be applied to the active link\'s parent and ancestor links as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'menu_text',
			),
			// Submenu items text color (replaces the ['fonts']['submenu_item']['text_color'] advanced field setting)
			'submenu_item_text_color' => array(
				'label'           	=> esc_html__( 'Submenu Items Text Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the submenu items text color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'submenu_text',
			),
			'sub_link_color_active' => array(
				'label'           	=> esc_html__( 'Submenu Active Link Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the submenu active link color. An active link is the page currently being visited. You can pick a color to be applied to active links to differentiate them from other links. The color will be applied to the active link\'s parent and ancestor links as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'submenu_text',
			),
			'parent_color' => array(
				'label'           	=> esc_html__( 'Parent Link Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the parent menu item link color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'parent_items_design',
			),
			'parent_color_open' => array(
				'label'           	=> esc_html__( 'Parent Link Color (Open)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the color that will be applied to the parent item link when the submenu is open.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'show_if'     		=> array(
					'collapse_submenus'	=> 'on',
					'submenu_style'		=> 'expand',
				),
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'parent_items_design',
			),
			'sub_parent_color' => array(
				'label'           	=> esc_html__( 'Submenu Parent Link Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the submenu parent menu item link color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'sub_parent_items_design',
			),
			'sub_parent_color_open' => array(
				'label'           	=> esc_html__( 'Submenu Parent Link Color (Open)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the color that will be applied to the submenu parent item link when the submenu is open.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'show_if'     		=> array(
					'collapse_submenus'	=> 'on',
					'submenu_style'		=> 'expand',
				),
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'sub_parent_items_design',
			),
			'sub_bg_color' => array(
				'label'           	=> esc_html__( 'Submenu Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the submenus background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'submenu_design',
			),
			'item_bg_color' => array(
				'label'           	=> esc_html__( 'Item Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the menu items background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'items_design',
			),
			'sub_item_bg_color' => array(
				'label'           	=> esc_html__( 'Submenu Item Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the submenu items background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'sub_items_design',
			),
			'parent_bg_color' => array(
				'label'           	=> esc_html__( 'Parent Item Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the parent item background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'parent_items_design',
			),
			'sub_parent_bg_color' => array(
				'label'           	=> esc_html__( 'Submenu Parent Item Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the submenu parent item background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'sub_parent_items_design',
			),
			'parent_bg_color_open' => array(
				'label'           	=> esc_html__( 'Parent Item Background Color (Open)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the color that will be applied to the parent item background when the submenu is open.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'show_if'     		=> array(
					'collapse_submenus'	=> 'on',
					'submenu_style'		=> 'expand',
				),
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'parent_items_design',
			),
			'sub_parent_bg_color_open' => array(
				'label'           	=> esc_html__( 'Submenu Parent Item Background Color (Open)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the color that will be applied to the submenu parent item background when the submenu is open.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'show_if'     		=> array(
					'collapse_submenus'	=> 'on',
					'submenu_style'		=> 'expand',
				),
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'sub_parent_items_design',
			),
			'item_bg_color_active' => array(
				'label'           	=> esc_html__( 'Active Item Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the active menu item background color. An active item/link is the page currently being visited. You can pick a color to be applied to active items background to differentiate them from other items. The background color will be applied to the active item\'s parent and ancestor items as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'items_design',
			),
			'sub_item_bg_color_active' => array(
				'label'           	=> esc_html__( 'Submenu Active Item Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the submenu active item background color. An active item/link is the page currently being visited. You can pick a color to be applied to active items background to differentiate them from other items. The background color will be applied to the active item\'s parent and ancestor items as well.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'sub_items_design',
			),
			'parent_icon_color' => array(
				'label'           	=> esc_html__( 'Parent Icon Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the parent item icon color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'show_if'           => array(
					'collapse_submenus'	=> 'on',
				),
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'parent_items_design',
			),
			'parent_icon_color_open' => array(
				'label'           	=> esc_html__( 'Parent Icon Color (Open)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the color that will be applied to the parent item icon when the submenu is open.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'show_if'     		=> array(
					'collapse_submenus'	=> 'on',
					'submenu_style'		=> 'expand',
				),
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'parent_items_design',
			),
			'sub_parent_icon_color' => array(
				'label'           	=> esc_html__( 'Submenu Parent Icon Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the submenu parent item icon color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'show_if'           => array(
					'collapse_submenus'	=> 'on',
				),
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'sub_parent_items_design',
			),
			'sub_parent_icon_color_open' => array(
				'label'           	=> esc_html__( 'Submenu Parent Icon Color (Open)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the color that will be applied to the submenu parent item icon when the submenu is open.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'show_if'     		=> array(
					'collapse_submenus'	=> 'on',
					'submenu_style'		=> 'expand',
				),
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'sub_parent_items_design',
			),
			'parent_icon_bg_color' => array(
				'label'           	=> esc_html__( 'Parent Icon Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the parent item icon background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'show_if'           => array(
					'collapse_submenus'	=> 'on',
				),
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'parent_items_design',
			),
			'parent_icon_bg_color_open' => array(
				'label'           	=> esc_html__( 'Parent Icon Background Color (Open)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the color that will be applied to the parent item icon background when the submenu is open.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'show_if'     		=> array(
					'collapse_submenus'	=> 'on',
					'submenu_style'		=> 'expand',
				),
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'parent_items_design',
			),
			'sub_parent_icon_bg_color' => array(
				'label'           	=> esc_html__( 'Submenu Parent Icon Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the submenu parent item icon background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'show_if'           => array(
					'collapse_submenus'	=> 'on',
				),
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'sub_parent_items_design',
			),
			'sub_parent_icon_bg_color_open' => array(
				'label'           	=> esc_html__( 'Submenu Parent Icon Background Color (Open)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the color that will be applied to the submenu parent item icon background when the submenu is open.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'mobile_options'	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'sticky'		    => true,
				'custom_color'    	=> true,
				'default'         	=> '',
				'show_if'     		=> array(
					'collapse_submenus'	=> 'on',
					'submenu_style'		=> 'expand',
				),
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'sub_parent_items_design',
			),
			'parent_icon_size' => array(
				'label'             => esc_html__( 'Parent Icon Size', 'chiac-divi-accordions' ),
				'description'       => esc_html__( 'Set the parent item icon size.', 'chiac-divi-accordions' ),
				'type'              => 'range',
				'option_category'	=> 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'             => 'tabs',
				'sticky'		    => true,
				'allowed_units'     => array( 'px' ),
				'default_unit'      => 'px',
				'default'           => '16px',
				// 'default_on_front'  => '',
				'range_settings'    => array(
					'min'   => '0',
					'max'   => '100',
					'step'  => '1',
				),
				'show_if'           => array(
					'collapse_submenus'	=> 'on',
				),
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'parent_items_design',
			),
			'sub_parent_icon_size' => array(
				'label'             => esc_html__( 'Submenu Parent Icon Size', 'chiac-divi-accordions' ),
				'description'       => esc_html__( 'Set the submenu parent item icon size.', 'chiac-divi-accordions' ),
				'type'              => 'range',
				'option_category'	=> 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'             => 'tabs',
				'sticky'		    => true,
				'allowed_units'     => array( 'px' ),
				'default_unit'      => 'px',
				'default'           => '',
				'range_settings'    => array(
					'min'   => '0',
					'max'   => '100',
					'step'  => '1',
				),
				'show_if'           => array(
					'collapse_submenus'	=> 'on',
				),
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'sub_parent_items_design',
			),
			'item_padding' => array(
				'label'             => esc_html__( 'Item Padding', 'chiac-divi-accordions' ),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'chiac-divi-accordions' ),
				'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'			  	=> 'tabs',
				'sticky'			=> true,
				'default'           => '10px|20px|10px|20px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'items_design',
			),
			'item_margin' => array(
				'label'             => esc_html__( 'Item Margin', 'chiac-divi-accordions' ),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'chiac-divi-accordions' ),
				'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'			  	=> 'tabs',
				'sticky'			=> true,
				'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'items_design',
			),
			'sub_item_padding' => array(
				'label'             => esc_html__( 'Submenu Item Padding', 'chiac-divi-accordions' ),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'chiac-divi-accordions' ),
				'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'			  	=> 'tabs',
				'sticky'			=> true,
				// 'default'           => '10px|20px|10px|20px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'sub_items_design',
			),
			'sub_item_margin' => array(
				'label'             => esc_html__( 'Submenu Item Margin', 'chiac-divi-accordions' ),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'chiac-divi-accordions' ),
				'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'			  	=> 'tabs',
				'sticky'			=> true,
				// 'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'sub_items_design',
			),
			'sub_padding' => array(
				'label'             => esc_html__( 'Submenu Padding', 'chiac-divi-accordions' ),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'chiac-divi-accordions' ),
				'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'			  	=> 'tabs',
				'sticky'			=> true,
				'show_if'         	=> array(
					'submenu_style'	=> 'expand',
				),
				'default'           => '0px|0px|0px|10px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'submenu_design',
			),
			'sub_margin' => array(
				'label'             => esc_html__( 'Submenu Margin', 'chiac-divi-accordions' ),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'chiac-divi-accordions' ),
				'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'			  	=> 'tabs',
				'sticky'			=> true,
				'show_if'         	=> array(
					'submenu_style'	=> 'expand',
				),
				'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'submenu_design',
			),
		);

		return $fields;
	}

	// Advanced fields
	public function get_advanced_fields_config() {

		// selectors
		$dvmmv_inner	= "{$this->main_css_element} .dvmmv_inner";
		$dvmm_menu		= "{$dvmmv_inner} .dvmm_menu"; // menu <ul> tag

		// advanced fields
		$advanced_fields = array(
			'margin_padding'	=> array(
				'css' => array(
					'margin'    => $this->main_css_element,
					'padding'   => "{$this->main_css_element} .dvmmv_wrapper",
					'important' => 'all',
				),
			),
			'background'	=> array(
				'css' => array(
					'main' => $this->main_css_element,
					'important' => false,
				),
			),
			'text'    		=> false,
			'text_shadow'	=> false,
			'fonts'	=> array(
				'menu_item' => array(
					'label'           => esc_html__( 'Menu Items', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$dvmmv_inner} li.menu-item a, {$dvmmv_inner} .dvmm_back_text",
						'limited_main' 	=> "{$dvmmv_inner} li.menu-item a, {$dvmmv_inner} .dvmm_back_text",
						'hover'        	=> "{$dvmmv_inner} li.menu-item > a:hover, {$dvmmv_inner} .dvmm_submenu_header > a:hover .dvmm_back_text",
						'font_size'		=> "{$dvmmv_inner} li.menu-item a, {$dvmmv_inner} .dvmm_back_text",
						'text_align'	=> "{$dvmmv_inner} li.menu-item a, {$dvmmv_inner} .dvmm_back_text",
						'line_height'	=> "{$dvmmv_inner} li.menu-item a, {$dvmmv_inner} .dvmm_back_text",
					),
					'hide_text_color'	=> true,	// replaced by a normal field due to '!important' being added by default, @see 'menu_item_text_color' field
					'line_height'     	=> array(
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
					'hide_text_shadow' 	=> true,
					'tab_slug'    		=> 'advanced',
					'toggle_slug' 		=> 'menu_text',
				),
				'submenu_item' => array(
					'label'           => esc_html__( 'Submenu Items', 'dvmm-divi-mad-menu' ),
					'css'             => array(
						'main'         	=> "{$dvmmv_inner} li li.menu-item > a",
						'limited_main' 	=> "{$dvmmv_inner} li li.menu-item > a",
						'hover'        	=> "{$dvmmv_inner} li li.menu-item > a:hover",
						'font_size'		=> "{$dvmmv_inner} li li.menu-item > a",
						'text_align'	=> "{$dvmmv_inner} li li.menu-item > a",
					),
					'hide_text_color'	=> true,	// replaced by a normal field due to '!important' being added by default, @see 'submenu_item_text_color' field
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
					'toggle_slug' => 'submenu_text',
				),
			), // END FONT FIELDS
			'height'	=> array(
				'css' => array(
					'main' => "{$this->main_css_element} .dvmmv_wrapper",
				),
				'options' => array(
					'min_height'     	=> array(
						'label'			=> esc_html__( 'Min Height', 'dvmm-divi-mad-menu' ),
						'tab_slug'		=> 'advanced',
						'toggle_slug'	=> 'width',
					),
					'height' => array(
						'label'			=> esc_html__( 'Height', 'dvmm-divi-mad-menu' ),
						'tab_slug'		=> 'advanced',
						'toggle_slug'	=> 'width',
					),
					'max_height' => array(
						'label'			=> esc_html__( 'Max Height', 'dvmm-divi-mad-menu' ),
						'tab_slug'		=> 'advanced',
						'toggle_slug'	=> 'width',
					),
				),
			), // END HEIGHT FIELDS
			'borders'	=> array(
				'default' => array(
					'label_prefix'		=> esc_html__( 'Main', 'dvmm-divi-mad-menu' ),
					'css'             	=> array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element}",
							'border_styles' => "{$this->main_css_element}",
						),
						'important' => 'plugin_only',
					),
					'defaults'        => array(
						'border_radii'  => 'on||||',
						'border_styles' => array(
							'width' => '1px',
							'color' => '#eaeaea',
							'style' => 'solid',
						),
					),
					'tab_slug'		=> 'advanced',
					'toggle_slug'	=> 'borders',
				),
				'menu_item'   => array(
					'label_prefix' => esc_html__( 'Menu Item', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$dvmmv_inner} li.menu-item > a, {$dvmmv_inner} .dvmm_submenu_header",
							'border_styles' => "{$dvmmv_inner} li.menu-item > a, {$dvmmv_inner} .dvmm_submenu_header",
						),
						'hover' => "{$dvmmv_inner} li.menu-item > a:hover, {$dvmmv_inner} .dvmm_submenu_header:hover",
						'important' => 'plugin_only',
					),
					'defaults' => array(
						'border_radii' => 'on||||',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'items_design',
				),
				'submenu'   => array(
					'label_prefix' => esc_html__( 'Submenu', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$dvmm_menu} li ul",
							'border_styles' => "{$dvmm_menu} li ul",
						),
						'hover' => "{$dvmm_menu} li ul:hover",
						'important' => 'plugin_only',
					),
					'defaults' => array(
						'border_radii' => 'on||||',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'submenu_design',
				),
				'submenu_item'   => array(
					'label_prefix' => esc_html__( 'Submenu Item', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$dvmmv_inner} li li.menu-item > a",
							'border_styles' => "{$dvmmv_inner} li li.menu-item > a",
						),
						'hover' => "{$dvmmv_inner} li li.menu-item > a:hover",
						'important' => 'plugin_only',
					),
					'defaults' => array(
						'border_radii' => 'on||||',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'sub_items_design',
				),
			), // END BORDER FIELDS
			'box_shadow'	=> array(
				'default' => array(
					'label' => esc_html__( 'Box Shadow', 'dvmm-divi-mad-menu' ),
					'css' 	=> array(
						'main'    => "{$this->main_css_element}",
						// 'overlay' => 'inset', 
						'important' => 'plugin_only',
					),
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'box_shadow',
				),
				'menu_item' => array(
					'label' => esc_html__( 'Menu Item Box Shadow', 'dvmm-divi-mad-menu' ),
					'css' 	=> array(
						'main'    => "{$dvmmv_inner} li.menu-item > a, {$dvmmv_inner} .dvmm_submenu_header",
						'important' => 'plugin_only',
					),
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'items_design',
				),
				'submenu' => array(
					'label' 		=> esc_html__( 'Submenu Box Shadow', 'dvmm-divi-mad-menu' ),
					'css' 			=> array(
						'main'    		=> "{$dvmm_menu} li ul",
						'important'		=> 'plugin_only',
					),
					'tab_slug'		=> 'advanced',
					'toggle_slug'	=> 'submenu_design',
				),
				'submenu_item' => array(
					'label' => esc_html__( 'Submenu Item Box Shadow', 'dvmm-divi-mad-menu' ),
					'css' 	=> array(
						'main'    => "{$dvmmv_inner} li li.menu-item > a",
						'important' => 'plugin_only',
					),
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'sub_items_design',
				),
			), // END BOX-SHADOW FIELDS
		);

		return $advanced_fields;
	}

	/**
	 * Module's custom CSS fields configuration
	 *
	 * @since v1.9.0
	 *
	 * @return array
	 */
    public function get_custom_css_fields_config() {

		// selectors
		$dvmmv_inner	= "{$this->main_css_element} .dvmmv_inner";
		$dvmm_menu		= "{$dvmmv_inner} .dvmm_menu"; // menu <ul> tag

		$custom_css_fields = array(
			'parent_css' => array(
				'label'    	=> esc_html__( 'Parent Item', 'dvmm-divi-mad-menu' ),
				'selector' 	=> "{$dvmmv_inner} li.menu-item-has-children > a",
			),
			'parent_css_open' => array(
				'label'    	=> esc_html__( 'Parent Item (Open)', 'dvmm-divi-mad-menu' ),
				'selector' 	=> "{$dvmmv_inner} li.menu-item-has-children > a.visible",
				'show_if'	=> array(
					'collapse_submenus' => 'on',
					'submenu_style'		=> 'expand',
				),
			),
			'parent_icon_css' => array(
				'label'    	=> esc_html__( 'Parent Icon', 'dvmm-divi-mad-menu' ),
				'selector' 	=> "{$dvmmv_inner} .dvmm_submenu_toggle",
			),
			'parent_icon_css_open' => array(
				'label'    	=> esc_html__( 'Parent Icon (Open)', 'dvmm-divi-mad-menu' ),
				'selector' 	=> "{$dvmmv_inner} a.visible > .dvmm_submenu_toggle",
				'show_if'	=> array(
					'collapse_submenus' => 'on',
					'submenu_style'		=> 'expand',
				),
			),
			'sub_parent_css' => array(
				'label'    	=> esc_html__( 'Submenu Parent Item', 'dvmm-divi-mad-menu' ),
				'selector' 	=> "{$dvmmv_inner} li li.menu-item-has-children > a",
			),
			'sub_parent_css_open' => array(
				'label'    	=> esc_html__( 'Submenu Parent Item (Open)', 'dvmm-divi-mad-menu' ),
				'selector' 	=> "{$dvmmv_inner} li li.menu-item-has-children > a.visible",
				'show_if'	=> array(
					'collapse_submenus' => 'on',
					'submenu_style'		=> 'expand',
				),
			),
			'sub_parent_icon_css' => array(
				'label'    	=> esc_html__( 'Submenu Parent Icon', 'dvmm-divi-mad-menu' ),
				'selector' 	=> "{$dvmmv_inner} li li .dvmm_submenu_toggle",
			),
			'sub_parent_icon_css_open' => array(
				'label'    	=> esc_html__( 'Submenu Parent Icon (Open)', 'dvmm-divi-mad-menu' ),
				'selector' 	=> "{$dvmmv_inner} li li a.visible > .dvmm_submenu_toggle",
				'show_if'	=> array(
					'collapse_submenus' => 'on',
					'submenu_style'		=> 'expand',
				),
			),
			'slide_sub_header_css' => array(
				'label'    => esc_html__( 'Submenu Header', 'dvmm-divi-mad-menu' ),
				'selector' => "{$dvmmv_inner} .dvmm_submenu_header",
				'show_if'		=> array(
					'collapse_submenus' => 'on',
				),
				'show_if_not'	=> array(
					'submenu_style'	=> 'expand',
				),
			),
			'slide_sub_header_text_css' => array(
				'label'    => esc_html__( 'Submenu Header Text', 'dvmm-divi-mad-menu' ),
				'selector' => "{$dvmmv_inner} .dvmm_back_text",
				'show_if'		=> array(
					'collapse_submenus' => 'on',
				),
				'show_if_not'	=> array(
					'submenu_style'				=> 'expand',
					'use_submenu_header_text'	=> 'none',
				),
			),
			'slide_sub_header_back_css' => array(
				'label'    => esc_html__( 'Submenu Header "Back" Button', 'dvmm-divi-mad-menu' ),
				'selector' => "{$dvmmv_inner} .dvmm_back",
				'show_if'		=> array(
					'collapse_submenus' => 'on',
				),
				'show_if_not'	=> array(
					'submenu_style' => 'expand',
				),
			),
			'slide_sub_header_back_home_css' => array(
				'label'    => esc_html__( 'Submenu Header "Home" Button', 'dvmm-divi-mad-menu' ),
				'selector' => "{$dvmmv_inner} .dvmm_back_home",
				'show_if'		=> array(
					'collapse_submenus' => 'on',
				),
				'show_if_not'	=> array(
					'submenu_style' => 'expand',
				),
			),
		);

		return $custom_css_fields;
    }

	/**
	 * Miscellaneous CSS styles.
	 * 
	 * @since	v1.9.0
	 * 
	 * @param	object	$module				Module object.
	 * @param	string	$render_slug		Module slug.
	 * @param	string	$processed_props	Processed props.
	 */
	public static function miscCss( $module, $render_slug, $processed_props ){

		// Props
		$module_order_class = isset($processed_props['module_order_class']) ? $processed_props['module_order_class'] : '';

		// Selectors
		$dvmmv_inner = "{$module->main_css_element} .dvmmv_inner";

		/**
		 * Main Transitions.
		 * For some reason not all CSS properties are included into the 'transition' rule (like 'padding'),
		 * so, the code below is intended to fix this issue.
		 * The "dvmm_transitions--on" class is added to the module main container using JS.
		 */
		$module->helpers()->declare_responsive_transition_styles($module, $render_slug, array(
			'properties' 	 => array('all'),
			'selector'		 => "{$module->main_css_element}.dvmm_transitions--on, 
									{$module->main_css_element}.dvmm_transitions--on .dvmmv_inner, 
									{$module->main_css_element}.dvmm_transitions--on .dvmmv_inner .dvmm_menu li,
									{$module->main_css_element}.dvmm_transitions--on .dvmmv_inner .dvmm_menu li a",	
			'additional_css' => 'important',
		));
	}

	/**
	 * CSS styles.
	 * 
	 * @since	v1.9.0
	 * 
	 * @param	object	$module			Module object.
	 * @param	string	$render_slug	Module slug.
	 */
	public static function css( $module, $render_slug ){

		// CSS selectors
		$dvmmv_inner	= "{$module->main_css_element} .dvmmv_inner";
		$dvmm_menu		= "{$dvmmv_inner} .dvmm_menu"; // menu <ul> tag

		// active/current item
		$current_item_ancestor 	= "{$dvmm_menu} li.current-menu-ancestor";
		$current_item_parent 	= "{$dvmm_menu} li.current-menu-parent";
		$current_item 			= "{$dvmm_menu} li.current-menu-item";

		// active/current submenu item
		$current_sub_item_ancestor 	= "{$dvmm_menu} li li.current-menu-ancestor";
		$current_sub_item_parent 	= "{$dvmm_menu} li li.current-menu-parent";
		$current_sub_item 			= "{$dvmm_menu} li li.current-menu-item";

		// Align parent item icon
		$module->helpers()->mobile_parent_arrow_alignment( 
			$module->props, 
			'menu_text_align', // $advanced_fields['fonts']['menu']
			"{$dvmm_menu} .dvmm_submenu_toggle",
			$render_slug
		);
		// Align submenu parent item icon
		$module->helpers()->mobile_parent_arrow_alignment( 
			$module->props, 
			'submenu_text_align', // $advanced_fields['fonts']['submenu']
			"{$dvmm_menu} li li .dvmm_submenu_toggle",
			$render_slug
		);

		// Submenu background color
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'sub_bg_color',
				'selector'       => "{$dvmm_menu} li ul",
				'hover_selector' => "{$dvmm_menu} li ul:hover",
				'type'           => 'color',
				'css_property'   => 'background-color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// Menu Item background color
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'item_bg_color',
				'selector'       => "{$dvmmv_inner} li.menu-item > a, {$dvmmv_inner} .dvmm_submenu_header",
				'hover_selector' => "{$dvmmv_inner} li.menu-item > a:hover, {$dvmmv_inner} .dvmm_submenu_header:hover",
				'type'           => 'color',
				'css_property'   => 'background-color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// Submenu Item background color
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'sub_item_bg_color',
				'selector'       => "{$dvmmv_inner} li li.menu-item > a",
				'hover_selector' => "{$dvmmv_inner} li li.menu-item > a:hover",
				'type'           => 'color',
				'css_property'   => 'background-color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// Parent Item background color
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'parent_bg_color',
				'selector'       => "{$dvmmv_inner} li.menu-item-has-children > a, {$dvmmv_inner} .menu-item-has-children .dvmm_submenu_header",
				'hover_selector' => "{$dvmmv_inner} li.menu-item-has-children > a:hover, {$dvmmv_inner} .menu-item-has-children .dvmm_submenu_header:hover",
				'type'           => 'color',
				'css_property'   => 'background-color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// Submenu parent item background color
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'sub_parent_bg_color',
				'selector'       => "{$dvmmv_inner} li li.menu-item-has-children > a",
				'hover_selector' => "{$dvmmv_inner} li li.menu-item-has-children > a:hover",
				'type'           => 'color',
				'css_property'   => 'background-color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// Parent item icon color
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'parent_icon_color',
				'selector'       => "{$dvmmv_inner} .dvmm_submenu_toggle, {$dvmmv_inner} .dvmm_go_back",
				'hover_selector' => "{$dvmmv_inner} a:hover > .dvmm_submenu_toggle, {$dvmm_menu} .dvmm_submenu_header a:hover button.dvmm_back, {$dvmm_menu} .dvmm_submenu_header button.dvmm_back_home:hover",
				'type'           => 'color',
				'css_property'   => 'color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// Submenu parent item icon color
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'sub_parent_icon_color',
				'selector'       => "{$dvmmv_inner} li li .dvmm_submenu_toggle",
				'hover_selector' => "{$dvmmv_inner} li li a:hover > .dvmm_submenu_toggle",
				'type'           => 'color',
				'css_property'   => 'color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// Parent item icon background color
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'parent_icon_bg_color',
				'selector'       => "{$dvmmv_inner} .dvmm_submenu_toggle, {$dvmmv_inner} .dvmm_go_back",
				'hover_selector' => "{$dvmmv_inner} a:hover > .dvmm_submenu_toggle, {$dvmmv_inner} a:hover .dvmm_back, {$dvmmv_inner} .dvmm_back_home:hover",
				'type'           => 'color',
				'css_property'   => 'background-color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// Submenu parent item icon background color
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'sub_parent_icon_bg_color',
				'selector'       => "{$dvmmv_inner} li li .dvmm_submenu_toggle",
				'hover_selector' => "{$dvmmv_inner} li li a:hover > .dvmm_submenu_toggle",
				'type'           => 'color',
				'css_property'   => 'background-color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// Parent item icon size
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'parent_icon_size',
				'selector'       => "{$dvmmv_inner} .dvmm_submenu_toggle, {$dvmmv_inner} .dvmm_go_back",
				'hover_selector' => "{$dvmmv_inner} a:hover > .dvmm_submenu_toggle, {$dvmmv_inner} a:hover .dvmm_back, {$dvmmv_inner} .dvmm_back_home:hover",
				'type'       	 => 'range',
				'css_property'	 => 'font-size',
				'render_slug'	 => $render_slug,
				'important'      => array('hover')
			)
		);

		// Submenu parent item icon size
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'sub_parent_icon_size',
				'selector'       => "{$dvmmv_inner} li li .dvmm_submenu_toggle",
				'hover_selector' => "{$dvmmv_inner} li li a:hover > .dvmm_submenu_toggle",
				'type'       	 => 'range',
				'css_property'	 => 'font-size',
				'render_slug'	 => $render_slug,
				'important'      => array('hover')
			)
		);

		// Active Item background color
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'item_bg_color_active',
				'selector'       => "{$current_item_ancestor} > a, {$current_item_parent} > a, {$current_item} > a",
				'hover_selector' => "{$current_item_ancestor} > a:hover, {$current_item_parent} > a:hover, {$current_item} > a:hover",
				'type'           => 'color',
				'css_property'   => 'background-color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// Submenu Active Item background color
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'sub_item_bg_color_active',
				'selector'       => "{$current_sub_item_ancestor} > a, {$current_sub_item_parent} > a, {$current_sub_item} > a",
				'hover_selector' => "{$current_sub_item_ancestor} > a:hover, {$current_sub_item_parent} > a:hover, {$current_sub_item} > a:hover",
				'type'           => 'color',
				'css_property'   => 'background-color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// Parent item icon
		$module->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family_and_content',
				'render_slug'    => $render_slug,
				'base_attr_name' => "parent_icon",
				'selector'       => "{$dvmm_menu} .dvmm_submenu_toggle:after",
				'important'      => true, // bool
				'processor'      => $module->helpers()->is_divi_older_than("4.13.0") ? array() : array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);

		// Submenu header "Home" icon
		$module->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family_and_content',
				'render_slug'    => $render_slug,
				'base_attr_name' => "sub_header_icon_home",
				'selector'       => "{$dvmmv_inner}.dvmm_submenus--slide_right .dvmm_back_home:after, {$dvmmv_inner}.dvmm_submenus--slide_left .dvmm_back_home:after",
				'important'      => true, // bool
				'processor'      => $module->helpers()->is_divi_older_than("4.13.0") ? array() : array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);

		// Submenu header "Back" icon
		$module->generate_styles(
			array(
				'utility_arg'    => 'icon_font_family_and_content',
				'render_slug'    => $render_slug,
				'base_attr_name' => "sub_header_icon_back",
				'selector'       => "{$dvmmv_inner}.dvmm_submenus--slide_right .dvmm_back:after, {$dvmmv_inner}.dvmm_submenus--slide_left .dvmm_back:after",
				'important'      => true, // bool
				'processor'      => $module->helpers()->is_divi_older_than("4.13.0") ? array() : array(
					'ET_Builder_Module_Helper_Style_Processor',
					'process_extended_icon',
				),
			)
		);

		// Menu items text color (replaces the ['fonts']['menu_item']['text_color'] advanced field setting CSS)
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'menu_item_text_color',
				'selector'       => "{$dvmmv_inner} li.menu-item > a, {$dvmmv_inner} .dvmm_submenu_header",
				'hover_selector' => "{$dvmmv_inner} li.menu-item > a:hover, {$dvmmv_inner} .dvmm_submenu_header a:hover, {$dvmmv_inner} .dvmm_submenu_header a:hover .dvmm_back, {$dvmmv_inner} .dvmm_submenu_header .dvmm_back_home:hover",
				'type'           => 'color',
				'css_property'   => 'color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// Active link color
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'link_color_active',
				'selector'       => "{$current_item_ancestor} > a, {$current_item_parent} > a, {$current_item} > a",
				'hover_selector' => "{$current_item_ancestor} > a:hover, {$current_item_parent} > a:hover, {$current_item} > a:hover",
				'type'           => 'color',
				'css_property'   => 'color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// Submenu items text color (replaces the ['fonts']['submenu_item']['text_color'] advanced field setting CSS)
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'submenu_item_text_color',
				'selector'       => "{$dvmmv_inner} li li.menu-item > a",
				'hover_selector' => "{$dvmmv_inner} li li.menu-item > a:hover",
				'type'           => 'color',
				'css_property'   => 'color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// Submenu active link color
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'sub_link_color_active',
				'selector'       => "{$current_sub_item_ancestor} > a, {$current_sub_item_parent} > a, {$current_sub_item} > a",
				'hover_selector' => "{$current_sub_item_ancestor} > a:hover, {$current_sub_item_parent} > a:hover, {$current_sub_item} > a:hover",
				'type'           => 'color',
				'css_property'   => 'color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// Parent link color
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'parent_color',
				'selector'       => "{$dvmmv_inner} li.menu-item-has-children > a, {$dvmmv_inner} .menu-item-has-children .dvmm_submenu_header",
				'hover_selector' => "{$dvmmv_inner} li.menu-item-has-children > a:hover, {$dvmmv_inner} .menu-item-has-children .dvmm_submenu_header a:hover, {$dvmmv_inner} .menu-item-has-children .dvmm_submenu_header a:hover .dvmm_back, {$dvmmv_inner} .menu-item-has-children .dvmm_submenu_header .dvmm_back_home:hover",
				'type'           => 'color',
				'css_property'   => 'color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// Submenu parent link color
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'sub_parent_color',
				'selector'       => "{$dvmmv_inner} li li.menu-item-has-children > a",
				'hover_selector' => "{$dvmmv_inner} li li.menu-item-has-children > a:hover",
				'type'           => 'color',
				'css_property'   => 'color',
				'render_slug'    => $render_slug,
				'important'      => array('hover')
			)
		);

		// generate this for "Expand" submenus only
		if($module->props['submenu_style'] === 'expand'){

			// Parent link color (Open)
			$module->helpers()->generate_styles( $module,
				array(
					'base_attr_name' => 'parent_color_open',
					'selector'       => "{$dvmmv_inner} li.menu-item-has-children > a.visible",
					'hover_selector' => "{$dvmmv_inner} li.menu-item-has-children > a.visible:hover",
					'type'           => 'color',
					'css_property'   => 'color',
					'render_slug'    => $render_slug,
					'important'      => array('hover')
				)
			);

			// Submenu parent link color (Open)
			$module->helpers()->generate_styles( $module,
				array(
					'base_attr_name' => 'sub_parent_color_open',
					'selector'       => "{$dvmmv_inner} li li.menu-item-has-children > a.visible",
					'hover_selector' => "{$dvmmv_inner} li li.menu-item-has-children > a.visible:hover",
					'type'           => 'color',
					'css_property'   => 'color',
					'render_slug'    => $render_slug,
					'important'      => array('hover')
				)
			);

			// Parent Item background color (Open)
			$module->helpers()->generate_styles( $module,
				array(
					'base_attr_name' => 'parent_bg_color_open',
					'selector'       => "{$dvmmv_inner} li.menu-item-has-children > a.visible",
					'hover_selector' => "{$dvmmv_inner} li.menu-item-has-children > a.visible:hover",
					'type'           => 'color',
					'css_property'   => 'background-color',
					'render_slug'    => $render_slug,
					'important'      => array('hover')
				)
			);

			// Submenu parent Item background color (Open)
			$module->helpers()->generate_styles( $module,
				array(
					'base_attr_name' => 'sub_parent_bg_color_open',
					'selector'       => "{$dvmmv_inner} li li.menu-item-has-children > a.visible",
					'hover_selector' => "{$dvmmv_inner} li li.menu-item-has-children > a.visible:hover",
					'type'           => 'color',
					'css_property'   => 'background-color',
					'render_slug'    => $render_slug,
					'important'      => array('hover')
				)
			);

			// Parent item icon color (Open)
			$module->helpers()->generate_styles( $module,
				array(
					'base_attr_name' => 'parent_icon_color_open',
					'selector'       => "{$dvmmv_inner} a.visible > .dvmm_submenu_toggle",
					'hover_selector' => "{$dvmmv_inner} a.visible:hover > .dvmm_submenu_toggle",
					'type'           => 'color',
					'css_property'   => 'color',
					'render_slug'    => $render_slug,
					'important'      => array('hover')
				)
			);

			// Submenu parent item icon color (Open)
			$module->helpers()->generate_styles( $module,
				array(
					'base_attr_name' => 'sub_parent_icon_color_open',
					'selector'       => "{$dvmmv_inner} li li a.visible > .dvmm_submenu_toggle",
					'hover_selector' => "{$dvmmv_inner} li li a.visible:hover > .dvmm_submenu_toggle",
					'type'           => 'color',
					'css_property'   => 'color',
					'render_slug'    => $render_slug,
					'important'      => array('hover')
				)
			);

			// Parent item icon background color (Open)
			$module->helpers()->generate_styles( $module,
				array(
					'base_attr_name' => 'parent_icon_bg_color_open',
					'selector'       => "{$dvmmv_inner} a.visible > .dvmm_submenu_toggle",
					'hover_selector' => "{$dvmmv_inner} a.visible:hover > .dvmm_submenu_toggle",
					'type'           => 'color',
					'css_property'   => 'background-color',
					'render_slug'    => $render_slug,
					'important'      => array('hover')
				)
			);

			// Submenu parent item icon background color (Open)
			$module->helpers()->generate_styles( $module,
				array(
					'base_attr_name' => 'sub_parent_icon_bg_color_open',
					'selector'       => "{$dvmmv_inner} li li a.visible > .dvmm_submenu_toggle",
					'hover_selector' => "{$dvmmv_inner} li li a.visible:hover > .dvmm_submenu_toggle",
					'type'           => 'color',
					'css_property'   => 'background-color',
					'render_slug'    => $render_slug,
					'important'      => array('hover')
				)
			);

			// Submenu padding
			$module->helpers()->generate_styles( $module,
				array(
					'base_attr_name' => 'sub_padding',
					'selector'		 => "{$dvmm_menu} li ul",
					'hover_selector' => "{$dvmm_menu} li ul:hover",
					'type'       	 => 'custom_padding',
					'css_property'	 => 'padding',
					'render_slug'	 => $render_slug,
					'important'      => array('hover'),
					'processor'		 => array(
						'DVMM_Module_Helper_Style_Processor',
						'process_margin_padding_styles',
					)
				)
			);
		}

		// Item padding
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'item_padding',
				'selector'		 => "{$dvmm_menu} li.menu-item > a",
				'hover_selector' => "{$dvmm_menu} li.menu-item > a:hover",
				'type'       	 => 'custom_padding',
				'css_property'	 => 'padding',
				'render_slug'	 => $render_slug,
				'important'      => array('hover'),
				'processor'		 => array(
					'DVMM_Module_Helper_Style_Processor',
					'process_margin_padding_styles',
				)
			)
		);

		// Submenu item padding
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'sub_item_padding',
				'selector'		 => "{$dvmm_menu} li li.menu-item > a",
				'hover_selector' => "{$dvmm_menu} li li.menu-item > a:hover",
				'type'       	 => 'custom_padding',
				'css_property'	 => 'padding',
				'render_slug'	 => $render_slug,
				'important'      => array('hover'),
				'processor'		 => array(
					'DVMM_Module_Helper_Style_Processor',
					'process_margin_padding_styles',
				)
			)
		);

		// Item margin
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'item_margin',
				'selector'		 => "{$dvmm_menu} li.menu-item",
				'hover_selector' => "{$dvmm_menu} li.menu-item:hover",
				'type'       	 => 'custom_margin',
				'css_property'	 => 'margin',
				'render_slug'	 => $render_slug,
				'important'      => array('hover'),
				'processor'		 => array(
					'DVMM_Module_Helper_Style_Processor',
					'process_margin_padding_styles',
				)
			)
		);

		// Submenu item margin
		$module->helpers()->generate_styles( $module,
			array(
				'base_attr_name' => 'sub_item_margin',
				'selector'		 => "{$dvmm_menu} li li.menu-item",
				'hover_selector' => "{$dvmm_menu} li li.menu-item:hover",
				'type'       	 => 'custom_margin',
				'css_property'	 => 'margin',
				'render_slug'	 => $render_slug,
				'important'      => array('hover'),
				'processor'		 => array(
					'DVMM_Module_Helper_Style_Processor',
					'process_margin_padding_styles',
				)
			)
		);

		// generate this for "Expand" submenus only
		if($module->props['submenu_style'] === 'expand'){
			// Submenu margin
			$module->helpers()->generate_styles( $module,
				array(
					'base_attr_name' => 'sub_margin',
					'selector'		 => "{$dvmm_menu} li ul",
					'hover_selector' => "{$dvmm_menu} li ul:hover",
					'type'       	 => 'custom_margin',
					'css_property'	 => 'margin',
					'render_slug'	 => $render_slug,
					'important'      => array('hover'),
					'processor'		 => array(
						'DVMM_Module_Helper_Style_Processor',
						'process_margin_padding_styles',
					)
				)
			);
		}
	}

	/**
     * Module Data.
     * 
     * The data that will be added to the inline JS script.
     * 
     * @since	v1.9.0
     * 
     * @param	object	$module				Module object.
     * @param	string	$processed_props	Processed props.
     * @param	string	$render_slug		Module slug.
     * @param	string	$element_name		Element name ('vertical_menu').
     * 
     * @return  string                      Element's data.
     */
    public static function inline_script_data( $module, $processed_props, $render_slug, $element_name ){

		$element_type 		= 'default'; // hardcoded till the "element_type" prop is introduced
		$collapse_submenus 	= $module->props['collapse_submenus'];

		// Submenus data
        if($element_type !== 'default' || $collapse_submenus !== 'on'){
            $submenusData = '';
        } else {
			$parent_links	 		 = $module->props["parent_links"];
			$accordion_mode			 = $module->props["accordion_mode"];
			$submenu_style 			 = $module->props["submenu_style"];
			$use_submenu_header_text = $module->props["use_submenu_header_text"];
			$submenu_header_text 	 = $module->props["submenu_header_text"];

			// Maybe clickable parent links
			$parentClickable = sprintf('parentClickable: "%1$s",', esc_attr( $parent_links ));

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
	 * Generate menu markup.
	 * 
	 * @since	v1.9.0
	 * 
	 * @param	object		$module				Module object.
	 * @param	array		$processed_props	Processed props.
	 * @param	string		$render_slug		Module slug.
	 * @param	array	    $args	        	Arguments
     * @param	function	$get_the_menu		Get the menu markup by its ID (<ul>...</ul>).
	 * 
	 * @return	string			            	Menu HTML
	 * 
	 */
	static function menu_markup( $module, $processed_props, $render_slug, $args, $get_the_menu ){

		// get the menu HTML (<ul>...</ul>)
		$menu = $get_the_menu( $args );

		$menu_HTML = sprintf(
			'%1$s',
			$menu
		);

		return $menu_HTML;
	}

	/**
     * Manage assigned menus.
	 * 
	 * Outputs assigned menus.
     * 
     * @since   v1.9.0
	 * 
	 * @param	object		$module				Module object.
	 * @param	array		$processed_props	Processed props.
	 * @param	string		$render_slug		Module slug.
     * @param	function	$get_the_menu		Get the menu markup by its ID (<ul>...</ul>).
	 * 
     * @return  string                      	Updated assigned menus (desktop, tablet and phone).
	 * 
     */
	public static function menus( $module, $processed_props, $render_slug, $get_the_menu ){

		// props
		$menu_id			= $processed_props['menu_id']['desktop'];
		$menu_id_tablet		= $processed_props['menu_id']['tablet'];
		$menu_id_phone		= $processed_props['menu_id']['phone'];
		$menu_id_responsive	= $processed_props['menu_id']['responsive'];

		// menus html
		$all_menus = '';
		$menu_desktop = '';
		$menu_tablet = '';
		$menu_phone = '';

		// don't render duplicate menus if the same menu is set to more than one device
		$render_tablet_menu = $menu_id_tablet !== $menu_id ? true : false;
		$render_phone_menu 	= $menu_id_phone !== $menu_id_tablet && $menu_id_phone !== $menu_id ? true : false;

		// add the Desktop menu
		$menu_desktop = self::menu_markup( $module, $processed_props, $render_slug, array(
			'menu_id'   => $menu_id,
			'menu_type' => 'desktop',
		), $get_the_menu );

		// if responsive menus enabled
		if ( $menu_id_responsive === 'on' ){
			// if tablet menu is assigned: remove 'Desktop' and add Tablet menu
			if ( isset($menu_id_tablet) && $menu_id_tablet !== '' && $render_tablet_menu === true ){
				// add the Tablet menu
				$menu_tablet = self::menu_markup( $module, $processed_props, $render_slug, array(
					'menu_id'	=> $menu_id_tablet,
					'menu_type'	=> 'tablet',
				), $get_the_menu );
			}

			// if phone menu assigned: add Phone menu
			if ( isset($menu_id_phone) && $menu_id_phone !== '' && $render_phone_menu === true ){
				// add the Phone menu
				$menu_phone = self::menu_markup( $module, $processed_props, $render_slug, array(
					'menu_id'	=> $menu_id_phone,
					'menu_type'	=> 'phone',
				), $get_the_menu );
			}
		} 

		// Generate the menu(s) HTML markup
		$all_menus .= $menu_desktop;
		$all_menus .= $menu_tablet;
        $all_menus .= $menu_phone;

		return $all_menus;
	}

	/**
	 * Render.
	 * 
	 * @since	v1.9.0
	 */
	public function render( $attrs, $content, $render_slug ) {

		// Module classnames
		// $module->remove_classname( 'et_pb_with_border' );

		// module order class
		$module_order_class = ET_Builder_Element::get_module_order_class( $render_slug );

		/**
		 * PROPS
		 */
		// get the menu values (devices, hover and responsive) array with $force_return = true (return any value found)
		$menu_id 			= $this->helpers()->get_property_values_all( $this->props, 'menu_id', 'none', true );
		$collapse_submenus	= isset($this->props['collapse_submenus']) ? $this->props['collapse_submenus'] : 'off';
		$parent_links		= isset($this->props['parent_links']) ? $this->props['parent_links'] : 'disabled';
		$accordion_mode		= isset($this->props['accordion_mode']) ? $this->props['accordion_mode'] : 'off';

		// Is DB Plugin active
		$is_dbp = et_is_builder_plugin_active();

		// The 'additional_css' value (the !important). Add '!important' if DB Plugin is active. Need to override some default CSS applied by the DB Plugin.
		$additional_css = $is_dbp ? ' !important;' : '';

		/**
		 * PROPCESSED PROPS
		 */
		$processed_props = array(
			'menu_id'				=> $menu_id,
			'collapse_submenus'		=> $collapse_submenus,
			'parent_links' 			=> $parent_links,
			'accordion_mode'		=> $accordion_mode,
			'module_order_class'	=> $module_order_class,
			'module_classname'		=> $this->module_classname( $render_slug ),
			'is_dbp'				=> $is_dbp,
			'additional_css'		=> $additional_css,
		);

		/**
		 * INLINE JS SCRIPT
		 */
		// module data
		$menu_inline_script_data = self::inline_script_data( $this, $processed_props, $render_slug, 'vertical_menu' );
		//
		$menu_data = $menu_inline_script_data !== '' ? "$menu_inline_script_data," : '';

		// If any inline scripts data available
		$any_script_data = $menu_data === '' ? false : true;

		// All inline script data
		$inline_script = $any_script_data === true ? sprintf('var %1$s_inline_script_data = {%2$s}', 
			esc_attr( $module_order_class ),		// %1$s
			et_core_esc_previously( $menu_data )	// %2$s
		) : '';

		// Add the inline script
		if ($inline_script !== ''){
			wp_add_inline_script( "divi-mad-menu-frontend-bundle", $inline_script, 'before' );
		}

		/**
		 * CSS
		 */
		// add misc CSS
		self::miscCss( $this, $render_slug, $processed_props );

		// add menu css
		self::css( $this, $render_slug );

		/**
		 * CSS CLASSES
		 */
		// get the menu inner container classes
		$inner_container_classes = implode(' ', self::css_classes( $this, $processed_props ) );

		/**
		 * DATA ATTRIBUTES
		 */
		// get the menu inner container data attributes
		$inner_container_data_attrs = implode(' ', self::data_attributes( $this, $processed_props ) );

		/**
		 * MENUS
		 */
		// get the menu(s)
		$all_menus = self::menus( $this, $processed_props, $render_slug, 'dvmm_madmenu_get_the_menu' );

		// Output
		$output = sprintf(
			'<div class="%1$s" %2$s>
				<nav class="dvmmv_nav">
					<div class="dvmmv_wrapper">
						%3$s
					</div>
				</nav>
			</div>',
			esc_attr( $inner_container_classes ),			// %1$s
			$inner_container_data_attrs,					// %2$s
			$all_menus										// %3$s
		);

		return $output;
	}
}

new DVMMV_MadMenu_Vertical;