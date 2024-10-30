<?php

/**
 * BLOCK: Practice Areas
 *
 * Gutenberg Custom Practice Area Block assets.
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
function wp_law_firm_practice_areas_block()
{
    if (!function_exists('register_block_type')) {
        // Gutenberg is not active.
        return;
    }

    // Scripts.
    wp_enqueue_script(
        'wp-law-firm-practice-areas-block-script', // Handle.
        plugin_dir_url( __FILE__ ) . 'block.js', // Block.js: We register the block here.
        array('wp-blocks', 'wp-components', 'wp-element', 'wp-i18n', 'wp-editor'), // Dependencies, defined above.
        filemtime(plugin_dir_path(__FILE__) . 'block.js'),
        true // Load script in footer.
    );

    // Styles.
    wp_register_style(
        'wp-law-firm-practice-areas-block-editor-style', // Handle.
        plugin_dir_url( __FILE__ ) . 'editor.css', // Block editor CSS.
        array('wp-edit-blocks'), // Dependency to include the CSS after it.
        filemtime(plugin_dir_path(__FILE__) . 'editor.css')
    );
    wp_register_style(
        'wp-law-firm-practice-areas-block-frontend-style', // Handle.
        plugin_dir_url( __FILE__ ) . 'style.css', // Block editor CSS.
        array(), // Dependency to include the CSS after it.
        filemtime(plugin_dir_path(__FILE__) . 'style.css')
    );
    wp_localize_script(
        'wp-law-firm-practice-areas-block-script',
        'wppic',
        array(
            'rest_url'      => get_rest_url(),
            'query_preview' => plugin_dir_url( __FILE__ ) . '/img/preview.png',
            'wppic_preview' => plugin_dir_url( __FILE__ ) . '/img/preview.png',
        )
    );
    register_block_type('wplawfirm/practice-areas-block', array(
        /** Define the attributes used in your block */
        'attributes'  => array(
            'title' => array(
                'type' => 'string',
                'default' => 'Practice Area'
            ),
            'text' => array(
                'type' => 'string'
            ),
            'url' => array(
                'type' => 'string',
                'default' => '#'
            ),
            'content' => array(
                'type' => 'string',
                'default' => '10'
            )
        ),
        'editor_script'   => 'wp-law-firm-practice-areas-block-script',
        'editor_style'    => 'wp-law-firm-practice-areas-block-editor-style',
        'style'           => 'wp-law-firm-practice-areas-block-frontend-style',
        'render_callback' => 'wp_law_firm_practice_area_render',
        'category'        => 'wp_law_firm_custom_blocks'
    ));
    function wp_law_firm_practice_area_render($attributes)
    {
        $args = array('post_type' => 'practice-areas', 'posts_per_page' => $attributes['content']);
        $query = new WP_Query($args);
        $output = '';
        $output .= '<section class="practice">
            <div class="llf-container">
                <h2 class="text-center text-white">' . $attributes['title'] . '</h2>
                <div class="d-flex flex-wrap pt-5">';
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $image = get_the_post_thumbnail_url() ?:  plugin_dir_url( __FILE__ ) . '/img/icon-1.png';
                
                $post_id = get_the_ID();
                $output  .= sprintf(
                    '<div class="inner-block">
                        <a href="%1$s">
                            <span class="img d-block">
                                <img class="lozad" src="' . $image . '"
                                    alt="Practice Image">
                            </span>
                            <p class="text-white mt-4">%2$s</p>
                        </a>
                    </div>',
                    esc_url(get_permalink($post_id)),
                    esc_html(get_the_title($post_id))
                );

                wp_reset_postdata();
            endwhile;
        endif;
        $output .= '</div>
                <div class="text-center mt-3">
                    <a href="' . $attributes['url'] . '" class="btn-primary btn-bg-transparent">View all</a>
                </div>
            </div>
        </section>';

        return $output;
    }
}
add_action('init', 'wp_law_firm_practice_areas_block');
