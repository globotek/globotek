<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 4/4/19
 * Time: 8:38 PM
 */

/**
 * @param $components array Template part assigned by ACF
 */
function gtek_template_router( $components ) {
	
	if ( $components ) {
		
		foreach ( $components as $component ) {
			
			echo '<div class="chunk chunk--treble">';
			
			include( get_stylesheet_directory() . '/partials/' . $component[ 'acf_fc_layout' ] . '.php' );
			
			echo '</div>';
			
		}
		
	}
	
}

function gtek_hero( $hero_template = NULL ) {
	
	if ( is_array( $hero_template ) ) {
		
		include( get_stylesheet_directory() . '/partials/hero-dynamic.php' );
		
		return;
		
	}
	
	if ( ! $hero_template ) {
		
		$hero = get_field( 'hero', get_the_ID() );
		
		if ( $hero[ 'title' ] ) {
			
			$hero_template = $hero[ 'hero_template' ];
			
		} else {
			
			$hero_template = 'hero-post';
			
		}
		
	}
	
	if ( $hero_template ) {
		
		include( get_stylesheet_directory() . '/partials/' . $hero_template . '.php' );
		
	}
	
}