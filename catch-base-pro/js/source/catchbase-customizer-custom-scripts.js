/**
 * Theme Customizer custom scripts
 * Control of show/hide events on feature slider type selection
 */
(function($) {

    /*
     * For Featured Content on featured_content_type change event
     */
    $("#customize-control-catchbase_theme_options-featured_content_type label select").live( "change", function() {
        var value = $(this).val();

        if (value == 'demo-featured-content') {
            $('#customize-control-catchbase_theme_options-featured_content_number').hide();
            $('#customize-control-catchbase_theme_options-featured_content_headline').hide();
            $('#customize-control-catchbase_theme_options-featured_content_subheadline').hide();
            $('#customize-control-catchbase_theme_options-featured_content_show').hide();
        } else {
            $('#customize-control-catchbase_theme_options-featured_content_number').show();
            $('#customize-control-catchbase_theme_options-featured_content_headline').show();
            $('#customize-control-catchbase_theme_options-featured_content_subheadline').show();
            $('#customize-control-catchbase_theme_options-featured_content_show').show();
        }

        if( value == 'featured-post-content' ) {
            $('[id*=customize-control-catchbase_featured_content_post]').show();
        }
        else {
            $('[id*=customize-control-catchbase_featured_content_post]').hide();
        }
        
        if( value == 'featured-page-content' ) {
            $('[id*=customize-control-catchbase_featured_content_page]').show();
        }
        else {
            $('[id*=customize-control-catchbase_featured_content_page]').hide();
        }
        
        if( value == 'featured-category-content' ) {
            $('#customize-control-catchbase_featured_content_select_category').show();
        }
        else {
            $('#customize-control-catchbase_featured_content_select_category').hide();
        }

        if( value == 'featured-image-content' ) {
            $('[id*=customize-control-featured_content_note]').show();
            $('[id*=customize-control-featured_content_image]').show();
            $('[id*=customize-control-catchbase_theme_options-featured_content_link]').show();
            $('[id*=customize-control-catchbase_theme_options-featured_content_target]').show();
            $('[id*=customize-control-catchbase_theme_options-featured_content_title]').show();
            $('[id*=customize-control-catchbase_theme_options-featured_content_content]').show();
        }
        else {
            $('[id*=customize-control-featured_content_note]').hide();
            $('[id*=customize-control-featured_content_image]').hide();
            $('[id*=customize-control-catchbase_theme_options-featured_content_link]').hide();
            $('[id*=customize-control-catchbase_theme_options-featured_content_target]').hide();
            $('[id*=customize-control-catchbase_theme_options-featured_content_title]').hide();
            $('[id*=customize-control-catchbase_theme_options-featured_content_content]').hide();
        }
    });

    /**
     * Control of show/hide events on feature content type selection on panel click if prevously value has been saved
     */
    $('#accordion-panel-catchbase_featured_content_options .accordion-section-title').live( "click", function() {
        var value = $("#customize-control-catchbase_theme_options-featured_content_type label select").val();
        
        if (value == 'demo-featured-content') {
            $('#customize-control-catchbase_theme_options-featured_content_number').hide();
            $('#customize-control-catchbase_theme_options-featured_content_headline').hide();
            $('#customize-control-catchbase_theme_options-featured_content_subheadline').hide();
            $('#customize-control-catchbase_theme_options-featured_content_show').hide();
        } else {
            $('#customize-control-catchbase_theme_options-featured_content_number').show();
            $('#customize-control-catchbase_theme_options-featured_content_headline').show();
            $('#customize-control-catchbase_theme_options-featured_content_subheadline').show();
            $('#customize-control-catchbase_theme_options-featured_content_show').show();
        }

       if( value == 'featured-post-content' ) {
            $('[id*=customize-control-catchbase_featured_content_post]').show();
        }
        else {
            $('[id*=customize-control-catchbase_featured_content_post]').hide();
        }
        
        if( value == 'featured-page-content' ) {
            $('[id*=customize-control-catchbase_featured_content_page]').show();
            }
        else {
            $('[id*=customize-control-catchbase_featured_content_page]').hide();
        }
        
        if( value == 'featured-category-content' ) {
            $('#customize-control-catchbase_featured_content_select_category').show();
        }
        else {
            $('#customize-control-catchbase_featured_content_select_category').hide();
        }

        if( value == 'featured-image-content' ) {
            $('[id*=customize-control-featured_content_note]').show();
            $('[id*=customize-control-featured_content_image]').show();
            $('[id*=customize-control-catchbase_theme_options-featured_content_link]').show();
            $('[id*=customize-control-catchbase_theme_options-featured_content_target]').show();
            $('[id*=customize-control-catchbase_theme_options-featured_content_title]').show();
            $('[id*=customize-control-catchbase_theme_options-featured_content_content]').show();
        }
        else {
            $('[id*=customize-control-featured_content_note]').hide();
            $('[id*=customize-control-featured_content_image]').hide();
            $('[id*=customize-control-catchbase_theme_options-featured_content_link]').hide();
            $('[id*=customize-control-catchbase_theme_options-featured_content_target]').hide();
            $('[id*=customize-control-catchbase_theme_options-featured_content_title]').hide();
            $('[id*=customize-control-catchbase_theme_options-featured_content_content]').hide();
        }
    });

    /*
     * For Feature Slider on featured_slider_type click event
     */

    $('#accordion-panel-catchbase_featured_slider .accordion-section-title').live( "click", function() {
        var value = $("#customize-control-catchbase_featured_slider_type label select").val();

        if (value == 'demo-featured-slider') {
            $('#customize-control-catchbase_featured_slide_number').hide();
        } else {
            $('#customize-control-catchbase_featured_slide_number').show();
        }

        if( value == 'featured-post-slider' ) {
            $('[id*=customize-control-catchbase_featured_slider_post]').show();
            $('[id*=customize-control-catchbase_theme_options-exclude_slider_post]').show();
        }
        else {
            $('[id*=customize-control-catchbase_featured_slider_post]').hide();
            $('[id*=customize-control-catchbase_theme_options-exclude_slider_post]').hide();
        }

        if( value == 'featured-page-slider' ) {
            $('[id*=customize-control-catchbase_featured_slider_page]').show();
        }
        else {
            $('[id*=customize-control-catchbase_featured_slider_page]').hide();
        }

        if( value == 'featured-category-slider' ) {
            $('#customize-control-catchbase_featured_slider_select_category').show();
        }
        else {
            $('#customize-control-catchbase_featured_slider_select_category').hide();
        }

        if( value == 'featured-image-slider' ) {
            $('[id*=customize-control-featured_slider_image]').show();
            $('[id*=customize-control-catchbase_theme_options-featured_link]').show();
            $('[id*=customize-control-featured_slider_image]').show();
            $('[id*=customize-control-catchbase_theme_options-featured_link]').show();
            $('[id*=customize-control-featured_slider_note]').show();
            $('[id*=customize-control-catchbase_theme_options-featured_target]').show();
            $('[id*=customize-control-catchbase_theme_options-featured_title]').show();
            $('#accordion-section-catchbase_featured_slider [id*=customize-control-catchbase_theme_options-featured_content]').show();
        }
        else {
            $('[id*=customize-control-featured_slider_image]').hide();
            $('[id*=customize-control-catchbase_theme_options-featured_link]').hide();
            $('[id*=customize-control-featured_slider_note]').hide();
            $('[id*=customize-control-catchbase_theme_options-featured_target]').hide();
            $('[id*=customize-control-catchbase_theme_options-featured_title]').hide();
            $('#accordion-section-catchbase_featured_slider [id*=customize-control-catchbase_theme_options-featured_content]').hide();
        }

    });

    $("#customize-control-catchbase_featured_slider_type label select").live( "change", function() {
        var value = $(this).val();

        if (value == 'demo-featured-slider') {
            $('#customize-control-catchbase_featured_slide_number').hide();
        } else {
            $('#customize-control-catchbase_featured_slide_number').show();
        }

        if( value == 'featured-post-slider' ) {
            $('[id*=customize-control-catchbase_featured_slider_post]').show();
            $('[id*=customize-control-catchbase_theme_options-exclude_slider_post]').show();
        }
        else {
            $('[id*=customize-control-catchbase_featured_slider_post]').hide();
            $('[id*=customize-control-catchbase_theme_options-exclude_slider_post]').hide();
        }

        if( value == 'featured-page-slider' ) {
            $('[id*=customize-control-catchbase_featured_slider_page]').show();
        }
        else {
            $('[id*=customize-control-catchbase_featured_slider_page]').hide();
        }

        if( value == 'featured-category-slider' ) {
            $('#customize-control-catchbase_featured_slider_select_category').show();
        }
        else {
            $('#customize-control-catchbase_featured_slider_select_category').hide();
        }

        if( value == 'featured-image-slider' ) {
            $('[id*=customize-control-featured_slider_image]').show();
            $('[id*=customize-control-catchbase_theme_options-featured_link]').show();
            $('[id*=customize-control-featured_slider_image]').show();
            $('[id*=customize-control-catchbase_theme_options-featured_link]').show();
            $('[id*=customize-control-featured_slider_note]').show();
            $('[id*=customize-control-catchbase_theme_options-featured_target]').show();
            $('[id*=customize-control-catchbase_theme_options-featured_title]').show();
            $('#accordion-section-catchbase_featured_slider [id*=customize-control-catchbase_theme_options-featured_content]').show();
        }
        else {
            $('[id*=customize-control-featured_slider_image]').hide();
            $('[id*=customize-control-catchbase_theme_options-featured_link]').hide();
            $('[id*=customize-control-featured_slider_note]').hide();
            $('[id*=customize-control-catchbase_theme_options-featured_target]').hide();
            $('[id*=customize-control-catchbase_theme_options-featured_title]').hide();
            $('#accordion-section-catchbase_featured_slider [id*=customize-control-catchbase_theme_options-featured_content]').hide();
        }

    });


    //For Color Scheme Change
    $("#customize-control-catchbase_theme_options-color_scheme").live( "change", function() {
        var catchbase_color_scheme = $('#customize-control-catchbase_theme_options-color_scheme input:checked').val();
        
        if ( 'dark' == catchbase_color_scheme ) {
            $('#customize-control-background_color .color-picker-hex').iris('color', '#111111');
            $('#customize-control-header_textcolor .color-picker-hex').iris('color', '#dddddd');
        }
        else {
            $('#customize-control-background_color .color-picker-hex').iris('color', '#f2f2f2');
            $('#customize-control-header_textcolor .color-picker-hex').iris('color', '#404040');
        }

        $.each( catchbase_color_list, function( index, value ) {
            if ( 'light' == catchbase_color_scheme ) {
                $( '#customize-control-catchbase_theme_options-'+ index +' .color-picker-hex').iris('color', value.light );
            }
            else if ( 'dark' == catchbase_color_scheme ) {
                $( '#customize-control-catchbase_theme_options-'+ index +' .color-picker-hex').iris('color', value.dark );
            }
        });
    });
})(jQuery);