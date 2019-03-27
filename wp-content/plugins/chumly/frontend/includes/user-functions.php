<?php
function chumly_user_id( $url = NULL ) {
	
	if( $url == NULL ) {
		global $wp;
		
		$url = home_url( $wp->request );
	}
	
	return chumly_explode_url( $url )->ID;
	
}


function chumly_get_user_id( $name ) {
	
	$user_id = chumly_get_user( array( 'name' => $name ) )->ID;
	
	return $user_id;
	
}


function chumly_get_role( $user_id ) {
	
	return get_user_meta( $user_id, '_chumly_user_role', TRUE );
	
}


/*
 * $parts = 'first', 'last', 'full'
 */
function chumly_username( $user_id = NULL, $parts = 'full' ) {
	
	if( $user_id == NULL ) {
		$user_id = chumly_user_id();
	}
	
	$user_first_name = chumly_get_profile_field( $user_id, 'first_name' )->value;
	$user_last_name = chumly_get_profile_field( $user_id, 'last_name' )->value;
	
	switch( $parts ) {
		
		case 'first':
			
			if($user_first_name) {
				
				return $user_first_name;
				
			} else {
				
				return get_userdata($user_id)->first_name;
				
			}
			
		case 'last':
			
			if($user_last_name) {
				
				return $user_last_name;
				
			} else {
				
				return get_userdata($user_id)->last_name;
				
			}
			
		case 'full':
		default:
			
			if($user_first_name && $user_last_name) {
				
				return $user_first_name . ' ' . $user_last_name;
				
			} else {
				
				$user_data = get_userdata($user_id);
				
				return $user_data->first_name . ' ' . $user_data->last_name;
				
			}
	}
	
	
}


function chumly_get_user( $args = array() ) {
	
	if( $args[ 'name' ] ) {
		
		$user_name = explode( ' ', $args[ 'name' ] );
		
		$user = get_users(
			array(
				'meta_query' => array(
					array(
						'key'     => 'first_name',
						'value'   => $user_name[ 0 ],
						'compare' => '=='
					),
					array(
						'key'     => 'last_name',
						'value'   => $user_name[ 1 ],
						'compare' => '=='
					)
				)
			)
		);
		
		return $user[ 0 ];
		
	} elseif( $args[ 'id' ] ) {
		
		$user = get_userdata( $args[ 'id' ] );
		
		return $user;
		
	} else {
		
		$user = get_userdata( get_current_user_id() );
		
		return $user;
	}
	
}


function chumly_create_user( $args = array() ) {
	
	$defaults = array(
		'user_login'   => $_POST[ 'required_1' ][ 'value' ],
		'user_pass'    => $_POST[ 'required_6' ][ 'value' ],
		'user_email'   => $_POST[ 'required_2' ][ 'value' ],
		'first_name'   => $_POST[ 'required_3' ][ 'value' ],
		'last_name'    => $_POST[ 'required_4' ][ 'value' ],
		'display_name' => $_POST[ 'required_3' ][ 'value' ] . ' ' . $_POST[ 'required_4' ][ 'value' ],
		'role'         => $_POST[ 'signup_data' ][ 'wp_user_role' ]
	);
	
	$userdata = wp_parse_args( $args, $defaults );
	
	
	$new_user_ID = wp_insert_user( array(
		'user_login'   => esc_attr( $userdata[ 'user_login' ] ),
		'user_pass'    => esc_attr( $userdata[ 'user_pass' ] ),
		'user_email'   => esc_attr( $userdata[ 'user_email' ] ),
		'first_name'   => esc_attr( $userdata[ 'first_name' ] ),
		'last_name'    => esc_attr( $userdata[ 'last_name' ] ),
		'display_name' => esc_attr( $userdata[ 'first_name' ] . ' ' . $userdata[ 'last_name' ] ),
		'role'         => esc_attr( $userdata[ 'user_role' ] )
	) );
	
	if( is_wp_error( $new_user_ID ) ) {
		
		return $new_user_ID;
		
	} else {
		
		if( !empty( $_POST[ 'meta_data' ] ) ) {
			
			foreach( $_POST[ 'meta_data' ] as $meta_key => $meta_value ) {
				update_user_meta( $new_user_ID, $meta_key, $meta_value );
			}
			
		}
		
		chumly_create_media_bucket( $new_user_ID );
		
		chumly_update_profile( $new_user_ID );
		
		return $new_user_ID;
		
	}
	
}


function chumly_create_media_bucket( $user_id ) {
	
	$user_media_post = wp_insert_post( array(
		'post_author' => $user_id,
		'post_title'  => $user_id,
		'post_status' => 'private',
		'post_type'   => 'chumly_user_media',
		'meta_input'  => array(
			'user_id' => $user_id
		)
	) );
	
	if( !is_wp_error( $user_media_post ) ) {
		update_user_meta( $user_id, '_media_post', $user_media_post );
	}
	
	return $user_media_post;
	
}


function chumly_get_user_roles() {
	
	global $wpdb;
	
	return $wpdb->get_results( "SELECT user_role FROM " . $wpdb->prefix . "chumly_input_groups WHERE user_type = 'user'", ARRAY_A );
	
}