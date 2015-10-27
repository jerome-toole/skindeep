<?php
/**
 * The template for adding color options in Customizer
 *
 * @package Catchbase
 * @subpackage Catchbase Pro
 * @since Catch Base 1.0
 */

 if ( ! defined( 'CATCHBASE_THEME_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}
  	//Basic Color Options
  	$wp_customize->add_panel( 'catchbase_color_options', array(
	    'capability'     => 'edit_theme_options',
	    'description'    => __( 'Color Options', 'catch-base' ),
	    'priority'       => 300,			
	    'title'    		 => __( 'Color Options', 'catch-base' ),
	) );

	$wp_customize->add_section( 'catchbase_color_scheme', array(
		'panel'	   => 'catchbase_color_options',
		'priority' => 301,
		'title'    => __( 'Basic Color Options', 'catch-base' ),
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[color_scheme]', array(
		'capability' 		=> 'edit_theme_options',
		'default'    		=> $defaults['color_scheme'],
		'sanitize_callback'	=> 'sanitize_key'
	) );

	$schemes = catchbase_color_schemes();

	$choices = array();

	foreach ( $schemes as $scheme ) {
		$choices[ $scheme['value'] ] = $scheme['label'];
	}

	$wp_customize->add_control( 'catchbase_theme_options[color_scheme]', array(
		'choices'  => $choices,
		'label'    => __( 'Color Scheme', 'catch-base' ),
		'priority' => 5,
		'section'  => 'catchbase_color_scheme',
		'settings' => 'catchbase_theme_options[color_scheme]',
		'type'     => 'radio',
	) );

	$catchbase_basic_color_options	=	catchbase_get_basic_color_options();

	$i = 10;
	foreach ( $catchbase_basic_color_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( 'catchbase_theme_options['. $lower_color_option .']', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'catchbase_theme_options['. $lower_color_option .']', array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'catchbase_color_scheme',
			'settings'	=> 'catchbase_theme_options['. $lower_color_option .']',
		) ) );

		$i++;
	}

	//Header Color Option
	$wp_customize->add_section( 'catchbase_header_color_options', array(
		'panel'	   => 'catchbase_color_options',
		'priority' => 302,
		'title'    => __( 'Header Color Options', 'catch-base' ),
	) );

	$catchbase_header_color_options	=	catchbase_get_header_color_options();

	$i = 10;
	foreach ( $catchbase_header_color_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( 'catchbase_theme_options['. $lower_color_option .']', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'catchbase_theme_options['. $lower_color_option .']', array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'catchbase_header_color_options',
			'settings'	=> 'catchbase_theme_options['. $lower_color_option .']',
		) ) );

		$i++;
	}

	//Content Color Option
	$wp_customize->add_section( 'catchbase_content_color_options', array(
		'panel'	   => 'catchbase_color_options',
		'priority' => 303,
		'title'    => __( 'Content Color Options', 'catch-base' ),
	) );

	$catchbase_content_color_options	=	catchbase_get_content_color_options();

	$i = 10;
	foreach ( $catchbase_content_color_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( 'catchbase_theme_options['. $lower_color_option .']', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'catchbase_theme_options['. $lower_color_option .']', array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'catchbase_content_color_options',
			'settings'	=> 'catchbase_theme_options['. $lower_color_option .']',
		) ) );

		$i++;
	}

	//Sidebar Color Option
	$wp_customize->add_section( 'catchbase_sidebar_color_options', array(
		'description'	=> __( 'Only for Primary and Secondary Sidebars', 'catch-base' ),
		'panel'	   		=> 'catchbase_color_options',
		'priority' 		=> 304,
		'title'    		=> __( 'Sidebar Color Options', 'catch-base' ),
	) );

	$catchbase_sidebar_color_options	=	catchbase_get_sidebar_color_options();

	$i = 1;
	foreach ( $catchbase_sidebar_color_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( 'catchbase_theme_options['. $lower_color_option .']', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'catchbase_theme_options['. $lower_color_option .']', array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'catchbase_sidebar_color_options',
			'settings'	=> 'catchbase_theme_options['. $lower_color_option .']',
		) ) );

		$i++;
	}

	//Pagination Color Option
	$wp_customize->add_section( 'catchbase_pagination_color_options', array(
		'panel'	   		=> 'catchbase_color_options',
		'priority' 		=> 305,
		'title'    		=> __( 'Pagination Color Options', 'catch-base' ),
	) );

	$catchbase_pagination_color_options	=	catchbase_get_pagination_color_options();

	$i = 1;
	foreach ( $catchbase_pagination_color_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );
		
		$lower_color_option	=	str_replace( '/', '_', $lower_color_option );

		$lower_color_option	=	str_replace( '-', '_', $lower_color_option );
		
		$wp_customize->add_setting( 'catchbase_theme_options['. $lower_color_option .']', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'catchbase_theme_options['. $lower_color_option .']', array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'catchbase_pagination_color_options',
			'settings'	=> 'catchbase_theme_options['. $lower_color_option .']',
		) ) );

		$i++;
	}

	//Footer Color Option
	$wp_customize->add_section( 'catchbase_footer_color_options', array(
		'panel'	   => 'catchbase_color_options',
		'priority' => 306,
		'title'    => __( 'Footer Color Options', 'catch-base' ),
	) );

	$catchbase_footer_color_options	=	catchbase_get_footer_color_options();

	$i = 1;
	foreach ( $catchbase_footer_color_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( 'catchbase_theme_options['. $lower_color_option .']', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'catchbase_theme_options['. $lower_color_option .']', array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'catchbase_footer_color_options',
			'settings'	=> 'catchbase_theme_options['. $lower_color_option .']',
		) ) );

		$i++;
	}

	//Promotion Headline Color Option
	$wp_customize->add_section( 'catchbase_promotion_headline_color_options', array(
		'panel'	   => 'catchbase_color_options',
		'priority' => 307,
		'title'    => __( 'Promotion Headline Color Options', 'catch-base' ),
	) );

	$catchbase_promotion_headline_options	=	catchbase_get_promotion_headline_color_options();

	$i = 1;
	foreach ( $catchbase_promotion_headline_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( 'catchbase_theme_options['. $lower_color_option .']', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',			
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'catchbase_theme_options['. $lower_color_option .']', array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'catchbase_promotion_headline_color_options',
			'settings'	=> 'catchbase_theme_options['. $lower_color_option .']',
		) ) );

		$i++;
	}

	//Scrollup Color Option
	$wp_customize->add_section( 'catchbase_scrollup_color_options', array(
		'panel'	   => 'catchbase_color_options',
		'priority' => 308,
		'title'    => __( 'Scrollup Color Options', 'catch-base' ),
	) );

	$catchbase_scrollup_options	=	catchbase_get_scrollup_color_options();

	$i = 1;
	foreach ( $catchbase_scrollup_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( 'catchbase_theme_options['. $lower_color_option .']', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',			
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'catchbase_theme_options['. $lower_color_option .']', array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'catchbase_scrollup_color_options',
			'settings'	=> 'catchbase_theme_options['. $lower_color_option .']',
		) ) );

		$i++;
	}

	//Slider Color Option
	$wp_customize->add_section( 'catchbase_slider_color_options', array(
		'panel'	   => 'catchbase_color_options',
		'priority' => 309,
		'title'    => __( 'Slider Color Options', 'catch-base' ),
	) );

	$catchbase_slider_options	=	catchbase_get_slider_color_options();

	$i = 1;
	foreach ( $catchbase_slider_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( 'catchbase_theme_options['. $lower_color_option .']', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'catchbase_theme_options['. $lower_color_option .']', array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'catchbase_slider_color_options',
			'settings'	=> 'catchbase_theme_options['. $lower_color_option .']',
		) ) );

		$i++;
	}

	//Featured Content Color Options
	$wp_customize->add_section( 'catchbase_featured_content_color_options', array(
		'panel'	   => 'catchbase_color_options',
		'priority' => 310,
		'title'    => __( 'Featured Content Color Options', 'catch-base' ),
	) );

	$catchbase_featured_content_options	=	catchbase_get_featured_content_color_options();

	$i = 1;
	foreach ( $catchbase_featured_content_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( 'catchbase_theme_options['. $lower_color_option .']', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'catchbase_theme_options['. $lower_color_option .']', array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'catchbase_featured_content_color_options',
			'settings'	=> 'catchbase_theme_options['. $lower_color_option .']',
		) ) );

		$i++;
	}

	//Menu Color Options
	$wp_customize->add_section( 'catchbase_primary_menu_color_options', array(
		'panel'	   => 'catchbase_color_options',
		'title'    => __( 'Primary Menu Color Options', 'catch-base' ),
		'priority' => 351,
	) );
	
	$catchbase_menu_color_options	=	catchbase_get_menu_color_options();

	$i = 1;
	
	foreach ( $catchbase_menu_color_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( 'catchbase_theme_options['. $lower_color_option .']', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		if ( 'hover_active_color' == $lower_color_option ) {
			$color_option = __(  'Hover Active Background Color', 'catch-base' );	
		}

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'catchbase_theme_options['. $lower_color_option .']', array(
			'label'		=> $color_option,
			'priority'	=> $i++,
			'section'	=> 'catchbase_primary_menu_color_options',
			'settings'	=> 'catchbase_theme_options['. $lower_color_option .']',
		) ) );
	}

	$wp_customize->add_section( 'catchbase_secondary_menu_color_options', array(
		'panel'	   => 'catchbase_color_options',
		'priority' => 352,
		'title'    => __( 'Secondary Menu Color Options', 'catch-base' ),
	) );

	foreach ( $catchbase_menu_color_options as $color_option ) {
		$lower_color_option	=	'secondary_' . str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( 'catchbase_theme_options['. $lower_color_option .']', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		if ( 'secondary_hover_active_color' == $lower_color_option ) {
			$color_option = __(  'Hover Active Background Color', 'catch-base' );	
		}

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'catchbase_theme_options['. $lower_color_option .']', array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'catchbase_secondary_menu_color_options',
			'settings'	=> 'catchbase_theme_options['. $lower_color_option .']',
		) ) );

		$i++;
	}


	$wp_customize->add_section( 'catchbase_header_right_menu_color_options', array(
		'panel'	   => 'catchbase_color_options',
		'priority' => 352,
		'title'    => __( 'Header Right Menu Color Options', 'catch-base' ),
	) );

	foreach ( $catchbase_menu_color_options as $color_option ) {
		$lower_color_option	=	'header_right_' . str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( 'catchbase_theme_options['. $lower_color_option .']', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		if ( 'header_right_hover_active_color' == $lower_color_option ) {
			$color_option = __(  'Hover Active Background Color', 'catch-base' );	
		}

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'catchbase_theme_options['. $lower_color_option .']', array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'catchbase_header_right_menu_color_options',
			'settings'	=> 'catchbase_theme_options['. $lower_color_option .']',
		) ) );

		$i++;
	}

	$wp_customize->add_section( 'catchbase_footer_menu_color_options', array(
		'panel'	   => 'catchbase_color_options',
		'priority' => 353,
		'title'    => __( 'Footer Menu Color Options', 'catch-base' ),
	) );

	foreach ( $catchbase_menu_color_options as $color_option ) {
		$lower_color_option	=	'footer_' . str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( 'catchbase_theme_options['. $lower_color_option .']', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		if ( 'footer_hover_active_color' == $lower_color_option ) {
			$color_option = __(  'Hover Active Background Color', 'catch-base' );	
		}

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'catchbase_theme_options['. $lower_color_option .']', array(
			'label'		=> $color_option,
			'section'	=> 'catchbase_footer_menu_color_options',
			'settings'	=> 'catchbase_theme_options['. $lower_color_option .']',
			'priority'	=> $i
		) ) );

		$i++;
	}
	
	//Basic Color Options End