<?php
/**
 * This functions makes the theme compatible with WPML Plugin
 *
 *
 * @package Catch Themes
 * @subpackage Catch Base Pro
 * @since Catch Base Pro 3.0
 */
 

if ( ! function_exists( 'catchbase_wpml_invalidcache' ) ) :
/**
 * Template for Clearing WPML Invalid Cache
 *
 * To override this in a child theme
 * simply create your own catchbase_wpml_invalidcache(), and that function will be used instead.
 *
 * @since Catch Base Pro 3.0
 */
function catchbase_wpml_invalidcache() {
	delete_transient( 'catchbase_featured_content' );
	delete_transient( 'catchbase_featured_slider' );
	delete_transient( 'catchbase_footer_content' );	
	delete_transient( 'catchbase_promotion_headline' );
	delete_transient( 'catchbase_featured_image' );
	delete_transient( 'all_the_cool_cats' );	
} // catchbase_wpml_invalidcache
endif;

add_action( 'after_setup_theme', 'catchbase_wpml_invalidcache' );
