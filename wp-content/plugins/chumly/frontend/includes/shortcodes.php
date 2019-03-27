<?php
function chumly_registration( $atts, $content = NULL ) {
	
	ob_start();
	include_once( plugin_dir_path( __DIR__ ) . 'templates/access/registration.php' );
	$output = ob_get_clean();
	
	return $output;
}

add_shortcode( 'chumly_registration', 'chumly_registration' );


function chumly_login( $atts = array() ) {
	ob_start();
	include( plugin_dir_path( __DIR__ ) . 'templates/access/login.php' );
	$output = ob_get_clean();
	
	return $output;
}

add_shortcode( 'chumly_login', 'chumly_login' );


function chumly_dashboard() {
	ob_start();
	include( plugin_dir_path( __DIR__ ) . 'templates/newsfeed/newsfeed.php' );
	$output = ob_get_clean();
	
	return $output;
}

add_shortcode( 'chumly_dashboard', 'chumly_dashboard' );


function chumly_members() {
	ob_start();
	include_once( chumly_locate_template( '', 'archive-user' ) );
	$output = ob_get_clean();
	
	return $output;
}

add_shortcode( 'chumly_members', 'chumly_members' );


function chumly_user_profile() {
	
	ob_start();
	
	global $chumly_user;
	
	if ( file_exists( chumly_locate_template( '', 'single-user_' . $chumly_user->role ) ) ) {
		
		include_once( chumly_locate_template( '', 'single-user_' . $chumly_user->role ) );
		
	} else {
		
		include_once( chumly_locate_template( '', 'single-user' ) );
		
	}
	
	$output = ob_get_clean();
	
	return $output;
}

add_shortcode( 'chumly_user_profile', 'chumly_user_profile' );


function chumly_edit_user_profile() {
	ob_start();
	include_once( plugin_dir_path( __DIR__ ) . 'templates/user/edit-profile.php' );
	$output = ob_get_clean();
	
	return $output;
}

add_shortcode( 'chumly_edit_profile', 'chumly_edit_user_profile' );


function chumly_groups() {
	ob_start();
	include_once( plugin_dir_path( __DIR__ ) . 'templates/archive-group.php' );
	$output = ob_get_clean();
	
	return $output;
}

add_shortcode( 'chumly_groups', 'chumly_groups' );


function chumly_group_profile() {
	ob_start();
	include_once( plugin_dir_path( __DIR__ ) . 'templates/single-group.php' );
	$output = ob_get_clean();
	
	return $output;
}

add_shortcode( 'chumly_group_profile', 'chumly_group_profile' );


function chumly_edit_group_profile() {
	ob_start();
	include_once( plugin_dir_path( __DIR__ ) . 'templates/group/edit-group.php' );
	$output = ob_get_clean();
	
	return $output;
}

add_shortcode( 'chumly_edit_group', 'chumly_edit_group_profile' );


function chumly_create_group_profile() {
	ob_start();
	include_once( plugin_dir_path( __DIR__ ) . 'templates/group/create-group.php' );
	$output = ob_get_clean();
	
	return $output;
}

add_shortcode( 'chumly_create_group', 'chumly_create_group_profile' );


function chumly_notifications() {
	ob_start();
	include_once( plugin_dir_path( __DIR__ ) . 'templates/notifications/notifications.php' );
	$output = ob_get_clean();
	
	return $output;
}

add_shortcode( 'chumly_notifications', 'chumly_notifications' );


function chumly_user_settings() {
	ob_start();
	include_once( plugin_dir_path( __DIR__ ) . 'templates/settings/user-settings.php' );
	$output = ob_get_clean();
	
	return $output;
}

add_shortcode( 'chumly_user_settings', 'chumly_user_settings' );


function chumly_privacy() {
	ob_start();
	include_once( plugin_dir_path( __DIR__ ) . 'templates/settings/privacy.php' );
	$output = ob_get_clean();
	
	return $output;
}

//add_shortcode( 'chumly_privacy', 'chumly_privacy' );


function chumly_emails() {
	ob_start();
	include_once( plugin_dir_path( __DIR__ ) . 'templates/settings/emails.php' );
	$output = ob_get_clean();
	
	return $output;
}

//add_shortcode( 'chumly_emails', 'chumly_emails' );


function chumly_message_center() {
	ob_start();
	include_once( plugin_dir_path( __DIR__ ) . 'templates/messaging/message-center.php' );
	//include_once(plugin_dir_path(__DIR__) . 'templates/messaging/message-center.original.php');
	$output = ob_get_clean();
	
	return $output;
}

add_shortcode( 'chumly_messaging', 'chumly_message_center' );
