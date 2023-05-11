<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Call Calls all functions that act if the corresponding options are activated
 *
 * @return void
 */
function mfbt_main() {

	if ( is_multisite() ) {
		return;
	}

	if ( ! empty( get_option( 'mfbt_add_theme_support_menu' ) ) ) {
		mfbt_add_theme_support_menus();
	}

	if ( ! empty( get_option( 'mfbt_show_customizer' ) ) ) {
		add_action( 'admin_head', 'mfbt_display_customizer' );
	}

	if ( ! empty( get_option( 'mfbt_disable_files_editor' ) ) ) {
		mfbt_disallow_file_edit();
	}
}


/**
 * Add the value 'menus' to add_theme_support
 *
 * @return void
 */
function mfbt_add_theme_support_menus() {
	add_theme_support( 'menus' );
}


/**
 * Disable files editor in the admin area
 *
 * @return void
 */
function mfbt_disallow_file_edit() {
	define( 'DISALLOW_FILE_EDIT', true );
}


/**
 * Display customizer link in the admin area
 *
 * @return void
 */
function mfbt_display_customizer() {

	global $submenu;

	$customize_url = add_query_arg( 'return', urlencode( remove_query_arg( wp_removable_query_args(), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ), 'customize.php' );

	$position = ( wp_is_block_theme() || current_theme_supports( 'block-template-parts' ) ) ? 7 : 6;

	$submenu['themes.php'][ $position ] = array( __( 'Customize' ), 'customize', esc_url( $customize_url ), '', 'hide-if-no-customize' );

}
