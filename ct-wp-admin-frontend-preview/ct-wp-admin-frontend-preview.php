<?php
// /wp-content/plugins/ct-wp-admin-frontend-preview/ct-wp-admin-frontend-preview.php
/**
 * Plugin Name:       Ultimate shortcode previewer
 * Description:       Preview shortcodes in admin panel using iframe
 * Version:           1.0.0
 * Text Domain:       ct-admin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'CT_WP_PREVIEW_ADMIN_VERSION', '1.0.0' );

define( 'CT_WP_PREVIEW_ADMIN_DIR', 'ct-wp-admin-frontend-preview' );

/**
 * Helpers
 */
require plugin_dir_path( __FILE__ ) . 'includes/helpers.php';


/**
 * The core plugin class
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ct-wp-admin-frontend-preview.php';


function run_ct_wp_frontend_preview() {

    $plugin = new Ct_Admin_Frontend_Preview();
    $plugin->init();

}
run_ct_wp_frontend_preview();

