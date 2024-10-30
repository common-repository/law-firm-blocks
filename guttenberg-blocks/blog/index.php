<?php

/**
 * BLOCK: Blog
 *
 * Gutenberg Custom Blog Block assets.
 *
 * @since   1.0.0
 * @package OPB
 */

defined('ABSPATH') || exit;

/**
 * Enqueue the block's assets for the editor.
 *
 * `wp-blocks`: Includes block type registration and related functions.
 * `wp-element`: Includes the WordPress Element abstraction for describing the structure of your blocks.
 * `wp-i18n`: To internationalize the block's text.
 *
 * @since 1.0.0
 */
function wp_law_firm_blog_block()
{
    if (!function_exists('register_block_type')) {
        // Gutenberg is not active.
        return;
    }

    // Scripts.
    wp_enqueue_script(
        'wp-law-firm-blog-block-script', // Handle.
        plugin_dir_url( __FILE__ ) . 'block.js', // Block.js: We register the block here.
        array('wp-blocks', 'wp-components', 'wp-element', 'wp-i18n', 'wp-editor'), // Dependencies, defined above.
        filemtime(plugin_dir_path(__FILE__) . 'block.js'),
        true // Load script in footer.
    );

    // Styles.
    wp_register_style(
        'wp-law-firm-blog-block-editor-style', // Handle.
        plugin_dir_url( __FILE__ ) . 'editor.css', // Block editor CSS.
        array('wp-edit-blocks'), // Dependency to include the CSS after it.
        filemtime(plugin_dir_path(__FILE__) . 'editor.css')
    );
    wp_register_style(
        'wp-law-firm-blog-block-frontend-style', // Handle.
        plugin_dir_url( __FILE__ ) . 'style.css', // Block editor CSS.
        array(), // Dependency to include the CSS after it.
        filemtime(plugin_dir_path(__FILE__) . 'style.css')
    );

    register_block_type('wplawfirm/blog-block', array(
        /** Define the attributes used in your block */
        'attributes'  => array(
            'title' => array(
                'type' => 'string',
                'default' => 'This is the blog title'
            ),
            'content' => array(
                'type' => 'string',
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in magna et felis laoreet tincidunt vel bibendum metus. Praesent eget laoreet purus. Curabitur rhoncus mattis lacus id sollicitudin. Aliquam efficitur vel orci et auctor. Praesent posuere sem odio, quis ultricies augue hendrerit in. Mauris venenatis laoreet pretium. Mauris magna libero, fringilla id tortor at, rhoncus venenatis velit. Fusce efficitur massa nec urna suscipit molestie. Sed eget nisi quam.'
            ),
        ),
        'editor_script'   => 'wp-law-firm-blog-block-script',
        'editor_style'    => 'wp-law-firm-blog-block-editor-style',
        'style'           => 'wp-law-firm-blog-block-frontend-style',
        'render_callback' => 'wp_law_firm_blog_render',
        'category'        => 'wp_law_firm_custom_blocks'
    ));
    function wp_law_firm_blog_render($attributes)
    {
        $args = array('numberposts' => 3);
        $latest_posts = get_posts($args);
        $latestPost1 = $latest_posts[0];
        $latestPost2 = $latest_posts[1];
        $latestPost3 = $latest_posts[2];
        $image1 = get_the_post_thumbnail_url($latestPost1->ID) ?: plugin_dir_url( __FILE__ ) . '/img/banner-img.png';
        $image2 = get_the_post_thumbnail_url($latestPost2->ID) ?: plugin_dir_url( __FILE__ ) . '/img/banner-img.png';
        $image3 = get_the_post_thumbnail_url($latestPost3->ID) ?:  plugin_dir_url( __FILE__ ) . '/img/banner-img.png';
        $category2 = get_the_category($latestPost2->ID);
        $category3 = get_the_category($latestPost3->ID);

        $output = '';
        $output .= '<section class="blog">
        <div class="llf-container">
            <h2 class="text-center">' . $attributes['title'] . '</h2>
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
                            <img class="lozad" src="' . $image2 . '" alt="Practice Image">
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
                            <img class="lozad" src="' . $image3 . '" alt="Practice Image">
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
        $output .= '</div>';
        if (in_array('url', $attributes)) {
            $output .= '<div class="text-center mt-5">
            <a href="' . $attributes['url'] . '" class="btn-primary">View all</a>
        </div>';
        }
        $output .= '</div>
</section>';

        return $output;
    }
}
add_action('init', 'wp_law_firm_blog_block');
