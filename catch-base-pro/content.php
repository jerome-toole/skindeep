<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search
 *
 * @package Catch Themes
 * @subpackage Catch Base Pro
 * @since Catch Base 1.0 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('unit half grid-item'); ?>>
	<a href="<?php the_permalink(); ?>" rel="bookmark">
		<div class="archive-post-wrap">
			<?php 
			/** 
			 * catchbase_before_entry_container hook
			 *
			 * @hooked catchbase_archive_content_image - 10
			 */
			do_action( 'catchbase_before_entry_container' ); ?>

			<div class="entry-container">
				<header class="entry-header">
					<h2 class="entry-title"><?php the_title(); ?></h2>
					<h3 class="entry-author"><?php the_author(); ?></h3>
				</header><!-- .entry-header -->

				<?php
				$options = catchbase_get_theme_options();

				if (is_tax('it_exchange_category')) :
					it_exchange( 'product', 'featured-image', array( 'size' => 'large' ) );
				endif;

				if ( is_search() || 'full-content' != $options['content_layout'] ) : // Only display Excerpts for Search and if 'full-content' is not selected ?>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->
				<?php else : ?>			
					<div class="entry-content">
						<?php the_content(); ?>
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links"><span class="pages">' . __( 'Pages:', 'catch-base' ) . '</span>',
								'after'  => '</div>',
								'link_before' 	=> '<span>',
			                    'link_after'   	=> '</span>',
							) );
						?>
					</div><!-- .entry-content -->
				<?php endif; ?>

				<footer class="entry-footer">
					<?php catchbase_tag_category(); ?>
				</footer><!-- .entry-footer -->
			</div><!-- .entry-container -->
		</div><!-- .archive-post-wrap -->
	</a>
</article><!-- #post -->
