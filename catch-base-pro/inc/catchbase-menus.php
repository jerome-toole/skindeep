<?php
/**
 * The template for displaying custom menus
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


if ( ! function_exists( 'catchbase_primary_menu' ) ) :
/**
 * Shows the Primary Menu 
 *
 * default load in sidebar-header-right.php
 */
function catchbase_primary_menu() {
    $options  = catchbase_get_theme_options();
    if ( !$options['primary_menu_disable'] ) :
    	?>
    	<nav class="nav-primary <?php echo ( !$options['primary_search_disablhee']  ) ? 'search-enabled' : '';?>" role="navigation">
            <h1 class="assistive-text"><?php _e( 'Primary Menu', 'catch-base' ); ?></h1>
            <div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'catch-base' ); ?>"><?php _e( 'Skip to content', 'catch-base' ); ?></a></div>
            <?php
                if ( has_nav_menu( 'primary' ) ) { 
                    $catchbase_primary_menu_args = array(
                        'theme_location'    => 'primary',
                        'menu_class'        => 'menu catchbase-nav-menu',
                        'container'         => false
                    );
                    wp_nav_menu( $catchbase_primary_menu_args );
                }
                else {
                    wp_page_menu( array( 'menu_class'  => 'page-menu-wrap' ) );
                }
                if( !$options['primary_search_disable'] ) :
                    ?>
                    <div id="search-toggle" class="genericon">
                        <a class="screen-reader-text" href="#search-container"><?php _e( 'Search', 'catch-base' ); ?></a>
                    </div>

                    <div id="search-container" class="displaynone">
                        <?php get_Search_form(); ?>
                    </div>
                    <?php
                endif;
                ?>
        </nav><!-- .nav-primary -->
        <?php
    endif;
}
endif; //catchbase_primary_menu
add_action( 'catchbase_header', 'catchbase_primary_menu', 42 );


if ( ! function_exists( 'catchbase_add_page_menu_class' ) ) :
/**
 * Filters wp_page_menu to add menu class  for default page menu
 *
 */    
function catchbase_add_page_menu_class( $ulclass ) {
  return preg_replace( '/<ul>/', '<ul class="menu catchbase-nav-menu">', $ulclass, 1 );
}
endif; //catchbase_add_page_menu_class
add_filter( 'wp_page_menu', 'catchbase_add_page_menu_class' );


if ( ! function_exists( 'catchbase_secondary_menu' ) ) :
/**
 * Shows the Secondary Menu 
 *
 * default load in sidebar-header-right.php
 */
function catchbase_secondary_menu() {
    if ( has_nav_menu( 'secondary' ) ) { 
	?>
    	<nav class="nav-secondary" role="navigation">
            <div class="wrapper">
                <h1 class="assistive-text"><?php _e( 'Secondary Menu', 'catch-base' ); ?></h1>
                <div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'catch-base' ); ?>"><?php _e( 'Skip to content', 'catch-base' ); ?></a></div>
                <?php             
                    $catchbase_secondary_menu_args = array(
                        'theme_location'    => 'secondary',
                        'menu_class' => 'menu catchbase-nav-menu'
                    );
                    wp_nav_menu( $catchbase_secondary_menu_args );
                ?>
        	</div><!-- .wrapper -->
        </nav><!-- .nav-secondary -->

<?php
    }
}
endif; //catchbase_secondary_menu
add_action( 'catchbase_after_header', 'catchbase_secondary_menu', 30 );


if ( ! function_exists( 'catchbase_footer_menu' ) ) :
/**
 * Shows the Footer Menu 
 *
 * default load in sidebar-header-right.php
 */
function catchbase_footer_menu() {
	if ( has_nav_menu( 'footer' ) ) { 
    ?>
	<nav class="nav-footer" role="navigation">
        <div class="wrapper">
            <h1 class="assistive-text"><?php _e( 'Footer Menu', 'catch-base' ); ?></h1>
            <div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'catch-base' ); ?>"><?php _e( 'Skip to content', 'catch-base' ); ?></a></div>
            <?php                
                $catchbase_footer_menu_args = array(
                    'theme_location'    => 'footer',
                    'menu_class' => 'menu catchbase-nav-menu'
                );
                wp_nav_menu( $catchbase_footer_menu_args );
            ?>
    	</div><!-- .wrapper -->
    </nav><!-- .nav-footer -->
<?php
    }
}
endif; //catchbase_footer_menu
add_action( 'catchbase_footer', 'catchbase_footer_menu', 10 );


if ( ! function_exists( 'catchbase_mobile_menus' ) ) :
/**
 * This function loads Mobile Menus
 *
 * @get the data value from theme options
 * @uses catchbase_after action to add the code in the footer
 */
function catchbase_mobile_menus() {
    //Getting Ready to load options data
    $options                    = catchbase_get_theme_options();

    if ( '1' == $options['responsive_select'] ) {
        return;
    }

    // Check Header Left Mobile Menu
   if ( '1' != $options['primary_menu_disable'] ) :
       $count = '1';
       $location = 'primary';
   elseif ( has_nav_menu( 'secondary' ) ) :
       $count = '1';
       $location = 'secondary';
   elseif ( has_nav_menu( 'header-right' ) ) :
       $count = '1';
       $location = 'header-right';    
   elseif ( '1' != $options['primary_menu_disable'] ) :
       $count = '0';
       $location = 'none';  
   else :
       $count = '2';
       $location = 'none';
   endif;

   if ( '0' == $count ) {
        return;
   }
    
    echo '<nav id="mobile-header-left-nav" class="mobile-menu" role="navigation">';
        if ( $count == '1' ) :
            $args = array(
                'theme_location'    => $location,
                'container'         => false,
                'items_wrap'        => '<ul id="header-left-nav" class="menu">%3$s</ul>'
            );
            wp_nav_menu( $args );
        else :
            wp_page_menu( array( 'menu_class'  => 'menu' ) );
        endif;
    echo '</nav><!-- #mobile-header-left-nav -->';


    // Check Header Right Mobile Menu ( only for Header right and Secondary )
    if ( ( '1' != $options['primary_menu_disable'] &&  has_nav_menu( 'header-right' ) ) || ( has_nav_menu( 'secondary' ) &&  has_nav_menu( 'header-right' ) ) ) :
        $count2 = '1';
        $location2 = 'header-right';
    elseif ( has_nav_menu( 'primary' ) && has_nav_menu( 'secondary' ) ) :
        $count2 = '1';
        $location2 = 'secondary';
    else :
        $count2 = '0';
        $location2 = 'none';
    endif;

    if ( $count2 == '1' ) :
        echo '<nav id="mobile-header-right-nav" class="mobile-menu" role="navigation">';
            $args = array(
                'theme_location'    => $location2,
                'container'         => false,
                'items_wrap'        => '<ul id="header-right-nav" class="menu">%3$s</ul>'
            );
            wp_nav_menu( $args );
        echo '</nav><!-- #mobile-header-right-nav -->';
    endif;

    // Check Secondary Menu
    if ( has_nav_menu( 'primary' ) &&  has_nav_menu( 'secondary' ) &&  has_nav_menu( 'header-right' ) ) :
        echo '<nav id="mobile-secondary-nav" class="mobile-menu" role="navigation">';
            $args = array(
                'theme_location'    => 'secondary',
                'container'         => false,
                'items_wrap'        => '<ul id="secondary-nav" class="menu">%3$s</ul>'
            );
            wp_nav_menu( $args );
        echo '</nav><!-- #mobile-secondary-nav -->';
    endif;

    // Check Footer Menu
    if ( has_nav_menu( 'footer' ) && '1' != $options['footer_mobile_menu_disable'] ) :
        echo '<nav id="mobile-footer-nav" class="mobile-menu" role="navigation">';
            $args = array(
                'theme_location'    => 'footer',
                'container'         => false,
                'items_wrap'        => '<ul id="footer-nav" class="menu">%3$s</ul>'
            );
            wp_nav_menu( $args );
        echo '</nav><!-- #mobile-footer-nav -->';
    endif;

}
endif; //catchbase_mobile_menus

add_action( 'catchbase_after', 'catchbase_mobile_menus', 20 );


if ( ! function_exists( 'catchbase_mobile_header_nav_anchor' ) ) :
/**
 * This function loads Mobile Menus Left Anchor
 *
 * @get the data value from theme options
 * @uses catchbase_header action to add in the Header
 */
function catchbase_mobile_header_nav_anchor() {
    //Getting Ready to load options data
    $options                    = catchbase_get_theme_options();

    if ( '1' == $options['responsive_select'] ) {
        return;
    }

    if ( '1' == $options['primary_menu_disable'] && !has_nav_menu( 'secondary' ) && !has_nav_menu( 'header-right' ) ) {
        return;
    }

    // Header Left Mobile Menu Anchor 
    if ( '1' != $options['primary_menu_disable'] ) {
        if ( has_nav_menu( 'primary' ) ) {
            $classes = "mobile-menu-anchor primary-menu";
        }
        else {
            $classes = "mobile-menu-anchor page-menu"; 
        }
    }
    elseif ( has_nav_menu( 'secondary' ) ) {
        $classes = "mobile-menu-anchor secondary-menu";
    }
    elseif ( has_nav_menu( 'header-right' ) ) {
        $classes = "mobile-menu-anchor header-right-menu";
    }

    ?>
    
    <div id="mobile-header-left-menu" class="<?php echo $classes; ?>">
        <a href="#mobile-header-left-nav" id="header-left-menu" class="genericon genericon-menu">
            <span class="mobile-menu-text"><?php _e( 'Menu', 'catch-base' );?></span>
        </a>
    </div><!-- #mobile-header-menu -->

    <?php 
    // Header Right Mobile Menu Anchor 
    if ( ( '1' != $options['primary_menu_disable'] &&  has_nav_menu( 'header-right' ) ) || ( has_nav_menu( 'secondary' ) &&  has_nav_menu( 'header-right' ) ) ) {
        $classes = "mobile-menu-anchor header-right-menu";
    }
    elseif ( '1' != $options['primary_menu_disable'] && has_nav_menu( 'secondary' ) ) {
        $classes = "mobile-menu-anchor secondary-menu";
    } 
    else {
        return; 
    }
    ?>
    <div id="mobile-header-right-menu" class="<?php echo $classes; ?>">
        <a href="#mobile-header-right-nav" id="header-right-menu" class="genericon genericon-menu">
            <span class="mobile-menu-text"><?php _e( 'Menu', 'catch-base' );?></span>
        </a>
    </div><!-- #mobile-header-menu -->

    <?php    
}
endif; //catchbase_mobile_menus    
add_action( 'catchbase_header', 'catchbase_mobile_header_nav_anchor', 39 );


if ( ! function_exists( 'catchbase_mobile_secondary_nav_anchor' ) ) :
/**
 * This function loads Mobile Menus Footer Anchor
 *
 * @get the data value from theme options
 * @uses catchbase_header action to add in the Header
 */
function catchbase_mobile_secondary_nav_anchor() {
    //Getting Ready to load options data
    $options = catchbase_get_theme_options();

    if ( '1' == $options['responsive_select'] ) {
        return;
    }

    if ( '1' != $options['primary_menu_disable'] && has_nav_menu( 'secondary' ) && has_nav_menu( 'header-right' ) ) {  
        ?>    
        <div id="mobile-secondary-menu" class="mobile-menu-anchor secondary-menu">
            <a href="#mobile-secondary-nav" id="secondary-menu" class="genericon genericon-menu">
                <span class="mobile-menu-text"><?php _e( 'Menu', 'catch-base' );?></span>
            </a>
        </div><!-- #mobile-header-menu -->
    <?php    
    }
}
endif; //catchbase_mobile_secondary_nav_anchor    
add_action( 'catchbase_header', 'catchbase_mobile_secondary_nav_anchor', 60 );


if ( ! function_exists( 'catchbase_mobile_footer_nav_anchor' ) ) :
/**
 * This function loads Mobile Menus Footer Anchor
 *
 * @get the data value from theme options
 * @uses catchbase_header action to add in the Header
 */
function catchbase_mobile_footer_nav_anchor() {
    //Getting Ready to load options data
    $options = catchbase_get_theme_options();

    if ( '1' == $options['responsive_select'] || '1' == $options['footer_mobile_menu_disable'] )
        return;
    
    ?>
    
    <div id="mobile-footer-menu" class="mobile-menu-anchor footer-menu">
        <a href="#mobile-footer-nav" id="footer-menu" class="genericon genericon-menu">
            <span class="mobile-menu-text"><?php _e( 'Menu', 'catch-base' );?></span>
        </a>
    </div><!-- #mobile-header-menu -->

    <?php    
}
endif; //catchbase_mobile_footer_nav_anchor    
add_action( 'catchbase_footer', 'catchbase_mobile_footer_nav_anchor', 20 );
