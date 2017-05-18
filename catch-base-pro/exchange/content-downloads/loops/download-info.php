<?php
/**
 * Custom download-info loop for the
 * content-downloads.php template part.
 *
 * @since 1.1.0
 * @version 1.1.0
 * @package IT_Exchange
*/
?>
<?php if ( it_exchange( 'transaction', 'has-product-downloads' ) ) : ?>
    <?php do_action( 'it_exchange_content_downloads_before_download_info_wrap' ); ?>
    <div class="it-exchange-download-wrapper">
        <?php do_action( 'it_exchange_content_downloads_before_download_info_loop' ); ?>
        <?php while ( it_exchange( 'transaction', 'product-downloads' ) ) : ?>
            <?php do_action( 'it_exchange_content_downloads_begin_download_info_loop' ); ?>
            <?php if ( is_transaction_product_digital() ) : ?>
            <div class="it-exchange-download">
                <?php it_exchange_get_template_part( 'content-downloads/elements/confirmation-url' ); ?>
                <div class="it-exchange-download-info">
                    <?php it_exchange_get_template_part( 'content-downloads/elements/download-title' ); ?>
                    <?php if ( it_exchange( 'transaction', 'has-product-download-hashes' ) ) : ?>
                        <?php it_exchange_get_template_part( 'content-downloads/loops/download-data' ); ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php do_action( 'it_exchange_content_downloads_end_download_info_loop' ); ?>
        <?php endwhile; ?>
        <?php do_action( 'it_exchange_content_downloads_after_download_info_loop' ); ?>
    </div>
    <?php do_action( 'it_exchange_content_downloads_after_download_info_wrap' ); ?>
<?php endif; ?>
