<?php
/**
 * Custom header implementation. Props _s.
 *
 * @package Minimal Stream
 * @since Minimal Stream 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @uses minimal_stream_admin_header_style()
 * @uses minimal_stream_admin_header_image()
 *
 * @package Minimal Stream
 */
function minimal_stream_custom_header_setup() {
	$args = array(
		'default-image'          => '',
		'default-text-color'     => '000',
		'width'                  => 250,
		'height'                 => 250,
		'flex-height'            => false,
		'header-text'			 => false,
		'admin-head-callback'    => 'minimal_stream_admin_header_style',
		'admin-preview-callback' => 'minimal_stream_admin_header_image',
	);

	$args = apply_filters( 'minimal_stream_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-header', $args );
	} else {
		// Compat: Versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR',    $args['default-text-color'] );
		define( 'HEADER_IMAGE',        $args['default-image'] );
		define( 'HEADER_IMAGE_WIDTH',  $args['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $args['height'] );
		add_custom_image_header( $args['wp-head-callback'], $args['admin-head-callback'], $args['admin-preview-callback'] );
	}
}
add_action( 'after_setup_theme', 'minimal_stream_custom_header_setup' );

/**
 * Shiv for get_custom_header().
 *
 * get_custom_header() was introduced to WordPress
 * in version 3.4. To provide backward compatibility
 * with previous versions, we will define our own version
 * of this function.
 *
 * @return stdClass All properties represent attributes of the curent header image.
 *
 * @package _s
 * @since Minimal Stream 1.1
 */

if ( ! function_exists( 'get_custom_header' ) ) {
	function get_custom_header() {
		return (object) array(
			'url'           => get_header_image(),
			'thumbnail_url' => get_header_image(),
			'width'         => HEADER_IMAGE_WIDTH,
			'height'        => HEADER_IMAGE_HEIGHT,
		);
	}
}

if ( ! function_exists( 'minimal_stream_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see minimal_stream_custom_header_setup().
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg img {
		max-height: 75px;
		max-width: 100%;
	}
	</style>
<?php
}
endif; // minimal_stream_admin_header_style

if ( ! function_exists( 'minimal_stream_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see minimal_stream_custom_header_setup().
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_admin_header_image() { ?>
	<div id="headimg">
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<a id="name" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" alt="" /></a>
		<?php endif; ?>
	</div>
<?php }
endif; // minimal_stream_admin_header_image