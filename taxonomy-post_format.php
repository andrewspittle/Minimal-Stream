<?php
/**
 * The template for displaying Post Format pages.
 *
 * Used to display archive-type pages for posts with a post format.
 * If you'd like to further customize these Post Format views, you may create a
 * new template file for each specific one.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Props minimal_stream for the code.
 *
 * @package Minimal Stream
 * @since Minimal Stream 1.0
 *
 */

get_header(); ?>

	<div id="primary" class="content-area eightcol last">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>
		
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( '%s Archives', 'minimal_stream' ), '<span>' . get_post_format_string( get_post_format() ) . '</span>' ); ?></h1>
			</header><!-- .archive-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			
				<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>
					
			<?php endwhile; ?>

			<?php minimal_stream_content_nav( 'nav-below' ); ?>

		<?php else : ?>
		
			<?php get_template_part( 'no-results', 'index' ); ?>
		
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>