<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 29/11/16
 * Time: 2:39 PM
 */
function chumly_locate_template( $directory, $file, $post_id = NULL, $data = array() ) {
	
	global $chumly;
	
	$template_path = NULL;
	
	if( $directory != NULL ) {
		$directory = trailingslashit( $directory );
	}
	
	$chumly_template_directories = apply_filters( 'chumly_template_directories_setup', array( plugin_dir_path( __DIR__ ) . 'templates', get_stylesheet_directory() . '/chumly' ) );
	
	if( file_exists( $chumly->templates->paths->theme_path . $directory . $file . '.php' ) ) {
		
		$template_path = $chumly->templates->paths->theme_path . $directory . $file . '.php';
		
	} else {
		
		foreach( $chumly_template_directories as $template_directory ) {
			
			if( file_exists( trailingslashit( $template_directory ) . $directory . $file . '.php' ) ) {
				
				$template_path = trailingslashit( $template_directory ) . $directory . $file . '.php';
				
			}
			
		}
		
	}
	
	//set_query_var( 'chumly_page', $file );
	
	return $template_path;
	
}


function chumly_get_template( $directory, $file, $post_id = NULL, $data = array() ) {
	
	include( chumly_locate_template( $directory, $file, $post_id, $data ) );
	
}


function chumly_inject_template( $template_name, $template_directory = NULL, $post_id = NULL, $data = array() ) {
	
	add_filter( 'the_content', function( $content ) use ( $template_name, $template_directory, $post_id, $data ) {
		
		if( !is_chumly_page() ) {
			
			return $content;
			
		}
		
		ob_start();
		
		chumly_get_template( $template_directory, $template_name, $post_id, $data );
		
		$content = ob_get_clean();
		
		ob_flush();
		
		return $content;
		
		
	} );
	
}


function chumly_get_page_template() {
	
	if( file_exists( get_stylesheet_directory() . '/page.php' ) ) {
		
		return get_stylesheet_directory() . '/page.php';
		
	} else {
		
		return get_template_directory() . '/page.php';
		
	}
	
}


function is_chumly_page() {
	
	return get_query_var( 'chumly_page' );
	
}


function chumly_sidebar( $sidebar_name ) {
	
	chumly_get_template( 'sidebars', $sidebar_name );
	
}


/**
 * @param $modal_template Filename of modal template part
 * @param $modal_id       The ID given to the modal for targeting modals when multiple modals in use on one template
 * @param $submit_label   The label used for the positive action button in the modal footer
 * @param $post_id        Post ID to load into the modal template part - can be assigned to modal trigger
 */
function chumly_modal( $modal_template = NULL, $modal_id = NULL, $submit_label = 'Update', $post_id = NULL ) {
	
	chumly_get_template( 'modal', 'frame', $post_id, array(
		'modal_template' => $modal_template,
		'modal_id'       => $modal_id,
		'submit_label'   => $submit_label
	) );
	
}


function chumly_load_modal_body() {
	
	chumly_get_template( 'modal', $_POST[ 'modal_template' ], $_POST[ 'post_id' ] );
	
	chumly_die();
	
}

add_action( 'wp_ajax_chumly_load_modal_body', 'chumly_load_modal_body' );
add_action( 'wp_ajax_nopriv_chumly_load_modal_body', 'chumly_load_modal_body' );


/** Global Templates */
function chumly_output_wrapper_start() {
	chumly_get_template( 'global', 'wrapper-start' );
}


function chumly_output_wrapper_end() {
	chumly_get_template( 'global', 'wrapper-end' );
}


function chumly_upload_meter() {
	include( plugin_dir_path( __DIR__ ) . '/images/icons/upload-meter.svg' );
	
	chumly_die();
}

add_action( 'wp_ajax_nopriv_chumly_upload_meter', 'chumly_upload_meter' );
add_action( 'wp_ajax_chumly_upload_meter', 'chumly_upload_meter' );

function chumly_post_feed( $data = NULL ) {
	
	chumly_get_template( 'global', 'post-feed', get_the_ID(), $data );
	
}

/**
 * Profile Templates
 */
function chumly_profile_picture() {
	chumly_get_template( 'user', 'picture' );
}

function chumly_profile_title() {
	chumly_get_template( 'user', 'title' );
}

function chumly_profile_networks() {
	chumly_get_template( 'user', 'networks' );
}

function chumly_profile_interactions() {
	chumly_get_template( 'user', 'connection-button' );
}

function chumly_profile_intro() {
	chumly_get_template( 'user', 'intro' );
}

function chumly_friends_grid() {
	chumly_get_template( 'user', 'friends-grid' );
}


/**
 * Settings Templates
 */
function chumly_user_settings_menu( $settings_panels ) {
	chumly_get_template( 'settings', 'sidebar-menu', NULL, $settings_panels );
}

