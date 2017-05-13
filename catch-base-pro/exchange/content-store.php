<?php
/**
 * Custom template for displaying the store.
 *
 * @package Skin Deep
 *
*/
?>

<?php do_action( 'it_exchange_content_store_before_wrap' ); ?>
<div id="it-exchange-store" class="it-exchange-wrap it-exchange-account featured-grid">
    <?php do_action( 'it_exchange_content_store_begin_wrap' ); ?>
    <?php it_exchange_get_template_part( 'messages' ); ?>
    <?php it_exchange_get_template_part( 'content-store/loops/categories' ); ?>
    <?php do_action( 'it_exchange_content_store_end_wrap' ); ?>
</div>
<?php do_action( 'it_exchange_content_store_after_wrap' ); ?>
