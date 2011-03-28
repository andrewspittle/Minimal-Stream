<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h2 class="entry-title"><?php the_title(); ?></h2>
	
		<div class="entry">

			<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

		</div>
	</div>
	
		<?php comments_template( '', true ); ?>

<?php endwhile; ?>

<span class="edit-link"><?php edit_post_link('Edit', '<p>', '</p>'); ?></span>