<?php 
// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

	/**
	* Delete all post and meta data.
	*/
	function wp_law_firm_delete_plugin(){
		
		$wp_law_firm_posts_data = array(
			array(
				'post' => get_posts(
					array(
						'numberposts' => -1,
						'post_type' => 'testimonials',
						'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash')    
						)
				)
			),
			array(
				'post' => get_posts(
					array(
						'numberposts' => -1,
						'post_type' => 'practice-areas',
						'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash')    
						)
				)
			)			
		);	
		/**
		 * Delete post.
		 */
		foreach ( $wp_law_firm_posts_data as $post_item ) {
			foreach ( $post_item['post'] as $post ) {
				wp_delete_post( $post->ID, true );
			}
		}		
	}
wp_law_firm_delete_plugin();