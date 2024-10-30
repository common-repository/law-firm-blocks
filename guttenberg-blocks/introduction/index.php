<?php

/**
 * BLOCK: Introduction
 *
 * Gutenberg Custom Introduction Block assets.
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
function wp_law_firm_introduction_block()
{

    if (!function_exists('register_block_type')) {
        // Gutenberg is not active.
        return;
    }

    // Scripts.
    wp_enqueue_script(
        'wp-law-firm-introduction-block-script', // Handle.
        plugin_dir_url( __FILE__ ) . 'block.js', // Block.js: We register the block here.
        array('wp-blocks', 'wp-components', 'wp-element', 'wp-i18n', 'wp-editor'), // Dependencies, defined above.
        filemtime(plugin_dir_path(__FILE__) . 'block.js'),
        true // Load script in footer.
    );

    // Styles.
    wp_register_style(
        'wp-law-firm-introduction-block-editor-style', // Handle.
        plugin_dir_url( __FILE__ ) . 'editor.css', // Block editor CSS.
        array('wp-edit-blocks'), // Dependency to include the CSS after it.
        filemtime(plugin_dir_path(__FILE__) . 'editor.css')
    );
    wp_register_style(
        'wp-law-firm-introduction-block-frontend-style', // Handle.
        plugin_dir_url( __FILE__ ) . 'style.css', // Block editor CSS.
        array(), // Dependency to include the CSS after it.
        filemtime(plugin_dir_path(__FILE__) . 'style.css')
    );

    // Here we actually register the block with WP, again using our namespacing.
    // We also specify the editor script to be used in the Gutenberg interface.
    register_block_type(
        'wplawfirm/introduction-block',
        array(
            /** Define the attributes used in your block */
            'attributes'  => array(
                'title' => array(
                    'type' => 'string',
                    'default' => 'Write the title here'
                ),
                'content' => array(
                    'type' => 'string',
                    'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in magna et felis laoreet tincidunt vel bibendum metus. Praesent eget laoreet purus. Curabitur rhoncus mattis lacus id sollicitudin. Aliquam efficitur vel orci et auctor. Praesent posuere sem odio, quis ultricies augue hendrerit in. Mauris venenatis laoreet pretium. Mauris magna libero, fringilla id tortor at, rhoncus venenatis velit. Fusce efficitur massa nec urna suscipit molestie. Sed eget nisi quam.'
                ),
                'url' => array(
                    'type' => 'string',
                    'default' => '<a href="#">Button Link</a>'
                ),
                'mediaURL' => array(
                    'type' => 'string',
                    'default' =>  plugin_dir_url( __FILE__ ) . '/img/banner-img.png'
                ),
            ),
            'editor_script'     => 'wp-law-firm-introduction-block-script',
            'editor_style'      => 'wp-law-firm-introduction-block-editor-style',
            'style'             => 'wp-law-firm-introduction-block-frontend-style',
            'render_callback'   => 'wp_law_firm_introduction_render',
            'category'          => 'wp_law_firm_custom_blocks'
        )
    );            
        function wp_law_firm_introduction_render($attributes)
    {  
        $output = '<section class="get-in-touch">';
        $output .= '<div class="llf-container">';
        $output .= '<div class="d-flex justify-content-between flex-wrap">';
        $output .= '<div class="text-block">';
        $output .= '<h2>' . $attributes['title'] . '</h2>';
        $output .= '<div class="content">';
        $output .= '<p class="introduction-content">' . $attributes['content'] . '</p>';
        // $output .= '<p class="introduction-link">' . $attributes['link'] . '</p>';
        $output .= '<p class="introduction-link">' . $attributes['url'] . '</p>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '<div class="img">';
        $output .= '<img src="' . $attributes['mediaURL'] . '" class="lozad" alt="Get In Touch Image" />';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</section>';
              
        return $output;
    }
} // End function wp_law_firm_introduction_block().

// Hook: Editor assets.
add_action('init', 'wp_law_firm_introduction_block');
