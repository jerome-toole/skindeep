<?php
/**
 * This is the custom template part for the content in the content-store
 * template part.
 *
 * @package Skin Deep
 */
?>

<?php do_action( 'it_exchange_content_store_before_categories_loop' ); ?>
<ul class="it-exchange-categories">
    <?php do_action( 'it_exchange_content_store_begin_categories_loop' ); ?>
    <?php

    # Pull out all non-empty product categories
    $taxonomy = 'it_exchange_category';
    $terms = get_terms(['taxonomy' => $taxonomy]);

    ?>

    <?php
    # Loop through the categories
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
        foreach ( $terms as $term ) :

            // wc_get_template( 'content-product_cat.php', array(
            //                     'category' => $category
            //                 ) );

            ?>

            <li class="<?php echo str_replace('_', '-', $taxonomy); ?>">
                <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"
                   alt="<?php esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) ) ?>">

                    <?php
                    // Pull out the ACF image
                    $image = get_field('image', $taxonomy . '_' . $term->term_id);
                    if( !empty($image) ) :

                        // vars
                        $alt = $image['alt'];
                        $caption = $image['caption'];

                        // thumbnail
                        $size = 'medium';
                        $thumb = $image['sizes'][ $size ];
                        $width = $image['sizes'][ $size . '-width' ];
                        $height = $image['sizes'][ $size . '-height' ];

                        ?>
                        <img src="<?php echo $thumb; ?>"
                             alt="<?php echo $alt; ?>"
                             width="<?php echo $width; ?>"
                             height="<?php echo $height; ?>" />
                    <?php endif; ?>

                    <h2>
                        <?php echo $term->name ?>
                        <span class="product-category-product-count">(<?php echo $term->count ?>)</span>
                    </h2>
                </a>
            </li>
        <?php endforeach; ?>
    <?php else : ?>
        it_exchange_get_template_part( 'content-store/elements/no-categories-found' );
    <?php endif;
    
    do_action( 'it_exchange_content_store_end_category_loops' );
    ?>
</ul>
<?php do_action( 'it_exchange_content_store_after_categories_loop' ); ?>
