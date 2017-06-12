<?php
/**
 * The template for displaying Social Icons
 *
 * @package Catch Themes
 * @subpackage Catch Base Pro
 * @since Catch Base 1.0
 */

if ( ! defined( 'CATCHBASE_THEME_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}


if ( ! function_exists( 'catchbase_get_social_icons' ) ) :
/**
 * Generate social icons.
 *
 * @since Catch Base 1.0
 */
function catchbase_get_social_icons(){
	if( ( !$catchbase_social_icons = get_transient( 'catchbase_social_icons' ) ) ) {
		$output	= '';

		$options 	= catchbase_get_theme_options(); // Get options

		$social_icons['Mailing List']	= isset( $options['icegram_campaign'] ) ? $options['icegram_campaign'] : '' ;
		$social_icons['Facebook-alt']	= isset( $options['facebook_link'] ) ? $options['facebook_link'] : '' ;
		$social_icons['Twitter']		= isset( $options['twitter_link'] ) ? $options['twitter_link'] : '' ;
		$social_icons['Googleplus-alt']	= isset( $options['googleplus_link'] ) ? $options['googleplus_link'] : '' ;
		$social_icons['Mail']			= isset( $options['email_link'] ) ? $options['email_link'] : '' ;
		$social_icons['Feed']			= isset( $options['feed_link'] ) ? $options['feed_link'] : '' ;
		$social_icons['WordPress']		= isset( $options['wordpress_link'] ) ? $options['wordpress_link'] : '' ;
		$social_icons['GitHub']			= isset( $options['github_link'] ) ? $options['github_link'] : '' ;
		$social_icons['LinkedIn']		= isset( $options['linkedin_link'] ) ? $options['linkedin_link'] : '' ;
		$social_icons['Pinterest']		= isset( $options['pinterest_link'] ) ? $options['pinterest_link'] : '' ;
		$social_icons['Flickr']			= isset( $options['flickr_link'] ) ? $options['flickr_link'] : '' ;
		$social_icons['Vimeo']			= isset( $options['vimeo_link'] ) ? $options['vimeo_link'] : '' ;
		$social_icons['YouTube']		= isset( $options['youtube_link'] ) ? $options['youtube_link'] : '' ;
		$social_icons['Tumblr']			= isset( $options['tumblr_link'] ) ? $options['tumblr_link'] : '' ;
		$social_icons['Instagram']		= isset( $options['instagram_link'] ) ? $options['instagram_link'] : '' ;
		$social_icons['CodePen']		= isset( $options['codepen_link'] ) ? $options['codepen_link'] : '' ;
		$social_icons['Polldaddy']		= isset( $options['polldaddy_link'] ) ? $options['polldaddy_link'] : '' ;
		$social_icons['Path']			= isset( $options['path_link'] ) ? $options['path_link'] : '' ;
		$social_icons['Dribbble']		= isset( $options['dribbble_link'] ) ? $options['dribbble_link'] : '' ;
		$social_icons['Skype']			= isset( $options['skype_link'] ) ? $options['skype_link'] : '' ;
		$social_icons['Digg']			= isset( $options['digg_link'] ) ? $options['digg_link'] : '' ;
		$social_icons['Reddit']			= isset( $options['reddit_link'] ) ? $options['reddit_link'] : '' ;
		$social_icons['Stumbleupon']	= isset( $options['stumbleupon_link'] ) ? $options['stumbleupon_link'] : '' ;
		$social_icons['Pocket']			= isset( $options['pocket_link'] ) ? $options['pocket_link'] : '' ;
		$social_icons['DropBox']		= isset( $options['dropbox_link'] ) ? $options['dropbox_link'] : '' ;
		$social_icons['Spotify']		= isset( $options['spotify_link'] ) ? $options['spotify_link'] : '' ;
		$social_icons['Foursquare']		= isset( $options['foursquare_link'] ) ? $options['foursquare_link'] : '' ;
		$social_icons['Spotify']		= isset( $options['spotify_link'] ) ? $options['spotify_link'] : '' ;
		$social_icons['Twitch']			= isset( $options['twitch_link'] ) ? $options['twitch_link'] : '' ;

		foreach ( $social_icons as $key => $value ) {
			if( '' != $value ){
				$title	=	explode( '-', $key );
				if ( 'Mail' == $key  ) { 
					$output .= '<a class="genericon_parent genericon genericon-'. strtolower( $key ) .'" title="'. __( 'Email', 'catch-base') . '" href="mailto:'. sanitize_email( $value ) .'"><span class="screen-reader-text">'. __( 'Email', 'catch-base') . '</span> </a>';
				}
				else if ( 'Skype' == $key  ) { 
					$output .= '<a class="genericon_parent genericon genericon-'. strtolower( $key ) .'" title="'. $title[ 0 ] . '" href="'. esc_attr( $value ) .'"><span class="screen-reader-text">'.$title[ 0 ] . '</span> </a>';
				}
				else if ( 'Mailing List' == $key ) {
					$output .= do_shortcode('[icegram campaigns="' . $value . '"]<a class="genericon_parent genericon genericon-mail" title="' . $title[ 0 ] . '" href="#"><span class="screen-reader-text">' . $title[0] . '</span></a>[/icegram]');
				}
				else {
					$output .= '<a class="genericon_parent genericon genericon-'. strtolower( $key ) .'" target="_blank" title="'. $title[ 0 ] .'" href="'. esc_url( $value ) .'"><span class="screen-reader-text">'. $title[ 0 ] .'</span> </a>';
				}
			}
		}

		for( $i = 1; $i <= $options['custom_social_icons'] ; $i++ ){
			$has_hover 		= '';
			$image_hover 	= '';

			if ( ! empty( $options['custom_social_icon_image_'. $i] ) ) {
				$image = $options['custom_social_icon_image_'. $i];

				if ( ! empty( $options['custom_social_icon_image_hover_'. $i] ) ) {
					$image_hover = $options['custom_social_icon_image_hover_'. $i];
					$has_hover = " has-hover";
				}

				//Checking Link
				if ( ! empty( $options['custom_social_icon_link_'. $i] ) ) {
					$link = $options['custom_social_icon_link_'. $i];
				} else {
					$link = '#';
				}

				//Checking Title
				if ( !empty ( $options['custom_social_icon_title_'. $i]) ) {
					$title = $options['custom_social_icon_title_'. $i];
				} else {
					$title = '';
				}	
				
				//Custom Social Icons
				$output .= '<a id="custom-icon-'. $i .'" class="custom-icon' . $has_hover . '" target="_blank" title="' . esc_attr( $title ) . '" href="' . esc_url( $link ) . '">
					<img  alt="' . esc_attr( $title ) . '" class ="icon-static" src="' . esc_url( $image ) . '" />';

					if ( isset ( $image_hover ) && '' != $image_hover ) {
					$output .= '<img  alt="' . esc_attr( $title ) . '" class ="icon-hover" src="' . esc_url( $image_hover ) . '" />';
				}
				$output .= '</a>';
			}
		}
		
		$catchbase_social_icons = $output;
	}
	return $catchbase_social_icons;
} // catchbase_get_social_icons
endif;
