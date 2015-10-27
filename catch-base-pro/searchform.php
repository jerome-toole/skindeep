<?php
/**
 * The template for displaying search form
 *
 * @package Catch Themes
 * @subpackage Catch Base Pro
 * @since Catch Base 1.0
 */
?>

<?php $options 	= catchbase_get_theme_options(); // Get options ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'catch-base' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( $options[ 'search_text' ] ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'catch-base' ); ?>">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'catch-base' ); ?>">
</form>
