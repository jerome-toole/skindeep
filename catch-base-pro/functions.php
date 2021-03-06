<?php
/**
 * Functions and definitions
 *
 * Sets up the theme using core catchbase-core and provides some helper functions using catchbase-custon-functions.
 * Others are attached to action and
 * filter hooks in WordPress to change core functionality
 *
 * @package Catch Themes
 * @subpackage Catch Base Pro
 * @since Catch Base 1.0 
 */

//define theme version
if ( !defined( 'CATCHBASE_THEME_VERSION' ) )
define ( 'CATCHBASE_THEME_VERSION', '3.1' );

/**
 * Implement the core functions
 */
require get_template_directory() . '/inc/catchbase-core.php';

// TODO: Indicate the ACF is a plugin dependency. Include with theme?

// Register action to configure theme requirements
add_action('init', 'custom_init');
// Register action to initialise skindeep theme
add_action('after_setup_theme', 'skindeep_setup' );
// Register action to initialise custom fields
// TODO: Use acf/init once upgraded
//add_action('init', 'my_acf_add_local_field_groups');

/**
 * Establishes the requirements of the theme
 */
function custom_init() {
    $options = catchbase_get_theme_options(); // Get options

    // Remove breadcrumbs from woocommerce pages
    if( isset ( $options['breadcumb_option'] ) ||
        isset ( $options['breadcumb_option'] ) && !$options['breadcumb_option'] ){
        jk_remove_wc_breadcrumbs();
    }
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as
 * indicating support post thumbnails.
 *
 * To override skindeep_setup() in a child theme, add your own skindeep_setup to
 * your child theme's functions.php file.
 *
 * @since      3.0.0
 */
function skindeep_setup() {
    // Skin Deep theme uses custom fields.
    add_custom_skin_deep_fields();
    install_ithemes_support();
}

/**
 * Register custom fields using Advanced Custom Fields (ACF). For example
 * 'Illustrator' field on posts.
 */
function add_custom_skin_deep_fields() {
    if(function_exists("register_field_group"))
    {
        // Author/Illustrator
        register_field_group(array (
            'id' => 'acf_skin-deep-article',
            'title' => 'Skin Deep Article',
            'fields' => array (
                array (
                    'key' => 'field_5833fcdadee6a',
                    'label' => 'Author',
                    'name' => 'author',
                    'type' => 'text',
                    'instructions' => 'The person who wrote the piece',
                    'required' => 1,
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => ' ',
                    'append' => '',
                    'formatting' => 'none',
                    'maxlength' => '',
                ),
                array (
                    'key' => 'field_5833fd0edee6b',
                    'label' => 'Illustrator',
                    'name' => 'illustrator',
                    'type' => 'text',
                    'instructions' => 'The person who created the illustrations',
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'none',
                    'maxlength' => '',
                ),
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'post',
                        'order_no' => 0,
                        'group_no' => 0,
                    ),
                ),
            ),
            'options' => array (
                'position' => 'acf_after_title',
                'layout' => 'no_box',
                'hide_on_screen' => array (
                    0 => 'author',
                ),
            ),
            'menu_order' => 0,
        ));
    }
}

/**
 * Replaces the_author()/get_the_author() output with ACF author field,
 * otherwise returns the logged in user if there is no custom entry.
 *
 * Credit for this code goes to Marty Martin:
 * http://seoserpent.com/wordpress/custom-author-byline
 *
 * @param      string  $author  The wordpress account author
 *
 * @return     string  The custom author name, or wordpress author if none exists
 */
function mod_the_author( $author ) {
    global $post;
    $custom_author = get_post_meta($post->ID, 'author', TRUE);
    if($custom_author)
        return $custom_author;
    return $author;
}
add_filter('the_author','mod_the_author');

/**
 * Update the 'seamless donations' plugin post type to not show in search
 * results
 *
 * @param      post_type  $donor_post_type  The donor post type to modify
 *
 * @return     post_type     The updated post type
 */
function mod_donor_post ( $donor_post_type ) {
    $donor_post_type['exclude_from_search'] = true ;
    return $donor_post_type;
}
add_filter('seamless_donations_donors_setup', 'mod_donor_post');

/**
 * @brief      Hide jetpack related posts from showing by default
 *
 * @param      $options  The options
 *
 * @return     None
 */
function jetpackme_remove_rp() {
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
        remove_filter( 'the_content', $callback, 40 );
    }
}
add_filter( 'wp', 'jetpackme_remove_rp', 20 );

/**
 * Writes a log message (only defined if WP_DEBUG is enabled)
 *
 * @param      string  $log    The log message
 */
function skindeep_write_log($log) {
    if (true == WP_DEBUG) {
        if (is_array($log) || is_object($log)) {
            error_log(print_r($log, true));
        } else {
            error_log($log);
        }
    }
}

/**
 * @brief      Remove the breadcrumbs from woocommerce pages
 *
 * @return     None
 */
function jk_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

/**
 * @brief      Sets the breadcrumb separator for woocommerce products
 *
 * @param      $defaults  The defaults
 *
 * @return     The amended default settings
 */
function jk_change_breadcrumb_delimiter( $defaults ) {
    $options = catchbase_get_theme_options(); // Get options
    $delimiter = '<span class="sep">'. $options['breadcumb_seperator'] .'</span><!-- .sep -->'; // delimiter between crumbs
    $defaults['delimiter'] = $delimiter;
    return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_delimiter' );

/**
 * @brief      Checks if the current post has a particular credit
 *
 * @param      $credit_type  The credit type: 'author' | 'illustrator'
 *  
 * @return     true if credit is populated, otherwise false
 */
function skindeep_has_post_credit( $credit_type ) {
    if ( function_exists('get_field') ) {
        return !empty(get_field( $credit_type ));
    }
    return false;
}

/**
 * @brief      Outputs the text for the particular credit
 *
 * @param      $credit_type  The credit type: 'author' | 'illustrator'
 *
 * @return     None
 */
function skindeep_get_post_credit( $credit_type ) {
    if ( function_exists('get_field') ) {
        $options = catchbase_get_theme_options(); // Get options
        printf(
            '%s %s',
            $options['post_' . $credit_type . '_credit_text'],
            get_field( $credit_type ));
    }
}

require get_template_directory() . '/exchange/functions.php';
