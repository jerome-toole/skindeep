<?php
/**
 * The template for displaying the Featured Content
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


if( !function_exists( 'catchbase_featured_content_display' ) ) :
/**
* Add Featured content.
*
* @uses action hook catchbase_before_content.
*
* @since Catch Base 1.0
*/
function catchbase_featured_content_display() {
	//catchbase_flush_transients();
	
	global $post, $wp_query;

	// get data value from options
	$options 		= catchbase_get_theme_options();
	$enablecontent 	= $options['featured_content_option'];
	$contentselect 	= $options['featured_content_type'];
	
	// Front page displays in Reading Settings
	$page_on_front 	= get_option('page_on_front') ;
	$page_for_posts = get_option('page_for_posts'); 


	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();
	if ( $enablecontent == 'entire-site' || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && $enablecontent == 'homepage' ) ) {
		if( ( !$catchbase_featured_content = get_transient( 'catchbase_featured_content_display' ) ) ) {
			$layouts 	 = $options ['featured_content_layout'];
			$headline 	 = $options ['featured_content_headline'];
			$subheadline = $options ['featured_content_subheadline'];
	
			echo '<!-- refreshing cache -->';

			if ( !empty( $layouts ) ) {
				$classes = $layouts ;
			}

			if( $contentselect == 'demo-featured-content' ) {
				$classes 		.= ' demo-featured-content' ;
				$headline 		= __( 'Featured Content', 'catch-base' );
				$subheadline 	= __( 'Here you can showcase the x number of Featured Content. You can edit this Headline, Subheadline and Feaured Content from "Appearance -> Customize -> Featured Content Options".', 'catch-base' );
			} 
			else if ( $contentselect == 'featured-post-content' ) {
				$classes 	.= ' featured-post-content' ;
			}
			elseif ( $contentselect == 'featured-page-content' ) {
				$classes .= ' featured-page-content' ;
			}
			elseif ( $contentselect == 'featured-category-content' ) {
				$classes .= ' featured-category-content' ;
			}
			elseif ( $contentselect == 'featured-image-content' ) {
				$classes .= ' featured-image-content' ;
			}

			//Check Featured Content Position
			if ( isset( $options [ 'featured_content_position' ] ) ) {
				$featured_content_position = $options [ 'featured_content_position' ];
			}
			// Providing Backward Compatible with Version 1.0
			else {
				$featured_content_position =  $options [ 'move_posts_home' ];
			}

			if ( '1' == $featured_content_position ) {
				$classes .= ' border-top' ;
			}

			$catchbase_featured_content ='
				<section id="featured-content" class="' . $classes . '">
					<div class="wrapper">';
						if ( !empty( $headline ) || !empty( $subheadline ) ) {
							$catchbase_featured_content .='<div class="featured-heading-wrap">';
								if ( !empty( $headline ) ) {
									$catchbase_featured_content .='<h1 id="featured-heading" class="entry-title">'. $headline .'</h1>';
								}
								if ( !empty( $subheadline ) ) {
									$catchbase_featured_content .='<p>'. $subheadline .'</p>';
								}
							$catchbase_featured_content .='</div><!-- .featured-heading-wrap -->';
						}
						
						$catchbase_featured_content .='
						<div class="featured-content-wrap">';

							// Select content
							if ( $contentselect == 'demo-featured-content'  && function_exists( 'catchbase_demo_content' ) ) {
								$catchbase_featured_content .= catchbase_demo_content( $options );
							}
							else if ( $contentselect == 'featured-post-content' && function_exists( 'catchbase_post_content' ) ) {
								$catchbase_featured_content .= catchbase_post_content( $options );
							}
							elseif ( $contentselect == 'featured-page-content' && function_exists( 'catchbase_page_content' ) ) {
								$catchbase_featured_content .= catchbase_page_content( $options );
							}
							elseif ( $contentselect == 'featured-category-content' && function_exists( 'catchbase_category_content' ) ) {
								$catchbase_featured_content .= catchbase_category_content( $options );
							}
							elseif ( $contentselect == 'featured-image-content' && function_exists( 'catchbase_image_content' ) ) {
								$catchbase_featured_content .= catchbase_image_content( $options );
							}

			$catchbase_featured_content .='
						</div><!-- .featured-content-wrap -->
					</div><!-- .wrapper -->
				</section><!-- #featured-content -->';
		set_transient( 'catchbase_featured_content', $catchbase_featured_content, 86940 );
		}
	echo $catchbase_featured_content;
	}
}
endif;


if ( ! function_exists( 'catchbase_featured_content_display_position' ) ) :
/**
 * Homepage Featured Content Position
 *
 * @action catchbase_content, catchbase_after_secondary
 * 
 * @since Catch Base 1.0
 */
function catchbase_featured_content_display_position() {
	// Getting data from Theme Options
	$options 		= catchbase_get_theme_options();
	
	//Check Featured Content Position
	if ( isset( $options [ 'featured_content_position' ] ) ) {
		$featured_content_position = $options [ 'featured_content_position' ];
	}
	// Providing Backward Compatible with Version 1.0
	else {
		$featured_content_position =  $options [ 'move_posts_home' ];
	}

	if ( '1' != $featured_content_position ) { 
		add_action( 'catchbase_before_content', 'catchbase_featured_content_display', 40 );
	} else {
		add_action( 'catchbase_after_content', 'catchbase_featured_content_display', 40 );
	}
	
}
endif; // catchbase_featured_content_display_position
add_action( 'catchbase_before', 'catchbase_featured_content_display_position' );


if ( ! function_exists( 'catchbase_demo_content' ) ) :
/**
 * This function to display featured posts content
 *
 * @get the data value from customizer options
 *
 * @since Catch Base 1.0
 *
 */
function catchbase_demo_content( $options ) {
	$catchbase_demo_content = '
		<article id="featured-post-1" class="post hentry post-demo">
			<figure class="featured-content-image">
				<img alt="Durbar Square" class="wp-post-image" src="'.get_template_directory_uri() . '/images/gallery/featured1-400x225.jpg" />
			</figure>
			<div class="entry-container">
				<header class="entry-header">
					<h1 class="entry-title">
						<a href="#" title="Durbar Square">Durbar Square</a>
					</h1>
				</header>
				<div class="entry-content">
					The Kathmandu Durbar Square holds the palaces of the Malla and Shah kings who ruled over the city. Along with these palaces, the square surrounds quadrangles revealing courtyards and temples.
				</div>
			</div><!-- .entry-container -->			
		</article>

		<article id="featured-post-2" class="post hentry post-demo">
			<figure class="featured-content-image">
				<img alt="Seto Ghumba" class="wp-post-image" src="'.get_template_directory_uri() . '/images/gallery/featured2-400x225.jpg" />
			</figure>
			<div class="entry-container">
				<header class="entry-header">
					<h1 class="entry-title">
						<a href="#" title="Seto Ghumba">Seto Ghumba</a>
					</h1>
				</header>
				<div class="entry-content">
					Situated western part in the outskirts of the Kathmandu valley, Seto Gumba also known as Druk Amitabh Mountain or White Monastery, is one of the most popular Buddhist monasteries of Nepal.
				</div>
			</div><!-- .entry-container -->			
		</article>
		
		<article id="featured-post-3" class="post hentry post-demo">
			<figure class="featured-content-image">
				<img alt="Swayambhunath" class="wp-post-image" src="'.get_template_directory_uri() . '/images/gallery/featured3-400x225.jpg" />
			</figure>
			<div class="entry-container">
				<header class="entry-header">
					<h1 class="entry-title">
						<a href="#" title="Swayambhunath">Swayambhunath</a>
					</h1>
				</header>
				<div class="entry-content">
					Swayambhunath is an ancient religious site up in the hill around Kathmandu Valley. It is also known as the Monkey Temple as there are holy monkeys living in the north-west parts of the temple.
				</div>
			</div><!-- .entry-container -->			
		</article>';

	if( 'layout-four' == $options ['featured_content_layout']) {
		$catchbase_demo_content .= '
		<article id="featured-post-4" class="post hentry post-demo">
			<figure class="featured-content-image">
				<img alt="Dhulikhel" class="wp-post-image" src="'.get_template_directory_uri() . '/images/gallery/featured4-400x225.jpg" />
			</figure>
			<div class="entry-container">
				<header class="entry-header">
					<h1 class="entry-title">
						<a href="#" title="Dhulikhel">Dhulikhel</a>
					</h1>
				</header>
				<div class="entry-content">
					Dhulikhel is a popular place to observe the high Himalaya - A Tourist Paradise: The spectacular snowfed mountains seen from Dhuklikhel must be one of the finest panoramic views in the world. 
				</div>
			</div><!-- .entry-container -->			
		</article>';
	}

	return $catchbase_demo_content;
}
endif; // catchbase_demo_content


if ( ! function_exists( 'catchbase_post_content' ) ) :
/**
 * This function to display featured posts content
 *
 * @param $options: catchbase_theme_options from customizer
 *
 * @since Catch Base 1.0
 */
function catchbase_post_content( $options ) {
	global $post;
	
	$quantity 		= $options [ 'featured_content_number' ];
	
	$number_of_post = 0; 		// for number of posts

	$post_list		= array();	// list of valid post ids

	$show_content	= isset( $options['featured_content_show'] ) ? $options['featured_content_show'] : 'excerpt';

	$catchbase_post_content = '';

	//Get valid number of posts
	for( $i = 1; $i <= $quantity; $i++ ){
		if( isset ( $options['featured_content_post_' . $i] ) && $options['featured_content_post_' . $i] > 0 ){
			$number_of_post++;

			$post_list	=	array_merge( $post_list, array( $options['featured_content_post_' . $i] ) );
		}

	}
	
	if ( !empty( $post_list ) && $number_of_post > 0 ) {
		$get_featured_posts = new WP_Query( array(
                    'posts_per_page' => $number_of_post,
                    'post__in'       => $post_list,
                    'orderby'        => 'post__in',
                    'ignore_sticky_posts' => 1 // ignore sticky posts
                ));

		$i=0; 
		while ( $get_featured_posts->have_posts()) : $get_featured_posts->the_post(); $i++;
			$title_attribute = the_title_attribute( array( 'before' => __( 'Permalink to ', 'catch-base' ), 'echo' => false ) );
			$excerpt = get_the_excerpt();
			$catchbase_post_content .= '
				<article id="featured-post-' . $i . '" class="post hentry featured-post-content">';	
				if ( has_post_thumbnail() ) {
					$catchbase_post_content .= '
					<figure class="featured-homepage-image">
						<a href="' . get_permalink() . '" title="' . the_title_attribute( array( 'before' => __( 'Permalink to ', 'catch-base' ), 'echo' => false ) ) . '">
						'. get_the_post_thumbnail( $post->ID, 'medium', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class' => 'pngfix' ) ) .'
						</a>
					</figure>';
				}
				else {
					$catchbase_first_image = catchbase_get_first_image( $post->ID, 'medium', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class' => 'pngfix' ) );

					if ( '' != $catchbase_first_image ) {
						$catchbase_post_content .= '
						<figure class="featured-homepage-image">
							<a href="' . get_permalink() . '" title="' . the_title_attribute( array( 'before' => __( 'Permalink to:', 'catch-base' ), 'echo' => false ) ) . '">
								'. $catchbase_first_image .'
							</a>
						</figure>';
					}
				}

				$catchbase_post_content .= '
					<div class="entry-container">
						<header class="entry-header">
							<h1 class="entry-title">
								<a href="' . get_permalink() . '" rel="bookmark">' . the_title( '','', false ) . '</a>
							</h1>
							<h3 class="entry-author">' . the_author( '','', false ) . '</h3>
						</header>';
						if ( 'excerpt' == $show_content ) {
							$catchbase_post_content .= '<div class="entry-excerpt"><p>' . $excerpt . '</p></div><!-- .entry-excerpt -->';
						}
						elseif ( 'full-content' == $show_content ) { 
							$content = apply_filters( 'the_content', get_the_content() );
							$content = str_replace( ']]>', ']]&gt;', $content );
							$catchbase_post_content .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
						}
					$catchbase_post_content .= '
					</div><!-- .entry-container -->
				</article><!-- .featured-post-'. $i .' -->';
		endwhile;

		wp_reset_query();
	}
	
	return $catchbase_post_content;
}
endif; // catchbase_post_content


if ( ! function_exists( 'catchbase_page_content' ) ) :
/**
 * This function to display featured page content
 *
 * @param $options: catchbase_theme_options from customizer
 *
 * @since Catch Base 1.0
 */
function catchbase_page_content( $options ) {
	global $post;

	$quantity 					= $options [ 'featured_content_number' ];

	$more_link_text				= $options['excerpt_more_text'];
	
	$show_content				= isset( $options['featured_content_show'] ) ? $options['featured_content_show'] : 'excerpt';

	$catchbase_page_content 	= '';

   	$number_of_page 			= 0; 		// for number of pages

	$page_list					= array();	// list of valid pages ids

	//Get valid pages
	for( $i = 1; $i <= $quantity; $i++ ){
		if( isset ( $options['featured_content_page_' . $i] ) && $options['featured_content_page_' . $i] > 0 ){
			$number_of_page++;

			$page_list	=	array_merge( $page_list, array( $options['featured_content_page_' . $i] ) );
		}

	}
	if ( !empty( $page_list ) && $number_of_page > 0 ) {
		$get_featured_posts = new WP_Query( array(
                    'posts_per_page' 		=> $number_of_page,
                    'post__in'       		=> $page_list,
                    'orderby'        		=> 'post__in',
                    'post_type'				=> 'page',
                ));

		$i=0; 
		while ( $get_featured_posts->have_posts()) : $get_featured_posts->the_post(); $i++;
			$title_attribute = the_title_attribute( array( 'before' => __( 'Permalink to:', 'catch-base' ), 'echo' => false ) );
			
			$excerpt = get_the_excerpt();
			
			$catchbase_page_content .= '
				<article id="featured-post-' . $i . '" class="post hentry featured-page-content">';	
				if ( has_post_thumbnail() ) {
					$catchbase_page_content .= '
					<figure class="featured-homepage-image">
						<a href="' . get_permalink() . '" title="' . the_title_attribute( array( 'before' => __( 'Permalink to:', 'catch-base' ), 'echo' => false ) ) . '">
						'. get_the_post_thumbnail( $post->ID, 'medium', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class' => 'pngfix' ) ) .'
						</a>
					</figure>';
				}
				else {
					$catchbase_first_image = catchbase_get_first_image( $post->ID, 'medium', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class' => 'pngfix' ) );

					if ( '' != $catchbase_first_image ) {
						$catchbase_page_content .= '
						<figure class="featured-homepage-image">
							<a href="' . get_permalink() . '" title="' . the_title_attribute( array( 'before' => __( 'Permalink to:', 'catch-base' ), 'echo' => false ) ) . '">
								'. $catchbase_first_image .'
							</a>
						</figure>';
					}
				}

				$catchbase_page_content .= '
					<div class="entry-container">
						<header class="entry-header">
							<h1 class="entry-title">
								<a href="' . get_permalink() . '" rel="bookmark">' . the_title( '','', false ) . '</a>
							</h1>
						</header>';
						if ( 'excerpt' == $show_content ) {
							$catchbase_page_content .= '<div class="entry-excerpt"><p>' . $excerpt . '</p></div><!-- .entry-excerpt -->';
						}
						elseif ( 'full-content' == $show_content ) { 
							$content = apply_filters( 'the_content', get_the_content() );
							$content = str_replace( ']]>', ']]&gt;', $content );
							$catchbase_page_content .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
						}
					$catchbase_page_content .= '
					</div><!-- .entry-container -->
				</article><!-- .featured-post-'. $i .' -->';
		endwhile;

		wp_reset_query();
	}		
	
	return $catchbase_page_content;
}
endif; // catchbase_page_content


if ( ! function_exists( 'catchbase_category_content' ) ) :
/**
 * This function to display featured category content
 *
 * @param $options: catchbase_theme_options from customizer
 *
 * @since Catch Base 1.0
 */
function catchbase_category_content( $options ) {
	global $post;

	$quantity 		= $options [ 'featured_content_number' ];
	
	$more_link_text	= $options['excerpt_more_text'];
	
	$category_list	=	array_filter( $options['featured_content_select_category']);
	
	$show_content	= isset( $options['featured_content_show'] ) ? $options['featured_content_show'] : 'excerpt';

	$catchbase_category_content = '';

	$get_featured_posts = new WP_Query( array(
		'posts_per_page'		=> $quantity,
		'category__in'			=> $category_list,
		'ignore_sticky_posts' 	=> 1 // ignore sticky posts
	));

	$i=0; 
	while ( $get_featured_posts->have_posts()) : $get_featured_posts->the_post(); $i++;
		$title_attribute = the_title_attribute( array( 'before' => __( 'Permalink to:', 'catch-base' ), 'echo' => false ) );
		$excerpt = get_the_excerpt();
		$catchbase_category_content .= '
			<article id="featured-post-' . $i . '" class="post hentry featured-category-content">';	
			if ( has_post_thumbnail() ) {
				$catchbase_category_content .= '
				<figure class="featured-homepage-image">
					<a href="' . get_permalink() . '" title="' . the_title_attribute( array( 'before' => __( 'Permalink to:', 'catch-base' ), 'echo' => false ) ) . '">
					'. get_the_post_thumbnail( $post->ID, 'medium', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class' => 'pngfix' ) ) .'
					</a>
				</figure>';
			}
			else {
					$catchbase_first_image = catchbase_get_first_image( $post->ID, 'medium', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ), 'class' => 'pngfix' ) );

					if ( '' != $catchbase_first_image ) {
						$catchbase_category_content .= '
						<figure class="featured-homepage-image">
							<a href="' . get_permalink() . '" title="' . the_title_attribute( array( 'before' => __( 'Permalink to:', 'catch-base' ), 'echo' => false ) ) . '">
								'. $catchbase_first_image .'
							</a>
						</figure>';
					}
				}

			$catchbase_category_content .= '
				<div class="entry-container">
					<header class="entry-header">
						<h1 class="entry-title">
							<a href="' . get_permalink() . '" rel="bookmark">' . the_title( '','', false ) . '</a>
						</h1>
					</header>';
					if ( 'excerpt' == $show_content ) {
						$catchbase_category_content .= '<div class="entry-excerpt"><p>' . $excerpt . '</p></div><!-- .entry-excerpt -->';
					}
					elseif ( 'full-content' == $show_content ) { 
						$content = apply_filters( 'the_content', get_the_content() );
						$content = str_replace( ']]>', ']]&gt;', $content );
						$catchbase_category_content .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
					}
				$catchbase_category_content .= '
				</div><!-- .entry-container -->
			</article><!-- .featured-post-'. $i .' -->';
	endwhile;

	wp_reset_query();	
	return $catchbase_category_content;
}
endif; // catchbase_category_content


if ( ! function_exists( 'catchbase_image_content' ) ) :
/**
 * This function to display featured posts content
 *
 * @get the data value from theme options
 * @displays on the index
 *
 * @useage Featured Image, Title and Excerpt of Post
 *
 * @uses set_transient
 *
 * @since Catch Base 1.0v
 */
function catchbase_image_content( $options ) {	
	$quantity 		= $options [ 'featured_content_number' ];
	
	$more_link_text	= $options['excerpt_more_text'];
	
	$show_content	= isset( $options['featured_content_show'] ) ? $options['featured_content_show'] : 'excerpt';

	$catchbase_image_content = '';

	for ( $i = 1; $i <= $quantity; $i++ ) {
		if ( !empty ( $options[ 'featured_content_target_' . $i ] ) ) {
			$target = '_blank';
		} else {
			$target = '_self';
		}
		
		//Checking Link
		if ( !empty ( $options[ 'featured_content_link_' . $i ] ) ) {
			//support qTranslate plugin
			if ( function_exists( 'qtrans_convertURL' ) ) {
				$link = qtrans_convertURL( $options[ 'featured_content_link_' . $i ] );
			}
			else {
				$link =  esc_url ( $options[ 'featured_content_link_' . $i ] );
			}
		} 
		else {
			$link = '#';
		}
			
		//Checking Title
		if ( !empty ( $options[ 'featured_content_title_'. $i ] ) ) {
			$title = esc_attr( $options[ 'featured_content_title_'. $i ] );
		} 
		else {
			$title = '';
		}		

		//Checking Content
		if ( !empty ( $options[ 'featured_content_content_'. $i ] ) ) {
			$content = $options[ 'featured_content_content_'. $i ];
		} 
		else {
			$content = '';
		}	

		$catchbase_image_content .= '
		<article id="featured-post-'.$i.'" class="post hentry featured-image-content">';
			if ( !empty ( $options[ 'featured_content_image_' . $i ] ) ) {
				$catchbase_image_content .= '
				<figure class="featured-homepage-image">
					<a title="'.$title.'" href="'.$link.'" target="'.$target.'">
						<img src="'. $options[ 'featured_content_image_' . $i ] .'" class="wp-post-image" alt="'.$title.'" title="'.$title.'">
					</a>
				</figure>';  
			}
			if ( $title != '' || $content!='' ) {
				$catchbase_image_content .= '
				<div class="entry-container">';
					if ( $title != '' ) { 
						$catchbase_image_content .= '
						<header class="entry-header">
							<h1 class="entry-title">
								<a href="'.$link.'" rel="bookmark" target="'.$target.'">'.$title.'</a>
							</h1>
						</header>';
					}
					if ( 'hide-content' != $show_content ) {
						if ( '' != $content )  {
							$catchbase_image_content .= '
							<div class="entry-content"><p>
								' . $content . '
							</p></div>';
						}
					}
				$catchbase_image_content .= '
				</div><!-- .entry-container -->';	
			}
		$catchbase_image_content .= '			
		</article><!-- .featured-post-'.$i.' -->'; 

	}
	return $catchbase_image_content;
}
endif; //catchbase_image_content	