<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 16/10/18
 * Time: 11:43 AM
 */
function chumly_taxonomy_setup() {
	
	/**
	 * User Media CPT & default Attachment post type
	 */
	$classification_tax_labels = array(
		'name' => 'Classification'
	);
	
	$classification_tax_args = array(
		'labels'                => $classification_tax_labels,
		'hierarchical'          => TRUE,
		'show_ui'               => TRUE,
		'show_admin_column'     => TRUE,
		'query_var'             => TRUE,
		'rewrite'               => TRUE,
		'update_count_callback' => '_update_post_term_count'
	);
	
	register_taxonomy( 'chumly_media_classification', array( 'chumly_user_media', 'attachment' ), $classification_tax_args );
	
	
	/**
	 * Status Post & Shared CPTs
	 */
	$post_owner_tax_labels = array(
		'name' => 'Target Object'
	);
	
	$post_owner_tax_args = array(
		'labels'            => $post_owner_tax_labels,
		'hierarchical'      => FALSE,
		'show_ui'           => TRUE,
		'show_admin_column' => TRUE
	);
	
	register_taxonomy( 'chumly_post_target', array( 'chumly_status_post', 'chumly_shared' ), $post_owner_tax_args );
	
	
	$linked_content_tax_labels = array(
		'name' => 'Linked Content'
	);
	
	$linked_content_tax_args = array(
		'labels'            => $linked_content_tax_labels,
		'hierarchical'      => FALSE,
		'show_ui'           => TRUE,
		'show_admin_column' => TRUE
	);
	
	register_taxonomy( 'chumly_linked', array( 'chumly_status_post', 'chumly_shared' ), $linked_content_tax_args );
	
	
	/**
	 * Group Message CPT
	 */
	$group_tax_labels = array(
		'name' => 'Target Group'
	);
	
	$group_tax_args = array(
		'labels'            => $group_tax_labels,
		'hierarchical'      => FALSE,
		'show_ui'           => TRUE,
		'show_admin_column' => TRUE
	);
	
	register_taxonomy( 'chumly_target_group', array( 'chumly_group_message' ), $group_tax_args );
	
	
	/**
	 * Chumly Post Statuses
	 */
	$post_format_tax_labels = array(
		'name' => 'Post Format'
	);
	
	$post_format_tax_args = array(
		'labels'            => $post_format_tax_labels,
		'hierarchical'      => FALSE,
		'show_ui'           => TRUE,
		'show_admin_column' => TRUE
	);
	
	register_taxonomy( 'chumly_post_format', array( 'chumly_status_post', 'chumly_group_message' ), $post_format_tax_args );
	
}

add_action( 'init', 'chumly_taxonomy_setup' );
