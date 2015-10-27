<?php
/**
 * The template for adding Featured Content Settings in Customizer
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
	// Featured Content Options
	$wp_customize->add_panel( 'catchbase_featured_content_options', array(
	    'capability'     => 'edit_theme_options',
		'description'    => __( 'Options for Featured Content', 'catch-base' ),
	    'priority'       => 400,
	    'title'    		 => __( 'Featured Content', 'catch-base' ),
	) );


	$wp_customize->add_section( 'catchbase_featured_content_options', array(
		'panel'			=> 'catchbase_featured_content_options',
		'priority'		=> 1,
		'title'			=> __( 'Featured Content Options', 'catch-base' ),
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[featured_content_option]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_option'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$catchbase_featured_slider_content_options = catchbase_featured_slider_content_options();
	$choices = array();
	foreach ( $catchbase_featured_slider_content_options as $catchbase_featured_slider_content_option ) {
		$choices[$catchbase_featured_slider_content_option['value']] = $catchbase_featured_slider_content_option['label'];
	}

	$wp_customize->add_control( 'catchbase_theme_options[featured_content_option]', array(
		'choices'  	=> $choices,
		'label'    	=> __( 'Enable Featured Content on', 'catch-base' ),
		'priority'	=> '1',
		'section'  	=> 'catchbase_featured_content_options',
		'settings' 	=> 'catchbase_theme_options[featured_content_option]',
		'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[featured_content_layout]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_layout'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$catchbase_featured_content_layout_options = catchbase_featured_content_layout_options();
	$choices = array();
	foreach ( $catchbase_featured_content_layout_options as $catchbase_featured_content_layout_option ) {
		$choices[$catchbase_featured_content_layout_option['value']] = $catchbase_featured_content_layout_option['label'];
	}

	$wp_customize->add_control( 'catchbase_theme_options[featured_content_layout]', array(
		'choices'  	=> $choices,
		'label'    	=> __( 'Select Featured Content Layout', 'catch-base' ),
		'priority'	=> '2',
		'section'  	=> 'catchbase_featured_content_options',
		'settings' 	=> 'catchbase_theme_options[featured_content_layout]',
		'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[featured_content_position]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_position'],
		'sanitize_callback' => 'catchbase_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'catchbase_theme_options[featured_content_position]', array(
		'label'		=> __( 'Check to Move above Footer', 'catch-base' ),
		'priority'	=> '3',
		'section'  	=> 'catchbase_featured_content_options',
		'settings'	=> 'catchbase_theme_options[featured_content_position]',
		'type'		=> 'checkbox',
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[featured_content_type]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_type'],
		'sanitize_callback'	=> 'sanitize_key',
	) );

	$catchbase_featured_content_types = catchbase_featured_content_types();
	$choices = array();
	foreach ( $catchbase_featured_content_types as $catchbase_featured_content_type ) {
		$choices[$catchbase_featured_content_type['value']] = $catchbase_featured_content_type['label'];
	}

	$wp_customize->add_control( 'catchbase_theme_options[featured_content_type]', array(
		'choices'  	=> $choices,
		'label'    	=> __( 'Select Content Type', 'catch-base' ),
		'priority'	=> '4',
		'section'  	=> 'catchbase_featured_content_options',
		'settings' 	=> 'catchbase_theme_options[featured_content_type]',
		'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'catchbase_theme_options[featured_content_headline]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_headline'],
		'sanitize_callback'	=> 'wp_kses_post',
	) );

	$wp_customize->add_control( 'catchbase_theme_options[featured_content_headline]' , array(
		'description'	=> __( 'Leave field empty if you want to remove Headline', 'catch-base' ),
		'label'    		=> __( 'Headline for Featured Content', 'catch-base' ),
		'priority'		=> '5',
		'section'  		=> 'catchbase_featured_content_options',
		'settings' 		=> 'catchbase_theme_options[featured_content_headline]',
		'type'	   		=> 'text',
		)
	);

	$wp_customize->add_setting( 'catchbase_theme_options[featured_content_subheadline]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_subheadline'],
		'sanitize_callback'	=> 'wp_kses_post',
	) );

	$wp_customize->add_control( 'catchbase_theme_options[featured_content_subheadline]' , array(
		'description'	=> __( 'Leave field empty if you want to remove Sub-headline', 'catch-base' ),
		'label'    		=> __( 'Sub-headline for Featured Content', 'catch-base' ),
		'priority'		=> '6',
		'section'  		=> 'catchbase_featured_content_options',
		'settings' 		=> 'catchbase_theme_options[featured_content_subheadline]',
		'type'	   		=> 'text',
		) 
	);

	$wp_customize->add_setting( 'catchbase_theme_options[featured_content_number]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_number'],
		'sanitize_callback'	=> 'catchbase_sanitize_no_of_slider',
	) );

	$wp_customize->add_control( 'catchbase_theme_options[featured_content_number]' , array(
		'description'	=> __( 'Save and refresh the page if No. of Featured Content is changed (Max no of Featured Content is 20)', 'catch-base' ),
		'input_attrs' 	=> array(
            'style' => 'width: 45px;',
            'min'   => 0,
            'max'   => 20,
            'step'  => 1,
        	),
		'label'    		=> __( 'No of Featured Content', 'catch-base' ),
		'priority'		=> '7',
		'section'  		=> 'catchbase_featured_content_options',
		'settings' 		=> 'catchbase_theme_options[featured_content_number]',
		'type'	   		=> 'number',
		) 
	);

	$wp_customize->add_setting( 'catchbase_theme_options[featured_content_show]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_content_show'],
		'sanitize_callback'	=> 'sanitize_key',
	) ); 

	$catchbase_featured_content_show = catchbase_featured_content_show();
	$choices = array();
	foreach ( $catchbase_featured_content_show as $catchbase_featured_content_shows ) {
		$choices[$catchbase_featured_content_shows['value']] = $catchbase_featured_content_shows['label'];
	}

	$wp_customize->add_control( 'catchbase_theme_options[featured_content_show]', array(
		'choices'  	=> $choices,
		'label'    	=> __( 'Display Content', 'catch-base' ),
		'priority'	=> '8',
		'section'  	=> 'catchbase_featured_content_options',
		'settings' 	=> 'catchbase_theme_options[featured_content_show]',
		'type'	  	=> 'select',
	) );
	

	//loop for featured post content
	for ( $i=1; $i <=  $options['featured_content_number'] ; $i++ ) {
		$wp_customize->add_setting( 'catchbase_theme_options[featured_content_post_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'catchbase_sanitize_post_id',
		) 
	);

		$wp_customize->add_control( 'catchbase_featured_content_post_'. $i, array(
			'input_attrs' => array(
            	'style' => 'width: 40px;'
        	),
			'label'    	=> __( 'Featured Post', 'catch-base' ) . ' ' . $i ,
			'priority'	=>  '9' . $i,
			'section'  	=> 'catchbase_featured_content_options',
			'settings' 	=> 'catchbase_theme_options[featured_content_post_'. $i .']',
			'type'	   	=> 'text',
			)
		);
	}

	//loop for featured page sliders
	for ( $i=1; $i <= $options['featured_content_number'] ; $i++ ) {
		$wp_customize->add_setting( 'catchbase_theme_options[featured_content_page_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'catchbase_sanitize_page',
		) );

		$wp_customize->add_control( 'catchbase_featured_content_page_'. $i .'', array(
			'label'    	=> __( 'Featured Page', 'catch-base' ) . ' ' . $i ,
			'priority'	=> '10' . $i,
			'section'  	=> 'catchbase_featured_content_options',
			'settings' 	=> 'catchbase_theme_options[featured_content_page_'. $i .']',
			'type'	   	=> 'dropdown-pages',
		) );
	}

	$wp_customize->add_setting( 'catchbase_theme_options[featured_content_select_category]', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'catchbase_sanitize_category_list',
	) );

	$wp_customize->add_control( new Catchbase_Customize_Dropdown_Categories_Control( $wp_customize, 'catchbase_featured_content_select_category', array(
        'label'   	=> __( 'Select Categories', 'catch-base' ),
        'name' 		=> 'catchbase_theme_options[featured_content_select_category]',
        'section'  	=> 'catchbase_featured_content_options',
        'settings' 	=> 'catchbase_theme_options[featured_content_select_category]',
        'type'     	=> 'dropdown-categories',
    ) ) );

	$priority	=	11;
	//loop for featured image content
	for( $i = 1; $i <= $options['featured_content_number'] ; $i++ ){
		if( $i > 9 ) // use this condition to make sure 10 comes after 9 priority wise
			$priority++;
		
		$wp_customize->add_setting( 'catchbase_theme_options[featured_content_note_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );

		$wp_customize->add_control( new Catchbase_Note_Control( $wp_customize, 'featured_content_note_'. $i, array(
	        'label'		=> __( 'Featured Content #', 'catch-base' ) .  $i,
			'priority'	=> $priority . '.' . $i,
	        'section'  	=> 'catchbase_featured_content_options',
	        'settings'	=> 'catchbase_theme_options[featured_content_note_'. $i .']',
	        'type'     	=> 'description',
   		) ) );

		$wp_customize->add_setting( 'catchbase_theme_options[featured_content_image_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'catchbase_sanitize_image',
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'featured_content_image_'. $i , array(
			'label'		=> __( 'Image', 'catch-base' ),
	        'priority'	=> $priority . '.' . $i .$i,
			'section'   => 'catchbase_featured_content_options',
	        'settings'  => 'catchbase_theme_options[featured_content_image_'. $i .']',
		) ) );

		$wp_customize->add_setting( 'catchbase_theme_options[featured_content_link_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'esc_url_raw',
		) );

		$wp_customize->add_control(  'catchbase_theme_options[featured_content_link_'. $i .']', array(
			'label'		=> __( 'Link', 'catch-base' ),
	        'priority'	=> $priority . '.' .$i . $i  . $i ,
			'section'   => 'catchbase_featured_content_options',
	        'settings'  => 'catchbase_theme_options[featured_content_link_'. $i .']',
		) );

		$wp_customize->add_setting( 'catchbase_theme_options[featured_content_target_'. $i .']', array(
	        'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'catchbase_sanitize_checkbox',
		) );

		$wp_customize->add_control(  'catchbase_theme_options[featured_content_target_'. $i .']', array(
			'label'		=> __( 'Check to Open Link in New Window/Tab', 'catch-base' ),
	        'priority'	=> $priority . '.' .$i  .$i  . $i . $i,
			'section'   => 'catchbase_featured_content_options',
	        'settings'  => 'catchbase_theme_options[featured_content_target_'. $i .']',
			'type'		=> 'checkbox',
	    ) );

	    $wp_customize->add_setting( 'catchbase_theme_options[featured_content_title_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );

		$wp_customize->add_control(  'catchbase_theme_options[featured_content_title_'. $i .']', array(
			'label'		=> __( 'Title', 'catch-base' ),
	        'priority'	=> $priority . '.' .$i .  $i.  $i .$i . $i,
			'section'   => 'catchbase_featured_content_options',
	        'settings'  => 'catchbase_theme_options[featured_content_title_'. $i .']',
			'type'		=> 'text',
	    ) );

	    $wp_customize->add_setting( 'catchbase_theme_options[featured_content_content_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'sanitize_text_field',
		) );

		$wp_customize->add_control( new Catchbase_Customize_Textarea_Control ( $wp_customize, 'catchbase_theme_options[featured_content_content_'. $i .']', array(
			'label'		=> __( 'Content', 'catch-base' ),
	        'priority'	=> $priority . '.' . $i . $i .  $i . $i . $i . $i,
			'section'   => 'catchbase_featured_content_options',
	        'settings'  => 'catchbase_theme_options[featured_content_content_'. $i .']',
			'type'		=> 'textarea',
	    ) ) );
	}
// Featured Content Setting End