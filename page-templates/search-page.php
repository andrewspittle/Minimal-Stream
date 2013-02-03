<?php
/**
 * Template Name: Search Template
 *
 * @since Minimal Stream 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			
			<div class="search-wrap">
				<?php get_search_form(); ?>
			</div>
			
			<?php get_sidebar(); ?>
			
			<?php minimal_stream_archives(); ?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>