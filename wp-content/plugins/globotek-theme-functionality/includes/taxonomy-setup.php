<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 6/4/19
 * Time: 6:59 PM
 */
$site_type_labels = array(
	'name'          => 'Site Types',
	'singular_name' => 'Site Type'
);

$site_type_args = array(
	'labels'       => $site_type_labels,
	'public'       => TRUE,
	'hierarchical' => TRUE,
	'rewrite'     => array( 'with_front' => FALSE )
);

register_taxonomy( 'site-type', array( 'portfolio' ), $site_type_args );


$services_labels = array(
	'name'          => 'Services',
	'singular_name' => 'Service'
);

$services_args = array(
	'labels'       => $services_labels,
	'public'       => TRUE,
	'show_ui'      => TRUE,
	'hierarchical' => TRUE,
	'rewrite'     => array( 'with_front' => FALSE )
);

register_taxonomy( 'services', array( 'portfolio', 'page' ), $services_args );