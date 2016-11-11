<?php
/**
 * Plugin Name: Bootstrap Cards Module For Beaver Builder 
 * Plugin URI: https://www.brainstormforce.com/
 * Description: This is a plugin for creating Awesome Bootstrap Card.
 * Version: 1.0
 * Author: Brainstorm force
 * Author URI: https://www.brainstormforce.com/
 * Text Domain: bb-bootstrap-cards
 */
define( 'BB_BOOTSTRAPCARDS_DIR', plugin_dir_path( __FILE__ ) );
define( 'BB_BOOTSTRAPCARDS_URL', plugins_url( '/', __FILE__ ) );

/**
 * Custom modules
 */
// check of BSFBBBootstrapCards class already exist or not
if ( !class_exists( 'BSFBBBootstrapCards' ) ) {

    class BSFBBBootstrapCards
    {
        
        function __construct() {
            add_action( 'init', array( $this, 'load_bootstrap_card' ) );
            add_action('init', array( $this, 'load_textdomain'));
        }

        // function to load BB Bootstrap Cards
        function load_bootstrap_card() {

            if ( class_exists( 'FLBuilder' ) ) {

                // If class exist it loads the module
                require_once 'bb-bootstrap-cards-module/bb-bootstrap-cards-module.php';

            }

            else {

                // Display admin notice for activating beaver builder
                add_action('admin_notices',array($this,'admin_notices_function'));
                add_action('network_admin_notices',array($this,'admin_notices_function'));

            }
        }

        // function to load text domain
        public function load_textdomain() {
            
            load_plugin_textdomain( 'bb-bootstrap-cards' );
            
        }

        // function to display admin notice
        function admin_notices_function() {

            // check for Beaver Builder Installed / Activated or not
            if ( file_exists( plugin_dir_path( 'bb-plugin-agency/fl-builder.php' ) ) 

                || file_exists( plugin_dir_path( 'beaver-builder-lite-version/fl-builder.php' ) ) ) {

                $url = network_admin_url() . 'plugins.php?s=Beaver+Builder+Plugin';
            
            } 
            
            else {
            
                $url = network_admin_url() . 'plugin-install.php?s=billyyoung&tab=search&type=author';
            
            }
            
            echo '<div class="notice notice-error">';

                echo "<p>The <strong>Bootstrap Cards For Beaver Builder</strong> " . __( 'plugin requires', 'bb-bootstrap-cards' )." <strong><a href='".$url."'>Beaver Builder</strong></a>" . __( ' plugin installed & activated.', 'bb-bootstrap-cards' ) . "</p>";
            
            echo '</div>';
        } 
    }

    new BSFBBBootstrapCards();
}