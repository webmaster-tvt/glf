<?php

class DVMM_DiviMadMenu extends DiviExtension {

	/**
	 * The gettext domain for the extension's translations.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $gettext_domain = 'dvmm-divi-mad-menu';

	/**
	 * The extension's WP Plugin name.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $name = 'divi-mad-menu';

	/**
	 * The extension's version
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $version = DVMM_MADMENU_VERSION;

	/**
	 * DVMM_DiviMadMenu constructor.
	 *
	 * @param string $name
	 * @param array  $args
	 */
	public function __construct( $name = 'divi-mad-menu', $args = array() ) {

		$this->plugin_dir     = plugin_dir_path( __FILE__ );
		$this->plugin_dir_url = plugin_dir_url( $this->plugin_dir );

		/**
		 * BUILDER JS DATA
		 * 
		 * Add JS data to the window.DiviMadMenuBuilderData object (the APP window)
		 */
		$this->_builder_js_data = array(
			'defaults' 		=> [],
			'menus' 		=> dvmm_madmenu_get_all_menus_html(),
			'logout_url' 	=> wp_logout_url(),
		);

		/**
		 * FRONT-END JS DATA
		 * 
		 * Add JS data to the window.DiviMadMenuFrontendData object
		 */
		$this->_frontend_js_data = array(
			'defaults' 	=> [],
		);

		parent::__construct( $name, $args );
		
	}
}

new DVMM_DiviMadMenu;
