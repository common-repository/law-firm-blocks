<?php

function wp_law_firm_logo_slider_shortcode($atts)
{
    $default_images = implode(',', [plugin_dir_url( __FILE__ ) . '/img/logo-img-1.png', plugin_dir_url( __FILE__ ) . '/img/logo-img-2.png', plugin_dir_url( __FILE__ ) . '/img/logo-img-3.png', plugin_dir_url( __FILE__ ) . '/img/logo-img-4.png']);

    $value = shortcode_atts(array(
        'image_urls' => $default_images,
        'links'   => '#, #, #, #'
    ), $atts);

    $output = '';

    // Create our array of values
    // First, sanitize the data and remove white spaces
    $no_whitespaces_image_urls = preg_replace('/\s*,\s*/', ',', filter_var($value['image_urls'], FILTER_SANITIZE_STRING));
    $image_urls_array = explode(',', $no_whitespaces_image_urls);

    $no_whitespaces_links = preg_replace('/\s*,\s*/', ',', filter_var($value['links'], FILTER_SANITIZE_STRING));
    $links_array = explode(',', $no_whitespaces_links);

    // We need to make sure that our two arrays are exactly the same length before we continue
    if (count($image_urls_array) != count($links_array)) {
        return $output;
    }

    // We now need to combine the two arrays, ids will be keys and text will be value in our new arrays
    $combined_array = array_combine($image_urls_array, $links_array);

    $output .= '<section class="partner-slider">';
    $output .= '<div class="llf-container">';
    $output .= '<div class="carousel-wrap">';
    $output .= '<div class="owl-carousel logo-slider">';

    foreach ($combined_array as $image_url => $link) :

        $output .= '<div class="item">';
        $output .= '<a href="' . $link . '" target="_blank" rel="noopener noreferrer">';
        $output .= '<img src="' . $image_url . '" alt="Logo Image" />';
        $output .= '</a>';
        $output .= '</div>';

    endforeach;

    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</section>';

    return $output;
}

add_shortcode('LOGO_SLIDER', 'wp_law_firm_logo_slider_shortcode');
