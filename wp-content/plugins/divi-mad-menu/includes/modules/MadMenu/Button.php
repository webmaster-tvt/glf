<?php

// Die if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Button(s).
 * 
 * Generates the button(s).
 *
 * @since   1.0.0 
 * 
 */
class DVMM_Menu_CTA_Button {

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
	 * @param	object	$module			Module.
	 * @param	string	$button_name	Rendered button name. Must be either 'button_one' or 'button_two'.
	 * @param	string	$button_label	Rendered button label. Eg. 'Button One' or 'Button Two'.
	 */
	public function get_fields( $module, $button_name = 'button', $button_label = 'Button' ) {

        $fields = array(
			"dvmm_enable_{$button_name}" => array(
				'label'           => sprintf( esc_html__( 'Enable %1$s', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     => esc_html__( 'Add the button element to the header.', 'dvmm-divi-mad-menu' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
                'affects'   => array(
					// normal
					"dvmm_{$button_name}_font",
					"dvmm_{$button_name}_text_color",
					"dvmm_{$button_name}_font_size",
					"dvmm_{$button_name}_letter_spacing",
					"dvmm_{$button_name}_line_height",

					// text shadow fields do not get hidden, apparently there is a bug, so, disable them for now
					// https://github.com/elegantthemes/create-divi-extension/issues/372
					// "dvmm_{$button_name}_text_shadow_style",
					// "dvmm_{$button_name}_text_shadow_horizontal_length",
					// "dvmm_{$button_name}_text_shadow_vertical_length",
					// "dvmm_{$button_name}_text_shadow_blur_strength",
					// "dvmm_{$button_name}_text_shadow_color",
					// fixed
					"dvmm_{$button_name}_f_font",
					"dvmm_{$button_name}_f_text_color",
					"dvmm_{$button_name}_f_font_size",
					"dvmm_{$button_name}_f_letter_spacing",
					"dvmm_{$button_name}_f_line_height",
					// "dvmm_{$button_name}_f_text_shadow_style",
					// "dvmm_{$button_name}_f_text_shadow_horizontal_length",
					// "dvmm_{$button_name}_f_text_shadow_vertical_length",
					// "dvmm_{$button_name}_f_text_shadow_blur_strength",
					// "dvmm_{$button_name}_f_text_shadow_color",
					
					"border_radii_dvmm_{$button_name}",
					"border_radii_dvmm_{$button_name}_f",
				),
				'default'       => 'off',
				'tab_slug'      => 'general',
				'toggle_slug'	=> 'header_elements',
			),
			"dvmm_show_{$button_name}" => array(
				'label'           => sprintf( esc_html__( 'Show %1$s', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     => esc_html__( 'Set the Button element responsive visibility.', 'dvmm-divi-mad-menu' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
				),
				'mobile_options'  => true,
				'responsive'      => true,
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'           => 'on',
				'tab_slug'          => 'custom_css',
				'toggle_slug'       => 'visibility',
			),
			"dvmm_{$button_name}_order" => array(
				'label'			=> sprintf( esc_html__( '%1$s Order', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'	=> esc_html__( 'Here you can set the element order. Element order is set relatively to other enabled elements, a higher order number moves the element closer to the right hand side of the header.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'range',
                'mobile_options'	=> true,
                'responsive'		=> true,
				'option_category'	=> 'layout',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
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
			"dvmm_{$button_name}_text" 	=> array(
				'label'            	=> sprintf( esc_html__( '%1$s Text', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'      	=> esc_html__( 'Input your desired button text.', 'dvmm-divi-mad-menu' ),
				'type'             	=> 'text',
				'option_category'  	=> 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
				),
				'default'       	=> '',
				'mobile_options'   	=> true,
				'hover'            	=> 'tabs',
				'dynamic_content'  	=> 'text',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'normal',
			),
			"dvmm_{$button_name}_enable_icon" => array(
				'label'            	=> sprintf( esc_html__( 'Enable %1$s Icon', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     	=> esc_html__( 'Enable the icon for the button.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'yes_no_button',
				'option_category' 	=> 'layout',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}"	=> 'on',
				),
				'options'         	=> array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'       	=> 'off',
				'tab_slug'			=> 'general',
				'toggle_slug'		=> $button_name,
				'sub_toggle'      	=> 'normal',
			),
            "dvmm_{$button_name}_icon_type" => array(
				'label'            	=> sprintf( esc_html__( '%1$s Icon Type', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'       => esc_html__( 'Select a font icon or upload your own image icon for the button.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
					"dvmm_{$button_name}_enable_icon" => 'on'
				),
				'options'         	=> array(
					'font_icon'			=> esc_html__( 'Font Icon', 'dvmm-divi-mad-menu' ),
					'image_icon'		=> esc_html__( 'Image Icon', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'font_icon',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'normal',
            ),
			"dvmm_{$button_name}_icon"  => array(
				'label'           	=> sprintf( esc_html__( '%1$s Icon', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     	=> esc_html__( 'Select a font icon for the button.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select_icon',
				'mobile_options'  	=> true,
				'hover'				=> 'tabs',
				'option_category' 	=> 'configuration',
				'show_if'		  	=> array(
					"dvmm_enable_{$button_name}" 		=> 'on',
					"dvmm_{$button_name}_enable_icon" 	=> 'on',
                    "dvmm_{$button_name}_icon_type" 	=> 'font_icon',
				),
				// 'class'           => array( 'et-pb-font-icon' ),
				'default'		  	=> $module->helpers()->default_font_icon('%%20%%', '&#x35;||divi||400'),
				'allow_empty' 	  	=> true,
				'tab_slug'        	=> 'general',
				'toggle_slug'     	=> $button_name,
				'sub_toggle'      	=> 'normal',
            ),
			"dvmm_{$button_name}_img" => array(
				'label'             => sprintf( esc_html__( '%1$s Image', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'       => esc_html__( 'Upload an image icon for the button.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'upload',
				'mobile_options'    => true,
				'hover'             => 'tabs',
				'option_category'	=> 'configuration',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}"    => 'on',
					"dvmm_{$button_name}_enable_icon" => 'on',
                    "dvmm_{$button_name}_icon_type" => 'image_icon',
				),
				'upload_button_text'=> esc_attr__( 'Upload an image', 'dvmm-divi-mad-menu' ),
				'choose_text'       => esc_attr__( 'Choose an Image', 'dvmm-divi-mad-menu' ),
				'update_text'       => esc_attr__( 'Set As Icon', 'dvmm-divi-mad-menu' ),
				// 'dynamic_content'   => 'image',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'normal',
			),
			"dvmm_{$button_name}_use_fixed_img" => array(
				'label'				=> esc_html__( 'Use Fixed Header Image', 'dvmm-divi-mad-menu' ),
				'description'		=> esc_html__( 'Use a different image icon for the fixed header button.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'yes_no_button',
				'option_category' 	=> 'configuration',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}"    => 'on',
					"dvmm_{$button_name}_enable_icon" => 'on',
                    "dvmm_{$button_name}_icon_type" => 'image_icon',
					'dvmm_enable_fixed_header' 	    => 'on',
				),
				'options'         	=> array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'			=> 'off',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'normal',
			),
			"dvmm_{$button_name}_img_f" => array(
				'label'             => sprintf( esc_html__( '%1$s Image (Fixed)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'       => esc_html__( 'Upload an image icon for the fixed header button.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'upload',
				'mobile_options'    => true,
				'hover'             => 'tabs',
				'option_category'	=> 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}"    => 'on',
					"dvmm_{$button_name}_enable_icon" => 'on',
                    "dvmm_{$button_name}_icon_type" => 'image_icon',
                    'dvmm_enable_fixed_header' 	    => 'on',
                    "dvmm_{$button_name}_use_fixed_img" => 'on',
				),
				'upload_button_text'=> esc_attr__( 'Upload an image', 'dvmm-divi-mad-menu' ),
				'choose_text'       => esc_attr__( 'Choose an Image', 'dvmm-divi-mad-menu' ),
				'update_text'       => esc_attr__( 'Set As Icon', 'dvmm-divi-mad-menu' ),
				// 'dynamic_content'   => 'image',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'normal',
			),
			"dvmm_{$button_name}_icon_placement" => array(
				'label'            	=> sprintf( esc_html__( '%1$s Icon Placement', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'       => esc_html__( 'Choose where the button icon should be displayed within the button relatively to the button text.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'option_category'	=> 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
					"dvmm_{$button_name}_enable_icon" => 'on'
				),
				'options'         	=> array(
					'column-reverse' => esc_html__( 'Above', 'dvmm-divi-mad-menu' ),
					'row'			 => esc_html__( 'Right', 'dvmm-divi-mad-menu' ),
					'column'		 => esc_html__( 'Below', 'dvmm-divi-mad-menu' ),
					'row-reverse'	 => esc_html__( 'Left', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'row',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'normal',
			),
			"dvmm_{$button_name}_show_icon" => array(
				'label'           => sprintf( esc_html__( '%1$s Icon Visibility', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     => esc_html__( 'Set the button icon visibility for each device.', 'dvmm-divi-mad-menu' ),
				'type'            => 'yes_no_button',
				'mobile_options'  => true,
				'responsive'      => true,
				'option_category' => 'layout',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}"	=> 'on',
					"dvmm_{$button_name}_enable_icon" => 'on',
				),
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'       => 'on',
				'tab_slug'		=> 'general',
				'toggle_slug'	=> $button_name,
				'sub_toggle'    => 'normal',
			),
			/**
			 * Popup Fields
			 * @since	v1.6
			 */
			"{$button_name}_type" => array(
				'label'            	=> sprintf( esc_html__( '%1$s Type', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'       => esc_html__( 'Select the button type.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
				),
				'options'         	=> array(
					'url'	=> esc_html__( 'URL', 'dvmm-divi-mad-menu' ),
					'popup'	=> esc_html__( 'Popup', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'url',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'normal',
			),
			"{$button_name}_pp_id" => array(
				'label'             => esc_html__( 'Popup ID', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Set the popup ID here. The same ID should be added into the popup element\'s Advanced -> CSS ID&Classes -> CSS ID field. Any section, row, column or module(except for the module triggering the popup) can be a popup.', 'dvmm-divi-mad-menu' ),
				'type'              => 'text',
				'option_category'   => 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}"	=> 'on',
					"{$button_name}_type" 			=> 'popup',
				),
				'tab_slug'         	=> 'general',
				'toggle_slug'       => $button_name,
				'sub_toggle'      	=> 'normal',
			),
			"{$button_name}_pp_toggle" => array(
				'label'            	=> esc_html__( 'Popup Toggle Type', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'A popup must have only one "Primary" toggle for applying the popup settings(location, animations, etc.). All additional toggles of the same popup for the same view mode("Normal" or "Auth") should be "Secondary" toggles to avoid popup settings conflicts.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'configuration',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}"	=> 'on',
					"{$button_name}_type" 		=> 'popup',
				),
				'options' 			=> array(
					'primary'	=> esc_html__( 'Primary', 'dvmm-divi-mad-menu' ),
					'secondary'	=> esc_html__( 'Secondary', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'primary',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'normal',
			),
			"{$button_name}_pp_location" => array(
				'label'            	=> esc_html__( 'Popup Location', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Set the popup location on the screen. This will override the Position and Transform settings of the popup element(section, row, column or module).', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'option_category'	=> 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
					"{$button_name}_type"		 => 'popup',
					"{$button_name}_pp_toggle"	 => 'primary',
				),
				'options'		=> array(
					'top_left'		=> esc_html__( 'Top Left', 'dvmm-divi-mad-menu' ),
					'top_center'	=> esc_html__( 'Top Center', 'dvmm-divi-mad-menu' ),
					'top_right'		=> esc_html__( 'Top Right', 'dvmm-divi-mad-menu' ),
					'center_left'	=> esc_html__( 'Center Left', 'dvmm-divi-mad-menu' ),
					'center_center'	=> esc_html__( 'Center', 'dvmm-divi-mad-menu' ),
					'center_right'	=> esc_html__( 'Center Right', 'dvmm-divi-mad-menu' ),
					'bottom_left'	=> esc_html__( 'Bottom Left', 'dvmm-divi-mad-menu' ),
					'bottom_center'	=> esc_html__( 'Bottom Center', 'dvmm-divi-mad-menu' ),
					'bottom_right'	=> esc_html__( 'Bottom Right', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'center_center',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'normal',
			),
			"{$button_name}_pp_animation_open" => array(
				'label'            	=> esc_html__( 'Popup Opening Animation', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Select the popup opening animation.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'option_category'	=> 'configuration',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
					"{$button_name}_type" 		 => 'popup',
					"{$button_name}_pp_toggle" 	 => 'primary',
				),
				'options' 			=> $module->helpers()->get_animation_options__open("popup"),
				'default'         	=> 'fadeIn',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'normal',
			),
			"{$button_name}_pp_animation_duration" => array(
				'label'				=> esc_html__( 'Opening Animation Duration', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Set the popup opening animation duration.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'configuration',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
					"{$button_name}_type" 		 => 'popup',
					"{$button_name}_pp_toggle" 	 => 'primary',
				),
				'default'           => '400ms',
				'allowed_units'     => array( 'ms' ),
				'default_unit'      => 'ms',
				'validate_unit' 	=> true,
				'fixed_range'       => true,
				'range_settings'    => array(
					'min'  => 0,
					'max'  => 2000,
					'step' => 50,
				),
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'normal',
			),
			"{$button_name}_pp_animation_close" => array(
				'label'            	=> esc_html__( 'Popup Closing Animation', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Select the popup closing animation.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'option_category'	=> 'configuration',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
					"{$button_name}_type" 		 => 'popup',
					"{$button_name}_pp_toggle" 	 => 'primary',
				),
				'options' 			=> $module->helpers()->get_animation_options__close("popup"),
				'default'         	=> 'dvmm_fadeOut',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'normal',
			),
			"{$button_name}_pp_animation_duration_close" => array(
				'label'				=> esc_html__( 'Closing Animation Duration', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Set the popup closing animation duration.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'configuration',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
					"{$button_name}_type" 		 => 'popup',
					"{$button_name}_pp_toggle" 	 => 'primary',
				),
				'default'           => '400ms',
				'allowed_units'     => array( 'ms' ),
				'default_unit'      => 'ms',
				'validate_unit' 	=> true,
				'fixed_range'       => true,
				'range_settings'    => array(
					'min'  => 0,
					'max'  => 2000,
					'step' => 50,
				),
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'normal',
			),
			"{$button_name}_pp_x" => array(
				'label'           	=> esc_html__( 'Popup Close Button', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Add the close button (the X icon) to the popup for closing it.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'yes_no_button',
				'option_category' 	=> 'layout',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
					"{$button_name}_type" 		 => 'popup',
					"{$button_name}_pp_toggle" 	 => 'primary',
				),
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'       => 'off',
				'tab_slug'		=> 'general',
				'toggle_slug'	=> $button_name,
				'sub_toggle'	=> 'normal',
			),
			"{$button_name}_pp_x_color" => array(
				'label'           => esc_html__( 'Popup Close Button Icon Color', 'dvmm-divi-mad-menu' ),
				'description'     => esc_html__( 'Set the popup close button icon(the X icon) color.', 'dvmm-divi-mad-menu' ),
				'type'            => 'color-alpha',
				'option_category' => 'basic_option',
				'show_if'         => array(
					"dvmm_enable_{$button_name}" => 'on',
					"{$button_name}_type" 		 => 'popup',
					"{$button_name}_pp_toggle" 	 => 'primary',
					"{$button_name}_pp_x"		 => 'on',
				),
				'mobile_options'	=> true,
				'responsive'		=> true,
				'hover'				=> 'tabs',
				'custom_color'		=> true,
				'default'			=> '#666666',
				'tab_slug'			=> 'advanced',
				'toggle_slug'		=> "{$button_name}_design",
				'sub_toggle'   	  	=> 'normal',
			),
			"{$button_name}_pp_overlay" => array(
				'label'           => esc_html__( 'Popup Overlay', 'dvmm-divi-mad-menu' ),
				'description'     => esc_html__( 'Show the popup background overlay when the popup is opened.', 'dvmm-divi-mad-menu' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'show_if'		  => array(
					"dvmm_enable_{$button_name}" => 'on',
					"{$button_name}_type" 		 => 'popup',
					"{$button_name}_pp_toggle" 	 => 'primary',
				),
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'       => 'off',
				'tab_slug'		=> 'general',
				'toggle_slug'	=> $button_name,
				'sub_toggle'	=> 'normal',
			),
			"{$button_name}_pp_overlay_bgcolor" => array(
				'label'           => esc_html__( 'Popup Overlay Color', 'dvmm-divi-mad-menu' ),
				'description'     => esc_html__( 'Set the popup overlay background color.', 'dvmm-divi-mad-menu' ),
				'type'            => 'color-alpha',
				'option_category' => 'basic_option',
				'show_if'         => array(
					"dvmm_enable_{$button_name}" => 'on',
					"{$button_name}_type" 		 => 'popup',
					"{$button_name}_pp_toggle" 	 => 'primary',
					"{$button_name}_pp_overlay"	 => 'on',
				),
				'mobile_options'	=> true,
				'responsive'		=> true,
				'hover'				=> 'tabs',
				'custom_color'		=> true,
				'default'			=> 'rgba(0,0,0,0.2)',
				'tab_slug'			=> 'advanced',
				'toggle_slug'		=> "{$button_name}_design",
				'sub_toggle'   	  	=> 'normal',
			),
			"{$button_name}_pp_x_out_click" => array(
				'label'           => esc_html__( 'Close On Outside Click', 'dvmm-divi-mad-menu' ),
				'description'     => esc_html__( 'Close popup when clicked outside the popup and the popup toggle.', 'dvmm-divi-mad-menu' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
					"{$button_name}_type" 		 => 'popup',
					"{$button_name}_pp_toggle" 	 => 'primary',
				),
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'       => 'on',
				'tab_slug'		=> 'general',
				'toggle_slug'	=> $button_name,
				'sub_toggle'	=> 'normal',
			),
			"{$button_name}_pp_zindex" => array(
				'label'				=> esc_html__( 'Popup Z Index', 'dvmm-divi-mad-menu' ),
				'description'		=> esc_html__( 'Here you can control the popup element position on the z-axis. Popup needs to have a large z-index so that it sits atop the rest of the page content.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'range',
				'mobile_options'	=> true,
				'responsive'		=> true,
				// 'hover'				=> 'tabs',
				'option_category'	=> 'layout',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
					"{$button_name}_type" 		 => 'popup',
					"{$button_name}_pp_toggle" 	 => 'primary',
				),
				'range_settings'   	=> array(
					'min'       => -9999999,
					'max'       => 9999999,
					'step'      => 1,
					'min_limit' => -9999999,
					'max_limit' => 9999999,
				),
				'validate_unit'	=> false,
				'default'		=> '99999',
				'tab_slug'		=> 'general',
				'toggle_slug'	=> $button_name,
				'sub_toggle'	=> 'normal',
			),

			"dvmm_{$button_name}_url" => array(
				'label'             => sprintf( esc_html__( '%1$s Link URL', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'       => esc_html__( 'Input the destination URL for the button.', 'dvmm-divi-mad-menu' ),
				'type'              => 'text',
				'option_category'   => 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
					"{$button_name}_type" 		 => 'url',
				),
				'dynamic_content'   => 'url',
				'tab_slug'         	=> 'general',
				'toggle_slug'       => $button_name,
				'sub_toggle'      	=> 'normal',
			),
			"dvmm_{$button_name}_url_new_window" => array(
				'label'             => sprintf( esc_html__( '%1$s Link Target', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'       => esc_html__( 'Here you can choose whether or not the button link opens in a new window', 'dvmm-divi-mad-menu' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
					"{$button_name}_type" 		 => 'url',
				),
				'options'           => array(
					'off' => esc_html__( 'In The Same Window', 'dvmm-divi-mad-menu' ),
					'on'  => esc_html__( 'In The New Tab', 'dvmm-divi-mad-menu' ),
				),
				'default_on_front'  => 'off',
				'tab_slug'         	=> 'general',
				'toggle_slug'       => $button_name,
				'sub_toggle'      	=> 'normal',
			),
			"dvmm_{$button_name}_rel" => array(
				'label'           => sprintf( esc_html__( '%1$s Relationship', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     => et_get_safe_localization( __( "Specify the value of your link's <em>rel</em> attribute. The <em>rel</em> attribute specifies the relationship between the current document and the linked document.<br><strong>Tip:</strong> Search engines can use this attribute to get more information about a link.", 'dvmm-divi-mad-menu' ) ),
				'type'            => 'multiple_checkboxes',
				'option_category' => 'configuration',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
					"{$button_name}_type" 		 => 'url',
				),
				'options'         => array(
					'bookmark',
					'external',
					'nofollow',
					'noreferrer',
					'noopener',
				),
				'tab_slug'        => 'custom_css',
				'toggle_slug'     => 'attributes',
				'shortcut_index'  => $button_name,
			),
			"dvmm_{$button_name}_img_alt" => array(
				'label'           	=> sprintf( esc_html__( '%1$s Image Alt Text', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     	=> esc_html__( 'Define the HTML ALT text for the button here.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'text',
				'option_category' 	=> 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}"    => 'on',
					"dvmm_{$button_name}_enable_icon" => 'on',
                    "dvmm_{$button_name}_icon_type" => 'image_icon',
				),
				'dynamic_content' 	=> 'text',
				'tab_slug'        => 'custom_css',
				'toggle_slug'     => 'attributes',
			),
			/**
			 * Authenticated User Content Fields
			 * @since	v1.5
			 */
			"dvmm_{$button_name}_enable_auth" => array(
				'label'            	=> sprintf( esc_html__( 'Enable %1$s Authenticated User Content', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     => esc_html__( 'Enable the button content that is displayed to logged in users only. This applies to this button\'s content only but not to the content of the page that this button is linking to.', 'dvmm-divi-mad-menu' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}"	=> 'on',
				),
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'       => 'off',
				'tab_slug'		=> 'general',
				'toggle_slug'	=> $button_name,
				'sub_toggle'	=> 'auth',
			),
			"dvmm_{$button_name}_text_auth" => array(
				'label'            	=> sprintf( esc_html__( '%1$s Text (Auth.)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'      	=> esc_html__( 'Input the button text displayed to logged in users.', 'dvmm-divi-mad-menu' ),
				'type'             	=> 'text',
				'option_category'  	=> 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" => 'on',
					"dvmm_{$button_name}_enable_auth" => 'on',
				),
				'default'       	=> esc_html__( 'Log Out', 'dvmm-divi-mad-menu' ),
				'mobile_options'   	=> true,
				'hover'            	=> 'tabs',
				'dynamic_content'  	=> 'text',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'auth',
			),
			"dvmm_{$button_name}_icon_auth" => array(
				'label'           => sprintf( esc_html__( '%1$s Icon (Auth.)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     => esc_html__( 'Select a font icon displayed to logged in users.', 'dvmm-divi-mad-menu' ),
				'type'            => 'select_icon',
				'mobile_options'  => true,
				'option_category' => 'configuration',
				'show_if'		  => array(
					"dvmm_enable_{$button_name}" 		=> 'on',
					"dvmm_{$button_name}_enable_icon" 	=> 'on',
					"dvmm_{$button_name}_icon_type" 	=> 'font_icon',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
				),
				'default'		  => '%%20%%',
				'allow_empty' 	  => true,
				'tab_slug'        => 'general',
				'toggle_slug'     => $button_name,
				'sub_toggle'      	=> 'auth',
			),
			"dvmm_{$button_name}_img_auth" => array(
				'label'             => sprintf( esc_html__( '%1$s Image (Auth.)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'       => esc_html__( 'Upload an image icon displayed to logged in users.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'upload',
				'mobile_options'    => true,
				'hover'             => 'tabs',
				'option_category'	=> 'configuration',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}"    	=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"dvmm_{$button_name}_enable_icon" 	=> 'on',
					"dvmm_{$button_name}_icon_type" 	=> 'image_icon',
				),
				'upload_button_text'=> esc_attr__( 'Upload an image', 'dvmm-divi-mad-menu' ),
				'choose_text'       => esc_attr__( 'Choose an Image', 'dvmm-divi-mad-menu' ),
				'update_text'       => esc_attr__( 'Set As Icon', 'dvmm-divi-mad-menu' ),
				// 'dynamic_content'   => 'image',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'auth',
			),
			"dvmm_{$button_name}_img_auth_f" => array(
				'label'             => sprintf( esc_html__( '%1$s Image (Fixed | Auth.)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'       => esc_html__( 'Upload an image icon displayed to logged in users for the fixed header.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'upload',
				'mobile_options'    => true,
				'hover'             => 'tabs',
				'option_category'	=> 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}"    	=> 'on',
					"dvmm_{$button_name}_enable_icon" 	=> 'on',
					"dvmm_{$button_name}_icon_type" 	=> 'image_icon',
					'dvmm_enable_fixed_header' 	    	=> 'on',
					"dvmm_{$button_name}_use_fixed_img" => 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
				),
				'upload_button_text'=> esc_attr__( 'Upload an image', 'dvmm-divi-mad-menu' ),
				'choose_text'       => esc_attr__( 'Choose an Image', 'dvmm-divi-mad-menu' ),
				'update_text'       => esc_attr__( 'Set As Icon', 'dvmm-divi-mad-menu' ),
				// 'dynamic_content'   => 'image',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'auth',
			),
			/**
			 * Popup Fields (Auth.)
			 * @since	v1.6
			 */
			"{$button_name}_type_auth" => array(
				'label'            	=> sprintf( esc_html__( '%1$s Type (Auth.)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'       => esc_html__( 'Select the button type.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" 		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
				),
				'options'         	=> array(
					'url'	=> esc_html__( 'URL', 'dvmm-divi-mad-menu' ),
					'popup'	=> esc_html__( 'Popup', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'url',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'auth',
			),
			"{$button_name}_pp_id_auth" => array(
				'label'             => esc_html__( 'Popup ID (Auth.)', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Set the popup ID here. The same ID should be added to the popup element\'s Advanced -> CSS ID & Classes -> CSS ID field. Any section, row, column or module(except for the module triggering the popup) can be a popup.', 'dvmm-divi-mad-menu' ),
				'type'              => 'text',
				'option_category'   => 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" 		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'popup',
				),
				'tab_slug'         	=> 'general',
				'toggle_slug'       => $button_name,
				'sub_toggle'      	=> 'auth',
			),
			"{$button_name}_pp_warning_auth" => array(
				'label'           => '',
				'type'            => 'warning',
				'value'           => true,
				'display_if'      => true,
				'message'         => esc_html__( '<p style="line-height: 1.2em; padding: 10px; border: 2px solid #ff9232; border-radius: 4px; color: #ff7700; background-color: #fffaf6;">Make sure you set a Logged In Status display condition for the popup to be visible to logged in users only in the popup element\'s Advanced->Conditions settings.</p>', 'dvmm-divi-mad-menu' ),
				'option_category' => 'configuration',
				'show_if'     	  => array(
					"dvmm_enable_{$button_name}" 		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'popup',
				),
				'bb_support'	=> false,
				'tab_slug'		=> 'general',
				'toggle_slug'	=> $button_name,
				'sub_toggle'	=> 'auth',
			),
			"{$button_name}_pp_toggle_auth" => array(
				'label'            	=> esc_html__( 'Popup Toggle Type (Auth.)', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'A popup must have only one "Primary" toggle for applying the popup settings(location, animations, etc.). All additional toggles of the same popup for the same view mode("Normal" or "Auth") should be "Secondary" toggles to avoid popup settings conflicts.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'configuration',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}"		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'popup',
				),
				'options' 			=> array(
					'primary'	=> esc_html__( 'Primary', 'dvmm-divi-mad-menu' ),
					'secondary'	=> esc_html__( 'Secondary', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'primary',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'auth',
			),
			"{$button_name}_pp_location_auth" => array(
				'label'            	=> esc_html__( 'Popup Location (Auth.)', 'dvmm-divi-mad-menu' ),
				'description'       => esc_html__( 'Set the popup location on the screen. This will override the Position and Transform settings of the popup element(section, row, column or module).', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'option_category'	=> 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" 		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'popup',
					"{$button_name}_pp_toggle_auth" 	=> 'primary',
				),
				'options'		=> array(
					'top_left'		=> esc_html__( 'Top Left', 'dvmm-divi-mad-menu' ),
					'top_center'	=> esc_html__( 'Top Center', 'dvmm-divi-mad-menu' ),
					'top_right'		=> esc_html__( 'Top Right', 'dvmm-divi-mad-menu' ),
					'center_left'	=> esc_html__( 'Center Left', 'dvmm-divi-mad-menu' ),
					'center_center'	=> esc_html__( 'Center', 'dvmm-divi-mad-menu' ),
					'center_right'	=> esc_html__( 'Center Right', 'dvmm-divi-mad-menu' ),
					'bottom_left'	=> esc_html__( 'Bottom Left', 'dvmm-divi-mad-menu' ),
					'bottom_center'	=> esc_html__( 'Bottom Center', 'dvmm-divi-mad-menu' ),
					'bottom_right'	=> esc_html__( 'Bottom Right', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'center_center',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'auth',
			),
			"{$button_name}_pp_animation_open_auth" => array(
				'label'            	=> esc_html__( 'Popup Opening Animation (Auth.)', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Select the popup opening animation.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'option_category'	=> 'configuration',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" 		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'popup',
					"{$button_name}_pp_toggle_auth" 	=> 'primary',
				),
				'options' 			=> $module->helpers()->get_animation_options__open("popup"),
				'default'         	=> 'fadeIn',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'auth',
			),
			"{$button_name}_pp_animation_duration_auth" => array(
				'label'				=> esc_html__( 'Opening Animation Duration (Auth.)', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Set the popup opening animation duration.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'configuration',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" 		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'popup',
					"{$button_name}_pp_toggle_auth" 	=> 'primary',
				),
				'default'           => '400ms',
				'allowed_units'     => array( 'ms' ),
				'default_unit'      => 'ms',
				'validate_unit' 	=> true,
				'fixed_range'       => true,
				'range_settings'    => array(
					'min'  => 0,
					'max'  => 2000,
					'step' => 50,
				),
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'auth',
			),
			"{$button_name}_pp_animation_close_auth" => array(
				'label'            	=> esc_html__( 'Popup Closing Animation (Auth.)', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Select the popup closing animation.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'option_category'	=> 'configuration',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" 		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'popup',
					"{$button_name}_pp_toggle_auth" 	=> 'primary',
				),
				'options' 			=> $module->helpers()->get_animation_options__close("popup"),
				'default'         	=> 'dvmm_fadeOut',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'auth',
			),
			"{$button_name}_pp_animation_duration_close_auth" => array(
				'label'				=> esc_html__( 'Closing Animation Duration (Auth.)', 'dvmm-divi-mad-menu' ),
				'description'	  	=> esc_html__( 'Set the popup closing animation duration.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'configuration',
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" 		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'popup',
					"{$button_name}_pp_toggle_auth" 	=> 'primary',
				),
				'default'           => '400ms',
				'allowed_units'     => array( 'ms' ),
				'default_unit'      => 'ms',
				'validate_unit' 	=> true,
				'fixed_range'       => true,
				'range_settings'    => array(
					'min'  => 0,
					'max'  => 2000,
					'step' => 50,
				),
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'auth',
			),
			"{$button_name}_pp_x_auth" => array(
				'label'            	=> esc_html__( 'Popup Close Button (Auth.)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Add the close button (the X icon) to the popup for closing it.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'yes_no_button',
				'option_category' 	=> 'layout',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}"		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'popup',
					"{$button_name}_pp_toggle_auth" 	=> 'primary',
				),
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'       => 'off',
				'tab_slug'		=> 'general',
				'toggle_slug'	=> $button_name,
				'sub_toggle'	=> 'auth',
			),
			"{$button_name}_pp_x_color_auth" => array(
				'label'           => esc_html__( 'Popup Close Button Icon Color (Auth.)', 'dvmm-divi-mad-menu' ),
				'description'     => esc_html__( 'Set the popup close button icon(the X icon) color.', 'dvmm-divi-mad-menu' ),
				'type'            => 'color-alpha',
				'option_category' => 'basic_option',
				'show_if'         => array(
					"dvmm_enable_{$button_name}"		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'popup',
					"{$button_name}_pp_toggle_auth" 	=> 'primary',
					"{$button_name}_pp_x_auth"			=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'		=> true,
				'hover'				=> 'tabs',
				'custom_color'		=> true,
				'default'			=> '#666666',
				'tab_slug'			=> 'advanced',
				'toggle_slug'		=> "{$button_name}_design",
				'sub_toggle'   	  	=> 'normal',
			),
			"{$button_name}_pp_overlay_auth" => array(
				'label'           => esc_html__( 'Popup Overlay (Auth.)', 'dvmm-divi-mad-menu' ),
				'description'     => esc_html__( 'Show the popup background overlay when the popup is opened.', 'dvmm-divi-mad-menu' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}"		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'popup',
					"{$button_name}_pp_toggle_auth" 	=> 'primary',
				),
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'       => 'off',
				'tab_slug'		=> 'general',
				'toggle_slug'	=> $button_name,
				'sub_toggle'	=> 'auth',
			),
			"{$button_name}_pp_overlay_bgcolor_auth" => array(
				'label'           => esc_html__( 'Popup Overlay Color (Auth.)', 'dvmm-divi-mad-menu' ),
				'description'     => esc_html__( 'Set the popup overlay background color.', 'dvmm-divi-mad-menu' ),
				'type'            => 'color-alpha',
				'option_category' => 'basic_option',
				'show_if'         => array(
					"dvmm_enable_{$button_name}"		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'popup',
					"{$button_name}_pp_toggle_auth" 	=> 'primary',
					"{$button_name}_pp_overlay_auth"	=> 'on',
				),
				'mobile_options'	=> true,
				'responsive'		=> true,
				'hover'				=> 'tabs',
				'custom_color'		=> true,
				'default'			=> 'rgba(0,0,0,0.2)',
				'tab_slug'			=> 'advanced',
				'toggle_slug'		=> "{$button_name}_design",
				'sub_toggle'   	  	=> 'normal',
			),
			"{$button_name}_pp_x_out_click_auth" => array(
				'label'           	=> esc_html__( 'Close On Outside Click (Auth.)', 'dvmm-divi-mad-menu' ),
				'description'     	=> esc_html__( 'Close popup when clicked outside the popup and the popup toggle.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'yes_no_button',
				'option_category' 	=> 'layout',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}"		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'popup',
					"{$button_name}_pp_toggle_auth" 	=> 'primary',
				),
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'dvmm-divi-mad-menu' ),
					'off' => esc_html__( 'No', 'dvmm-divi-mad-menu' ),
				),
				'default'       => 'on',
				'tab_slug'		=> 'general',
				'toggle_slug'	=> $button_name,
				'sub_toggle'	=> 'auth',
			),
			"{$button_name}_pp_zindex_auth" => array(
				'label'				=> esc_html__( 'Popup Z Index (Auth.)', 'dvmm-divi-mad-menu' ),
				'description'		=> esc_html__( 'Here you can control the popup element position on the z-axis. Popup needs to have a large z-index so that it sits atop the rest of the page content.', 'dvmm-divi-mad-menu' ),
				'type'				=> 'range',
				'mobile_options'	=> true,
				'responsive'		=> true,
				// 'hover'				=> 'tabs',
				'option_category'	=> 'layout',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" 		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'popup',
					"{$button_name}_pp_toggle_auth" 	=> 'primary',
				),
				'range_settings'   	=> array(
					'min'       => -9999999,
					'max'       => 9999999,
					'step'      => 1,
					'min_limit' => -9999999,
					'max_limit' => 9999999,
				),
				'validate_unit'	=> false,
				'default'		=> '99999',
				'tab_slug'		=> 'general',
				'toggle_slug'	=> $button_name,
				'sub_toggle'	=> 'auth',
			),

			"dvmm_{$button_name}_link_type_auth" => array(
				'label'            	=> sprintf( esc_html__( '%1$s Link Type (Auth.)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'       => esc_html__( 'Select the button link type.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" 		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'url',
				),
				'options'         	=> array(
					'logout'		=> esc_html__( 'Logout', 'dvmm-divi-mad-menu' ),
					'custom_url'	=> esc_html__( 'Custom URL', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'logout',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'auth',
			),
			"dvmm_{$button_name}_url_auth" => array(
				'label'             => sprintf( esc_html__( '%1$s Link URL (Auth.)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'       => esc_html__( 'Input the destination URL for the button.', 'dvmm-divi-mad-menu' ),
				'type'              => 'text',
				'option_category'   => 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" 			=> 'on',
					"dvmm_{$button_name}_enable_auth"		=> 'on',
					"{$button_name}_type_auth"				=> 'url',
					"dvmm_{$button_name}_link_type_auth" 	=> 'custom_url',
				),
				'dynamic_content'   => 'url',
				'tab_slug'         	=> 'general',
				'toggle_slug'       => $button_name,
				'sub_toggle'      	=> 'auth',
			),
			"dvmm_{$button_name}_url_warning_auth" => array(
				'label'           => '',
				'type'            => 'warning',
				'value'           => true,
				'display_if'      => true,
				'message'         => esc_html__( '<p style="line-height: 1.2em; padding: 10px; border: 2px solid #ff9232; border-radius: 4px; color: #ff7700; background-color: #fffaf6;">The content of the page you are linking to <b>will not<b/> be hidden from unauthorized users! <br /><br />If you want to restrict this page\'s content to logged in users only, please make sure you use a page content restriction tool for that.</p>', 'dvmm-divi-mad-menu' ),
				'option_category' => 'configuration',
				'show_if'     	  => array(
					"dvmm_enable_{$button_name}" 		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'url',
					"dvmm_{$button_name}_link_type_auth" => 'custom_url',
				),
				'bb_support'	=> false,
				'tab_slug'		=> 'general',
				'toggle_slug'	=> $button_name,
				'sub_toggle'	=> 'auth',
			),
			"dvmm_{$button_name}_url_new_window_auth" => array(
				'label'             => sprintf( esc_html__( '%1$s Link Target (Auth.)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'       => esc_html__( 'Here you can choose whether or not the button link opens in a new window', 'dvmm-divi-mad-menu' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" 			=> 'on',
					"dvmm_{$button_name}_enable_auth"		=> 'on',
					"{$button_name}_type_auth"				=> 'url',
					"dvmm_{$button_name}_link_type_auth" 	=> 'custom_url',
				),
				'options'           => array(
					'off' => esc_html__( 'In The Same Window', 'dvmm-divi-mad-menu' ),
					'on'  => esc_html__( 'In The New Tab', 'dvmm-divi-mad-menu' ),
				),
				'default_on_front'  => 'off',
				'tab_slug'         	=> 'general',
				'toggle_slug'       => $button_name,
				'sub_toggle'      	=> 'auth',
			),
			"dvmm_{$button_name}_rel_auth" => array(
				'label'           => sprintf( esc_html__( '%1$s Relationship (Auth.)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     => et_get_safe_localization( __( "Specify the value of your link's <em>rel</em> attribute. The <em>rel</em> attribute specifies the relationship between the current document and the linked document.<br><strong>Tip:</strong> Search engines can use this attribute to get more information about a link.", 'dvmm-divi-mad-menu' ) ),
				'type'            => 'multiple_checkboxes',
				'option_category' => 'configuration',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" 			=> 'on',
					"dvmm_{$button_name}_enable_auth"		=> 'on',
					"{$button_name}_type_auth"				=> 'url',
					"dvmm_{$button_name}_link_type_auth" 	=> 'custom_url',
				),
				'options'         => array(
					'bookmark',
					'external',
					'nofollow',
					'noreferrer',
					'noopener',
				),
				'tab_slug'        => 'custom_css',
				'toggle_slug'     => 'attributes',
				'shortcut_index'  => $button_name,
			),
			"dvmm_{$button_name}_logout_redirect" => array(
				'label'            	=> sprintf( esc_html__( '%1$s Logout Redirect (Auth.)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'       => esc_html__( 'Redirect the user to the current page or to a custom URL when logged out.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'select',
				'option_category'	=> 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" 		=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"{$button_name}_type_auth"			=> 'url',
					"dvmm_{$button_name}_link_type_auth" => 'logout',
				),
				'options'         	=> array(
					'current_url'	=> esc_html__( 'Current Page', 'dvmm-divi-mad-menu' ),
					'custom_url'	=> esc_html__( 'Custom URL', 'dvmm-divi-mad-menu' ),
				),
				'default'         	=> 'current_url',
				'tab_slug'         	=> 'general',
				'toggle_slug'      	=> $button_name,
				'sub_toggle'      	=> 'auth',
			),
			"dvmm_{$button_name}_redirect_url" => array(
				'label'             => sprintf( esc_html__( '%1$s Redirect URL', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'       => esc_html__( 'Set the URL of the page to which you would like the user to be redirected when logged out.', 'dvmm-divi-mad-menu' ),
				'type'              => 'text',
				'option_category'   => 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" 			=> 'on',
					"dvmm_{$button_name}_enable_auth"		=> 'on',
					"{$button_name}_type_auth"				=> 'url',
					"dvmm_{$button_name}_link_type_auth" 	=> 'logout',
					"dvmm_{$button_name}_logout_redirect" 	=> 'custom_url',
				),
				'dynamic_content'   => 'url',
				'tab_slug'         	=> 'general',
				'toggle_slug'       => $button_name,
				'sub_toggle'      	=> 'auth',
			),
			"dvmm_{$button_name}_img_alt_auth" => array(
				'label'           	=> sprintf( esc_html__( '%1$s Image Alt Text (Auth.)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     	=> esc_html__( 'Define the HTML ALT text for the button here.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'text',
				'option_category' 	=> 'basic_option',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}"    	=> 'on',
					"dvmm_{$button_name}_enable_auth"	=> 'on',
					"dvmm_{$button_name}_enable_icon" 	=> 'on',
					"dvmm_{$button_name}_icon_type" 	=> 'image_icon',
				),
				'dynamic_content'	=> 'text',
				'tab_slug'        	=> 'custom_css',
				'toggle_slug'     	=> 'attributes',
			),
			"dvmm_{$button_name}_margin" => array(
				'label'           	=> sprintf( esc_html__( '%1$s Margin', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         => array(
					"dvmm_enable_{$button_name}" => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'default'           => '0px|5px|0px|5px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => "{$button_name}_design",
				'sub_toggle'   	  	=> 'normal',
			),
			"dvmm_{$button_name}_margin_f" => array(
				'label'           	=> sprintf( esc_html__( '%1$s Margin (Fixed)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         => array(
					"dvmm_enable_{$button_name}" => 'on',
					'dvmm_enable_fixed_header'	 => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				// 'default'           => '0px|5px|0px|5px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => "{$button_name}_design",
				'sub_toggle'   	  	=> 'fixed',
			),
			"dvmm_{$button_name}_padding" => array(
				'label'           	=> sprintf( esc_html__( '%1$s Padding', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'show_if'         => array(
					"dvmm_enable_{$button_name}" => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'default'           => '10px|10px|10px|10px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => "{$button_name}_design",
				'sub_toggle'   	  	=> 'normal',
			),
			"dvmm_{$button_name}_padding_f" => array(
				'label'           	=> sprintf( esc_html__( '%1$s Padding (Fixed)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     	=> esc_html__( 'Padding adds extra space to the inside of the element, increasing the distance between the edge of the element and its inner contents.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_padding',
				'option_category' 	=> 'layout',
				'show_if'         => array(
					"dvmm_enable_{$button_name}" => 'on',
					'dvmm_enable_fixed_header'   => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				// 'default'           => '10px|10px|10px|10px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => "{$button_name}_design",
				'sub_toggle'   	  	=> 'fixed',
			),
			"dvmm_{$button_name}_text_margin" => array(
				'label'           	=> sprintf( esc_html__( '%1$s Text Margin', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         => array(
					"dvmm_enable_{$button_name}" => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => "{$button_name}_design",
				'sub_toggle'   	  	=> 'normal',
			),
			"dvmm_{$button_name}_text_margin_f" => array(
				'label'           	=> sprintf( esc_html__( '%1$s Text Margin (Fixed)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     	=> esc_html__( 'Margin adds extra space to the outside of the element, increasing the distance between the element and other items on the page.', 'dvmm-divi-mad-menu' ),
				'type'              => 'custom_margin',
				'option_category' 	=> 'layout',
				'show_if'         => array(
					"dvmm_enable_{$button_name}" => 'on',
					'dvmm_enable_fixed_header'	 => 'on',
				),
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				// 'default'           => '0px|0px|0px|0px|false|false',
				'default_unit'      => 'px',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => "{$button_name}_design",
				'sub_toggle'   	  	=> 'fixed',
			),
			"dvmm_{$button_name}_icon_size" => array(
				'label'           	=> sprintf( esc_html__( '%1$s Icon Size', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     	=> esc_html__( 'Here you can control the size of the button icon.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" 	  => 'on',
					"dvmm_{$button_name}_enable_icon" => 'on',
					"dvmm_{$button_name}_icon_type"   => 'font_icon',
				),
				'allowed_units'     => array( 'px' ),
				'default_unit'      => 'px',
				// 'validate_unit' 	=> false,
				'default'           => '',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => "{$button_name}_design",
				'sub_toggle'   	  	=> 'normal',
			),
			"dvmm_{$button_name}_icon_size_f" => array(
				'label'           	=> sprintf( esc_html__( '%1$s Icon Size (Fixed)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     	=> esc_html__( 'Here you can control the size of the fixed header button icon.', 'dvmm-divi-mad-menu' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'mobile_options'    => true,
				'responsive'        => true,
				'hover'           	=> 'tabs',
				'show_if'			=> array(
					"dvmm_enable_{$button_name}" 	  => 'on',
					"dvmm_{$button_name}_enable_icon" => 'on',
					"dvmm_{$button_name}_icon_type"   => 'font_icon',
					'dvmm_enable_fixed_header' 		  => 'on',
				),
				'allowed_units'     => array( 'px' ),
				'default_unit'      => 'px',
				// 'validate_unit' 	=> false,
				'default'           => '',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => "{$button_name}_design",
				'sub_toggle'   	  	=> 'fixed',
			),
			"dvmm_{$button_name}_icon_color" => array(
				'label'           => sprintf( esc_html__( '%1$s Icon Color', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     => esc_html__( 'Set the button icon color.', 'dvmm-divi-mad-menu' ),
				'type'            => 'color-alpha',
				'option_category' => 'basic_option',
				'show_if'         => array(
					"dvmm_enable_{$button_name}" 	  => 'on',
					"dvmm_{$button_name}_enable_icon" => 'on',
					"dvmm_{$button_name}_icon_type"   => 'font_icon',
				),
				'mobile_options'  => true,
				'responsive'      => true,
				'hover'           => 'tabs',
				'custom_color'    => true,
				'default'         => '#666666',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => "{$button_name}_design",
				'sub_toggle'   	  => 'normal',
			),
			"dvmm_{$button_name}_icon_color_f" => array(
				'label'           	=> sprintf( esc_html__( '%1$s Icon Color (Fixed)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     	=> esc_html__( 'Set the fixed header button icon color.', 'dvmm-divi-mad-menu' ),
				'type'            	=> 'color-alpha',
				'option_category' 	=> 'basic_option',
				'show_if'         	=> array(
					"dvmm_enable_{$button_name}" 	  => 'on',
					"dvmm_{$button_name}_enable_icon" => 'on',
					"dvmm_{$button_name}_icon_type"   => 'font_icon',
					'dvmm_enable_fixed_header' 		  => 'on',
				),
				'mobile_options'  	=> true,
				'responsive'      	=> true,
				'hover'           	=> 'tabs',
				'custom_color'    	=> true,
				'default'         	=> '',
				'tab_slug'        	=> 'advanced',
				'toggle_slug'     	=> "{$button_name}_design",
				'sub_toggle'		=> 'fixed',
			),
			"dvmm_{$button_name}_bg_color" => array(
				'label'           => sprintf( esc_html__( '%1$s Background Color', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     => esc_html__( 'Set the button background color.', 'dvmm-divi-mad-menu' ),
				'type'            => 'color-alpha',
				'option_category' => 'basic_option',
				'show_if'         => array(
					"dvmm_enable_{$button_name}" => 'on',
				),
				'mobile_options'  => true,
				'responsive'      => true,
				'hover'           => 'tabs',
				'custom_color'    => true,
				'default'         => 'rgba(0,0,0,0)',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => "{$button_name}_design",
				'sub_toggle'   	  => 'normal',
			),
			"dvmm_{$button_name}_bg_color_f" => array(
				'label'           => sprintf( esc_html__( '%1$s Background Color (Fixed)', 'dvmm-divi-mad-menu' ), $button_label ),
				'description'     => esc_html__( 'Set the fixed header button background color.', 'dvmm-divi-mad-menu' ),
				'type'            => 'color-alpha',
				'option_category' => 'basic_option',
				'show_if'         => array(
					"dvmm_enable_{$button_name}" => 'on',
					'dvmm_enable_fixed_header'   => 'on',
				),
				'mobile_options'  => true,
				'responsive'      => true,
				'hover'           => 'tabs',
				'custom_color'    => true,
				'default'         => '',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => "{$button_name}_design",
				'sub_toggle'   	  => 'fixed',
			),
		);

		/**
		 * Add the element column layout fields.
		 * 
		 * dvmm_{$button_name}_col_width
		 * dvmm_{$button_name}_col_width_f
		 * dvmm_{$button_name}_col_max_width
		 * dvmm_{$button_name}_col_max_width_f
		 */
		$element_column_layout_fields = $module->helpers()->add_element_column_layout_fields( 
			array(
				'element_name' 	=> "{$button_label}",
				'element_slug' 	=> "{$button_name}",
				'tab_slug'		=> 'advanced',
				'toggle_slug'	=> 'elements_layout',
				'sub_toggle'	=> "{$button_name}",
			)
		);

		/**
		 * Add the element column design fields.
		 * 
		 * dvmm_{$button_name}_col_bg_color
		 * dvmm_{$button_name}_col_bg_color_f
		 */
		$element_column_design_fields = $module->helpers()->add_element_column_design_fields( 
			array(
				'element_name' 	=> "{$button_label}",
				'element_slug' 	=> "{$button_name}",
				'tab_slug'		=> 'advanced',
				'toggle_slug'	=> "{$button_name}_design",
			)
		);

		/**
		 * Add the element alignment fields.
		 * 
		 * dvmm_{$button_name}_vertical_alignment
		 * dvmm_{$button_name}_vertical_alignment_f
		 * dvmm_{$button_name}_horizontal_alignment
		 * dvmm_{$button_name}_horizontal_alignment_f
		 */
		$element_fields = $module->helpers()->add_element_alignment_fields( 
			array(
				'element_name' 		 => "{$button_label}",
				'element_slug' 		 => "{$button_name}", /* required, do not change */
				'setting_base' 		 => "{$button_name}",
				'vertical_options' 	 => "general",
				'horizontal_options' => "general",
				'tab_slug'			 => 'advanced',
				'toggle_slug'		 => 'elements_layout',
				'sub_toggle'		 => "{$button_name}",
			)
		);

		/**
		 * Add the element warning fields.
		 * 
		 * dvmm_{$button_label}_disabled__layout
		 * dvmm_{$button_label}_disabled__layout_f
		 */
		$element_warning_fields = $module->helpers()->add_element_warning_fields( 
			array(
				'element_name' 	=> "{$button_label}",
				'element_slug' 	=> "{$button_name}",
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

    /**
	 * Advanced fields.
	 * 
	 * @since v1.0.0 
	 */
	public function get_advanced_fields_config() {
        
        // module class
        $this->main_css_element = '%%order_class%%';
        
        $dvmm_menu_inner_container  = "{$this->main_css_element} .dvmm_menu_inner_container";

		// advanced fields
        $advanced_fields = array();

        return $advanced_fields;

	}

	/**
	 * Manage the button wrapper data attributes.
	 * 
	 * Adds attributes both for the normal and fixed header
	 * if fixed header is enabled and there are fixed header specific data attributes defined.
	 * 
	 * @since   v1.0.0
	 * 
	 * @param	object	$module				Module object.
	 * @param	array	$processed_props	Processed props.
	 * @param	string	$button_name		Button name ('button_one' or 'button_two').
	 * 
	 * @return	array						Menu CTA button wrapper data attributes.
	 */
	public function wrapper_data_attributes( $module, $processed_props, $button_name ){

		/**
		 * Props
		 */
		$_is_fixed_enabled = $processed_props['is_fixed_enabled'];
		
		/**
		 * Data attributes
		 */
		// button wrapper data attributes array
		$button_wrap_data_attributes = [];

		// FIXED HEADER
		if( $_is_fixed_enabled === true ){
			
		}

		return $button_wrap_data_attributes;
	}

	/**
	 * Manage the button data attributes (the <a></a> tag data attributes).
	 * 
	 * Adds attributes both for the normal and fixed header
	 * if fixed header is enabled and there are fixed header specific data attributes defined.
	 * 
	 * @since   v1.0.0
	 * 
	 * @param	object	$module				Module object.
	 * @param	string	$render_slug		Module slug.
	 * @param	array	$processed_props	Processed props.
	 * @param	string	$button_name		Button name ('button_one' or 'button_two').
	 * 
	 * @return	array						Menu CTA button wrapper data attributes.
	 */
	public function button_data_attributes( $module, $render_slug, $processed_props, $button_name ){

		/**
		 * Props
		 */
		$_is_fixed_enabled = $processed_props['is_fixed_enabled'];
		
		/**
		 * Data attributes
		 */
		// button wrapper data attributes array
		$button_data_attributes = [];

		// FIXED HEADER
		if( $_is_fixed_enabled === true ){

		}

		/**
		 * If the user is logged in and the "Authenticated User Content" is enabled
		 * @since v1.6
		 */
		$_auth = $module->helpers()->_auth_suffix( $module->props, $button_name );
		// @todo: Add these props to the $processed_props
		$buttonType  = $module->props["{$button_name}_type{$_auth}"];
		$popupID 	 = $module->props["{$button_name}_pp_id{$_auth}"];
		$triggerType = $module->props["{$button_name}_pp_toggle{$_auth}"];

		// Popup ID
		$popup_id = $buttonType === 'popup' && isset($popupID) && $popupID !== '' ? $popupID : '';

		// Popup ID data attribute
		$popup_id_data = sprintf( 'data-popup_id="%1$s"', esc_attr( $popup_id ) );

		if(!empty($popup_id)){
			$button_data_attributes[] = $popup_id_data;
		}

		return $button_data_attributes;
	}

	/**
	 * Manage the button wrapper classes.
	 * 
	 * @since   v1.0.0
	 * 
	 * @param	object	$module				Module object.
	 * @param	array	$processed_props	Processed props.
	 * @param	string	$button_name		Button name ('button_one' or 'button_two').
	 * 
	 * @return	array						Menu CTA button wrapper CSS classes.
	 */
	public function button_wrap_classes( $module, $processed_props, $button_name ){

		// PROPS
		$_is_fixed_enabled 	= $processed_props['is_fixed_enabled'];
		$use_fixed_img 		= $module->props["dvmm_{$button_name}_use_fixed_img"];

		// button wrapper classes array
		$button_wrap_classes = ["dvmm_element", "dvmm_button__wrap", "dvmm_{$button_name}__wrap"];

		// Maybe hide this element when search form appears
		$search_hide_elems_class = $module->helpers()->maybe_hide_element_when_search_opens($module->props, $button_name);

		// add fixed header button image class if fixed image is enabled
		if( $_is_fixed_enabled === true && $use_fixed_img === 'on' ){
			$use_fixed_img_class = 'dvmm_fixed_image_enabled';
			$button_wrap_classes[] = $use_fixed_img_class;
		}

		/**
		 * If the user is logged in and the "Authenticated User Content" is enabled
		 * @since v1.6
		 */
		$_auth = $module->helpers()->_auth_suffix( $module->props, $button_name );
		// @todo: Add these props to the $processed_props
		$buttonType 	= $module->props["{$button_name}_type{$_auth}"];
		$popupID 		= $module->props["{$button_name}_pp_id{$_auth}"];
		$triggerType 	= $module->props["{$button_name}_pp_toggle{$_auth}"];
		$close_on_outside_click = $module->props["{$button_name}_pp_x_out_click{$_auth}"];

		// Close popup on outside click
		if($buttonType === 'popup' && isset($popupID) && $popupID !== '' && $triggerType === 'primary'){
			$close_on_outside_click_class = $close_on_outside_click === 'on' ? 'dvmm_pp_close_on_outside_click' : '';
		}

		if(!empty($close_on_outside_click_class)){
			$button_wrap_classes[] = $close_on_outside_click_class;
		}

		// add to button wrapper classes array
		$button_wrap_classes[] = $search_hide_elems_class;

		return $button_wrap_classes;
	}

	/**
     * Manage the button ID.
	 * 
	 * Adds the ID to the button only if the popup toggle type is "Primary",
	 * otherwise ID is not added.
     * 
     * @since   v1.6
     * 
	 * @param	object	$module				Module object.
	 * @param	array	$processed_props	Processed props.
	 * @param	string	$button_name		Button name ('button_one' or 'button_two').
	 * 
     * @return	array						Menu button CSS classes.
     */
	public function button_ID( $module, $processed_props, $button_name ){

		/**
		 * If the user is logged in and the "Authenticated User Content" is enabled
		 * @since v1.6
		 */
		$_auth = $module->helpers()->_auth_suffix( $module->props, $button_name );
		// @todo: Add these props to the $processed_props
		$buttonType  = $module->props["{$button_name}_type{$_auth}"];
		$popupID 	 = $module->props["{$button_name}_pp_id{$_auth}"];
		$triggerType = $module->props["{$button_name}_pp_toggle{$_auth}"];

		/**
		 * Button ID for the popup "primary" trigger
		 */
		$popupPrimaryTriggerID = $buttonType === 'popup' && isset($popupID) && $popupID !== '' && $triggerType === 'primary'? "{$popupID}_primary" : '';

		// 	Button ID
		$button_ID = $popupPrimaryTriggerID;

		return $button_ID;
	}

    /**
     * Manage the button classes.
	 * Manages the CSS classes of the button(s).
     * 
     * @since   v1.0.0
     * 
	 * @param	object	$module				Module object.
	 * @param	array	$processed_props	Processed props.
	 * @param	string	$button_name		Button name ('button_one' or 'button_two').
	 * 
     * @return	array						Menu button CSS classes.
     */
	public function button_classes( $module, $processed_props, $button_name ){

		/**
		 * Processed props
		 */
		$_is_fixed_enabled 	= $processed_props['is_fixed_enabled'];

		// Button classes
		$button_classes = ["dvmm_button", "dvmm_{$button_name}"];

		// FIXED
		if( $_is_fixed_enabled === true ){

		}

		/**
		 * If the user is logged in and the "Authenticated User Content" is enabled
		 * @since v1.6
		 */
		$_auth = $module->helpers()->_auth_suffix( $module->props, $button_name );
		// @todo: Add these props to the $processed_props
		$buttonType  = $module->props["{$button_name}_type{$_auth}"];
		$popupID 	 = $module->props["{$button_name}_pp_id{$_auth}"];
		$triggerType = $module->props["{$button_name}_pp_toggle{$_auth}"];

		// Popup  CSS classes
		$buttonTypeClass = "dvmm_button_type--{$buttonType}"; 
		$popupIDclass = $buttonType === 'popup' && isset($popupID) && $popupID !== '' ? "dvmm_popup_id--{$popupID}" : '';

		// add the "popup closed" CSS class on page load (toggled using JS)
		$togglePopupClass = $buttonType === 'popup' && !empty($popupID) && $triggerType === 'primary' ? 'dvmm_popup--closed' : ''; 

		// add to button classes array
		$button_classes[] = $buttonTypeClass;
		$button_classes[] = $popupIDclass;
		$button_classes[] = $togglePopupClass;

		return $button_classes;
	}

	/**
	 * Botton CSS styles.
	 * 
	 * @since	v1.0.0 (updated in v1.6)
	 * 
	 * @param	object	$module				Module object.
	 * @param	string	$render_slug		Module slug.
	 * @param	string	$processed_props	Processed props.
	 * @param	string	$button_name		Button name ('button_one' or 'button_two').
	 */
	public function css( $module, $render_slug, $processed_props, $button_name ){

		/**
		 * Processed props
		 */
		$_is_fixed_enabled 	= $processed_props['is_fixed_enabled'];
		$enable_icon	= isset($processed_props['_enable_icon']) ? $processed_props['_enable_icon'] : '';
		$icon_type		= isset($processed_props['_icon_type']) ? $processed_props['_icon_type'] : '';
		$_icon_desktop 	= isset($processed_props['_icon']) ? $processed_props['_icon'] : '';
		$_icon_tablet 	= isset($processed_props['_icon_tablet']) ? $processed_props['_icon_tablet'] : '';
		$_icon_phone 	= isset($processed_props['_icon_phone']) ? $processed_props['_icon_phone'] : '';
		$additional_css	= isset($processed_props['additional_css']) ? $processed_props['additional_css'] : '';
		// Is Divi Builder plugin active
		$is_dbp	= isset($processed_props['is_dbp']) ? $processed_props['is_dbp'] : false;

		/**
		 * Selectors
		 */
		$dvmm_menu_inner_container 	= "{$module->main_css_element} .dvmm_menu_inner_container";
		$dvmm_button__wrap 			= "{$module->main_css_element} .dvmm_{$button_name}__wrap";
		$dvmm_button 				= "{$module->main_css_element} .dvmm_{$button_name}";

		// Button visibility
		$module->helpers()->declare_element_responsive_visibility_css( 
			$module->props, 
			"dvmm_show_{$button_name}",
			"{$dvmm_button__wrap}",
			$render_slug
		);

		// Button order (range)
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> "dvmm_{$button_name}_order",
			'selector' 			=> $dvmm_button__wrap,
			'property' 			=> 'order',
			'additional_css'	=> '',
			'field_type'		=> '', // don't set for 'range' field type
			'priority'			=> ''
		));

		// Button column width
		$module->helpers()->declare_element_column_width_css( $module->props, $render_slug, array( 
			'setting' 		=> "dvmm_{$button_name}_col_width",
			'setting_fixed'	=> "dvmm_{$button_name}_col_width_f",
			'selector' 		=> array(
				'normal'	=> "{$module->main_css_element} .dvmm_{$button_name}__wrap",
				'fixed'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name}__wrap",
			),
		));

		// Button column max-width
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> "dvmm_{$button_name}_col_max_width",
			'setting_fixed'		=> "dvmm_{$button_name}_col_max_width_f",
			'default'			=> '',
			'selector' 			=> array(
				'normal'	=> "{$module->main_css_element} .dvmm_{$button_name}__wrap",
				'fixed'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name}__wrap",
			),
			'property' 			=> 'max-width',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Button column background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> "dvmm_{$button_name}_col_bg_color",
			'setting_fixed'		=> "dvmm_{$button_name}_col_bg_color_f",
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_{$button_name}__wrap",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_{$button_name}__wrap:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name}__wrap",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name}__wrap:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Button vertical alignment
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> "dvmm_{$button_name}_vertical_alignment",
			'setting_fixed'		=> "dvmm_{$button_name}_vertical_alignment_f",
			'default'			=> '',
			'selector' 			=> array(
				'normal'	=> "{$module->main_css_element} .dvmm_{$button_name}__wrap",
				'fixed'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name}__wrap",
			),
			'property' 			=> 'align-items',
			'additional_css'	=> '',
			'field_type'		=> 'select',
			'priority'			=> ''
		));

		// Button horizontal alignment
		$module->helpers()->declare_element_content_horizontal_alignment_css( $module->props, $render_slug, array( 
			'setting' 		=> "dvmm_{$button_name}_horizontal_alignment",
			'setting_fixed'	=> "dvmm_{$button_name}_horizontal_alignment_f",
			'selector' 		=> array(
				'normal'			=> "{$module->main_css_element} .dvmm_{$button_name}__wrap", // container
				'normal_stretch'	=> "{$module->main_css_element} .dvmm_{$button_name}__wrap .dvmm_{$button_name}", // item(content)
				'fixed'				=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name}__wrap",
				'fixed_stretch'		=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name}__wrap .dvmm_{$button_name}",
			),
		));

		// Button icon position
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array(
			'setting' 			=> "dvmm_{$button_name}_icon_placement",
			'selector' 			=> $dvmm_button,
			'property' 			=> 'flex-flow',
			'additional_css'	=> '',
			'field_type'		=> 'select',
			'priority'			=> ''
		));

		// Button icon visibility
		$module->helpers()->declare_element_responsive_visibility_css( 
			$module->props, 
			"dvmm_{$button_name}_show_icon",
			"{$dvmm_button__wrap} .dvmm_button_icon",
			$render_slug
		);

		/**
		 * Declare the button font icon CSS
		 * if the icon is enabled and the 'font_icon' type selected.
		 */
		if($enable_icon === 'on' && $icon_type === 'font_icon'){
			// if($module->helpers()->is_divi_older_than("4.13.0")){ // TBU
				// @since v1.7.3 (updated @since v1.7.4)
				$module->helpers()->declare_font_icon_css( $module->props, $render_slug, array(
					'setting' 	=> "dvmm_{$button_name}_icon",
					'selector' 	=> "{$dvmm_button__wrap} .dvmm_button_icon.dvmm_icon_type--font_icon:after",
					'hover_selector' => "{$dvmm_button__wrap} .dvmm_button:hover .dvmm_button_icon.dvmm_icon_type--font_icon:after",
				));
			// } else {
			// 	// Font icon style - @since v1.7.4 - // TBU
			// 	$module->generate_styles(
			// 		array(
			// 			'utility_arg'    => 'icon_font_family_and_content',
			// 			'render_slug'    => $render_slug,
			// 			'base_attr_name' => "dvmm_{$button_name}_icon",
			// 			'selector'       => "{$dvmm_button__wrap} .dvmm_button_icon.dvmm_icon_type--font_icon:after",
			// 			'hover_selector' => "{$dvmm_button__wrap} .dvmm_button:hover .dvmm_button_icon.dvmm_icon_type--font_icon:after",
			// 			'important'      => true, // bool
			// 			'processor'      => $module->helpers()->is_divi_older_than("4.13.0") ? array() : array(
			// 				'ET_Builder_Module_Helper_Style_Processor',
			// 				'process_extended_icon',
			// 			),
			// 		)
			// 	);
			// }
		}

		// Button margin
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> "dvmm_{$button_name}_margin",
			'setting_fixed'		=> "dvmm_{$button_name}_margin_f",
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_{$button_name}",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_{$button_name}:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name}",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name}:hover",
			),
			'property' 			=> 'margin',
			'additional_css'	=> '',
			'field_type'		=> 'custom_margin',
			'priority'			=> ''
		));

		// Button padding
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> "dvmm_{$button_name}_padding",
			'setting_fixed'		=> "dvmm_{$button_name}_padding_f",
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_{$button_name}",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_{$button_name}:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name}",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name}:hover",
			),
			'property' 			=> 'padding',
			// 'additional_css'	=> '',
			'additional_css'	=> "{$additional_css}", // for DBP
			'field_type'		=> 'custom_padding',
			'priority'			=> ''
		));

		// Button Text margin
		$module->helpers()->generate_responsive_css__spacing( $module->props, $render_slug, array( 
			'setting' 			=> "dvmm_{$button_name}_text_margin",
			'setting_fixed'		=> "dvmm_{$button_name}_text_margin_f",
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_{$button_name} .dvmm_button_text",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_{$button_name}:hover .dvmm_button_text",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name} .dvmm_button_text",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name}:hover .dvmm_button_text",
			),
			'property' 			=> 'margin',
			'additional_css'	=> '',
			'field_type'		=> 'custom_margin',
			'priority'			=> ''
		));

		// Button icon size
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> "dvmm_{$button_name}_icon_size",
			'setting_fixed'		=> "dvmm_{$button_name}_icon_size_f",
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_{$button_name} .dvmm_button_icon",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_{$button_name}:hover .dvmm_button_icon",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name} .dvmm_button_icon",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name}:hover .dvmm_button_icon",
			),
			'property' 			=> 'font-size',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Button icon color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> "dvmm_{$button_name}_icon_color",
			'setting_fixed'		=> "dvmm_{$button_name}_icon_color_f",
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_{$button_name} .dvmm_button_icon",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_{$button_name}:hover .dvmm_button_icon",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name} .dvmm_button_icon",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name}:hover .dvmm_button_icon",
			),
			'property' 			=> 'color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		// Button background color
		$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
			'setting' 			=> "dvmm_{$button_name}_bg_color",
			'setting_fixed'		=> "dvmm_{$button_name}_bg_color_f",
			'default'			=> '',
			'selector' 			=> array(
				'normal'		=> "{$module->main_css_element} .dvmm_{$button_name}",
				'normal_hover'	=> "{$module->main_css_element} .dvmm_{$button_name}:hover",
				'fixed'			=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name}",
				'fixed_hover'	=> "{$module->main_css_element} .dvmm_fixed .dvmm_{$button_name}:hover",
			),
			'property' 			=> 'background-color',
			'additional_css'	=> '',
			'field_type'		=> '',
			'priority'			=> ''
		));

		/**
		 * Button transitions.
		 * @since v1.3.5
		 */
		$module->helpers()->declare_responsive_transition_styles($module, $render_slug, array(
			'properties' 	 => array('all'),
			'selector'		 => "{$module->main_css_element}.dvmm_transitions--on .dvmm_element.dvmm_button__wrap",
			'additional_css' => 'important',
		));

		/**
		 * If the user is logged in and the "Authenticated User Content" is enabled
		 * @since v1.6
		 */
		$_auth = $module->helpers()->_auth_suffix( $module->props, $button_name );
		// @todo: Add these props to the $processed_props
		$buttonType  = $module->props["{$button_name}_type{$_auth}"];
		$popupID 	 = $module->props["{$button_name}_pp_id{$_auth}"];
		$triggerType = $module->props["{$button_name}_pp_toggle{$_auth}"];

		// Popup selector
		$popup_selector = $buttonType === 'popup' && isset($popupID) && $popupID !== '' ? "#{$popupID}" : '';

		/**
		 * Declare the popup(s) position CSS.
		 * @since	v1.6
		 */
		$module->popups()->declare_popup_position_css( $module, $render_slug, array(
			'element'	=> $button_name,
			'selector'	=> $popup_selector,
		));

		/**
		 * Declare the popup(s) visibility CSS.
		 * @since	v1.6
		 */
		$module->popups()->declare_popup_visibility_css( $module, $render_slug, array(
			'element'	=> $button_name,
			'selector'	=> $popup_selector,
		));

		/**
		 * Declare the popup(s) animation CSS.
		 * @since	v1.6
		 */
		$module->popups()->declare_popup_animation_css( $module, $render_slug, array(
			'element'	=> $button_name,
		));

		/**
		 * Is popup valid.
		 * @since	v1.6
		 * @todo	Add to the @see $_processed_props
		 */
		$is_popup_valid = $buttonType === 'popup' && !empty($popupID) && $triggerType === 'primary' ? true : false;

		/**
		 * Popup CSS should only be generated by the 'primary' trigger.
		 * @since	v1.6
		 */
		if($is_popup_valid === true){

			// Popup overlay selector
			$popup_overlay_selector = "{$module->main_css_element}__{$button_name}__popup_overlay--{$popupID}";
			
			// Popup Close Button 'X' icon color
			$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
				'setting' 			=> "{$button_name}_pp_x_color{$_auth}",
				'selector' 			=> array(
					'normal'		=> "#{$popupID} button.dvmm_popup_close div.dvmm_close--left, #{$popupID} button.dvmm_popup_close div.dvmm_close--right",
					'normal_hover'	=> "#{$popupID} button.dvmm_popup_close:hover div.dvmm_close--left, #{$popupID} button.dvmm_popup_close:hover div.dvmm_close--right",
				),
				'property' 			=> 'background-color',
				'additional_css'	=> '',
				'field_type'		=> '',
				'priority'			=> ''
			));

			// Popup overlay background color
			$module->helpers()->generate_responsive_css( $module->props, $render_slug, array(
				'setting' 			=> "{$button_name}_pp_overlay_bgcolor{$_auth}",
				'selector' 			=> array(
					'normal'		=> $popup_overlay_selector,
					'normal_hover'	=> "{$popup_overlay_selector}:hover",
				),
				'property' 			=> 'background-color',
				'additional_css'	=> '',
				'field_type'		=> '',
				'priority'			=> ''
			));

			// Popup z-index
			$module->helpers()->generate_responsive_css( $module->props, $render_slug, array( 
				'setting' 			=> "{$button_name}_pp_zindex{$_auth}",
				'selector' 			=> array(
					'normal'		=> "#{$popupID}",
					// 'normal_hover'	=> "#{$popupID}:hover",
				),
				'property' 			=> 'z-index',
				'additional_css'	=> '',
				'field_type'		=> '',
				'priority'			=> ''
			));

			// Declare the popup overlay z-index CSS
			$module->popups()->declare_popup_overlay_zindex_css( $module, $render_slug, array(
				'element'	=> $button_name,
				'selector'	=> $popup_overlay_selector,
			));
		}
	}

	/**
	 * Render CTA button(s).
	 *
	 * @since v1.0.0
	 * 
	 * @param	object	$module				Module object.
	 * @param	array	$processed_props	Processed props.
	 * @param	string	$render_slug		Module slug.
	 * @param	string	$button_name		Rendered button('button_one' or 'button_two').
	 *
	 * @return string
	 */
	public function render( $module, $processed_props, $render_slug, $button_name ) {

		// return empty if this element is disabled or not visible
		if ( ! $module->helpers()->maybe_render_element( $module->props, $button_name ) ) {
			return '';
		}

		/**
		 * PROPS
		 */
		/**
		 * If the user is logged in and the Authenticated User Content is enabled
		 * @since v1.5
		 */
		$_enable_auth = $module->props["dvmm_{$button_name}_enable_auth"];
		$isAuth = is_user_logged_in() && $_enable_auth === 'on';

		/**
		 * If the user is logged in and the "Authenticated User Content" is enabled
		 * @since v1.6
		 * @todo Add this into the $processed_props
		 */
		$_auth = $module->helpers()->_auth_suffix( $module->props, $button_name );

		// button relationship
		$button_rel		= $module->props["dvmm_{$button_name}_rel{$_auth}"];

		// multi view
		$multi_view	= et_pb_multi_view_options( $module );

		// enable button icon
		$enable_icon = $module->props["dvmm_{$button_name}_enable_icon"];

		// selected icon type
		$icon_type = $module->props["dvmm_{$button_name}_icon_type"];

		// button link target
		$link_target = '';

		/**
		 * Processed props
		 */
		$_is_fixed_enabled 	= $processed_props['is_fixed_enabled'];

		// module class
		$this->main_css_element = '%%order_class%%';
		
		// icon values
		$_icons			= et_pb_responsive_options()->get_property_values( $module->props, "dvmm_{$button_name}_icon{$_auth}" );
		$_icon			= isset( $_icons['desktop'] ) ? $_icons['desktop'] : '';
		$_icon_tablet	= isset( $_icons['tablet'] ) ? $_icons['tablet'] : '';
		$_icon_phone	= isset( $_icons['phone'] ) ? $_icons['phone'] : '';
		$_is_any_icon_set	= ('' !== $_icon || '' !== $_icon_tablet || '' !== $_icon_phone) ? true : false;
		
		// Background layout data attributes.
		$data_background_layout = et_pb_background_layout_options()->get_background_layout_attrs( $module->props );

		// Background layout class names.
		$background_layout_class_names = et_pb_background_layout_options()->get_background_layout_class( $module->props );
		$module->add_classname( $background_layout_class_names );

		// Module classnames
		// $module->remove_classname( 'et_pb_module' );

		/**
		 * PROPCESSED PROPS(NORMAL)
		 */
		$_processed_props = array(
			'_enable_icon'		=> $enable_icon,
			'_icon_type'		=> $icon_type,
			'_icon'         	=> $_icon,
			'_icon_tablet'  	=> $_icon_tablet,
			'_icon_phone'   	=> $_icon_phone,
			'_is_any_icon_set' 	=> $_is_any_icon_set,
		);

		// FIXED HEADER
		if( $_is_fixed_enabled === true ){

			/**
			 * PROPCESSED PROPS(FIXED)
			 */
			$_processed_props_f = array(

			);

			// merge processed props with 'fixed' processed props
			$_processed_props = array_merge( $_processed_props, $_processed_props_f );

		}

		/**
		 * BUTTON TEXT
		 */
		// button text ("dvmm_{$button_name}_text" OR "dvmm_{$button_name}_text_auth")
		$button_text = $multi_view->render_element( array(
			// 'tag'	  => 'span',
			'content' => "{{dvmm_{$button_name}_text{$_auth}}}",
			'attrs'	  => array(
				'class' => 'dvmm_button_text',
			),
			'required'	=> array(
				"dvmm_enable_{$button_name}" => 'on',
				"dvmm_{$button_name}_text{$_auth}"	 => '__not_empty'
			),
			'hover_selector' => "{$this->main_css_element} .dvmm_{$button_name}",
		) );
		// END BUTTON TEXT
			
		/**
		 * BUTTON URL
		 */
		// Logout or a custom URL (Auth.)
		$_link_type_auth	= $module->props["dvmm_{$button_name}_link_type_auth"];
		// Custom URL (Auth.)
		$button_url_auth	= $module->props["dvmm_{$button_name}_url_auth"];
		// Redirect to the current page('current_url') or to a custom URL ('custom_url') (Auth.)
		$_logout_redirect	= $module->props["dvmm_{$button_name}_logout_redirect"];
		// Custom redirect URL (Auth.)
		$_redirect_url		= $module->props["dvmm_{$button_name}_redirect_url"];

		// Redirect to the selected page on logout
		$_redirect_to = 'current_url' === $_logout_redirect
						? ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
						: $_redirect_url;

		// The button URL (final)
		// @todo: Add these props to the $processed_props
		$buttonType = $module->props["{$button_name}_type{$_auth}"];
		// $popupID = $module->props["{$button_name}_pp_id{$_auth}"];
		// $triggerType = $module->props["{$button_name}_pp_toggle{$_auth}"];

		if($buttonType === 'url'){
			if($isAuth){
				$button_url_ = $_link_type_auth === 'logout' ? wp_logout_url( esc_url( $_redirect_to ) ) : $button_url_auth;
			} else {
				$button_url_ = $module->props["dvmm_{$button_name}_url"];
			}
		} else {
			// Don't add the URL if the 'popup' is enabled
			$button_url_ = '';
		}
		// END BUTTON URL

		/**
		 * BUTTON ICON/IMAGE
		 */
		// button image (normal)
		$img_alt             	= $module->props["dvmm_{$button_name}_img_alt{$_auth}"];
		$button_url            	= trim( $button_url_ );
		$button_url_new_window 	= $module->props["dvmm_{$button_name}_url_new_window{$_auth}"];

		// ("dvmm_{$button_name}_img" OR "dvmm_{$button_name}_img_auth")
		$img_html = $multi_view->render_element( array(
			'tag'            => 'img',
			'attrs'          => array(
				'src' => "{{dvmm_{$button_name}_img{$_auth}}}",
				'alt' => $img_alt,
			),
			'classes'		 => array(
				'dvmm_button_img' => array(
					"dvmm_enable_{$button_name}" 		=> 'on',
					"dvmm_{$button_name}_enable_icon" 	=> 'on',
					"dvmm_{$button_name}_icon_type" 	=> 'image_icon',
				)
			),
			'required'       => array(
				"dvmm_enable_{$button_name}" 		=> 'on',
				"dvmm_{$button_name}_enable_icon" 	=> 'on',
				"dvmm_{$button_name}_icon_type" 	=> 'image_icon',
				"dvmm_{$button_name}_img{$_auth}" 	=> '__not_empty'
			),
			'hover_selector' => "{$this->main_css_element} .dvmm_{$button_name}",
		) );

		// button image (fixed)
		// ("dvmm_{$button_name}_img_f" OR "dvmm_{$button_name}_img_auth_f")
		$img_html_f = $multi_view->render_element( array(
			'tag'            => 'img',
			'attrs'          => array(
				'src' => "{{dvmm_{$button_name}_img{$_auth}_f}}",
				'alt' => $img_alt,
			),
			'classes'		 => array(
				'dvmm_button_img__fixed' => array(
					"dvmm_enable_{$button_name}" 		=> 'on',
					"dvmm_{$button_name}_enable_icon" 	=> 'on',
					"dvmm_enable_fixed_header" 			=> 'on',
					"dvmm_{$button_name}_use_fixed_img" => 'on',
					"dvmm_{$button_name}_icon_type" 	=> 'image_icon',
				)
			),
			'required'       => array(
				"dvmm_enable_{$button_name}" 		=> 'on',
				"dvmm_{$button_name}_enable_icon" 	=> 'on',
				"dvmm_enable_fixed_header" 			=> 'on',
				"dvmm_{$button_name}_use_fixed_img" => 'on',
				"dvmm_{$button_name}_icon_type" 	=> 'image_icon',
				"dvmm_{$button_name}_img{$_auth}_f" => '__not_empty'
			),
			'hover_selector' => "{$this->main_css_element} .dvmm_{$button_name}",
		) );

		// check if the button image icon fields have any values (for desktop, hover, tablet and phone)
		// render button image icon <img /> tag conditionally (NORMAL)
		$img_values = $module->helpers()->get_property_values_all( $module->props, "dvmm_{$button_name}_img{$_auth}", '', false );

		if($img_values['responsive'] === 'off'){
			$_img_html = ($img_values['desktop'] === '' && $img_values['hover'] === '') ? '' : $img_html;
		} else {
			$_img_html = $img_html;
		}

		// render button image icon <img /> tag conditionally (FIXED)
		$img_values_f = $module->helpers()->get_property_values_all( $module->props, "dvmm_{$button_name}_img{$_auth}_f", '', false );

		if($img_values_f['responsive'] === 'off'){
			$_img_html_f = ($img_values_f['desktop'] === '' && $img_values_f['hover'] === '') ? '' : $img_html_f;
		} else {
			$_img_html_f = $img_html_f;
		}

		// button icon container
		$dvmm_button_icon_container = $enable_icon === 'on' ? sprintf(
				'<span class="dvmm_button_icon dvmm_icon_type--%1$s">
					%2$s
					%3$s
				</span>',
				esc_attr( $icon_type ),
				et_core_esc_previously( $_img_html ),
				et_core_esc_previously( $_img_html_f )
			) : '';

		/**
		 * Don't render empty icon container if the icon is enabled and
		 * the 'image_icon' type is selected but no image icons set/uploaded.
		 * 
		 * @todo this is a TEMPORARY condition, need a better/cleaner way to do this.
		 * 
		 */
		if( $enable_icon === 'on' && $icon_type === 'image_icon' ){
			$dvmm_button_icon_container = $_img_html === '' && $_img_html_f === '' ? '' : $dvmm_button_icon_container;
		}
		// END BUTTON ICON/IMAGE

		if ( ! empty( $button_url ) ) {
			$link_target = ( 'on' === $button_url_new_window ) ? 'target="_blank"' : '';
		}

		// merge all processed props
		$processed_props = array_merge( $processed_props, $_processed_props );

		// get the button wrapper classes
		$button_wrap_classes = implode(' ', $this->button_wrap_classes( $module, $processed_props, $button_name ) );

		// get the button wrapper data attributes (for both normal and fixed headers)
		$button_wrap_data_attrs = implode(' ', $this->wrapper_data_attributes( $module, $processed_props, $button_name ) );

		// get the button data attributes (for both normal and fixed headers)
		$button_data_attrs = implode(' ', $this->button_data_attributes( $module, $render_slug, $processed_props, $button_name ) );

		// get button classes (for both normal and fixed headers)
		$button_classes = $this->button_classes( $module, $processed_props, $button_name );

		// get button ID
		$button_ID = $this->button_ID( $module, $processed_props, $button_name );

		// add button CSS
		$this->css( $module, $render_slug, $processed_props, $button_name );

		// Render output
		$output = sprintf(
			'<div class="%1$s" %2$s>
				<a href="%3$s" id="%10$s" %4$s %5$s class="%6$s" %7$s>
					%8$s
					%9$s
				</a>
			</div>',
			esc_attr( $button_wrap_classes ),
			et_core_esc_previously( $button_wrap_data_attrs ),
			esc_url( $button_url ),
			et_core_intentionally_unescaped( $link_target, 'fixed_string' ),
			et_core_esc_previously( $module->get_rel_attributes( $button_rel ) ),
			esc_attr( implode( ' ', array_unique( $button_classes ) ) ),
			et_core_esc_previously( $button_data_attrs ),
			et_core_esc_previously( $button_text ),
			et_core_esc_previously( $dvmm_button_icon_container ),
			esc_attr( $button_ID )
		);

		return $output;
	}
}

/**
 * Intstantiates the DVMM_Menu_CTA_Button class.
 * 
 * @since   1.0.0
 * 
 * @return  Instance of the DVMM_Menu_CTA_Button class.
 * 
 */
function dvmm_menu_cta_button_class_instance( ) {
	return DVMM_Menu_CTA_Button::instance( );
}