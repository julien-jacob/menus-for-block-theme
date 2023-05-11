<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Create a menu link for the plugin settings in the admin area
 *
 * @return void
 */
function mfbt_create_menu() {

	add_submenu_page(
		'options-general.php',
		__( 'Menus for Block Theme : Settings', 'menus-for-block-theme' ),
		__( 'MFBT Settings', 'menus-for-block-theme'),
		'administrator',
		'mfbt-settings',
		'mfbt_settings'
	);

}


/**
 * register settings
 *
 * @return void
 */
function mfbt_register_settings() {

	register_setting( 'mfbt_settings', 'mfbt_add_theme_support_menu' );
	register_setting( 'mfbt_settings', 'mfbt_show_customizer' );
	register_setting( 'mfbt_settings', 'mfbt_disable_files_editor' );
	register_setting( 'mfbt_settings', 'mfbt_show_reusable_blocks' );
	register_setting( 'mfbt_settings', 'mfbt_show_navigation_menu' );
	register_setting( 'mfbt_settings', 'mfbt_show_templates' );
	register_setting( 'mfbt_settings', 'mfbt_show_template_parts' );

}


/**
 * Add 'Settings' link on the plugin list
 *
 * @param array $settings
 * @return array
 */
function mfbt_settings_link( $settings ) {

	$url = esc_url(
		add_query_arg(
			'page',
			'mfbt-settings',
			get_admin_url() . 'options-general.php'
		)
	);

	$settings[] = '<a href="' . $url . '">' . __( 'Settings', 'menus-for-block-theme' ) . '</a>';

	return $settings;
}


/**
 * Option page for the plugin
 *
 * @return void
 */
function mfbt_settings() {

	if ( is_multisite() ) {
		?>
		<div class="wrap">
			<h1><?php _e( 'Menus for Block Theme', 'menus-for-block-theme' ); ?></h1>
			<p><?php _e( 'Not available on WordPress Multisite', 'menus-for-block-theme' ); ?></p>
		</div>
		<?php
		return;
	}

	?>
	<div class="wrap">
		<h1><?php _e( 'Menus for Block Theme', 'menus-for-block-theme' ); ?></h1>
		
		<form method="post" action="options.php">
			<?php
			settings_fields( 'mfbt_settings' );
			do_settings_sections( 'mfbt_settings' );
			?>

			<table class="form-table">

				<tr>
					<th scope="row"><?php _e( 'Support menus', 'menus-for-block-theme' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text">
								<span><?php _e( 'Support menus', 'menus-for-block-theme' ); ?></span>
							</legend>
							<label for="mfbt_add_theme_support_menu">
								<input type="checkbox" id="mfbt_add_theme_support_menu" name="mfbt_add_theme_support_menu" value="1" <?php checked( 1, get_option( 'mfbt_add_theme_support_menu' ), true ); ?> /> <?php _e( 'Add classic menus for block theme (Appearance > Menus)', 'menus-for-block-theme' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr>
					<th scope="row"><?php _e( 'Customizer', 'menus-for-block-theme' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text">
								<span><?php _e( 'Customizer', 'menus-for-block-theme' ); ?></span>
							</legend>
							<label for="mfbt_show_customizer">
								<input type="checkbox" id="mfbt_show_customizer" name="mfbt_show_customizer" value="1" <?php checked( 1, get_option( 'mfbt_show_customizer' ), true ); ?> /> <?php _e( 'Display the customizer in admin menu (Appearance > Customize)', 'menus-for-block-theme' ); ?>
							</label>
						</fieldset>
					</td>
				</tr>

				<tr>
					<th scope="row"><?php _e( 'Reusable Blocks', 'menus-for-block-theme' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text">
								<span><?php _e( 'Reusable Blocks', 'menus-for-block-theme' ); ?></span>
							</legend>
							<label for="mfbt_show_reusable_blocks">
								<input type="checkbox" id="mfbt_show_reusable_blocks" name="mfbt_show_reusable_blocks" value="1" <?php checked( 1, get_option( 'mfbt_show_reusable_blocks' ), true ); ?> /> <?php _e( 'Display shortcut to the reusable blocks management screen (Appearance > Reusable Blocks) ', 'menus-for-block-theme' ); ?>
							</label>
						</fieldset>
					</td>
				</tr>

				<tr>
					<th scope="row"><?php _e( 'Navigation Menu', 'menus-for-block-theme' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text">
								<span><?php _e( 'Navigation Menu', 'menus-for-block-theme' ); ?></span>
							</legend>
							<label for="mfbt_show_navigation_menu">
								<input type="checkbox" id="mfbt_show_navigation_menu" name="mfbt_show_navigation_menu" value="1" <?php checked( 1, get_option( 'mfbt_show_navigation_menu' ), true ); ?> /> <?php _e( 'Display shortcut to menu list (Appearance > Navigation menus)', 'menus-for-block-theme' ); ?>
							</label>
						</fieldset>
					</td>
				</tr>

				<tr>
					<th scope="row"><?php _e( 'Templates', 'menus-for-block-theme' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text">
								<span><?php _e( 'Templates', 'menus-for-block-theme' ); ?></span>
							</legend>
							<label for="mfbt_show_templates">
								<input type="checkbox" id="mfbt_show_templates" name="mfbt_show_templates" value="1" <?php checked( 1, get_option( 'mfbt_show_templates' ), true ); ?> /> <?php _e( 'Display shortcut to templates list (Appearance > Templates)', 'menus-for-block-theme' ); ?>
							</label>
						</fieldset>
					</td>
				</tr>

				<tr>
					<th scope="row"><?php _e( 'Template Parts', 'menus-for-block-theme' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text">
								<span><?php _e( 'Template Parts', 'menus-for-block-theme' ); ?></span>
							</legend>
							<label for="mfbt_show_template_parts">
								<input type="checkbox" id="mfbt_show_template_parts" name="mfbt_show_template_parts" value="1" <?php checked( 1, get_option( 'mfbt_show_template_parts' ), true ); ?> /> <?php _e( 'Display shortcut to template parts list (Appearance > Template Parts)', 'menus-for-block-theme' ); ?>
							</label>
						</fieldset>
					</td>
				</tr>

				<tr>
					<th scope="row"><?php _e( 'File editor', 'menus-for-block-theme' ); ?></th>
					<td>
						<fieldset>
							<legend class="screen-reader-text">
								<span><?php _e( 'File editor', 'menus-for-block-theme' ); ?></span>
							</legend>
							<label for="mfbt_disable_files_editor">
								<input type="checkbox" id="mfbt_disable_files_editor" name="mfbt_disable_files_editor" value="1" <?php checked( 1, get_option( 'mfbt_disable_files_editor' ), true ); ?> /> <?php _e( 'Disable file editor for plugins and themes (Tools > Theme / Plugin File Editor)', 'menus-for-block-theme' ); ?>
							</label>
						</fieldset>
					</td>
				</tr>
				
			</table>
			
			<?php submit_button(); ?>
		
		</form>
	</div>
	<?php
}
