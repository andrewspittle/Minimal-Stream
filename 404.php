<?php get_header(); ?>

	<div id="content">
		<h2 class="entry-title"><?php _e( 'Not Found', 'minimalstream' ); ?></h2>
		
		<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'twentyten' ); ?></p>
		<?php get_search_form(); ?>
	</div>

<?php get_footer(); ?>