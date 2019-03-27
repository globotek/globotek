<?php
/**
 * @param array $post_formats = New post statuses added as a simple array
 */
function chumly_add_post_formats( $new_formats = array() ) {
	
	$post_formats = get_theme_support( 'post-formats' );
	
	if( !is_array( $post_formats ) ) {
		$post_formats = array( 0 => array() );
	}
	
	foreach( $new_formats as $format ) {
		$post_formats[ 0 ][] = $format;
	}
	
	add_theme_support( 'post-formats', $post_formats[ 0 ] );
	
}


/**
 * Initiate the Chumly post types
 *
 * @TODO Move taxonomies to own file for manageability
 */
function chumly_post_types_setup() {
	
	/**
	 * User Media - Stores all the information about a user's uploaded media that needs linking to a user ID and categorising.
	 */
	$user_media_cpt_labels = array(
		'name'          => _x( 'User Media', 'chumly_user_media', 'chumly' ),
		'singular_name' => _x( 'User Media', 'chumly_user_media', 'chumly' ),
		'add_new_item'  => _x( 'Add User Media', 'chumly_user_media', 'chumly' )
	);
	
	$user_media_cpt_args = array(
		'labels'       => $user_media_cpt_labels,
		'rewrite'      => array( 'slug' => 'user-media' ),
		'supports'     => array(
			'title',
			'author',
			'custom-fields'
		),
		'show_ui'      => TRUE,
		'show_in_menu' => TRUE,
		'public'       => TRUE,
		'menu_icon'    => 'dashicons-admin-media'
	);
	
	register_post_type( 'chumly_user_media', $user_media_cpt_args );
	
	
	/**
	 * Group Post - Stores all the information about a group.
	 */
	$groups_cpt_labels = array(
		'name'          => _x( 'Groups', 'chumly_groups', 'chumly' ),
		'singular_name' => _x( 'Group', 'chumly_groups', 'chumly' ),
		'add_new_item'  => _x( 'Add a Group', 'chumly_groups', 'chumly' )
	);
	
	$groups_cpt_args = array(
		'labels'       => $groups_cpt_labels,
		'rewrite'      => array( 'slug' => chumly_get_option( 'group_archive_page' ) ),
		'supports'     => array(
			'title',
			'author',
			'thumbnail',
			'comments',
			'custom-fields'
		),
		'show_ui'      => TRUE,
		'show_in_menu' => TRUE,
		'public'       => TRUE,
		'menu_icon'    => 'dashicons-groups',
		'rewrite'      => array( 'with_front' => FALSE, 'slug' => chumly_get_option('group_archive_page') )
	);
	
	register_post_type( 'chumly_groups', $groups_cpt_args );
	
	
	/**
	 * Status Post - For when someone submits a status to their wall or another's.
	 */
	$status_post_cpt_labels = array(
		'name'          => _x( 'Status Posts', 'chumly_status_post', 'chumly' ),
		'singular_name' => _x( 'Status Post', 'chumly_status_post', 'chumly' ),
		'add_new_item'  => _x( 'Add a Status', 'chumly_status_post', 'chumly' )
	);
	
	$status_post_cpt_args = array(
		'labels'       => $status_post_cpt_labels,
		'rewrite'      => array( 'slug' => 'status' ),
		'supports'     => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'comments',
			'custom-fields'
		),
		'show_ui'      => TRUE,
		'show_in_menu' => TRUE,
		'public'       => TRUE,
		'menu_icon'    => 'dashicons-format-status'
	);
	
	register_post_type( 'chumly_status_post', $status_post_cpt_args );
	
	
	/**
	 * Group Message - For when someone submits a message to the group. The group is the overarching
	 * post parent and the parent-child post relationship will be utilised for both initial posts and
	 * replies to posts.
	 */
	$group_message_cpt_labels = array(
		'name'          => _x( 'Group Messages', 'chumly_group_message', 'chumly' ),
		'singular_name' => _x( 'Group Message', 'chumly_group_message', 'chumly' ),
		'add_new_item'  => _x( 'Add a Group Message', 'chumly_group_message', 'chumly' )
	);
	
	$group_message_cpt_args = array(
		'labels'       => $group_message_cpt_labels,
		'rewrite'      => array( 'slug' => 'group-status' ),
		'supports'     => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'comments',
			'custom-fields'
		),
		'show_ui'      => TRUE,
		'show_in_menu' => TRUE,
		'public'       => TRUE,
		'hierarchical' => TRUE,
		'menu_icon'    => 'dashicons-list-view'
	);
	
	register_post_type( 'chumly_group_message', $group_message_cpt_args );
	
	
	/**
	 * Status Post - For when someone submits a status to their wall or another's.
	 */
	$shared_content_cpt_labels = array(
		'name'          => _x( 'Shared Content', 'chumly_shared_content', 'chumly' ),
		'singular_name' => _x( 'Shared Content', 'chumly_shared_content', 'chumly' ),
		'add_new_item'  => _x( 'Add Shared Content', 'chumly_shared_content', 'chumly' )
	);
	
	$shared_content_cpt_args = array(
		'labels'        => $shared_content_cpt_labels,
		'rewrite'       => array( 'slug' => 'shared' ),
		'supports'      => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'comments',
			'custom-fields'
		),
		'show_ui'       => TRUE,
		'show_in_menu'  => TRUE,
		'public'        => TRUE,
		'menu_icon'     => 'dashicons-share',
		'menu_position' => 25
	);
	
	register_post_type( 'chumly_shared', $shared_content_cpt_args );
	
}

add_action( 'init', 'chumly_post_types_setup' );

function hide_metabox() {
	remove_meta_box(
		'tagsdiv-chumly_post_format',
		'chumly_status_post',
		'side'
	);
}

//add_action( 'admin_menu', 'hide_chumly_post_format_metabox' );