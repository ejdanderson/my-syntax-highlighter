<?php

/**
 * Prevent Direct Access
 */
defined( 'ABSPATH' ) or die( "Restricted access!" );

/**
 * Register text domain
 */
function spacexchimp_p010_textdomain() {
    load_plugin_textdomain( SPACEXCHIMP_P010_TEXT, false, SPACEXCHIMP_P010_DIR . '/languages/' );
}
add_action( 'init', 'spacexchimp_p010_textdomain' );

/**
 * Print direct link to plugin admin page
 *
 * Fetches array of links generated by WP Plugin admin page ( Deactivate | Edit )
 * and inserts a link to the plugin admin page
 *
 * @param  array $links Array of links generated by WP in Plugin Admin page.
 * @return array        Array of links to be output on Plugin Admin page.
 */
function spacexchimp_p010_settings_link( $links ) {
    $page = '<a href="' . admin_url( 'options-general.php?page=' . SPACEXCHIMP_P010_SLUG . '.php' ) .'">' . __( 'Settings', SPACEXCHIMP_P010_TEXT ) . '</a>';
    array_unshift( $links, $page );
    return $links;
}
add_filter( 'plugin_action_links_' . SPACEXCHIMP_P010_BASE, 'spacexchimp_p010_settings_link' );

/**
 * Print additional links to plugin meta row
 */
function spacexchimp_p010_plugin_row_meta( $links, $file ) {

    if ( strpos( $file, SPACEXCHIMP_P010_SLUG . '.php' ) !== false ) {

        $new_links = array(
                           'donate' => '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8A88KC7TFF6CS" target="_blank"><span class="dashicons dashicons-heart"></span> ' . __( 'Donate', SPACEXCHIMP_P010_TEXT ) . '</a>'
                           );
        $links = array_merge( $links, $new_links );
    }

    return $links;
}
add_filter( 'plugin_row_meta', 'spacexchimp_p010_plugin_row_meta', 10, 2 );

/**
 * Register plugin's submenu in the "Settings" Admin Menu
 */
function spacexchimp_p010_register_submenu_page() {
    $menu_title = __( 'Syntax Highlighter', SPACEXCHIMP_P010_TEXT );
    $capability = 'manage_options';
    add_options_page( SPACEXCHIMP_P010_NAME, $menu_title, $capability, SPACEXCHIMP_P010_SLUG, 'spacexchimp_p010_render_submenu_page' );
}
add_action( 'admin_menu', 'spacexchimp_p010_register_submenu_page' );

/**
 * Register settings
 */
function spacexchimp_p010_register_settings() {
    register_setting( SPACEXCHIMP_P010_SETTINGS . '_settings_group', SPACEXCHIMP_P010_SETTINGS . '_settings' );
    register_setting( SPACEXCHIMP_P010_SETTINGS . '_settings_group_si', SPACEXCHIMP_P010_SETTINGS . '_service_info' );
}
add_action( 'admin_init', 'spacexchimp_p010_register_settings' );
