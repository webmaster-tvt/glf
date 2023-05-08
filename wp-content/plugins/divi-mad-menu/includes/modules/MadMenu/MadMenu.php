<?php
// Die if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Module main class.
 *
 * @since   1.0.0 
 * 
 */
class DVMM_MadMenu extends ET_Builder_Module {

	// Module slug (also used as shortcode tag)
	public $slug       = 'dvmm_mad_menu';

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
		$this->name = esc_html__( 'MadMenu', 'dvmm-divi-mad-menu' );

		// module icon
		$this->icon_path = plugin_dir_path( __FILE__ ) . 'divi-madmenu.svg';

		// Toggle settings
		$this->settings_modal_toggles  = array(
			'general' => array(
				'toggles' => array(
					'header_elements'	=> esc_html__( 'Elements', 'dvmm-divi-mad-menu' ),
					'horizontal_menu' 	=> esc_html__( 'Desktop Menu', 'dvmm-divi-mad-menu' ),
					'mobile_menu' 		=> esc_html__( 'Mobile Menu', 'dvmm-divi-mad-menu' ),
					'mobile_menu_toggle'=> esc_html__( 'Mobile Menu Toggle', 'dvmm-divi-mad-menu' ),
					'logo' 				=> esc_html__( 'Logo', 'dvmm-divi-mad-menu' ),
					'search' 			=> esc_html__( 'Search', 'dvmm-divi-mad-menu' ),
					'cart' 				=> esc_html__( 'Cart', 'dvmm-divi-mad-menu' ),
					'button_one' => array(
						'title'      => esc_html__( 'Button One', 'dvmm-divi-mad-menu' ),
						// 'priority'   => 57,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'auth' => array(
								'name' => esc_html__( 'Auth', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'button_two' => array(
						'title'      => esc_html__( 'Button Two', 'dvmm-divi-mad-menu' ),
						// 'priority'   => 57,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'auth' => array(
								'name' => esc_html__( 'Auth', 'dvmm-divi-mad-menu' ),
							),
						),
					),

					// TBU
					// 'background' => array(
					// 	'title'      => esc_html__( 'Background', 'dvmm-divi-mad-menu' ),
					// 	'priority'   => 89,
					// 	'tabbed_subtoggles' => true,
					// 	'sub_toggles' => array(
					// 		'normal' => array(
					// 			'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
					// 		),
					// 		'fixed' => array(
					// 			'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
					// 		),
					// 	),
					// ),

					'dvmm_builder_settings' => array(
						'title'		=> esc_html__( 'Builder Settings', 'dvmm-divi-mad-menu' ),
						'priority'	=> 90,
					),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'general_layout' => array(
						'title'      => esc_html__( 'Layout: General', 'dvmm-divi-mad-menu' ),
						'priority'   => 54,
					),
					'elements_layout' => array(
						'title'      => esc_html__( 'Layout: Elements', 'dvmm-divi-mad-menu' ),
						'priority'   => 55,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'menu' => array(
								'name' => esc_html__( 'DM', 'dvmm-divi-mad-menu' ),
							),
							'mobile_menu' => array(
								'name' => esc_html__( 'MM', 'dvmm-divi-mad-menu' ),
							),
							'logo' => array(
								'name' => esc_html__( 'L', 'dvmm-divi-mad-menu' ),
							),
							'search' => array(
								'name' => esc_html__( 'S', 'dvmm-divi-mad-menu' ),
							),
							'cart' => array(
								'name' => esc_html__( 'C', 'dvmm-divi-mad-menu' ),
							),
							'button_one' => array(
								'name' => esc_html__( 'B1', 'dvmm-divi-mad-menu' ),
							),
							'button_two' => array(
								'name' => esc_html__( 'B2', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'elements_layout_f' => array(
						'title'      => esc_html__( 'Layout: Elements (Fixed)', 'dvmm-divi-mad-menu' ),
						'priority'   => 56,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'menu' => array(
								'name' => esc_html__( 'M', 'dvmm-divi-mad-menu' ),
							),
							'logo' => array(
								'name' => esc_html__( 'L', 'dvmm-divi-mad-menu' ),
							),
							'search' => array(
								'name' => esc_html__( 'S', 'dvmm-divi-mad-menu' ),
							),
							'cart' => array(
								'name' => esc_html__( 'C', 'dvmm-divi-mad-menu' ),
							),
							'button_one' => array(
								'name' => esc_html__( 'B1', 'dvmm-divi-mad-menu' ),
							),
							'button_two' => array(
								'name' => esc_html__( 'B2', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'menu_text' => array(
						'title'      => esc_html__( 'Text: Desktop Menu', 'dvmm-divi-mad-menu' ),
						'priority'   => 57,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'submenu_text' => array(
						'title'      => esc_html__( 'Text: Desktop Submenu', 'dvmm-divi-mad-menu' ),
						'priority'   => 58,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),			
					'menu_toggle_text' => array(
						'title'      => esc_html__( 'Text: Mobile Menu Toggle', 'dvmm-divi-mad-menu' ),
						'priority'   => 59,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'mobile_menu_text' => array(
						'title'      => esc_html__( 'Text: Mobile Menu', 'dvmm-divi-mad-menu' ),
						'priority'   => 60,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'mobile_submenu_text' => array(
						'title'      => esc_html__( 'Text: Mobile Submenu', 'dvmm-divi-mad-menu' ),
						'priority'   => 61,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'button_one_text' => array(
						'title'      => esc_html__( 'Text: Button One', 'dvmm-divi-mad-menu' ),
						'priority'   => 62,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'button_two_text' => array(
						'title'      => esc_html__( 'Text: Button Two', 'dvmm-divi-mad-menu' ),
						'priority'   => 63,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'cart_text' => array(
						'title'      => esc_html__( 'Text: Cart', 'dvmm-divi-mad-menu' ),
						'priority'   => 64,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'menu_design' => array(
						'title'      => esc_html__( 'Desktop Menu', 'dvmm-divi-mad-menu' ),
						'priority'   => 65,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'menu_items' => array(
						'title'      => esc_html__( 'Desktop Menu Items', 'dvmm-divi-mad-menu' ),
						'priority'   => 67,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'submenu' => array(
						'title'      => esc_html__( 'Desktop Submenu', 'dvmm-divi-mad-menu' ),
						'priority'   => 69,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'submenu_items' => array(
						'title'      => esc_html__( 'Desktop Submenu Items', 'dvmm-divi-mad-menu' ),
						'priority'   => 71,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'menu_toggle_design' => array(
						'title'      => esc_html__( 'Mobile Menu Toggle', 'dvmm-divi-mad-menu' ),
						'priority'   => 73,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'mobile_menu_design' => array(
						'title'      => esc_html__( 'Mobile Menu', 'dvmm-divi-mad-menu' ),
						'priority'   => 75,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'mobile_items_design' => array(
						'title'      => esc_html__( 'Mobile Menu Items', 'dvmm-divi-mad-menu' ),
						'priority'   => 77,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'mobile_submenu_design' => array(
						'title'      => esc_html__( 'Mobile Submenu', 'dvmm-divi-mad-menu' ),
						'priority'   => 79,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'mobile_sub_items_design' => array(
						'title'      => esc_html__( 'Mobile Submenu Items', 'dvmm-divi-mad-menu' ),
						'priority'   => 81,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'logo_design' => array(
						'title'      => esc_html__( 'Logo', 'dvmm-divi-mad-menu' ),
						'priority'   => 83,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'search_design' => array(
						'title'      => esc_html__( 'Search', 'dvmm-divi-mad-menu' ),
						'priority'   => 85,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'cart_design' => array(
						'title'      => esc_html__( 'Cart', 'dvmm-divi-mad-menu' ),
						'priority'   => 87,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'button_one_design' => array(
						'title'      => esc_html__( 'Button One', 'dvmm-divi-mad-menu' ),
						'priority'   => 89,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'button_two_design' => array(
						'title'      => esc_html__( 'Button Two', 'dvmm-divi-mad-menu' ),
						'priority'   => 91,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'sizing' => array(
						'title'			=> esc_html__( 'Sizing', 'dvmm-divi-mad-menu' ),
						'priority'		=> 93,
						'tabbed_subtoggles' => true,
						'sub_toggles' 	=> array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'margin_padding' => array(
						'title'    	  => esc_html__( 'Spacing', 'dvmm-divi-mad-menu' ),
						'priority'	=> 94,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'borders' => array(
						'title'      => esc_html__( 'Border', 'dvmm-divi-mad-menu' ),
						'priority'   => 95,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'box_shadow' => array(
						'title'      => esc_html__( 'Box Shadow', 'dvmm-divi-mad-menu' ),
						'priority'   => 96,
						'tabbed_subtoggles' => true,
						'sub_toggles' => array(
							'normal' => array(
								'name' => esc_html__( 'Normal', 'dvmm-divi-mad-menu' ),
							),
							'fixed' => array(
								'name' => esc_html__( 'Fixed', 'dvmm-divi-mad-menu' ),
							),
						),
					),
					'filters' => array(
						'title'		=> esc_html__( 'Filters', 'dvmm-divi-mad-menu' ),
						'priority'	=> 97,
					),
					'transform' => array(
						'label'    	  => esc_html__( 'Transform', 'dvmm-divi-mad-menu' ),
						'priority'	=> 109,
					),
					'animation' => array(
						'title'    	  => esc_html__( 'Animation', 'dvmm-divi-mad-menu' ),
						'priority'	=> 110,
					),
				),
			),
			'custom_css' => array(
				'toggles' => array(
					'custom_css_f' => array(
						'title'      => esc_html__( 'Custom CSS (Fixed)', 'dvmm-divi-mad-menu' ),
						'priority'   => 59,
					),
				)
			)

		);

	}

	/**
	 * Custom nav menu walker.
	 * 
	 * @since	1.0.0
	 * 
	 * @return	DVMM_MadMenu_Walker_Nav_Menu
	 */
	public static function walker_nav_menu( $args ){
		return dvmm_madmenu_walker_nav_menu_instance( $args );
	}

	/**
	 * Helper methods.
	 * Returns the helper methods class instance.
	 * 
	 * @since	1.0.0
	 * 
	 * @return	DVMM_Divi_Modules_Helper
	 */
	public function helpers(){
		return dvmm_modules_helper_methods();
	}

	/**
	 * Popups methods.
	 * Returns the popups methods class instance.
	 * 
	 * @since v1.6
	 * 
	 * @return	DVMM_MadMenu_Popups
	 */
	public function popups(){
		return dvmm_madmenu_popups();
	}

	/**
	 * Menu Inner Container.
	 * Returns the menu inner container class instance.
	 * 
	 * @since	1.0.0
	 * 
	 * @return	DVMM_Menu_Inner_Container
	 */
	public function menu_inner_container(){
		return dvmm_menu_inner_container_class_instance();
	}

	/**
	 * Menu Wrapper.
	 * Returns the menu wrapper class instance.
	 * 
	 * @since	1.0.0
	 * 
	 * @return	DVMM_Menu_Wrapper
	 */
	public function menu_wrapper(){
		return dvmm_menu_wrapper_class_instance();
	}

	/**
	 * Mobile Menu Wrapper.
	 * Returns the mobile menu wrapper class instance.
	 * 
	 * @since	1.0.0
	 * 
	 * @return	DVMM_Mobile_Menu_Wrapper
	 */
	public function mobile_menu_wrapper(){
		return dvmm_mobile_menu_wrapper_class_instance();
	}

	/**
	 * Styles.
	 * Returns the module styles class instance.
	 * 
	 * @since	1.0.0
	 * 
	 * @return	DVMM_Menu_Module_Styles
	 */
	public function styles(){
		return dvmm_menu_module_styles_class_instance();
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
	 * Logo.
	 * Returns the logo class instance.
	 * 
	 * @since	1.0.0
	 * 
	 * @return	DVMM_Menu_Logo
	 */
	public function logo(){
		return dvmm_menu_logo_class_instance();
	}

	/**
	 * Search.
	 * Returns the search class instance.
	 * 
	 * @since	1.0.0
	 * 
	 * @return	DVMM_Menu_Search
	 */
	public function search(){
		return dvmm_menu_search_class_instance();
	}

	/**
	 * Shopping Cart.
	 * Returns the shopping cart class instance.
	 * 
	 * @since	1.0.0
	 * 
	 * @return	DVMM_Menu_Shopping_Cart
	 */
	public function cart(){
		return dvmm_menu_shopping_cart_class_instance();
	}

	/**
	 * Button(s).
	 * Returns the button class instance.
	 * 
	 * @since	1.0.0
	 * 
	 * @return	DVMM_Menu_CTA_Button
	 */
	public function button(){
		return dvmm_menu_cta_button_class_instance();
	}

	// Fields
	public function get_fields() {
		$fields = array(
			'dvmm_show_outlines__vb' => array(
				'label'           	=> esc_html__( 'Show Outlines', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Showing outlines helps to see & adjust the header layout structure. Outlines are shown in Visual Builder only and have no effect on Front End.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'yes_no_button',
				'option_category' 	=> 'configuration',
				'options'         	=> array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'off',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'dvmm_builder_settings',
			),
			'dvmm_outlines_color__vb' => array(
				'label'           => esc_html__( 'Outlines Color', 'dvmm-divi-mad-menu' ),
                'description'     => esc_html__( 'Set the outlines color.', 'dvmm-divi-mad-menu' ),
				'type'            => 'color-alpha',
                'mobile_options'  => true,
                'responsive'      => true,
				'hover'           => 'tabs',
				'custom_color'    => true,
				'option_category' => 'basic_option',
				'show_if'			=> array(
					'dvmm_show_outlines__vb' => 'on',
				),
                'default'         => '#ff0000',
				'tab_slug'        => 'general',
				'toggle_slug'     => 'dvmm_builder_settings',
			),
			'dvmm_fixed_header_mode__vb' => array(
				'label'           	=> esc_html__( 'Enable Fixed Header Mode', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Enable the fixed header mode manually without the need to scroll the page to trigger it. This setting works in Visual Builder only and has no effect on Front End.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'yes_no_button',
				'option_category' 	=> 'configuration',
				'show_if'			=> array(
					'dvmm_enable_fixed_header' 	=> 'on',
				),
				'options'         	=> array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'off',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'dvmm_builder_settings',
			),
			// @since	v1.5
			'dvmm_auth_mode__vb' => array(
				'label'           	=> esc_html__( 'Enable Logged In Mode', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Enable logged in mode to view the content that is displayed to logged in users. This setting works in Visual Builder only and has no effect on Front End.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'yes_no_button',
				'option_category' 	=> 'configuration',
				'options'         	=> array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'off',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'dvmm_builder_settings',
			),
			'dvmm_h_menu_id' => array(
				'label'           => esc_html__( 'Desktop Menu', 'dvmm-divi-mad-menu' ),
				'description'     => sprintf(
					'<p class="et-fb-form__description">%2$s. <a href="%1$s" target="_blank">%3$s</a>.</p>',
					esc_url( admin_url( 'nav-menus.php' ) ),
					esc_html__( 'Select a menu that should be used as horizontal menu', 'dvmm-divi-mad-menu' ),
					esc_html__( 'Click here to create new menu', 'dvmm-divi-mad-menu' )
				),
				'type'            => 'select',
				'option_category' => 'basic_option',
				'mobile_options'  => true,
				'responsive'      => true,
				'show_if'			=> array(
					'dvmm_enable_menu' => 'on',
				),
				'options'         => et_builder_get_nav_menus_options(),
				'default'		  => 'none',
				'tab_slug'         => 'general',
				'toggle_slug'      => 'horizontal_menu',
				// 'computed_affects' => array( // TBR
				// 	'__dvmm_menu',
				// ),
			),
			'dvmm_m_menu_id' => array(
				'label'           => esc_html__( 'Mobile Menu', 'dvmm-divi-mad-menu' ),
				'description'     => sprintf(
					'<p class="et-fb-form__description">%2$s. <a href="%1$s" target="_blank">%3$s</a>.</p>',
					esc_url( admin_url( 'nav-menus.php' ) ),
					esc_html__( 'Select a menu that should be used as mobile menu', 'dvmm-divi-mad-menu' ),
					esc_html__( 'Click here to create new menu', 'dvmm-divi-mad-menu' )
				),
				'type'            => 'select',
				'option_category' => 'basic_option',
                'mobile_options'  => true,
                'responsive'      => true,
				'show_if'			=> array(
					'dvmm_enable_mobile_menu' => 'on',
				),
				'options'         => et_builder_get_nav_menus_options(),
				'default'		  => 'none',
				'tab_slug'         => 'general',
				'toggle_slug'      => 'mobile_menu',
				// 'computed_affects' => array( // TBR
				// 	'__dvmm_menu',
				// ),
			),
			/**
			 * @todo TBR (@since v1.3.4)
			 */
			// '__dvmm_menu' => array(
			// 	'type'            => 'computed',
			// 	'computed_callback'   => array( 'DVMM_MadMenu', 'get_all_menus_html' ),
			// 	'computed_depends_on' => array(
			// 		// 'dvmm_h_menu_id',
			// 		// 'dvmm_m_menu_id',
			// 	),
			// ),
			'dvmm_enable_fixed_header' => array(
				'label'           => esc_html__( 'Enable Fixed Header', 'dvmm-divi-mad-menu' ),
				'description'     => esc_html__( 'Make the header fixed. Fixed header will always stay in the viewport while the page is being scrolled.', 'dvmm-divi-mad-menu' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'affects' => array(
					'border_radii_inner_container_f',
				),
				'default'			=> 'off',
				'tab_slug'         	=> 'custom_css',
				'toggle_slug'      	=> 'position_fields',
			),
			'dvmm_fixed_header' => array(
				'label'           	=> esc_html__( 'Fixed Header Position', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Set the fixed header position for all devices or for each device individually.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'basic_option',
				'show_if'         => array(
					'dvmm_enable_fixed_header' 	=> 'on',
				),
                'mobile_options'  	=> true,
                'responsive'      	=> true,
				'options'         	=> array(
					'none'		=> esc_html__( 'Not Fixed', 'dvmm-divi-mad-menu' ),
					'top'		=> esc_html__( 'Top (Overlap Content)', 'dvmm-divi-mad-menu' ),
					'top_push'	=> esc_html__( 'Top (No Content Overlap)', 'dvmm-divi-mad-menu' ),
					'bottom' 	=> esc_html__( 'Bottom', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'top',
				'tab_slug'         	=> 'custom_css',
				'toggle_slug'      	=> 'position_fields',
			),
			'dvmm_elements_alignment' => array(
				'label'           	=> esc_html__( 'Elements Alignment', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Change the elements horizontal alignment. This setting takes effect unless any element is "stretched" because it makes the elements occupy all the available space.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'option_category'	=> 'basic_option',
				'options'         	=> array(
					'flex-start'	=> esc_html__( 'Left', 'dvmm-divi-mad-menu' ),
					'center' 		=> esc_html__( 'Center', 'dvmm-divi-mad-menu' ),
					'flex-end' 		=> esc_html__( 'Right', 'dvmm-divi-mad-menu' ),
					'space-between' => esc_html__( 'Space-between', 'dvmm-divi-mad-menu' ),
					'space-around' 	=> esc_html__( 'Space-around', 'dvmm-divi-mad-menu' ),
					'space-evenly' 	=> esc_html__( 'Space-evenly', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'flex-start',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'general_layout',
			),
			'dvmm_main_margin' => array(
				'label'             => esc_html__('Main Margin', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           => 'tabs',
				'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'margin_padding',
				'sub_toggle'		=> 'normal',
			),
            'dvmm_main_padding' => array(
                'label'             => esc_html__('Main Padding', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
                'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
                'mobile_options'    => true,
                'responsive'        => true,
				'hover'           	=> 'tabs',
				'default'           => '20px|20px|20px|20px|false|false',
                'default_unit'      => 'px',
                'tab_slug'          => 'advanced',
				'toggle_slug'       => 'margin_padding',
				'sub_toggle'		=> 'normal',
			),
            'dvmm_main_padding_f' => array(
                'label'             => esc_html__('Main Padding (Fixed)', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
                'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'show_if'         => array(
					'dvmm_enable_fixed_header' => 'on',
				),
                'mobile_options'    => true,
                'responsive'        => true,
				'hover'           => 'tabs',
				// 'default'           => '20px|20px|20px|20px|false|false',
                'default_unit'      => 'px',
                'tab_slug'          => 'advanced',
				'toggle_slug'       => 'margin_padding',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_background_color_f' => array(
				'label'           => esc_html__( 'Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
                'description'     => esc_html__('Set the fixed header background color.', 'dvmm-divi-mad-menu'),
				'type'            => 'color-alpha',
				'option_category' => 'basic_option',
				'show_if'         => array(
					'dvmm_enable_fixed_header' => 'on',
				),
                'mobile_options'  => true,
                'responsive'      => true,
				'hover'           => 'tabs',
                'custom_color'    => true,
                'default'         => '',
				'tab_slug'        => 'general',
				'toggle_slug'     => 'background',
				// 'sub_toggle'	  => 'fixed', // TBU
			),
			'dvmm_search_hide_elems'	=> array(
				'label'           => esc_html__( 'Hide Elements When Search Opens', 'dvmm-divi-mad-menu' ),
				'description'     => esc_html__( 'Select which elements to hide when the search form is opened.', 'dvmm-divi-mad-menu' ),
				'type'            => 'multiple_checkboxes',
				'option_category' => 'configuration',
				'show_if'         => array(
					'dvmm_enable_search' => 'on',
				),
				// 'mobile_options'  	=> true,
				// 'responsive'      	=> true,
				'options'		=> array(
					'logo'		  => esc_html__( 'Logo', 'dvmm-divi-mad-menu' ),
					'menu'		  => esc_html__( 'Desktop Menu', 'dvmm-divi-mad-menu' ),
					'mobile_menu' => esc_html__( 'Mobile Menu', 'dvmm-divi-mad-menu' ),
					'search'	  => esc_html__( 'Search Icon', 'dvmm-divi-mad-menu' ),
					'cart'		  => esc_html__( 'Cart Icon', 'dvmm-divi-mad-menu' ),
					'button_one'  => esc_html__( 'Button One', 'dvmm-divi-mad-menu' ),
					'button_two'  => esc_html__( 'Button Two', 'dvmm-divi-mad-menu' ),
				),
				// 'default'		=> 'off|on|on|on',
				'default'		=> 'on|on|on|on|on|on|on',
				'tab_slug'		=> 'custom_css',
				'toggle_slug'	=> 'visibility',
			),

		);

		// get the horizontal menu fields
		$horizontal_menu_fields = self::horizontal_menu()->get_fields( $this );

		// get the mobile menu fields
		$mobile_menu_fields = self::mobile_menu()->get_fields( $this );

		// get the mobile menu toggle fields
		$mobile_menu_toggle_fields = self::mobile_menu()->mobile_menu_toggle()->get_fields( $this );

		// get the menu wrapper fields
		$menu_wrapper_fields = self::menu_wrapper()->get_fields( $this );

		// get the mobile menu wrapper fields
		$mobile_menu_wrapper_fields = self::mobile_menu_wrapper()->get_fields( $this );

		// get the logo fields
		$logo_fields = self::logo()->get_fields( $this );

		// get the search fields
		$search_fields = self::search()->get_fields( $this );

		// get the cart fields
		$cart_fields = self::cart()->get_fields( $this );

		// get the CTA button(s) fields
		$button_one_fields = self::button()->get_fields($this, 'button_one', 'Button One');
		$button_two_fields = self::button()->get_fields($this, 'button_two', 'Button Two');

		/**
		 * Add the "Fixed Header Disabled" warning fields.
		 * Eg.: "dvmm_fixed_header_disabled__menu_text"
		 */
		$fixed_header_disabled_warning_fields = self::helpers()->add_fixed_header_disabled_warning_fields();

		// merge fields arrays
		$fields = array_merge( 
			$fields,
			$horizontal_menu_fields,
			$mobile_menu_fields,
			$mobile_menu_toggle_fields,
			$menu_wrapper_fields,
			$mobile_menu_wrapper_fields,
			$logo_fields, 
			$search_fields, 
			$cart_fields,
			$button_one_fields,
			$button_two_fields,
			$fixed_header_disabled_warning_fields
		);

		return $fields;
	}

	// Advanced fields
	public function get_advanced_fields_config() {
        
        // module class
		$this->main_css_element = '%%order_class%%';

		// selectors
		$dvmm_menu_inner_container = "{$this->main_css_element} .dvmm_menu_inner_container";

		// advanced fields
		$advanced_fields = array(

			// remove default spacing fields
			'margin_padding' => false,

			// Main background
			'background'            => array(
				'css' => array(
					'main' => $this->main_css_element,
					'important' => false,
				),

				// TBU
				// 'tab_slug'        => 'general',
				// 'toggle_slug'     => 'background',
				// 'sub_toggle'	  => 'normal',


				// 'sticky' => false,
			),
			'text'           => false,
			'text_shadow'    => false,
			'fonts'          => false,
			'max_width'             => array(
				'use_module_alignment' => true,
				'css' => array(
					'main' 		=> "{$dvmm_menu_inner_container}",
					'hover'		=> "{$dvmm_menu_inner_container}:hover", // DOESN'T WORK. Hover style is only applied when the %%order_class%% element is hovered, not possible to change the hover selector. WHY ??? @see Divi/includes/builder/class-et-builder-element.php::14803 (Divi 4.7.7)
				),
				'options' => array(
					'width'     => array(
						'label' 			=> esc_html__( 'Main Width', 'dvmm-divi-mad-menu' ),
						'default' 			=> '100%',
						'tab_slug'          => 'advanced',
						'toggle_slug'       => 'sizing',
						'sub_toggle'		=> 'normal',
					),
					'max_width' => array(
						'label' 			=> esc_html__( 'Main Max Width', 'dvmm-divi-mad-menu' ),
						'default' 			=> '100%',
						'tab_slug'          => 'advanced',
						'toggle_slug'       => 'sizing',
						'sub_toggle'		=> 'normal',
					),
					'module_alignment' => array(
						'label' 			=> esc_html__( 'Main Alignment', 'dvmm-divi-mad-menu' ),
						'tab_slug'          => 'advanced',
						'toggle_slug'       => 'sizing',
						'sub_toggle'		=> 'normal',
					),
				),
				'extra'   => array(
					'max_width_f' => array(
						'use_module_alignment'	=> true,
						'css' => array(
							'main' 	=> "{$dvmm_menu_inner_container}.dvmm_fixed",
							'hover' => "{$dvmm_menu_inner_container}.dvmm_fixed:hover", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Main Width (Fixed)', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> '100%',
								'show_if'			=> array(
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'sizing',
								'sub_toggle'		=> 'fixed',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Main Max Width (Fixed)', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> '100%',
								'show_if'			=> array(
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'sizing',
								'sub_toggle'		=> 'fixed',
							),
							'module_alignment' => array(
								'label' 			=> esc_html__( 'Main Alignment (Fixed)', 'dvmm-divi-mad-menu' ),
								'show_if'			=> array(
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'sizing',
								'sub_toggle'		=> 'fixed',
							),
						),
					),
					'content_width' => array(
						'use_module_alignment'	=> true,
						'css' => array(
							'main' => "{$dvmm_menu_inner_container} .dvmm_content",
							'hover' => "{$dvmm_menu_inner_container} .dvmm_content:hover", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Contents Width', 'dvmm-divi-mad-menu' ),
								'default' 			=> '100%',
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'sizing',
								'sub_toggle'		=> 'normal',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Contents Max Width', 'dvmm-divi-mad-menu' ),
								'default' 			=> '1080px',
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'sizing',
								'sub_toggle'		=> 'normal',
							),
							'module_alignment' => array(
								'label' 			=> esc_html__( 'Contents Alignment', 'dvmm-divi-mad-menu' ),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'sizing',
								'sub_toggle'		=> 'normal',
							),
						),
					),
					'content_width_f' => array(
						'use_module_alignment'	=> true,
						'css' => array(
							'main' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_content",
							'hover' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_content:hover", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Contents Width (Fixed)', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> '',
								'show_if'			=> array(
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'sizing',
								'sub_toggle'		=> 'fixed',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Contents Max Width (Fixed)', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> '',
								'show_if'			=> array(
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'sizing',
								'sub_toggle'		=> 'fixed',
							),
							'module_alignment' => array(
								'label' 			=> esc_html__( 'Contents Alignment (Fixed)', 'dvmm-divi-mad-menu' ),
								'show_if'			=> array(
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'sizing',
								'sub_toggle'		=> 'fixed',
							),
						),
					),
					'submenu_width' => array(
						'use_module_alignment'	=> false,
						'css' => array(
							'main' => "{$dvmm_menu_inner_container} .dvmm_menu__menu .dvmm_menu li ul",
							'hover' => "{$dvmm_menu_inner_container} .dvmm_menu__menu .dvmm_menu li ul:hover", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Submenu Width', 'dvmm-divi-mad-menu' ),
								'default' 			=> '240px',
								'show_if'			=> array(
									'dvmm_enable_menu' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'submenu',
								'sub_toggle'		=> 'normal',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Submenu Max Width', 'dvmm-divi-mad-menu' ),
								'default' 			=> '240px',
								'show_if'			=> array(
									'dvmm_enable_menu' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'submenu',
								'sub_toggle'		=> 'normal',
							),
						),
					),
					'submenu_width_f' => array(
						'use_module_alignment'	=> false,
						'css' => array(
							'main' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_menu__menu .dvmm_menu li ul",
							'hover' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_menu__menu .dvmm_menu li ul:hover", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Submenu Width (Fixed)', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> '240px',
								'show_if'			=> array(
									'dvmm_enable_menu' => 'on',
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'submenu',
								'sub_toggle'		=> 'fixed',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Submenu Max Width (Fixed)', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> '240px',
								'show_if'			=> array(
									'dvmm_enable_menu' => 'on',
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'submenu',
								'sub_toggle'		=> 'fixed',
							),
						),
					),
					'mobile_dd_width' => array(
						'use_module_alignment'	=> false,
						'css' => array(
							'main' => "{$this->main_css_element} .dvmm_mobile_menu_wrapper",
							'hover' => "{$this->main_css_element} .dvmm_mobile_menu_wrapper:hover", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Mobile Menu Width', 'dvmm-divi-mad-menu' ),
								'default' 			=> '80%',
								'show_if'			=> array(
									'dvmm_enable_mobile_menu' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'mobile_menu_design',
								'sub_toggle'		=> 'normal',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Mobile Menu Max Width', 'dvmm-divi-mad-menu' ),
								'default' 			=> '100%',
								'show_if'			=> array(
									'dvmm_enable_mobile_menu' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'mobile_menu_design',
								'sub_toggle'		=> 'normal',
							),
						),
					),
					'mobile_dd_width_f' => array(
						'use_module_alignment'	=> false,
						'css' => array(
							'main' => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile_menu_wrapper",
							'hover' => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile_menu_wrapper:hover", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Mobile Menu Width (Fixed)', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> '80%',
								'show_if'			=> array(
									'dvmm_enable_mobile_menu' => 'on',
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'mobile_menu_design',
								'sub_toggle'		=> 'fixed',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Mobile Menu Max Width (Fixed)', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> '100%',
								'show_if'			=> array(
									'dvmm_enable_mobile_menu' => 'on',
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'mobile_menu_design',
								'sub_toggle'		=> 'fixed',
							),
						),
					),
					'logo_width' => array(
						'use_module_alignment'	=> false,
						'css' => array(
							'main' => "{$dvmm_menu_inner_container} .dvmm_logo",
							'hover' => "{$dvmm_menu_inner_container} .dvmm_logo:hover", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Logo Width', 'dvmm-divi-mad-menu' ),
								'default' 			=> 'auto',
								'show_if'			=> array(
									'dvmm_enable_logo' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'logo_design',
								'sub_toggle'		=> 'normal',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Logo Max Width', 'dvmm-divi-mad-menu' ),
								'default' 			=> '120px',
								'show_if'			=> array(
									'dvmm_enable_logo' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'logo_design',
								'sub_toggle'		=> 'normal',
							),
						),
					),
					'logo_width_f' => array(
						'use_module_alignment'	=> false,
						'css' => array(
							'main' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_logo",
							'hover' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_logo:hover", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Logo Width (Fixed)', 'dvmm-divi-mad-menu' ),
								'default' 			=> 'auto',
								'show_if'			=> array(
									'dvmm_enable_logo' => 'on',
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'logo_design',
								'sub_toggle'		=> 'fixed',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Logo Max Width (Fixed)', 'dvmm-divi-mad-menu' ),
								'default' 			=> '120px',
								'show_if'			=> array(
									'dvmm_enable_logo' => 'on',
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'logo_design',
								'sub_toggle'		=> 'fixed',
							),
						),
					),
					'button_one_img_width' => array(
						'use_module_alignment'	=> false,
						'css' => array(
							'main' => "{$this->main_css_element} .dvmm_button_one img",
							'hover' => "{$this->main_css_element} .dvmm_button_one:hover img", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Button One Image Width', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> 'auto',
								'default' 			=> '24px',
								'show_if'			=> array(
									'dvmm_enable_button_one' 		=> 'on',
									'dvmm_button_one_enable_icon' 	=> 'on',
									'dvmm_button_one_icon_type' 	=> 'image_icon',
								),
								'priority'			=> 520,			// DOESN'T WORK ???
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'button_one_design',
								'sub_toggle'		=> 'normal',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Button One Image Max Width', 'dvmm-divi-mad-menu' ),
								'default' 			=> '24px',
								'show_if'			=> array(
									'dvmm_enable_button_one' 		=> 'on',
									'dvmm_button_one_enable_icon' 	=> 'on',
									'dvmm_button_one_icon_type' 	=> 'image_icon',
								),
								'priority'			=> 730,			// DOESN'T WORK ???
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'button_one_design',
								'sub_toggle'		=> 'normal',
							),
						),
					),
					'button_one_img_width_f' => array(
						'use_module_alignment'	=> false,
						'css' => array(
							'main' => "{$this->main_css_element} .dvmm_fixed .dvmm_button_one img",
							'hover' => "{$this->main_css_element} .dvmm_fixed .dvmm_button_one:hover img", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Button One Image Width (Fixed)', 'dvmm-divi-mad-menu' ),
								'default' 			=> '',
								'show_if'			=> array(
									'dvmm_enable_button_one' 		=> 'on',
									'dvmm_button_one_enable_icon' 	=> 'on',
									'dvmm_button_one_icon_type' 	=> 'image_icon',
									'dvmm_enable_fixed_header' 		=> 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'button_one_design',
								'sub_toggle'		=> 'fixed',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Button One Image Max Width (Fixed)', 'dvmm-divi-mad-menu' ),
								'default' 			=> '',
								'show_if'			=> array(
									'dvmm_enable_button_one' 		=> 'on',
									'dvmm_button_one_enable_icon' 	=> 'on',
									'dvmm_button_one_icon_type' 	=> 'image_icon',
									'dvmm_enable_fixed_header' 		=> 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'button_one_design',
								'sub_toggle'		=> 'fixed',
							),
						),
					),
					'button_two_img_width' => array(
						'use_module_alignment'	=> false,
						'css' => array(
							'main' => "{$this->main_css_element} .dvmm_button_two img",
							'hover' => "{$this->main_css_element} .dvmm_button_two:hover img", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Button Two Image Width', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> 'auto',
								'default' 			=> '24px',
								'show_if'			=> array(
									'dvmm_enable_button_two' 		=> 'on',
									'dvmm_button_two_enable_icon' 	=> 'on',
									'dvmm_button_two_icon_type' 	=> 'image_icon',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'button_two_design',
								'sub_toggle'		=> 'normal',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Button Two Image Max Width', 'dvmm-divi-mad-menu' ),
								'default' 			=> '24px',
								'show_if'			=> array(
									'dvmm_enable_button_two' 		=> 'on',
									'dvmm_button_two_enable_icon' 	=> 'on',
									'dvmm_button_two_icon_type' 	=> 'image_icon',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'button_two_design',
								'sub_toggle'		=> 'normal',
							),
						),
					),
					'button_two_img_width_f' => array(
						'use_module_alignment'	=> false,
						'css' => array(
							'main' => "{$this->main_css_element} .dvmm_fixed .dvmm_button_two img",
							'hover' => "{$this->main_css_element} .dvmm_fixed .dvmm_button_two:hover img", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Button Two Image Width (Fixed)', 'dvmm-divi-mad-menu' ),
								'default' 			=> '',
								'show_if'			=> array(
									'dvmm_enable_button_two' 		=> 'on',
									'dvmm_button_two_enable_icon' 	=> 'on',
									'dvmm_button_two_icon_type' 	=> 'image_icon',
									'dvmm_enable_fixed_header' 		=> 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'button_two_design',
								'sub_toggle'		=> 'fixed',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Button Two Image Max Width (Fixed)', 'dvmm-divi-mad-menu' ),
								'default' 			=> '',
								'show_if'			=> array(
									'dvmm_enable_button_two' 		=> 'on',
									'dvmm_button_two_enable_icon' 	=> 'on',
									'dvmm_button_two_icon_type' 	=> 'image_icon',
									'dvmm_enable_fixed_header' 		=> 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'button_two_design',
								'sub_toggle'		=> 'fixed',
							),
						),
					),
					'search_img_width' => array(
						'use_module_alignment'	=> false,
						'css' => array(
							'main' => "{$dvmm_menu_inner_container} .dvmm_search__button img",
							'hover' => "{$dvmm_menu_inner_container} .dvmm_search__button:hover img", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Search Image Width', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> 'auto',
								'default' 			=> '24px',
								'show_if'			=> array(
									'dvmm_enable_search' => 'on',
									'dvmm_search_icon_image' => 'image',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'search_design',
								'sub_toggle'		=> 'normal',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Search Image Max Width', 'dvmm-divi-mad-menu' ),
								'default' 			=> '24px',
								'show_if'			=> array(
									'dvmm_enable_search' => 'on',
									'dvmm_search_icon_image' => 'image',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'search_design',
								'sub_toggle'		=> 'normal',
							),
						),
					),
					'search_img_width_f' => array(
						'use_module_alignment'	=> false,
						'css' => array(
							'main' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__button img",
							'hover' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__button:hover img", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Search Image Width (Fixed)', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> 'auto',
								'show_if'			=> array(
									'dvmm_enable_search' => 'on',
									'dvmm_search_icon_image' => 'image',
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'search_design',
								'sub_toggle'		=> 'fixed',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Search Image Max Width (Fixed)', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> '64px',
								'show_if'			=> array(
									'dvmm_enable_search' => 'on',
									'dvmm_search_icon_image' => 'image',
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'search_design',
								'sub_toggle'		=> 'fixed',
							),
						),
					),
					'search_form_width' => array(
						'use_module_alignment'	=> true,
						'css' => array(
							'main' => "{$dvmm_menu_inner_container} .dvmm_search",
							'hover' => "{$dvmm_menu_inner_container} .dvmm_search:hover", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Search Form Width', 'dvmm-divi-mad-menu' ),
								'default' 			=> '50%',
								'show_if'			=> array(
									'dvmm_enable_search' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'search_design',
								'sub_toggle'		=> 'normal',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Search Form Max Width', 'dvmm-divi-mad-menu' ),
								'default' 			=> '1080px',
								'show_if'			=> array(
									'dvmm_enable_search' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'search_design',
								'sub_toggle'		=> 'normal',
							),
							'module_alignment' => array(
								'label' 			=> esc_html__( 'Search Form Alignment', 'dvmm-divi-mad-menu' ),
								'show_if'			=> array(
									'dvmm_enable_search' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'search_design',
								'sub_toggle'		=> 'normal',
							),
						),
					),
					'search_form_width_f' => array(
						'use_module_alignment'	=> true,
						'css' => array(
							'main' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search",
							'hover' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search:hover", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Search Form Width (Fixed)', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> '50%',
								'show_if'			=> array(
									'dvmm_enable_search' => 'on',
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'search_design',
								'sub_toggle'		=> 'fixed',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Search Form Max Width (Fixed)', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> '1080px',
								'show_if'			=> array(
									'dvmm_enable_search' => 'on',
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'search_design',
								'sub_toggle'		=> 'fixed',
							),
							'module_alignment' => array(
								'label' 			=> esc_html__( 'Search Form Alignment (Fixed)', 'dvmm-divi-mad-menu' ),
								'show_if'			=> array(
									'dvmm_enable_search' => 'on',
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'search_design',
								'sub_toggle'		=> 'fixed',
							),
						),
					),
					'cart_img_width' => array(
						'use_module_alignment'	=> false,
						'css' => array(
							'main' => "{$dvmm_menu_inner_container} .dvmm_cart__button img",
							'hover' => "{$dvmm_menu_inner_container} .dvmm_cart__button:hover img", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Cart Image Width', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> 'auto',
								'default' 			=> '24px',
								'show_if'			=> array(
									'dvmm_enable_cart' 		=> 'on',
									'dvmm_cart_icon_image' 	=> 'image',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'cart_design',
								'sub_toggle'		=> 'normal',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Cart Image Max Width', 'dvmm-divi-mad-menu' ),
								'default' 			=> '24px',
								'show_if'			=> array(
									'dvmm_enable_cart' 		=> 'on',
									'dvmm_cart_icon_image' 	=> 'image',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'cart_design',
								'sub_toggle'		=> 'normal',
							),
						),
					),
					'cart_img_width_f' => array(
						'use_module_alignment'	=> false,
						'css' => array(
							'main' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_cart__button img",
							'hover' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_cart__button:hover img", // DOESN'T WORK @see above
						),
						'options' => array(
							'width'     => array(
								'label' 			=> esc_html__( 'Cart Image Width (Fixed)', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> 'auto',
								'show_if'			=> array(
									'dvmm_enable_cart' => 'on',
									'dvmm_cart_icon_image' 	=> 'image',
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'cart_design',
								'sub_toggle'		=> 'fixed',
							),
							'max_width' => array(
								'label' 			=> esc_html__( 'Cart Image Max Width (Fixed)', 'dvmm-divi-mad-menu' ),
								// 'default' 			=> '64px',
								'show_if'			=> array(
									'dvmm_enable_cart' => 'on',
									'dvmm_cart_icon_image' 	=> 'image',
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'cart_design',
								'sub_toggle'		=> 'fixed',
							),
						),
					),
				)
			),
			'height'                => array(
				'css' => array(
					'main' => "{$dvmm_menu_inner_container}",
				),
				'options' => array(
					'min_height'     => array(
						'label' 			=> esc_html__( 'Main Min Height', 'dvmm-divi-mad-menu' ),
						'tab_slug'          => 'advanced',
						'toggle_slug'       => 'sizing',
						'sub_toggle'		=> 'normal',
					),
					'height' => array(
						'label' 			=> esc_html__( 'Main Height', 'dvmm-divi-mad-menu' ),
						'tab_slug'          => 'advanced',
						'toggle_slug'       => 'sizing',
						'sub_toggle'		=> 'normal',
					),
					'max_height' => array(
						'label' 			=> esc_html__( 'Main Max Height', 'dvmm-divi-mad-menu' ),
						'tab_slug'          => 'advanced',
						'toggle_slug'       => 'sizing',
						'sub_toggle'		=> 'normal',
					),
				),
				'extra'   => array(
					'height_f' => array(
						'css' => array(
							'main' => "{$dvmm_menu_inner_container}.dvmm_fixed",
						),
						'options' => array(
							'min_height'     => array(
								'label' => esc_html__( 'Main Min Height (Fixed)', 'dvmm-divi-mad-menu' ),
								'default' => '',
								'show_if'			=> array(
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'sizing',
								'sub_toggle'		=> 'fixed',
							),
							'height' => array(
								'label' => esc_html__( 'Main Height (Fixed)', 'dvmm-divi-mad-menu' ),
								'default' => '',
								'show_if'			=> array(
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'sizing',
								'sub_toggle'		=> 'fixed',
							),
							'max_height' => array(
								'label' => esc_html__( 'Main Max Height (Fixed)', 'dvmm-divi-mad-menu' ),
								'default' => '',
								'show_if'			=> array(
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'sizing',
								'sub_toggle'		=> 'fixed',
							),
						),
					),
					'mobile_dd_height' => array(
						'css' => array(
							'main' => "{$this->main_css_element} .dvmm_mobile_menu_wrapper",
						),
						'options' => array(
							'min_height' => array(
								'label' => esc_html__( 'Mobile Menu Min Height', 'dvmm-divi-mad-menu' ),
								'default' => '',
								'show_if'			=> array(
									'dvmm_enable_mobile_menu' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'mobile_menu_design',
								'sub_toggle'		=> 'normal',
							),
							'height' => array(
								'label' => esc_html__( 'Mobile Menu Height', 'dvmm-divi-mad-menu' ),
								'default' => '',
								'show_if'			=> array(
									'dvmm_enable_mobile_menu' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'mobile_menu_design',
								'sub_toggle'		=> 'normal',
							),
							'max_height' => array(
								'label' => esc_html__( 'Mobile Menu Max Height', 'dvmm-divi-mad-menu' ),
								'default' => '',
								'show_if'			=> array(
									'dvmm_enable_mobile_menu' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'mobile_menu_design',
								'sub_toggle'		=> 'normal',
							),
						),
					),
					'mobile_dd_height_f' => array(
						'css' => array(
							'main' => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile_menu_wrapper",
						),
						'options' => array(
							'min_height' => array(
								'label' => esc_html__( 'Mobile Menu Min Height (Fixed)', 'dvmm-divi-mad-menu' ),
								'default' => '',
								'show_if'			=> array(
									'dvmm_enable_mobile_menu' => 'on',
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'mobile_menu_design',
								'sub_toggle'		=> 'fixed',
							),
							'height' => array(
								'label' => esc_html__( 'Mobile Menu Height (Fixed)', 'dvmm-divi-mad-menu' ),
								'default' => '',
								'show_if'			=> array(
									'dvmm_enable_mobile_menu' => 'on',
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'mobile_menu_design',
								'sub_toggle'		=> 'fixed',
							),
							'max_height' => array(
								'label' => esc_html__( 'Mobile Menu Max Height (Fixed)', 'dvmm-divi-mad-menu' ),
								'default' => '',
								'show_if'			=> array(
									'dvmm_enable_mobile_menu' => 'on',
									'dvmm_enable_fixed_header' => 'on',
								),
								'tab_slug'          => 'advanced',
								'toggle_slug'       => 'mobile_menu_design',
								'sub_toggle'		=> 'fixed',
							),
						),
					),
				),
			),
			'borders'	=> array(
				'default'           	  => false,
				'inner_container' => array(
					'label_prefix'		=> esc_html__( 'Main', 'dvmm-divi-mad-menu' ),
					'css'             	=> array(
						'main' => array(
							'border_radii'  => "{$dvmm_menu_inner_container}",
							'border_styles' => "{$dvmm_menu_inner_container}",
						),
						'important' => 'plugin_only',
					),
					'defaults'        => array(
						'border_radii'  => 'on||||',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'tab_slug'		=> 'advanced',
					'toggle_slug'	=> 'borders',
					'sub_toggle'	=> 'normal',
				),
				'inner_container_f' => array(
					'label_prefix'	=> esc_html__( 'Fixed Main', 'dvmm-divi-mad-menu' ),
					'css'			=> array(
						'main' => array(
							'border_radii'  => "{$dvmm_menu_inner_container}.dvmm_fixed",
							'border_styles' => "{$dvmm_menu_inner_container}.dvmm_fixed",
						),
						'important' => 'plugin_only',
					),
					'defaults'        => array(
						'border_radii'  => 'on| | | | ',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					'depends_on'      => array(
						'dvmm_enable_fixed_header',
					),
					// 'show_if'			=> array(
					// 	'dvmm_enable_fixed_header' => 'on',
					// ),
					'tab_slug'		=> 'advanced',
					'toggle_slug'	=> 'borders',
					'sub_toggle'	=> 'fixed',
				),
				'dvmm_logo'   => array(
					'label_prefix' => esc_html__( 'Logo', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$dvmm_menu_inner_container} .dvmm_logo",
							'border_styles' => "{$dvmm_menu_inner_container} .dvmm_logo",
						),
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
					'depends_show_if'	=> 'on',
					'depends_on'      => array(
						'dvmm_enable_logo',
					),
					'tab_slug'     	=> 'advanced',
					'toggle_slug'  	=> 'logo_design',
					'sub_toggle'	=> 'normal',
				),
				'dvmm_logo_f'   => array(
					'label_prefix' => esc_html__( 'Logo (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_logo",
							'border_styles' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_logo",
						),
						'important' => 'plugin_only',
					),
					'defaults' => array(
						'border_radii' => 'on| | | | ',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					// 'depends_show_if_not'	=> 'off',
					'depends_on'      => array(
						'dvmm_enable_logo',
						// 'dvmm_enable_fixed_header',
					),
					'tab_slug'     	=> 'advanced',
					'toggle_slug'  	=> 'logo_design',
					'sub_toggle'	=> 'fixed',
				),		
				'dvmm_item'   => array(
					'label_prefix' => esc_html__( 'Menu Item', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$dvmm_menu_inner_container} .dvmm_menu__menu .dvmm_menu li a",
							'border_styles' => "{$dvmm_menu_inner_container} .dvmm_menu__menu .dvmm_menu li a",
						),
						'hover' => "{$dvmm_menu_inner_container} .dvmm_menu__menu .dvmm_menu li a",
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
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_menu',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'menu_items',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_item_f'   => array(
					'label_prefix' => esc_html__( 'Menu Item (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_menu__menu .dvmm_menu li a",
							'border_styles' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_menu__menu .dvmm_menu li a",
						),
						'hover' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_menu__menu .dvmm_menu li a",
						'important' => 'plugin_only',
					),
					'defaults' => array(
						'border_radii' => 'on| | | | ',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_menu',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'menu_items',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_sub_item'   => array(
					'label_prefix' => esc_html__( 'Submenu Item', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$dvmm_menu_inner_container} .dvmm_menu__menu .dvmm_menu li li a",
							'border_styles' => "{$dvmm_menu_inner_container} .dvmm_menu__menu .dvmm_menu li li a",
						),
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
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_menu',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'submenu_items',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_sub_item_f'   => array(
					'label_prefix' => esc_html__( 'Submenu Item (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_menu__menu .dvmm_menu li li a",
							'border_styles' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_menu__menu .dvmm_menu li li a",
						),
						'important' => 'plugin_only',
					),
					'defaults' => array(
						'border_radii' => 'on| | | | ',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_menu',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'     	=> 'submenu_items',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_submenu'   => array(
					'label_prefix' => esc_html__( 'Submenu', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$dvmm_menu_inner_container} .dvmm_menu__menu .dvmm_menu li ul",
							'border_styles' => "{$dvmm_menu_inner_container} .dvmm_menu__menu .dvmm_menu li ul",
						),
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
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_menu',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'submenu',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_submenu_f'   => array(
					'label_prefix' => esc_html__( 'Submenu (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_menu__menu .dvmm_menu li ul",
							'border_styles' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_menu__menu .dvmm_menu li ul",
						),
						'important' => 'plugin_only',
					),
					'defaults' => array(
						'border_radii' => 'on| | | | ',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_menu',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'       => 'submenu',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_mobile_menu'   => array(
					'label_prefix' => esc_html__( 'Mobile Menu', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .dvmm_mobile_menu_wrapper",
							'border_styles' => "{$this->main_css_element} .dvmm_mobile_menu_wrapper",
						),
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
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_mobile_menu',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'mobile_menu_design',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_mobile_menu_f'   => array(
					'label_prefix' => esc_html__( 'Mobile Menu (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile_menu_wrapper",
							'border_styles' => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile_menu_wrapper",
						),
						'important' => 'plugin_only',
					),
					'defaults' => array(
						'border_radii' => 'on| | | | ',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_mobile_menu',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'       => 'mobile_menu_design',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_mobile_item'   => array(
					'label_prefix' => esc_html__( 'Mobile Item', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .dvmm_mobile__menu .dvmm_menu li a",
							'border_styles' => "{$this->main_css_element} .dvmm_mobile__menu .dvmm_menu li a",
						),
						'hover' => "{$this->main_css_element} .dvmm_mobile__menu .dvmm_menu li a:hover",
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
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_mobile_menu',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'mobile_items_design',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_mobile_item_f'   => array(
					'label_prefix' => esc_html__( 'Mobile Item (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li a",
							'border_styles' => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li a",
						),
						'hover' => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li a:hover",
						'important' => 'plugin_only',
					),
					'defaults' => array(
						'border_radii' => 'on| | | | ',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_mobile_menu',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'mobile_items_design',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_mobile_submenu'   => array(
					'label_prefix' => esc_html__( 'Mobile Submenu', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .dvmm_mobile__menu .dvmm_menu li ul",
							'border_styles' => "{$this->main_css_element} .dvmm_mobile__menu .dvmm_menu li ul",
						),
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
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_mobile_menu',
					),
					'show_if' => array( // DOESN'T WORK
						'submenu_style' 			=> 'expand',	
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'mobile_submenu_design',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_mobile_submenu_f'   => array(
					'label_prefix' => esc_html__( 'Mobile Submenu (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li ul",
							'border_styles' => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li ul",
						),
						'important' => 'plugin_only',
					),
					'defaults' => array(
						'border_radii' => 'on| | | | ',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_mobile_menu',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'mobile_submenu_design',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_mobile_sub_item'   => array(
					'label_prefix' => esc_html__( 'Mobile Submenu Item', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .dvmm_mobile__menu .dvmm_menu li li a",
							'border_styles' => "{$this->main_css_element} .dvmm_mobile__menu .dvmm_menu li li a",
						),
						'hover' => "{$this->main_css_element} .dvmm_mobile__menu .dvmm_menu li li a:hover",
						'important' => 'plugin_only',
					),
					'defaults'		=> array(
						'border_radii' 	=> 'on||||',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_mobile_menu',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'mobile_sub_items_design',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_mobile_sub_item_f'   => array(
					'label_prefix' => esc_html__( 'Mobile Submenu Item (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li li a",
							'border_styles' => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li li a",
						),
						'hover' => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li li a:hover",
						'important' => 'plugin_only',
					),
					'defaults' => array(
						'border_radii' => 'on| | | | ',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_mobile_menu',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'mobile_sub_items_design',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_menu_toggle'   => array(
					'label_prefix' => esc_html__( 'Mobile Menu Toggle', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .dvmm_mobile_menu_toggle",
							'border_styles' => "{$this->main_css_element} .dvmm_mobile_menu_toggle",
						),
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
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_mobile_menu',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'menu_toggle_design',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_menu_toggle_f'   => array(
					'label_prefix' => esc_html__( 'Mobile Menu Toggle (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle",
							'border_styles' => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle",
						),
						'important' => 'plugin_only',
					),
					'defaults' => array(
						'border_radii' => 'on| | | | ',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_mobile_menu',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'     	=> 'menu_toggle_design',
					'sub_toggle'   		=> 'fixed',
				),
				'dvmm_search_btn'   => array(
					'label_prefix' => esc_html__( 'Search', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$dvmm_menu_inner_container} .dvmm_search__button",
							'border_styles' => "{$dvmm_menu_inner_container} .dvmm_search__button",
						),
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
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_search',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'search_design',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_search_btn_f'   => array(
					'label_prefix' => esc_html__( 'Search (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__button",
							'border_styles' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__button",
						),
						'important' => 'plugin_only',
					),
					'defaults'        => array(
						'border_radii'  => 'on| | | | ',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_search',
					),
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'search_design',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_cart_btn'   => array(
					'label_prefix' => esc_html__( 'Cart', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$dvmm_menu_inner_container} .dvmm_cart__button",
							'border_styles' => "{$dvmm_menu_inner_container} .dvmm_cart__button",
						),
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
					'depends_show_if'	=> 'on',
					'depends_on'      => array(
						'dvmm_enable_cart',
					),
					'tab_slug'		=> 'advanced',
					'toggle_slug'	=> 'cart_design',
					'sub_toggle'	=> 'normal',
				),
				'dvmm_cart_btn_f'   => array(
					'label_prefix' => esc_html__( 'Cart (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_cart__button",
							'border_styles' => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_cart__button",
						),
						'important' => 'plugin_only',
					),
					'defaults'        => array(
						'border_radii'  => 'on| | | | ',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					'depends_on'      => array(
						'dvmm_enable_cart',
					),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'cart_design',
					'sub_toggle'	=> 'fixed',
				),
				'dvmm_button_one'   => array(
					'label_prefix' 		=> esc_html__( 'Button One', 'dvmm-divi-mad-menu' ),
					'css'          		=> array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .dvmm_button_one",
							'border_styles' => "{$this->main_css_element} .dvmm_button_one",
						),
						'important' => 'plugin_only',
					),
					'defaults'        	=> array(
						'border_radii'  => 'on|3px|3px|3px|3px',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					'depends_on'      	=> array(
						'dvmm_enable_button_one',
					),
					// 'priority'			=> 120,			// DOESN'T WORK ???
					'tab_slug'     		=> 'advanced',
					'toggle_slug'  		=> 'button_one_design',
					'sub_toggle'   		=> 'normal',
				),
				'dvmm_button_one_f'   => array(
					'label_prefix' => esc_html__( 'Button One (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .dvmm_fixed .dvmm_button_one",
							'border_styles' => "{$this->main_css_element} .dvmm_fixed .dvmm_button_one",
						),
						'important' => 'plugin_only',
					),
					'defaults'        => array(
						'border_radii'  => 'on| | | | ',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					'depends_on'      => array(
						'dvmm_enable_button_one',
					),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'button_one_design',
					'sub_toggle'   => 'fixed',
				),
				'dvmm_button_two'   => array(
					'label_prefix' => esc_html__( 'Button Two', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .dvmm_button_two",
							'border_styles' => "{$this->main_css_element} .dvmm_button_two",
						),
						'important' => 'plugin_only',
					),
					'defaults'        => array(
						'border_radii'  => 'on|3px|3px|3px|3px',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					'depends_on'      => array(
						'dvmm_enable_button_two',
					),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'button_two_design',
					'sub_toggle'   => 'normal',
				),
				'dvmm_button_two_f'   => array(
					'label_prefix' => esc_html__( 'Button Two (Fixed)', 'dvmm-divi-mad-menu' ),
					'css'          => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .dvmm_fixed .dvmm_button_two",
							'border_styles' => "{$this->main_css_element} .dvmm_fixed .dvmm_button_two",
						),
						'important' => 'plugin_only',
					),
					'defaults'        => array(
						'border_radii'  => 'on| | | | ',
						'border_styles' => array(
							'width' => '',
							'color' => '',
							'style' => 'none',
						),
					),
					'depends_show_if'	=> 'on',
					'depends_on'      => array(
						'dvmm_enable_button_two',
					),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'button_two_design',
					'sub_toggle'   => 'fixed',
				),
			), // END BORDER FIELDS
			'box_shadow'	=> array(
				'default' 		  => false,
				'inner_container' => array(
					'label' => esc_html__( 'Main Box Shadow', 'dvmm-divi-mad-menu' ),
					'css' 	=> array(
						'main'    => "{$dvmm_menu_inner_container}",
						// 'overlay' => 'inset', // adds an overlay with shadow which applies on fixed header as well causing unwanted duplicate shadow
						'important' => 'plugin_only',
					),
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'box_shadow',
					'sub_toggle'   		=> 'normal',
				),
				'inner_container_f'   => array(
					'label'             => esc_html__( 'Fixed Main Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category'   => 'layout',
					'css'               => array(
						'main'    => "{$dvmm_menu_inner_container}.dvmm_fixed",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_fixed_header' => 'on',
					),
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'box_shadow',
					'sub_toggle'   		=> 'fixed',
				),
				'dvmm_submenu'	=> array(
					'label'           	=> esc_html__( 'Submenu Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category'	=> 'layout',
					'css'             	=> array(
						'main'    => "{$dvmm_menu_inner_container} .dvmm_menu__menu .dvmm_menu li ul",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_menu' => 'on',
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'     	=> 'submenu',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_submenu_f'	=> array(
					'label'           	=> esc_html__( 'Submenu Box Shadow (Fixed)', 'dvmm-divi-mad-menu' ),
					'option_category' 	=> 'layout',
					'css'             	=> array(
						'main'    => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_menu__menu .dvmm_menu li ul",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_menu' => 'on',
						'dvmm_enable_fixed_header' => 'on' // why box shadow is not being applied in VB with this condition ? FE is fine.
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'       => 'submenu',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_menu_toggle'	=> array(
					'label'           	=> esc_html__( 'Menu Toggle Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category'	=> 'layout',
					'css'             	=> array(
						'main'    => "{$this->main_css_element} .dvmm_mobile_menu_toggle",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_mobile_menu' => 'on',
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'     	=> 'menu_toggle_design',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_menu_toggle_f'	=> array(
					'label'           	=> esc_html__( 'Menu Toggle Box Shadow (Fixed)', 'dvmm-divi-mad-menu' ),
					'option_category' 	=> 'layout',
					'css'             	=> array(
						'main'    => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile_menu_toggle",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_mobile_menu' => 'on',
						'dvmm_enable_fixed_header' => 'on'
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'     	=> 'menu_toggle_design',
					'sub_toggle'   		=> 'fixed',
				),
				'dvmm_mobile_menu'	=> array(
					'label'           	=> esc_html__( 'Mobile Menu Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category'	=> 'layout',
					'css'             	=> array(
						'main'    => "{$this->main_css_element} .dvmm_mobile_menu_wrapper",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_mobile_menu' => 'on',
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'     	=> 'mobile_menu_design',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_mobile_menu_f'	=> array(
					'label'           	=> esc_html__( 'Mobile Menu Box Shadow (Fixed)', 'dvmm-divi-mad-menu' ),
					'option_category' 	=> 'layout',
					'css'             	=> array(
						'main'    => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile_menu_wrapper",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_mobile_menu' => 'on',
						'dvmm_enable_fixed_header' => 'on'
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'       => 'mobile_menu_design',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_mobile_item'	=> array(
					'label'           	=> esc_html__( 'Mobile Item Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category'	=> 'layout',
					'css'             	=> array(
						'main'    => "{$this->main_css_element} .dvmm_mobile__menu .dvmm_menu li a",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_mobile_menu' => 'on',
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'     	=> 'mobile_items_design',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_mobile_item_f'	=> array(
					'label'           	=> esc_html__( 'Mobile Item Box Shadow (Fixed)', 'dvmm-divi-mad-menu' ),
					'option_category' 	=> 'layout',
					'css'             	=> array(
						'main'    => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li a",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_mobile_menu' => 'on',
						'dvmm_enable_fixed_header' => 'on'
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'  		=> 'mobile_items_design',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_mobile_submenu'	=> array(
					'label'           	=> esc_html__( 'Mobile Submenu Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category'	=> 'layout',
					'css'             	=> array(
						'main'    => "{$this->main_css_element} .dvmm_mobile__menu .dvmm_menu li ul",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_mobile_menu' => 'on',
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'     	=> 'mobile_submenu_design',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_mobile_submenu_f'	=> array(
					'label'           	=> esc_html__( 'Mobile Submenu Box Shadow (Fixed)', 'dvmm-divi-mad-menu' ),
					'option_category' 	=> 'layout',
					'css'             	=> array(
						'main'    => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li ul",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_mobile_menu' => 'on',
						'dvmm_enable_fixed_header' => 'on'
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'  		=> 'mobile_submenu_design',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_mobile_sub_item'	=> array(
					'label'           	=> esc_html__( 'Mobile Submenu Item Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category'	=> 'layout',
					'css'             	=> array(
						'main'    => "{$this->main_css_element} .dvmm_mobile__menu .dvmm_menu li li a",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_mobile_menu' => 'on',
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'     	=> 'mobile_sub_items_design',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_mobile_sub_item_f'	=> array(
					'label'           	=> esc_html__( 'Mobile Submenu Item Box Shadow (Fixed)', 'dvmm-divi-mad-menu' ),
					'option_category' 	=> 'layout',
					'css'             	=> array(
						'main'    => "{$this->main_css_element} .dvmm_fixed .dvmm_mobile__menu .dvmm_menu li li a",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_mobile_menu' => 'on',
						'dvmm_enable_fixed_header' => 'on'
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'  		=> 'mobile_sub_items_design',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_item'	=> array(
					'label'           	=> esc_html__( 'Item Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category'	=> 'layout',
					'css'             	=> array(
						'main'    => "{$dvmm_menu_inner_container} .dvmm_menu__menu .dvmm_menu li a",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_menu' => 'on',
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'     	=> 'menu_items',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_item_f'	=> array(
					'label'           	=> esc_html__( 'Item Box Shadow (Fixed)', 'dvmm-divi-mad-menu' ),
					'option_category' 	=> 'layout',
					'css'             	=> array(
						'main'    => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_menu__menu .dvmm_menu li a",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_menu' => 'on',
						'dvmm_enable_fixed_header' => 'on'
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'     	=> 'menu_items',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_sub_item'	=> array(
					'label'           	=> esc_html__( 'Submenu Item Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category'	=> 'layout',
					'css'             	=> array(
						'main'    => "{$dvmm_menu_inner_container} .dvmm_menu__menu .dvmm_menu li li a",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_menu' => 'on',
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'     	=> 'submenu_items',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_sub_item_f'	=> array(
					'label'           	=> esc_html__( 'Submenu Item Box Shadow (Fixed)', 'dvmm-divi-mad-menu' ),
					'option_category' 	=> 'layout',
					'css'             	=> array(
						'main'    => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_menu__menu .dvmm_menu li li a",
						'important' => 'plugin_only',
					),
					'show_if'			=> array(
						'dvmm_enable_menu' => 'on',
						'dvmm_enable_fixed_header' => 'on'
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'     	=> 'submenu_items',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_logo'   => array(
					'label'           	=> esc_html__( 'Logo Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category' 	=> 'layout',
					'css'             	=> array(
						'main'    => "{$dvmm_menu_inner_container} .dvmm_logo",
						'important' => 'plugin_only',
					),
					'show_if'		  	=> array(
						'dvmm_enable_logo' => 'on',
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'     	=> 'logo_design',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_logo_f'   => array(
					'label'           	=> esc_html__( 'Logo (Fixed) Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category' 	=> 'layout',
					'css'             	=> array(
						'main'    => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_logo",
						'important' => 'plugin_only',
					),
					'show_if'		  	=> array(
						'dvmm_enable_logo' => 'on',
						'dvmm_enable_fixed_header' => 'on'
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'		=> 'logo_design',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_search_btn'   => array(
					'label'           	=> esc_html__( 'Search Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category' 	=> 'layout',
					'css'             	=> array(
						'main'    	=> "{$dvmm_menu_inner_container} .dvmm_search__button",
						'important' => 'plugin_only',
					),
					'show_if'		  	=> array(
						'dvmm_enable_search' => 'on',
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'     	=> 'search_design',
					'sub_toggle'		=> 'normal',
				),
				'dvmm_search_btn_f'   	=> array(
					'label'           	=> esc_html__( 'Search (Fixed) Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category' 	=> 'layout',
					'css'             	=> array(
						'main'    	=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_search__button",
						'important' => 'plugin_only',
					),
					'show_if'		  	=> array(
						'dvmm_enable_search' => 'on',
						'dvmm_enable_fixed_header' => 'on'
					),
					'tab_slug'        	=> 'advanced',
					'toggle_slug'     	=> 'search_design',
					'sub_toggle'		=> 'fixed',
				),
				'dvmm_cart_btn'   => array(
					'label'           => esc_html__( 'Cart Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category' => 'layout',
					'css'             => array(
						'main'    => "{$dvmm_menu_inner_container} .dvmm_cart__button",
						'important' => 'plugin_only',
					),
					'show_if'		  => array(
						'dvmm_enable_cart' => 'on',
					),
					'tab_slug'		=> 'advanced',
					'toggle_slug'	=> 'cart_design',
					'sub_toggle'	=> 'normal',
				),
				'dvmm_cart_btn_f'   => array(
					'label'           => esc_html__( 'Cart (Fixed) Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category' => 'layout',
					'css'             => array(
						'main'    => "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_cart__button",
						'important' => 'plugin_only',
					),
					'show_if'		  => array(
						'dvmm_enable_cart' => 'on',
						'dvmm_enable_fixed_header' => 'on'
					),
					'tab_slug'		=> 'advanced',
					'toggle_slug'	=> 'cart_design',
					'sub_toggle'	=> 'fixed',
				),
				'dvmm_button_one'   => array(
					'label'           => esc_html__( 'Button One Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category' => 'layout',
					'css'             => array(
						'main'    => "{$this->main_css_element} .dvmm_button_one",
						'important' => 'plugin_only',
					),
					'show_if'		  => array(
						'dvmm_enable_button_one' => 'on',
					),
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'button_one_design',
					'sub_toggle'   	  => 'normal',
				),
				'dvmm_button_one_f'   => array(
					'label'           => esc_html__( 'Button One (Fixed) Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category' => 'layout',
					'css'             => array(
						'main'    => "{$this->main_css_element} .dvmm_fixed .dvmm_button_one",
						'important' => 'plugin_only',
					),
					'show_if'		  => array(
						'dvmm_enable_button_one' => 'on',
						'dvmm_enable_fixed_header' => 'on'
					),
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'button_one_design',
					'sub_toggle'   	  => 'fixed',
				),
				'dvmm_button_two'   => array(
					'label'           => esc_html__( 'Button Two Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category' => 'layout',
					'css'             => array(
						'main'    => "{$this->main_css_element} .dvmm_button_two",
						'important' => 'plugin_only',
					),
					'show_if'		  => array(
						'dvmm_enable_button_two' => 'on',
					),
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'button_two_design',
					'sub_toggle'   	  => 'normal',
				),
				'dvmm_button_two_f'   => array(
					'label'           => esc_html__( 'Button Two (Fixed) Box Shadow', 'dvmm-divi-mad-menu' ),
					'option_category' => 'layout',
					'css'             => array(
						'main'    => "{$this->main_css_element} .dvmm_fixed .dvmm_button_two",
						'important' => 'plugin_only',
					),
					'show_if'		  => array(
						'dvmm_enable_button_two' => 'on',
						'dvmm_enable_fixed_header' => 'on'
					),
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'button_two_design',
					'sub_toggle'   	  => 'fixed',
				),
			), // END BOX-SHADOW FIELDS

			// Disable sticky options on Scroll Effects options group - @since v1.1.3
			'sticky' => false,

		);

		// remove default position option fields
		$advanced_fields['position_fields'] = false;

		// get the Menu Wrapper advanced fields
		$menu_wrapper_advanced_fields = self::menu_wrapper()->get_advanced_fields_config( $this );

		// get the CTA button(s) advanced fields
		// $button_advanced_fields = self::button()->get_advanced_fields_config();

		// merge fields arrays
		$advanced_fields = array_merge( 
			$advanced_fields,
			//$button_advanced_fields,
			$menu_wrapper_advanced_fields
		);

		return $advanced_fields;
	}

	/**
	 * Module's custom CSS fields configuration
	 *
	 * @since v1.0.0
	 *
	 * @return array
	 */
    public function get_custom_css_fields_config() {

		// module class
		$this->main_css_element = '%%order_class%%';

		// selectors
		$dvmm_menu_inner_container = "{$this->main_css_element} .dvmm_menu_inner_container";

		$custom_css_fields = array();

		// get the logo custom CSS fields
		$logo_custom_css_fields = self::logo()->get_custom_css_fields_config( $this );

		// get the search custom CSS fields
		$search_custom_css_fields = self::search()->get_custom_css_fields_config( $this );

		// get the cart custom CSS fields
		$cart_custom_css_fields = self::cart()->get_custom_css_fields_config( $this );

		// get the mobile menu toggle custom CSS fields
		$menu_toggle_custom_css_fields = self::mobile_menu()->mobile_menu_toggle()->get_custom_css_fields_config( $this );

		// get the mobile menu custom CSS fields - @since v1.8.0
		$mobile_menu_custom_css_fields = self::mobile_menu()->get_custom_css_fields_config( $this );

		// merge fields arrays
		$custom_css_fields = array_merge( 
			$custom_css_fields,
			$logo_custom_css_fields,
			$search_custom_css_fields,
			$cart_custom_css_fields,
			$menu_toggle_custom_css_fields,
			$mobile_menu_custom_css_fields
		);

		return $custom_css_fields;
    }

	/**
	 * Add the class with page ID to menu item so that 
	 * it can be easily found by ID in Visual Builder
	 * 
	 * @since	v1.0.0
	 *
	 * @return	object	Menu item
	 */
	static function modify_menu_item( $menu_item ) {

		// Convert to array(as of PHP 7.1.0, silent conversion to array is no longer supported)
		$menu_item->classes = (array) $menu_item->classes;

		// The class starting with "dvmm_menu_page_id-" is used to add the "current-menu-item" class to the menu item in Visual Builder
		if ( esc_url( home_url( '/' ) ) === $menu_item->url ) {
			$menu_custom_class = 'dvmm_menu_page_id-home';
		} else {
			$menu_custom_class = 'dvmm_menu_page_id-' . $menu_item->object_id;
		}

		// add the class to menu item classes
		$menu_item->classes[] = $menu_custom_class;
		
		return $menu_item;
	}

	/**
	 * Default menu.
	 * Creates the default menu displayed when no menus selected.
	 * 
	 * @since	v1.0.0
	 * 
	 * @param	string	$menuClass	CSS class of the menu.
	 * @return	string	$menu		The HTML of the default menu.
	 */
	static function default_menu( $menuClass = 'dvmm_menu' ){

		// menu html
		$menu = '';

		// Home item
		$home_item = '';

		// Home item CSS classes
		$home_class = is_home() ? 'home_item current_page_item' : 'home_item';

		if ( ! et_is_builder_plugin_active() && 'on' === et_get_option( 'divi_home_link' ) ){
			$home_item .= sprintf( 
				'<li class="%1$s">
					<a href="%2$s">%3$s</a>
				</li>',
				esc_attr( $home_class ),
				esc_url( home_url( '/' ) ),
				esc_html__( 'Home', 'dvmm-divi-mad-menu' )
			);
		} else {
			$home_item .= '';
		}

		// start menu
		$menu .= sprintf(
			'<ul class="%1$s">
				%2$s',
			esc_attr( $menuClass ),
			$home_item
		);

		ob_start();

		if ( et_is_builder_plugin_active() ) {
			// wp_page_menu();

			// remove extra <div> and <ul> wrappers 
			// because menu items are already being wrapped with <ul class="dvmm_menu"></ul> 
			wp_nav_menu( array (
				'container' => '',
				'items_wrap' => '%3$s',
			));
		} else {
			show_page_menu( $menuClass, false, false );
			show_categories_menu( $menuClass, false );
		}

		$menu .= ob_get_contents();

		$menu .= '</ul>';

		ob_end_clean();

		// return menu
		return $menu;
	}

	/**
	 * Get menu markup by its ID.
	 * 
	 * @since	v1.0.0
	 *
	 * @param	array	$args	Argumets.
	 * @return	string			Menu markup (<ul>...</ul>).
	 */
	static function get_the_menu( $args = array() ) {

		$defaults = array(
			'menu_id' => '',
		);

		// modify the menu item to include the required data
		add_filter( 'wp_setup_nav_menu_item', array( 'DVMM_MadMenu', 'modify_menu_item' ) );

		$args      = wp_parse_args( $args, $defaults );
		$menu = '';

		// menu classes (<ul></ul>)
		$menuClass = "dvmm_menu dvmm_menu--{$args['menu_id']}";

		/**
		 * Menu arguments.
		 * If no menu ID provided then 
		 * the menu assigned to the 'primary-menu' location will be displayed.
		 */
		$menu_args = array(
			'theme_location' => 'primary-menu',
			'container'      => '',
			'fallback_cb'    => '',
			'menu_class'     => $menuClass,
			'menu_id'        => '',
			'echo'           => false,
			'walker'		 => self::walker_nav_menu( $args ),
		);

		if ( '' !== $args['menu_id'] ) {
			$menu_args['menu'] = (int) $args['menu_id'];
		}

		$filter     = 'dvmm_menu_args';
		$navMenu 	= wp_nav_menu( apply_filters( $filter, $menu_args ) );

		/**
		 * Display the default menu if no menu has been selected
		 * (the menu ID is 'none').
		 */
		if ( empty( $navMenu ) || $args['menu_id'] === 'none' ) {
			// use the default menu
			$menu .= self::default_menu( $menuClass );
		} else {
			// use the selected menu (even if it has no items)
			$menu .= $navMenu;
		}

		remove_filter( 'wp_setup_nav_menu_item', array( 'DVMM_MadMenu', 'modify_menu_item' ) );

		return $menu;
	}

	/**
	 * Generate all menus HTML for the computed field (__menu).
	 * Used in the Divi Builder for menu selection.
	 * 
	 * @since	v1.0.0
	 * @todo TBR (@since v1.3.4)
	 * 
	 * @return	array	$menus	Array of all existing menus including the default menu.
	 */
	static function get_all_menus_html(){

		// menus array
		$menus = [];

		// default menu (for the 'none' value -> the 'Select a menu' option)
		$default = '';

		// menu CSS class (for the default menu)
		$menuClass = "dvmm_menu dvmm_menu--default"; 

		// get all navigation menus
		$nav_menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );

		// populate the navigation menus array ('menu ID' => 'menu html')
		foreach ( (array) $nav_menus as $_nav_menu ) {
			// get menu id
			$menu_id = $_nav_menu->term_id;

			// get the menu by its id 
			$menu = self::get_the_menu( array(
				'menu_id' => $menu_id,
			) );
			// add to menus array
			$menus[$menu_id] = $menu;
		}

		// get the default menu HTML
		$default = self::default_menu( $menuClass );

		// add the default menu to menus array with the 'none' key
		$menus['none'] = $default;

		return $menus;

	}

	/**
	 * Miscellaneous CSS styles.
	 * 
	 * @since	v1.0.0
	 * 
	 * @param	object	$module				Module object.
	 * @param	string	$render_slug		Module slug.
	 * @param	string	$processed_props	Processed props.
	 */
	public static function miscCss( $module, $render_slug, $processed_props ){

		// PROCESSED PROPS
		$module_order_class = isset($processed_props['module_order_class']) ? $processed_props['module_order_class'] : '';

		// SELECTORS
		$dvmm_menu_inner_container = "{$module->main_css_element} .dvmm_menu_inner_container";

		// Main margin
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_main_margin',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element}",
				'normal_hover'	=> "{$module->main_css_element}:hover",
			),
			'property' 			=> 'margin',
			'additional_css'	=> ' !important;',
			'field_type'		=> 'custom_margin',
			'priority'			=> ''
		));		

		// Main padding
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_main_padding',
			'setting_fixed'		=> 'dvmm_main_padding_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$dvmm_menu_inner_container}",
				'normal_hover'	=> "{$dvmm_menu_inner_container}:hover",
				'fixed'			=> "{$dvmm_menu_inner_container}.dvmm_fixed",
				'fixed_hover'	=> "{$dvmm_menu_inner_container}.dvmm_fixed:hover",
			),
			'property' 			=> 'padding',
			'additional_css'	=> '',
			'field_type'		=> 'custom_padding',
			'priority'			=> ''
		));

		// Main Background Color (fixed)
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting_fixed' 	=> 'dvmm_background_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'fixed'			=> "{$module->main_css_element}.dvmm_fixed_active",
				'fixed_hover'	=> "{$module->main_css_element}.dvmm_fixed_active:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> 'color-alpha',
			'priority'			=> ''
		));

		/**
		 * Main Transitions 
		 * (inner container, dvmm_placeholder (No Content Overlap option) and cart).
		 * For some reason not all CSS properties are included into the 'transition' rule (like 'padding'),
		 * so, the code below is intended to fix the issue.
		 * The "dvmm_transitions--on" class is added using JS on menu hover or page scroll.
		 */
		$module->helpers()->declare_responsive_transition_styles($module, $render_slug, array(
			'properties' 	 => array('all'),
			'selector'		 => ".{$module_order_class}.dvmm_transitions--on, .{$module_order_class}.dvmm_placeholder, {$module->main_css_element}.dvmm_transitions--on .dvmm_cart_icon",
			'additional_css' => 'important',
		));
		
		// Elements alignment
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_elements_alignment',
			'selector' 			=> "{$dvmm_menu_inner_container} .dvmm_content",
			'property' 			=> 'justify-content',
			'additional_css'	=> '',
			'field_type'		=> 'select',
			'priority'			=> ''
		));

		/**
		 * Inner Container overflow-x
		 * (uses module's default Horizontal Overflow setting)
		 * @since v1.3.4
		 */
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'overflow-x',
			'selector' 			=> "{$dvmm_menu_inner_container}",
			'property' 			=> 'overflow-x',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		/**
		 * Inner Container overflow-y
		 * (uses module's default Vertical Overflow setting)
		 * @since v1.3.4
		 */
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'overflow-y',
			'selector' 			=> "{$dvmm_menu_inner_container}",
			'property' 			=> 'overflow-y',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

	}

	/**
	 * Render
	 * 
	 * @since	v1.0.0
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
		$dvmm_h_menu_id = $this->helpers()->get_property_values_all( $this->props, 'dvmm_h_menu_id', 'none', true );
		$dvmm_m_menu_id = $this->helpers()->get_property_values_all( $this->props, 'dvmm_m_menu_id', 'none', true );
		$menu_breakpoint		= $this->helpers()->process_breakpoint_value( $this->props, 'menu_breakpoint' );
		$mobile_menu_breakpoint	= $this->helpers()->process_breakpoint_value( $this->props, 'mobile_menu_breakpoint' );
		$collapse_submenus 		= isset($this->props['collapse_submenus']) ? $this->props['collapse_submenus'] : 'off';
		$mobile_parent_links	= isset($this->props['mobile_parent_links']) ? $this->props['mobile_parent_links'] : 'disabled';
		$accordion_mode			= isset($this->props['accordion_mode']) ? $this->props['accordion_mode'] : 'off';

		// dropdown direction
		$dd_direction = isset($this->props['dvmm_dd_direction']) ? $this->props['dvmm_dd_direction'] : 'downwards';

		// get the fixed header values (devices, hover and responsive) array with $force_return = true (return any value)
		$fixed_header 	= $this->helpers()->get_property_values_all( $this->props, 'dvmm_fixed_header', 'none', true );
		$is_fixed_enabled	= $this->props['dvmm_enable_fixed_header'] === 'on' && ( $fixed_header['desktop'] !== 'none' || $fixed_header['tablet'] !== 'none' || $fixed_header['phone'] !== 'none' ) ? true : false;

		// which elements to hide when search form appears
		$dvmm_search_hide_elems = isset($this->props['dvmm_search_hide_elems']) ? $this->props['dvmm_search_hide_elems'] : 'off|off|off|off';

		// Desktop menu element visibility value
		$dvmm_show_menu 	= $this->helpers()->get_property_values_all( $this->props, 'dvmm_show_menu', 'none', true );

		// Mobile menu element visibility value
		$dvmm_show_mobile_menu 	= $this->helpers()->get_property_values_all( $this->props, 'dvmm_show_mobile_menu', 'none', true );

		// Is DB Plugin active (@since v1.3.3)
		$is_dbp = et_is_builder_plugin_active();

		// The 'additional_css' value (the !important). Add '!important' if DB Plugin is active. Need to override some default CSS applied by the DB Plugin.
		$additional_css = $is_dbp ? ' !important;' : '';

		/**
		 * PROPCESSED PROPS
		 */
		$processed_props = array(
			'dvmm_h_menu_id'		=> $dvmm_h_menu_id,
			'dvmm_m_menu_id'		=> $dvmm_m_menu_id,
			'menu_breakpoint' 		=> $menu_breakpoint,
			'mobile_menu_breakpoint' => $mobile_menu_breakpoint,
			'collapse_submenus'		=> $collapse_submenus,
			'mobile_parent_links' 	=> $mobile_parent_links,
			'accordion_mode'		=> $accordion_mode,
			'dd_direction'			=> $dd_direction,
			'module_order_class'	=> $module_order_class,
			'module_classname'		=> $this->module_classname( $render_slug ),
			'fixed_header'			=> $fixed_header,
			'is_fixed_enabled'		=> $is_fixed_enabled,
			'dvmm_search_hide_elems'=> $dvmm_search_hide_elems,
			'dvmm_show_menu'		=> $dvmm_show_menu,
			'dvmm_show_mobile_menu'	=> $dvmm_show_mobile_menu,
			'is_dbp'				=> $is_dbp,
			'additional_css'		=> $additional_css,
		);

		/**
		 * INLINE JS SCRIPT - @since v1.6
		 */
		$button_one_inline_script_data = self::popups()->inline_script_data( $this, $processed_props, $render_slug, 'button_one' );
		$button_two_inline_script_data = self::popups()->inline_script_data( $this, $processed_props, $render_slug, 'button_two' );
		// Mobile Menu element data - @since v1.8.0
		$mobile_menu_inline_script_data = self::mobile_menu()->inline_script_data( $this, $processed_props, $render_slug, 'mobile_menu' );

		// 
		$button_one_data = $button_one_inline_script_data !== '' ? "$button_one_inline_script_data," : '';
		$button_two_data = $button_two_inline_script_data !== '' ? "$button_two_inline_script_data," : '';
		$mobile_menu_data = $mobile_menu_inline_script_data !== '' ? "$mobile_menu_inline_script_data," : '';

		// If any inline scripts data available
		$any_script_data = $button_one_data === '' && $button_two_data === '' && $mobile_menu_data === '' ? false : true;

		// All inline script data
		$inline_script = $any_script_data === true ? sprintf('var %1$s_inline_script_data = {%2$s%3$s%4$s}', 
			esc_attr( $module_order_class ),			// %1$s	
			et_core_esc_previously( $button_one_data ),	// %2$s
			et_core_esc_previously( $button_two_data ),	// %3$s
			et_core_esc_previously( $mobile_menu_data )	// %4$s
		) : '';

		// Add the inline script
		if ($inline_script !== ''){
			wp_add_inline_script( "divi-mad-menu-frontend-bundle", $inline_script, 'before' );
		}

		/**
		 * CSS
		 */
		// add Logo CSS
		self::logo()->css( $this, $render_slug );

		// add Menu Wrapper CSS
		self::menu_wrapper()->css( $this, $render_slug );

		// add Mobile Menu Wrapper CSS
		self::mobile_menu_wrapper()->css( $this, $render_slug );

		// add Horizontal Menu CSS
		self::horizontal_menu()->css( $this, $render_slug );

		// add Mobile Menu Toggle css
		self::mobile_menu()->mobile_menu_toggle()->css( $this, $processed_props, $render_slug );

		// add Mobile Menu Wrapper css
		self::mobile_menu()->css( $this, $render_slug );

		// add Search CSS
		self::search()->css( $this, $render_slug );

		// add Cart CSS
		self::cart()->css( $this, $render_slug );

		// add misc CSS
		self::miscCss( $this, $render_slug, $processed_props );

		/**
		 * CSS CLASSES
		 */
		// get the menu inner container classes
		$inner_container_classes = implode(' ', self::menu_inner_container()->css_classes( $processed_props ) );

		/**
		 * DATA ATTRIBUTES
		 */
		// get the menu inner container data attributes
		$inner_container_data_attrs = implode(' ', self::menu_inner_container()->data_attributes( $this, $processed_props ) );

		/**
		 * STYLE
		 */
		// get the module styles
		$module_styles = self::styles()->styles( $processed_props );

		/**
		 * ELEMENTS
		 */
		// get the menu wrapper.
		$menu_wrapper = self::menu_wrapper()->render( $this, $processed_props, $render_slug );

		// get the mobile menu wrapper.
		$mobile_menu_wrapper = self::mobile_menu_wrapper()->render( $this, $processed_props, $render_slug );

		// get the logo.
		$logo = self::logo()->render( $this, $processed_props, $render_slug );

		// get the search button.
		$search_button = self::search()->render_search( $this, $processed_props, $render_slug );

		// get the search form.
		$search_form = self::search()->render_search_form( $this, $processed_props, $render_slug );

		// get the shopping cart button.
		$cart_button = self::cart()->render_cart( $this, $processed_props, $render_slug );

		// get the buttons.
		$button_one = self::button()->render( $this, $processed_props, $render_slug, 'button_one' );
		$button_two = self::button()->render( $this, $processed_props, $render_slug, 'button_two' );

		/**
		 * MENU HTML OUTPUT
		 */
		$output = sprintf(
			'%1$s
			<div class="%2$s" %3$s>
				<div class="dvmm_content">
					%4$s
					%5$s
					%6$s
					%7$s
					%8$s
					%9$s
					%10$s
					%11$s
				</div>
			</div>',
			$module_styles,
			esc_attr( $inner_container_classes ),
			$inner_container_data_attrs,
			et_core_esc_previously( $logo ),
			et_core_esc_previously( $menu_wrapper ),
			et_core_esc_previously( $mobile_menu_wrapper ),
			et_core_esc_previously( $search_button ),
			et_core_esc_previously( $search_form ),
			et_core_esc_previously( $cart_button ),
			et_core_esc_previously( $button_one ),
			et_core_esc_previously( $button_two )
		);

		return $output;
	}
}

new DVMM_MadMenu;