<?php
/**
 * Plugin Name: WP React KickOff
 * Author: Md. Rabiul Islam Robi
 * Author URI: https://github.com/robicse11127
 * Version: 1.0.0
 * Description: WordPress React KickOff.
 * Text-Domain: wp-react-kickoff
 */
if( ! defined( 'ABSPATH' ) ) : exit(); endif; // No direct access allowed.

/**
 * Define plugin constants
 */
define( 'WPRK_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'WPRK_URL', trailingslashit( plugins_url('/', __FILE__) ) );

/**
 * Loading Necessary Scripts
 */
add_action( 'admin_enqueue_scripts', 'load_scripts' );
function load_scripts() {
    // wp_enqueue_style( 'wp-react-chart-admin', WPRK_URL . 'css/app.css', array(), wp_rand(), 'all' ); // phpcs:ignore
    wp_enqueue_script( 'wp-react-chart-admin', WPRK_URL . 'dist/bundle.js', array( 'jquery', 'wp-element' ), wp_rand(), true ); // phpcs:ignore
    wp_localize_script( 'wp-react-chart-admin', 'appLocalizer', [
        'apiUrl' => home_url( '/wp-json' ),
        'nonce'  => wp_create_nonce( 'wp_rest' ),
    ] );
}
require_once WPRK_PATH . 'classes/class-create-admin-menu.php';
require_once WPRK_PATH . 'classes/class-create-settings-routes.php';