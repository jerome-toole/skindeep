<?php
/**
 * The template for displaying Archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Catch Themes
 * @subpackage Catch Base Pro
 * @since Catch Base 1.0 
 */

$options = catchbase_get_theme_options(); // Get options

get_header(); ?>
			
	<header class="page-header">
		<h1 class="page-title <?php if ( $options['archive_hide_title_cat'] ) echo ('hide-cat-title') ?>">
			<?php
				if ( is_category() ) :
					single_cat_title();

				elseif ( is_tag() ) :
					single_tag_title();

				elseif ( is_author() ) :
					printf( __( 'Author: %s', 'catch-base' ), '<span class="vcard">' . get_the_author() . '</span>' );

				elseif ( is_day() ) :
					printf( __( 'Day: %s', 'catch-base' ), '<span>' . get_the_date() . '</span>' );

				elseif ( is_month() ) :
					printf( __( 'Month: %s', 'catch-base' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'catch-base' ) ) . '</span>' );

				elseif ( is_year() ) :
					printf( __( 'Year: %s', 'catch-base' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'catch-base' ) ) . '</span>' );

				elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
					_e( 'Asides', 'catch-base' );

				elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
					_e( 'Galleries', 'catch-base');

				elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
					_e( 'Images', 'catch-base');

				elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
					_e( 'Videos', 'catch-base' );

				elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
					_e( 'Quotes', 'catch-base' );

				elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
					_e( 'Links', 'catch-base' );

				elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
					_e( 'Statuses', 'catch-base' );

				elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
					_e( 'Audios', 'catch-base' );

				elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
					_e( 'Chats', 'catch-base' );

				elseif ( is_tax( 'it_exchange_category') ) :
					printf($wp_query->get_queried_object()->name);

				else :
					_e( 'Archives', 'catch-base' );

				endif;
			?>
		</h1>
		<?php
			// Show an optional term description.
			$term_description = term_description();
			if ( ! empty( $term_description ) ) :
				printf( '<div class="taxonomy-description">%s</div>', $term_description );
			endif;
		?>
	</header><!-- .page-header -->

	<main id="main" class="site-main grid featured-grid" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					if (is_tax('it_exchange_category')) :
						it_exchange_set_product( $post->ID );
						get_template_part( 'exchange/content', 'category');
					else :
						get_template_part( 'content', get_post_format() );
					endif;
				?>

			<?php endwhile; ?>

			<?php catchbase_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>
	</main><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>