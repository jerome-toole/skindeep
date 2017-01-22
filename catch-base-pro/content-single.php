<?php
/**
 * The template used for displaying post content in single.php
 *
 * @package Catch Themes
 * @subpackage Catch Base Pro
 * @since Catch Base 1.0 
 */
?>

<?php
// Get theme options
$options = catchbase_get_theme_options();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="post-credits">
		<?php if ( !empty( get_field('author') ) ) : ?>
			<h2 class="entry-author post-credits-author">
				<?php printf(
					'%s %s',
					$options['post_author_credit_text'],
					get_field('author')); ?>
			</h2>
		<?php endif; ?>
		<?php if( !empty( get_field('illustrator') ) ) : ?>
			<h2 class="entry-illustrator post-credits-illustrator">
				<?php printf(
					'%s %s',
					$options['post_illustrator_credit_text'],
					get_field('illustrator')); ?>
			</h2>
		<?php endif; ?>
	</header>

	<?php 
	/** 
	 * catchbase_before_post_container hook
	 *
	 * @hooked catchbase_single_content_image - 10
	 */
	do_action( 'catchbase_before_post_container' ); ?>

	<div class="entry-container">
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

		<footer class="entry-footer">
			<?php catchbase_tag_category(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .entry-container -->
</article><!-- #post-## -->