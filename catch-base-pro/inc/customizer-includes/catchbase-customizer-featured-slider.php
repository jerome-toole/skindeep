<?php
/**
 * The template for adding Featured Slider Options in Customizer
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
	// Featured Slider
	$wp_customize->add_panel( 'catchbase_featured_slider', array(
	    'capability'     => 'edit_theme_options',
	    'description'    => __( 'Featured Slider Options', 'catch-base' ),
	    'priority'       => 500,
		'title'    		 => __( 'Featured Slider', 'catch-base' ),
	) );

	$wp_customize->add_section( 'catchbase_featured_slider', array(
		'panel'			=> 'catchbase_featured_slider',
		'priority'		=> 1,
		'title'			=> __( 'Featured Slider Options', 'catch-base' ),
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[featured_slider_option]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slider_option'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$featured_slider_content_options = catchbase_featured_slider_content_options();
	$choices = array();
	foreach ( $featured_slider_content_options as $featured_slider_content_option ) {
		$choices[$featured_slider_content_option['value']] = $featured_slider_content_option['label'];
	}

	$wp_customize->add_control( 'catchbase_featured_slider_option', array(
		'choices'   => $choices,
		'label'    	=> __( 'Enable Slider on', 'catch-base' ),
		'priority'	=> '1',
		'section'  	=> 'catchbase_featured_slider',
		'settings' 	=> 'catchbase_theme_options[featured_slider_option]',
		'type'    	=> 'select',
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[featured_slide_transition_effect]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slide_transition_effect'],
		'sanitize_callback'	=> 'catchbase_sanitize_featured_slide_transition_effects',
	) );

	$catchbase_featured_slide_transition_effects = catchbase_featured_slide_transition_effects();
	$choices = array();
	foreach ( $catchbase_featured_slide_transition_effects as $catchbase_featured_slide_transition_effect ) {
		$choices[$catchbase_featured_slide_transition_effect['value']] = $catchbase_featured_slide_transition_effect['label'];
	}

	$wp_customize->add_control( 'catchbase_theme_options[featured_slide_transition_effect]' , array(
		'choices'  	=> $choices,
		'label'		=> __( 'Transition Effect', 'catch-base' ),
		'priority'	=> '2',
		'section'  	=> 'catchbase_featured_slider',
		'settings' 	=> 'catchbase_theme_options[featured_slide_transition_effect]',
		'type'	  	=> 'select',
		)
	);

	$wp_customize->add_setting( 'catchbase_theme_options[featured_slide_transition_delay]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slide_transition_delay'],
		'sanitize_callback'	=> 'absint',
	) );

	$wp_customize->add_control( 'catchbase_theme_options[featured_slide_transition_delay]' , array(
		'description'	=> __( 'seconds(s)', 'catch-base' ),
		'input_attrs' => array(
        	'style' => 'width: 40px;'
    	),
    	'label'    		=> __( 'Transition Delay', 'catch-base' ),
		'priority'		=> '3',
		'section'  		=> 'catchbase_featured_slider',
		'settings' 		=> 'catchbase_theme_options[featured_slide_transition_delay]',
		)
	);

	$wp_customize->add_setting( 'catchbase_theme_options[featured_slide_transition_length]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slide_transition_length'],
		'sanitize_callback'	=> 'absint',
	) );

	$wp_customize->add_control( 'catchbase_theme_options[featured_slide_transition_length]' , array(
		'description'	=> __( 'seconds(s)', 'catch-base' ),
		'input_attrs' => array(
        	'style' => 'width: 40px;'
    	),
    	'label'    		=> __( 'Transition Length', 'catch-base' ),
		'priority'		=> '4',
		'section'  		=> 'catchbase_featured_slider',
		'settings' 		=> 'catchbase_theme_options[featured_slide_transition_length]',
		)
	);

	$wp_customize->add_setting( 'catchbase_theme_options[featured_slider_image_loader]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slider_image_loader'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$featured_slider_image_loader_options = catchbase_featured_slider_image_loader();
	$choices = array();
	foreach ( $featured_slider_image_loader_options as $featured_slider_image_loader_option ) {
		$choices[$featured_slider_image_loader_option['value']] = $featured_slider_image_loader_option['label'];
	}

	$wp_customize->add_control( 'catchbase_featured_slider_image_loader', array(
		'description'	=> __( 'True: Fixes the height overlap issue. Slideshow will start as soon as two slider are available. Slide may display in random, as image is fetch.<br>Wait: Fixes the height overlap issue.<br> Slideshow will start only after all images are available.', 'catch-base' ),
		'choices'   => $choices,
		'label'    	=> __( 'Image Loader', 'catch-base' ),
		'priority'	=> '5',
		'section'  	=> 'catchbase_featured_slider',
		'settings' 	=> 'catchbase_theme_options[featured_slider_image_loader]',
		'type'    	=> 'select',
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[featured_slider_type]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slider_type'],
		'sanitize_callback'	=> 'sanitize_key',
	) );

	$featured_slider_types = catchbase_featured_slider_types();
	$choices = array();
	foreach ( $featured_slider_types as $featured_slider_type ) {
		$choices[$featured_slider_type['value']] = $featured_slider_type['label'];
	}

	$wp_customize->add_control( 'catchbase_featured_slider_type', array(
		'choices'  	=> $choices,
		'label'    	=> __( 'Select Slider Type', 'catch-base' ),
		'priority'	=> '6',
		'section'  	=> 'catchbase_featured_slider',
		'settings' 	=> 'catchbase_theme_options[featured_slider_type]',
		'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[featured_slide_number]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_slide_number'],
		'sanitize_callback'	=> 'catchbase_sanitize_no_of_slider',
	) );

	$wp_customize->add_control( 'catchbase_featured_slide_number' , array(
		'description'	=> __( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'catch-base' ),
		'input_attrs' 	=> array(
            'style' => 'width: 45px;',
            'min'   => 0,
            'max'   => 20,
            'step'  => 1,
        	),
		'label'    		=> __( 'No of Slides', 'catch-base' ),
		'priority'		=> '7',
		'section'  		=> 'catchbase_featured_slider',
		'settings' 		=> 'catchbase_theme_options[featured_slide_number]',
		'type'	   		=> 'number',
		)
	);

	$wp_customize->add_setting( 'catchbase_theme_options[exclude_slider_post]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['exclude_slider_post'],
		'sanitize_callback'	=> 'catchbase_sanitize_checkbox',
	) );

	$wp_customize->add_control(  'catchbase_theme_options[exclude_slider_post]', array(
		'label'		=> __( 'Check to exclude Slider post from Homepage posts', 'catch-base' ),
		'priority'	=> '8',
		'section'   => 'catchbase_featured_slider',
		'settings'  => 'catchbase_theme_options[exclude_slider_post]',
		'type'		=> 'checkbox',
	) );

	//loop for featured post sliders
	for ( $i=1; $i <=  $options['featured_slide_number'] ; $i++ ) {
		$wp_customize->add_setting( 'catchbase_theme_options[featured_slider_post_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'catchbase_sanitize_post_id',
		) );

		$wp_customize->add_control( 'catchbase_featured_slider_post_'. $i, array(
			'input_attrs' => array(
        		'style' => 'width: 80px;'
    		),
			'label'    	=> __( 'Featured Post', 'catch-base' ) . ' # ' . $i ,
			'priority'	=>  '9' . $i,
			'section'  	=> 'catchbase_featured_slider',
			'settings' 	=> 'catchbase_theme_options[featured_slider_post_'. $i .']',
			'type'	   	=> 'text',
			)
		);
	}

	//loop for featured page sliders
	for ( $i=1; $i <= $options['featured_slide_number'] ; $i++ ) {
		$wp_customize->add_setting( 'catchbase_theme_options[featured_slider_page_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'catchbase_sanitize_page',
		) );

		$wp_customize->add_control( 'catchbase_featured_slider_page_'. $i .'', array(
			'label'    	=> __( 'Featured Page', 'catch-base' ) . ' # ' . $i ,
			'priority'	=> '10' . $i,
			'section'  	=> 'catchbase_featured_slider',
			'settings' 	=> 'catchbase_theme_options[featured_slider_page_'. $i .']',
			'type'	   	=> 'dropdown-pages',
		) );
	}

	$wp_customize->add_setting( 'catchbase_theme_options[featured_slider_select_category]', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'catchbase_sanitize_category_list',
	) );

	$wp_customize->add_control( new Catchbase_Customize_Dropdown_Categories_Control( $wp_customize, 'catchbase_featured_slider_select_category', array(
        'label'   	=> __('Select Categories', 'catch-base' ),
        'name' 		=> 'catchbase_theme_options[featured_slider_select_category]',
		'priority'	=> '11',
        'section'  	=> 'catchbase_featured_slider',
        'settings' 	=> 'catchbase_theme_options[featured_slider_select_category]',
        'type'     	=> 'dropdown-categories',
    ) ) );

	$priority	=	'12';
	//loop for featured image slider
	for( $i = 1; $i <= $options['featured_slide_number'] ; $i++ ){
		if( $i > 9 ) // use this condition to make sure 10 comes after 9 priority wise
			$priority++;
		
		$wp_customize->add_setting( 'catchbase_theme_options[featured_slider_note_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );

		$wp_customize->add_control( new Catchbase_Note_Control( $wp_customize, 'featured_slider_note_'. $i, array(
	        'label'		=> __( 'Featured Slide #', 'catch-base' ) . $i,
			'priority'	=> $priority . '.' . $i,
	        'section'  	=> 'catchbase_featured_slider',
	        'settings'	=> 'catchbase_theme_options[featured_slider_note_'. $i .']',
	        'type'     	=> 'description',
   		) ) );

		$wp_customize->add_setting( 'catchbase_theme_options[featured_slider_image_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'catchbase_sanitize_image',
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'featured_slider_image_'. $i , array(
			'label'		=> __( 'Image', 'catch-base' ),
			'priority'	=> $priority . '.' . $i .$i,
			'section'   => 'catchbase_featured_slider',
	        'settings'  => 'catchbase_theme_options[featured_slider_image_'. $i .']',
		) ) );

		$wp_customize->add_setting( 'catchbase_theme_options[featured_link_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'esc_url_raw',
		) );

		$wp_customize->add_control(  'catchbase_theme_options[featured_link_'. $i .']', array(
			'label'		=> __( 'Link', 'catch-base' ),
	        'priority'	=> $priority . '.' .$i . $i  . $i,
			'section'   => 'catchbase_featured_slider',
	        'settings'  => 'catchbase_theme_options[featured_link_'. $i .']',
		) );

		$wp_customize->add_setting( 'catchbase_theme_options[featured_target_'. $i .']', array(
	        'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'catchbase_sanitize_checkbox',
		) );

		$wp_customize->add_control(  'catchbase_theme_options[featured_target_'. $i .']', array(
			'label'		=> __( 'Check to Open Link in New Window/Tab', 'catch-base' ),
	        'priority'	=> $priority . '.' .$i  .$i  . $i . $i,
			'section'   => 'catchbase_featured_slider',
	        'settings'  => 'catchbase_theme_options[featured_target_'. $i .']',
			'type'		=> 'checkbox',
	    ) );

	    $wp_customize->add_setting( 'catchbase_theme_options[featured_title_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );

		$wp_customize->add_control(  'catchbase_theme_options[featured_title_'. $i .']', array(
			'label'		=> __( 'Title', 'catch-base' ),
	        'priority'	=> $priority . '.' .$i .  $i.  $i .$i . $i,
			'section'   => 'catchbase_featured_slider',
	        'settings'  => 'catchbase_theme_options[featured_title_'. $i .']',
			'type'		=> 'text',
	    ) );

	    $wp_customize->add_setting( 'catchbase_theme_options[featured_content_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );

		$wp_customize->add_control( new Catchbase_Customize_Textarea_Control ( $wp_customize, 'catchbase_theme_options[featured_content_'. $i .']', array(
			'label'		=> __( 'Content', 'catch-base' ),
	        'priority'	=> $priority . '.' . $i . $i .  $i . $i . $i . $i,
			'section'   => 'catchbase_featured_slider',
	        'settings'  => 'catchbase_theme_options[featured_content_'. $i .']',
			'type'		=> 'textarea',
	    ) ) );
	}
// Featured Slider End