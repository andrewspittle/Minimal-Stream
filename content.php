<?php
/**
 * @package Minimal Stream
 * @since Minimal Stream 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
		if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
		  the_post_thumbnail( 'featured-image' ); // use the custom image size we've set in functions.php
		} 
	?>
	<header class="entry-header">
			<?php if ( is_sticky() ) : ?>
				<hgroup>
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'minimalstream' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<h3 class="entry-format"><?php _e( 'Featured', 'minimalstream' ); ?></h3>
				</hgroup>
			<?php elseif ( is_single() ) : ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<h4 class="entry-meta"><?php minimal_stream_posted_on(); ?></h4>
			<?php else : ?>
				<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'minimalstream' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				<h4 class="entry-meta"><?php minimal_stream_posted_on(); ?></h4>
			<?php endif; ?>
		</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'minimal_stream' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'minimal_stream' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'minimal_stream' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
