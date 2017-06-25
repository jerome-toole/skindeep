<?php

/**
 * @brief      Top-level function that should be called upon initialisation to
 *             install support for ithemes in the Skin Deep theme
 *
 * @return     None
 */
function install_ithemes_support() {
    add_custom_ithemes_fields();
    install_shop_image_sizes();
    add_shipping_to_memberships();
}

/**
 * @brief      Adds custom ithemes fields.
 *
 * @return     None
 */
function add_custom_ithemes_fields() {
    if(function_exists("register_field_group"))
    {
        // iThemes Exchange product category image
        register_field_group(array (
            'id' => 'acf_ithemes-product-category',
            'title' => 'iThemes Product Category',
            'fields' => array (
                array (
                    'key' => 'field_591178033d922',
                    'label' => 'Image',
                    'name' => 'image',
                    'type' => 'image',
                    'save_format' => 'object',
                    'preview_size' => 'thumbnail',
                    'library' => 'all',
                ),
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'ef_taxonomy',
                        'operator' => '==',
                        'value' => 'it_exchange_category',
                        'order_no' => 0,
                        'group_no' => 0,
                    ),
                ),
            ),
            'options' => array (
                'position' => 'normal',
                'layout' => 'no_box',
                'hide_on_screen' => array (
                ),
            ),
            'menu_order' => 0,
        ));
    }
}

function install_shop_image_sizes() {
    add_image_size("shop_catalog", 300, 300, true);
    add_image_size("shop_single", 600, 600, true);
}

function it_product_category_image($post_id, $size="shop_catalog") {
    // Pull out the ACF image
    if (function_exists('get_field'))
    {
        $image = get_field('image', $post_id);
        if( !empty($image) ) {

            // vars
            $alt = $image['alt'];
            $caption = $image['caption'];

            // thumbnail
            $src = $image['sizes'][ $size ];
            $width = $image['sizes'][ $size . '-width' ];
            $height = $image['sizes'][ $size . '-height' ];

            printf('<img src="%s" alt="%s" width="%d" height="%d" />', $src, $alt, $width, $height);
        }
    }
}

function it_get_image($size)
{
    $image = it_exchange('product', 'get-images')[0][$size];
    $src = $image[0];
    $width = $image[1];
    $height = $image[2];
    printf('<img src="%s" width="%d" height="%d" />', $src, $width, $height);
}

/**
 * @brief      Disables the jetpack infinite scroll conditionally.
 *
 * @return     None
 */
function jetpack_remove_inifite_scroll_conditionally() {
    if (it_exchange_is_page( 'store' )) {
        remove_theme_support( 'infinite-scroll' );
    }
}
add_action( 'template_redirect', 'jetpack_remove_inifite_scroll_conditionally', 9);

/**
 * @brief      Adds the shipping feature to memberships
 *
 *             This is important as otherwise no shipping address is gathered
 *             from a customer, nor can shipping be applied for international
 *             customers
 *
 * @return     None
 */
function add_shipping_to_memberships() {
    it_exchange_add_feature_support_to_product_type( 'shipping', 'membership-product-type' );
}

?>
