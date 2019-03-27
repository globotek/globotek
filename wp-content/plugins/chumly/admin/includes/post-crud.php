<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 20/6/18
 * Time: 10:53 PM
 */
function chumly_link_shortcodes( $post_id ) {
	
	$post         = get_post( $post_id );
	$post_content = $post->post_content;
	
	if ( has_shortcode( $post_content, 'chumly_dashboard' ) ) {
		chumly_update_option( 'dashboard_page', $post->post_name );
	}
	
	if ( has_shortcode( $post_content, 'chumly_groups' ) ) {
		chumly_update_option( 'group_archive_page', $post->post_name );
	}
	
	if ( has_shortcode( $post_content, 'chumly_group_profile' ) ) {
		chumly_update_option( 'group_profile_page', $post->post_name );
	}
	
	if ( has_shortcode( $post_content, 'chumly_members' ) ) {
		chumly_update_option( 'user_archive_page', $post->post_name );
	}
	
	if ( has_shortcode( $post_content, 'chumly_user_profile' ) ) {
		chumly_update_option( 'user_profile_page', $post->post_name );
	}
	
	if ( has_shortcode( $post_content, 'chumly_notifications' ) ) {
		chumly_update_option( 'notifications_page', $post->post_name );
	}
	
	if ( has_shortcode( $post_content, 'chumly_edit_profile' ) ) {
		chumly_update_option( 'edit_profile_page_id', $post->ID );
	}
	
	if ( has_shortcode( $post_content, 'chumly_create_group' ) ) {
		chumly_update_option( 'group_create_page_id', $post->ID );
	}
	
	if ( has_shortcode( $post_content, 'chumly_edit_group' ) ) {
		chumly_update_option( 'group_edit_page_id', $post->ID );
	}
	
	if ( has_shortcode( $post_content, 'chumly_messaging' ) ) {
		chumly_update_option( 'messaging_page', $post->post_name );
	}
	
	if ( has_shortcode( $post_content, 'chumly_user_settings' ) ) {
		chumly_update_option( 'user_settings_page', $post->post_name );
	}
	
	if ( has_shortcode( $post_content, 'chumly_login' ) ) {
		chumly_update_option( 'login_page', $post->post_name );
	}
	
	if ( has_shortcode( $post_content, 'chumly_registration' ) ) {
		chumly_update_option( 'registration_page', $post->post_name );
	}
	
	flush_rewrite_rules( TRUE );
	
}

add_action( 'save_post', 'chumly_link_shortcodes', 10, 2 );
