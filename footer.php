<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Minimal Stream
 * @since Minimal Stream 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="widget-area" role="complementary">
			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->
		<div class="site-info">
			<?php do_action( 'minimal_stream_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'minimal_stream' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'minimal_stream' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>