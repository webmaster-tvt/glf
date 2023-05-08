<?php

// Die if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Logo.
 * 
 * Generates the menu logo element.
 *
 * @since   1.0.0 
 * 
 */
class DVMM_Menu_Logo {

    /**
     * Props.
     * 
     * @since   1.0.0
     * 
     */
    public $props = array();

    /**
     * Returns instance of the class.
     * 
     * @since   1.0.0
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
	 * Fields.
	 * 
	 * @since	v1.0.0 
	 * 
	 * @param	object	$module		Module.
	 * 
	 */
	public function get_fields( $module ) {
        $fields = array(
            'dvmm_enable_logo' => array(
				'label'				=> esc_html__( 'Enable Logo', 'dvmm-divi-mad-menu' ),
				'description'		=> esc_html__( 'Add the logo element to the header.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'yes_no_button',
				'option_category' 	=> 'configuration',
				'options'         	=> array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'affects' 			=> array(
					'border_radii_dvmm_logo',
					'border_radii_dvmm_logo_f',
				),
				'default'			=> 'off',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'header_elements',
			),
			'dvmm_logo_img' => array(
				'label'             => esc_html__( 'Logo', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Upload an image to display beside your menu.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'upload',
				'option_category'	=> 'basic_option',
				'show_if'			=> array(
					'dvmm_enable_logo' => 'on',
				),
				'mobile_options'    => true,
				'hover'             => 'tabs',
				'upload_button_text'=> esc_attr__( 'Upload an image', 'dvmm-divi-mad-menu' ),
				'choose_text'       => esc_attr__( 'Choose an Image', 'dvmm-divi-mad-menu' ),
				'update_text'       => esc_attr__( 'Set As Logo', 'dvmm-divi-mad-menu' ),
				'dynamic_content'   => 'image',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'logo',
			),
			'dvmm_use_fixed_logo' => array(
				'label'				=> esc_html__( 'Use Fixed Header Logo', 'dvmm-divi-mad-menu' ),
				'description'		=> esc_html__( 'Use a different logo for the fixed header.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'yes_no_button',
				'option_category' 	=> 'configuration',
				'show_if'			=> array(
					'dvmm_enable_logo' 			=> 'on',
					'dvmm_enable_fixed_header' 	=> 'on',
				),
				'options'         	=> array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'			=> 'off',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'logo',
			),
			'dvmm_logo_img_f' => array(
				'label'             => esc_html__( 'Logo (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Upload the fixed header logo image.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'upload',
				'option_category'	=> 'basic_option',
				'show_if'			=> array(
					'dvmm_enable_logo' 		 	=> 'on',
					'dvmm_enable_fixed_header' 	=> 'on',
					'dvmm_use_fixed_logo' 		=> 'on',
				),
				'mobile_options'    => true,
				'hover'             => 'tabs',
				'upload_button_text'=> esc_attr__( 'Upload an image', 'dvmm-divi-mad-menu' ),
				'choose_text'       => esc_attr__( 'Choose an Image', 'dvmm-divi-mad-menu' ),
				'update_text'       => esc_attr__( 'Set As Logo', 'dvmm-divi-mad-menu' ),
				'dynamic_content'   => 'image',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> 'logo',
			),
			'dvmm_logo_url' => array(
				'label'           	=> esc_html__( 'Logo Link URL', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'If you would like to make your logo a link, input your destination URL here.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'text',
				'option_category' 	=> 'basic_option',
				'show_if'			=> array(
					'dvmm_enable_logo' => 'on',
				),
				'dynamic_content' 	=> 'url',
				'tab_slug'         	=> 'general',
				'toggle_slug'     => 'logo',
			),
			'dvmm_logo_url_new_window' => array(
				'label'           	=> esc_html__( 'Logo Link Target', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Here you can choose whether or not your link opens in a new window', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category' 	=> 'configuration',
				'show_if'			=> array(
					'dvmm_enable_logo' => 'on',
				),
				'options'         	=> array(
					'off' => esc_html__( 'In The Same Window', 'dvmm-divi-mad-menu' ),
					'on'  => esc_html__( 'In The New Tab', 'dvmm-divi-mad-menu' ),
				),
				'default_on_front'	=> 'off',
				'tab_slug'         	=> 'general',
				'toggle_slug'     => 'logo',
			),
			'dvmm_logo_alt' => array(
				'label'           	=> esc_html__( 'Logo Alt Text', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Define the HTML ALT text for your logo here.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'text',
				'option_category' 	=> 'basic_option',
				'show_if'			=> array(
					'dvmm_enable_logo' => 'on',
				),
				'dynamic_content' 	=> 'text',
				'tab_slug'        => 'custom_css',
				'toggle_slug'     => 'attributes',
			),
			'dvmm_logo_order' => array(
				'label'			=> esc_html__( 'Logo Order', 'dvmm-divi-mad-menu' ),
				'description'	=> esc_html__( 'Here you can set the element order. Element order is set relatively to other enabled elements, a higher order number moves the element closer to the right hand side of the header.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'range',
                'mobile_options'	=> true,
                'responsive'		=> true,
				'option_category'	=> 'layout',
				'show_if'			=> array(
					'dvmm_enable_logo' => 'on',
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
			'dvmm_logo_margin' => array(
				'label'             => esc_html__('Logo Margin', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_logo' => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'default'           => '0px|5px|0px|5px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'logo_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_logo_margin_f' => array(
				'label'             => esc_html__('Logo Margin (Fixed)', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         => array(
					'dvmm_enable_fixed_header' => 'on',
					'dvmm_enable_logo' => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				// 'default'           => '0px|5px|0px|5px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'logo_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_logo_padding' => array(
				'label'             => esc_html__('Logo Padding', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_logo' => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'logo_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_logo_padding_f' => array(
				'label'             => esc_html__('Logo Padding (Fixed)', 'dvmm-divi-mad-menu'),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'show_if'         	=> array(
					'dvmm_enable_fixed_header' => 'on',
					'dvmm_enable_logo' => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				// 'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'logo_design',
				'sub_toggle'		=> 'fixed',
			),
			'dvmm_logo_bg_color' => array(
				'label'           	=> esc_html__( 'Logo Background Color', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the logo background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_logo'	=> 'on',
				),
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'logo_design',
				'sub_toggle'		=> 'normal',
			),
			'dvmm_logo_bg_color_f' => array(
				'label'           	=> esc_html__( 'Logo Background Color (Fixed)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Set the fixed header logo background color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					'dvmm_enable_logo'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> 'logo_design',
				'sub_toggle'		=> 'fixed',
			),
		);

		/**
		 * Add the element column layout fields.
		 * 
		 * dvmm_logo_col_width
		 * dvmm_logo_col_width_f
		 * dvmm_logo_col_max_width
		 * dvmm_logo_col_max_width_f
		 */
		$element_column_layout_fields = $module->helpers()->add_element_column_layout_fields( 
			array(
				'element_name' 	=> "Logo",
				'element_slug' 	=> "logo",
				'tab_slug'		=> 'advanced',
				'toggle_slug'	=> 'elements_layout',
				'sub_toggle'	=> 'logo',
			)
		);

		/**
		 * Add the element column design fields.
		 * 
		 * dvmm_logo_col_bg_color
		 * dvmm_logo_col_bg_color_f
		 */
		$element_column_design_fields = $module->helpers()->add_element_column_design_fields( 
			array(
				'element_name' 	=> "Logo",
				'element_slug' 	=> "logo",
				'tab_slug'		=> 'advanced',
				'toggle_slug'	=> 'logo_design',
			)
		);

		/**
		 * Add the element alignment fields.
		 * 
		 * dvmm_logo_vertical_alignment
		 * dvmm_logo_vertical_alignment_f
		 * dvmm_logo_horizontal_alignment
		 * dvmm_logo_horizontal_alignment_f
		 */
		$element_fields = $module->helpers()->add_element_alignment_fields( 
			array(
				'element_name' 		 => "Logo",
				'element_slug' 		 => "logo",
				'setting_base' 		 => "logo",
				'vertical_options' 	 => "general",
				'horizontal_options' => "logo",
				'tab_slug'			 => 'advanced',
				'toggle_slug'		 => 'elements_layout',
				'sub_toggle'		 => 'logo',
			)
		);

		/**
		 * Add the element warning fields.
		 * 
		 * dvmm_logo_disabled__layout
		 * dvmm_logo_disabled__layout_f
		 */
		$element_warning_fields = $module->helpers()->add_element_warning_fields( 
			array(
				'element_name' 	=> "Logo",
				'element_slug' 	=> "logo",
				// 'tab_slug'		=> 'advanced',
				// 'toggle_slug'	=> 'elements_layout',
			)
		);

		// merge fields arrays
		$fields = array_merge(
			$element_fields,
			$element_column_layout_fields,
			$element_column_design_fields,
			$element_warning_fields,
			$fields
		);

        return $fields;
    }

    // Advanced fields
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
	 * @return array
	 */
    public function get_custom_css_fields_config( $module ) {

		// selectors
		$dvmm_menu_inner_container = "{$module->main_css_element} .dvmm_menu_inner_container";

		$custom_css_fields = array(
			'dvmm_logo_img_css' => array(
				'label'    	=> esc_html__( 'Logo Image', 'dvmm-divi-mad-menu' ),
				'selector' 	=> "{$dvmm_menu_inner_container} .dvmm_logo img",
				'show_if'	=> array(
					'dvmm_enable_logo'	=> 'on',
				),
			),
			'dvmm_logo_img_css_f' => array(
				'label'    	=> esc_html__( 'Logo Image (Fixed)', 'dvmm-divi-mad-menu' ),
				'selector' 	=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_logo img",
				'show_if'	=> array(
					'dvmm_enable_logo'	=> 'on',
					'dvmm_enable_fixed_header' => 'on',
				),
			),
		);

		return $custom_css_fields;
    }

	/**
	 * Manage the logo wrapper classes.
	 * Manages the CSS classes of the '.dvmm_logo__wrap' element.
	 * 
	 * @since   v1.0.0
	 * 
	 * @param	object	$module				Module object.
     * @param   array	$processed_props	Processed props.
	 * 
	 * @return	array						Logo wrapper CSS classes.
	 */
	public function manage_logo_wrap_classes( $module, $processed_props ){

		// props
		$is_fixed_enabled = $processed_props['is_fixed_enabled'];
		$use_fixed_logo = $module->props['dvmm_use_fixed_logo'];

		// logo wrapper classes array (.dvmm_logo__wrap)
		$logo_wrap_classes = ['dvmm_element', 'dvmm_logo__wrap'];

		// Maybe hide this element when search form appears
		$search_hide_elems_class = $module->helpers()->maybe_hide_element_when_search_opens($module->props, 'logo');

		// add fixed header logo class if enabled
		if( $is_fixed_enabled === true && $use_fixed_logo === 'on' ){
			$use_fixed_logo_class = 'dvmm_fixed_header_logo_enabled';
			$logo_wrap_classes[] = $use_fixed_logo_class;
		}

		// add to logo wrapper classes array
		$logo_wrap_classes[] = $search_hide_elems_class;

		return $logo_wrap_classes;
	}

	/**
	 * Logo CSS styles.
	 * 
	 * @since	v1.0.0
	 * 
	 * @param	object	$module			Module object.
	 * @param	string	$render_slug	Module slug.
	 */
	public function css( $module, $render_slug ){

		// SELECTORS
		$dvmm_menu_inner_container = "{$module->main_css_element} .dvmm_menu_inner_container";
		$dvmm_logo__wrap = "{$module->main_css_element} .dvmm_logo__wrap";

		// Logo order (range)
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_logo_order',
			'selector' 			=> $dvmm_logo__wrap,
			'property' 			=> 'order',
			'additional_css'	=> '',
			'field_type'		=> '', // don't set for 'range' field type
			'priority'			=> ''
		));

		// Logo column width
		$module->helpers()->declare_element_column_width_css( $module->props, $render_slug, array( 
			'setting' 		=> 'dvmm_logo_col_width',
			'setting_fixed'	=> 'dvmm_logo_col_width_f',
			'selector' 		=> array(
				'normal'	=> "{$module->main_css_element} .dvmm_logo__wrap",
				'fixed'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_logo__wrap",
			),
		));

		// Logo column max-width
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_logo_col_max_width',
			'setting_fixed'		=> 'dvmm_logo_col_max_width_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'	=> "{$module->main_css_element} .dvmm_logo__wrap",
				'fixed'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_logo__wrap",
			),
			'property' 			=> 'max-width',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Logo column background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_logo_col_bg_color',
			'setting_fixed'		=> 'dvmm_logo_col_bg_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_logo__wrap",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_logo__wrap:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_logo__wrap",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_logo__wrap:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Logo vertical alignment
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_logo_vertical_alignment',
			'setting_fixed'		=> 'dvmm_logo_vertical_alignment_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'	=> "{$module->main_css_element} .dvmm_logo__wrap",
				'fixed'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_logo__wrap",
			),
			'property' 			=> 'align-items',
			'additional_css'	=> '',
			'field_type'		=> 'select',
			'priority'			=> ''
		));

		// Logo horizontal alignment
		$module->helpers()->declare_element_content_horizontal_alignment_css( $module->props, $render_slug, array( 
			'setting' 		=> 'dvmm_logo_horizontal_alignment',
			'setting_fixed'	=> 'dvmm_logo_horizontal_alignment_f',
			'selector' 		=> array(
				'normal'			=> "{$module->main_css_element} .dvmm_logo__wrap", // container
				'normal_stretch'	=> "{$module->main_css_element} .dvmm_logo__wrap .dvmm_logo", // item(content)
				'fixed'				=> "{$module->main_css_element} .dvmm_fixed .dvmm_logo__wrap",
				'fixed_stretch'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_logo__wrap .dvmm_logo",
			),
		));

		// Logo margin
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_logo_margin',
			'setting_fixed'		=> 'dvmm_logo_margin_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$dvmm_menu_inner_container} .dvmm_logo",
				'normal_hover'	=> "{$dvmm_menu_inner_container} .dvmm_logo:hover",
				'fixed'			=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_logo",
				'fixed_hover'	=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_logo:hover",
			),
			'property' 			=> 'margin',
			'additional_css'	=> '',
			'field_type'		=> 'custom_margin',
			'priority'			=> ''
		));	
		// Logo padding
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_logo_padding',
			'setting_fixed'		=> 'dvmm_logo_padding_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$dvmm_menu_inner_container} .dvmm_logo",
				'normal_hover'	=> "{$dvmm_menu_inner_container} .dvmm_logo:hover",
				'fixed'			=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_logo",
				'fixed_hover'	=> "{$dvmm_menu_inner_container}.dvmm_fixed .dvmm_logo:hover",
			),
			'property' 			=> 'padding',
			'additional_css'	=> '',
			'field_type'		=> 'custom_padding',
			'priority'			=> ''
		));

		// Logo background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> 'dvmm_logo_bg_color',
			'setting_fixed'		=> 'dvmm_logo_bg_color_f',
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_logo",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_logo:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_logo",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_logo:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));
	}

    /**
     * Render the logo.
     * 
     * @since   v1.0.0
     * 
     * @param   array       $module             Module object.
     * @param   array       $processed_props	Processed props.
     * @param   string      $render_slug        Module slug.
	 * 
     * @return  string      $logo               Logo markup.
     */
    public function render( $module, $processed_props, $render_slug ) {

		// normal header logo
        $multi_view          = et_pb_multi_view_options( $module );
		$logo_alt            = $module->props['dvmm_logo_alt'];
		$logo_url            = $module->props['dvmm_logo_url'];
		$logo_url_new_window = $module->props['dvmm_logo_url_new_window'];
		$logo_html = $multi_view->render_element( array(
			'tag'            => 'img',
			'attrs'          => array(
				'src' => '{{dvmm_logo_img}}',
				'alt' => $logo_alt,
			),
			'classes'		 => array(
				'dvmm_logo_img' => array(
					'dvmm_enable_logo' => 'on'
				)
			),
			'required'       => array(
                'dvmm_enable_logo' => 'on'
            ),
			'hover_selector' => '%%order_class%% .dvmm_menu_inner_container .dvmm_logo',
		) );

		// fixed header logo
		$multi_view_f	= et_pb_multi_view_options( $module );
		$logo_alt_f		= $module->props['dvmm_logo_alt'];
		$logo_html .= $multi_view_f->render_element( array(
			'tag'            => 'img',
			'attrs'          => array(
				'src' => '{{dvmm_logo_img_f}}',
				'alt' => $logo_alt_f,
			),
			'classes'		 => array(
				'dvmm_logo_img__fixed' => array(
					'dvmm_enable_logo' 	  		=> 'on',
					'dvmm_enable_fixed_header' 	=> 'on',
					'dvmm_use_fixed_logo' 		=> 'on'
				)
			),
			'required'       => array(
				'dvmm_enable_logo' 	  		=> 'on',
				'dvmm_enable_fixed_header' 	=> 'on',
				'dvmm_use_fixed_logo' 		=> 'on'
			),
			'hover_selector' => '%%order_class%% .dvmm_menu_inner_container.dvmm_fixed .dvmm_logo',
		) );

		if ( empty( $logo_html ) ) {
			return '';
		}

		if ( ! empty( $logo_url ) ) {
			$target = ( 'on' === $logo_url_new_window ) ? 'target="_blank"' : '';

			$logo_html = sprintf(
				'<a href="%1$s" %2$s>%3$s</a>',
				esc_url( $logo_url ),
				et_core_intentionally_unescaped( $target, 'fixed_string' ),
				et_core_esc_previously( $logo_html )
			);
		}

		// get logo wrapper classes (.dvmm_logo__wrap)
		$logo_wrap_classes = implode(' ', $this->manage_logo_wrap_classes( $module, $processed_props ) );

		$logo_html = sprintf(
			'<div class="%2$s">
			  <div class="dvmm_logo">
				%1$s
			  </div>
			</div>',
			$logo_html,
            esc_attr( $logo_wrap_classes )
		);

		// check if the logo image field has any value (desktop, hover, tablet and/or phone)
		return $multi_view->has_value('dvmm_logo_img') || $multi_view_f->has_value('dvmm_logo_img_f') ? $logo_html : '';
    }
	
}

/**
 * Intstantiates the DVMM_Menu_Logo class.
 * 
 * @since   1.0.0
 * 
 * @return  Instance of the DVMM_Menu_Logo class.
 * 
 */
function dvmm_menu_logo_class_instance() {
	return DVMM_Menu_Logo::instance();
}
