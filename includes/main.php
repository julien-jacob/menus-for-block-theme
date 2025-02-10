<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Call all functions that act if the corresponding options are activated
 *
 * @return void
 */
function mfbt_main() {

	if ( is_multisite() ) {
		return;
	}

	if ( ! empty( get_option( 'mfbt_add_global_styles' ) ) ) {
		add_action( 'admin_head', 'mfbt_add_global_styles' );
	}

	if ( ! empty( get_option( 'mfbt_show_customizer' ) ) ) {
		add_action( 'admin_head', 'mfbt_display_customizer' );
	}

	if ( ! empty( get_option( 'mfbt_disable_files_editor' ) ) ) {
		mfbt_disallow_file_edit();
	}

	if ( ! empty( get_option( 'mfbt_show_reusable_blocks' ) ) ) {
		add_action( 'admin_menu', 'mfbt_display_reusable_blocks' );
	}

	if ( ! empty( get_option( 'mfbt_show_navigation_menu' ) ) ) {
		add_action( 'admin_menu', 'mfbt_display_navigation_menu' );
	}

	if ( ! empty( get_option( 'mfbt_show_templates' ) ) ) {
		add_action( 'admin_menu', 'mfbt_display_templates' );
	}

	if ( ! empty( get_option( 'mfbt_show_template_parts' ) ) ) {
		add_action( 'admin_menu', 'mfbt_display_template_parts' );
	}
}


/**
 * Loads MFBT plugin's translated strings.
 *
 * @return void
 */
function mfbt_load_plugin_textdomain() {
	load_plugin_textdomain(
		'menus-for-block-theme',
		false,
		basename( dirname( __FILE__ ) ) . '/languages'
	);
}


/**
 * Display Glogal styles in the admin area
 *
 * @return void
 */
function mfbt_add_global_styles() {

	add_theme_page(
		__( 'Global styles', 'menus-for-block-theme' ),
		__( 'Global styles', 'menus-for-block-theme' ),
		'manage_options',
		'site-editor.php?path=%2Fwp_global_styles',
		'',
		7
	);

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

	$customize_url = sanitize_url(
		add_query_arg(
			'return',
			urlencode(
				remove_query_arg(
					wp_removable_query_args(),
					wp_unslash( $_SERVER['REQUEST_URI'] )
				)
			),
			'customize.php'
		)
	);

	$position = ( wp_is_block_theme() || current_theme_supports( 'block-template-parts' ) ) ? 7 : 6;

	$submenu['themes.php'][ $position ] = array( __( 'Customize' ), 'customize', esc_url( $customize_url ), '', 'hide-if-no-customize' );

}


/**
 * Display Reusable Blocks link in the admin area
 *
 * @return void
 */
function mfbt_display_reusable_blocks() {

	add_theme_page(
		__( 'Reusable Blocks', 'menus-for-block-theme' ),
		__( 'Reusable Blocks', 'menus-for-block-theme' ),
		'manage_options',
		'edit.php?post_type=wp_block',
		'',
		8
	);

}


/**
 * Display Navigation Menu link in the admin area
 *
 * @return void
 */
function mfbt_display_navigation_menu() {

	add_theme_page(
		__( 'Nav Menu', 'menus-for-block-theme' ),
		__( 'Nav Menu', 'menus-for-block-theme' ),
		'manage_options',
		'site-editor.php?postType=wp_navigation',
		'',
		9
	);

}


/**
 * Display Templates link in the admin area
 *
 * @return void
 */
function mfbt_display_templates() {

	add_theme_page(
		__( 'Templates', 'menus-for-block-theme' ),
		__( 'Templates', 'menus-for-block-theme' ),
		'manage_options',
		'site-editor.php?postType=wp_template',
		'',
		10
	);

}


/**
 * Display Patterns link in the admin area
 *
 * @return void
 */
function mfbt_display_template_parts() {

	add_theme_page(
		__( 'Patterns', 'menus-for-block-theme' ),
		__( 'Patterns', 'menus-for-block-theme' ),
		'manage_options',
		'site-editor.php?postType=wp_block',
		'',
		11
	);

}
