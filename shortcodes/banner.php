<?php

function wp_law_firm_banner_area_shortcode($atts = '')
{
    $cf7_args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => 1);
    $cf7_forms = get_posts($cf7_args);
    $cf7_ids = wp_list_pluck($cf7_forms, 'ID');
    $cf7_default_id = $cf7_ids[0];

    $value = shortcode_atts(array(
        'image' => plugin_dir_url( __FILE__ ) . '/img/banner-img.png',
        'form_title' => 'Get your free legal consultation with a friendly lawyer!',
        'cf7_form_id' => $cf7_default_id
    ), $atts);

    $output = '<section class="home-banner">';
    $output .= '<div class="d-flex justify-content-between flex-wrap">';
    $output .= '<div class="banner-img">';
    $output .= '<img class="lozad" data-src="' . $value['image'] . '" alt="Facility Image" />';
    $output .= '</div>';
    $output .= '<div class="form bg-black">';
    $output .= '<h3 class="text-center">' . $value['form_title'] . '</h3>';
    $output .= do_shortcode('[contact-form-7 id="' . $value['cf7_form_id'] . '" title="Contact form"]');

    if (!class_exists('WPCF7')) {
        $output .= '<div>This section needs the Contact Form 7 plugin installed to display the form. Install + Activate plugin from <a href="wp-admin/admin.php?page=wp-law-firm-doc">here</a>.</div>';
    }

    $output .= '</div>';
    $output .= '</div>';
    $output .= '</section>';

    return $output;
}

add_shortcode('BANNER_AREA', 'wp_law_firm_banner_area_shortcode');
