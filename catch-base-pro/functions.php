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