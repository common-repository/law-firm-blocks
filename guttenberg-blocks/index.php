<?php
/**
 * Gutenberg block category
 */
function wp_law_firm_blocks_categories($categories)
{
    return array_merge(
        array(
            array(
                'slug' => 'wp_law_firm_custom_blocks',
                'title' => __('WP Law Firm Blocks', 'wplawfirm'),
                // 'icon'  => 'wordpress',
            ),
        ),
        $categories
    );
}
add_filter('block_categories', 'wp_law_firm_blocks_categories', 10, 2);

/**
 * BLOCK: Banner Block.
 */
require_once  plugin_dir_path( __FILE__ ) . 'banner/index.php';

// /**
//  * BLOCK: 3 CTA Block.
//  */
require_once  plugin_dir_path( __FILE__ ) . '3cta/index.php';

// /**
//  * BLOCK: Introduction Block.
//  */
require_once  plugin_dir_path( __FILE__ ) . 'introduction/index.php';

// /**
//  * BLOCK: Practice Area Block.
//  */
require_once  plugin_dir_path( __FILE__ ) . 'practiceareas/index.php';

// /**
//  * BLOCK: Blog Block.
//  */
require_once  plugin_dir_path( __FILE__ ) . 'blog/index.php';

// /**
//  * BLOCK: Testimonials Block.
//  */
require_once  plugin_dir_path( __FILE__ ) . 'testimonials/index.php';

// /**
//  * BLOCK: Logo Slider Block.
//  */
require_once plugin_dir_path( __FILE__ ) . 'logo-slider/index.php';
