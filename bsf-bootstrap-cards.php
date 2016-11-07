<?php
/**
 * Plugin Name: Bootstrap Cards Module For Beaver Builder 
 * Plugin URI: http://www.ultimatebeaver.com/
 * Description: This is a plugin for creating Bootstrap Card builder modules.
 * Version: 1.0
 * Author: Bhushan Boabde
 * Author URI: http://www.ultimatebeaver.com/
 */
define( 'BSF_MODULE_CARDS_DIR', plugin_dir_path( __FILE__ ) );
define( 'BSF_MODULE_CARDS_URL', plugins_url( '/', __FILE__ ) );

/**
 * Custom modules
 */

if ( !class_exists( 'BSFBBBootstarpCards' ) ) {

    class BSFBBBootstarpCards
    {
        
        function __construct() {
            add_action( 'init', array( $this, 'load_bootstrap_card' ) );
        }

        function load_bootstrap_card() {
            if ( class_exists( 'FLBuilder' ) ) {
                require_once 'bsf-bootstrap-cards/bsf-bootstrap-cards.php';
            }
        } 
    }

    new BSFBBBootstarpCards();
}