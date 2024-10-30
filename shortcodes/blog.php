<?php

function wp_law_firm_blog_area_shortcode($atts = '')
{
    $value = shortcode_atts(array(
        'title' => 'Our New Blog',
        'view_all_link' => '#'
    ), $atts);

    $args = array('numberposts' => 3);
    $latest_posts = get_posts($args);
    $latestPost1 = $latest_posts[0];
    $latestPost2 = $latest_posts[1];
    $latestPost3 = $latest_posts[2];
    $image1 = get_the_post_thumbnail_url($latestPost1->ID) ?: plugin_dir_url( __FILE__ ) . '/img/banner-img.png';
    $image2 = get_the_post_thumbnail_url($latestPost2->ID) ?: plugin_dir_url( __FILE__ ) . '/img/banner-img.png';
    $image3 = get_the_post_thumbnail_url($latestPost3->ID) ?: plugin_dir_url( __FILE__ ) . '/img/banner-img.png';
    $category2 = get_the_category($latestPost2->ID);
    $category3 = get_the_category($latestPost3->ID);

    $output = '';
    $output .= '<section class="blog">
        <div class="llf-container">
            <h2 class="text-center">' . $value['title'] . '</h2>
            <div class="main-block d-flex justify-content-between flex-wrap mt-5">';

    $output  .= '<div class="latest-blog">
                            <div>
                                <a href="' . get_the_permalink($latestPost1->ID) . '" style="background-image: url(' . $image1 . ');">
                                    <p class="text-white">' . get_the_title($latestPost1->ID) . '</p>
                                    <div class="d-flex">
                                        <p class="text-white">' . get_the_author_meta('display_name') . '</p>
                                        <span class="px-2 text-white">|</span>
                                        <p class="text-white">' . get_the_date("d F Y", $latestPost1->ID) . '</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="mulit-blog">
                <div class="d-flex inner-block flex-wrap justify-content-between">
                    <div class="img">
                        <a href="' . get_the_permalink($latestPost2->ID) . '" class="w-100 h-100">
                            <img class="lozad" data-src="' . $image2 . '" alt="Practice Image">
                        </a>
                    </div>
                    <div class="content">
                        <p class="mb-0"><a href="' . get_the_permalink($latestPost2->ID) . '">' . get_the_title($latestPost2->ID) . '</a></p>';
    foreach ($category2 as $cat) {
        $output .= '<a class="tag" href="' . get_category_link($cat->term_id) . '">' . $cat->name . '</a>';
    }
    $output .= '<p>
                            <a class="pointer-none" href="#">' . get_the_author_meta('display_name') . '</a>
                            <span class="px-2">|</span>
                            <a class="pointer-none" href="#">' . get_the_date("d F Y", $latestPost2->ID) . '</a>
                        </p>
                    </div>
                </div>
                <div class="d-flex inner-block flex-wrap justify-content-between">
                    <div class="img">
                        <a href="' . get_the_permalink($latestPost3->ID) . '" class="w-100 h-100">
                            <img class="lozad" data-src="' . $image3 . '" alt="Practice Image">
                        </a>
                    </div>
                    <div class="content">
                        <p class="mb-0"><a href="' . get_the_permalink($latestPost3->ID) . '">' . get_the_title($latestPost3->ID) . '</a></p>';
    foreach ($category3 as $cat) {
        $output .= '<a class="tag" href="' . get_category_link($cat->term_id) . '">' . $cat->name . '</a>';
    }
    $output .= '<p>
                        <a class="pointer-none" href="#">' . get_the_author_meta('display_name') . '</a>
                        <span class="px-2">|</span>
                        <a class="pointer-none" href="#">' . get_the_date("d F Y", $latestPost3->ID) . '</a>
                    </p>
                    </div>
                </div>
            </div>';
    $output .= '</div>
        <div class="text-center mt-5">
            <a href="' . $value['view_all_link'] . '" class="btn-primary">View all</a>
        </div>
    </div>
</section>';

    return $output;
}

add_shortcode('BLOG_AREA', 'wp_law_firm_blog_area_shortcode');
