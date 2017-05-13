<?php
/**
 * Custom template part for the product
 * images in one of the the content-product
 * template part's loops.
 *
 * @since 1.1.0
 * @version 1.1.0
 * @package Skin Deep
*/
?>

<?php if ( it_exchange( 'product', 'has-images' ) ) : ?>
    <?php do_action( 'it_exchange_content_product_before_product_images_element' ); ?>
    <div class="it-exchange-column it-exchange-product-images">
        <div class="it-exchange-column-inner">
            <? it_get_image('shop_single') ?>
        </div>
    </div>
    <?php do_action( 'it_exchange_content_product_after_product_images_element' ); ?>
<?php endif; ?>