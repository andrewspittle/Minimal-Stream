<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Minimal Stream
 * @since Minimal Stream 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'minimal_stream' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'minimal_stream' ); ?></p>

					<?php get_search_form(); ?>

					<?php the_widget( 'WP_Widget_Recent_Posts', '', array( 'before_widget' => '<div class="widget sixcol">', 'after_widget' => '</div>' ) ); ?>

					<div class="widget sixcol last">
						<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'minimal_stream' ); ?></h2>
						<ul>
						<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
						</ul>
					</div><!-- .widget -->
					
					<div class="widget">
						<h2 class="widgettitle"><?php _e( 'Last 12 months', 'minimal_stream' ); ?></h2>
						<ul>
						<?php wp_get_archives( 'type=monthly&limit=12' ) ?>
						</ul>
					</div>
					
					<div class="widget">
						<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
					</div>

				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>