<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Display wp error screen if options disabled for current user.
 * Copy of the et_pb_check_options_access() function.
 * 
 * @since   v1.0.0
 * 
 */
function dvmm_check_options_access() {
	// display wp error screen if theme/plugin options disabled for current user
	if ( ! et_pb_is_allowed( 'theme_options' ) ) {
		wp_die( esc_html__( "You don't have sufficient permissions to access this page!", 'dvmm-divi-mad-menu' ) );
	}
}

/**
 * Add the MadMenu admin page and menu 
 * under the Divi main admin menu.
 * 
 * @since v1.0.0 
 * 
 */
if ( ! function_exists( 'dvmm_add_madmenu_admin_page' ) ) {
    function dvmm_add_madmenu_admin_page() {
        /**
         * Check if the top level menu exists and add the submenu item.
         * For Divi and Divi Builder plugin it is "et_divi_options" 
         * and for Extra it is "et_extra_options".
         * Return if none of them found.
         */
        if ( empty ( $GLOBALS['admin_page_hooks']['et_divi_options'] ) && empty ( $GLOBALS['admin_page_hooks']['et_extra_options'] )){
            return;
        }

        $parent = !empty ( $GLOBALS['admin_page_hooks']['et_extra_options'] ) ? 'et_extra_options' : 'et_divi_options';

        // add submenu page
        $dvmm_page = add_submenu_page(
            $parent,
            esc_html__( 'MadMenu', 'dvmm-divi-mad-menu' ),
            esc_html__( 'MadMenu', 'dvmm-divi-mad-menu' ),
            // 'edit_others_posts', // this is the lowest requirement to use VB
            'manage_options',
            'dvmm_madmenu',
            'dvmm_madmenu_admin_page'
        );

        // load function to check the permissions of current user
        add_action( "load-{$dvmm_page}", 'dvmm_check_options_access' );

        // enqueue the admin JS (alternative way of enqueueing scripts on MadMenu admin page only)
        // add_action( "admin_print_scripts-{$dvmm_page}", 'dvmm_madmenu_admin_enqueue_scripts' );
    }
}
add_action( 'admin_menu', 'dvmm_add_madmenu_admin_page', 101 ); // wait for Divi (or Extra) menu to be added first

/**
 * Enqueue admin JS and CSS.
 * 
 * @since v1.0.0
 * 
 */
if ( ! function_exists( 'dvmm_madmenu_admin_enqueue_scripts' ) ) {
    function dvmm_madmenu_admin_enqueue_scripts($hook) {
        // don't enqueue if it is not the MadMenu admin page ("divi_page_dvmm_madmenu" is same for Divi & DB Plugin)
        if ( 'divi_page_dvmm_madmenu' != $hook && 'extra_page_dvmm_madmenu' != $hook ) {
            return;
        }

        // Admin JS scripts
        wp_enqueue_script( 'dvmm_admin_js', DVMM_MADMENU_PLUGIN_PATH . 'admin/scripts/admin.js', array( 'jquery', 'jquery-ui-tabs', 'jquery-form' ), DVMM_MADMENU_VERSION );

        // data for JS
        wp_localize_script( 'dvmm_admin_js', 'dvmmAdminPanelSettings', array(
            // 'dvmm_admin_nonce'   => wp_create_nonce( 'dvmm_admin_nonce' ),
        ) );

        // Admin CSS
        wp_register_style( 'dvmm_admin_css', DVMM_MADMENU_PLUGIN_PATH . 'admin/styles/admin.css', false, DVMM_MADMENU_VERSION );
        wp_enqueue_style( 'dvmm_admin_css' );
    }
}
add_action( 'admin_enqueue_scripts', 'dvmm_madmenu_admin_enqueue_scripts', 101 );

/**
 * Add plugin Settings link under its name on the Plugins page.
 *
 * @since 	2.7.0
 * @param	array	$links	Array of links.
 * @return	array	$links	Modified array of links.
 */
function dvmm_madmenu_settings_link( $links ){
    // Settings link 
    $settings_link = '<a href="admin.php?page=dvmm_madmenu">' . esc_html__( 'Settings', 'dvmm-divi-mad-menu' ) . '</a>';

    // Add the settings link into links array
    array_unshift( $links, $settings_link );

    return $links;
}
add_filter( "plugin_action_links_" . DVMM_MADMENU_BASENAME, 'dvmm_madmenu_settings_link' );

/**
 * Admin page template.
 *
 * @since	v1.0.0
 *
 * @return void
 */
function dvmm_madmenu_admin_page() {

    // tabs
    $tabs = array(
        'updates' => _x( 'Updates', 'plugin updates', 'dvmm-divi-mad-menu' ),
    );

    ?>
    <div id="wrapper">
        <div id="panel-wrap">
            <form method="post" action="options.php" id="main_options_form" enctype="multipart/form-data">
                <?php 

                // Output the form hidden fileds (option_page, action and _wpnonce)
                settings_fields('dvmm_madmenu_license');

                ?>
                <div id="dvmm-panel" class="">
                    <div id="dvmm-panel-header">
                        <img src="<?php echo DVMM_MADMENU_PLUGIN_PATH . 'admin/assets/logo.png'?>" class="dvmm-logo"/>
                        <h1 id="dvmm-panel-title">MadMenu Options</h1>
                    </div>
                    <ul id="dvmm-panel-mainmenu">
                        <?php
                            foreach ( $tabs as $tab_slug => $tab_name ) {
                                printf( '<li><a href="#wrap-%1$s">%2$s</a></li>', esc_attr( $tab_slug ), esc_html( $tab_name ) );
                            }
                        ?>
                    </ul><!-- end dvmm-panel-mainmenu -->
                    <div id="dvmm-updates" class="dvmm_tab_content dvmm_updates">
                        <?php

                        /**
                         * Add the license activation fileds.
                         */
                        do_action('dvmm_madmenu_license_activation');

                        ?>
                    </div>
                </div> <!-- end dvmm-panel div -->
                <div id="dvmm-panel-bottom" class="dvmm_panel_bottom">
                    <?php submit_button( __('Save Changes'), 'primary', 'submit', false ); ?>
                </div>
            </form>
        </div>
    </div>
    <?php
}

/**
 * Add the Beta version notice to admin page.
 * 
 * @since   v0.1
 * 
 * @todo    Remove/hide when a stable version is released.
 * 
 */
function dvmm_madmenu_beta_version_notice(){
    ?>
	<div class="notice notice-warning is-dismissible">
        <p><?php _e( 'You are using the <b>Beta</b> version of the <b>Divi MadMenu</b>! It is <b>not recommended</b> to use the Beta version on your live site because it may still be unstable.', 'dvmm-divi-mad-menu' ); ?></p>
	</div>
	<?php
}
// add_action('admin_notices', 'dvmm_madmenu_beta_version_notice');