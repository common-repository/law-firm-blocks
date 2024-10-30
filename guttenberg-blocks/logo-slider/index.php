<?php

/**
 * BLOCK: Logo Slider
 *
 * Gutenberg Custom Logo Slider Block assets.
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
function wp_law_firm_logo_slider_block()
{
    if (!function_exists('register_block_type')) {
        // Gutenberg is not active.
        return;
    }
    // Scripts.
    wp_enqueue_script(
        'wp-law-firm-logo-slider-block-script', // Handle.
        plugin_dir_url( __FILE__ ) . 'block.js', // Block.js: We register the block here.
        array('wp-blocks', 'wp-components', 'wp-element', 'wp-i18n', 'wp-editor' , 'jquery'), // Dependencies, defined above.
        filemtime(plugin_dir_path(__FILE__) . 'block.js'),
        true // Load script in footer.
    );
    wp_enqueue_script(
		'owl-carousel',
       plugin_dir_url( __FILE__ ) . '/owl.carousel.min.js' ,
		array( 'jquery' ),
		'2.3.4',
		true
	);
    // Styles.

    wp_enqueue_style( 'owlcarousel-style', plugin_dir_url( __FILE__ ) . '/owl.carousel.min.js' );

    wp_enqueue_style( 'owlcarousel-theme', plugin_dir_url( __FILE__ ) . '/owl.carousel.min.css' );

    wp_register_style(
        'wp-law-firm-logo-slider-block-editor-style', // Handle.
        plugin_dir_url( __FILE__ ) . 'editor.css', // Block editor CSS.
        array('wp-edit-blocks'), // Dependency to include the CSS after it.
        filemtime(plugin_dir_path(__FILE__) . 'editor.css')
    );
    wp_register_style(
        'wp-law-firm-logo-slider-block-frontend-style', // Handle.
        plugin_dir_url( __FILE__ ) . 'style.css', // Block editor CSS.
        array(), // Dependency to include the CSS after it.
        filemtime(plugin_dir_path(__FILE__) . 'style.css')
    );
      register_block_type('wplawfirm/logo-slider-block', array(
        /** Define the attributes used in your block */
        // 'attributes'  => array(
        //     'items' => array(
        //         'type' => 'array'
        //     )
        // ),
        'editor_script'   => 'wp-law-firm-logo-slider-block-script',
        'editor_style'    => 'wp-law-firm-logo-slider-block-editor-style',
        'style'           => 'wp-law-firm-logo-slider-block-frontend-style',
        'render_callback' => 'wp_law_firm_logo_slider_render',
        'category'        => 'wp_law_firm_custom_blocks'
    ));
    function wp_law_firm_logo_slider_render($attributes)
    {      
        $default_values = array(
            array(
                'mediaURL' =>  plugin_dir_url( __FILE__ ) . '/img/logo-img-1.png',
                'link' => '#',
            ),
            array(
                'mediaURL' =>  plugin_dir_url( __FILE__ ) . '/img/logo-img-2.png',
                'link' => '#',
            ),
            array(
                'mediaURL' =>  plugin_dir_url( __FILE__ ) . '/img/logo-img-3.png',
                'link' => '#',
            ),
            array(
                'mediaURL' =>  plugin_dir_url( __FILE__ ) . '/img/logo-img-4.png',
                'link' => '#',
            ),
        );
        
      //  if (in_array('items', $attributes) && $attributes['items']) {
          if(!empty($attributes)){
            $all_items = $attributes['items'];
        }
         else {
            $all_items = $default_values;
        }

        $output = '<section class="partner-slider">';
        $output .= '<div class="llf-container">';
        $output .= '<div class="carousel-wrap">';
        $output .= '<div class="owl-carousel logo-slider">';

        foreach ($all_items as $single_item) :

            $output .= '<div class="item">';
            $output .= '<a href="' . $single_item['link'] . '" target="_blank" rel="noopener noreferrer">';
            $output .= '<img src="' . $single_item['mediaURL'] . '" alt="Logo Image" />';
            $output .= '</a>';
            $output .= '</div>';

        endforeach;

        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</section>';

        return $output;
    }
}
add_action('init', 'wp_law_firm_logo_slider_block');
