<?php
/**
 * Minimal Stream functions and definitions
 *
 * @package Minimal Stream
 * @since Minimal Stream 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Minimal Stream 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'minimal_stream_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Minimal Stream, use a find and replace
	 * to change 'minimal_stream' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'minimal_stream', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	
	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	/**
	 * Set Post Thumbnail size
	 */
	 add_image_size( 'featured-image', 1200, 9999 ); //1200 pixels wide (and unlimited height)

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'minimal_stream' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'link', 'status' ) );
}
endif; // minimal_stream_setup
add_action( 'after_setup_theme', 'minimal_stream_setup' );

/**
 * Register widgetized area and update footer with default widgets
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Footer', 'minimal_stream' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'minimal_stream_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function minimal_stream_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'minimal_stream_scripts' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );