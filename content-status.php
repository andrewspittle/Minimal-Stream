<?php
/**
 * The template for displaying status posts
 *
 * @package Minimal Stream
 * @since Minimal Stream 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'post' == get_post_type() ) : ?>
		<?php printf( __( '<div class="avatar-wrap">%1$s</div>', 'minimal_stream' ),
			get_avatar( get_the_author_meta( 'email' ), '55' )
		); ?>
		<div class="entry-meta">
			<p class="entry-date"><?php minimal_stream_posted_on(); ?></p>
			<p class="entry-tags"><?php the_tags('Tagged with ', ', '); ?> </p>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'minimal_stream' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'minimal_stream' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'minimal_stream' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
