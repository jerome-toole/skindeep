<?php
/**
 * The Template for displaying all single posts
 *
 * @package Catchbase
 * @subpackage Catchbase Pro
 * @since Catch Base 1.0
 */

get_header(); ?>

<section class="post-header">
	<?php the_post_thumbnail('large'); /* Large */ ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php catchbase_entry_meta(); ?>
	</header><!-- .entry-header -->
</section>

<section class="post-main">

	<main id="main" class="site-main article-post" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>

		<?php 
			/** 
			 * catchbase_after_post hook
			 *
			 * @hooked catchbase_post_navigation - 10
			 */
			do_action( 'catchbase_after_post' ); 
			
			/** 
			 * catchbase_comment_section hook
			 *
			 * @hooked catchbase_get_comment_section - 10
			 */
			do_action( 'catchbase_comment_section' ); 
		?>
	<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->

	<div class="social-sharing">
		<span>Share this on</span>
		<?php echo do_shortcode('[supsystic-social-sharing id="2"]') ?>
	</div>
	
	<?php get_sidebar(); ?>
</section>

<?php get_footer(); ?>