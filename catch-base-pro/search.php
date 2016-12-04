<?php
/**
 * The template for displaying Search Results pages
 *
 * @package Catch Themes
 * @subpackage Catch Base Pro
 * @since Catch Base 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">

		<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title">
				<?php printf( __( 'Search Results for: %s', 'catch-base' ), '<span>' . get_search_query() . '</span>' ); ?>
			</h1>
		</header><!-- .page-header -->

		<main id="main" class="site-main grid featured-grid" role="main">

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php catchbase_content_nav( 'nav-below' ); ?>


		</main><!-- #main -->

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
