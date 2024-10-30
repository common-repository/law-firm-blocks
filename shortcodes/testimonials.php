<?php

function wp_law_firm_testimonials_shortcode($atts = '')
{
    $value = shortcode_atts(array(
        'title' => 'Testimonials',
        'no_of_posts' => 10
    ), $atts);

    $output = '<section class="testimonials bg-lighter-gray">';
    $output .= '<div class="llf-container">';
    $output .= '<h2 class="text-center">' . $value['title'] . '</h2>';
    $output .= '<div class="carousel-wrap">';
    $output .= '<div class="owl-carousel testimonials-slider mt-5">';

    $testimonials_args = array('post_type' => 'testimonials', 'posts_per_page' => $value['no_of_posts']);
    $testimonials_query = new WP_Query($testimonials_args);
    if ($testimonials_query->have_posts()) :
        while ($testimonials_query->have_posts()) : $testimonials_query->the_post();
            $image = get_the_post_thumbnail_url() ?: plugin_dir_url( __FILE__ ) .  '/img/banner-img.png';
            $post_id = get_the_ID();

            $output .= '<div class="item">';
            $output .= '<div class="img-block">';
            $output .= '<img class="lozad" data-src="' . $image . '" alt="Testimonials Image">';
            $output .= '</div>';
            $output .= '<div class="content text-center mt-5">';
            $output .= '<h2>' . get_the_title() . '</h2>';
            $output .= '<p>';
            $output .= '<img class="lozad" data-src="' . plugin_dir_url( __FILE__ ) . '/img/simbol.png" alt="Quote Image">';
            $output .= '</p>';
            $output .= '<p>' . get_the_content() . '</p>';
            $output .= '<p class="name text-center">' . get_post_meta($post_id, 'testimonial_author', true) . '</p>';
            $output .= '</div>';
            $output .= '</div>';
        endwhile;
        wp_reset_postdata();
    endif;

    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</section>';

    return $output;
}

add_shortcode('TESTIMONIALS_SLIDER', 'wp_law_firm_testimonials_shortcode');
