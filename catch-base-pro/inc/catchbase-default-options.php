<?php
/**
 * Implement Default Theme/Customizer Options
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


/**
 * Returns the default options for catchbase.
 *
 * @since Catch Base 1.0
 */
function catchbase_get_default_theme_options() {
	
	$theme_data = wp_get_theme();
	
	$default_theme_options = array(
		//Site Title an Tagline
		'logo'												=> get_template_directory_uri() . '/images/headers/logo.png',
		'logo_alt_text' 									=> '',
		'logo_disable'										=> 1,
		'move_title_tagline'								=> 0,
		
		//Layout
		'theme_layout' 										=> 'three-columns',
		'woocommerce_layout' 								=> 'three-columns',
		'content_layout'									=> 'excerpt-featured-image',
		'single_post_image_layout'							=> 'disabled',
		
		//Header Image
		'enable_featured_header_image'						=> 'disabled',
		'featured_header_image_position'					=> 'before-menu',
		'featured_image_size'								=> 'full',
		'featured_header_image_url'							=> '',
		'featured_header_image_alt'							=> '',
		'featured_header_image_base'						=> 0,

		//Navigation
		'primary_menu_disable'								=> 0,
		'primary_search_disable'							=> 0,

		//Breadcrumb Options
		'breadcumb_option'									=> 0,
		'breadcumb_onhomepage'								=> 0,
		'breadcumb_seperator'								=> '&raquo;',

		//Comment Options
		'comment_option'									=> 'use-wordpress-setting',
		'disable_notes'										=> 0,
		'disable_website_field'								=> 0,

		//Custom CSS
		'custom_css'										=> '',

		//Scrollup Options
		'disable_scrollup'									=> 0,
		
		//Header Right Sidebar Options
		'disable_header_right_sidebar'						=> 0,
		
		//Excerpt Options
		'excerpt_length'									=> '200',
		'excerpt_more_text'									=> __( 'Read More ...', 'catch-base' ),
		
		//Homepage / Frontpage Settings
		'front_page_category'								=> array(),
		
		//Pagination Options
		'pagination_type'									=> 'default',

		// Post Options
		'post_author_credit_text'
					=> 'Writing by',
		'post_illustrator_credit_text'
					=> 'Image by',

		//Promotion Headline Options
		'promotion_headline_option'							=> 'homepage',
		'promotion_headline'								=> __( 'Catch Base Pro is a Premium Responsive WordPress Theme', 'catch-base' ),
		'promotion_subheadline'								=> __( 'This is promotion headline. You can edit this from Appearance -> Customize -> Theme Options -> Promotion Headline Options', 'catch-base' ),
		'promotion_headline_button'							=> __( 'Buy Now', 'catch-base' ),
		'promotion_headline_url'							=> esc_url( 'http://catchthemes.com/' ),
		'promotion_headline_target'							=> 1,

		//Responsive Options
		'responsive_select'									=> 0,
		'footer_mobile_menu_disable'						=> 1,

		//Search Options
		'search_text'										=> __( 'Search...', 'catch-base' ),

		//Single Post Navigation
		'disable_single_post_navigation'					=> 0,
		
		//Feed Redirect
		'feed_redirect'										=> '',

		//Font Family Options
		'body_font' 										=> 'sans-serif',
		'title_font' 										=> 'sans-serif',
		'tagline_font' 										=> 'sans-serif',
		'content_title_font' 								=> 'sans-serif',
		'content_font' 										=> 'sans-serif',
		'headings_font' 									=> 'sans-serif', 
		'reset_typography'									=> 0,

		//Footer Editor Options		
		'footer_left_content'								=> sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved.', '1: Year, 2: Site Title with home URL', 'catch-base' ), '[the-year]', '[site-link]' ),
		'footer_right_content'								=> esc_attr( $theme_data->get( 'Name') ) . '&nbsp;' . __( 'by', 'catch-base' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_attr( $theme_data->get( 'Author' ) ) .'</a>',
		'reset_footer_content'								=> 0,

		//Update Notifier
		'update_notifier'									=> 0,

		//Basic Color Options
		'color_scheme' 										=> 'light',
		'text_color'										=> '#404040',
		'link_color'										=> '#21759b',
		'link_hover_color'									=> '#404040',
		
		//Content Color Options
		'content_wrapper_background_color'					=> '#ffffff', 
		'content_background_color'							=> '#ffffff', 
		'content_title_color'								=> '#404040',
		'content_title_hover_color'							=> '#21759b',
		'content_meta_color'								=> '#21759b',
		'content_meta_hover_color'							=> '#404040',
		
		//Header Color Options
		'header_background_color'							=> '#ffffff',
		'site_title_hover_color'							=> '#21759b',
		'tagline_color'										=> '#404040',
		
		//Sidebar Color Options
		'sidebar_background_color'							=> '#ffffff',
		'sidebar_widget_title_color'						=> '#404040',
		'sidebar_widget_text_color'							=> '#404040',
		'sidebar_widget_link_color'							=> '#21759b',
		
		//Pagination Color Options //Need to check in details after
		'pagination_background_color'						=> '#ffffff',
		'pagination_hover_background_color'					=> '#ffffff',
		'pagination_text_color'								=> '#404040',
		'pagination_link_color'								=> '#21759b',
		'pagination_hover_active_color'						=> '#ffffff',
		'numeric_infinite_scroll_background_color'			=> '#eeeeee',
		'numeric_infinite_scroll_hover_background_color'	=> '#000000',
		
		//Footer Color Options
		'footer_background_color'							=> '#ffffff',
		'footer_text_color'									=> '#404040',
		'footer_link_color'									=> '#21759b',
		'footer_sidebar_area_background_color'				=> '#ffffff',
		'footer_widget_background_color'					=> '#ffffff',
		'footer_widget_title_color'							=> '#404040',
		'footer_widget_text_color'							=> '#404040',
		'footer_widget_link_color'							=> '#21759b',
		
		//Promotion Headline Color Options
		'promotion_headline_background_color'				=> '#ffffff',
		'promotion_headline_text_color'						=> '#404040',
		'promotion_headline_link_color'						=> '#21759b',
		'promotion_headline_button_background_color'		=> '#f2f2f2',
		'promotion_headline_button_text_color'				=> '#666666',
		'promotion_headline_button_hover_background_color'	=> '#f2f2f2',
		'promotion_headline_button_hover_text_color'		=> '#666666',
		
		//Scrollup Color Options
		'scrollup_background_color'							=> '#666666',
		'scrollup_hover_background_color'					=> '#000000',
		'scrollup_text_color'								=> '#eeeeee',
		'scrollup_hover_text_color'							=> '#ffffff',
		
		//Slider Color Options
		'slider_background_color'							=> '#ffffff',
		'slider_text_color'									=> '#ffffff',
		'slider_link_color'									=> '#ffffff',
		
		//Featured Content Color Options
		'featured_content_background_color'					=> '#ffffff',
		'featured_content_title_color'						=> '#404040',
		'featured_content_text_color'						=> '#404040',
		'featured_content_link_color'						=> '#21759b',
		
		//Primary Menu Color Options
		'menu_background_color'								=> '#ffffff',
		'menu_color'										=> '#666666',
		'hover_active_color'								=> '#ffffff',
		'hover_active_text_color'							=> '#21759b',
		'sub_menu_background_color'							=> '#ffffff',
		'sub_menu_text_color'								=> '#666666',
		
		//Secondary Menu Color Options
		'secondary_menu_background_color'					=> '#f2f2f2',
		'secondary_menu_color'								=> '#666666',
		'secondary_hover_active_color'						=> '#f2f2f2',
		'secondary_hover_active_text_color'					=> '#21759b',
		'secondary_sub_menu_background_color'				=> '#f2f2f2',
		'secondary_sub_menu_text_color'						=> '#666666',

		//Header Right Menu Color Options
		'header_right_menu_background_color'				=> '#ffffff',
		'header_right_menu_color'							=> '#666666',
		'header_right_hover_active_color'					=> '#ffffff',
		'header_right_hover_active_text_color'				=> '#21759b',
		'header_right_sub_menu_background_color'			=> '#ffffff',
		'header_right_sub_menu_text_color'					=> '#666666',
		
		//Footer Menu Color Options
		'footer_menu_background_color'						=> '#ffffff',
		'footer_menu_color'									=> '#666666',
		'footer_hover_active_color'							=> '#ffffff',
		'footer_hover_active_text_color'					=> '#21759b',
		'footer_sub_menu_background_color'					=> '#ffffff',
		'footer_sub_menu_text_color'						=> '#666666',	
		
		//Featured Content Options
		'featured_content_option'							=> 'homepage',
		'featured_content_layout'							=> 'layout-four',
		//move_posts_home replaced with featured_content_position from version 1.1
		'move_posts_home'									=> 0,
		'featured_content_position'							=> 0,
		'featured_content_headline'							=> '',
		'featured_content_subheadline'						=> '',
		'featured_content_type'								=> 'demo-featured-content',
		'featured_content_number'							=> '4',
		'featured_content_select_category'					=> array(),
		'featured_content_show'								=> 'excerpt',
		
		//Featured Slider Options
		'featured_slider_option'							=> 'homepage',
		'featured_slider_image_loader'						=> 'true',
		'featured_slide_transition_effect'					=> 'fadeout',
		'featured_slide_transition_delay'					=> '4',
		'featured_slide_transition_length'					=> '1',
		'featured_slider_type'								=> 'demo-featured-slider',
		'featured_slide_number'								=> '4',
		'featured_slider_select_category'					=> array(),
		'exclude_slider_post'								=> 0,
		
		//Social Links
		'social_icon_size'									=> '20',
		'custom_social_icons'								=> '1',
		
		//Reset all settings
		'reset_all_settings'								=> 0,
	);

	return apply_filters( 'catchbase_default_theme_options', $default_theme_options );
}


/**
 * Returns an array of featured slider image loader options
 *
 * @since Catch Base 2.3.1
 */
function catchbase_featured_slider_image_loader() {
	$color_scheme_options = array(
		'true' => array(
			'value' 				=> 'true',
			'label' 				=> __( 'True', 'catch-base' ),
		),
		'wait' => array(
			'value' 				=> 'wait',
			'label' 				=> __( 'Wait', 'catch-base' ),
		),
		'false' => array(
			'value' 				=> 'false',
			'label' 				=> __( 'False', 'catch-base' ),
		),		
	);

	return apply_filters( 'catchbase_color_schemes', $color_scheme_options );
}


/**
 * Returns an array of color schemes registered for catchbase.
 *
 * @since Catch Base 1.0
 */
function catchbase_color_schemes() {
	$color_scheme_options = array(
		'light' => array(
			'value' 				=> 'light',
			'label' 				=> __( 'Light', 'catch-base' ),
		),
		'dark' => array(
			'value' 				=> 'dark',
			'label' 				=> __( 'Dark', 'catch-base' ),
		),
	);

	return apply_filters( 'catchbase_color_schemes', $color_scheme_options );
}


/**
 * Returns an array of layout options registered for catchbase.
 *
 * @since Catch Base 1.0
 */
function catchbase_layouts() {
	$layout_options = array(
		'left-sidebar' 	=> array(
			'value' => 'left-sidebar',
			'label' => __( 'Primary Sidebar, Content', 'catch-base' ),
		),
		'right-sidebar' => array(
			'value' => 'right-sidebar',
			'label' => __( 'Content, Primary Sidebar', 'catch-base' ),
		),
		'three-columns'	=> array(
			'value' => 'three-columns',
			'label' => __( 'Three Columns ( Secondary Sidebar, Content, Primary Sidebar )', 'catch-base' ),
		),
		'three-columns-secondary-sidebar-first'	=> array(
			'value' => 'three-columns-secondary-sidebar-first',
			'label' => __( 'Three Columns ( Mobile Secondary Sidebar First )', 'catch-base' ),
		),
		'three-columns-equal-sidebars'	=> array(
			'value' => 'three-columns-equal-sidebars',
			'label' => __( 'Three Columns ( Equal Primary and Secondary Sidebars )', 'catch-base' ),
		),
		'three-columns-equal-columns'	=> array(
			'value' => 'three-columns-equal-columns',
			'label' => __( 'Three Columns ( Equal Secondary Sidebar, Content, Primary Sidebar )', 'catch-base' ),
		),
		'three-columns-content-left'	=> array(
			'value' => 'three-columns-content-left',
			'label' => __( 'Three Columns ( Content, Primary Sidebar, Secondary Sidebar )', 'catch-base' ),
		),
		'three-columns-content-right'	=> array(
			'value' => 'three-columns-content-right',
			'label' => __( 'Three Columns ( Secondary Sidebar, Primary Sidebar, Content ) ', 'catch-base' ),
		),
		'no-sidebar'	=> array(
			'value' => 'no-sidebar',
			'label' => __( 'No Sidebar ( Content Width )', 'catch-base' ),
		),
		'no-sidebar-one-column' => array(
			'value' => 'no-sidebar-one-column',
			'label' => __( 'No Sidebar ( One Column )', 'catch-base' ),
		),
		'no-sidebar-full-width' => array(
			'value' => 'no-sidebar-full-width',
			'label' => __( 'No Sidebar ( Full Width )', 'catch-base' ),
		),
	);
	return apply_filters( 'catchbase_layouts', $layout_options );
}


/**
 * Returns an array of content layout options registered for catchbase.
 *
 * @since Catch Base 1.0
 */
function catchbase_get_archive_content_layout() {
	$layout_options = array(
		'excerpt-featured-image' => array(
			'value' => 'excerpt-featured-image',
			'label' => __( 'Show Excerpt', 'catch-base' ),
		),		
		'excerpt-portrait-featured-image' => array(
			'value' => 'excerpt-portrait-featured-image',
			'label' => __( 'Show Excerpt (Portrait Featured Image)', 'catch-base' ),
		),
		'excerpt-landscape-featured-image' => array(
			'value' => 'excerpt-landscape-featured-image',
			'label' => __( 'Show Excerpt (Landscape Featured Image)', 'catch-base' ),
		),
		'excerpt-thumbnail-featured-image' => array(
			'value' => 'excerpt-thumbnail-featured-image',
			'label' => __( 'Show Excerpt (Thumbnail Featured Image)', 'catch-base' ),
		),
		'excerpt-full-image' => array(
			'value' => 'excerpt-full-image',
			'label' => __( 'Show Excerpt (Full Featured Image)', 'catch-base' ),
		),		
		'full-content' => array(
			'value' => 'full-content',
			'label' => __( 'Show Full Content (No Featured Image)', 'catch-base' ),
		),
	);

	return apply_filters( 'catchbase_get_archive_content_layout', $layout_options );
}


/**
 * Returns an array of feature header enable options
 *
 * @since Catch Base 1.0
 */
function catchbase_enable_featured_header_image_options() {
	$enable_featured_header_image_options = array(
		'homepage' 		=> array(
			'value'	=> 'homepage',
			'label' => __( 'Homepage / Frontpage', 'catch-base' ),
		),
		'exclude-home' 		=> array(
			'value'	=> 'exclude-home',
			'label' => __( 'Excluding Homepage', 'catch-base' ),
		),
		'exclude-home-page-post' 	=> array(
			'value' => 'exclude-home-page-post',
			'label' => __( 'Excluding Homepage, Page/Post Featured Image', 'catch-base' ),
		),
		'entire-site' 	=> array(
			'value' => 'entire-site',
			'label' => __( 'Entire Site', 'catch-base' ),
		),
		'entire-site-page-post' 	=> array(
			'value' => 'entire-site-page-post',
			'label' => __( 'Entire Site, Page/Post Featured Image', 'catch-base' ),
		),
		'pages-posts' 	=> array(
			'value' => 'pages-posts',
			'label' => __( 'Pages and Posts', 'catch-base' ),
		),
		'disabled'		=> array(
			'value' => 'disabled',
			'label' => __( 'Disabled', 'catch-base' ),
		),
	);

	return apply_filters( 'catchbase_enable_featured_header_image_options', $enable_featured_header_image_options );
}


/**
 * Returns an array of feature header image positions
 *
 * @since Catch Base 1.0
 */
function catchbase_featured_header_image_position_options() {
	$featured_header_image_position_options = array(
		'before_menu' 		=> array(
			'value'	=> 'before-menu',
			'label' => __( 'Before Menu', 'catch-base' ),
		),
		'after_menu' 	=> array(
			'value' => 'after-menu',
			'label' => __( 'After Menu', 'catch-base' ),
		),
		'before_header'		=> array(
			'value' => 'before-header',
			'label' => __( 'Before Header', 'catch-base' ),
		),
		'after_slider'		=> array(
			'value' => 'after-slider',
			'label' => __( 'After Slider', 'catch-base' ),
		),
	);

	return apply_filters( 'catchbase_featured_header_image_position_options', $featured_header_image_position_options );
}


/**
 * Returns an array of feature image size
 *
 * @since Catch Base 1.0
 */
function catchbase_featured_image_size_options() {
	$featured_image_size_options = array(
		'full' 		=> array(
			'value'	=> 'full',
			'label' => __( 'Full Image', 'catch-base' ),
		),
		'large' 	=> array(
			'value' => 'large',
			'label' => __( 'Large Image', 'catch-base' ),
		),
		'slider'		=> array(
			'value' => 'slider',
			'label' => __( 'Slider Image', 'catch-base' ),
		),
	);

	return apply_filters( 'catchbase_featured_image_size_options', $featured_image_size_options );
}


/**
 * Returns an array of content and slider layout options registered for catchbase.
 *
 * @since Catch Base 1.0
 */
function catchbase_featured_slider_content_options() {
	$featured_slider_content_options = array(
		'homepage' 		=> array(
			'value'	=> 'homepage',
			'label' => __( 'Homepage / Frontpage', 'catch-base' ),
		),
		'entire-site' 	=> array(
			'value' => 'entire-site',
			'label' => __( 'Entire Site', 'catch-base' ),
		),
		'disabled'		=> array(
			'value' => 'disabled',
			'label' => __( 'Disabled', 'catch-base' ),
		),
	);

	return apply_filters( 'catchbase_featured_slider_content_options', $featured_slider_content_options );
}


/**
 * Returns an array of feature content types registered for catchbase.
 *
 * @since Catch Base 1.0
 */
function catchbase_featured_content_types() {
	$featured_content_types = array(
		'demo-featured-content' => array(
			'value' => 'demo-featured-content',
			'label' => __( 'Demo Featured Content', 'catch-base' ),
		),
		'featured-post-content' => array(
			'value' => 'featured-post-content',
			'label' => __( 'Featured Post Content', 'catch-base' ),
		),
		'featured-page-content' => array(
			'value' => 'featured-page-content',
			'label' => __( 'Featured Page Content', 'catch-base' ),
		),
		'featured-category-content' => array(
			'value' => 'featured-category-content',
			'label' => __( 'Featured Category Content', 'catch-base' ),
		),
		'featured-image-content' => array(
			'value' => 'featured-image-content',
			'label' => __( 'Featured Image Content', 'catch-base' ),
		),
	);

	return apply_filters( 'catchbase_featured_content_types', $featured_content_types );
}


/**
 * Returns an array of featured content options registered for catchbase.
 *
 * @since Catch Base 1.0
 */
function catchbase_featured_content_layout_options() {
	$featured_content_layout_option = array(
		'layout-three' 		=> array(
			'value'	=> 'layout-three',
			'label' => __( '3 columns', 'catch-base' ),
		),
		'layout-four' 	=> array(
			'value' => 'layout-four',
			'label' => __( '4 columns', 'catch-base' ),
		),
	);

	return apply_filters( 'catchbase_featured_content_layout_options', $featured_content_layout_option );
}

/**
 * Returns an array of featured content show registered for catchbase.
 *
 * @since Catch Base 3.0
 */
function catchbase_featured_content_show() {
	$featured_content_show_option = array(
		'excerpt' 		=> array(
			'value'	=> 'excerpt',
			'label' => __( 'Show Excerpt', 'catch-base' ),
		),
		'full-content' 	=> array(
			'value' => 'full-content',
			'label' => __( 'Show Full Content', 'catch-base' ),
		),
		'hide-content' 	=> array(
			'value' => 'hide-content',
			'label' => __( 'Hide Content', 'catch-base' ),
		),
	);

	return apply_filters( 'catchbase_featured_content_show', $featured_content_show_option );
}

/**
 * Returns an array of feature slider types registered for catchbase.
 *
 * @since Catch Base 1.0
 */
function catchbase_featured_slider_types() {
	$featured_slider_types = array(
		'demo-featured-slider' => array(
			'value' => 'demo-featured-slider',
			'label' => __( 'Demo Featured Slider', 'catch-base' ),
		),
		'featured-post-slider' => array(
			'value' => 'featured-post-slider',
			'label' => __( 'Featured Post Slider', 'catch-base' ),
		),
		'featured-page-slider' => array(
			'value' => 'featured-page-slider',
			'label' => __( 'Featured Page Slider', 'catch-base' ),
		),
		'featured-category-slider' => array(
			'value' => 'featured-category-slider',
			'label' => __( 'Featured Category Slider', 'catch-base' ),
		),
		'featured-image-slider' => array(
			'value' => 'featured-image-slider',
			'label' => __( 'Featured Image Slider', 'catch-base' ),
		),
	);

	return apply_filters( 'catchbase_featured_slider_types', $featured_slider_types );
}


/**
 * Returns an array of feature slider transition effects
 *
 * @since Catch Base 1.0
 */
function catchbase_featured_slide_transition_effects() {
	$featured_slide_transition_effects = array(
		'fade' 		=> array(
			'value'	=> 'fade',
			'label' => __( 'Fade', 'catch-base' ),
		),
		'fadeout' 	=> array(
			'value'	=> 'fadeout',
			'label' => __( 'Fade Out', 'catch-base' ),
		),
		'none' 		=> array(
			'value' => 'none',
			'label' => __( 'None', 'catch-base' ),
		),
		'scrollHorz'=> array(
			'value' => 'scrollHorz',
			'label' => __( 'Scroll Horizontal', 'catch-base' ),
		),
		'scrollVert'=> array(
			'value' => 'scrollVert',
			'label' => __( 'Scroll Vertical', 'catch-base' ),
		),
		'flipHorz'	=> array(
			'value' => 'flipHorz',
			'label' => __( 'Flip Horizontal', 'catch-base' ),
		),
		'flipVert'	=> array(
			'value' => 'flipVert',
			'label' => __( 'Flip Vertical', 'catch-base' ),
		),
		'tileSlide'	=> array(
			'value' => 'tileSlide',
			'label' => __( 'Tile Slide', 'catch-base' ),
		),
		'tileBlind'	=> array(
			'value' => 'tileBlind',
			'label' => __( 'Tile Blind', 'catch-base' ),
		),
		'shuffle'	=> array(
			'value' => 'shuffle',
			'label' => __( 'Suffle', 'catch-base' ),
		)
	);

	return apply_filters( 'catchbase_featured_slide_transition_effects', $featured_slide_transition_effects );
}


/**
 * Returns an array of color schemes registered for catchbase.
 *
 * @since Catch Base 1.0
 */
function catchbase_get_pagination_types() {
	$pagination_types = array(
		'default' => array(
			'value' => 'default',
			'label' => __( 'Default(Older Posts/Newer Posts)', 'catch-base' ),
		),
		'numeric' => array(
			'value' => 'numeric',
			'label' => __( 'Numeric', 'catch-base' ),
		),
		'infinite-scroll-click' => array(
			'value' => 'infinite-scroll-click',
			'label' => __( 'Infinite Scroll (Click)', 'catch-base' ),
		),
		'infinite-scroll-scroll' => array(
			'value' => 'infinite-scroll-scroll',
			'label' => __( 'Infinite Scroll (Scroll)', 'catch-base' ),
		),
	);

	return apply_filters( 'catchbase_get_pagination_types', $pagination_types );
}


/**
 * Returns an array of content featured image size.
 *
 * @since Catch Base 1.0
 */
function catchbase_single_post_image_layout_options() {
	$single_post_image_layout_options = array(
		'large' => array(
			'value' => 'large',
			'label' => __( 'Large', 'catch-base' ),
		),
		'medium' => array(
			'value' => 'medium',
			'label' => __( 'Medium', 'catch-base' ),
		),
		'full-size' => array(
			'value' => 'full-size',
			'label' => __( 'Full size', 'catch-base' ),
		),
		'slider-image-size' => array(
			'value' => 'slider-image-size',
			'label' => __( 'Slider Image Size', 'catch-base' ),
		),		
		'disabled' => array(
			'value' => 'disabled',
			'label' => __( 'Disabled', 'catch-base' ),
		),
	);
	return apply_filters( 'catchbase_single_post_image_layout_options', $single_post_image_layout_options );
}


/**
 * Returns an array of comment options for catchbase.
 *
 * @since Catch Base 1.0
 */
function catchbase_comment_options() {
	$comment_options = array(
		'use-wordpress-setting' => array(
			'value' => 'use-wordpress-setting',
			'label' => __( 'Use WordPress Setting', 'catch-base' ),
		),
		'disable-in-pages' => array(
			'value' => 'disable-in-pages',
			'label' => __( 'Disable in Pages', 'catch-base' ),
		),
		'disable-completely' => array(
			'value' => 'disable-completely',
			'label' => __( 'Disable Completely', 'catch-base' ),
		),
	);

	return apply_filters( 'catchbase_comment_options', $comment_options );
}


/**
 * Returns an array of avaliable fonts registered for catchbase.
 *
 * @since Catch Base 1.0
 */
function catchbase_avaliable_fonts() {
	$avaliable_fonts = array(
		'arial-black' => array(
			'value' => 'arial-black',
			'label' => '"Arial Black", Gadget, sans-serif',
		),
		'allan' => array(
			'value' => 'allan',
			'label' => '"Allan", sans-serif',
		),
		'allerta' => array(
			'value' => 'allerta',
			'label' => '"Allerta", sans-serif',
		),
		'amaranth' => array(
			'value' => 'amaranth',
			'label' => '"Amaranth", sans-serif',
		),
		'amiri' => array(
			'value' => 'amiri',
			'label' => '"Amiri", sans-serif',
		),
		'arial' => array(
			'value' => 'arial',
			'label' => 'Arial, Helvetica, sans-serif',
		),
		'bitter' => array(
			'value' => 'bitter',
			'label' => '"Bitter", sans-serif',
		),
		'cabin' => array(
			'value' => 'cabin',
			'label' => '"Cabin", sans-serif',
		),
		'cantarell' => array(
			'value' => 'cantarell',
			'label' => '"Cantarell", sans-serif',
		),
		'century-gothic' => array(
			'value' => 'century-gothic',
			'label' => '"Century Gothic", sans-serif',
		),
		'courier-new' => array(
			'value' => 'courier-new',
			'label' => '"Courier New", Courier, monospace',
		),
		'crimson-text' => array(
			'value' => 'crimson-text',
			'label' => '"Crimson Text", sans-serif',
		),
		'cuprum' => array(
			'value' => 'cuprum',
			'label' => '"Cuprum", sans-serif',
		),
		'dancing-script' => array(
			'value' => 'dancing-script',
			'label' => '"Dancing Script", sans-serif',
		),
		'droid-sans' => array(
			'value' => 'droid-sans',
			'label' => '"Droid Sans", sans-serif',
		),
		'droid-serif' => array(
			'value' => 'droid-serif',
			'label' => '"Droid Serif", sans-serif',
		),
		'exo' => array(
			'value' => 'exo',
			'label' => '"Exo", sans-serif',
		),	
		'exo-2' => array(
			'value' => 'exo-2',
			'label' => '"Exo 2", sans-serif',
		),				
		'georgia' => array(
			'value' => 'georgia',
			'label' => 'Georgia, "Times New Roman", Times, serif',
		),
		'helvetica' => array(
			'value' => 'helvetica',
			'label' => 'Helvetica, "Helvetica Neue", Arial, sans-serif',
		),
		'helvetica-neue' => array(
			'value' => 'helvetica-neue',
			'label' => '"Helvetica Neue",Helvetica,Arial,sans-serif',
		),
		'istok-web' => array(
			'value' => 'istok-web',
			'label' => '"Istok Web", sans-serif',
		),
		'impact' => array(
			'value' => 'impact',
			'label' => 'Impact, Charcoal, sans-serif',
		),
		'josefin-sans' => array(
			'value' => 'josefin-sans',
			'label' => '"Josefin Sans", sans-serif',
		),
		'lato' => array(
			'value' => 'lato',
			'label' => '"Lato", sans-serif',
		),
		'libre-baskerville' => array(
			'value' => 'libre-baskerville',
			'label' => '"Libre Baskerville",serif'		
		),
		'lucida-sans-unicode' => array(
			'value' => 'lucida-sans-unicode',
			'label' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
		),
		'lucida-grande' => array(
			'value' => 'lucida-grande',
			'label' => '"Lucida Grande", "Lucida Sans Unicode", sans-serif',
		),
		'lobster' => array(
			'value' => 'lobster',
			'label' => '"Lobster", sans-serif',
		),
		'lora' => array(
			'value' => 'lora',
			'label' => '"Lora", serif',
		),
		'monaco' => array(
			'value' => 'monaco',
			'label' => 'Monaco, Consolas, "Lucida Console", monospace, sans-serif',
		),
		'montserrat' => array(
			'value' => 'montserrat',
			'label' => '"Montserrat", sans-serif',
		),
		'nobile' => array(
			'value' => 'nobile',
			'label' => '"Nobile", sans-serif',
		),
		'noto-serif' => array(
			'value' => 'noto-serif',
			'label' => '"Noto Serif", serif',
		),
		'neuton' => array(
			'value' => 'neuton',
			'label' => '"Neuton", serif',
		),
		'open-sans' => array(
			'value' => 'open-sans',
			'label' => '"Open Sans", sans-serif',
		),
		'oswald' => array(
			'value' => 'oswald',
			'label' => '"Oswald", sans-serif',
		),
		'palatino' => array(
			'value' => 'palatino',
			'label' => 'Palatino, "Palatino Linotype", "Book Antiqua", serif',
		),
		'patua-one' => array(
			'value' => 'patua-one',
			'label' => '"Patua One", sans-serif',
		),
		'playfair-display' => array(
			'value' => 'playfair-display',
			'label' => '"Playfair Display", sans-serif',
		),
		'pt-sans' => array(
			'value' => 'pt-sans',
			'label' => '"PT Sans", sans-serif',
		),
		'pt-serif' => array(
			'value' => 'pt-serif',
			'label' => '"PT Serif", serif',
		),
		'quattrocento-sans' => array(
			'value' => 'quattrocento-sans',
			'label' => '"Quattrocento Sans", sans-serif',
		),
		'roboto' => array(
			'value' => 'roboto',
			'label' => '"Roboto", sans-serif',
		),
		'roboto-slab' => array(
			'value' => 'roboto-slab',
			'label' => '"Roboto Slab", serif',
		),
		'roboto-condensed' => array(
			'value' => 'roboto-condensed',
			'label' => '"Roboto Condensed", serif',
		),
		'sans-serif' => array(
			'value' => 'sans-serif',
			'label' => 'Sans Serif, Arial',
		),
		'source-sans-pro' => array(
			'value' => 'source-sans-pro',
			'label' => '"Source Sans Pro", sans-serif',
		),
		'tahoma' => array(
			'value' => 'tahoma',
			'label' => 'Tahoma, Geneva, sans-serif',
		),
		'trebuchet-ms' => array(
			'value' => 'trebuchet-ms',
			'label' => '"Trebuchet MS", "Helvetica", sans-serif',
		),
		'times-new-roman' => array(
			'value' => 'times-new-roman',
			'label' => '"Times New Roman", Times, serif',
		),
		'ubuntu' => array(
			'value' => 'ubuntu',
			'label' => '"Ubuntu", sans-serif',
		),
		'varela' => array(
			'value' => 'varela',
			'label' => '"Varela", sans-serif',
		),
		'verdana' => array(
			'value' => 'verdana',
			'label' => 'Verdana, Geneva, sans-serif',
		),
		'yanone-kaffeesatz' => array(
			'value' => 'yanone-kaffeesatz',
			'label' => '"Yanone Kaffeesatz", sans-serif',
		),
	);

	return apply_filters( 'catchbase_avaliable_fonts', $avaliable_fonts );
}


/**
 * Returns list of social icons currently supported
 *
 * @since Catch Base 1.0
*/
function catchbase_get_social_icons_list() {
	$catchbase_social_icons_list =	array( 
											__( 'Facebook', 'catch-base' ), 
											__( 'Twitter', 'catch-base' ), 
											__( 'Googleplus', 'catch-base' ),
											__( 'Email', 'catch-base' ),
											__( 'Feed', 'catch-base' ),	
											__( 'WordPress', 'catch-base' ), 
											__( 'GitHub', 'catch-base' ), 
											__( 'LinkedIn', 'catch-base' ), 
											__( 'Pinterest', 'catch-base' ), 
											__( 'Flickr', 'catch-base' ), 
											__( 'Vimeo', 'catch-base' ), 
											__( 'YouTube', 'catch-base' ), 
											__( 'Tumblr', 'catch-base' ), 
											__( 'Instagram', 'catch-base' ), 
											__( 'PollDaddy', 'catch-base' ),
											__( 'CodePen', 'catch-base' ), 
											__( 'Path', 'catch-base' ), 
											__( 'Dribbble', 'catch-base' ), 
											__( 'Skype', 'catch-base' ), 
											__( 'Digg', 'catch-base' ), 
											__( 'Reddit', 'catch-base' ), 
											__( 'Stumbleupon', 'catch-base' ), 
											__( 'Pocket', 'catch-base' ), 
											__( 'DropBox', 'catch-base' ),
											__( 'Spotify', 'catch-base' ),
											__( 'Foursquare', 'catch-base' ),											
											__( 'Spotify', 'catch-base' ),
											__( 'Twitch', 'catch-base' ),
										);

	return apply_filters( 'catchbase_social_icons_list', $catchbase_social_icons_list );
}


/**
 * Returns list of basic color options currently supported
 *
 * @since Catch Base 1.0
*/
function catchbase_get_basic_color_options() {
	$basic_color_options =	array(
									__( 'Text Color', 'catch-base' ), 
									__( 'Link Color', 'catch-base' ),
									__( 'Link Hover Color', 'catch-base' ),
								);

	return apply_filters( 'catchbase_get_basic_color_options', $basic_color_options );
}


/**
 * Returns list of content color options currently supported
 *
 * @since Catch Base 1.0
*/
function catchbase_get_content_color_options() {
	$content_color_options =	array(  
									__( 'Content Wrapper Background Color', 'catch-base' ),
									__( 'Content Background Color', 'catch-base' ),
									__( 'Content Title Color', 'catch-base' ),	
									__( 'Content Title Hover Color', 'catch-base' ), 
									__( 'Content Meta Color', 'catch-base' ), 
									__( 'Content Meta Hover Color', 'catch-base' ), 
								);

	return apply_filters( 'catchbase_get_content_color_options', $content_color_options );
}	

									
/**
 * Returns list of header color options currently supported
 *
 * @since Catch Base 1.0
*/
function catchbase_get_header_color_options() {
	$header_color_options =	array(  
									__( 'Header Background color', 'catch-base' ), 
									__( 'Site Title Hover Color', 'catch-base' ), 
									__( 'Tagline Color', 'catch-base' )
								);

	return apply_filters( 'catchbase_get_header_color_options', $header_color_options );
}


/**
 * Returns list of sidebar color options currently supported
 *
 * @since Catch Base 1.0
*/
function catchbase_get_sidebar_color_options() {
	$sidebar_color_options = array(  
									__( 'Sidebar Background Color', 'catch-base' ),
									__( 'Sidebar Widget Title Color', 'catch-base' ),
									__( 'Sidebar Widget Text Color', 'catch-base' ), 
									__( 'Sidebar Widget Link Color', 'catch-base' ), 
								);
	return apply_filters( 'catchbase_get_sidebar_color_options', $sidebar_color_options );
}


/**
 * Returns list of pagination color options currently supported
 *
 * @since Catch Base 1.0
*/
function catchbase_get_pagination_color_options() {
	$pagination_color_options = array(  
									__( 'Pagination Background Color', 'catch-base' ),
									__( 'Pagination Hover Background Color', 'catch-base' ),
									__( 'Pagination Text Color', 'catch-base' ), 
									__( 'Pagination Link Color', 'catch-base' ),
									__( 'Pagination Hover/Active Color', 'catch-base' ),
									__( 'Numeric/Infinite Scroll Background Color', 'catch-base' ),
									__( 'Numeric/Infinite Scroll Hover Background Color', 'catch-base' ),
								);
	return apply_filters( 'catchbase_get_pagination_color_options', $pagination_color_options );
}


/**
 * Returns list of footer color options currently supported
 *
 * @since Catch Base 1.0
*/
function catchbase_get_footer_color_options() {
	$footer_color_options =	array(  
									__( 'Footer Background Color', 'catch-base' ),
									__( 'Footer Text Color', 'catch-base' ),
									__( 'Footer Link Color', 'catch-base' ),
									__( 'Footer Sidebar Area Background Color', 'catch-base' ),
									__( 'Footer Widget Background Color', 'catch-base' ),
									__( 'Footer Widget Title Color', 'catch-base' ),
									__( 'Footer Widget Text Color', 'catch-base' ),
									__( 'Footer Widget Link Color', 'catch-base' ),
								);

	return apply_filters( 'catchbase_get_footer_color_options', $footer_color_options );
}


/**
 * Returns list of promotion headline color options currently supported
 *
 * @since Catch Base 1.0
*/
function catchbase_get_promotion_headline_color_options() {
	$promotion_headline_color_options =	array(  
												__( 'Promotion Headline Background Color', 'catch-base' ),
												__( 'Promotion Headline Text Color', 'catch-base' ),
												__( 'Promotion Headline Link Color', 'catch-base' ),
												__( 'Promotion Headline Button Background Color', 'catch-base' ),
												__( 'Promotion Headline Button Text Color', 'catch-base' ),
												__( 'Promotion Headline Button Hover Background Color', 'catch-base' ),
												__( 'Promotion Headline Button Hover Text Color', 'catch-base' ),
										);

	return apply_filters( 'catchbase_get_promotion_headline_color_options', $promotion_headline_color_options );
}


/**
 * Returns list of scrollup color options currently supported
 *
 * @since Catch Base 1.0
*/
function catchbase_get_scrollup_color_options() {
	$scrollup_color_options =	array(  
									__( 'Scrollup Background Color', 'catch-base' ),
									__( 'Scrollup Hover Background Color', 'catch-base' ),
									__( 'Scrollup Text Color', 'catch-base' ),
									__( 'Scrollup Hover Text Color', 'catch-base' ),
							);

	return apply_filters( 'catchbase_get_scrollup_color_options', $scrollup_color_options );
}


/**
 * Returns list of slider color options currently supported
 *
 * @since Catch Base 1.0
*/
function catchbase_get_slider_color_options() {
	$slider_color_options =	array(  
												__( 'Slider Background Color', 'catch-base' ),
												__( 'Slider Text Color', 'catch-base' ),
												__( 'Slider Link Color', 'catch-base' ),
										);

	return apply_filters( 'catchbase_get_slider_color_options', $slider_color_options );
}


/**
 * Returns list of featured_content color options currently supported
 *
 * @since Catch Base 1.0
*/
function catchbase_get_featured_content_color_options() {
	$eatured_content_color_options =	array(  
												__( 'Featured Content Background Color', 'catch-base' ),
												__( 'Featured Content Title Color', 'catch-base' ),
												__( 'Featured Content Text Color', 'catch-base' ),
												__( 'Featured Content Link Color', 'catch-base' ),
										);

	return apply_filters( 'catchbase_get_featured_content_color_options', $eatured_content_color_options );
}


/**
 * Returns list of menu color options currently supported
 *
 * @since Catch Base 1.0
*/
function catchbase_get_menu_color_options() {
	$menu_color_options =	array( 
									__( 'Menu Background color', 'catch-base' ), 
									__( 'Menu Color', 'catch-base' ), 
									__( 'Hover Active Color', 'catch-base' ),
									__( 'Hover Active Text Color', 'catch-base' ),
									__( 'Sub Menu Background Color', 'catch-base' ),	
									__( 'Sub Menu Text Color', 'catch-base' ), 
								);
	return apply_filters( 'catchbase_get_menu_color_options', $menu_color_options );
}

/**
 * Returns an array of metabox layout options registered for catchbase.
 *
 * @since Catch Base 1.0
 */
function catchbase_metabox_layouts() {
	$layout_options = array(
		'default' 	=> array(
			'id' 	=> 'catchbase-layout-option',
			'value' => 'default',
			'label' => __( 'Default', 'catch-base' ),
		),
		'left-sidebar' 	=> array(
			'id' 	=> 'catchbase-layout-option',
			'value' => 'left-sidebar',
			'label' => __( 'Primary Sidebar, Content', 'catch-base' ),
		),
		'right-sidebar' => array(
			'id' 	=> 'catchbase-layout-option',
			'value' => 'right-sidebar',
			'label' => __( 'Content, Primary Sidebar', 'catch-base' ),
		),
		'three-columns'	=> array(
			'id' 	=> 'catchbase-layout-option',
			'value' => 'three-columns',
			'label' => __( 'Three Columns ( Secondary Sidebar, Content, Primary Sidebar )', 'catch-base' ),
		),
		'three-columns-secondary-sidebar-first'	=> array(
			'id' 	=> 'catchbase-layout-option',
			'value' => 'three-columns-secondary-sidebar-first',
			'label' => __( 'Three Columns ( Mobile Secondary Sidebar First )', 'catch-base' ),
		),
		'three-columns-equal-sidebars'	=> array(
			'id' 	=> 'catchbase-layout-option',
			'value' => 'three-columns-equal-sidebars',
			'label' => __( 'Three Columns ( Equal Primary and Secondary Sidebars )', 'catch-base' ),
		),
		'three-columns-equal-columns'	=> array(
			'id' 	=> 'catchbase-layout-option',
			'value' => 'three-columns-equal-columns',
			'label' => __( 'Three Columns ( Equal Secondary Sidebar, Content, Primary Sidebar )', 'catch-base' ),
		),
		'three-columns-content-left'	=> array(
			'id' 	=> 'catchbase-layout-option',
			'value' => 'three-columns-content-left',
			'label' => __( 'Three Columns ( Content, Primary Sidebar, Secondary Sidebar )', 'catch-base' ),
		),
		'three-columns-content-right'	=> array(
			'id' 	=> 'catchbase-layout-option',
			'value' => 'three-columns-content-right',
			'label' => __( 'Three Columns ( Secondary Sidebar, Primary Sidebar, Content ) ', 'catch-base' ),
		),
		'no-sidebar'	=> array(
			'id' 	=> 'catchbase-layout-option',
			'value' => 'no-sidebar',
			'label' => __( 'No Sidebar ( Content Width )', 'catch-base' ),
		),
		'no-sidebar-one-column' => array(
			'id' 	=> 'catchbase-layout-option',
			'value' => 'no-sidebar-one-column',
			'label' => __( 'No Sidebar ( One Column )', 'catch-base' ),
		),
		'no-sidebar-full-width' => array(
			'id' 	=> 'catchbase-layout-option',
			'value' => 'no-sidebar-full-width',
			'label' => __( 'No Sidebar ( Full Width )', 'catch-base' ),
		),
	);
	return apply_filters( 'catchbase_layouts', $layout_options );
}

/**
 * Returns an array of metabox header featured image options registered for catchbase.
 *
 * @since Catch Base 1.0
 */
function catchbase_metabox_header_featured_image_options() {
	$header_featured_image_options = array(
		'default' => array(
			'id'		=> 'catchbase-header-image',
			'value' 	=> 'default',
			'label' 	=> __( 'Default', 'catch-base' ),
		),
		'enable' => array(
			'id'		=> 'catchbase-header-image',
			'value' 	=> 'enable',
			'label' 	=> __( 'Enable', 'catch-base' ),
		),	
		'disable' => array(
			'id'		=> 'catchbase-header-image',
			'value' 	=> 'disable',
			'label' 	=> __( 'Disable', 'catch-base' )
		)
	);
	return apply_filters( 'header_featured_image_options', $header_featured_image_options );
}


/**
 * Returns an array of metabox sidebar options registered for catchbase.
 *
 * @since Catch Base 1.0
 */
function catchbase_metabox_sidebar_options() {
	$sidebar_options = array(
		'main-sidebar' => array(
			'id'		=> 'catchbase-sidebar-options',
			'value' 	=> 'default-sidebar',
			'label' 	=> __( 'Default Sidebar', 'catch-base' )
		),
		'optional-sidebar-one' => array(
			'id' 	=> 'catchbase-sidebar-options',
			'value' => 'optional-sidebar-one',
			'label' => __( 'Optional Sidebar One', 'catch-base' )
		),
		'optional-sidebar-two' => array(
			'id' 	=> 'catchbase-sidebar-options',
			'value' => 'optional-sidebar-two',
			'label' => __( 'Optional Sidebar Two', 'catch-base' )
		),
		'optional-sidebar-three' => array(
			'id' 	=> 'catchbase-sidebar-options',
			'value' => 'optional-sidebar-three',
			'label' => __( 'Optional Sidebar three', 'catch-base' )
		)
	);
	return apply_filters( 'sidebar_options', $sidebar_options );
}


/**
 * Returns an array of metabox featured image options registered for catchbase.
 *
 * @since Catch Base 1.0
 */
function catchbase_metabox_featured_image_options() {
	$featured_image_options = array(
		'default' => array(
			'id'		=> 'catchbase-featured-image',
			'value' 	=> 'default',
			'label' 	=> __( 'Default', 'catch-base' ),
		),							   
		'featured' => array(
			'id'		=> 'catchbase-featured-image',
			'value' 	=> 'featured',
			'label' 	=> __( 'Featured Image', 'catch-base' )
		),
		'full' => array(
			'id' => 'catchbase-featured-image',
			'value' => 'full',
			'label' => __( 'Full Image', 'catch-base' )
		),
		'slider' => array(
			'id' => 'catchbase-featured-image',
			'value' => 'slider',
			'label' => __( 'Slider Image', 'catch-base' )
		),
		'disable' => array(
			'id' => 'catchbase-featured-image',
			'value' => 'disable',
			'label' => __( 'Disable Image', 'catch-base' )
		)
	);
	return apply_filters( 'featured_image_options', $featured_image_options );
}


/**
 * Returns the default options for gridalicious dark theme.
 *
 * @since Catch Base 1.0
 */
function catchbase_default_dark_color_options() {
	$default_dark_color_options = array(
		//Basic Color Options
		'text_color'										=> '#aaaaaa',
		'link_color'										=> '#e4741f',
		'link_hover_color'									=> '#dddddd',
		
		//Header Color Options
		'header_background_color'							=> '#111111',
		'site_title_hover_color'							=> '#e4741f',
		'tagline_color'										=> '#dddddd',

		//Content Color Options
		'content_wrapper_background_color'					=> '#222222', 
		'content_background_color'							=> '#222222', 
		'content_title_color'								=> '#dddddd',
		'content_title_hover_color'							=> '#e4741f',
		'content_meta_color'								=> '#e4741f',
		'content_meta_hover_color'							=> '#dddddd',
		
		//Sidebar Color Options
		'sidebar_background_color'							=> '#222222',
		'sidebar_widget_title_color'						=> '#dddddd',
		'sidebar_widget_text_color'							=> '#aaaaaa',
		'sidebar_widget_link_color'							=> '#e4741f',
		
		//Pagination Color Options //Need to check in details after
		'pagination_background_color'						=> '#202020',
		'pagination_hover_background_color'					=> '#202020',
		'pagination_text_color'								=> '#aaaaaa',
		'pagination_link_color'								=> '#e4741f',
		'pagination_hover_active_color'						=> '#000000',
		'numeric_infinite_scroll_background_color'			=> '#444444',
		'numeric_infinite_scroll_hover_background_color'	=> '#dddddd',
		
		//Footer Color Options
		'footer_background_color'							=> '#000000',
		'footer_text_color'									=> '#aaaaaa',
		'footer_link_color'									=> '#dddddd',
		'footer_sidebar_area_background_color'				=> '#222222',
		'footer_widget_background_color'					=> '#222222',
		'footer_widget_title_color'							=> '#dddddd',
		'footer_widget_text_color'							=> '#aaaaaa',
		'footer_widget_link_color'							=> '#e4741f',
		
		//Promotion Headline Color Options
		'promotion_headline_background_color'				=> '#222222',
		'promotion_headline_text_color'						=> '#aaaaaa',
		'promotion_headline_link_color'						=> '#e4741f',
		'promotion_headline_button_background_color'		=> '#f2f2f2',
		'promotion_headline_button_text_color'				=> '#666666',
		'promotion_headline_button_hover_background_color'	=> '#f2f2f2',
		'promotion_headline_button_hover_text_color'		=> '#666666',
		
		//Scrollup Color Options
		'scrollup_background_color'							=> '#666666',
		'scrollup_hover_background_color'					=> '#000000',
		'scrollup_text_color'								=> '#eeeeee',
		'scrollup_hover_text_color'							=> '#ffffff',
		
		//Slider Color Options
		'slider_background_color'							=> '#222222',
		'slider_text_color'									=> '#ffffff',
		'slider_link_color'									=> '#ffffff',
		
		//Featured Content Color Options
		'featured_content_background_color'					=> '#222222',
		'featured_content_title_color'						=> '#dddddd',
		'featured_content_text_color'						=> '#aaaaaa',
		'featured_content_link_color'						=> '#e4741f',

		//Primary Menu Color Options
		'menu_background_color'								=> '#333333',
		'menu_color'										=> '#dddddd',
		'hover_active_color'								=> '#333333',
		'hover_active_text_color'							=> '#e4741f',
		'sub_menu_background_color'							=> '#333333',
		'sub_menu_text_color'								=> '#dddddd',
		
		//Secondary Menu Color Options
		'secondary_menu_background_color'					=> '#111111',
		'secondary_menu_color'								=> '#dddddd',
		'secondary_hover_active_color'						=> '#111111',
		'secondary_hover_active_text_color'					=> '#e4741f',
		'secondary_sub_menu_background_color'				=> '#111111',
		'secondary_sub_menu_text_color'						=> '#dddddd',

		//Header Right Menu Color Options
		'header_right_menu_background_color'				=> '#111111',
		'header_right_menu_color'							=> '#dddddd',
		'header_right_hover_active_color'					=> '#111111',
		'header_right_hover_active_text_color'				=> '#e4741f',
		'header_right_sub_menu_background_color'			=> '#111111',
		'header_right_sub_menu_text_color'					=> '#dddddd',
		
		//Footer Menu Color Options
		'footer_menu_background_color'						=> '#333333',
		'footer_menu_color'									=> '#dddddd',
		'footer_hover_active_color'							=> '#333333',
		'footer_hover_active_text_color'					=> '#e4741f',
		'footer_sub_menu_background_color'					=> '#333333',
		'footer_sub_menu_text_color'						=> '#dddddd',	
	);

	return apply_filters( 'catchbase_default_dark_color_options', $default_dark_color_options );
}


/**
 * Checks if there are options already present from Catchbase free version and adds it to the Catchbase Pro theme options
 *
 * @since Catch Base 1.0
 * @hook after_theme_switch
 */
function catchbase_setup_options() {
	//Perform action only if theme_mods_catch-base-pro[catchbase_theme_options] does not exist
	if( !get_theme_mod( 'catchbase_theme_options' ) ) {
		//Perform action only if theme_mods_catch-base free version exists
		if ( $catchbase_free_options = get_option ( 'theme_mods_catch-base' ) ) {
			if ( isset( $catchbase_free_options['catchbase_theme_options'] ) ) {
				$theme_data = wp_get_theme();
				
				$catchbase_pro_default_options = array(
								//Header Image
								'featured_header_image_position'					=> 'before-menu',

								//Theme Layout
								'woocommerce_layout' 								=> 'three-columns',

								//Navigation
								'primary_menu_disable'								=> 0,
								'primary_search_disable'							=> 0,
								
								//Comment Options
								'comment_option'									=> 'use-wordpress-setting',
								'disable_notes'										=> '0',
								'disable_website_field'								=> '0',
								
								//Scrollup Options
								'disable_scrollup'									=> '0',
			
								//Header Right Sidebar Options
								'disable_header_right_sidebar'						=> 0,
								
								//Responsive Options
								'responsive_select'									=> 0,
								'footer_mobile_menu_disable'						=> 1,

								//Single Post Navigation
								'disable_single_post_navigation'					=> 0,

								//Feed Redirect
								'feed_redirect'										=> '',

								//Font Family Options
								'body_font' 										=> 'sans-serif',
								'title_font' 										=> 'sans-serif',
								'tagline_font' 										=> 'sans-serif',
								'content_title_font' 								=> 'sans-serif',
								'content_font' 										=> 'sans-serif',
								'headings_font' 									=> 'sans-serif', 
								'reset_typography'									=> 0,

								//Footer Editor Options
								'footer_left_content'								=> sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved.', '1: Year, 2: Site Title with home URL', 'catch-base' ), '[the-year]', '[site-link]' ),
								'footer_right_content'								=> $theme_data->get( 'Name') . '&nbsp;' . __( 'by', 'catch-base' ). '&nbsp;<a target="_blank" href="'. $theme_data->get( 'AuthorURI' ) .'">'. $theme_data->get( 'Author' ) .'</a>',
								'reset_footer_content'								=> 0,

								//Update Notifier
								'update_notifier'									=> 0,
								
								//Basic Color Options
								'color_scheme' 										=> 'light',
								'text_color'										=> '#404040',
								'link_color'										=> '#21759b',
								'link_hover_color'									=> '#404040',
								
								//Content Color Options
								'content_wrapper_background_color'					=> '#ffffff', 
								'content_background_color'							=> '#ffffff', 
								'content_title_color'								=> '#404040',
								'content_title_hover_color'							=> '#21759b',
								'content_meta_color'								=> '#21759b',
								'content_meta_hover_color'							=> '#404040',
								
								//Header Color Options
								'header_background_color'							=> '#ffffff',
								'site_title_hover_color'							=> '#21759b',
								'tagline_color'										=> '#404040',
								
								//Sidebar Color Options
								'sidebar_background_color'							=> '#ffffff',
								'sidebar_widget_title_color'						=> '#404040',
								'sidebar_widget_text_color'							=> '#404040',
								'sidebar_widget_link_color'							=> '#21759b',
								
								//Pagination Color Options //Need to check in details after
								'pagination_background_color'						=> '#ffffff',
								'pagination_hover_background_color'					=> '#ffffff',
								'pagination_text_color'								=> '#404040',
								'pagination_link_color'								=> '#21759b',
								'pagination_hover_active_color'						=> '#ffffff',
								'numeric_infinite_scroll_background_color'			=> '#eeeeee',
								'numeric_infinite_scroll_hover_background_color'	=> '#000000',
								
								//Footer Color Options
								'footer_background_color'							=> '#ffffff',
								'footer_text_color'									=> '#404040',
								'footer_link_color'									=> '#21759b',
								'footer_sidebar_area_background_color'				=> '#ffffff',
								'footer_widget_background_color'					=> '#ffffff',
								'footer_widget_title_color'							=> '#404040',
								'footer_widget_text_color'							=> '#404040',
								'footer_widget_link_color'							=> '#21759b',
								
								//Promotion Headline Color Options
								'promotion_headline_background_color'				=> '#ffffff',
								'promotion_headline_text_color'						=> '#404040',
								'promotion_headline_link_color'						=> '#21759b',
								'promotion_headline_button_background_color'		=> '#f2f2f2',
								'promotion_headline_button_text_color'				=> '#666666',
								'promotion_headline_button_hover_background_color'	=> '#f2f2f2',
								'promotion_headline_button_hover_text_color'		=> '#666666',
								
								//Scrollup Color Options
								'scrollup_background_color'							=> '#666666',
								'scrollup_hover_background_color'					=> '#000000',
								'scrollup_text_color'								=> '#eeeeee',
								'scrollup_hover_text_color'							=> '#ffffff',
								
								//Slider Color Options
								'slider_background_color'							=> '#ffffff',
								'slider_text_color'									=> '#ffffff',
								'slider_link_color'									=> '#ffffff',
								
								//Featured Content Color Options
								'featured_content_background_color'					=> '#ffffff',
								'featured_content_title_color'						=> '#404040',
								'featured_content_text_color'						=> '#404040',
								'featured_content_link_color'						=> '#21759b',
								
								//Primary Menu Color Options
								'menu_background_color'								=> '#ffffff',
								'menu_color'										=> '#666666',
								'hover_active_color'								=> '#ffffff',
								'hover_active_text_color'							=> '#21759b',
								'sub_menu_background_color'							=> '#ffffff',
								'sub_menu_text_color'								=> '#666666',
								
								//Secondary Menu Color Options
								'secondary_menu_background_color'					=> '#f2f2f2',
								'secondary_menu_color'								=> '#666666',
								'secondary_hover_active_color'						=> '#f2f2f2',
								'secondary_hover_active_text_color'					=> '#21759b',
								'secondary_sub_menu_background_color'				=> '#f2f2f2',
								'secondary_sub_menu_text_color'						=> '#666666',

								//Header Right Menu Color Options
								'header_right_menu_background_color'				=> '#ffffff',
								'header_right_menu_color'							=> '#666666',
								'header_right_hover_active_color'					=> '#ffffff',
								'header_right_hover_active_text_color'				=> '#21759b',
								'header_right_sub_menu_background_color'			=> '#ffffff',
								'header_right_sub_menu_text_color'					=> '#666666',
								
								//Footer Menu Color Options
								'footer_menu_background_color'						=> '#ffffff',
								'footer_menu_color'									=> '#666666',
								'footer_hover_active_color'							=> '#ffffff',
								'footer_hover_active_text_color'					=> '#21759b',
								'footer_sub_menu_background_color'					=> '#ffffff',
								'footer_sub_menu_text_color'						=> '#666666',	
								
								//Feature Content Options
								'featured_content_select_category'					=> array(),

								//Feature Slider Options
								'featured_slider_select_category'					=> array(),
								'exclude_slider_post'								=> 0,

								//Social Links
								'custom_social_icons'								=> '1',
								'social_icon_size'									=> '20',
					);
				
				$catchbase_theme_options = array_merge( $catchbase_pro_default_options , $catchbase_free_options['catchbase_theme_options'] );

				set_theme_mod( 'catchbase_theme_options', $catchbase_theme_options);
			}
		}
	}
}

add_action('after_switch_theme', 'catchbase_setup_options');