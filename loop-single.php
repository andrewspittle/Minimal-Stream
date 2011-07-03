<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<h2 class="entry-title"><?php the_title(); ?></h2>
			<div class="entry-meta">
				<p>Posted on <?php the_time('F j, Y'); ?> <span class="meta-sep"> • </span> <?php the_category(', ') ?> <span class="meta-sep"> • </span> <?php ms_tweet_this(); ?></p>
			</div>
			
			<div class="entry-tags">
				<?php the_tags('<h4>Tags</h4><ul><li>','</li><li>','</li></ul>'); ?>
			</div>

			<div class="entry">

					<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
					
					<span class="edit-link"><?php edit_post_link('Edit', '<p>', '</p>'); ?></span>
				
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'minimalstream_author_bio_avatar_size', 60 ) ); ?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h2><?php printf( esc_attr__( 'About %s', 'minimalstream' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
						</div><!-- #author-description -->
					</div><!-- #entry-author-info -->

			</div>
			
			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php previous_post_link( 'Previously: %link', '<span class="meta-nav">' . _x( '', 'Previous post link', 'minimalstream' ) . '</span> %title' ); ?></div>
				<div class="nav-next"><?php next_post_link( 'Next: %link', '<span class="meta-nav">' . _x( '', 'Next post link', 'minimalstream' ) . '</span> %title' ); ?></div>
			</div><!-- #nav-below -->
			
		</div>

	<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>