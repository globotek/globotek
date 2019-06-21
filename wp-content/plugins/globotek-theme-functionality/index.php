<?php
/**
 * Plugin Name: GloboTek Functionality
 * Author: GloboTek
 * Author URI: https://globotek.net
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 18/02/2019
 * Time: 11:53
 */
function gtek_functionality_file_include() {
	
	foreach ( glob( dirname( __FILE__ ) . '/includes/*.php' ) as $file ) {
		
		include( $file );
		
	}
	
}

add_action( 'init', 'gtek_functionality_file_include' );


function gtek_functionality_scripts() {
	
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_script( 'lib', plugin_dir_url( __FILE__ ) . 'scripts/lib.js', array( 'jquery' ) );
	
	wp_register_script( 'gtek-functionality', plugin_dir_url( __FILE__ ) . 'scripts/globotek-theme-functionality.js', array( 'lib' ), '', TRUE );
	wp_localize_script( 'gtek-functionality', 'gtek_vars', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_script( 'gtek-functionality' );
	
}

add_action( 'wp_enqueue_scripts', 'gtek_functionality_scripts' );


function gtek_register_functionality_globals() {
	
	global $api_keys;
	
	$api_keys = new stdClass();
	
	$api_keys->freshsales = 'T2w9EivCKG8Ngor5q8C8kg';
	
}

add_action( 'init', 'gtek_register_functionality_globals' );


if ( function_exists( 'acf' ) ) {
	
	acf_add_options_page( array( 'page_title' => 'Appointment Availability' ) );
	
}
