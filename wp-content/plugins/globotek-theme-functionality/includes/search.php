<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 25/4/19
 * Time: 8:26 PM
 */

function gtek_search() {
	
	ob_start();
	
	if ( intval( $_POST[ 'term' ] ) == TRUE ) {
		
		$term_query = array(
			'taxonomy' => esc_attr( $_POST[ 'taxonomy' ] ),
			'field'    => 'term_id',
			'terms'    => intval( $_POST[ 'term' ] )
		);
		
	}
	
	$query = new WP_Query( array(
		'post_type'      => esc_attr( $_POST[ 'post_type' ] ),
		'posts_per_page' => intval( $_POST[ 'post_limit' ] ),
		'tax_query'      => array( $term_query )
	) );
	
	while ( $query->have_posts() ) : $query->the_post();
		
		include( get_template_directory() . '/partials/project-box.php' );
		echo ob_get_clean();
	
	endwhile;
	
	wp_die();
	
}

add_action( 'wp_ajax_gtek_search', 'gtek_search' );
add_action( 'wp_ajax_nopriv_gtek_search', 'gtek_search' );