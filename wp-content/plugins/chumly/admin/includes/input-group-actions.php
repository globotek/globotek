<?php
function chumly_create_inputs_group( $user_type ) {
	$input_group = esc_attr( $_POST[ 'input_group_name' ] );
	
	if ( $_POST[ 'user_role_name' ] ) {
		$user_role = sanitize_text_field( strtolower( str_replace( ' ', '_', $_POST[ 'user_role_name' ] ) ) );
	} else {
		$user_role = sanitize_text_field( strtolower( str_replace( ' ', '_', $input_group ) ) );
	}
	
	( isset( $_POST[ 'admin_approval' ] ) ) ? $admin_approval = 1 : $admin_approval = 0;
	( isset( $_POST[ 'dashboard_access' ] ) ) ? $dashboard_access = 1 : $dashboard_access = 0;
	
	/*	foreach ( $_POST['capabilities'] as $capability_name => $capability_value ) {
			$_POST['capabilities'][ $capability_name ] = TRUE;
		}*/
	
	//var_dump( $_POST['capabilities'] );
	
	if ( ! empty( $user_role ) && ! empty( $_POST[ 'input_group_name' ] ) ) {
		
		global $wpdb;
		
		$preset_role = strtolower( str_replace( ' ', '_', $_POST[ 'preset_role' ] ) );
		var_dump( $preset_role );
		$wp_role = get_role( $preset_role );
		add_role( $user_role, $_POST[ 'input_group_name' ], $wp_role->capabilities );
		
		$capabilities = serialize( $wp_role->capabilities );
		$group_name   = ucfirst( sanitize_text_field( $_POST[ 'input_group_name' ] ) );
		
		$inputs_group_table = $wpdb->prefix . 'chumly_input_groups';
		
		$wpdb->query( "INSERT INTO $inputs_group_table
			(ID, input_group_name, user_type, user_role, admin_approval, dashboard_access, required, wp_user_role, wp_capabilities)
			VALUES
			(NULL, '$group_name', '$user_type', '$user_role', $admin_approval, $dashboard_access, 0, '$preset_role', '$capabilities')" );
		
		$input_location_index = ( chumly_get_option( $user_type . '_index' ) );
		
		if ( $input_location_index ) {
			
			if ( ! $input_location_index ) {
				$input_location_index = 0;
			}
			
			chumly_update_option( $user_type . '_' . 'index', $input_location_index );
			
		} else {
			
			chumly_set_option( $user_type . '_' . 'index', 1 );
			
		}
		
		$prefix       = $wpdb->prefix . 'chumly_';
		$inputs_table = $prefix . 'inputs';
		
		$wpdb->query( "INSERT INTO $inputs_table 
			(ID, input_id, input_order, input_name, input_label, input_type, input_required, input_instructions, input_data, input_location, input_group, input_permanent, input_active, input_placement, user_type)
			VALUES
			(NULL, 'required_1', 1, 'username', 'Username', 'text', 1, NULL, 'a:0:{}', 'required', '$user_role', 0, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'user'),
			(NULL, 'required_2', 2, 'user_email', 'Email', 'email', 1, NULL, 'a:0:{}', 'required', '$user_role', 0, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'user'),
			(NULL, 'required_3', 3, 'first_name', 'First Name', 'text', 1, NULL, 'a:0:{}', 'required', '$user_role', 0, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'user'),
			(NULL, 'required_4', 4, 'last_name', 'Last Name', 'text', 1, NULL, 'a:0:{}', 'required', '$user_role', 0, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'user'),
			(NULL, 'required_5', 5, 'password_one', 'Password', 'password', 1, NULL, 'a:0:{}', 'required', '$user_role', 0, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'user'),
			(NULL, 'required_6', 6, 'password_two', 'Confirm Password', 'password', 1, NULL, 'a:0:{}', 'required', '$user_role', 0, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'user'),
			(NULL, 'profile_1', 1, 'profile_picture', 'Profile Picture', 'avatar', 1, NULL, 'a:0:{}', 'profile', '$user_role', 0, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'user'),
			(NULL, 'profile_2', 2, 'profile_introduction', 'Introduction', 'textarea', 1, NULL, 'a:0:{}', 'profile', '$user_role', 0, 1, 'grid__item--palm-one-whole grid__item--lap--one-whole grid__item--desk--one-whole', 'user')
		" );
		
		wp_redirect( ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] !== 'off' ? 'https' : 'http' ) . '://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'REQUEST_URI' ] . '&input_group=' . $user_role . '&user_type=' . $user_type );
		
	}
}


if ( isset( $_POST[ 'delete_input_group' ] ) ) {
	
	global $wpdb;
	//var_dump($_POST);
	$user_role = $wpdb->get_var( 'SELECT user_role FROM ' . $wpdb->prefix . 'chumly_input_groups WHERE ID = ' . intval( esc_attr( $_POST[ 'delete_input_group' ] ) ) );
	remove_role( $user_role );
	
	$wpdb->delete( $wpdb->prefix . 'chumly_inputs', array( 'input_group' => esc_attr( $_POST[ 'input_group' ] ) ) );
	$wpdb->delete( $wpdb->prefix . 'chumly_input_groups', array( 'ID' => intval( esc_attr( $_POST[ 'delete_input_group' ] ) ) ) );
	
	wp_redirect( ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] !== 'off' ? 'https' : 'http' ) . '://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'REQUEST_URI' ] );
	exit;
	
}

