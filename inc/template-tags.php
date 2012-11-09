<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Minimal Stream
 * @since Minimal Stream 1.0
 */

if ( ! function_exists( 'minimal_stream_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_content_nav( $nav_id ) {
	global $wp_query;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'minimal_stream' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'minimal_stream' ) . '</span>' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '<span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'minimal_stream' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'minimal_stream' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'minimal_stream' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // minimal_stream_content_nav

if ( ! function_exists( 'minimal_stream_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'minimal_stream' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'minimal_stream' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 60 ); ?>
					<?php printf( __( '%s <span class="says">says,</span>', 'minimal_stream' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'minimal_stream' ); ?></em>
					<br />
				<?php endif; ?>
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for minimal_stream_comment()

if ( ! function_exists( 'minimal_stream_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_posted_on( $post_id = null, $echo = true, $post_timestamp = null ) {
	if ( !isset( $post_id ) ) {
		global $post;
		$post_id = $post->ID;
	}
	if ( !$post_timestamp )
		$post_timestamp = get_post_time( 'U', true, $post_id );
	$current_timestamp = time();

	// Only do the relative timestamps for 7 days or less, then just the month and day
	if ( $post_timestamp > ( $current_timestamp - 604800 ) )
		$html = human_time_diff( $post_timestamp ) . ' ago';
	else if ( $post_timestamp > ( $current_timestamp - 220752000 ) && date( 'Y', $post_timestamp ) == date( 'Y' ) )
		$html = date( 'F jS', $post_timestamp );
	else
		$html = date( 'F j, Y', $post_timestamp );

	if ( $echo )
		echo 'Posted ', $html;
	else
		return $html;
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so minimal_stream_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so minimal_stream_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in minimal_stream_categorized_blog
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'minimal_stream_category_transient_flusher' );
add_action( 'save_post', 'minimal_stream_category_transient_flusher' );

/**
 * Custom excerpt filter
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_excerpt( $more ) {
	global $post;
	return '... <a href="'. get_permalink($post->ID) . '">More &rarr;</a>';
}
add_filter('excerpt_more', 'minimal_stream_excerpt');