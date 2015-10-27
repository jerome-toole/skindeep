<?php
/**
 * The Header Right Sidebar containing the header right widget area
 *
 * @package Catch Themes
 * @subpackage Catch Base Pro
 * @since Catch Base 1.0 
 */
?>

<?php 
/** 
 * catchbase_before_header_right hook
 */
do_action( 'catchbase_before_header_right' ); ?>

<aside class="sidebar sidebar-header-right widget-area">
	<?php
	if ( has_nav_menu( 'header-right' ) ) { 
	?>
    	<nav class="nav-header-right" role="navigation">
            <div class="wrapper">
                <h1 class="assistive-text"><?php _e( 'Header Right Menu', 'catch-base' ); ?></h1>
                <div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'catch-base' ); ?>"><?php _e( 'Skip to content', 'catch-base' ); ?></a></div>
                <?php             
                    $catchbase_header_right_menu_args = array(
                        'theme_location'    => 'header-right',
                        'menu_class' => 'menu catchbase-nav-menu'
                    );
                    wp_nav_menu( $catchbase_header_right_menu_args );
                ?>
        	</div><!-- .wrapper -->
        </nav><!-- .nav-secondary -->
	<?php
	}
	
	//Header Right Widgets Sidebar
	if ( is_active_sidebar( 'header-right' ) ) {
	   	dynamic_sidebar( 'header-right' ); 
	}	
	elseif ( !has_nav_menu( 'header-right' ) ) { ?> 
		<?php if ( '' != ( $catchbase_social_icons = catchbase_get_social_icons() ) ) { ?>
			<section class="widget widget_catchbase_social_icons" id="header-right-social-icons">
				<div class="widget-wrap">
					<?php echo $catchbase_social_icons; ?>
				</div><!-- .widget-wrap -->
			</section><!-- #header-right-social-icons -->
		<?php 
			}
        }
	?>
</aside><!-- .sidebar .header-sidebar .widget-area -->

<?php 
/** 
 * catchbase_after_header_right hook
 */
do_action( 'catchbase_after_header_right' ); ?>
