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

function gtek_cpt_setup() {
	
	$portfolio_labels = array(
		'name'          => 'Portfolio Projects',
		'singular_name' => 'Portfolio Project'
	);
	
	$portfolio_args = array(
		'labels'      => $portfolio_labels,
		'public'      => TRUE,
		'supports'    => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
		'has_archive' => TRUE
	);
	
	register_post_type( 'portfolio', $portfolio_args );
	
}

add_action( 'init', 'gtek_cpt_setup' );


function gtek_taxonomy_setup() {
	
	$services_labels = array(
		'name'          => 'Services',
		'singular_name' => 'Service'
	);
	
	$services_args = array(
		'labels' => $services_labels,
		'public' => TRUE,
	
	);
	
	register_taxonomy( 'services', array( 'portfolio' ), $services_args );
	
}

add_action( 'init', 'gtek_taxonomy_setup' );


function gtek_functionality_scripts() {
	
	wp_enqueue_script( 'lib', plugin_dir_url( __FILE__ ) . 'scripts/lib.js', array( 'jquery' ), '', TRUE );
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


function gtek_functionality_file_include() {
	
	include_once( 'includes/freshsales-api-integration.php' );
	
}

add_action( 'init', 'gtek_functionality_file_include' );