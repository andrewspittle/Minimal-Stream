<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'ms_options', 'minimal_stream_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'minimal_stream' ), __( 'Theme Options', 'minimal_stream' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'minimal_stream' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'minimal_stream' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'ms_options' ); ?>
			<?php $options = get_option( 'minimal_stream_options' ); ?>

			<table class="form-table">

				<?php
				/**
				 * A sample text input option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Profile picture', 'minimal_stream' ); ?></th>
					<td>
						<input id="minimal_stream_options[profilepic]" class="regular-text" type="text" name="minimal_stream_options[profilepic]" value="<?php esc_attr_e( $options['profilepic'] ); ?>" />
						<label class="description" for="minimal_stream_options[profilepic]"><?php _e( 'Enter the path to your profile picture. This appears alongside the header image.', 'minimal_stream' ); ?></label>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'minimal_stream' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $select_options, $radio_options;

	// Say our text option must be safe text with no HTML tags
	$input['profilepic'] = wp_filter_nohtml_kses( $input['profilepic'] );

	return $input;
}

// adapted from http://themeshaper.com/2010/06/03/sample-theme-options/