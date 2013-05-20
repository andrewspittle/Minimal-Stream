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
	$content_width = 550; /* pixels */

if ( ! function_exists( 'minimal_stream_setup' ) ) :
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
	 * Register custom image sizes
	 */
	add_image_size( 'featured-thumbnail', 183, 100, true ); //200 pixels wide, 150 pixels tall, cropped
	add_image_size( 'featured-big', 550, 9999 ); //737 pixels wide, unlimited height

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'minimal_stream' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'status', 'image' ) );
}
endif; // minimal_stream_setup
add_action( 'after_setup_theme', 'minimal_stream_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Search page widgets', 'minimal_stream' ),
		'id' => 'sidebar-1',
		'description' => 'Appears in the search page template. Recommended use is for links or custom menu widgets that list your favorite posts.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'minimal_stream_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function minimal_stream_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri(), '', '20130516-1' );
	
	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'minimal_stream_scripts' );

/**
 * Implement custom excerpt link
 */
function minimal_stream_excerpt_more( $more ) {
	global $post;
	return '... <a class="moretag" href="'. get_permalink($post->ID) . '">Continue reading &rarr;</a>';
}
add_filter('excerpt_more', 'minimal_stream_excerpt_more');

/**
 * Implement custom excerpt length
 */
function minimal_stream_excerpt_length( $length ) {
	return 45;
}
add_filter( 'excerpt_length', 'minimal_stream_excerpt_length', 999 );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Load up our awesome theme options
 */
require_once ( get_template_directory() . '/inc/theme-options.php' );

/**
 * Remove URL field from the comment form
 */
add_filter( 'comment_form_default_fields', 'minimal_stream_remove_url' );

function minimal_stream_remove_url( $arg ) {
    $arg['url'] = '';
    return $arg;
}
