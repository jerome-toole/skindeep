<?php
/**
 * Core functions and definitions
 *
 * Sets up the theme
 *
 * The first function, catchbase_initial_setup(), sets up the theme by registering support
 * for various features in WordPress, such as theme support, post thumbnails, navigation menu, and the like.
 *
 * Catchbase functions and definitions
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

function filter_jetpack_infinite_scroll_js_settings( $settings ) {
	$settings['text'] = __( 'Load more...', 'l18n' );
	return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'filter_jetpack_infinite_scroll_js_settings' );

function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 540; /* pixels */


if ( ! function_exists( 'catchbase_content_width' ) ) :
	/**
	 * Change the content width based on the Theme Settings and Page/Post Settings
	 */
	function catchbase_content_width() {
		global $post, $wp_query, $content_width;

		//Getting Ready to load options data
		$options					= catchbase_get_theme_options();
		
		$themeoption_layout 		= $options['theme_layout'];
		
		// Front page displays in Reading Settings
		$page_on_front = get_option('page_on_front') ;
		$page_for_posts = get_option('page_for_posts');

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		// WooCommerce Shop Page 
		if ( class_exists( 'woocommerce' ) && is_woocommerce() ) { 
			$shop_id 	= get_option( 'woocommerce_shop_page_id' );
		    $layout 	= get_post_meta( $shop_id,'catchbase-layout-option', true );
		}
		else {
			// Blog Page or Front Page setting in Reading Settings
			if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
		        $layout  = get_post_meta( $page_id,'catchbase-layout-option', true );
		    }
	    	elseif ( is_singular() ) {
		 		if ( is_attachment() ) { 
					$parent = $post->post_parent;
					
					$layout = get_post_meta( $parent,'catchbase-layout-option', true );
				} 
				else {
					$layout = get_post_meta( $post->ID,'catchbase-layout-option', true ); 
				}
			}
			else {
				$layout = 'default';
			}
		}

		//check empty and load default
		if ( empty( $layout ) ) {
			$layout = 'default';
		}

		if ( class_exists( 'woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() ) ) {
			$woocommerce_layout = isset( $options['woocommerce_layout'] ) ? $options['woocommerce_layout'] : 'three-columns';

			// Three Columns: Equal Sidebars
			if ( $layout == 'three-columns-equal-sidebars' || ( $layout=='default' && $woocommerce_layout == 'three-columns-equal-sidebars' ) ) {
				$content_width = 440;
			}

			// Three Columns: Equal Columns - All three equal
			elseif ( $layout == 'three-columns-equal-columns' || ( $layout=='default' && $woocommerce_layout == 'three-columns-equal-columns' ) ) {
				$content_width = 346;
			}

			// Two Colums: Left and Right Sidebar & One Column: No Sidbear, No Sidebar One Column
			elseif ( $layout == 'right-sidebar' || $layout == 'left-sidebar' || $layout == 'no-sidebar' || $layout == 'no-sidebar-one-column' || ( $layout=='default' && $woocommerce_layout == 'right-sidebar' ) || ( $layout=='default' && $woocommerce_layout == 'left-sidebar' ) || ( $layout=='default' && $woocommerce_layout == 'no-sidebar' ) || ( $layout=='default' && $woocommerce_layout == 'no-sidebar-one-column' ) ) {
				$content_width = 780;
			}

			// One Column: No Sidebar Full Width
			elseif ( $layout == 'no-sidebar-full-width' || ( $layout=='default' && $woocommerce_layout == 'no-sidebar-full-width' ) ) { 
				$content_width = 1120;
			}
		}
		else {
			// Three Columns: Equal Sidebars
			if ( $layout == 'three-columns-equal-sidebars' || ( $layout=='default' && $themeoption_layout == 'three-columns-equal-sidebars' ) ) {
				$content_width = 440;
			}

			// Three Columns: Equal Columns - All three equal
			elseif ( $layout == 'three-columns-equal-columns' || ( $layout=='default' && $themeoption_layout == 'three-columns-equal-columns' ) ) {
				$content_width = 346;
			}

			// Two Colums: Left and Right Sidebar & One Column: No Sidbear, No Sidebar One Column
			elseif ( $layout == 'right-sidebar' || $layout == 'left-sidebar' || $layout == 'no-sidebar' || $layout == 'no-sidebar-one-column' || ( $layout=='default' && $themeoption_layout == 'right-sidebar' ) || ( $layout=='default' && $themeoption_layout == 'left-sidebar' ) || ( $layout=='default' && $themeoption_layout == 'no-sidebar' ) || ( $layout=='default' && $themeoption_layout == 'no-sidebar-one-column' ) ) {
				$content_width = 780;
			}

			// One Column: No Sidebar Full Width
			elseif ( $layout == 'no-sidebar-full-width' || ( $layout=='default' && $themeoption_layout == 'no-sidebar-full-width' ) ) { 
				$content_width = 1120;
			}
		}

	}
endif;
add_action( 'template_redirect', 'catchbase_content_width' );


if ( ! function_exists( 'catchbase_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function catchbase_setup() {
		/**
		 * Get Theme Options Values
		 */		
		$options 	= catchbase_get_theme_options();
		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on catchbase, use a find and replace
		 * to change 'catch-base' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'catch-base', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// Add Catchbase custom image sizes
    	add_image_size( 'catchbase-featured-content', 400, 225, true); // used in Featured Content Options Ratio 16:9

        add_image_size( 'catchbase-slider', 1200, 514, true); // used in Featured Slider Ratio 21:9

		//Three Archive Images
    	add_image_size( 'catchbase-featured', 780, 439, true); // used in Archive Landecape Ratio 16:9

    	add_image_size( 'catchbase-featured-portrait', 169, 300, true ); // used in Archive Portriat Ratio 9:16

    	add_image_size( 'catchbase-featured-landscape', 450, 254, true ); // used in Archive Ratio 16:9
    	
    	add_image_size( 'square_cats', 450, 450, true );
		
		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary' 	=> __( 'Primary Menu', 'catch-base' ),
			'secondary' => __( 'Secondary Menu', 'catch-base' ),
			'header-right' => __( 'Header Right Menu', 'catch-base' ),
			'footer' 	=> __( 'Footer Menu', 'catch-base' ),
		) );

		/**
		 * Enable support for Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		/**
		 * Setup the WordPress core custom background feature.
		 */
		if ( $options['color_scheme'] != 'light' ) {
			$default_color = '111111';
		}
		else {
			$default_color = 'f2f2f2';
		}
		add_theme_support( 'custom-background', apply_filters( 'catchbase_custom_background_args', array(
			'default-color' => $default_color
		) ) );

		/**
		 * Setup Editor style
		 */
		add_editor_style( 'css/editor-style.css' );

		/**
		 * Setup title support for theme
		 * Supported from WordPress version 4.1 onwards 
		 * More Info: https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Setup Infinite Scroll using JetPack if navigation type is set
		 */
		$pagination_type	= isset( $options['pagination_type'] ) ? $options['pagination_type'] : '';

		if( 'infinite-scroll-click' == $pagination_type ) {
			add_theme_support( 'infinite-scroll', array(
				'type'		=> 'click',
				'container' => 'main',
				'footer'    => 'page'
			) );
		}
		else if ( 'infinite-scroll-scroll' == $pagination_type ) {
			add_theme_support( 'infinite-scroll', array(
				'type'		=> 'scroll',
				'container' => 'main',
				'footer'    => 'page'
			) );
		}

		/**
		 * Load up our new theme update notifier.
		 */	
		if ( '1' != $options[ 'update_notifier' ] ) {
			require get_template_directory() . '/inc/catchthemes-update-notifier.php';	
		}	 

	}
endif; // catchbase_setup
add_action( 'after_setup_theme', 'catchbase_setup' );


/**
 * Enqueue scripts and styles
 *
 * @uses  wp_register_script, wp_enqueue_script, wp_register_style, wp_enqueue_style, wp_localize_script
 * @action wp_enqueue_scripts
 *
 * @since Catch Base 1.0
 */
function catchbase_scripts() {
	$options			= catchbase_get_theme_options();

	$catchbase_fonts 	= array();	
	$catchbase_fonts[]	= $options[ 'body_font' ];
	$catchbase_fonts[]	= $options[ 'title_font' ];
	$catchbase_fonts[]	= $options[ 'tagline_font' ];
	$catchbase_fonts[]	= $options[ 'content_title_font' ];
	$catchbase_fonts[]	= $options[ 'content_font' ];
	$catchbase_fonts[]	= $options[ 'headings_font' ];
	
	$web_fonts = array(
		'allan'					=> 'Allan',
		'allerta'				=> 'Allerta',
		'amiri'				=> 'Amiri',
		'amaranth'				=> 'Amaranth',
		'bitter'				=> 'Bitter',
		'cabin'					=> 'Cabin',
		'cantarell'				=> 'Cantarell',
		'crimson-text'			=> 'Crimson+Text',
		'cuprum'				=> 'Cuprum',
		'dancing-script'		=> 'Dancing+Script',
		'droid-sans'			=> 'Droid+Sans',
		'droid-serif'			=> 'Droid+Serif',
		'exo'					=> 'Exo',
		'exo-2'					=> 'Exo+2',
		'istok-web'				=> 'Istok+Web',
		'josefin-sans'			=> 'Josefin+Sans',
		'lato'					=> 'Lato',
		'libre-baskerville'		=> 'Libre+Baskerville',
		'lobster'				=> 'Lobster',
		'lora'					=> 'Lora',
		'montserrat'			=> 'Montserrat',
		'nobile'				=> 'Nobile',
		'noto-serif'			=> 'Noto+Serif',
		'neuton'				=> 'Neuton',
		'open-sans'				=> 'Open+Sans',
		'oswald'				=> 'Oswald',
		'patua-one'				=> 'Patua+One',
		'playfair-display'		=> 'Playfair+Display',
		'pt-sans'				=> 'PT+Sans',
		'pt-serif'				=> 'PT+Serif',
		'quattrocento-sans' 	=> 'Quattrocento+Sans',
		'roboto'				=> 'Roboto',
		'roboto-slab'			=> 'Roboto+Slab',
		'roboto-condensed'			=> 'Roboto+Condensed',
		'source-sans-pro'		=> 'Source+Sans+Pro',
		'ubuntu'				=> 'Ubuntu',
		'varela'				=> 'Varela',
		'yanone-kaffeesatz' 	=> 'Yanone+Kaffeesatz'
	);

	$catchbase_fonts = array_unique( $catchbase_fonts ); // Make the array of fonts unique so that same font is not loaded twice
	$catchbase_fonts = array_intersect( $catchbase_fonts, array_keys( $web_fonts ) ); // Intersect selected fonts and webfonts to only recover fonts that need loading 

	if ( empty( $options[ 'reset_typography' ] ) && !empty( $catchbase_fonts ) ) {		
		$web_fonts_stylesheet = '//fonts.googleapis.com/css?family=';

		$i	=	0;
		foreach( $catchbase_fonts as $catchbase_fonts ) {
			if( $i )// only set | to $web_fonts_stylesheet from second loop onwards 
				$web_fonts_stylesheet .='|';
			
			$web_fonts_stylesheet .= $web_fonts[ $catchbase_fonts ] . ':300,300italic,regular,italic,600,600italic';	
			
			$i = 1;
		}	

		$web_fonts_stylesheet .= '&subset=latin';

		wp_register_style( 'catchbase-web-font', $web_fonts_stylesheet, false, null );
		
		$catchbase_deps = array( 'catchbase-web-font' );
	} 
	else {
		$catchbase_deps = false;
	}

	wp_enqueue_style( 'catchbase-style', get_stylesheet_uri(), $catchbase_deps, '123' );

	wp_enqueue_script( 'catchbase-navigation', get_template_directory_uri() . '/js/navigation.min.js', array(), '20120206', true );

	wp_enqueue_script( 'catchbase-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20130115', true );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//For genericons
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/css/genericons/genericons.css', false, '3.3' );

	/**
	 * Enqueue the styles for the current color scheme for catchbase.
	 */
	if ( $options['color_scheme'] != 'light' )
		wp_enqueue_style( 'catchbase-dark', get_template_directory_uri() . '/css/colors/'. $options['color_scheme'] .'.css', array(), null );
	
	/**
	 * Loads up Responsive stylesheet and Menu JS
	 */
	if ( ! $options['responsive_select'] ) {
		wp_enqueue_style( 'catchbase-responsive', get_template_directory_uri() . '/css/responsive.css' );

		//Responsive Menu		
		wp_enqueue_script('sidr', get_template_directory_uri() . '/js/jquery.sidr.min.js', array('jquery'), '1.2.1', false );	

		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/fitvids.min.js', array( 'jquery' ), '1.1', true );
	}
	

	/**
	 * Loads up Cycle JS
	 */
	if( $options['featured_slider_option'] != 'disabled' ) {
		wp_register_script( 'jquery.cycle2', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.min.js', array( 'jquery' ), '2.1.5', true );

		/**
		 * Condition checks for additional slider transition plugins
		 */
		// Scroll Vertical transition plugin addition
		if ( 'scrollVert' ==  $options['featured_slide_transition_effect'] ){
			wp_enqueue_script( 'jquery.cycle2.scrollVert', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.scrollVert.min.js', array( 'jquery.cycle2' ), '20140128', true );
		}
		// Flip transition plugin addition
		else if ( 'flipHorz' ==  $options['featured_slide_transition_effect'] || 'flipVert' ==  $options['featured_slide_transition_effect'] ){
			wp_enqueue_script( 'jquery.cycle2.flip', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.flip.min.js', array( 'jquery.cycle2' ), '20140128', true );
		}
		// Suffle transition plugin addition
		else if ( 'tileSlide' ==  $options['featured_slide_transition_effect'] || 'tileBlind' ==  $options['featured_slide_transition_effect'] ){
			wp_enqueue_script( 'jquery.cycle2.tile', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.tile.min.js', array( 'jquery.cycle2' ), '20140128', true );
		}
		// Suffle transition plugin addition
		else if ( 'shuffle' ==  $options['featured_slide_transition_effect'] ){
			wp_enqueue_script( 'jquery.cycle2.shuffle', get_template_directory_uri() . '/js/jquery.cycle/jquery.cycle2.shuffle.min.js', array( 'jquery.cycle2' ), '20140128 ', true );
		}
		else {
			wp_enqueue_script( 'jquery.cycle2' );
		}
	}

	/**
	 * Loads up Scroll Up script
	 */	
	if ( ! $options['disable_scrollup'] ) { 
		wp_enqueue_script( 'catchbase-scrollup', get_template_directory_uri() . '/js/catchbase-scrollup.min.js', array( 'jquery' ), '20072014', true  );
	}

	/**
	 * Enqueue custom script for catchbase.
	 */
	wp_enqueue_script( 'masonry', 'script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.js', array( 'jquery' ), true );
	wp_enqueue_script(  'images_loaded', 'http://imagesloaded.desandro.com/imagesloaded.pkgd.min.js', array('jquery','masonry'), true  );
	wp_enqueue_script(  'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', true  );
	wp_enqueue_script( 'skindeep', get_template_directory_uri() . '/js/skindeep.js', array( 'jquery','masonry', 'modernizr' ), true );
	wp_enqueue_script( 'catchbase-custom-scripts', get_template_directory_uri() . '/js/catchbase-custom-scripts.min.js', array( 'jquery' ), null );
}
add_action( 'wp_enqueue_scripts', 'catchbase_scripts' );


/**
 * Enqueue scripts and styles for Metaboxes
 * @uses wp_register_script, wp_enqueue_script, and  wp_enqueue_style
 *
 * @action admin_print_scripts-post-new, admin_print_scripts-post, admin_print_scripts-page-new, admin_print_scripts-page
 *
 * @since Catch Base 1.0
 */
function catchbase_enqueue_metabox_scripts() {
    //Scripts
	wp_enqueue_script( 'catchbase-metabox', get_template_directory_uri() . '/js/catchbase-metabox.min.js', array( 'jquery', 'jquery-ui-tabs' ), '2013-10-05' );
	
	//CSS Styles
	wp_enqueue_style( 'catchbase-metabox-tabs', get_template_directory_uri() . '/css/catchbase-metabox-tabs.css' );
}
add_action( 'admin_print_scripts-post-new.php', 'catchbase_enqueue_metabox_scripts', 11 );
add_action( 'admin_print_scripts-post.php', 'catchbase_enqueue_metabox_scripts', 11 );
add_action( 'admin_print_scripts-page-new.php', 'catchbase_enqueue_metabox_scripts', 11 );
add_action( 'admin_print_scripts-page.php', 'catchbase_enqueue_metabox_scripts', 11 );


/**
 * Default Options.
 */
require get_template_directory() . '/inc/catchbase-default-options.php';

/**
 * Custom Header.
 */
require get_template_directory() . '/inc/catchbase-custom-header.php';


/**
 * Structure for catchbase
 */
require get_template_directory() . '/inc/catchbase-structure.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer-includes/catchbase-customizer.php';


/**
 * Custom Menus
 */
require get_template_directory() . '/inc/catchbase-menus.php';


/**
 * Load Slider file.
 */
require get_template_directory() . '/inc/catchbase-featured-slider.php';


/**
 * Load Featured Content.
 */
require get_template_directory() . '/inc/catchbase-featured-content.php';


/**
 * Load Breadcrumb file.
 */
require get_template_directory() . '/inc/catchbase-breadcrumb.php';


/**
 * Load Widgets and Sidebars
 */
require get_template_directory() . '/inc/catchbase-widgets.php';


/**
 * Load Social Icons
 */
require get_template_directory() . '/inc/catchbase-social-icons.php';


/**
 * Load Metaboxes
 */
require get_template_directory() . '/inc/catchbase-metabox.php';


/**
 * Returns the options array for catchbase.
 * @uses  get_theme_mod
 *
 * @since Catch Base 1.0
 */
function catchbase_get_theme_options() {
	return get_theme_mod( 'catchbase_theme_options', catchbase_get_default_theme_options() );
}


/**
 * Flush out all transients
 *
 * @uses delete_transient 
 * 
 * @action customize_save, catchbase_customize_preview (see catchbase_customizer function: catchbase_customize_preview)
 * 
 * @since Catch Base 1.0
 */
function catchbase_flush_transients(){
	delete_transient( 'catchbase_featured_content' );
	
	delete_transient( 'catchbase_featured_slider' );

	delete_transient( 'catchbase_favicon' );

	delete_transient( 'catchbase_webclip' );

	delete_transient( 'catchbase_custom_css' );

	delete_transient( 'catchbase_footer_content' );	

	delete_transient( 'catchbase_promotion_headline' );

	delete_transient( 'catchbase_featured_image' );

	delete_transient( 'catchbase_social_icons' );	

	delete_transient( 'catchbase_scrollup' );

	delete_transient( 'all_the_cool_cats' );

	//Add Catchbase default themes if there is no values
	if ( !get_theme_mod('catchbase_theme_options') ) {
		set_theme_mod( 'catchbase_theme_options', catchbase_get_default_theme_options() );
	}
}
add_action( 'customize_save', 'catchbase_flush_transients' );

/**
 * Flush out category transients
 *
 * @uses delete_transient 
 * 
 * @action edit_category
 * 
 * @since Catch Base 1.0
 */
function catchbase_flush_category_transients(){
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'catchbase_flush_category_transients' );


/**
 * Flush out post related transients
 *
 * @uses delete_transient 
 * 
 * @action save_post
 * 
 * @since Catch Base 1.0
 */
function catchbase_flush_post_transients(){
	delete_transient( 'catchbase_featured_content' );
	
	delete_transient( 'catchbase_featured_slider' );

	delete_transient( 'catchbase_featured_image' );

	delete_transient( 'all_the_cool_cats' );
}
add_action( 'save_post', 'catchbase_flush_post_transients' );


if ( ! function_exists( 'catchbase_favicon' ) ) :
	/**
	 * Get the favicon Image options
	 *
	 * @uses favicon 
	 * @get the data value of image from options
	 * @display favicon
	 *
	 * @uses set_transient
	 *
	 * @action wp_head, admin_head
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_favicon() {
		if( ( !$catchbase_favicon = get_transient( 'catchbase_favicon' ) ) ) {
			$options 	= catchbase_get_theme_options();
			
			echo '<!-- refreshing cache -->';
			
			if ( isset( $options[ 'favicon' ] ) &&  $options[ 'favicon' ] != '' &&  !empty( $options[ 'favicon' ] ) ) {
				// if not empty fav_icon on options
				$catchbase_favicon = '<link rel="shortcut icon" href="'.esc_url( $options[ 'favicon' ] ).'" type="image/x-icon" />'; 	
			}

			set_transient( 'catchbase_favicon', $catchbase_favicon, 86940 );	
		}
		echo $catchbase_favicon ;	
	}
endif; //catchbase_favicon
//Load Favicon in Header Section
add_action( 'wp_head', 'catchbase_favicon' );
//Load Favicon in Admin Section
add_action( 'admin_head', 'catchbase_favicon' );


if ( ! function_exists( 'catchbase_web_clip' ) ) :
	/**
	 * Get the Web Clip Icon Image from options
	 *
	 * @uses web_clip and remove_web_clip 
	 * @get the data value of image from theme options
	 * @display web clip
	 *
	 * @uses default Web Click Icon if web_clip field on theme options is empty
	 *
	 * @uses set_transient and delete_transient 
	 *
	 * @action wp_head
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_web_clip() {
		if( ( !$catchbase_web_clip = get_transient( 'catchbase_web_clip' ) ) ) {
			$options 	= catchbase_get_theme_options();
			
			echo '<!-- refreshing cache -->';
			
			if ( isset( $options[ 'web_clip' ] ) &&  $options[ 'web_clip' ] != '' &&  !empty( $options[ 'web_clip' ] ) ){
				$catchbase_web_clip = '<link rel="apple-touch-icon-precomposed" href="'.esc_url( $options[ 'web_clip' ] ).'" />'; 	
			}
			
			set_transient( 'catchbase_web_clip', $catchbase_web_clip, 86940 );	
		}	
		echo $catchbase_web_clip ;	
	}
endif; //catchbase_web_clip
//Load Catchbase Icon in Header Section
add_action('wp_head', 'catchbase_web_clip');

if ( ! function_exists( 'catchbase_custom_css' ) ) :
	/**
	 * Enqueue Custon CSS
	 *
	 * @uses  set_transient, wp_head, wp_enqueue_style
	 *
	 * @action wp_enqueue_scripts
	 * 
	 * @since Catch Base 1.0
	 */
	function catchbase_custom_css() {
		//catchbase_flush_transients();
		$options 	= catchbase_get_theme_options();
		
		$defaults 	= catchbase_get_default_theme_options();

		$defaults_temp 	= $defaults;
		
		$fonts 		= catchbase_avaliable_fonts();

		$responsive_select 	= ( isset ( $options['responsive_select'] ) && $options['responsive_select'] ) ? 1 : 0;
			
		if ( ( !$catchbase_custom_css = get_transient( 'catchbase_custom_css' ) ) ) {		
			$catchbase_custom_css ='';

			$text_color = get_header_textcolor();

			//Change values of default colors if the scheme is dark
			if ( 'dark' == $options['color_scheme'] ) {
				$defaults = catchbase_default_dark_color_options();
			}

			if ( 'blank' == $text_color ){
				$catchbase_custom_css	.=  ".site-title a, .site-description { position: absolute !important; clip: rect(1px 1px 1px 1px); clip: rect(1px, 1px, 1px, 1px); }". "\n";
			}
			elseif (  HEADER_TEXTCOLOR != $text_color ) {
				$catchbase_custom_css	.=  ".site-title a, .site-description { color: #".  $text_color ."; }". "\n";
			}

			//Basic Color Options
			if( $defaults[ 'text_color' ] != $options[ 'text_color' ] ) {
				$catchbase_custom_css	.=  "body, button, input, select, textarea { color: ".  $options[ 'text_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'link_color' ] != $options[ 'link_color' ] ) {
				$catchbase_custom_css	.=  "a { color: ".  $options[ 'link_color' ] ."; }". "\n";	
			}

			if( $defaults[ 'link_hover_color' ] != $options[ 'link_hover_color' ] ) {
				$catchbase_custom_css	.=  "a:hover, a:focus, a:active { color: ".  $options[ 'link_hover_color' ] ."; }". "\n";	
			}		

			//Header Color Options
			if( $defaults[ 'header_background_color' ] != $options[ 'header_background_color' ] ) {
				$catchbase_custom_css	.=  "#masthead { background-color: ".  $options[ 'header_background_color' ] ."; }". "\n";	
			}

			if( $defaults[ 'site_title_hover_color' ] != $options[ 'site_title_hover_color' ] ) {
				$catchbase_custom_css	.=  ".site-title a:hover { color: ".  $options[ 'site_title_hover_color' ] ."; }". "\n";
			}

			if( $defaults[ 'tagline_color' ] != $options[ 'tagline_color' ] ) {
				$catchbase_custom_css	.=  ".site-description { color: ".  $options[ 'tagline_color' ] ."; }". "\n";
			}

			//Content Color Options
			if( $defaults[ 'content_wrapper_background_color' ] != $options[ 'content_wrapper_background_color' ] ) {
				$catchbase_custom_css	.=  "#content { background-color: ".  $options[ 'content_wrapper_background_color' ] ."; }". "\n";	
			}

			if( $defaults[ 'content_background_color' ] != $options[ 'content_background_color' ] ) {
				$catchbase_custom_css	.=  "#main { background-color: ".  $options[ 'content_background_color' ] ."; }". "\n";	
			}

			if( $defaults[ 'content_title_color' ] != $options[ 'content_title_color' ] ) {
				$catchbase_custom_css	.=  ".page-title, #main .entry-title, #main .entry-title a { color: ".  $options[ 'content_title_color' ] ."; }". "\n";	
			}

			if( $defaults[ 'content_title_hover_color' ] != $options[ 'content_title_hover_color' ] ) {
				$catchbase_custom_css	.=  "#main .entry-title a:hover { color: ".  $options[ 'content_title_hover_color' ] ."; }". "\n";
			}

			if( $defaults[ 'content_meta_color' ] != $options[ 'content_meta_color' ] ) {
				$catchbase_custom_css	.=  "#main .entry-meta a { color: ".  $options[ 'content_meta_color' ] ."; }". "\n";	
			}

			if( $defaults[ 'content_meta_hover_color' ] != $options[ 'content_meta_hover_color' ] ) {
				$catchbase_custom_css	.=  "#main .entry-meta a:hover { color: ".  $options[ 'content_meta_hover_color' ] ."; }". "\n";	
			}		

			//Sidebar Color Options
			if( $defaults[ 'sidebar_background_color' ] != $options[ 'sidebar_background_color' ] ) {
				$catchbase_custom_css	.=  ".sidebar-primary, .sidebar-secondary { background-color: ".  $options[ 'sidebar_background_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'sidebar_widget_title_color' ] != $options[ 'sidebar_widget_title_color' ] ) {
				$catchbase_custom_css	.=  ".sidebar-primary .widget-wrap .widget-title, .sidebar-primary .widget-wrap .widget-title a, .sidebar-secondary .widget-wrap .widget-title, .widget-wrap .sidebar-secondary .widget-title a { color: ".  $options[ 'sidebar_widget_title_color' ] ."; }". "\n";
			}
			
			if( $defaults[ 'sidebar_widget_text_color' ] != $options[ 'sidebar_widget_text_color' ] ) {
				$catchbase_custom_css	.=  ".sidebar-primary .widget-wrap, .sidebar-secondary .widget-wrap { color: ".  $options[ 'sidebar_widget_text_color' ] ."; }". "\n";
			}

			if( $defaults[ 'sidebar_widget_link_color' ] != $options[ 'sidebar_widget_link_color' ] ) {
				$catchbase_custom_css	.=  ".sidebar-primary .widget-wrap a, .sidebar-secondary .widget-wrap a { color: ".  $options[ 'sidebar_widget_text_color' ] ."; }". "\n";
			}

			//Pagination Color Options
			if( $defaults[ 'pagination_background_color' ] != $options[ 'pagination_background_color' ] ) {
				$catchbase_custom_css	.=  "#nav-below, #infinite-handle { background-color: ".  $options[ 'pagination_background_color' ] ."; }". "\n";	
			}

			if( $defaults[ 'pagination_hover_background_color' ] != $options[ 'pagination_hover_background_color' ] ) {
				$catchbase_custom_css	.=  "#nav-below:hover, #infinite-handle:hover { background-color: ".  $options[ 'pagination_hover_background_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'pagination_text_color' ] != $options[ 'pagination_text_color' ] ) {
				$catchbase_custom_css	.=  "#nav-below .wp-pagenavi span.pages, #infinite-handle span { color: ".  $options[ 'pagination_text_color' ] ."; }". "\n";
			}
			
			if( $defaults[ 'pagination_link_color' ] != $options[ 'pagination_link_color' ] ) {
				$catchbase_custom_css	.=  "#nav-below a, #nav-below .wp-pagenavi a, #nav-below .wp-pagenavi span, #infinite-handle span { color: ".  $options[ 'pagination_link_color' ] ."; }". "\n";
			}

			if( $defaults[ 'pagination_hover_active_color' ] != $options[ 'pagination_hover_active_color' ] ) {
				$catchbase_custom_css	.=  "#nav-below a:hover, #nav-below .wp-pagenavi a:hover, #nav-below .wp-pagenavi span.current, #infinite-handle span:hover, #infinite-handle span:hover { color: ".  $options[ 'pagination_hover_active_color' ] ."; }". "\n";
			}

			if( $defaults[ 'numeric_infinite_scroll_background_color' ] != $options[ 'numeric_infinite_scroll_background_color' ] ) {
				$catchbase_custom_css	.=  "#nav-below .wp-pagenavi a, #infinite-handle span { background-color: ".  $options[ 'numeric_infinite_scroll_background_color' ] ."; }". "\n";
			}

			if( $defaults[ 'numeric_infinite_scroll_hover_background_color' ] != $options[ 'numeric_infinite_scroll_hover_background_color' ] ) {
				$catchbase_custom_css	.=  "#nav-below .wp-pagenavi a:hover, #nav-below .wp-pagenavi span.current,  #infinite-handle span:hover { background-color: ".  $options[ 'numeric_infinite_scroll_hover_background_color' ] ."; }". "\n";
			}
				
			//Footer Color Options
			if( ( $defaults[ 'footer_background_color' ] != $options[ 'footer_background_color' ] ) || ( $defaults[ 'footer_text_color' ] != $options[ 'footer_text_color' ] ) ) {
				$catchbase_custom_css	.=  "#site-generator { background-color: ".  $options[ 'footer_background_color' ] ."; color: ".  $options[ 'footer_text_color' ] ."; }". "\n";	
			}			

			if( $defaults[ 'footer_link_color' ] != $options[ 'footer_link_color' ] ) {
				$catchbase_custom_css	.=  "#site-generator a { color: ".  $options[ 'footer_link_color' ] ."; }". "\n";	
			}	

			if( $defaults[ 'footer_sidebar_area_background_color' ] != $options[ 'footer_sidebar_area_background_color' ] ) {
				$catchbase_custom_css	.=  "#supplementary { background-color: ".  $options[ 'footer_sidebar_area_background_color' ] ."; }". "\n";	
			}	

			if( $defaults[ 'footer_widget_background_color' ] != $options[ 'footer_widget_background_color' ] ) {
				$catchbase_custom_css	.=  "#supplementary .widget { background-color: ".  $options[ 'footer_widget_background_color' ] ."; }". "\n";
			}	

			if( $defaults[ 'footer_widget_title_color' ] != $options[ 'footer_widget_title_color' ] ) {
				$catchbase_custom_css	.=  "#supplementary .widget-wrap .widget-title, #supplementary .widget-wrap .widget-title a { color: ".  $options[ 'footer_widget_title_color' ] ."; }". "\n";
			}	

			if( $defaults[ 'footer_widget_text_color' ] != $options[ 'footer_widget_text_color' ] ) {
				$catchbase_custom_css	.=  "#supplementary .widget-wrap { color: ".  $options[ 'footer_widget_text_color' ] ."; }". "\n";
			}	

			if( $defaults[ 'footer_widget_link_color' ] != $options[ 'footer_widget_link_color' ] ) {
				$catchbase_custom_css	.=  "#supplementary .widget-wrap a { color: ".  $options[ 'footer_widget_link_color' ] ."; }". "\n";
			}		

			//Promotion Headline Color Options
			if( ( $defaults[ 'promotion_headline_background_color' ] != $options[ 'promotion_headline_background_color' ] ) || ( $defaults[ 'promotion_headline_text_color' ] != $options[ 'promotion_headline_text_color' ] ) ) {
				$catchbase_custom_css	.=  "#promotion-message { background-color: ".  $options[ 'promotion_headline_background_color' ] ."; color: ".  $options[ 'promotion_headline_text_color' ] .";  }". "\n";
			}		
			

			if( $defaults[ 'promotion_headline_link_color' ] != $options[ 'promotion_headline_link_color' ] ) {
				$catchbase_custom_css	.=  "#promotion-message a { color: ".  $options[ 'promotion_headline_link_color' ] ."; }". "\n";
			}	

			if( ( $defaults[ 'promotion_headline_button_background_color' ] != $options[ 'promotion_headline_button_background_color' ] ) || ( $defaults[ 'promotion_headline_button_text_color' ] != $options[ 'promotion_headline_button_text_color' ] ) ) {
				$catchbase_custom_css	.=  "#promotion-message .right a { background-color: ".  $options[ 'promotion_headline_button_background_color' ] ."; color: ".  $options[ 'promotion_headline_button_text_color' ] ."; }". "\n";
			}	

			if( ( $defaults[ 'promotion_headline_button_hover_background_color' ] != $options[ 'promotion_headline_button_hover_background_color' ] ) || ( $defaults[ 'promotion_headline_button_hover_text_color' ] != $options[ 'promotion_headline_button_hover_text_color' ] ) ) {
				$catchbase_custom_css	.=  "#promotion-message .right a:hover { background-color: ".  $options[ 'promotion_headline_button_hover_background_color' ] ."; color: ".  $options[ 'promotion_headline_button_hover_text_color' ] ."; }". "\n";
			}	

			//Scrollup Color Options
			if( ( $defaults[ 'scrollup_background_color' ] != $options[ 'scrollup_background_color' ] ) || ( $defaults[ 'scrollup_text_color' ] != $options[ 'scrollup_text_color' ] ) ) {
				$catchbase_custom_css	.=  "#scrollup { background-color: ".  $options[ 'scrollup_background_color' ] ."; color: ".  $options[ 'scrollup_text_color' ] ."; }". "\n";	
			}
			if( ( $defaults[ 'scrollup_hover_background_color' ] != $options[ 'scrollup_hover_background_color' ] ) || ( $defaults[ 'scrollup_hover_text_color' ] != $options[ 'scrollup_hover_text_color' ] ) ) {
				$catchbase_custom_css	.=  "#scrollup:hover { background-color: ".  $options[ 'scrollup_hover_background_color' ] ."; color: ".  $options[ 'scrollup_hover_text_color' ] ."; }". "\n";	
			}

			//Slider Color Options
			if( $defaults[ 'slider_background_color' ] != $options[ 'slider_background_color' ] ) {
				$catchbase_custom_css	.=  "#feature-slider { background-color: ".  $options[ 'slider_background_color' ] ."; }". "\n";	
			}			
						
			if( $defaults[ 'slider_text_color' ] != $options[ 'slider_text_color' ] ) {
				$catchbase_custom_css	.=  "#feature-slider .entry-container { color: ".  $options[ 'slider_text_color' ] ."; }". "\n";	
			}			

			if( $defaults[ 'slider_link_color' ] != $options[ 'slider_link_color' ] ) {
				$catchbase_custom_css	.=  "#feature-slider .entry-container a { color: ".  $options[ 'slider_link_color' ] ."; }". "\n";	
			}	

			//Featured Content Color Options
			if( $defaults[ 'featured_content_background_color' ] != $options[ 'featured_content_background_color' ] ) {
				$catchbase_custom_css	.=  "#featured-content { background-color: ".  $options[ 'featured_content_background_color' ] ."; }". "\n";	
			}			
						
			if( $defaults[ 'featured_content_title_color' ] != $options[ 'featured_content_title_color' ] ) {
				$catchbase_custom_css	.=  "#featured-content .entry-title, #featured-content .entry-title a { color: ".  $options[ 'featured_content_title_color' ] ."; }". "\n";	
			}			

			if( $defaults[ 'featured_content_text_color' ] != $options[ 'featured_content_text_color' ] ) {
				$catchbase_custom_css	.=  "#featured-content { color: ".  $options[ 'featured_content_text_color' ] ."; }". "\n";
			}	

			if( $defaults[ 'featured_content_link_color' ] != $options[ 'featured_content_link_color' ] ) {
				$catchbase_custom_css	.=  "#featured-content a { color: ".  $options[ 'featured_content_link_color' ] ."; }". "\n";	
			}	
			
			// Primary Menu Color			
			if( ( $defaults[ 'menu_background_color' ] != $options[ 'menu_background_color' ] ) || ( $defaults[ 'menu_color' ] != $options[ 'menu_color' ] ) || ( $defaults[ 'hover_active_color' ] != $options[ 'hover_active_color' ] ) || ( $defaults[ 'hover_active_text_color' ] != $options[ 'hover_active_text_color' ] ) || ( $defaults[ 'sub_menu_background_color' ] != $options[ 'sub_menu_background_color' ] ) || ( $defaults[ 'sub_menu_text_color' ] != $options[ 'sub_menu_text_color' ] ) ) {
				$catchbase_custom_css	.=  ".nav-primary { background-color: ".  $options[ 'menu_background_color' ] ."; }". "\n";
				$catchbase_custom_css	.=  ".nav-primary ul.menu a { color: ".  $options[ 'menu_color' ] ."; }". "\n";	
				$catchbase_custom_css	.=  ".nav-primary ul.menu li:hover > a, .nav-primary ul.menu a:focus, .nav-primary ul.menu .current-menu-item > a, .nav-primary ul.menu .current-menu-ancestor > a, .nav-primary ul.menu .current_page_item > a, .nav-primary ul.menu .current_page_ancestor > a { background-color: ".  $options[ 'hover_active_color' ] ."; color: ".  $options[ 'hover_active_text_color' ] ."; }". "\n";	
				$catchbase_custom_css	.=  ".nav-primary ul.menu .sub-menu a, .nav-primary ul.menu .children a { background-color: ".  $options[ 'sub_menu_background_color' ] ."; color: ".  $options[ 'sub_menu_text_color' ] ."; }". "\n";
			}
				
			// Secondary Menu Color
			if( ( $defaults[ 'secondary_menu_background_color' ] != $options[ 'secondary_menu_background_color' ] ) || ( $defaults[ 'secondary_menu_color' ] != $options[ 'secondary_menu_color' ] ) || ( $defaults[ 'secondary_hover_active_color' ] != $options[ 'secondary_hover_active_color' ] ) || ( $defaults[ 'secondary_hover_active_text_color' ] != $options[ 'secondary_hover_active_text_color' ] ) || ( $defaults[ 'secondary_sub_menu_background_color' ] != $options[ 'secondary_sub_menu_background_color' ] ) || ( $defaults[ 'secondary_sub_menu_text_color' ] != $options[ 'secondary_sub_menu_text_color' ] ) ) {
				$catchbase_custom_css	.=  ".nav-secondary { background-color: ".  $options[ 'secondary_menu_background_color' ] ."; }". "\n";
				$catchbase_custom_css	.=  ".nav-secondary ul.menu a { color: ".  $options[ 'secondary_menu_color' ] ."; }". "\n";	
				$catchbase_custom_css	.=  ".nav-secondary ul.menu li:hover > a, .nav-secondary ul.menu a:focus, .nav-secondary ul.menu .current-menu-item > a, .nav-secondary ul.menu .current-menu-ancestor > a, .nav-secondary ul.menu .current_page_item > a, .nav-secondary ul.menu .current_page_ancestor > a { background-color: ".  $options[ 'secondary_hover_active_color' ] ."; color: ".  $options[ 'secondary_hover_active_text_color' ] ."; }". "\n";	
				$catchbase_custom_css	.=  ".nav-secondary ul.menu .sub-menu a, .nav-secondary ul.menu .children a { background-color: ".  $options[ 'secondary_sub_menu_background_color' ] ."; color: ".  $options[ 'secondary_sub_menu_text_color' ] ."; }". "\n";
			}

			// Header Right Menu Color
			if ( isset( $options[ 'header_right_menu_background_color' ] ) ) {
				//Check isset because this option is added later. Remove this check for fresh themes
				if( ( $defaults[ 'header_right_menu_background_color' ] != $options[ 'header_right_menu_background_color' ] ) || ( $defaults[ 'header_right_menu_color' ] != $options[ 'header_right_menu_color' ] ) || ( $defaults[ 'header_right_hover_active_color' ] != $options[ 'header_right_hover_active_color' ] ) || ( $defaults[ 'header_right_hover_active_text_color' ] != $options[ 'header_right_hover_active_text_color' ] ) || ( $defaults[ 'header_right_sub_menu_background_color' ] != $options[ 'header_right_sub_menu_background_color' ] ) || ( $defaults[ 'header_right_sub_menu_text_color' ] != $options[ 'header_right_sub_menu_text_color' ] ) ) {
					$catchbase_custom_css	.=  ".sidebar-header-right .wrapper, .sidebar-header-right .widget_nav_menu { background-color: ".  $options[ 'header_right_menu_background_color' ] ."; }". "\n";
					$catchbase_custom_css	.=  ".sidebar-header-right ul.menu a { color: ".  $options[ 'header_right_menu_color' ] ."; }". "\n";	
					$catchbase_custom_css	.=  ".sidebar-header-right ul.menu li:hover > a, .sidebar-header-right ul.menu a:focus, .sidebar-header-right ul.menu .current-menu-item > a, .sidebar-header-right ul.menu .current-menu-ancestor > a { background-color: ".  $options[ 'header_right_hover_active_color' ] ."; color: ".  $options[ 'header_right_hover_active_text_color' ] ."; }". "\n";	
					$catchbase_custom_css	.=  ".sidebar-header-right ul.menu .sub-menu a { background-color: ".  $options[ 'header_right_sub_menu_background_color' ] ."; color: ".  $options[ 'header_right_sub_menu_text_color' ] ."; }". "\n";
				}
			}	
			
			// Footer Menu Color
			if( ( $defaults[ 'footer_menu_background_color' ] != $options[ 'footer_menu_background_color' ] ) || ( $defaults[ 'footer_menu_color' ] != $options[ 'footer_menu_color' ] ) || ( $defaults[ 'footer_hover_active_color' ] != $options[ 'footer_hover_active_color' ] ) || ( $defaults[ 'footer_hover_active_text_color' ] != $options[ 'footer_hover_active_text_color' ] ) || ( $defaults[ 'footer_sub_menu_background_color' ] != $options[ 'footer_sub_menu_background_color' ] ) || ( $defaults[ 'footer_sub_menu_text_color' ] != $options[ 'footer_sub_menu_text_color' ] ) ) {
				$catchbase_custom_css	.=  ".nav-footer { background-color: ".  $options[ 'footer_menu_background_color' ] ."; }". "\n";
				$catchbase_custom_css	.=  ".nav-footer ul.menu a { color: ".  $options[ 'footer_menu_color' ] ."; }". "\n";	
				$catchbase_custom_css	.=  ".nav-footer ul.menu li:hover > a, .nav-footer ul.menu a:focus, .nav-footer ul.menu .current-menu-item > a, .nav-footer ul.menu .current-menu-ancestor > a, .nav-footer ul.menu .current_page_item > a, .nav-footer ul.menu .current_page_ancestor > a { background-color: ".  $options[ 'footer_hover_active_color' ] ."; color: ".  $options[ 'footer_hover_active_text_color' ] ."; }". "\n";	
				$catchbase_custom_css	.=  ".nav-footer ul.menu .sub-menu a, .nav-footer ul.menu .children a { background-color: ".  $options[ 'footer_sub_menu_background_color' ] ."; color: ".  $options[ 'footer_sub_menu_text_color' ] ."; }". "\n";
			}	

			//Revert values of default to its originals if the value is changed due to dark color scheme
			$defaults 	= $defaults_temp;

			// Typography (Font Family) Options
			if( ! $options[ 'reset_typography' ] ) {			
				if( $defaults[ 'body_font' ] != $options[ 'body_font' ] ) {
					$catchbase_custom_css	.=  "body, button, input, select, textarea { font-family: ". $fonts [ $options[ 'body_font' ] ] [ 'label' ] ."; }". "\n";
				}	
				if( $defaults[ 'title_font' ] != $options[ 'title_font' ] ) {
					$catchbase_custom_css	.=  ".site-title { font-family: ". $fonts [ $options[ 'title_font' ] ] [ 'label' ] ."; }". "\n";
				}	
				if( $defaults[ 'tagline_font' ] != $options[ 'tagline_font' ] ) {
					$catchbase_custom_css	.=  ".site-description { font-family: ". $fonts [ $options[ 'tagline_font' ] ] [ 'label' ] ."; }". "\n";
				}	
				if( $defaults[ 'content_title_font' ] != $options[ 'content_title_font' ] ) {
					$catchbase_custom_css	.=  ".page-title, #main .entry-container .entry-title, #featured-content .entry-title { font-family: ". $fonts [ $options[ 'content_title_font' ] ] [ 'label' ] ."; }". "\n";
				}
				if( $defaults[ 'content_font' ] != $options[ 'content_font' ] ) {
					$catchbase_custom_css	.=  "#main .entry-container, #featured-content { font-family: ". $fonts [ $options[ 'content_font' ] ] [ 'label' ] ."; }". "\n";
				}	
				if( $defaults[ 'headings_font' ] != $options[ 'headings_font' ] ) {
					$catchbase_custom_css	.=  "h1, h2, h3, h4, h5, h6 { font-family: ". $fonts [ $options[ 'headings_font' ] ] [ 'label' ] ."; }". "\n";
				}
				
			}
				
			/*
			 * Custom css for genericon social icons. needs change: @change
			 */
			if( $defaults[ 'social_icon_size' ] != $options[ 'social_icon_size' ] )
			if( isset( $options['social_icon_size'] ) && $options['social_icon_size'] != '' ){
				$size 	= $options['social_icon_size'];
				
				$catchbase_custom_css    .=    '.widget_catchbase_social_icons .genericon:before { font-size:'. $size .'px; }' . "\n";
			}

			//Custom CSS Option		
			if( !empty( $options[ 'custom_css' ] ) ) {
				$catchbase_custom_css	.=  $options[ 'custom_css'] . "\n";
			}

			if ( '' != $catchbase_custom_css ){
				echo '<!-- refreshing cache -->' . "\n";
				
				$catchbase_custom_css = '<!-- '.get_bloginfo('name').' inline CSS Styles -->' . "\n" . '<style type="text/css" media="screen">' . "\n" . $catchbase_custom_css;
			
				$catchbase_custom_css .= '</style>' . "\n";
			
			}
			
			set_transient( 'catchbase_custom_css', htmlspecialchars_decode( $catchbase_custom_css ), 86940 );
		}
		
		echo $catchbase_custom_css;
	}
endif; //catchbase_custom_css
add_action( 'wp_head', 'catchbase_custom_css', 101  );


if ( ! function_exists( 'catchbase_rss_redirect' ) ) :
	/**
	 * Redirect WordPress Feeds To FeedBurner
	 *
	 * @action template_redirect
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_rss_redirect() {	
		$options 	= catchbase_get_theme_options();

	    if ( $options['feed_redirect'] ) {
			$url = 'Location: '.$options['feed_redirect'];
			if ( is_feed() && !preg_match('/feedburner|feedvalidator/i', $_SERVER['HTTP_USER_AGENT']))
			{
				header( esc_url( $url ) );
				header('HTTP/1.1 302 Temporary Redirect');
			}
		}
	}
endif; //catchbase_rss_redirect
add_action( 'template_redirect', 'catchbase_rss_redirect' );


/**
 * Alter the query for the main loop in homepage
 * 
 * @action pre_get_posts
 * 
 * @since Catch Base 1.0
 */
function catchbase_alter_home( $query ){
	$options 	= catchbase_get_theme_options();
		
    $cats 		= $options[ 'front_page_category' ];

    $quantity	= $options['featured_slide_number'];

	$post_list	= array();	// list of valid post ids

	for( $i = 1; $i <= $quantity; $i++ ){
		if( isset ( $options['featured_slider_post_' . $i] ) && $options['featured_slider_post_' . $i] > 0 ){
			$post_list	=	array_merge( $post_list, array( $options['featured_slider_post_' . $i] ) );
		}

	}

    if ( '1' == $options[ 'exclude_slider_post'] && !empty( $post_list ) ) {
		if( $query->is_main_query() && $query->is_home() ) {
			$query->query_vars['post__not_in'] = $post_list;
		}
	}

	if ( is_array( $cats ) && !in_array( '0', $cats ) ) {
		if( $query->is_main_query() && $query->is_home() ) {
			$query->query_vars['category__in'] =  $cats;
		}
	}
}
add_action( 'pre_get_posts','catchbase_alter_home' );


if ( ! function_exists( 'catchbase_content_nav' ) ) :
	/**
	 * Display navigation to next/previous pages when applicable
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous )
				return;
		}
		
		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$options			= catchbase_get_theme_options();
		
		$pagination_type	= $options['pagination_type'];

		$nav_class = ( is_single() ) ? 'site-navigation post-navigation' : 'site-navigation paging-navigation';
		
		/**
		 * Check if navigation type is Jetpack Infinite Scroll and if it is enabled, else goto default pagination
		 * if it's active then disable pagination
		 */
		if ( ( 'infinite-scroll-click' == $pagination_type || 'infinite-scroll-scroll' == $pagination_type ) && class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
			return false;
		}

		?>
	        <nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>">
	        	<h3 class="screen-reader-text"><?php _e( 'Post navigation', 'catch-base' ); ?></h3>
				<?php
				/**
				 * Check if navigation type is numeric and if Wp-PageNavi Plugin is enabled
				 */
				if ( 'numeric' == $pagination_type && function_exists( 'wp_pagenavi' ) ) {
					wp_pagenavi();
	            }
	            else { ?>	
	                <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'catch-base' ) ); ?></div>
	                <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'catch-base' ) ); ?></div>
	            <?php 
	            } ?>
	        </nav><!-- #nav -->	
		<?php
	}
endif; // catchbase_content_nav


if ( ! function_exists( 'catchbase_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">
				<?php _e( 'Pingback:', 'catch-base' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'catch-base' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		<?php else : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
						<?php printf( __( '%s <span class="says">says:</span>', 'catch-base' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</div><!-- .comment-author -->

					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'catch-base' ), get_comment_date(), get_comment_time() ); ?>
							</time>
						</a>
						<?php edit_comment_link( __( 'Edit', 'catch-base' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'catch-base' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<?php
					comment_reply_link( array_merge( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="reply">',
						'after'     => '</div>',
					) ) );
				?>
			</article><!-- .comment-body -->

		<?php
		endif;
	}
endif; // catchbase_comment()


if ( ! function_exists( 'catchbase_the_attached_image' ) ) :
	/**
	 * Prints the attached image with a link to the next attached image.
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_the_attached_image() {
		$post                = get_post();
		$attachment_size     = apply_filters( 'catchbase_attachment_size', array( 1200, 1200 ) );
		$next_attachment_url = wp_get_attachment_url();

		/**
		 * Grab the IDs of all the image attachments in a gallery so we can get the
		 * URL of the next adjacent image in a gallery, or the first image (if
		 * we're looking at the last image in a gallery), or, in a gallery of one,
		 * just the link to that image file.
		 */
		$attachment_ids = get_posts( array(
			'post_parent'    => $post->post_parent,
			'fields'         => 'ids',
			'numberposts'    => 1,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID'
		) );

		// If there is more than 1 attachment in a gallery...
		if ( count( $attachment_ids ) > 1 ) {
			foreach ( $attachment_ids as $attachment_id ) {
				if ( $attachment_id == $post->ID ) {
					$next_id = current( $attachment_ids );
					break;
				}
			}

			// get the URL of the next image attachment...
			if ( $next_id )
				$next_attachment_url = get_attachment_link( $next_id );

			// or get the URL of the first image attachment.
			else
				$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}

		printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
			esc_url( $next_attachment_url ),
			the_title_attribute( array( 'echo' => false ) ),
			wp_get_attachment_image( $post->ID, $attachment_size )
		);
	}
endif; //catchbase_the_attached_image


if ( ! function_exists( 'catchbase_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_entry_meta() {
		echo '<p class="entry-meta">';

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf( '<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			sprintf( _x( '<span class="screen-reader-text">Posted on</span>', 'Used before publish date.', 'catch-base' ) ),
			esc_url( get_permalink() ),
			$time_string
		);

		if ( is_singular() || is_multi_author() ) {
			printf( '<span class="byline"><span class="author vcard">%1$s<a class="url fn n" href="%2$s">%3$s</a></span></span>',
				sprintf( _x( '<span class="screen-reader-text">Author</span>', 'Used before post author name.', 'catch-base' ) ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			);
		}

		if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'catch-base' ), esc_html__( '1 Comment', 'catch-base' ), esc_html__( '% Comments', 'catch-base' ) );
			echo '</span>';
		}

		edit_post_link( esc_html__( 'Edit', 'catch-base' ), '<span class="edit-link">', '</span>' ); 

		echo '</p><!-- .entry-meta -->';
	}
endif; //catchbase_entry_meta


if ( ! function_exists( 'catchbase_tag_category' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_tag_category() {
		echo '<p class="entry-meta">';

		if ( 'post' == get_post_type() ) {
			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'catch-base' ) );
			if ( $categories_list && catchbase_categorized_blog() ) {
				printf( '<span class="cat-links">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'catch-base' ) ),
					$categories_list
				);
			}

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'catch-base' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Tags</span>', 'Used before tag names.', 'catch-base' ) ),
					$tags_list
				);
			}
		}

		echo '</p><!-- .entry-meta -->';
	}
endif; //catchbase_tag_category


/**
 * Returns true if a blog has more than 1 category
 *
 * @since Catch Base 1.0
 */
function catchbase_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so catchbase_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so catchbase_categorized_blog should return false
		return false;
	}
}


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Catch Base 1.0
 */
function catchbase_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'catchbase_page_menu_args' );


/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Catch Base 1.0
 */
function catchbase_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'catchbase_enhanced_image_navigation', 10, 2 );


/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Catch Base 1.0
 */
function catchbase_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'footer-1' ) )
		$count++;

	if ( is_active_sidebar( 'footer-2' ) )
		$count++;

	if ( is_active_sidebar( 'footer-3' ) )
		$count++;

	if ( is_active_sidebar( 'footer-4' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}


if ( ! function_exists( 'catchbase_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_excerpt_length( $length ) {
		// Getting data from Customizer Options
		$options	= catchbase_get_theme_options();
		$length	= $options['excerpt_length'];
		return $length;
	}
endif; //catchbase_excerpt_length
add_filter( 'excerpt_length', 'catchbase_excerpt_length' );


/**
 * Change the defult excerpt length of 30 to whatever passed as value
 * 
 * @use excerpt(10) or excerpt (..)  if excerpt length needs only 10 or whatevere
 * @uses get_permalink, get_the_excerpt
 */
function catchbase_excerpt_desired( $num ) {
    $limit = $num+1;
    $excerpt = explode( ' ', get_the_excerpt(), $limit );
    array_pop( $excerpt );
    $excerpt = implode( " ",$excerpt )."<a href='" .get_permalink() ." '></a>";
    return $excerpt;
}


if ( ! function_exists( 'catchbase_continue_reading' ) ) :
	/**
	 * Returns a "Custom Continue Reading" link for excerpts
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_continue_reading() {
		// Getting data from Customizer Options
		$options		=	catchbase_get_theme_options();
		$more_tag_text	= $options['excerpt_more_text'];

		return '';
	}
endif; //catchbase_continue_reading
add_filter( 'excerpt_more', 'catchbase_continue_reading' );


if ( ! function_exists( 'catchbase_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with catchbase_continue_reading().
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_excerpt_more( $more ) {
		return catchbase_continue_reading();	
	}
endif; //catchbase_excerpt_more
add_filter( 'excerpt_more', 'catchbase_excerpt_more' );


if ( ! function_exists( 'catchbase_custom_excerpt' ) ) :
	/**
	 * Adds Continue Reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_custom_excerpt( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= catchbase_continue_reading();
		}
		return $output;
	}
endif; //catchbase_custom_excerpt
add_filter( 'get_the_excerpt', 'catchbase_custom_excerpt' );


if ( ! function_exists( 'catchbase_more_link' ) ) :
	/**
	 * Replacing Continue Reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_more_link( $more_link, $more_link_text ) {
	 	$options		=	catchbase_get_theme_options();
		$more_tag_text	= $options['excerpt_more_text'];

		return str_replace( $more_link_text, $more_tag_text, $more_link );
	}
endif; //catchbase_more_link
add_filter( 'the_content_more_link', 'catchbase_more_link', 10, 2 );


if ( ! function_exists( 'catchbase_body_classes' ) ) :
	/**
	 * Adds Catchbase layout classes to the array of body classes.
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_body_classes( $classes ) {
		global $post, $wp_query;

		// Adds a class of group-blog to blogs with more than 1 published author
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		// Front page displays in Reading Settings
	    $page_on_front 	= get_option('page_on_front') ;
	    $page_for_posts = get_option('page_for_posts');
	
		// Get Page ID outside Loop
	    $page_id = $wp_query->get_queried_object_id();
		
		// WooCommerce Shop Page 
		if ( class_exists( 'woocommerce' ) && is_woocommerce() ) { 
			$shop_id 	= get_option( 'woocommerce_shop_page_id' );
		    $layout 	= get_post_meta( $shop_id,'catchbase-layout-option', true );
		}
		else {
			// Blog Page or Front Page setting in Reading Settings
			if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
		        $layout = get_post_meta( $page_id,'catchbase-layout-option', true );
		    }
	    	else if ( is_singular() ) {
		 		if ( is_attachment() ) { 
					$parent = $post->post_parent;
					
					$layout = get_post_meta( $parent,'catchbase-layout-option', true );
				} else {
					$layout = get_post_meta( $post->ID,'catchbase-layout-option', true ); 
				}
			}
			else {
				$layout = 'default';
			}
		}

		//check empty and load default
		if( empty( $layout ) ) {
			$layout = 'default';
		}

		$options 		= catchbase_get_theme_options();
			
		if ( class_exists( 'woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() ) ) {
			$current_layout = isset( $options['woocommerce_layout'] ) ? $options['woocommerce_layout'] : 'three-columns';
		}
		else {
			$current_layout = $options['theme_layout'];
		}

		if( 'default' == $layout ) {
			$layout_selector = $current_layout;
		}
		else {
			$layout_selector = $layout;
		}

		switch ( $layout_selector ) {
			case 'left-sidebar':
				$classes[] = 'two-columns content-right';
			break;
			
			case 'right-sidebar':
				$classes[] = 'two-columns content-left';
			break;
			
			case 'three-columns':
				$classes[] = 'three-columns';
			break;
			
			case 'three-columns-secondary-sidebar-first':
				$classes[] = 'three-columns secondary-first';
			break;
			
			case 'three-columns-equal-sidebars':
				$classes[] = 'three-columns equal-sidebars';
			break;
			
			case 'three-columns-equal-columns':
				$classes[] = 'three-columns equal-columns';
			break;
			
			case 'three-columns-content-left':
				$classes[] = 'three-columns content-left';
			break;
			
			case 'three-columns-content-right':
				$classes[] = 'three-columns content-right';
			break;
			
			case 'no-sidebar':
				$classes[] = 'no-sidebar content-width';
			break;
			
			case 'no-sidebar-one-column':
				$classes[] = 'no-sidebar one-column';
			break;
			
			case 'no-sidebar-full-width':
				$classes[] = 'no-sidebar full-width';
			break;
		}

		$current_content_layout = $options['content_layout'];
		if( "" != $current_content_layout ) {
			$classes[] = $current_content_layout;
		}

		//Count number of menus avaliable and set class accordingly
		$mobile_menu_count = 0;
		if ( !$options['primary_menu_disable'] ) {
			$mobile_menu_count++;	
		}

		if ( has_nav_menu( 'secondary' ) ) {
			$mobile_menu_count++;
		}

		if ( has_nav_menu( 'header-right' ) ) {
			$mobile_menu_count++;
		}

		switch ( $mobile_menu_count ) {
			case 1:
				$classes[] = 'mobile-menu-one';
				break;

			case 2:
				$classes[] = 'mobile-menu-two';
				break;

			case 3:
				$classes[] = 'mobile-menu-three';
				break;
		}	

		$classes 	= apply_filters( 'catchbase_body_classes', $classes );

		return $classes;
	}
endif; //catchbase_body_classes
add_filter( 'body_class', 'catchbase_body_classes' );


if ( ! function_exists( 'catchbase_post_classes' ) ) :
	/**
	 * Adds Catchbase post classes to the array of post classes.
	 * used for supporting different content layouts
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_post_classes( $classes ) {
		//Getting Ready to load data from Theme Options Panel
		$options 		= catchbase_get_theme_options();
	
		$contentlayout = $options['content_layout'];

		if ( is_archive() || is_home() ) {
			$classes[] = $contentlayout;
		}

		return $classes;
	}
endif; //catchbase_post_classes
add_filter( 'post_class', 'catchbase_post_classes' );

if ( ! function_exists( 'catchbase_responsive' ) ) :
	/**
	 * Responsive Layout
	 *
	 * @get the data value of responsive layout from theme options
	 * @display responsive meta tag
	 * @action wp_head
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_responsive() {
		$options 			= catchbase_get_theme_options();

		$responsive_select 	= ( isset ( $options['responsive_select'] ) && $options['responsive_select'] ) ? 1 : 0;

		if ( $responsive_select ) {
			$catchbase_responsive = '<!-- Responsive Disabled -->';
		}
		else {
			$catchbase_responsive = '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
		}

		echo $catchbase_responsive;
	}
endif; //catchbase_responsive
add_filter( 'wp_head', 'catchbase_responsive', 1 );


if ( ! function_exists( 'catchbase_archive_content_image' ) ) :
	/**
	 * Template for Featured Image in Archive Content
	 *
	 * To override this in a child theme
	 * simply create your own catchbase_archive_content_image(), and that function will be used instead.
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_archive_content_image() {
		$options 			= catchbase_get_theme_options();
		
		$featured_image = $options['content_layout'];
			
		if ( has_post_thumbnail() && 'full-content' != $featured_image ) { ?>
			<figure class="featured-image">
	                <?php 
						if ( $featured_image == 'excerpt-featured-image' ) {
		                     the_post_thumbnail( 'catchbase-featured' );
		                }
		                elseif ( $featured_image == 'excerpt-landscape-featured-image' ) {
		                     the_post_thumbnail( 'catchbase-featured-landscape' );
		                }
		                elseif ( $featured_image == 'excerpt-portrait-featured-image' ) {
		                     the_post_thumbnail( 'catchbase-featured-portrait' );
		                }
		                elseif ( $featured_image == 'excerpt-thumbnail-featured-image' ) {
		                     the_post_thumbnail( 'thumbnail' );
		                }
		               	elseif ( $featured_image == 'excerpt-full-image' ) {
		                     the_post_thumbnail( 'full' );
		                }
		                elseif ( is_page() )
					?>
	        </figure>
	   	<?php
		}
	}
endif; //catchbase_archive_content_image
add_action( 'catchbase_before_entry_container', 'catchbase_archive_content_image', 10 );


if ( ! function_exists( 'catchbase_single_content_image' ) ) :
	/**
	 * Template for Featured Image in Single Post
	 *
	 * To override this in a child theme
	 * simply create your own catchbase_single_content_image(), and that function will be used instead.
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_single_content_image() {
		global $post, $wp_query;
		
		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if( $post) {
	 		if ( is_attachment() ) { 
				$parent = $post->post_parent;
				$individual_featured_image = get_post_meta( $parent,'catchbase-featured-image', true );
			} else {
				$individual_featured_image = get_post_meta( $page_id,'catchbase-featured-image', true ); 
			}
		}

		if( empty( $individual_featured_image ) || ( !is_page() && !is_single() ) ) {
			$individual_featured_image = 'default';
		}
		
		// Getting data from Theme Options
	   	$options = catchbase_get_theme_options();
		
		$featured_image = $options['single_post_image_layout'];
			
		if ( ( $individual_featured_image == 'disable' || '' == get_the_post_thumbnail() || ( $individual_featured_image=='default' && $featured_image == 'disabled') ) ) {
			echo '<!-- Page/Post Single Image Disabled or No Image set in Post Thumbnail -->';
			return false;
		}
		else {
			$class = '';

			if ( 'default' == $individual_featured_image ) {
				$class = $featured_image;
			}
			else {
				$class = 'from-metabox ' . $individual_featured_image;
			}

			?>
			<figure class="featured-image <?php echo $class; ?>">
                <?php 
				if ( $individual_featured_image == 'large' || ( $individual_featured_image=='default' && $featured_image == 'large' ) ) {
                     the_post_thumbnail( 'catchbase-large' );
                }
                elseif ( $individual_featured_image == 'medium' || ( $individual_featured_image=='default' && $featured_image == 'medium' ) ) {
					the_post_thumbnail( 'catchbase-medium' );
				}	
				elseif ( $individual_featured_image == 'slider-image-size' || ( $individual_featured_image=='default' && $featured_image == 'slider-image-size' ) ) {
					the_post_thumbnail( 'catchbase-slider' );
				}
				else {
					the_post_thumbnail( 'full' );
				} ?>
	        </figure>
	   	<?php
		}
	}
endif; //catchbase_single_content_image
add_action( 'catchbase_before_post_container', 'catchbase_single_content_image', 10 );
add_action( 'catchbase_before_page_container', 'catchbase_single_content_image', 10 );


if ( ! function_exists( 'catchbase_get_comment_section' ) ) :
	/**
	 * Comment Section
	 *
	 * @get comment setting from theme options and display comments sections accordingly
	 * @display comments_template
	 * @action catchbase_comment_section
	 *
	 * @since Catch Base 1.0
	 */
	function catchbase_get_comment_section() {
		$options 			= catchbase_get_theme_options();

		$comment_select 	= isset ( $options['comment_option']  ) ? $options['comment_option']: '';

		if ( $comment_select == 'use-wordpress-setting' ) {
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
		}
		else if ( $comment_select == 'disable-in-pages' ) {
			if( ! is_page() )
				if ( comments_open() || '0' != get_comments_number() )
				comments_template();
		}
}
endif;
add_action( 'catchbase_comment_section', 'catchbase_get_comment_section', 10 );


if ( ! function_exists( 'catchbase_promotion_headline' ) ) :
	/**
	 * Template for Promotion Headline
	 *
	 * To override this in a child theme
	 * simply create your own catchbase_promotion_headline(), and that function will be used instead.
	 *
	 * @uses catchbase_before_main action to add it in the header
	 * @since Catch Base 1.0
	 */
	function catchbase_promotion_headline() { 
		//delete_transient( 'catchbase_promotion_headline' );
		
		global $post, $wp_query;
	   	$options 	= catchbase_get_theme_options();

		$promotion_headline 		= $options['promotion_headline'];
		$promotion_subheadline 		= $options['promotion_subheadline'];
		$promotion_headline_button 	= $options['promotion_headline_button'];
		$promotion_headline_target 	= $options['promotion_headline_target'];
		$enablepromotion 			= $options['promotion_headline_option'];
		
		//support qTranslate plugin
		if ( function_exists( 'qtrans_convertURL' ) ) {
			$promotion_headline_url = qtrans_convertURL($options[ 'promotion_headline_url' ]);
		}
		else {
			$promotion_headline_url = $options[ 'promotion_headline_url' ];
		}
		
		// Front page displays in Reading Settings
		$page_on_front = get_option( 'page_on_front' ) ;
		$page_for_posts = get_option('page_for_posts'); 

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		 if ( ( "" != $promotion_headline || "" != $promotion_subheadline || "" != $promotion_headline_url ) && ( $enablepromotion == 'entire-site' || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && $enablepromotion == 'homepage' ) ) ) { 	
			
			if ( !$catchbase_promotion_headline = get_transient( 'catchbase_promotion_headline' ) ) {
				
				echo '<!-- refreshing cache -->';	
				
				$catchbase_promotion_headline = '
				<div id="promotion-message">
					<div class="wrapper">
						<div class="section left">';
				
						if ( "" != $promotion_headline ) {
							$catchbase_promotion_headline .= '<h2>' . $promotion_headline . '</h2>';
						}

						if ( "" != $promotion_subheadline ) {
							$catchbase_promotion_headline .= '<p>' . $promotion_subheadline . '</p>';
						}			
						
						$catchbase_promotion_headline .= '
						</div><!-- .section.left -->';  
							
						if ( "" != $promotion_headline_url ) {
							if ( "1" == $promotion_headline_target ) {
								$headlinetarget = '_blank';
							}
							else {
								$headlinetarget = '_self';
							}
							
							$catchbase_promotion_headline .= '
							<div class="section right">
								<a href="' . esc_url( $promotion_headline_url ) . '" target="' . $headlinetarget . '">' . esc_attr( $promotion_headline_button ) . '
								</a>
							</div><!-- .section.right -->';
						}
				
				$catchbase_promotion_headline .= '
					</div><!-- .wrapper -->
				</div><!-- #promotion-message -->';
				
				set_transient( 'catchbase_promotion_headline', $catchbase_promotion_headline, 86940 );
			}
			echo $catchbase_promotion_headline;	
		 }
	}
endif; // catchbase_promotion_featured_content
add_action( 'catchbase_before_content', 'catchbase_promotion_headline', 30 );


/**
 * Footer Text
 *
 * @get footer text from theme options and display them accordingly
 * @display footer_text
 * @action catchbase_footer
 *
 * @since Catch Base 1.0
 */
function catchbase_footer_content() {
	//catchbase_flush_transients();
	if ( ( !$catchbase_footer_content = get_transient( 'catchbase_footer_content' ) ) ) {
		echo '<!-- refreshing cache -->';
		
		// get the data value from theme options
		$options	= catchbase_get_theme_options();

		$defaults 	= catchbase_get_default_theme_options();

		$search = array( '[the-year]', '[site-link]' );

        $replace = array( date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );
		
        $options['footer_left_content'] = str_replace( $search, $replace, $options['footer_left_content'] );

		if ( ! $options['reset_footer_content'] ) {
			$footer_left_content 	= isset ( $options['footer_left_content']  ) ? $options['footer_left_content']: '';

			$footer_right_content	= isset ( $options['footer_right_content']  ) ? $options['footer_right_content']: '';
		}	
		else {
			$footer_left_content 	= $defaults['footer_left_content'];

			$footer_right_content	= $defaults['footer_right_content'];
		}

		
		if ( empty( $footer_left_content ) &&  empty( $footer_right_content )) {
			return false;
		}
		else {
			if ( !empty( $footer_left_content ) && !empty( $footer_right_content ) ){
	    		$class = "two";
	    	}
	    	else {
	    		$class = "one";
	    	}

	    	$catchbase_footer_content .=  '
	    	<div id="site-generator" class="'. $class . '">
	    		<div class="wrapper">';
	    	
	    	if ( !empty( $footer_left_content ) ) {
				$catchbase_footer_content .= '<div id="footer-left-content" class="copyright">' . $footer_left_content . '</div>';
			}

			if ( !empty( $footer_right_content ) ) {
				$catchbase_footer_content .= '<div id="footer-right-content" class="powered">' . $footer_right_content . '</div>';
			}

			$catchbase_footer_content .=  '
				</div><!-- .wrapper -->
			</div><!-- #site-generator -->';
			
	    	set_transient( 'catchbase_footer_content', $catchbase_footer_content, 86940 );
	    }
    }

    echo $catchbase_footer_content;
}
add_action( 'catchbase_footer', 'catchbase_footer_content', 100 );


/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @return [string] image html
 *
 * @since Catch Base 1.0
 */

function catchbase_get_first_image( $postID, $size, $attr ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field('post_content', $postID ) , $matches);

	if( isset( $matches [1] [0] ) ) {
		//Get first image
		$first_img = $matches [1] [0];
		
		return '<img class="pngfix wp-post-image" src="'. $first_img .'">';
	}
	
	return false;
}


if ( ! function_exists( 'catchbase_scrollup' ) ) {
	/**
	 * This function loads Scroll Up Navigation
	 *
	 * @action catchbase_footer action
	 * @uses set_transient and delete_transient
	 */
	function catchbase_scrollup() {
		//catchbase_flush_transients();
		if ( !$catchbase_scrollup = get_transient( 'catchbase_scrollup' ) ) {

			// get the data value from theme options
			$options = catchbase_get_theme_options();
			echo '<!-- refreshing cache -->';	
			
			//site stats, analytics header code
			if ( ! $options['disable_scrollup'] ) {
				$catchbase_scrollup =  '<a href="#masthead" id="scrollup" class="genericon"><span class="screen-reader-text">' . __( 'Scroll Up', 'catch-base' ) . '</span></a>' ;
			}
				
			set_transient( 'catchbase_scrollup', $catchbase_scrollup, 86940 );
		}
		echo $catchbase_scrollup;	
	}
}
add_action( 'catchbase_after', 'catchbase_scrollup', 10 );


if ( ! function_exists( 'catchbase_comment_defaults' ) ) :
	/**
	 * Modify Comment Form Defaults
	 *
	 * @uses comment_form_defaults filter 
	 * @since Catch Base 1.0
	 */
	function catchbase_comment_defaults( $defaults ) {
		// get data value from theme options
	    $options = catchbase_get_theme_options();
		$disablenote = $options[ 'disable_notes' ];
	 
	 	if ( $disablenote == '1' ) :
			$defaults['comment_notes_after'] = '';
		endif;
		
		return $defaults;
	}
endif; //catchbase_comment_defaults
add_filter( 'comment_form_defaults', 'catchbase_comment_defaults' );


if ( ! function_exists( 'catchbase_comment_form_fields' ) ) :
	/**
	 * Modify Comment Form Fields
	 *
	 * @uses comment_form_default_fields filter
	 * @since Catch Base 1.0 
	 */
	function catchbase_comment_form_fields( $fields ) {
		// get data value from theme options
		$options = catchbase_get_theme_options();
		$disableurl = $options[ 'disable_website_field' ];
		
		if ( isset( $fields['url'] ) && $disableurl == '1' ) {
			unset( $fields['url'] );
		}

		return $fields;

	}
endif; //catchbase_comment_form_fields
add_filter( 'comment_form_default_fields', 'catchbase_comment_form_fields' );


if ( ! function_exists( 'catchbase_page_post_meta' ) ) :
	/**
	 * Post/Page Meta for Google Structure Data
	 */
	function catchbase_page_post_meta() {
		$catchbase_author_url = esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) );
		
		$catchbase_page_post_meta = '<span class="post-time">' . __( 'Posted on', 'catch-base' ) . ' <time class="entry-date updated" datetime="' . esc_attr( get_the_date( 'c' ) ) . '" pubdate>' . esc_html( get_the_date() ) . '</time></span>';
	    $catchbase_page_post_meta .= '<span class="post-author">' . __( 'By', 'catch-base' ) . ' <span class="author vcard"><a class="url fn n" href="' . $catchbase_author_url . '" title="View all posts by ' . get_the_author() . '" rel="author">' .get_the_author() . '</a></span>';

		return $catchbase_page_post_meta;
	}
endif; //catchbase_page_post_meta


if ( ! function_exists( 'catchbase_truncate_phrase' ) ) :
	/**
	 * Return a phrase shortened in length to a maximum number of characters.
	 *
	 * Result will be truncated at the last white space in the original string. In this function the word separator is a
	 * single space. Other white space characters (like newlines and tabs) are ignored.
	 *
	 * If the first `$max_characters` of the string does not contain a space character, an empty string will be returned.
	 *
	 * @since 2.4.1
	 *
	 * @param string $text            A string to be shortened.
	 * @param integer $max_characters The maximum number of characters to return.
	 *
	 * @return string Truncated string
	 */
	function catchbase_truncate_phrase( $text, $max_characters ) {

		$text = trim( $text );

		if ( mb_strlen( $text ) > $max_characters ) {
			//* Truncate $text to $max_characters + 1
			$text = mb_substr( $text, 0, $max_characters + 1 );

			//* Truncate to the last space in the truncated string
			$text = trim( mb_substr( $text, 0, mb_strrpos( $text, ' ' ) ) );
		}

		return $text;
	}
endif; //catchbase_truncate_phrase


if ( ! function_exists( 'catchbase_get_the_content_limit' ) ) :
	/**
	 * Return content stripped down and limited content.
	 *
	 * Strips out tags and shortcodes, limits the output to `$max_char` characters, and appends an ellipsis and more link to the end.
	 *
	 * @since 2.4.1
	 *
	 * @param integer $max_characters The maximum number of characters to return.
	 * @param string  $more_link_text Optional. Text of the more link. Default is "(more...)".
	 * @param bool    $stripteaser    Optional. Strip teaser content before the more text. Default is false.
	 *
	 * @return string Limited content.
	 */
	function catchbase_get_the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {

		$content = get_the_content( '', $stripteaser );

		//* Strip tags and shortcodes so the content truncation count is done correctly
		$content = strip_tags( strip_shortcodes( $content ), apply_filters( 'get_the_content_limit_allowedtags', '<script>,<style>' ) );

		//* Remove inline styles / scripts
		$content = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $content ) );

		//* Truncate $content to $max_char
		$content = catchbase_truncate_phrase( $content, $max_characters );

		//* More link?
		if ( $more_link_text ) {
			$link   = apply_filters( 'get_the_content_more_link', sprintf( '<a href="%s" class="more-link">%s</a>', get_permalink(), $more_link_text ), $more_link_text );
			$output = sprintf( '<p>%s %s</p>', $content, $link );
		} else {
			$output = sprintf( '<p>%s</p>', $content );
			$link = '';
		}

		return apply_filters( 'catchbase_get_the_content_limit', $output, $content, $link, $max_characters );

	}
endif; //catchbase_get_the_content_limit


if ( ! function_exists( 'catchbase_post_navigation' ) ) :
	/**
	 * Displays Single post Navigation
	 *
	 * @uses  the_post_navigation
	 *
	 * @action catchbase_after_post
	 * 
	 * @since Catch Base 3.1
	 */
	function catchbase_post_navigation() {
		$options	= catchbase_get_theme_options();

		$disable_single_post_navigation = isset($options['disable_single_post_navigation']) ? $options['disable_single_post_navigation'] : 0;

		if ( !$disable_single_post_navigation ) {
			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next &rarr;', 'catch-base' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'catch-base' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( '&larr; Previous', 'catch-base' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'catch-base' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );
		}
	}
endif; //catchbase_post_navigation
add_action( 'catchbase_after_post', 'catchbase_post_navigation', 10 );


/**
 * Add Support for WooCommerce Plugin
 */	
if ( class_exists( 'woocommerce' ) ) { 
	add_theme_support( 'woocommerce' );			
    require get_template_directory() . '/inc/catchbase-woocommerce.php';
}


/**
 * Add Support for mqTranslate and qTranslate Plugin
 */	
if ( in_array( 'qtranslate/qtranslate.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ||
in_array( 'mqtranslate/mqtranslate.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { 
	require get_template_directory() . '/inc/catchbase-qtranslate.php';
}


/**
 * Add Support for WPML, qTranslate X & Polylang Plugin
 */	
if ( defined( 'ICL_SITEPRESS_VERSION' ) || defined( 'QTX_VERSION' ) || class_exists( 'Polylang' ) ) {
	require get_template_directory() . '/inc/catchbase-wpml.php';
}