<?php
/**
 * This file will create admin menu page.
 */

class WPRK_Create_Admin_Page {

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'create_admin_menu' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts_styles' ] );
    }

    public function register_scripts_styles() {
        $this->load_scripts();
        $this->load_styles();
    }

    public function load_scripts() {
        wp_register_script( 'wprk-admin', WPREACTKICKOFF_URL . 'dist/bundle.js', [], wp_rand(), true );
        wp_enqueue_script( 'wprk-admin' );
        wp_localize_script( 'wprk-admin', 'wprk', [
            'api_url' => home_url( '/wp-json' ),
            'nonce'   => wp_create_nonce( 'wprk_nonce' ),
        ] );
    }

    public function load_styles() {

    }

    public function create_admin_menu() {
        global $submenu;

        $capability = 'manage_options';
        $slug       = 'wprk-settings';

        add_menu_page(
            __( 'WP React KickOff', 'wp-react-kickoff' ),
            __( 'WP React KickOff', 'wp-react-kickoff' ),
            $capability,
            $slug,
            [ $this, 'menu_page_template' ],
            'dashicons-buddicons-replies'
        );

        // add_action( 'load-' . $hook, [ $this, 'init_hooks' ] );
    }

    public function menu_page_template() {
        echo '<div class="wrap"><div id="wprk-admin-app"></div></div>';
    }
}
new WPRK_Create_Admin_Page();