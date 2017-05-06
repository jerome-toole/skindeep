<?php
/**
 * The template for adding Additional Header Option in Customizer
 *
 * @package Catch Themes
 * @subpackage Catch Base
 * @since Catch Base 1.0 
 */

if ( ! defined( 'CATCHBASE_THEME_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

	// Header Options
	$wp_customize->add_setting( 'catchbase_theme_options[enable_featured_header_image]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['enable_featured_header_image'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$catchbase_enable_featured_header_image_options = catchbase_enable_featured_header_image_options();
	$choices = array();
	foreach ( $catchbase_enable_featured_header_image_options as $catchbase_enable_featured_header_image_option ) {
		$choices[$catchbase_enable_featured_header_image_option['value']] = $catchbase_enable_featured_header_image_option['label'];
	}

	$wp_customize->add_control( 'catchbase_theme_options[enable_featured_header_image]', array(
			'choices'  	=> $choices,
			'label'		=> __( 'Enable Featured Header Image on ', 'catch-base' ),
			'section'   => 'header_image',
	        'settings'  => 'catchbase_theme_options[enable_featured_header_image]',
	        'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[featured_header_image_position]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_header_image_position'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$catchbase_featured_header_image_position_options = catchbase_featured_header_image_position_options();
	$choices = array();
	foreach ( $catchbase_featured_header_image_position_options as $catchbase_featured_header_image_position_option ) {
		$choices[$catchbase_featured_header_image_position_option['value']] = $catchbase_featured_header_image_position_option['label'];
	}

	$wp_customize->add_control( 'catchbase_theme_options[featured_header_image_position]', array(
			'choices'  	=> $choices,
			'label'		=> __( 'Featured Header Image Position', 'catch-base' ),
			'section'   => 'header_image',
	        'settings'  => 'catchbase_theme_options[featured_header_image_position]',
	        'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[featured_image_size]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_image_size'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$catchbase_featured_image_size_options = catchbase_featured_image_size_options();
	$choices = array();
	foreach ( $catchbase_featured_image_size_options as $catchbase_featured_image_size_option ) {
		$choices[$catchbase_featured_image_size_option['value']] = $catchbase_featured_image_size_option['label'];
	}

	$wp_customize->add_control( 'catchbase_theme_options[featured_image_size]', array(
			'choices'  	=> $choices,
			'label'		=> __( 'Page/Post Featured Header Image Size', 'catch-base' ),
			'section'   => 'header_image',
			'settings'  => 'catchbase_theme_options[featured_image_size]',
			'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[featured_header_image_alt]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_header_image_alt'],
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'catchbase_theme_options[featured_header_image_alt]', array(
			'label'		=> __( 'Featured Header Image Alt/Title Tag ', 'catch-base' ),
			'section'   => 'header_image',
	        'settings'  => 'catchbase_theme_options[featured_header_image_alt]',
	        'type'	  	=> 'text',
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[featured_header_image_url]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_header_image_url'],
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'catchbase_theme_options[featured_header_image_url]', array(
			'label'		=> __( 'Featured Header Image Link URL', 'catch-base' ),
			'section'   => 'header_image',
	        'settings'  => 'catchbase_theme_options[featured_header_image_url]',
	        'type'	  	=> 'text',
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[featured_header_image_base]', array(
		'capability'		=> 'edit_theme_options',
		'default'	=> $defaults['featured_header_image_url'],
		'sanitize_callback' => 'catchbase_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'catchbase_theme_options[featured_header_image_base]', array(
		'label'    	=> __( 'Check to Open Link in New Window/Tab', 'catch-base' ),
		'section'  	=> 'header_image',
		'settings' 	=> 'catchbase_theme_options[featured_header_image_base]',
		'type'     	=> 'checkbox',
	) );	

	$wp_customize->add_setting( 'catchbase_theme_options[featured_header_image_inline_css]', array(
		'capability'		=> 'edit_theme_options',
		'default'	=> $defaults['featured_header_image_inline_css'],
		'sanitize_callback' => 'catchbase_sanitize_custom_css',
	) );

	$wp_customize->add_control( 'catchbase_theme_options[featured_header_image_inline_css]', array(
			'label'		=> __( 'Featured Header Image Inline CSS', 'catch-base' ),
			'section'   => 'header_image',
	        'settings'  => 'catchbase_theme_options[featured_header_image_inline_css]',
	        'type'	  	=> 'text',
	) );
// Header Options End