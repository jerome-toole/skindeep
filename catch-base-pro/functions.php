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
    write_log("custom_init() called.");
    $options = catchbase_get_theme_options(); // Get options

    // Remove breadcrumbs from woocommerce pages
    if( isset ( $options['breadcumb_option'] ) ||
        isset ( $options['breadcumb_option'] ) && !$options['breadcumb_option'] ){
        jk_remove_wc_breadcrumbs();
    }

    // e.g. add_post_type_support( 'post', 'excerpt' );
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
    write_log("skindeep_setup() called.");

    // Skin Deep theme uses custom fields.
    my_acf_add_local_field_groups();
}

/**
 * Register custom fields using Advanced Custom Fields (ACF). For example
 * 'Illustrator' field on posts.
 */
function my_acf_add_local_field_groups() {
    write_log("my_acf_add_local_field_groups() called.");

    if(function_exists("register_field_group"))
    {
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
 * @brief      Exclude products from showing jetpack related posts
 *
 * @param      $options  The options
 *
 * @return     None
 */
function jetpackme_no_related_posts( $options ) {
    write_log("post_type_exists( 'product' ) = " . post_type_exists( 'product' ));
    write_log("is_singular( 'product' ) = " . is_singular( 'product' ));
    if ( is_singular( 'product' ) || is_singular('product_variation') ) {
        $options['enabled'] = false;
    }
    return $options;
}
add_filter( 'jetpack_relatedposts_filter_options', 'jetpackme_no_related_posts' );

if (!function_exists('write_log')) {
    /**
     * Writes a log message (only defined if WP_DEBUG is enabled)
     *
     * @param      string  $log    The log message
     */
    function write_log($log) {
        if (true == WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
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