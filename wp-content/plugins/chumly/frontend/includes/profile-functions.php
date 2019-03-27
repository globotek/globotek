<?php
function chumly_is_profile() {
	
	if( get_query_var( 'pagename' ) == chumly_get_option( 'user_profile_page' ) ) {
		
		return TRUE;
		
	} else {
		
		return FALSE;
		
	}
	
}


function chumly_own_profile() {
	
	if( chumly_user_id() == get_current_user_id() ) {
		
		return TRUE;
		
	}
	
}


function chumly_current_profile() {
	
	$user_id = 3;
	
	return $user_id;
	
}


function chumly_profile_url( $user_id = NULL ) {
	
	if( $user_id && is_user_logged_in() ) {
		
		if( !$user_id ) {
			$user_id = get_current_user_id();
		}
		
		$username = strtolower( str_replace( ' ', '_', chumly_username( $user_id ) ) . '_' . $user_id );
		
		return home_url( '/' ) . trailingslashit( chumly_get_option( 'user_archive_page' ) ) . $username;
		
	} else {
		
		return home_url( '/' ) . trailingslashit( chumly_get_option( 'user_profile_page' ) );
		
	}
	
}


function chumly_get_profile( $params = array() ) {
	
	if( !$params[ 'user_id' ] ) {
		$params[ 'user_id' ] = chumly_user_id();
	}
	
	$profile_data = get_user_meta( $params[ 'user_id' ], 'profile_fields', TRUE );
	
	if( !empty( $params[ 'exclude' ] ) ) {
		$excludes = $params[ 'exclude' ];
	}
	
	if( !empty( $profile_data ) ) {
		
		$profile_data = (object)chumly_unserialize( $profile_data );
		
		foreach( $profile_data as $key => $value ) {
			
			//if( !in_array( $value[ 'field_name' ], $excludes ) ) {
				
				$profile_data->$key = (object)$value;
				
			//}
			
		}
		
		return $profile_data;
		
	} else {
		
		return new stdClass();
		
	}
	
}


function chumly_profile( $params = array() ) {
	
	$profile_fields = chumly_get_profile( $params );
	
	if( $profile_fields && !property_exists( $profile_fields, 'error' ) ) {
		
		foreach( $profile_fields as $field ) {
			
			if( !empty( $field->field_type ) && strpos( $field->field_id, 'profile_' ) === 0 ) {
				
				chumly_field( $field, $params[ 'labels' ] );
				
			}
			
		}
		
	}
	
}


function chumly_get_profile_field( $user_ID = NULL, $field_identifier, $selector = 'name' ) {
//	var_dump( $field_identifier );
//	var_dump( $user_ID );
	if( $selector == 'name' ) {
		
		$input = chumly_get_input( array(
			'name' => $field_identifier
		) );
		
	} elseif( $selector == 'id' ) {
		
		$input = chumly_get_input( array( 'id' => $field_identifier ) );
		
	}

//	var_dump( $input );
	$profile_data = chumly_get_profile( array( 'user_id' => $user_ID ) );
	//var_dump( $profile_data );
	if( !empty( $profile_data ) ) {
		
		$input_id = $input->input_id;
		
		//var_dump($profile_data->$input_id);
		return $profile_data->$input_id;
		
	}
}


function chumly_profile_field( $field_name, $selector = 'name', $user_ID = NULL ) {
	
	if( !$user_ID ) {
		$user_ID = get_current_user_id();
	}
	
	$field = chumly_get_profile_field( $user_ID, $field_name, $selector );
	
	if( $field->value ) {
		return $field->value;
	}
	
}


function chumly_register_profile( $attributes = array() ) {
	
	$default_atts = array(
		'location'     => 'registration',
		'user_role'    => 'default',
		'wp_user_role' => 'subscriber'
	);
	
	$atts = wp_parse_args( $attributes, $default_atts );
	
	$input_group = chumly_get_input_group_data( $atts[ 'user_role' ] );
	
	$reg_inputs[] = chumly_get_input_group( array(
		'location' => 'required',
		'group'    => $atts[ 'user_role' ]
	), FALSE );
	
	if( empty( $reg_inputs[ 0 ] ) ) {
		$error = new stdClass();
		echo $error->error = '<p><strong>Error:</strong> The Input Group entered into the chumly_registration shortcode doesn\'t exist.</p>';
		
		return $error;
	}
	
	$reg_inputs[] = chumly_get_input_group( array(
		'location' => 'registration',
		'group'    => $atts[ 'user_role' ]
	), FALSE );
	
	$reg_inputs[] = chumly_get_input_group( array(
		'location' => 'profile',
		'group'    => $atts[ 'user_role' ]
	), FALSE );
	
	/**
	 * Form Meta Data
	 */
	echo '<input type="hidden" name=meta_data[show_admin_bar_front]" value="' . $input_group->dashboard_access . '" />';
	echo '<input type="hidden" name=meta_data[_admin_dash_access]" value="' . $input_group->dashboard_access . '" />';
	echo '<input type="hidden" name=meta_data[_requires_activation]" value="' . $input_group->admin_approval . '" />';
	echo '<input type="hidden" name="meta_data[_chumly_user_role]" value="' . $atts[ 'user_role' ] . '" />';
	echo '<input type="hidden" name="signup_data[wp_user_role]" value="' . $atts[ 'wp_user_role' ] . '" />';
	
	
	foreach( $reg_inputs as $reg_set ) {
		
		foreach( $reg_set as $reg_input ) {
			
			$reg_form[] = $reg_input;
			
		}
		
	}
	
	chumly_load_profile_form( $reg_form );
	
	if( isset( $_POST[ 'register_profile' ] ) ) {
		
		$new_user_ID = chumly_create_user();
		
		if( is_wp_error( $new_user_ID ) ) {
			
			foreach( $new_user_ID->errors as $error_type ) {
				foreach( $error_type as $error ) {
					echo chumly_alert( 'error', $error );
				}
			}
			
		} else {
			
			$query_params = array_merge( $_GET, array( 'registered' => 'true' ) );
			$redirect_url = ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] !== 'off' ? 'https' : 'http' ) . '://' . $_SERVER[ 'HTTP_HOST' ] . strtok( $_SERVER[ 'REQUEST_URI' ], '?' ) . '?' . http_build_query( $query_params );
			
			wp_redirect( $redirect_url );
			
			exit;
			
			
		}
		
		
	}
	
}


function chumly_edit_profile( $exclude = array(), $location = array() ) {
	
	$user_role = get_user_meta( get_current_user_id(), '_chumly_user_role', TRUE );
	
	$exclude_defaults = array( 'username' );
	
	$exclude_args = wp_parse_args( $exclude, $exclude_defaults );
	
	$exclude_args = apply_filters( 'chumly_edit_profile_exclude_fields', $exclude_args );
	
	if( empty( $location ) ) {
		$location = array( 'profile', 'required' );
	}
	
	/** @var $profile_inputs = get all the inputs to build the form with. */
	$profile_inputs = chumly_all_inputs( array(
		'location' => $location,
		'group'    => array( $user_role ),
		'exclude'  => $exclude_args
	) );
	
	//var_dump( $profile_inputs );
	
	/** Load the form with the loaded inputs. */
	chumly_load_profile_form( $profile_inputs );
	
}


function chumly_update_field( $user_ID, $input_id, $field_data, $profile_data = array() ) {
	
	if( empty( $profile_data ) ) {
		$profile_data = (array)chumly_get_profile( array( 'user_id' => $user_ID ) );
	}
	
	if( !is_array( $field_data ) ) {
		
		$field_data = array( 'value' => $field_data );
		
	}
	
	$input = chumly_get_input( array( 'id' => $input_id ) );
	
	if( $input ) {
		
		/** Validate and sanitize the input values using a prepare function. */
		$data = array( 'input' => $input, 'value' => $field_data, 'user_id' => $user_ID );
		
		$value = apply_filters( 'chumly_process_' . $input->input_type . '_field', $data );
		
		$profile_data[ $input_id ] = array(
			'field_id'   => $input_id,
			'field_name' => $input->input_name,
			'label'      => $field_data[ 'label' ],
			'value'      => $value,
			'placement'  => $field_data[ 'input_placement' ],
			'field_type' => $field_data[ 'field_type' ]
		);
		
		update_user_meta( $user_ID, $input_id, $value );
		
	}
	
	return $profile_data;
	
}


function chumly_update_profile( $user_ID = NULL ) {
	
	if( empty( $user_ID ) ) {
		$user_ID = get_current_user_id();
	}
	
	if( !isset( $_POST[ 'signup_data' ] ) ) {
		
		if( empty( $_POST[ 'password_two' ] ) ) {
			
			wp_update_user( array(
				'ID'           => esc_attr( $user_ID ),
				'user_email'   => esc_attr( $_POST[ 'required_2' ][ 'value' ] ),
				'display_name' => esc_attr( $_POST[ 'required_3' ][ 'value' ] . ' ' . $_POST[ 'required_4' ][ 'value' ] ),
				'first_name'   => esc_attr( $_POST[ 'required_3' ][ 'value' ] ),
				'last_name'    => esc_attr( $_POST[ 'required_4' ][ 'value' ] )
			) );
			
		} else {
			
			wp_update_user( array(
				'ID'           => esc_attr( $user_ID ),
				'user_pass'    => esc_attr( $_POST[ 'required_6' ][ 'value' ] ),
				'user_email'   => esc_attr( $_POST[ 'required_2' ][ 'value' ] ),
				'display_name' => esc_attr( $_POST[ 'required_3' ][ 'value' ] . ' ' . $_POST[ 'required_4' ][ 'value' ] ),
				'first_name'   => esc_attr( $_POST[ 'required_3' ][ 'value' ] ),
				'last_name'    => esc_attr( $_POST[ 'required_4' ][ 'value' ] )
			) );
		}
		
	}
	
	unset( $_POST[ 'required_5' ] );
	unset( $_POST[ 'required_6' ] );
	unset( $_POST[ 'action' ] );
	
	$profile_data = (array)chumly_get_profile( array( 'user_id' => $user_ID ) );
	
	if( !chumly_ajax() ) {
		
		foreach( $_FILES as $meta_key => $meta_data ) {
			
			$input = chumly_get_input( array( 'id' => $meta_key ) );
			
			/** Validate and sanitize the input values using a prepare function. */
			$data = array( 'input' => $input, 'value' => $meta_data, 'user_id' => $user_ID );
			
			if( !chumly_ajax() ) {
				//var_dump( $data );
				$save_file = new Chumly_Upload();
				
				$data[ 'attachment_id' ] = $save_file->save_file( intval( get_user_meta( $user_ID, '_media_post', TRUE ) ), $input->input_location . '-' . $input->input_name, $user_ID );
				var_dump( $data );
			}
			
			apply_filters( 'chumly_process_' . $input->input_type . '_field', $data );
			
		}
		
	} else {
		
		foreach( $_FILES as $input_id => $file_data ) {
			
			if( $file_data[ 'size' ][ 0 ] > 0 ) {
				
				$input = chumly_get_input( array( 'id' => $input_id ) );
				
				if( $input ) {
					var_dump( $_FILES );
					
					/** Validate and sanitize the input values using a prepare function. */
					$data = array( 'input' => $input, 'value' => $file_data, 'user_id' => $user_ID, 'hello_world' => 'go for it' );
					
					$value = apply_filters( 'chumly_process_' . $input->input_type . '_field', $data );
					
					$profile_data[ $input_id ] = array(
						'field_id'   => $input_id,
						'field_name' => $input->input_name,
						'label'      => $input->input_label,
						'value'      => $value,
						'placement'  => $input->input_placement,
						'field_type' => $input->input_type
					);
					
					//	var_dump( $value );
					
					update_user_meta( $user_ID, $input_id, $value );
					
				}
				
			} else {
				
				$field = chumly_get_profile_field( $user_ID, $input_id, 'id' );
				$profile_data[ $input_id ] = $field;
			}
			
		}
		
	}
	
	foreach( $_POST as $input_id => $field_data ) {
		
		$profile_data = chumly_update_field( $user_ID, $input_id, $field_data, $profile_data );
		
	}
	
	update_user_meta( $user_ID, 'profile_fields', chumly_serialize( $profile_data ) );
	
	chumly_die();
	
}

add_action( 'wp_ajax_chumly_update_profile', 'chumly_update_profile' );
add_action( 'wp_ajax_nopriv_chumly_update_profile', 'chumly_update_profile' );


function chumly_load_profile_form( $profile_inputs ) {
	
	if( is_user_logged_in() ) {
		
		$input_values = chumly_get_profile();
		//	var_dump( $input_values );
	} elseif( isset( $_POST[ 'register_profile' ] ) ) {
		
		$input_values = new stdClass();
		foreach( $_POST as $key => $value ) {
			
			$input_values->$key = (object)$value;
			
		}
		
	}
	
	foreach( $profile_inputs as $input ) {
		
		$value_key = $input->input_id;
		$value = $input_values->$value_key->value;
		
		chumly_input( $input, $value );
		
	}
}
