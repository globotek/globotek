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