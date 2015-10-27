<?php
/**
 * The template for Social Links in Customizer
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

	// Social Icons
	$wp_customize->add_panel( 'catchbase_social_links', array(
	    'capability'     => 'edit_theme_options',
	    'description'	=> __( 'Note: Enter the url for correponding social networking website', 'catch-base' ),
	    'priority'       => 600,
		'title'    		 => __( 'Social Links', 'catch-base' ),
	) );
	
	$wp_customize->add_section( 'catchbase_social_links', array(
		'panel'			=> 'catchbase_social_links',
		'priority' 		=> 1,
		'title'   	 	=> __( 'Social Links', 'catch-base' ),
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[social_icon_size]', array(
		'capability'		=> 'edit_theme_options',
		'default' 			=> $defaults['social_icon_size'],
		'sanitize_callback'	=> 'absint',
	) );

	$wp_customize->add_control( 'social_icon_size', array(
		'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
            'style' => 'width: 60px;'
            ),
		'label'    	=> __( 'Social Icon Size(px)', 'catch-base' ),
		'priority'	=> '1.5',
		'section' 	=> 'catchbase_social_links',
		'settings'	=> 'catchbase_theme_options[social_icon_size]',
		'type'	   => 'number',
		) 
	);

	$catchbase_social_icons 	=	catchbase_get_social_icons_list();	
	
	$i 	=	1;

	foreach ( $catchbase_social_icons as $option ){
		$lower_case_option	=	str_replace( ' ', '_', strtolower( $option ) );
			
		if( $option == 'Skype' ){
			$wp_customize->add_setting( 'catchbase_theme_options['. $lower_case_option .'_link]', array(
					'capability'		=> 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				) );

			$wp_customize->add_control( 'catchbase_'. $lower_case_option .'_link', array(
				'description'	=> __( 'Skype link can be of formats:<br>callto://+{number}<br> skype:{username}?{action}. More Information in readme file', 'catch-base' ),
				'label'    		=> $option,
				'priority' 		=> $i + '2',
				'section'  		=> 'catchbase_social_links',
				'settings' 		=> 'catchbase_theme_options['. $lower_case_option .'_link]',
				'type'	   		=> 'url',
			) );
		}
		else {
			if( $option == 'Email' ){
				$wp_customize->add_setting( 'catchbase_theme_options['. $lower_case_option .'_link]', array(
						'capability'		=> 'edit_theme_options',
						'sanitize_callback' => 'sanitize_email',
					) );
			}
			
			else {
				$wp_customize->add_setting( 'catchbase_theme_options['. $lower_case_option .'_link]', array(
						'capability'		=> 'edit_theme_options',
						'sanitize_callback' => 'esc_url_raw',
					) );
			}

			$wp_customize->add_control( 'catchbase_'. $lower_case_option .'_link', array(
				'label'    => $option,
				'priority' => $i + '2',
				'section'  => 'catchbase_social_links',
				'settings' => 'catchbase_theme_options['. $lower_case_option .'_link]',
				'type'	   => 'url',
			) );
		}
	
		$i++;
	}

	$wp_customize->add_section( 'catchbase_custom_social_links', array(
		'description'	=> __( 'Save and refresh the page if No. of custom social icon is changed (Max number of icons is 10)', 'catch-base' ),
		'panel'			=> 'catchbase_social_links',
		'priority' 		=> 2,
		'title'   	 	=> __( 'Custom Social Links', 'catch-base' ),
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[custom_social_icons]', array(
		'capability'		=> 'edit_theme_options',
		'default' 			=> $defaults['custom_social_icons'],
		'sanitize_callback'	=> 'catchbase_sanitize_no_of_social_icons',
		) 
	);

	$wp_customize->add_control( 'custom_social_icons', array(
		'input_attrs' => array(
            'min'   => 0,
            'max'   => 10,
            'step'  => 1,
            'style' => 'width: 45px;'
            ),
		'label'    	=> __( 'Number of Custom Social Icons', 'catch-base' ),
		'priority'	=> '1.5',
		'section' 	=> 'catchbase_custom_social_links',
		'settings'	=> 'catchbase_theme_options[custom_social_icons]',
		'type'		=> 'number'
		) 
	);

	$priority	=	6;
	//loop for custom social icons
	for( $i = 1; $i <= $options['custom_social_icons'] ; $i++ ){
		if( $i > 9 ) // use this condition to make sure 10 comes after 9 priority wise
			$priority++;
		
		$wp_customize->add_setting( 'catchbase_theme_options[custom_social_icon_note_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );

		$wp_customize->add_control( new Catchbase_Note_Control( $wp_customize, 'custom_social_icon_note_'. $i, array(
	        'label'		=> __( 'Custom Social Icon #', 'catch-base' ) . $i,
			'priority'	=> $priority . '.' . $i,
	        'section'  	=> 'catchbase_custom_social_links',
	        'settings'	=> 'catchbase_theme_options[custom_social_icon_note_'. $i .']',
	        'type'     	=> 'description',
   		) ) );

   		$wp_customize->add_setting( 'catchbase_theme_options[custom_social_icon_title_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );

		$wp_customize->add_control(  'catchbase_theme_options[custom_social_icon_title_'. $i .']', array(
			'label'		=> __( 'Title', 'catch-base' ),
			'priority'	=> $priority . '.' .$i .$i,
			'section'   => 'catchbase_custom_social_links',
			'settings'  => 'catchbase_theme_options[custom_social_icon_title_'. $i .']',
		) );

		$wp_customize->add_setting( 'catchbase_theme_options[custom_social_icon_image_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'catchbase_sanitize_image',
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_social_icon_image_'. $i , array(
			'label'		=> __( 'Image', 'catch-base' ),
	        'priority'	=> $priority . '.' . $i .$i .$i,
			'section'   => 'catchbase_custom_social_links',
	        'settings'  => 'catchbase_theme_options[custom_social_icon_image_'. $i .']',
		) ) );

   		$wp_customize->add_setting( 'catchbase_theme_options[custom_social_icon_image_hover_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'catchbase_sanitize_image',
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_social_icon_image_hover_'. $i , array(
			'label'		=> __( 'Hover Image(Optional)', 'catch-base' ),
	        'priority'	=> $priority . '.' . $i .$i . $i  .$i,
			'section'   => 'catchbase_custom_social_links',
	        'settings'  => 'catchbase_theme_options[custom_social_icon_image_hover_'. $i .']',
		) ) );

		$wp_customize->add_setting( 'catchbase_theme_options[custom_social_icon_link_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'catchbase_sanitize_image',
		) );

		$wp_customize->add_control(  'catchbase_theme_options[custom_social_icon_link_'. $i .']', array(
			'label'		=> __( 'Link', 'catch-base' ),
	        'priority'	=> $priority . '.' .$i . $i  . $i  .$i .$i,
			'section'   => 'catchbase_custom_social_links',
	        'settings'  => 'catchbase_theme_options[custom_social_icon_link_'. $i .']',
		) );
	}
	// Social Icons End