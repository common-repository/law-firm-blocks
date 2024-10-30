<?php

/**
 * BLOCK: Testimonials
 *
 * Gutenberg Custom Testimonials Block assets.
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
function wp_law_firm_testimonials_block()
{
    if (!function_exists('register_block_type')) {
        // Gutenberg is not active.
        return;
    }

    // Scripts.
    wp_enqueue_script(
        'wp-law-firm-testimonials-block-script', // Handle.
        plugin_dir_url( __FILE__ ) . 'block.js', // Block.js: We register the block here.
        array('wp-blocks', 'wp-components', 'wp-element', 'wp-i18n', 'wp-editor'), // Dependencies, defined above.
        filemtime(plugin_dir_path(__FILE__) . 'block.js'),
        true // Load script in footer.
    );

    // Styles.
    wp_register_style(
        'wp-law-firm-testimonials-block-editor-style', // Handle.
        plugin_dir_url( __FILE__ ) . 'editor.css', // Block editor CSS.
        array('wp-edit-blocks'), // Dependency to include the CSS after it.
        filemtime(plugin_dir_path(__FILE__) . 'editor.css')
    );
    wp_register_style(
        'wp-law-firm-testimonials-block-frontend-style', // Handle.
        plugin_dir_url( __FILE__ ) . 'style.css', // Block editor CSS.
        array(), // Dependency to include the CSS after it.
        filemtime(plugin_dir_path(__FILE__) . 'style.css')
    );

    register_block_type('wplawfirm/testimonials-block', array(
        /** Define the attributes used in your block */
        'attributes'  => array(
            'title' => array(
                'type' => 'string',
                'default' => 'Testimonials'
            ),
            'number' => array(
                'type' => 'number',
                'default' => '10'
            )
        ),
        'editor_script'   => 'wp-law-firm-testimonials-block-script',
        'editor_style'    => 'wp-law-firm-testimonials-block-editor-style',
         'style'           => 'wp-law-firm-testimonials-block-frontend-style',
        'render_callback' => 'wp_law_firm_testimonials_render',
        'category'        => 'wp_law_firm_custom_blocks'
    ));
    function wp_law_firm_testimonials_render($attributes)
    {

        $args = array('post_type' => 'testimonials', 'posts_per_page' => $attributes['number']);
        $query = new WP_Query($args);
        $output = '';
        $output .= '<section class="testimonials bg-lighter-gray">
            <div class="llf-container">
                <h2 class="text-center">' . $attributes['title'] . '</h2>
                <div class="carousel-wrap">
                <div class="owl-carousel testimonials-slider mt-5">';
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $image = get_the_post_thumbnail_url() ?: plugin_dir_url( __FILE__ ) .  '/img/banner-img.png';
                $post_id = get_the_ID();
                $output  .= sprintf(
                    '<div class="item">
                            <div class="img-block">
                                <img class="lozad" src="' . $image . '" alt="Testimonials Image">
                            </div>
                            <div class="content text-center mt-5">
                                <h2>' . get_the_title() . '</h2>
                                <p>
                                    <img class="lozad" src="' .  plugin_dir_url( __FILE__ ) . '/img/simbol.png" alt="Quote Image">
                                </p>
                                <p>' . get_the_content() . '</p>
                                <p class="name text-center">' . get_post_meta($post_id, "testimonial_author", true) . '</p>
                            </div>
                    </div>',
                    esc_url(get_permalink($post_id)),
                    esc_html(get_the_title($post_id))
                );

                wp_reset_postdata();
            endwhile;
        endif;
        $output .= '</div>
                </div>
            </div>
        </section>';

        return $output;
    }
}
add_action('init', 'wp_law_firm_testimonials_block');
