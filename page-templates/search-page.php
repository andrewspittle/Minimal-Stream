<?php
/**
 * Template Name: Search Template
 *
 * @since Simple Grid 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			
			<div class="search-wrap">
				<?php get_search_form(); ?>
			</div>
			
			<div class="search-sidebar">
				<?php dynamic_sidebar( 'Search page widgets' ); ?>
			</div>
			
			<h3 class="search-archive-header">Monthly archives</h3>
			<ul class="archive-list">
				<?php wp_get_archives(); ?>
			</ul>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>