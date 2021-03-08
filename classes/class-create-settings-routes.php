<?php
/**
 * This file will create Custom Rest API End Points.
 */
class WP_React_Settings_Rest_Route {

    public function __construct() {
        add_action( 'rest_api_init', [ $this, 'create_rest_routes' ] );
    }

    public function create_rest_routes() {
        register_rest_route( 'wprk/v1', '/settings', [
            'methods' => 'GET',
            'callback' => [ $this, 'get_settings' ],
            'permission_callback' => [ $this, 'get_settings_permission' ]
        ] );
        register_rest_route( 'wprk/v1', '/settings', [
            'methods' => 'POST',
            'callback' => [ $this, 'save_settings' ],
            'permission_callback' => [ $this, 'save_settings_permission' ]
        ] );
    }

    public function get_settings() {
        $firstname = get_option( 'wprk_settings_firstname' );
        $lastname  = get_option( 'wprk_settings_lastname' );
        $email     = get_option( 'wprk_settings_email' );
        $response = [
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'email'     => $email
        ];

        return rest_ensure_response( $response );
    }

    public function get_settings_permission() {
        return true;
    }

    public function save_settings( $req ) {
        $firstname = sanitize_text_field( $req['firstname'] );
        $lastname  = sanitize_text_field( $req['lastname'] );
        $email     = sanitize_text_field( $req['email'] );
        update_option( 'wprk_settings_firstname', $firstname );
        update_option( 'wprk_settings_lastname', $lastname );
        update_option( 'wprk_settings_email', $email );
        return rest_ensure_response( 'success' );
    }

    public function save_settings_permission() {
        return current_user_can( 'publish_posts' );
    }
}
new WP_React_Settings_Rest_Route();