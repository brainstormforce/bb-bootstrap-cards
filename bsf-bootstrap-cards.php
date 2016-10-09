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
function bsf_load_bootstrap_card() {
	if ( class_exists( 'FLBuilder' ) ) {
	    require_once 'bsf-bootstrap-cards/bsf-bootstrap-cards.php';
	}
}
add_action( 'init', 'bsf_load_bootstrap_card', 9999 );

