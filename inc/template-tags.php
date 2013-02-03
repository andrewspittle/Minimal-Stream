<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Minimal Stream
 * @since Minimal Stream 1.0
 */

if ( ! function_exists( 'minimal_stream_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'minimal_stream' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'minimal_stream' ) . '</span> Prev' ); ?>
		<span class="nav-sep">//</span>
		<?php next_post_link( '<div class="nav-next">%link</div>', 'Next <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'minimal_stream' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'minimal_stream' ) ); ?></div>
		<?php endif; ?>
		<span class="nav-sep">//</span>
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
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s:', 'minimal_stream' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'minimal_stream' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date */
						printf( __( '%1$s', 'minimal_stream' ), get_comment_date( 'M jS, Y' ) ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'minimal_stream' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
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
function minimal_stream_posted_on() {
	if ( !is_single() ) {
		printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>', 'minimal_stream' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
	}
	else {
		printf( __( 'Posted on <time class="entry-date" datetime="%1$s" pubdate>%2$s</time>', 'minimal_stream' ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
	}
}
endif;

if ( ! function_exists( 'minimal_stream_author_bio' ) ) :
/**
 * Outputs author bio below single post permalinks.
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_author_bio() {
	?>
	<div class="author-bio">
		<?php printf( __( '<span class="avatar-wrap">%1$s</span> <h4>About %2$s</h4><p>%3$s</p>', 'minimal_stream' ),
			get_avatar( get_the_author_meta( 'email' ), '70' ),
			esc_attr( get_the_author() ),
			get_the_author_meta( 'description' )
		); ?>
	</div><?php
	
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
 * Simple post title function for the front-page template.
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_front_page_title() {
	?>
	<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'minimal_stream' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	<?php
}

/**
 * Return the most recent standard post type.
 *
 * Used in a custom front-page template.
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_front_page_feature() {
	// Props @mfields. http://wordpress.mfields.org/2011/post-format-queries/
	$formats = get_post_format_slugs();
	 
	foreach ( (array) $formats as $i => $format ) {
	    $formats[$i] = 'post-format-' . $format;
	}
	 
	$standard_posts = get_posts( array(
		'numberposts' => 1,
	    'tax_query' => array(
	        array(
	          'taxonomy' => 'post_format',
	          'field'    => 'slug',
	          'terms'    => $formats,
	          'operator' => 'NOT IN'
	        )
	    )
	) );
	 
	global $post;
	print '<div class="front-page-feature">';
	foreach( (array) $standard_posts as $post ) {
		setup_postdata( $post );
			print '<article ';
			post_class();
			print '>';
		    print '<header class="entry-header">';
			the_post_thumbnail( 'featured-big' );
		    minimal_stream_front_page_title();
		    print '<div class="entry-meta">';
		    minimal_stream_posted_on();
		    print '</div>';
		    print '</header>';
		    print '<div class="entry-content">';
		    the_content();
		    print '</div>';
		    print '<footer class="entry-meta">';
		    edit_post_link( __( 'Edit', 'minimal_stream' ), '<span class="edit-link">', '</span>' );
		    print '</footer>';
		    print '</article>';
	}
	print '</div>';

	wp_reset_postdata();
}

/**
 * Return the most recent standard post types offset by one.
 *
 * Used in a custom front-page template.
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_front_page_asides() {
	// Props @mfields. http://wordpress.mfields.org/2011/post-format-queries/
	$formats = get_post_format_slugs();
	 
	foreach ( (array) $formats as $i => $format ) {
	    $formats[$i] = 'post-format-' . $format;
	}
	 
	$standard_posts = get_posts( array(
		'numberposts' => 3,
		'offset' => 1,
	    'tax_query' => array(
	        array(
	          'taxonomy' => 'post_format',
	          'field'    => 'slug',
	          'terms'    => $formats,
	          'operator' => 'NOT IN'
	        )
	    )
	) );
	 
	global $post;
	print '<div class="front-page-asides">';
	foreach( (array) $standard_posts as $post ) {
		setup_postdata( $post );
			print '<article ';
			post_class();
			print '>';
		    print '<header class="entry-header">';
		    minimal_stream_front_page_title();
		    print '<span class="entry-meta">';
		    minimal_stream_posted_on();
		    print '</span>';
		    print '</article>';
	}
	print '</div>';

	wp_reset_postdata();
}

/**
 * Return archives and split in to columns.
 *
 * Used in a custom search-page template.
 *
 * @since Minimal Stream 1.0
 */
function minimal_stream_archives() {
	// Grab the archives. Return the output
	$get_archives = wp_get_archives( 'echo=0' );
	// Split into array items
	$archives_array = explode('</li>',$get_archives);
	// Amount of archives (count of items in array)
	$results_total = count($archives_array);
	// How many columns to display
	$archives_per_list = ceil($results_total / 3);
	// Counter number for tagging onto each list
	$list_number = 1;
	// Set the archive result counter to zero
	$result_number = 0;
	?>
	<h3 class="archive-title">Monthly Archives</h3>
	<ul class="archive_col" id="archive-col-<?php echo $list_number; ?>">
	<?php
	foreach($archives_array as $archive) {
		$result_number++;

		if($result_number % $archives_per_list == 0) {
			$list_number++;
			echo $archive.'</li>
			</ul>
			<ul class="archive_col" id="archive-col-'.$list_number.'">';
		}
		else {
			echo $archive.'</li>';
		}
	}
}
