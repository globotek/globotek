<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 6/4/19
 * Time: 3:18 PM
 */
$portfolio_labels = array(
	'name'          => 'Portfolio Projects',
	'singular_name' => 'Portfolio Project'
);

$portfolio_args = array(
	'labels'      => $portfolio_labels,
	'public'      => TRUE,
	'supports'    => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
	'has_archive' => TRUE,
	'rewrite'     => array( 'with_front' => FALSE )
);

register_post_type( 'portfolio', $portfolio_args );


$testimonial_labels = array(
	'name'          => 'Testimonials',
	'singular_name' => 'Testimonial'
);

$testimonial_args = array(
	'labels'      => $testimonial_labels,
	'public'      => TRUE,
	'supports'    => array( 'title', 'editor', 'custom-fields' ),
	'has_archive' => TRUE
);

register_post_type( 'testimonial', $testimonial_args );
	
