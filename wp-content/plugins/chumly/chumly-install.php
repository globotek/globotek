<?php
/*
 * Run installation functions. These only need  to run on initial
 * activation so we will create a WP Option to record successful
 * installation and prevent from running on every page load.
 */

global $wpdb;

/*
 * Create Tables
 */
$prefix              = $wpdb->prefix . 'chumly_';
$options_table       = $prefix . 'options';
$inputs_table        = $prefix . 'inputs';
$input_groups_table  = $prefix . 'input_groups';
$profiles_table      = $prefix . 'profiles';
$groups_table        = $prefix . 'groups';
$group_members_table = $prefix . 'group_members';
$friends_table       = $prefix . 'friends';
$conversations_table = $prefix . 'conversations';
$messages_table      = $prefix . 'messages';
$notifications_table = $prefix . 'notifications';
//$posts_table          = $prefix . 'posts';

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
require_once( 'chumly-db-statements.php' );

dbDelta( $create_options_table );
dbDelta( $create_inputs_table );
dbDelta( $create_input_groups_table );
dbDelta( $create_friends_table );
dbDelta( $create_conversations_table );
dbDelta( $create_messages_table );
dbDelta( $create_groups_table );
dbDelta( $create_group_members_table );
dbDelta( $create_notifications_table );

/*
 * Generate and submit all the default data that's created on install
 * and is required for Chumly to function.
 *
 *
 * Default install Profile Field Inputs
 */
$wpdb->query( "INSERT INTO $inputs_table
	(ID, input_id, input_order, input_name, input_label, input_type, input_required, input_instructions, input_data, input_location, input_group, input_permanent, input_active, input_placement, user_type)
	VALUES
	(NULL, 'required_1', 1, 'username', 'Username', 'text', 1, NULL, 'a:0:{}', 'required', 'default', 1, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'user'),
	(NULL, 'required_2', 2, 'user_email', 'Email', 'email', 1, NULL, 'a:0:{}', 'required', 'default', 1, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'user'),
	(NULL, 'required_3', 3, 'first_name', 'First Name', 'text', 1, NULL, 'a:0:{}', 'required', 'default', 1, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'user'),
	(NULL, 'required_4', 4, 'last_name', 'Last Name', 'text', 1, NULL, 'a:0:{}', 'required', 'default', 1, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'user'),
	(NULL, 'required_5', 5, 'password_one', 'Password', 'password', 1, NULL, 'a:0:{}', 'required', 'default', 1, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'user'),
	(NULL, 'required_6', 6, 'password_two', 'Confirm Password', 'password', 1, NULL, 'a:0:{}', 'required', 'default', 1, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'user'),
	(NULL, 'profile_1', 1, 'profile_picture', 'Profile Picture', 'avatar', 1, NULL, 'a:0:{}', 'profile', 'default', 1, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'user'),
	(NULL, 'profile_2', 2, 'profile_introduction', 'Introduction', 'textarea', 1, NULL, 'a:0:{}', 'profile', 'default', 1, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'user'),
	(NULL, 'group_1', 1, 'group_name', 'Name', 'text', 1, NULL, 'a:0:{}', 'group', 'default', 1, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'group'),
	(NULL, 'group_2', 2, 'group_description', 'Description', 'textarea', 1, NULL, 'a:0:{}', 'group', 'default', 1, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'group'),
	(NULL, 'group_3', 3, 'group_privacy', 'Privacy', 'radio', 1, NULL, 'a:0:{}', 'group', 'default', 1, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'group'),
	(NULL, 'group_4', 4, 'group_invites', 'Send Invites', 'invite', 1, NULL, 'a:0:{}', 'group', 'default', 1, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'group'),
	(NULL, 'group_5', 5, 'group_logo', 'Group Logo', 'avatar', 1, NULL, 'a:0:{}', 'group', 'default', 1, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'group')
" );

/*
 * Default install Input Group
 */
$wpdb->query( "INSERT INTO $input_groups_table
	(ID, input_group_name, user_type, user_role, admin_approval, dashboard_access, required, wp_user_role, wp_capabilities)
	VALUES
	(NULL, 'Default', 'user', 'default', 0, 0, 1, 'subscriber', '" . serialize( array( 'subscriber' ) ) . "'),
	(NULL, 'Default', 'group', 'default', 0, 0, 1, NULL, NULL)
" );


/*
 * Install Chumly pages
 */
$register_page_id = wp_insert_post( array(
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'post_title'   => 'Register',
	'post_content' => '[chumly_registration]'
) );

$login_page_id = wp_insert_post( array(
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'post_title'   => 'Login',
	'post_content' => '[chumly_login]'
) );

$members_page_id = wp_insert_post( array(
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'post_title'   => 'Members',
	'post_content' => '[chumly_members]'
) );

$profile_page_id = wp_insert_post( array(
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'post_title'   => 'Profile',
	'post_content' => '[chumly_user_profile]'
) );

$edit_profile_page_id = wp_insert_post( array(
	'post_type'    => 'page',
	'post_parent'  => $profile_page_id,
	'post_status'  => 'publish',
	'post_title'   => 'Edit Profile',
	'post_name'    => 'edit',
	'post_content' => '[chumly_edit_profile]'
) );

$groups_page_id = wp_insert_post( array(
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'post_title'   => 'Groups',
	'post_content' => '[chumly_groups]'
) );

$group_page_id = wp_insert_post( array(
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'post_title'   => 'Group',
	'post_content' => '[chumly_group_profile]'
) );

$create_group_page_id = wp_insert_post( array(
	'post_type'    => 'page',
	'post_parent'  => $group_page_id,
	'post_status'  => 'publish',
	'post_title'   => 'Create Group',
	'post_content' => '[chumly_create_group]'
) );

$edit_group_page_id = wp_insert_post( array(
	'post_type'    => 'page',
	'post_parent'  => $group_page_id,
	'post_status'  => 'publish',
	'post_title'   => 'Edit Group',
	'post_name'    => 'edit',
	'post_content' => '[chumly_edit_group]'
) );

$messaging_page_id = wp_insert_post( array(
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'post_title'   => 'Messaging',
	'post_content' => '[chumly_messaging]'
) );

$notifications_page_id = wp_insert_post( array(
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'post_title'   => 'Notifications',
	'post_content' => '[chumly_notifications]'
) );

$newsfeed_page_id = wp_insert_post( array(
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'post_title'   => 'Newsfeed',
	'post_content' => '[chumly_dashboard]'
) );

$settings_page_id = wp_insert_post( array(
	'post_type'   => 'page',
	'post_status' => 'publish',
	'post_title'  => 'User Preferences'
) );

/*
 * Set the necessary default options on install
 */
$wpdb->query( "INSERT INTO $options_table
	(option_id, option_name, option_value)
	VALUES
	(NULL, 'required_index', 6),
	(NULL, 'registration_index', 0),
	(NULL, 'new_user_index', 0),
	(NULL, 'profile_index', 2),
	(NULL, 'group_index', 5),
	(NULL, 'inputs_index', 13),
	(NULL, 'user_profile_page', 'profile'),
	(NULL, 'edit_profile_page_id', '" . $edit_profile_page_id . "'),
	(NULL, 'user_archive_page', 'members'),
	(NULL, 'user_messaging_page', 'messaging'),
	(NULL, 'group_profile_page', 'group'),
	(NULL, 'group_create_page_id', '" . $create_group_page_id . "'),
	(NULL, 'group_edit_page_id', '" . $edit_group_page_id . "'),
	(NULL, 'group_archive_page', 'groups'),
	(NULL, 'notifications_page', 'notifications'),
	(NULL, 'login_page', 'login'),
	(NULL, 'dashboard_page', 'newsfeed')
" );

/*
 * Give all existing users the Chumly role of default.
 * This is the only role available on install.
 */
$wpdb->query( '
	INSERT INTO ' . $wpdb->prefix . 'usermeta(umeta_id, user_id, meta_key, meta_value)
	SELECT NULL, ID, "_chumly_user_role", "default"
	FROM ' . $wpdb->prefix . 'users'
);


/*
 * Chumly metadata that we save after everything else has run.
 * Save version number so we can update things conditionally.
 * For example, data structure updates on version change.
 */
add_option( 'chumly_installed', TRUE );
add_option( 'chumly_version', '1.0' );

$upload_dir = wp_upload_dir()[ 'basedir' ] . '/chumly';

if ( ! is_dir( $upload_dir ) ) {
	mkdir( $upload_dir, 0700 );
}

$source = plugin_dir_path( __FILE__ ) . 'install';

rename( $source, $upload_dir );