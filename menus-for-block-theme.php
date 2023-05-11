<?php
/*
Plugin Name: Menus for Block Theme
Plugin URI: https://la-webeuse.com/menus-for-block-theme/
Description: Add classic menus to Block Themes. Display the customizer in admin menu. Disable files editor for plugins and themes.
Version: 1.0.0
Text Domain: menus-for-block-theme
Domain Path: /languages/
Author: Lycia Diaz
Author URI: https://la-webeuse.com/
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


// Load plugin text domain
load_plugin_textdomain( 
	'menus-for-block-theme', 
	false, 
	basename( dirname( __FILE__ ) ) . '/languages' 
);

// Load require PHP files
require_once plugin_dir_path( __FILE__ ) . 'includes/admin.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/main.php';

/**
 * Add all necessary actions and filters of the plugin
 *
 * @return void
 */
function mfbt_start() {

	add_action( 'admin_menu', 'mfbt_create_menu' );
    add_action( 'admin_init', 'mfbt_register_settings' );
	add_action( 'init', 'mfbt_main' );
	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'mfbt_settings_link' );

}
mfbt_start();
