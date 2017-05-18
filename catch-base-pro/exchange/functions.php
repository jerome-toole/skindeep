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

    // Allow us to combine downloads and physical products
    add_downloads_to_physical_products();
}
add_action('it_exchange_enabled_addons_loaded', 'install_ithemes_support' );

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

/**
 * @brief      Install image sizes for shop images
 *
 * @return     None
 */
function install_shop_image_sizes() {
    add_image_size("shop_catalog", 300, 300, true);
    add_image_size("shop_single", 600, 600, true);
}

/**
 * @brief      Outputs an image for an iThemes category
 *
 * @param      $taxonomy  The taxonomy
 * @param      $term      The term
 * @param      $size      The image size
 * @param      $post_id   The identifier of the post/taxonomy
 *
 * @return     None
 */
function it_product_category_image($taxonomy, $term, $size="shop_catalog") {
    $post_id = $taxonomy . '_' . $term;

    // Pull out the ACF image
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

/**
 * @brief      Outputs an iThemes product image of any installed sizes
 *
 * @param      $size  The size
 *
 * @return     None
 */
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
    if (it_exchange_is_page() !== false) {
        remove_theme_support( 'infinite-scroll' );
    }
}
add_action( 'template_redirect', 'jetpack_remove_inifite_scroll_conditionally', 9);

/**
 * @brief      Adds the downloads feature to physical products.
 *
 * @return     None
 */
function add_downloads_to_physical_products() {
    it_exchange_add_feature_support_to_product_type( 'downloads', 'physical-product-type' );
}

function add_variant_presets() {
    write_log("Now add!");

    // Create a preset variant for Digital/Print
    $format_preset = array(
        'slug' => 'format',
        'title' => 'Format',
        'values' => array(
            'print' => array(
                'slug' => 'print',
                'title' => 'Print',
                'order' => 1,
            ),
            'digital' => array(
                'slug' => 'digital',
                'title' => 'Digital',
                'order' => 2,
            )
        ),
        'default' => 'print',
        'core' => false,
        'ui-type' => 'select',
        'version' => '0.0.31',
    );
    it_exchange_variants_addon_create_variant_preset($format_preset);
}
add_action( 'admin_init', 'add_variant_presets' );

/**
 * @brief      Determines if the current transaction product is digital.
 * @note       This function should be called while in a loop using
 *             it_exchange('transaction', 'product-downloads')
 *
 * @return     True if transaction product is digital, False otherwise.
 */
function is_transaction_product_digital()
{
    $itemized_data = maybe_unserialize(get_transaction_product_attribute('itemized_data'));

    write_log($itemized_data);

    if ( !empty( $itemized_data['it_variant_combo_hash'] ) )
    {
        // Product is of a particular variant
        $product_id = get_transaction_product_attribute('product_id');
        $atts = it_exchange_get_variant_combo_attributes_from_hash(
            $product_id,
            $itemized_data['it_variant_combo_hash'] );

        if ($atts['title'] == 'Digital')
        {
            return true;
        }
    }
    return false;
}

/**
 * @brief      Gets the product attribute from the current transaction product.
 * @note       This function should be called while in a loop using
 *             it_exchange('transaction', 'product-downloads')
 *
 * @param      $attribute  The attribute to retrieve
 *
 * @return     The transaction product attribute.
 */
function get_transaction_product_attribute($attribute)
{
    $options = array(
        'attribute' => $attribute,
        'format' => '',
        'return' => true
    );
    return it_exchange('transaction', 'product-attribute', $options);
}

?>
