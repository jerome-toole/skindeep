<?php
/**
 * The main template for implementing Theme/Customzer Options
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
 * Implements Catchbase theme options into Theme Customizer.
 *
 * @param $wp_customize Theme Customizer object
 * @return void
 *
 * @since Catch Base 1.0
 */
function catchbase_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport			= 'postMessage';

	/**
	  * Set priority of blogname (Site Title) to 1. 
	  *  Strangly, if more than two options is added, Site title is moved below Tagline. This rectifies this issue.
	  */
	$wp_customize->get_control( 'blogname' )->priority			= 1;

	$wp_customize->get_setting( 'blogdescription' )->transport	= 'postMessage';

	$options  = catchbase_get_theme_options();

	$defaults = catchbase_get_default_theme_options();

	//Custom Controls
	require get_template_directory() . '/inc/customizer-includes/catchbase-customizer-custom-controls.php';

	// Custom Logo (added to Site Title and Tagline section in Theme Customizer)
	$wp_customize->add_setting( 'catchbase_theme_options[logo]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['logo'],
		'sanitize_callback'	=> 'catchbase_sanitize_image'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
		'label'		=> __( 'Logo', 'catch-base' ),
		'priority'	=> 100,
		'section'   => 'title_tagline',
        'settings'  => 'catchbase_theme_options[logo]',
    ) ) );

    $wp_customize->add_setting( 'catchbase_theme_options[logo_disable]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['logo_disable'],
		'sanitize_callback' => 'catchbase_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'catchbase_theme_options[logo_disable]', array(
		'label'    => __( 'Check to disable logo', 'catch-base' ),
		'priority' => 101,
		'section'  => 'title_tagline',
		'settings' => 'catchbase_theme_options[logo_disable]',
		'type'     => 'checkbox',
	) );
	
	$wp_customize->add_setting( 'catchbase_theme_options[logo_alt_text]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['logo_alt_text'],
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'catchbase_logo_alt_text', array(
		'label'    	=> __( 'Logo Alt Text', 'catch-base' ),
		'priority'	=> 102,
		'section' 	=> 'title_tagline',
		'settings' 	=> 'catchbase_theme_options[logo_alt_text]',
		'type'     	=> 'text',
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[move_title_tagline]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['move_title_tagline'],
		'sanitize_callback' => 'catchbase_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'catchbase_theme_options[move_title_tagline]', array(
		'label'    => __( 'Check to move Site Title and Tagline before logo', 'catch-base' ),
		'priority' => 103,
		'section'  => 'title_tagline',
		'settings' => 'catchbase_theme_options[move_title_tagline]',
		'type'     => 'checkbox',
	) );
	// Custom Logo End

	// Header Options (added to Header section in Theme Customizer)
	require get_template_directory() . '/inc/customizer-includes/catchbase-customizer-header-options.php';


   	//Additional Menu Options   	
   	$wp_customize->add_section( 'catchbase_menu_options', array(
		'description'	=> __( 'Extra Menu Options specific to this theme', 'catch-base' ),
		'priority' 		=> 105,
		'title'    		=> __( 'Menu Options', 'catch-base' ),
	) );
	
	$wp_customize->add_setting( 'catchbase_theme_options[primary_menu_disable]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['primary_menu_disable'],
		'sanitize_callback' => 'catchbase_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'catchbase_theme_options[primary_menu_disable]', array(
		'label'    => __( 'Check to disable Primary Menu', 'catch-base' ),
		'section'  => 'catchbase_menu_options',
		'settings' => 'catchbase_theme_options[primary_menu_disable]',
		'type'     => 'checkbox',
	) );

   	$wp_customize->add_setting( 'catchbase_theme_options[primary_search_disable]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['primary_search_disable'],
		'sanitize_callback' => 'catchbase_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'catchbase_theme_options[primary_search_disable]', array(
		'label'    => __( 'Check to disable search box in Primary Menu', 'catch-base' ),
		'section'  => 'catchbase_menu_options',
		'settings' => 'catchbase_theme_options[primary_search_disable]',
		'type'     => 'checkbox',
	) );

	//Theme Options
	require get_template_directory() . '/inc/customizer-includes/catchbase-customizer-theme-options.php';

	// Color Options
	// Moved from Default Color Control to Catbase Color Options
   	$wp_customize->get_control( 'background_color' )->section			= 'catchbase_color_scheme';
	$wp_customize->get_control( 'header_textcolor' )->section			= 'catchbase_header_color_options';
	
   	require get_template_directory() . '/inc/customizer-includes/catchbase-customizer-color-options.php';
	
	//Featured Content Setting
	require get_template_directory() . '/inc/customizer-includes/catchbase-customizer-featured-content-setting.php';
   	
	//Featured Slider
	require get_template_directory() . '/inc/customizer-includes/catchbase-customizer-featured-slider.php';

	//Social Links
	require get_template_directory() . '/inc/customizer-includes/catchbase-customizer-social-icons.php';
	
	// Reset all settings to default
	$wp_customize->add_section( 'catchbase_reset_all_settings', array(
		'description'	=> __( 'Caution: Reset all settings to default. Refresh the page after save to view full effects.', 'catch-base' ),
		'priority' 		=> 700,
		'title'    		=> __( 'Reset all settings', 'catch-base' ),
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[reset_all_settings]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['reset_all_settings'],
		'sanitize_callback' => 'catchbase_reset_all_settings',
		'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control( 'catchbase_theme_options[reset_all_settings]', array(
		'label'    => __( 'Check to reset all settings to default', 'catch-base' ),
		'section'  => 'catchbase_reset_all_settings',
		'settings' => 'catchbase_theme_options[reset_all_settings]',
		'type'     => 'checkbox',
	) );
	// Reset all settings to default end


	//Important Links
		$wp_customize->add_section( 'important_links', array(
			'priority' 		=> 999,
			'title'   	 	=> __( 'Important Links', 'catch-base' ),
		) );

		/**
		 * Has dummy Sanitizaition function as it contains no value to be sanitized
		 */
		$wp_customize->add_setting( 'important_links', array(
			'sanitize_callback'	=> 'catchbase_sanitize_important_link',
		) );

		$wp_customize->add_control( new Catchbase_Important_Links( $wp_customize, 'important_links', array(
	        'label'   	=> __( 'Important Links', 'catch-base' ),
	         'section'  	=> 'important_links',
	        'settings' 	=> 'important_links',
	        'type'     	=> 'important_links',
	    ) ) );  
	    //Important Links End
}
add_action( 'customize_register', 'catchbase_customize_register' );


/**
 * Sanitizes Checkboxes
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Base 1.0
 */
function catchbase_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } 
    else {
        return '';
    }
}


/**
 * Sanitizes Custom CSS 
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Base 1.0
 */
function catchbase_sanitize_custom_css( $input ) {
	if ( $input != '' ) { 
        $input = str_replace( '<=', '&lt;=', $input ); 
        
        $input = wp_kses_split( $input, array(), array() ); 
        
        $input = str_replace( '&gt;', '>', $input ); 
        
        $input = strip_tags( $input ); 

        return $input;
 	}
    else {
    	return '';
    }
}

/**
 * Sanitizes images uploaded
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Base 1.0
 */
function catchbase_sanitize_image( $input ) {
	return esc_url_raw( $input );
}

/**
 * Sanitizes post_id in slider
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Base 1.0
 */
function catchbase_sanitize_post_id( $input ) {
    //check if post exists
	if( get_post_status( $input ) ) {
		return $input;
    }
    else {
    	return '';
    }
}


/**
 * Sanitizes page in slider
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Base 1.0
 */
function catchbase_sanitize_page( $input ) {
	if(  get_post( $input ) ){
		return $input;
	}
    else {
    	return '';
    }
}


/**
 * Sanitizes category list in slider
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Base 1.0
 */
function catchbase_sanitize_category_list( $input ) {
	if ( $input != '' ) { 
		$args = array(
						'type'			=> 'post',
						'child_of'      => 0,
						'parent'        => '',
						'orderby'       => 'name',
						'order'         => 'ASC',
						'hide_empty'    => 0,
						'hierarchical'  => 0,
						'taxonomy'      => 'category',
					); 
		
		$categories = ( get_categories( $args ) );

		$category_list 	=	array();
		
		foreach ( $categories as $category )
			$category_list 	=	array_merge( $category_list, array( $category->term_id ) );

		if ( count( array_intersect( $input, $category_list ) ) == count( $input ) ) {
	    	return $input;
	    } 
	    else {
    		return '';
   		}
    }
    else {
    	return '';
    }
}


/**
 * Sanitizes slider number
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Base 1.0
 */
function catchbase_sanitize_no_of_slider( $input ) {
	if ( absint( $input ) > 20 ) {
    	return 20;
    } 
    else {
    	return absint( $input );
    }
}

/**
 * Sanitizes custom social icons number
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Base 1.0
 */
function catchbase_sanitize_no_of_social_icons( $input ) {
	if ( absint( $input ) > 10 ) {
    	return 10;
    } 
    else {
    	return absint( $input );
    }
}


/**
 * Sanitizes footer code
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Base 1.0
 */
function catchbase_sanitize_footer_code( $input ) {
	return ( stripslashes( wp_filter_post_kses( addslashes ( $input ) ) ) );
}


/**
 * Sanitizes feature slider transition effects
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Base 1.0
 */
function catchbase_sanitize_featured_slide_transition_effects( $input ) {
	$catchbase_featured_slide_transition_effects = array_keys( catchbase_featured_slide_transition_effects() );
	
	if ( in_array( $input, $catchbase_featured_slide_transition_effects ) ) {
		return $input;
	}
	else {
		$defaults = catchbase_get_default_theme_options();

		return $defaults['featured_slide_transition_effect'];
	}
}


/**
 * Sanitizes and Make options default for font family options
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Base 1.0
 */
function catchbase_reset_typography( $input ) {
    if ( $input == 1 ) {
    	//Reset Font Family Options
        $options 	= catchbase_get_theme_options();
        $defaults 	= catchbase_get_default_theme_options();

        $font_family_options	=	array(
										'title_font',
										'body_font',
										'tagline_font',
										'content_title_font',
										'content_font',
										'headings_font'
									);

		foreach ( $font_family_options as $font_family_option ) {
			$options[ $font_family_option ] = $defaults[ $font_family_option ];
		}

        set_theme_mod( 'catchbase_theme_options', $options );
    }

    return '';
}


/**
 * Sanitizes and Make options default for footer editor options
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Base 1.0
 */
function catchbase_sanitize_footer_content( $input ) {
    if ( $input == '1' ) {
    	//Reset Footer Editor Options
        $options 	= catchbase_get_theme_options();
        $defaults 	= catchbase_get_default_theme_options();
        
        $options[ 'footer_left_content' ] = $defaults[ 'footer_left_content' ];
		$options[ 'footer_right_content' ] = $defaults[ 'footer_right_content' ];

        set_theme_mod( 'catchbase_theme_options', $options );
    }

    return '';
}


/**
 * Reset all settings to default
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Base 1.0
 */
function catchbase_reset_all_settings( $input ) {
	if ( $input == 1 ) {
        // Set default values
        set_theme_mod( 'catchbase_theme_options', catchbase_get_default_theme_options() );
       
        // Flush out all transients	
        catchbase_flush_transients();
    } 
    else {
        return '';
    }
}


/**
 * Dummy Sanitizaition function as it contains no value to be sanitized
 *
 * @since Catch Base 1.1
 */
function create_sanitize_important_link() {
	return false;
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously for catchbase.
 * And flushes out all transient data on preview
 *
 * @since Catch Base 1.0
 */
function catchbase_customize_preview() {
	wp_enqueue_script( 'catchbase_customizer', get_template_directory_uri() . '/js/catchbase-customizer.min.js', array( 'customize-preview' ), '20120827', true );
	
	//Flush transients
	catchbase_flush_transients();
}
add_action( 'customize_preview_init', 'catchbase_customize_preview' );


/**
 * Custom scripts and styles on customize.php for catchbase.
 *
 * @since Catch Base Pro 1.0
 */
function catchbase_customize_scripts() {
	wp_register_script( 'catchbase_customizer_custom', get_template_directory_uri() . '/js/catchbase-customizer-custom-scripts.min.js', array( 'jquery' ), '20150630', true );

	// Send list of color variables as object to custom customizer js
	wp_localize_script( 'catchbase_customizer_custom', 'catchbase_color_list', catchbase_color_list() );

	wp_enqueue_script( 'catchbase_customizer_custom' );

	wp_enqueue_style( 'catchbase_customizer_custom', get_template_directory_uri() . '/css/catchbase-customizer.css');
}
add_action( 'customize_controls_print_footer_scripts', 'catchbase_customize_scripts');


/**
 * Returns list of color keys of array with default values for each color scheme as index
 *
 * @since Catch Base Pro 3.0.2
 */
function catchbase_color_list() {
	// Get default color scheme values
	$default 		= catchbase_get_default_theme_options();
	// Get default dark color scheme valies
	$default_dark 	= catchbase_default_dark_color_options();

	// Get coloy keys for menu
	$catchbase_menu_color_option = catchbase_get_menu_color_options();

	// Get coloy keys for all other options except menu
	$catchbase_get_color_list = array_merge( 
									catchbase_get_basic_color_options(), 
									catchbase_get_header_color_options(),
									catchbase_get_content_color_options(),
									catchbase_get_sidebar_color_options(),
									catchbase_get_pagination_color_options(),
									catchbase_get_footer_color_options(),
									catchbase_get_promotion_headline_color_options(),
									catchbase_get_scrollup_color_options(),
									catchbase_get_slider_color_options(),
									catchbase_get_featured_content_color_options(),
									$catchbase_menu_color_option // Primary Menu Color Options
									);

	// Set light and dark color keys with default values for each color scheme as index
	foreach( $catchbase_get_color_list as $color_option ) {
		$lower_color_option = str_replace( array( ' ', '/', '-') ,  '_', strtolower( $color_option ) );
		
		$catchbase_color_list[ $lower_color_option ]['light'] 	= $default[ $lower_color_option ];
		$catchbase_color_list[ $lower_color_option ]['dark'] 	= $default_dark[ $lower_color_option ];
	}

	//Add Secondary Menu Color Options
	foreach( $catchbase_menu_color_option as $color_option ) {
		$lower_color_option	=	'secondary_' . str_replace( ' ', '_', strtolower( $color_option ) );
		
		$catchbase_color_list[ $lower_color_option ]['light'] 	= $default[ $lower_color_option ];
		$catchbase_color_list[ $lower_color_option ]['dark'] 	= $default_dark[ $lower_color_option ];

		//Add Header Right Menu Color Options
		$lower_color_option	=	'header_right_' . str_replace( ' ', '_', strtolower( $color_option ) );
		
		$catchbase_color_list[ $lower_color_option ]['light'] 	= $default[ $lower_color_option ];
		$catchbase_color_list[ $lower_color_option ]['dark'] 	= $default_dark[ $lower_color_option ];
		
		//Add Footer Menu Color Options
		$lower_color_option	=	'footer_' . str_replace( ' ', '_', strtolower( $color_option ) );

		$catchbase_color_list[ $lower_color_option ]['light'] 	= $default[ $lower_color_option ];
		$catchbase_color_list[ $lower_color_option ]['dark'] 	= $default_dark[ $lower_color_option ];
	}

	return $catchbase_color_list;
}

function catchbase_sanitize_css_length( $input ) {
    $return_value = catchbase_get_default_theme_options()['featured_header_image_width'];
    // Split into value and units
    if (preg_match('/(\d+)([\w]+|%)/', $input, $matches)) {
        $value = $matches[1];
        $unit = $matches[2];
        switch ($unit) {
            case '%':
            case 'cm':
            case 'em':
            case 'ex':
            case 'in':
            case 'mm':
            case 'pc':
            case 'pt':
            case 'px':
            case 'vh':
            case 'vw':
            case 'vmin':
                // Valid unit
                if (is_numeric($value))
                {
                    $return_value = $value . $unit;
                }
                break;

            default:
                break;

        }
    }
    return $return_value;
}