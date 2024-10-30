<?php

function wp_law_firm_three_cta_shortcode($atts = '')
{
    $value = shortcode_atts(array(
        'title1' => 'High Success Rate',
        'content1' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the',
        'link1' => '#',
        'image1' =>  plugin_dir_url( __FILE__ ) . 'img/img-1.png',
        
        'title2' => 'High Success Rate',
        'content2' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the',
        'link2' => '#',
        'image2' => plugin_dir_url( __FILE__ ) . 'img/img-2.png',

        'title3' => 'High Success Rate',
        'content3' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the',
        'link3' => '#',
        'image3' => plugin_dir_url( __FILE__ ) . 'img/img-3.png'
    ), $atts);

    $output = '<section class="abilities-block">';
    $output .= '<div class="llf-container py-0">';
    $output .= '<div class="main-block d-flex flex-wrap justify-content-center">';

    $output .= '<a class="inner-block justify-content-between" href="' . $value['link1'] . '">';
    $output .= '<div class="d-flex justify-content-between align-items-center">';
    $output .= '<div class="img">';
    $output .= '<img class="lozad" data-src="' . $value['image1'] . '" alt="Ability Image">';
    $output .= '</div>';
    $output .= '<div class="content">';
    $output .= '<h3 class="mb-0 text-uppercase text-white">' . $value['title1'] . '</h3>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="main-content mt-3">';
    $output .= '<p class="text-white">' . $value['content1'] . '</p>';
    $output .= '</div>';
    $output .= '</a>';

    $output .= '<a class="inner-block justify-content-between" href="' . $value['link2'] . '">';
    $output .= '<div class="d-flex justify-content-between align-items-center">';
    $output .= '<div class="img">';
    $output .= '<img class="lozad" data-src="' . $value['image2'] . '" alt="Ability Image">';
    $output .= '</div>';
    $output .= '<div class="content">';
    $output .= '<h3 class="mb-0 text-uppercase text-white">' . $value['title2'] . '</h3>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="main-content mt-3">';
    $output .= '<p class="text-white">' . $value['content2'] . '</p>';
    $output .= '</div>';
    $output .= '</a>';

    $output .= '<a class="inner-block justify-content-between" href="' . $value['link3'] . '">';
    $output .= '<div class="d-flex justify-content-between align-items-center">';
    $output .= '<div class="img">';
    $output .= '<img class="lozad" data-src="' . $value['image3'] . '" alt="Ability Image">';
    $output .= '</div>';
    $output .= '<div class="content">';
    $output .= '<h3 class="mb-0 text-uppercase text-white">' . $value['title3'] . '</h3>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="main-content mt-3">';
    $output .= '<p class="text-white">' . $value['content3'] . '</p>';
    $output .= '</div>';
    $output .= '</a>';

    $output .= '</div>';
    $output .= '</div>';
    $output .= '</section>';

    return $output;
}

add_shortcode('3_CTA', 'wp_law_firm_three_cta_shortcode');
