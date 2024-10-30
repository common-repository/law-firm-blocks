<?php 
function law_firm_blocks_create_practice_areas_initial_posts()
{
    /**
 * Create practice areas initial posts
 */

    $practice_areas = array(
        // Page Title and URL (a blank space will end up becomeing a dash "-")
        'Commercial Law & Litigation' => array(
            // Page Content     // Template to use (if left blank the default template will be used)
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed erat magna, varius eu neque ut, placerat pretium augue. Sed fringilla et quam congue gravida.' => ''
        ),
        'Estate Admin (Probate)' => array(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed erat magna, varius eu neque ut, placerat pretium augue. Sed fringilla et quam congue gravida.' => ''
        ),
        'Estate Planning' => array(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed erat magna, varius eu neque ut, placerat pretium augue. Sed fringilla et quam congue gravida.' => ''
        ),
        'Criminal Defense' => array(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed erat magna, varius eu neque ut, placerat pretium augue. Sed fringilla et quam congue gravida.' => ''
        ),
        'Real Estate' => array(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed erat magna, varius eu neque ut, placerat pretium augue. Sed fringilla et quam congue gravida.' => ''
        ),
    );

    foreach ($practice_areas as $practice_url_title => $practice_meta) {

        foreach ($practice_meta as $practice_content => $practice_template) {

            $practice = array(
                'post_type'   => 'practice-areas',
                'post_title'  => $practice_url_title,
                'post_name'   => $practice_url_title,
                'post_status' => 'publish',
                'post_content' => $practice_content,
                'post_author' => 1,
                'post_parent' => ''
            );

            $new_practice_id = wp_insert_post($practice);
        }
    }
}

/**
 * Create testimonials initial posts
 */

function law_firm_blocks_create_testimonials_initial_posts()
{

    $testimonials = array(
        // Page Title and URL (a blank space will end up becomeing a dash "-")
        'My case was dismissed' => array(
            // Page Content     // Template to use (if left blank the default template will be used)
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed erat magna, varius eu neque ut, placerat pretium augue. Sed fringilla et quam congue gravida.' => 'George Caliber'
        ),
        'Testimonial title 2' => array(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed erat magna, varius eu neque ut, placerat pretium augue. Sed fringilla et quam congue gravida.' => 'Andrew Strauss'
        ),
        'Testimonial title 3' => array(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed erat magna, varius eu neque ut, placerat pretium augue. Sed fringilla et quam congue gravida.' => 'Ricky Sabistan'
        ),
        'Testimonial title 4' => array(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed erat magna, varius eu neque ut, placerat pretium augue. Sed fringilla et quam congue gravida.' => 'Oliver Shander'
        ),
        'Testimonial title 5' => array(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed erat magna, varius eu neque ut, placerat pretium augue. Sed fringilla et quam congue gravida.' => 'John Drew'
        )
    );

    foreach ($testimonials as $testmonial_url_title => $testmonial_meta) {

        foreach ($testmonial_meta as $testmonial_content => $testmonial_author) {

            $testmonial = array(
                'post_type'   => 'testimonials',
                'post_title'  => $testmonial_url_title,
                'post_name'   => $testmonial_url_title,
                'post_status' => 'publish',
                'post_content' => $testmonial_content,
                'post_author' => 1,
                'post_parent' => ''
            );
            $new_testmonial_id = wp_insert_post($testmonial);
            if ($new_testmonial_id) {
                update_post_meta($new_testmonial_id, 'testimonial_author', $testmonial_author);
            }
        }
    }
}
/**
 * On Activation activation
 */
require_once( ABSPATH . "wp-includes/pluggable.php" );
require_once( ABSPATH . "wp-includes/load.php" );
function law_firm_blocks_default_posts(){
    $args = array(
    'post_type' => 'practice-areas'
    );
    $the_query = new WP_Query( $args );
    $totalpost = $the_query->found_posts; 
    if($totalpost <= 0){  
        law_firm_blocks_create_practice_areas_initial_posts();
    }
    $args2 = array(
        'post_type' => 'testimonials'
    );
    $the_query2 = new WP_Query( $args2 );
    $totalpost2 = $the_query2->found_posts; 

    if($totalpost2 <= 0){
        law_firm_blocks_create_testimonials_initial_posts();    
    }
}
register_activation_hook( plugin_dir_path( __FILE__ ) . 'post_and_blocks.php', 'law_firm_blocks_default_posts' );
            