<?php get_header(); ?>

	<div id="content" role="main">

<?php
	/* Queue the first post, that way we know
	 * what date we're dealing with (if that is the case).
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	if ( have_posts() )
		the_post();
?>

			<h1 class="page-title">
<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: <span>%s</span>', 'minimalstream' ), get_the_date() ); ?>
<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: <span>%s</span>', 'minimalstream' ), get_the_date( 'F Y' ) ); ?>
<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: <span>%s</span>', 'minimalstream' ), get_the_date( 'Y' ) ); ?>
<?php elseif ( is_category() ) : ?>
				<?php printf( __( 'Category Archives: %s', 'minimalstream' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
<?php elseif ( is_author() ) : ?>
				<?php printf( __( 'Author Archives: %s', 'minimalstream' ), get_the_author() ); ?>
<?php else : ?>
				<?php _e( 'Blog Archives', 'minimalstream' ); ?>
<?php endif; ?>
			</h1>

<?php
	rewind_posts();
	get_template_part( 'loop', 'archive' );
?>

	</div><!-- #content -->
	
<?php get_footer(); ?>
