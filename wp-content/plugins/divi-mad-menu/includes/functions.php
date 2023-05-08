<?php 

// Die if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Enqueue Theme Builder CSS.
 * Also enqueued on the backend Divi Builder("The Latest Divi Builder Experience")
 * by checking if it is "post.php"(@todo is there a better way to check that???).
 * 
 * @since v1.8.3
 * 
 * @param	$hook	Page.
 * 
 */
if ( ! function_exists( 'dvmm_madmenu_tb_admin_enqueue_scripts' ) ) {
    function dvmm_madmenu_tb_admin_enqueue_scripts($hook) {

        // don't enqueue if it is not the Theme Builder/backend Divi Builder page
        if ( 'divi_page_et_theme_builder' !== $hook && 'extra_page_et_theme_builder' !== $hook && 'post.php' !== $hook ) {
            return;
        }

        // Theme Builder CSS
        wp_register_style( 'dvmm_tb_admin_css', DVMM_MADMENU_PLUGIN_PATH . 'admin/styles/theme-builder.css', false, DVMM_MADMENU_VERSION );
        wp_enqueue_style( 'dvmm_tb_admin_css' );
    }
}
add_action( 'admin_enqueue_scripts', 'dvmm_madmenu_tb_admin_enqueue_scripts', 101 );

/**
 * Update the woocommerce cart contents.
 * 
 * (Check if the "Enable AJAX add to cart buttons on archives" is enabled 
 * in WooCommerce->Settings->Products->General)
 * 
 * @since   1.3
 */
if ( 'yes' === get_option( 'woocommerce_enable_ajax_add_to_cart' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'dvmm_woo_cart_contents_fragment', 10, 1 );
}
 
/**
 * Woo cart contents fragment.
 * 
 * Updates the cart contents when new items added/removed 
 * and adds the "dvmm_cart_empty" CSS class to the cart if it is empty. 
 * This CSS class is needed for hiding the empty cart contents if this feature is enabled
 * (it works in combination with the "dvmm_hide_empty_cart_contents" CSS class).
 * 
 * @uses	WooCommerce fragments (using AJAX)
 * 
 * @since   1.3
 */
function dvmm_woo_cart_contents_fragment( $fragments ) {

	$items_number 		= WC()->cart->get_cart_contents_count();
	$cart_items_text 	= _nx( 'Item', 'Items', $items_number, 'WooCommerce items number', 'dvmm-divi-mad-menu' );
	$cart_empty 		= empty($items_number) ? "dvmm_cart_empty" : "";

	ob_start();

	?><div class="dvmm_cart_contents <?php echo esc_html($cart_empty); ?>">
		<div class="dvmm_cart_items_count">
			<span class="dvmm_cart_items_number"><?php echo $items_number; ?></span>
			<span class="dvmm_cart_items_text"><?php echo $cart_items_text; ?></span>
		</div>
		<div class="dvmm_cart_total_amount">
			<?php echo WC()->cart->get_cart_subtotal();?>
		</div>
	</div>
	<?php

	$fragments['.dvmm_cart_button__wrap.dvmm_cart_ajax_update--enabled .dvmm_cart_contents'] = ob_get_clean();

	return $fragments;
}

/**
 * Add the class with page ID to menu item so that
 * it can be easily found by ID in Visual Builder
 * 
 * @since	v1.3.4
 *
 * @return	object	Menu item
 */
function dvmm_madmenu_modify_menu_item( $menu_item ) {

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
 * @since	v1.3.4
 * 
 * @param	string	$menuClass	CSS class of the menu.
 * @return	string	$menu		The HTML of the default menu.
 */
function dvmm_madmenu_default_menu( $menuClass = 'dvmm_menu' ){

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
 * @since	v1.3.4
 *
 * @param	array	$args	Argumets.
 * @return	string			Menu markup (<ul>...</ul>).
 */
function dvmm_madmenu_get_the_menu( $args = array() ) {

	$defaults = array(
		'menu_id' => '',
	);

	// modify the menu item to include the required data
	add_filter( 'wp_setup_nav_menu_item', 'dvmm_madmenu_modify_menu_item' );

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
		'walker'		 => dvmm_madmenu_walker_nav_menu_instance( $args ),
	);

	if ( '' !== $args['menu_id'] ) {
		$menu_args['menu'] = (int) $args['menu_id'];
	}

	$filter		= 'dvmm_menu_args';
	$navMenu 	= wp_nav_menu( apply_filters( $filter, $menu_args ) );

	/**
	 * Display the default menu if no menu has been selected
	 * (the menu ID is 'none').
	 */
	if ( empty( $navMenu ) || $args['menu_id'] === 'none' ) {
		// use the default menu
		$menu .= dvmm_madmenu_default_menu( $menuClass );
	} else {
		// use the selected menu (even if it has no items)
		$menu .= $navMenu;
	}

	remove_filter( 'wp_setup_nav_menu_item', 'dvmm_madmenu_modify_menu_item' );

	return $menu;
}

/**
 * Get the menu assigned to the "primary-menu" location
 * (for the window.DiviMadMenuBuilderData.menus object).
 * 
 * @since	v1.3.5
 *
 * @return	string	Menu markup (<ul>...</ul>).
 */
function dvmm_madmenu_get_the_primary_menu() {

	// get menu locations with menu IDs
	$theme_locations = get_nav_menu_locations();

	// check if the "primary-menu" location has been assigned a menu
	if(isset($theme_locations["primary-menu"])){
		// get the ID of the menu assigned to the "primary-menu" location
		$primary_menu_ID = $theme_locations["primary-menu"];
	} else {
		// if no menus assigned to "primary-menu" location
		return false;
	}

	$args = array(
		'menu_id' => $primary_menu_ID,
	);

	// modify the menu item to include the required data
	add_filter( 'wp_setup_nav_menu_item', 'dvmm_madmenu_modify_menu_item' );

	// menu classes (<ul></ul>)
	$menuClass = "dvmm_menu dvmm_menu--{$primary_menu_ID}";

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
		'walker'		 => dvmm_madmenu_walker_nav_menu_instance( $args ),
	);

	$filter		= 'dvmm_primary_menu_args';
	$navMenu 	= wp_nav_menu( apply_filters( $filter, $menu_args ) );

	remove_filter( 'wp_setup_nav_menu_item', 'dvmm_madmenu_modify_menu_item' );

	return $navMenu;
}

/**
 * Generate all menus HTML
 * for the window.DiviMadMenuBuilderData.menus object.
 * 
 * @since	v1.3.4 (updated in v1.3.5)
 * 
 * @return	array	$menus	Array of all existing menus including the default menu.
 */
function dvmm_madmenu_get_all_menus_html(){

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
		$menu = dvmm_madmenu_get_the_menu( array(
			'menu_id' => $menu_id,
		) );
		// add to menus array
		$menus[$menu_id] = $menu;
	}

	// get the default menu HTML
	$default = dvmm_madmenu_default_menu( $menuClass );

	// add the default menu to menus array with the 'none' key
	$menus['none'] = $default;

	// get the primary menu
	$primary_menu = dvmm_madmenu_get_the_primary_menu();

	// add the primary menu to menus array with the 'primaryMenu' key
	$menus['primaryMenu'] = $primary_menu;

	return $menus;
}