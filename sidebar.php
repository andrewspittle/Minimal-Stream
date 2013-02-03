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
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->
