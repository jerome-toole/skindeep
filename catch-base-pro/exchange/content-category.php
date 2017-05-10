<?php
/**
 * The template for displaying iThemes Exchange products in a product category
 * (it_exchange_category taxonomy)
 *
 * Used for both single and index/archive/search
 *
 * @package Catch Themes @subpackage Catch Base Pro
 * @since      Catch Base 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('unit half'); ?>>
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
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header><!-- .entry-header -->

                <?php

                // Show product image
                it_exchange( 'product', 'featured-image', array( 'size' => 'large' ) );

                // TODO: Show product price!

                ?>

                <footer class="entry-footer">
                    <?php catchbase_tag_category(); ?>
                </footer><!-- .entry-footer -->
            </div><!-- .entry-container -->
        </div><!-- .archive-post-wrap -->
    </a>
</article><!-- #post -->