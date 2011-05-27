<?php /* Display navigation to next/previous pages when applicable */ ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'minimalstream' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'minimalstream' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display posts of the Gallery format. The gallery category is the old way. */ ?>

	<?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'minimalstream' ) ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

			<div class="entry">
				<?php
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>
						<div class="gallery-thumb">
							<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
						</div><!-- .gallery-thumb -->
						<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'minimalstream' ),
								'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'minimalstream' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
								number_format_i18n( $total_images )
							); ?></em></p>
				<?php endif; ?>
				
				<?php the_excerpt('Read more &raquo;'); ?>
			</div><!-- .entry -->
			
			<div class="entry-meta">
				<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Posted on <?php the_time('F j, Y'); ?></a></p>
			</div>

		</div><!-- #post-ID -->

<?php /* How to display posts of the Aside format. The asides category is the old way. */ ?>

	<?php elseif ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'minimalstream' ) )  ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry">
				<?php the_content('Read more &raquo;'); ?>
			</div><!-- .entry -->
			
			<div class="entry-meta">
				<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Posted on <?php the_time('F j, Y'); ?></a></p>
			</div>

		</div><!-- #post-ID -->
		
<?php /* How to display posts of the Status format. The statuses category is the old way. */ ?>

	<?php elseif ( 'status' == get_post_format( $post->ID ) || in_category( _x('statuses', 'statuses category slug', 'minimalstream' ) )  ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="status-wrapper">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'minimalstream_author_bio_avatar_size', 60 ) ); ?>
				</div><!-- .author-avatar -->

				<div class="entry">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'minimalstream' ) ); ?>
				</div><!-- .entry-content -->
				<div style="clear:both"></div>
			</div>
			
			<div class="entry-meta">
				<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Posted on <?php the_time('F j, Y'); ?></a></p>
			</div>
			
		</div><!-- #post-## -->

<?php /* How to display posts of the Quote format. The Quotes category is the old way. */ ?>

	<?php elseif ( 'quote' == get_post_format( $post->ID ) || in_category( _x('quotes', 'quotes category slug', 'minimalstream' ) )  ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry">
				<?php the_content('Read more &raquo;'); ?>
			</div><!-- .entry -->
			
			<div class="entry-meta">
				<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Posted on <?php the_time('F j, Y'); ?></a></p>
			</div>

		</div><!-- #post-ID -->

<?php /* How to display all other posts. */ ?>

	<?php else : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

			<div class="entry">
				<?php the_content('Read more &raquo;'); ?>
			</div><!-- .entry -->
			
			<div class="entry-meta">
				<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Posted on <?php the_time('F j, Y'); ?></a></p>
			</div>

		</div><!-- #post-ID -->

		<?php comments_template( '', true ); ?>

	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

<?php endwhile; // End the loop. Whew. ?>
