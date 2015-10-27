<?php
/**
 * Adding support for WooCommerce Plugin
 * 
 * uses remove_action to remove the WooCommerce Wrapper and add_action to add Catch Base Wrapper
 *
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'catchbase_woocommerce_start' ) ) :
function catchbase_woocommerce_start() {
	echo '<main role="main" class="site-main woocommerce" id="main"><div class="woocommerce-wrap">';
}
endif; //catchbase_woocommerce_start
add_action( 'woocommerce_before_main_content', 'catchbase_woocommerce_start', 15 );

if ( ! function_exists( 'catchbase_woocommerce_end' ) ) :
function catchbase_woocommerce_end() {
	echo '</div><!-- .woocommerce-wrap --></main><!-- #main -->';
}
endif; //catchbase_woocommerce_end
add_action( 'woocommerce_after_main_content', 'catchbase_woocommerce_end', 15 );