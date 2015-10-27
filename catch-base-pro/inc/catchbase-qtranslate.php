<?php
/**
 * This functions makes the theme compatible with qTranslate Plugin
 *
 *
 * @package Catch Themes
 * @subpackage Catch Base Pro
 * @since Catch Base 3.0
 */

if ( ! function_exists( 'catchbase_menuitem' ) ) :
/**
 * Template for Converting Home link in Custom Menu
 *
 * To override this in a child theme
 * simply create your own catchbase_menuitem(), and that function will be used instead.
 *
 * @since Catch Base Pro 3.0
 */
function catchbase_menuitem( $menu_item ) {
	// convert local URLs in custom menu items	
	if ( $menu_item->type == 'custom' && stripos($menu_item->url, get_site_url()) !== false) {
		$menu_item->url = qtrans_convertURL($menu_item->url);
	}     
		return $menu_item;
} // catchbase_menuitem
endif;

add_filter( 'wp_setup_nav_menu_item' , 'catchbase_menuitem', 0 );


if ( ! function_exists( 'catchbase_qtranslate_invalidcache' ) ) :
/**
 * Template for Clearing qtranslate Invalid Cache
 *
 * To override this in a child theme
 * simply create your own catchbase_qtranslate_invalidcache(), and that function will be used instead.
 *
 * @since Catch Base Pro 3.0
 */
function catchbase_qtranslate_invalidcache() {
	delete_transient( 'catchbase_featured_content' );
	delete_transient( 'catchbase_featured_slider' );
	delete_transient( 'catchbase_footer_content' );	
	delete_transient( 'catchbase_promotion_headline' );
	delete_transient( 'catchbase_featured_image' );
	delete_transient( 'all_the_cool_cats' );	
} // catchbase_qtranslate_invalidcache
endif;

add_action( 'after_setup_theme', 'catchbase_qtranslate_invalidcache' );
