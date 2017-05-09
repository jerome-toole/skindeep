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

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
	<div class="archive-post-wrap">
		<a href="<?php the_permalink(); ?>" >
		<figure class="featured-image">
			<?php write_log("category content!"); ?>
		    <?php if ( has_post_thumbnail() ) { the_post_thumbnail('square_cats');} ?>
		</figure>
		</a>

		<div class="entry-container">
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<h3 class="entry-author"><?php the_author(); ?></h3>
			</header><!-- .entry-header -->

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
	</div><!-- .archive-post-wrap -->
</article><!-- #post -->