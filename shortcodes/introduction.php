<?php

function wp_law_firm_introduction_shortcode($atts = '')
{
    $value = shortcode_atts(array(
        'title' => 'This is the title',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in magna et felis laoreet tincidunt vel bibendum metus. Praesent eget laoreet purus. Curabitur rhoncus mattis lacus id sollicitudin. Aliquam efficitur vel orci et auctor.
        Praesent posuere sem odio, quis ultricies augue hendrerit in. Mauris venenatis laoreet pretium. Mauris magna libero, fringilla id tortor at, rhoncus venenatis velit. Fusce efficitur massa nec urna suscipit molestie. Sed eget nisi quam.',
        'button_text' => 'Button Link',
        'button_link' => '#',
        'image' => plugin_dir_url( __FILE__ ) . '/img/banner-img.png'
    ), $atts);

    $output = '<section class="get-in-touch">';
    $output .= '<div class="llf-container">';
    $output .= '<div class="d-flex justify-content-between flex-wrap">';
    $output .= '<div class="text-block">';
    $output .= '<h2>' . $value['title'] . '</h2>';
    $output .= '<div class="content">';
    $output .= '<p>' . $value['content'] . '</p>';
    $output .= '<a href="' . $value['button_link'] . '" class="btn-secondary mt-5">' . $value['button_text'] . '</a>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="img">';
    $output .= '<img class="lozad" data-src="' . $value['image'] . '" alt="Get In Touch Image" />';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</section>';

    return $output;
}

add_shortcode('INTRODUCTION', 'wp_law_firm_introduction_shortcode');
