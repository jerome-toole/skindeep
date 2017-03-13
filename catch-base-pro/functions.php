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

// Register action to configure theme requirements
add_action('init', 'custom_init');

// Register action to initialise skindeep theme
add_action('after_setup_theme', 'skindeep_setup' );

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

    // Skin Deep theme uses an Article post type
    create_article_post_type();
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
                    'instructions' => 'The person who wrote the article',
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
                        'value' => 'sd_articles',
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
 * @brief      Creates a cutsom post type of Article
 *             Note: Must be called on the 'init' hook. the after_setup hook is
 *             too soon for the 'taxonomies' argument.
 *
 * @return     None
 */
function create_article_post_type() {

    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => 'Articles',
        'singular_name'       => 'Article',
        'menu_name'           => 'Articles',
        'parent_item_colon'   => 'Parent Article', // Irrelevant
        'all_items'           => 'All Articles',
        'view_item'           => 'View Article',
        'add_new_item'        => 'Add New Article',
        'add_new'             => 'Add New',
        'edit_item'           => 'Edit Article',
        'update_item'         => 'Update Article',
        'search_items'        => 'Search Article',
        'not_found'           => 'Not Found',
        'not_found_in_trash'  => 'Not found in Trash',
    );
    // Set other options for Custom Post Type
    $args = array(
        'label'               => 'articles',
        'description'         => 'Article for viewing online',
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions' ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array ('category', 'post_tag'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'rewrite'             => ['slug' => 'online-articles'],
    );
    // Registering your Custom Post Type
    register_post_type( 'sd_articles', $args );
}

add_filter('manage_sd_articles_columns' , 'add_articles_columns');
function add_articles_columns($columns) {
    return array_merge($columns,
          array('ID' => 'ID'));
}

function revealid_id_column_content( $column, $id ) {
  if( 'revealid_id' == $column ) {
    echo $id;
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

/**
 * @brief      Include Articles in post queries
 *
 * @param      $query  The query
 *
 * @return     None
 */
function inc_articles_in_queries($query) {
    $post_type = get_query_var('post_type');
    if ( !is_admin() &&  $query->is_main_query()) {
        if (is_home()) {
            $query->set('post_type', array( 'post', 'sd_articles'));
        } else if (is_archive() || is_category()) {
            // Anything querying for Posts should also query Articles
            if (!$post_type) {
                $post_type = array('post', 'sd_articles');
            }
            $query->set('post_type', $post_type);
        }
    } else if ($query->get('post__in')) {
        write_log($query);
        // Ensure queries for specific post IDs (e.g. featured slider) include
        // Articles
        $post_type = array('nav_menu_item', 'post', 'sd_articles');
        $query->set('post_type', $post_type);
    }
}
add_action('pre_get_posts','inc_articles_in_queries');

/**
 * @brief      Have Jetpack display related posts for Articles
 *
 * @param      $allowed_post_types  The allowed post types
 *
 * @return     An array of post types to display related posts on
 */
function allow_my_post_types($allowed_post_types) {
    $allowed_post_types[] = 'articles';
    return $allowed_post_types;
}
add_filter( 'rest_api_allowed_post_types', 'allow_my_post_types' );
