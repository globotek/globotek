<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 29/11/16
 * Time: 2:36 PM
 */

/**
 * Global Hooks.
 */
add_action('chumly_before_content', 'chumly_check_login');

/**
 * Content Wrappers.
 */
add_action( 'chumly_before_content', 'chumly_output_wrapper_start', 5 );
add_action( 'chumly_after_content', 'chumly_output_wrapper_end', 5 );


/**
 * Profile Template Parts.
 */
add_action( 'chumly_profile_header', 'chumly_profile_picture', 5 );
add_action( 'chumly_profile_header', 'chumly_profile_title', 10 );

add_action( 'chumly_profile_interactions', 'chumly_profile_networks', 5 );
add_action( 'chumly_profile_interactions', 'chumly_profile_interactions', 10 );

add_action( 'chumly_profile_sidebar', 'chumly_profile_intro', 5 );
add_action( 'chumly_profile_sidebar', 'chumly_friends_grid', 10 );


/**
 *
 */
add_action('chumly_profile_header', function(){
	
	global $chumly_user;
	
	if(!$chumly_user->id){
		
		chumly_check_login( TRUE );
		
	}
	
});


/**
 * User Sidebar.
 */
add_action( 'chumly_settings_sidebar', 'chumly_user_settings_menu', 10 );