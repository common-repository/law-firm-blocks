<?php
/*
Plugin Name: Law Firm Blocks
Plugin URI: https://www.encoresky.com/
Description: A plugin for add post types and gutenberg blocks
Version: 1.0
Author: EncoreSky Technologies
*/
defined('ABSPATH') || exit;
/* 
Creating Testimonials And Practice Areas cucstom post types.
 */

function wp_law_firm_posts()
{
  register_post_type(
    'testimonials',
    array(

      'labels' => array(
        'name' => __('Testimonials', 'wplawfirm'),
        'singular_name' => __('Testimonial', 'wplawfirm'),
        'all_items' => __('All Testimonials', 'wplawfirm'),
        'add_new' => __('Add New', 'wplawfirm'),
        'add_new_item' => __('Add New Testimonial', 'wplawfirm'),
        'edit' => __('Edit', 'wplawfirm'),
        'edit_item' => __('Edit Testimonial', 'wplawfirm'),
        'new_item' => __('New Testimonial', 'wplawfirm'),
        'view_item' => __('View Testimonial', 'wplawfirm'),
        'search_items' => __('Search Testimonial', 'wplawfirm'),
        'not_found' =>  __('No example CPTs found. Add some and they\'ll appear here!', 'wplawfirm'),
        'not_found_in_trash' => __('Deleted Testimonial will appear here.', 'wplawfirm'),
        'parent_item_colon' => ''
      ),
      
      'description' => __('Testimonials custom post type.', 'wplawfirm'),
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 8,
      'menu_icon' => 'dashicons-testimonial',
      'rewrite' => array(
        'slug' => 'testimonials',
        'with_front' => false
      ),
      
      'has_archive' => 'testimonials',
      'capability_type' => 'post',
      'hierarchical' => false,
      'show_in_rest' => true,
      'supports' => array(
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt',
        'trackbacks',
        'custom-fields',
        'comments',
        'revisions',
        'sticky'
      )
    )
  );    
  register_post_type(
        'practice-areas',
        array(
          'labels' => array(
            'name' => __('Practice Areas', 'wplawfirm'),
            'singular_name' => __('Practice Area', 'wplawfirm'),
            'all_items' => __('All Practice Areas', 'wplawfirm'),
            'add_new' => __('Add New', 'wplawfirm'),
            'add_new_item' => __('Add New Practice Area', 'wplawfirm'),
            'edit' => __('Edit', 'wplawfirm'),
            'edit_item' => __('Edit Practice Area', 'wplawfirm'),
            'new_item' => __('New Practice Area', 'wplawfirm'),
            'view_item' => __('View Practice Area', 'wplawfirm'),
            'search_items' => __('Search Practice Area', 'wplawfirm'),
            'not_found' =>  __('No example CPTs found. Add some and they\'ll appear here!', 'wplawfirm'),
            'not_found_in_trash' => __('Deleted Practice Area will appear here.', 'wplawfirm'),
            'parent_item_colon' => ''
          ),
    
          'description' => __('Practice Area custom post type.', 'wplawfirm'),
          'public' => true,
          'publicly_queryable' => true,
          'exclude_from_search' => false,
          'show_ui' => true,
          'query_var' => true,
          'menu_position' => 7,
          'menu_icon' => 'dashicons-book-alt',
          'rewrite' => array(
            'slug' => 'practice-areas',
            'with_front' => false
          ),
    
          'has_archive' => 'practice-areas',
          'capability_type' => 'post',
          'show_in_rest' => true,
          'hierarchical' => false,
          'supports' => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'sticky'
          )
        )
      );
    
  register_taxonomy_for_object_type('testimonials-category', 'testimonials');
  register_taxonomy_for_object_type('testimonials-tag', 'testimonials');
  register_taxonomy_for_object_type('practice-areas-category', 'practice-areas');
  register_taxonomy_for_object_type('practice-areas-tag', 'practice-areas');
}

add_action('init', 'wp_law_firm_posts');

function wp_law_firm_taxonomy()
{
register_taxonomy(
  'testimonials-category',
  array('testimonials'),
  array(
    'hierarchical' => true,
    'labels' => array(
      'name' => __('Categories', 'wplawfirm'),
      'singular_name' => __('Category', 'wplawfirm'),
      'search_items' =>  __('Search Categories', 'wplawfirm'),
      'all_items' => __('All Categories', 'wplawfirm'),
      'parent_item' => __('Parent Category', 'wplawfirm'),
      'parent_item_colon' => __('Parent Category:', 'wplawfirm'),
      'edit_item' => __('Edit Category', 'wplawfirm'),
      'update_item' => __('Update Category', 'wplawfirm'),
      'add_new_item' => __('Add New Category', 'wplawfirm'),
      'new_item_name' => __('New Category Name', 'wplawfirm')
    ),

    'show_admin_column' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'testimonials-categories'),
  )
);
register_taxonomy(
    'practice-areas-category',
    array('practice-areas'),
    array(
      'hierarchical' => true,
      'labels' => array(
        'name' => __('Categories', 'wplawfirm'),
        'singular_name' => __('Category', 'wplawfirm'),
        'search_items' =>  __('Search Categories', 'wplawfirm'),
        'all_items' => __('All Categories', 'wplawfirm'),
        'parent_item' => __('Parent Category', 'wplawfirm'),
        'parent_item_colon' => __('Parent Category:', 'wplawfirm'),
        'edit_item' => __('Edit Category', 'wplawfirm'),
        'update_item' => __('Update Category', 'wplawfirm'),
        'add_new_item' => __('Add New Category', 'wplawfirm'),
        'new_item_name' => __('New Category Name', 'wplawfirm')
      ),
  
      'show_admin_column' => true,
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'Practice Area-categories'),
    )
  );
}
add_action('init', 'wp_law_firm_taxonomy');
function wp_law_firm_taxonomy2()
{
register_taxonomy(
  'testimonials-tag',
  array('testimonials'),
  array(
    'hierarchical' => false,
    'labels' => array(
      'name' => __('Tags', 'wplawfirm'),
      'singular_name' => __('Tag', 'wplawfirm'),
      'search_items' =>  __('Search Tags', 'wplawfirm'),
      'all_items' => __('All Tags', 'wplawfirm'),
      'parent_item' => __('Parent Tag', 'wplawfirm'),
      'parent_item_colon' => __('Parent Tag:', 'wplawfirm'),
      'edit_item' => __('Edit Tag', 'wplawfirm'),
      'update_item' => __('Update Tag', 'wplawfirm'),
      'add_new_item' => __('Add New Tag', 'wplawfirm'),
      'new_item_name' => __('New Tag Name', 'wplawfirm')
    ),
      
    'show_admin_column' => true,
    'show_ui' => true,
    'query_var' => true,
  )
);
register_taxonomy(
    'practice-areas-tag',
    array('practice-areas'),
    array(
      'hierarchical' => false,
      'labels' => array(
        'name' => __('Tags', 'wplawfirm'),
        'singular_name' => __('Tag', 'wplawfirm'),
        'search_items' =>  __('Search Tags', 'wplawfirm'),
        'all_items' => __('All Tags', 'wplawfirm'),
        'parent_item' => __('Parent Tag', 'wplawfirm'),
        'parent_item_colon' => __('Parent Tag:', 'wplawfirm'),
        'edit_item' => __('Edit Tag', 'wplawfirm'),
        'update_item' => __('Update Tag', 'wplawfirm'),
        'add_new_item' => __('Add New Tag', 'wplawfirm'),
        'new_item_name' => __('New Tag Name', 'wplawfirm')
      ),
  
      'show_admin_column' => true,
      'show_ui' => true,
      'query_var' => true,
    )
  );
}
add_action('init', 'wp_law_firm_taxonomy2');

/* Including custom gutenberg blocks file. */
require_once plugin_dir_path( __FILE__ ) . 'guttenberg-blocks/index.php';

/* Including shortcodes file. */
/* Shortcodes are created for gutenberg blocks. */
require_once plugin_dir_path( __FILE__ ) . 'shortcodes/index.php';

/* Starter content. */
require_once plugin_dir_path( __FILE__ ) . 'starter-content.php';
