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
	
	foreach ( $components as $component ) {
		
		include( get_stylesheet_directory() . '/partials/' . $component[ 'acf_fc_layout' ] . '.php' );
		
	}
	
}

function gtek_hero( $hero_template = NULL ) {
	
	if ( ! $hero_template ) {
		
		$hero          = get_field( 'hero', get_the_ID() );
		$hero_template = $hero[ 'hero_template' ];
		
	}
	
	if ( $hero_template ) {
		
		include( get_stylesheet_directory() . '/partials/' . $hero_template . '.php' );
		
	}
	
}