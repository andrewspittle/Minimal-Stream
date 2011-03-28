<?php
if ( ! isset( $content_width ) )
	$content_width = 560;

/** Tell WordPress to run mnmlist_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'mnmlist_setup' );

if ( ! function_exists( 'mnmlist_setup' ) ):
function mnmlist_setup() {
	
	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'status' ) );
	
}
endif;

/**
 * Remove inline styles printed when the gallery shortcode is used.
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 */
function mnmlist_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'mnmlist_remove_gallery_css' );
	
if ( ! function_exists( 'mnmlist_comment' ) ) :
function mnmlist_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'mnmlist' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'mnmlist' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'mnmlist' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'mnmlist' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'mnmlist' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'mnmlist' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;
/* Props Noel http://blog.noel.io/tweet-this-wordpress-function/ */
function tweet_this() {
	global $post;
	$tweet = sprintf( __('Currently reading %1$s %2$s'), $post->post_title, wp_get_shortlink() );
	echo '<a class="tweethis" href="http://twitter.com/home?status=' . urlencode( $tweet ) . '">Tweet this</a>';
}
?>