<?php
class WP_React_Chart_Rest_Routes {

    public function __construct() {
        add_action( 'rest_api_init', [ $this, 'create_rest_routes' ] );
    }

    /**
     * Create rest route endpoint.
     *
     * @return void
     */
    public function create_rest_routes() {
        register_rest_route( 'wprk/v1', '/settings', array(
            'methods' => 'GET',
            'callback' => [ $this, 'get_settings' ],
            'permission_callback' => [ $this, 'get_settings_permission' ],
        ) );

        register_rest_route( 'wprk/v1', '/settings', array(
            'methods' => 'POST',
            'callback' => [ $this, 'save_settings' ],
            'permission_callback' => [ $this, 'save_settings_permission' ],
        ) );
    }

    /**
     * Rest route endpoint callback.
     *
     * @return void
     */
    public function get_settings() {
        $firstname = get_option( 'wprk_settings_firstname' );
        $lastname  = get_option( 'wprk_settings_lastname' );
        $email     = get_option( 'wprk_settings_email' );
        $response = [
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'email'     => $email,
        ];
        return rest_ensure_response( $response );
    }

    public function get_settings_permission() {
        return true;
    }

    public function save_settings( $req ) {
        $firstname = sanitize_text_field( $req['firstname'] );
        $lastname  = sanitize_text_field( $req['lastname'] );
        $email     = sanitize_email( $req['email'] );
        update_option( 'wprk_settings_firstname', $firstname );
        update_option( 'wprk_settings_lastname', $lastname );
        update_option( 'wprk_settings_email', $email );
        return rest_ensure_response( 'succes' );
    }

    public function save_settings_permission() {
        return current_user_can( 'publish_posts' );
        return true;
    }

}
new WP_React_Chart_Rest_Routes();