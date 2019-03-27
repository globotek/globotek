<?php
/**
 * Functions for getting input data with no wrappers.
 *
 * @param string  $input_group Registration, New User or Profile.
 * @param string  $location    Whether the field is from the group or profile pool of fields.
 * @param string  $name        The name of the field as stored under ID.
 * @param mixed[] $options     The different field options
 *
 * @return object
 *
 */
//function chumly_get_input( $input_group, $location, $name, $options = array(), $attributes = array(), $echo = FALSE, $label = TRUE ) {
function chumly_get_input( $args = array() ) {
	
	global $wpdb;
	
	$db_table = $wpdb->prefix . 'chumly_inputs';
	
	if ( count( $args ) == 1 && $args[ 'id' ] ) {
		
		$input_id = $args[ 'id' ];
		
		$query = "SELECT * FROM $db_table WHERE input_id = '$input_id'";
		
	} else {
		
		$defaults = array(
			'user_type'      => 'user',
			'location'       => array( 'profile', 'required' ),
			'group'          => 'default',
			'echo'           => FALSE,
			'exclude_fields' => array(),
			'show_labels'    => FALSE
		);
		
		$args = wp_parse_args( $args, $defaults );
		
		//var_dump($args['input_name']);
		
		$input_locations = '"' . implode( '", "', $args[ 'location' ] ) . '"';
		$input_name      = $args[ 'name' ];
		$input_group     = $args[ 'group' ];
		
		$query = "SELECT * FROM $db_table WHERE input_location IN($input_locations) AND input_name = '$input_name' AND input_group = '$input_group'";
		
		//echo $query;
	}
	
	return $wpdb->get_results( $query, 'OBJECT' )[ 0 ];
	
}

function chumly_input( $input, $value = '', $options = array() ) {
	
	if ( $input ) {
		
		//echo '$input';
		//var_dump( $input );
		$input_data = chumly_unserialize( $input->input_data );
		//var_dump( $value );
		$input_attributes = array();
		
		if ( ! empty( $input_data ) ) {
			foreach ( $input_data as $attr_name => $attr_value ) {
				//var_dump($attr_value);
				if ( $attr_value !== '' ) {
					$input_attributes[ $attr_name ] = $attr_value;
				}
				
			}
		}
		
		$required = '';
		if ( intval( $input->input_required ) === 1 ) {
			$required = 'required';
		}
		
		$input_meta = array(
			'input_placement' => $input->input_placement,
			'field_type'      => $input->input_type
		);
		
		
		$function = 'chumly_edit_' . $input->input_type . '_field';
		
		$attributes = array(
			'attributes' => $input_attributes,
			'required'   => $required,
			'value'      => $value,
			'meta'       => $input_meta
		);
		
		$function( $input, $options, $attributes );
		
		if ( empty( $input->input_label ) ) {
			echo '<span class="form__error-message">Please enter your ' . lcfirst( $input->input_label ) . '</span>';
		}
		
	} else {
		
		echo '<strong>Error: </strong>Unknown input';
		
	}
	
}


/*
 * $args['input_group'] = Which group of fields you want, based on user roles.
 * $args['input_type'] = Exclude profile or groups fields
 * $args['return'] = Return data as an object or HTML elements
 * $args['exclude_fields'] = Exclude certain fields from returned data, use field names
 * $args['show_labels'] = Only works if return is set to HTML, outputs labels if TRUE
 * $args['user_type'] = Select either user profile fields or groups fields
 */
function chumly_all_inputs( $args = array() ) {
	/**WILL BE FED FROM STOCK ROW IN GROUPS**/
	$standard_roles = array( 'default', 'subscriber', 'contributor', 'author', 'editor', 'administrator' );
	/**************************/
	
	$defaults = array(
		'user_type'    => 'user',
		'group'        => array( 'default' ),
		'location'     => array( 'profile' ),
		'echo'         => FALSE,
		'exclude'      => array(),
		'show_labels'  => FALSE,
		'input_active' => 1
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	global $wpdb;
	
	$query = "SELECT * FROM " . $wpdb->prefix . "chumly_inputs WHERE";
	
	if ( $args[ 'user_type' ] == 'user' ) {
		$query .= ' user_type = "user"';
	} else {
		$query .= ' user_type = "group"';
	}
	
	$input_groups = $args[ 'input_group' ];
	
	$input_group_count = 1;
	
	$query .= ' AND ';
	$query .= '(';
	foreach ( $args[ 'group' ] as $field ) {
		
		if ( $input_groups && $input_group_count < count( $input_groups ) ) {
			$query .= 'input_group = "' . $field . '" OR ';
		} else {
			$query .= 'input_group = "' . $field . '"';
		}
		
		$input_group_count ++;
		
	}
	$query .= ')';
	
	
	$input_locations = $args[ 'location' ];
	
	$input_locations_count = 1;
	
	$query .= ' AND (';
	foreach ( $args[ 'location' ] as $field ) {
		
		if ( $input_locations_count < count( $input_locations ) ) {
			$query .= 'input_location = "' . $field . '" OR ';
		} else {
			$query .= 'input_location = "' . $field . '"';
		}
		
		$input_locations_count ++;
		
	}
	$query .= ')';
	
	$query .= ' AND input_active = ' . $args[ 'input_active' ];
	
	$exclude = $args[ 'exclude' ];
	if ( $exclude != NULL ) {
		foreach ( $exclude as $field ) {
			$query .= ' AND input_name != "' . $field . '"';
		}
	}
	
	$query .= ' ORDER BY input_location DESC, input_order ASC';
	
	$all_fields = $wpdb->get_results( $query, 'OBJECT' );
	
	if ( $args[ 'echo' ] == FALSE ) {
		
		return $all_fields;
		
	} elseif ( $args[ 'echo' ] == TRUE ) {
		
		foreach ( $all_fields as $single_field ) {
			
			$attributes = array();
			$function   = 'chumly_edit_' . $single_field->input_type . '_field';
			$function( $single_field, NULL, $attributes );
			
		}
	}
}


function chumly_get_input_group( $location = array(), $echo = TRUE, $exclude = NULL, $label = TRUE ) {
	
	if ( $location[ 'location' ] != 'default' ) {
		
		$defaults = array(
			'group' => 'default'
		);
		
	}
	
	$args = wp_parse_args( $location, $defaults );
	
	global $wpdb;
	
	$query = "SELECT * FROM " . $wpdb->prefix . "chumly_inputs WHERE input_location = '" . $args[ 'location' ] . "' AND input_group = '" . $args[ 'group' ] . "' ORDER BY input_order";
	
	if ( $exclude != NULL ) {
		foreach ( $exclude as $field ) {
			$query .= ' AND input_name != "' . $field . '"';
		}
	}
	
	$all_fields = $wpdb->get_results( $query, 'OBJECT' );
	
	if ( $echo == FALSE ) {
		
		return $all_fields;
		
	} elseif ( $echo == TRUE ) {
		
		foreach ( $all_fields as $single_field ) {
			
			chumly_unserialize( $single_field->input_data );
			
		}
	}
}


function chumly_get_input_group_data( $input_group_name, $user_type = 'user' ) {
	
	global $wpdb;
	
	$query = "SELECT * FROM " . $wpdb->prefix . "chumly_input_groups WHERE input_group_name = '$input_group_name' AND user_type = '$user_type'";
	
	return $wpdb->get_results( $query, 'OBJECT' )[ 0 ];
	
}
