<?php

/**
 * BLOCK: Banner
 *
 * Gutenberg Custom Banner Block assets.
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
function wp_law_firm_banner_block()
{
    if (!function_exists('register_block_type')) {
        // Gutenberg is not active.
        return;
    }

    // Scripts.
    wp_enqueue_script(
        'wp-law-firm-banner-block-script', // Handle.
        plugin_dir_url( __FILE__ ) . 'block.js', // Block.js: We register the block here.
        array('wp-blocks', 'wp-components', 'wp-element', 'wp-i18n', 'wp-editor'), // Dependencies, defined above.
        filemtime(plugin_dir_path(__FILE__) . 'block.js'),
        true // Load script in footer.
    );

    // Styles.
    wp_register_style(
        'wp-law-firm-banner-block-editor-style', // Handle.
        plugin_dir_url( __FILE__ ) . 'editor.css', // Block editor CSS.
        array('wp-edit-blocks'), // Dependency to include the CSS after it.
        filemtime(plugin_dir_path(__FILE__) . 'editor.css')
    );
    wp_register_style(
        'wp-law-firm-banner-block-frontend-style', // Handle.
        plugin_dir_url( __FILE__ ) . 'style.css', // Block editor CSS.
        array(), // Dependency to include the CSS after it.
        filemtime(plugin_dir_path(__FILE__) . 'style.css')
    );

    $cf7_args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => 1);
    $cf7_forms = get_posts($cf7_args);
    $cf7_ids = wp_list_pluck($cf7_forms, 'ID');
    $cf7_default_id = $cf7_ids[0];

    register_block_type('wplawfirm/banner-block', array(
        /** Define the attributes used in your block */
        'attributes'  => array(
            'image' => array(
                'type' => 'string',
                'default' =>    plugin_dir_url( __FILE__ ) . '/img/banner-img.png'
                 ),
            'form_title' => array(
                'type' => 'string',
                'default' => 'Get your free legal consultation with a friendly lawyer!'
            ),
            'cf7_form_id' => array(
                'type'  => 'string',
                'default'   => $cf7_default_id
            ),
        ),
        'editor_script'   => 'wp-law-firm-banner-block-script',
        'editor_style'    => 'wp-law-firm-banner-block-editor-style',
        'style'           => 'wp-law-firm-banner-block-frontend-style',
        'render_callback' => 'wp_law_firm_banner_render',
        'category'        => 'wp_law_firm_custom_blocks'
    ));
    function wp_law_firm_banner_render($attributes)
    {
        $output = '<section class="home-banner">';
        $output .= '<div class="d-flex justify-content-between flex-wrap">';
        $output .= '<div class="banner-img">';
        $output .= '<img class="lozad" src="' . $attributes['image'] . '" alt="Facility Image" />';
        
        $output .= '</div>';
        $output .= '<div class="form bg-black">';
        $output .= '<h3 class="text-center">' . $attributes['form_title'] . '</h3>';
        $output .= do_shortcode('[contact-form-7 id="' . $attributes['cf7_form_id'] . '" title="Contact form"]');

        if (!class_exists('WPCF7')) {
            $output .= '<div>This section needs the Contact Form 7 plugin installed to display the form. Install + Activate plugin from <a href="wp-admin/admin.php?page=wp-law-firm-doc">here</a>.</div>';
        }
        
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</section>';

        return $output;
    }
}
add_action('init', 'wp_law_firm_banner_block');




