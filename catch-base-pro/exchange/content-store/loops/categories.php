<?php
/**
 * This is the custom template part for the content in the content-store
 * template part.
 *
 * @package Skin Deep
 */
?>

<?php do_action( 'it_exchange_content_store_before_categories_loop' ); ?>
<?php do_action( 'it_exchange_content_store_begin_categories_loop' ); ?>
<?php

# Pull out all product categories
$taxonomy = 'it_exchange_category';
$terms = get_terms(['taxonomy' => $taxonomy]);

?>

<?php
# Loop through the non-empty categories
if ( !empty($terms) && ! is_wp_error($terms) ) :
    foreach ($terms as $term) : ?>

        <article class="<?php echo str_replace('_', '-', $taxonomy); ?> grid-item unit half">
            <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"
               alt="<?php esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) ) ?>">

                <?php it_product_category_image($taxonomy . '_' . $term->term_id); ?>

                <h2>
                    <?php echo $term->name ?>
                    <span class="product-category-product-count">(<?php echo $term->count ?>)</span>
                </h2>
            </a>
        </article>
    <?php endforeach; ?>
<?php else : ?>
    it_exchange_get_template_part( 'content-store/elements/no-categories-found' );
<?php endif;

do_action( 'it_exchange_content_store_end_category_loops' );
?>
<?php do_action( 'it_exchange_content_store_after_categories_loop' ); ?>
