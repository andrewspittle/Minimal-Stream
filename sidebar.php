<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Minimal Stream
 * @since Minimal Stream 1.0
 */
?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php do_action( 'before_sidebar' ); ?>

				<aside class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>
				
		</div><!-- #secondary .widget-area -->
