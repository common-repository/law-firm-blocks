<?php

/**
 * BLOCK: 3 CTA
 *
 * Gutenberg Custom 3 CTA Block assets.
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
function wp_law_firm_3_cta_block()
{

    if (!function_exists('register_block_type')) {
        // Gutenberg is not active.
        return;
    }

    // Scripts.
    wp_enqueue_script(
        'wp-law-firm-3cta-block-script', // Handle.
        plugin_dir_url( __FILE__ ) . '/block.js', // Block.js: We register the block here.
        array('wp-blocks', 'wp-components', 'wp-element', 'wp-i18n', 'wp-editor'), // Dependencies, defined above.
        filemtime(plugin_dir_path(__FILE__) . 'block.js'),
        true // Load script in footer.
    );

    // Styles.
    wp_register_style(
        'wp-law-firm-3cta-block-editor-style', // Handle.
        plugin_dir_url( __FILE__ ) . 'editor.css', // Block editor CSS.
        array('wp-edit-blocks'), // Dependency to include the CSS after it.
        filemtime(plugin_dir_path(__FILE__) . 'editor.css')
    );
    wp_register_style(
        'wp-law-firm-3cta-block-frontend-style', // Handle.
        plugin_dir_url( __FILE__ ) . 'style.css', // Block editor CSS.
        array(), // Dependency to include the CSS after it.
        filemtime(plugin_dir_path(__FILE__) . 'style.css')
    );

    // Here we actually register the block with WP, again using our namespacing.
    // We also specify the editor script to be used in the Gutenberg interface.
    register_block_type(
        'wplawfirm/three-cta-block',
        array(
            /** Define the attributes used in your block */
            'attributes'  => array(
                'mediaURL1' => array(
                    'type' => 'string',
                    'default' => plugin_dir_url( __FILE__ ) . 'img/img-1.png'
                ),
                'title1' => array(
                    'type' => 'string',
                    'default' => 'Title 1 here'
                ),
                'content1' => array(
                    'type' => 'string',
                    'default' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the'
                ),
                'link1' => array(
                    'type' => 'string',
                    'default' => '#'
                ),
                'mediaURL2' => array(
                    'type' => 'string',
                    'default' => plugin_dir_url( __FILE__ ) . 'img/img-2.png'
                ),
                'title2' => array(
                    'type' => 'string',
                    'default' => 'Title 2 here'
                ),
                'content2' => array(
                    'type' => 'string',
                    'default' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the'
                ),
                'link2' => array(
                    'type' => 'string',
                    'default' => '#'
                ),
                'mediaURL3' => array(
                    'type' => 'string',
                    'default' => plugin_dir_url( __FILE__ ) . 'img/img-3.png'
                ),
                'title3' => array(
                    'type' => 'string',
                    'default' => 'Title 3 here'
                ),
                'content3' => array(
                    'type' => 'string',
                    'default' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the'
                ),
                'link3' => array(
                    'type' => 'string',
                    'default' => '#'
                ),
            ),
            'editor_script'     => 'wp-law-firm-3cta-block-script',
            'editor_style'      => 'wp-law-firm-3cta-block-editor-style',
            'style'             => 'wp-law-firm-3cta-block-frontend-style',
            'render_callback'    => 'wp_law_firm_3cta_render',
            'category'          => 'wp_law_firm_custom_blocks'
        )
    );

    function wp_law_firm_3cta_render($attributes)
    {
        $output = '<section class="abilities-block">';
        $output .= '<div class="llf-container py-0">';
        $output .= '<div class="main-block d-flex flex-wrap justify-content-center">';

        $output .= '<a class="inner-block justify-content-between" href="' . $attributes['link1'] . '">';
        $output .= '<div class="d-flex justify-content-between align-items-center">';
        $output .= '<div class="img">';
        $output .= '<img class="lozad" src="' . $attributes['mediaURL1'] . '" alt="Ability Image">';
        $output .= '</div>';
        $output .= '<div class="content">';
        $output .= '<h3 class="mb-0 text-uppercase text-white">' . $attributes['title1'] . '</h3>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '<div class="main-content mt-3">';
        $output .= '<p class="text-white">' . $attributes['content1'] . '</p>';
        $output .= '</div>';
        $output .= '</a>';

        $output .= '<a class="inner-block justify-content-between" href="' . $attributes['link2'] . '">';
        $output .= '<div class="d-flex justify-content-between align-items-center">';
        $output .= '<div class="img">';
        $output .= '<img class="lozad" src="' . $attributes['mediaURL2'] . '" alt="Ability Image">';
        $output .= '</div>';
        $output .= '<div class="content">';
        $output .= '<h3 class="mb-0 text-uppercase text-white">' . $attributes['title2'] . '</h3>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '<div class="main-content mt-3">';
        $output .= '<p class="text-white">' . $attributes['content2'] . '</p>';
        $output .= '</div>';
        $output .= '</a>';

        $output .= '<a class="inner-block justify-content-between" href="' . $attributes['link3'] . '">';
        $output .= '<div class="d-flex justify-content-between align-items-center">';
        $output .= '<div class="img">';
        $output .= '<img class="lozad" src="' . $attributes['mediaURL3'] . '" alt="Ability Image">';
        $output .= '</div>';
        $output .= '<div class="content">';
        $output .= '<h3 class="mb-0 text-uppercase text-white">' . $attributes['title3'] . '</h3>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '<div class="main-content mt-3">';
        $output .= '<p class="text-white">' . $attributes['content3'] . '</p>';
        $output .= '</div>';
        $output .= '</a>';

        $output .= '</div>';
        $output .= '</div>';
        $output .= '</section>';

        return $output;
    }
} // End function wp_law_firm_3_cta_block().

// Hook: Editor assets.
add_action('init', 'wp_law_firm_3_cta_block');
