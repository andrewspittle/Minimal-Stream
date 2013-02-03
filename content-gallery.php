<?php
/**
 * The template for displaying gallery posts
 *
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
		<?php if ( post_password_required() ) : ?>
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'minimalstream' ) ); ?>

		<?php elseif ( is_single() ) : ?>
			<?php the_content(); ?>
		<?php elseif ( ! has_post_thumbnail() && ! is_single() ) : {
			// Props Otto http://ottopress.com/2011/photo-gallery-primer/
			$attachments = get_children( array(
				'post_parent' => get_the_ID(),
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => 'ASC',
				'orderby' => 'menu_order ID',
				'numberposts' => 1)
			);
			foreach ( $attachments as $thumb_id => $attachment )
				echo wp_get_attachment_image($thumb_id, 'medium'); // whatever size you want
			}
			the_excerpt();
		?>
			
		<?php else : ?>
			<?php the_excerpt(); ?>
		<?php endif; ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'minimal_stream' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php //endif; ?>

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'minimal_stream' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
