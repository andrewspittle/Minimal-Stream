<?php
/**
 * The template for displaying quote posts
 *
 * @package Minimal Stream
 * @since Minimal Stream 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'minimal_stream' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'minimal_stream' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		
		<footer class="entry-footer">
			<?php if ( is_single() ) : ?>
				<h4 class="entry-meta"><?php minimal_stream_posted_on(); ?></h4>
			<?php else : ?>
				<h4 class="entry-meta"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'minimal_stream' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php minimal_stream_posted_on(); ?></a></h4>
			<?php endif; ?>
			<?php edit_post_link( __( 'Edit', 'minimal_stream' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-header -->
	</article><!-- #post-<?php the_ID(); ?> -->
