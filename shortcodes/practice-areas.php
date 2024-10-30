<?php

function wp_law_firm_practice_areas_shortcode($atts = '')
{
    $value = shortcode_atts(array(
        'title' => 'Practice Areas',
        'no_of_posts' => 10,
        'view_all_link' => '#'
    ), $atts);

    $output = '<section class="practice">';
    $output .= '<div class="llf-container">';
    $output .= '<h2 class="text-center text-white">' . $value['title'] . '</h2>';
    $output .= '<div class="d-flex flex-wrap pt-5">';

    $practice_args = array('post_type' => 'practice-areas', 'posts_per_page' => $value['no_of_posts']);
    $practice_query = new WP_Query($practice_args);
    if ($practice_query->have_posts()) :
        while ($practice_query->have_posts()) : $practice_query->the_post();
            $icon = plugin_dir_url( __FILE__ ) . '/img/icon-1.png';

            $output .= '<div class="inner-block">';
            $output .= '<a href="' . get_the_permalink() . '">';
            $output .= '<span class="img d-block">';
            $output .= '<img class="lozad" data-src="' . $icon . '" alt="Practice Image" />';
            $output .= '</span>';
            $output .= '<p class="text-white mt-4">' . get_the_title() . '</p>';
            $output .= '</a>';
            $output .= '</div>';
        endwhile;
        wp_reset_postdata();
    endif;

    $output .= '</div>';
    $output .= '<div class="text-center mt-3">';
    $output .= '<a href="' . $value['view_all_link'] . '" class="text-white btn-bg-transparent text-uppercase">View all</a>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</section>';

    return $output;
}

add_shortcode('PRACTICE_AREAS', 'wp_law_firm_practice_areas_shortcode');
