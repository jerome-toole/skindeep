<?php
/**
 * The template for Managing Theme Structure
 *
 * @package Catch Themes
 * @subpackage Catch Base Pro
 * @since Catch Base 1.0
 */

if ( ! defined( 'CATCHBASE_THEME_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}


if ( ! function_exists( 'catchbase_doctype' ) ) :
	/**
	 * Doctype Declaration
	 *
	 * @since Catch Base 1.0
	 *
	 */
	function catchbase_doctype() {
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<?php
	}
endif;
add_action( 'catchbase_doctype', 'catchbase_doctype', 10 );


if ( ! function_exists( 'catchbase_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Catch Base 1.0
	 *
	 */
	function catchbase_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<!--[if lt IE 9]>
			<script src="<?php echo get_template_directory_uri(); ?>/js/html5.min.js"></script>
		<![endif]-->
		<?php
	}
endif;
add_action( 'catchbase_before_wp_head', 'catchbase_head', 10 );


if ( ! function_exists( 'catchbase_page_start' ) ) :
	/**
	 * Start div id #page
	 *
	 * @since Catch Base 1.0
	 *
	 */
	function catchbase_page_start() {
		?>
		<div id="page" class="hfeed site">
		<?php
	}
endif;
add_action( 'catchbase_header', 'catchbase_page_start', 100 );


if ( ! function_exists( 'catchbase_page_end' ) ) :
	/**
	 * End div id #page
	 *
	 * @since Catch Base 1.0
	 *
	 */
	function catchbase_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'catchbase_footer', 'catchbase_page_end', 200 );


if ( ! function_exists( 'catchbase_header_start' ) ) :
	/**
	 * Start Header id #masthead and class .wrapper
	 *
	 * @since Catch Base 1.0
	 *
	 */
	function catchbase_header_start() {
		?>
		<header id="masthead" role="banner">
    		<div class="wrapper">
		<?php
	}
endif;
add_action( 'catchbase_header', 'catchbase_header_start', 30 );


if ( ! function_exists( 'catchbase_header_end' ) ) :
	/**
	 * End Header id #masthead and class .wrapper
	 *
	 * @since Catch Base 1.0
	 *
	 */
	function catchbase_header_end() {
		?>
			</div><!-- .wrapper -->
		</header><!-- #masthead -->
		<?php
	}
endif;
add_action( 'catchbase_header', 'catchbase_header_end', 80 );


if ( ! function_exists( 'catchbase_content_start' ) ) :
	/**
	 * Start div id #content and class .wrapper
	 *
	 * @since Catch Base 1.0
	 *
	 */
	function catchbase_content_start() {
		?>
		<div id="content" class="site-content">
			<div class="wrapper">
	<?php
	}
endif;
add_action('catchbase_content', 'catchbase_content_start', 10 );

if ( ! function_exists( 'catchbase_content_end' ) ) :
	/**
	 * End div id #content and class .wrapper
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_content_end() {
		?>
			</div><!-- .wrapper -->
	    </div><!-- #content -->
		<?php
	}

endif;
add_action( 'catchbase_after_content', 'catchbase_content_end', 30 );


if ( ! function_exists( 'catchbase_content_sidebar_wrap_start' ) ) :
	/**
	 * Start div id #content_sidebar_wrap
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_content_sidebar_wrap_start() {
		?>
			<div id="content_sidebar_wrap">
		<?php
	}
endif;


if ( ! function_exists( 'catchbase_content_sidebar_wrap_end' ) ) :
	/**
	 * End div id #content_sidebar_wrap
	 * 
	 * @since Catch Base 1.0
	 */
	function catchbase_content_sidebar_wrap_end() {
		?>
			</div><!-- #content_sidebar_wrap -->
		<?php
	}
endif;


if ( ! function_exists( 'catchbase_sidebar_secondary' ) ) :
	/**
	 * Secondary Sidebar
	 * 
	 * @since Catch Base 1.0
	 */
	function catchbase_sidebar_secondary() {
		get_sidebar( 'secondary' );
	}
endif;


if ( ! function_exists( 'catchbase_layout_condition_check' ) ) :
	/**
	 * Layout Optons Condition Check and Hook
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_layout_condition_check() {
		global $post, $wp_query;

		$options = catchbase_get_theme_options();
		
		$themeoption_layout = $options['theme_layout'];
		
		// Front page displays in Reading Settings
		$page_on_front = get_option('page_on_front') ;
		$page_for_posts = get_option('page_for_posts'); 

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();	
		
	   	// WooCommerce Shop Page 
		if ( class_exists( 'woocommerce' ) && is_woocommerce() ) { 
			$shop_id = get_option( 'woocommerce_shop_page_id' );
	        $layout 		= get_post_meta( $shop_id,'catchbase-layout-option', true );
		    $sidebaroptions = get_post_meta( $shop_id, 'catchbase-sidebar-options', true );
		}		
		else {
			// Blog Page or Front Page setting in Reading Settings
			if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
		        $layout 		= get_post_meta( $page_id,'catchbase-layout-option', true );
		    }
			else if ( is_singular() ) {
				if ( is_attachment() ) { 
					$parent = $post->post_parent;
					$layout = get_post_meta( $parent, 'catchbase-layout-option', true );
				}
				else {
					$layout = get_post_meta( $post->ID, 'catchbase-layout-option', true ); 
				}
			}
			else {
				$sidebaroptions = '';
				$layout = 'default';
			}
		}

		//check empty and load default
		if( empty( $layout ) ) {
			$layout = 'default';
		}

		if ( class_exists( 'woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() ) ) {
			$woocommerce_layout = isset( $options['woocommerce_layout'] ) ? $options['woocommerce_layout'] : 'three-columns';
			if ( $layout == 'three-columns' || $layout == 'three-columns-equal-columns' || $layout == 'three-columns-equal-sidebars' || $layout == 'three-columns-content-left' || $layout == 'three-columns-content-right' || ( $layout=='default' && ( $woocommerce_layout == 'three-columns' || $woocommerce_layout == 'three-columns-equal-columns' || $woocommerce_layout == 'three-columns-equal-sidebars' || $woocommerce_layout == 'three-columns-content-left' || $woocommerce_layout == 'three-columns-content-right' ) ) ) {
				add_action( 'catchbase_content', 'catchbase_content_sidebar_wrap_start', 40 );

				add_action( 'catchbase_after_content', 'catchbase_content_sidebar_wrap_end', 10 );
				
				add_action( 'catchbase_after_content', 'catchbase_sidebar_secondary', 20 );
			} 	
			else if ( $layout == 'three-columns-secondary-sidebar-first' || ( $layout=='default' && $woocommerce_layout == 'three-columns-secondary-sidebar-first' ) ) {
				add_action( 'catchbase_content', 'catchbase_sidebar_secondary', 30 );

				add_action( 'catchbase_content', 'catchbase_content_sidebar_wrap_start', 40 );

				add_action( 'catchbase_after_content', 'catchbase_content_sidebar_wrap_end', 20 );
			}
		}
		else {
			if ( $layout == 'three-columns' || $layout == 'three-columns-equal-columns' || $layout == 'three-columns-equal-sidebars' || $layout == 'three-columns-content-left' || $layout == 'three-columns-content-right' || ( $layout=='default' && ( $themeoption_layout == 'three-columns' || $themeoption_layout == 'three-columns-equal-columns' || $themeoption_layout == 'three-columns-equal-sidebars' || $themeoption_layout == 'three-columns-content-left' || $themeoption_layout == 'three-columns-content-right' ) ) ) {
				add_action( 'catchbase_content', 'catchbase_content_sidebar_wrap_start', 40 );

				add_action( 'catchbase_after_content', 'catchbase_content_sidebar_wrap_end', 10 );
				
				add_action( 'catchbase_after_content', 'catchbase_sidebar_secondary', 20 );
			} 			
			else if ( $layout == 'three-columns-secondary-sidebar-first' || ( $layout=='default' && $themeoption_layout == 'three-columns-secondary-sidebar-first' ) ) {
				add_action( 'catchbase_content', 'catchbase_sidebar_secondary', 30 );

				add_action( 'catchbase_content', 'catchbase_content_sidebar_wrap_start', 40 );

				add_action( 'catchbase_after_content', 'catchbase_content_sidebar_wrap_end', 20 );
			}
		}

	} // catchbase_layout_condition_check
endif;
add_action( 'catchbase_before', 'catchbase_layout_condition_check' ); 


if ( ! function_exists( 'catchbase_footer_content_start' ) ) :
/**
 * Start footer id #colophon
 *
 * @since Catch Base 1.0
 */
function catchbase_footer_content_start() {
	?>
	<footer id="colophon" class="site-footer" role="contentinfo">
    <?php
}
endif;
add_action('catchbase_footer', 'catchbase_footer_content_start', 30 );


if ( ! function_exists( 'catchbase_footer_sidebar' ) ) :
/**
 * Footer Sidebar
 *
 * @since Catch Base 1.0
 */
function catchbase_footer_sidebar() {
	get_sidebar( 'footer' );
}
endif;
add_action( 'catchbase_footer', 'catchbase_footer_sidebar', 40 );


if ( ! function_exists( 'catchbase_footer_content_end' ) ) :
/**
 * End footer id #colophon
 *
 * @since Catch Base 1.0
 */
function catchbase_footer_content_end() {
	?>
	</footer><!-- #colophon -->
	<?php
}
endif;
add_action( 'catchbase_footer', 'catchbase_footer_content_end', 110 );


if ( ! function_exists( 'catchbase_header_right' ) ) :
/**
 * Header Right Sidebar
 *
 * @since Catch Base 1.0
 */
function catchbase_header_right() { 
	$options = catchbase_get_theme_options();
		
	//A sidebar in the Header Right 
	if ( !$options['disable_header_right_sidebar'] ) {
		get_sidebar( 'header-right' ); 
	}
}
endif;
add_action( 'catchbase_header', 'catchbase_header_right', 60 );
