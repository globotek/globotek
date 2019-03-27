<?php

class Chumly_Groups {
	
	protected $groups_table, $members_table, $current_user;
	
	public function __construct() {
		
		add_action( 'wp_ajax_chumly_delete_group', array( $this, 'delete_group' ) );
		add_action( 'wp_ajax_nopriv_chumly_delete_group', array( $this, 'delete_group' ) );
		
		add_action( 'wp_ajax_chumly_save_group', array( $this, 'save_group' ) );
		add_action( 'wp_ajax_nopriv_chumly_save_group', array( $this, 'save_group' ) );
		
		global $wpdb;
		
		$this->groups_table = $wpdb->prefix . 'chumly_groups';
		$this->members_table = $wpdb->prefix . 'chumly_group_members';
		$this->current_user = get_current_user_id();
		
	}
	
	protected function get_group_member( $group_id, $user_id ) {
		
		global $wpdb;
		
		return $wpdb->get_row( "SELECT * FROM " . $this->members_table . " WHERE group_id = $group_id AND user_id = $user_id", OBJECT );
		
	}
	
	public function get_group_members( $group_id, $membership = array( 'any' ), $limit = NULL ) {
		
		global $wpdb;
		
		$group_members = new stdClass();
		
		if( !$limit ) {
			$limit = count( $wpdb->get_results( "SELECT * FROM $this->members_table WHERE group_id = $group_id", OBJECT ) );
		}
		
		if( in_array( 'all', $membership ) || in_array( 'any', $membership ) || in_array( 'admins', $membership ) ) {
			
			$group_members->admins = $wpdb->get_results( "SELECT * FROM $this->members_table WHERE group_id = $group_id AND (membership = 'owner' OR membership = 'admin') LIMIT $limit", OBJECT );
			
		}
		
		if( in_array( 'all', $membership ) || in_array( 'any', $membership ) || in_array( 'members', $membership ) ) {
			
			$group_members->members = $wpdb->get_results( "SELECT * FROM $this->members_table WHERE group_id = $group_id AND membership = 'member' LIMIT $limit", OBJECT );
			
		}
		
		if( in_array( 'all', $membership ) || in_array( 'applicants', $membership ) ) {
			
			$group_members->applicants = $wpdb->get_results( "SELECT * FROM $this->members_table WHERE group_id = $group_id AND membership = 'applicant' LIMIT $limit", OBJECT );
			
		}
		
		if( in_array( 'all', $membership ) || in_array( 'invitees', $membership ) ) {
			
			$group_members->invitees = $wpdb->get_results( "SELECT * FROM $this->members_table WHERE group_id = $group_id AND membership = 'invitee' LIMIT $limit", OBJECT );
			
		}
		
		if( in_array( 'all', $membership ) || in_array( 'banned', $membership ) ) {
			
			$group_members->banned = $wpdb->get_results( "SELECT * FROM $this->members_table WHERE group_id = $group_id AND membership = 'banned' LIMIT $limit", OBJECT );
			
		}
		
		return $group_members;
		
	}
	
	public function get_group_member_count( $group_id ) {
		
		global $wpdb;
		
		return count( $wpdb->get_results( "SELECT * FROM $this->members_table WHERE group_id = $group_id AND membership != 'banned' AND membership != 'invitee' AND membership != 'applicant'", OBJECT ) );
		
	}
	
	
	public static function get_group( $group_id ) {
		global $wpdb;
		
		return $wpdb->get_row( "
		SELECT * FROM " . $wpdb->prefix . "chumly_groups
		WHERE ID = " . $group_id,
			OBJECT );
	}
	
	
	function chumly_get_group_id( $name ) {
		
		global $wpdb;
		
		$return_data = $wpdb->get_row( "
		SELECT ID FROM " . $wpdb->prefix . "chumly_groups
		WHERE name = '" . $name . "'",
			OBJECT );
		
		return $return_data->ID;
		
	}
	
	public static function get_group_url( $group_id ) {
		
		$group = self::get_group( $group_id );
		
		return strtolower( str_replace( ' ', '_', home_url( '/' ) . chumly_get_option( 'group_archive_page' ) . '/' . $group->name . '_' . $group->ID ) );
		
	}
	
	public static function get_all_groups( $groups_per_page = 2 ) {
		
		global $wpdb;
		
		$db_table = $wpdb->prefix . 'chumly_groups';
		$groups_data = new stdClass();
		
		$current_user_id = get_current_user_id();
		
		$user_public_groups = implode( get_user_meta( $current_user_id, 'user_public_groups', TRUE ), ',' );
		$user_private_groups = implode( get_user_meta( $current_user_id, 'user_private_groups', TRUE ), ',' );
		$user_secret_groups = implode( get_user_meta( $current_user_id, 'user_secret_groups', TRUE ), ',' );
		
		if( intval( basename( $_SERVER[ 'REQUEST_URI' ] ) ) > 1 ) {
			$current_page = intval( basename( $_SERVER[ 'REQUEST_URI' ] ) );
		} else {
			$current_page = 1;
		}
		
		$offset = ( $groups_per_page * $current_page ) - $groups_per_page;
		
		if( !empty( $user_secret_groups ) ) {
			$groups_data->posts = $wpdb->get_results( "SELECT * FROM $db_table WHERE ID IN ($user_secret_groups) OR is_public IN (0,1) LIMIT $groups_per_page OFFSET $offset", OBJECT );
		} else {
			$groups_data->posts = $wpdb->get_results( "SELECT * FROM $db_table WHERE is_public IN (0,1) LIMIT $groups_per_page OFFSET $offset", OBJECT );
		}
		
		if( $groups_data->posts ) {
			
			$groups_data->limit = $wpdb->num_rows;
			$groups_data->offset = $offset;
			$groups_data->total_posts = intval( $wpdb->get_var( "SELECT COUNT(*) FROM $db_table WHERE is_public = 1" ) );
			$groups_data->current_page = $current_page;
			
		}
		
		$groups_data->total_pages = ceil( $groups_data->total_posts / $groups_per_page );
		
		return $groups_data;
		
	}
	
	public function group_fields( $group_id ) {
		
		$group = $this->get_group( $group_id );
		
		$group_data = chumly_unserialize( $group->group_data );
		
		$data = new stdClass();
		foreach( $group_data as $item ) {
			//var_dump($item);
			
			$data_key = strtolower( str_replace( ' ', '_', $item->label ) );
			
			$data->$data_key = $item;
			
		}
		
		return $data;
		
	}
	
	public static function get_data( $group_id ) {
		
		$group = self::get_group( $group_id );
		
		//var_dump( $group );
		
		return chumly_unserialize( $group->group_data );
	}
	
	public static function group_field_data( $group_ID = NULL, $field_identifier, $selector = 'name' ) {
		
		if( $selector == 'name' ) {
			
			$input = chumly_get_input( array(
				'location'  => array( 'group' ),
				'name'      => $field_identifier,
				'user_type' => 'group'
			) );
			
			
		}
		
		if( $selector == 'id' ) {
			
			$input = chumly_get_input( array(
				'id' => $field_identifier
			) );
			
		}
		
		//var_dump( $input );
		
		//var_dump( $field_identifier );
		
		$group_data = self::get_data( $group_ID );
		//var_dump( $group_data );
		if( !empty( $group_data ) ) {
			
			$input_id = $input->input_id;
			
			return $group_data->$input_id;
			
		}
		
	}
	
	public function get_group_field( $group_ID = NULL, $field_identifier, $selector = 'name' ) {
		
		$field = self::group_field_data( $group_ID, $field_identifier, $selector );
		
		//var_dump( $field );
		
		return $field->value;
		
	}
	
	public function group_field( $group_ID = NULL, $field_identifier, $selector = 'name' ) {
		
		$field = self::group_field_data( $group_ID, $field_identifier, $selector );
		chumly_field( $field );
		
	}
	
	public function get_linked_post_id( $group_id ) {
		
		global $wpdb;
		
		$db_table = $wpdb->prefix . 'chumly_groups';
		
		return intval( $wpdb->get_results( "SELECT wp_post_id FROM $db_table WHERE ID = $group_id" )[ 0 ]->wp_post_id );
		
	}
	
	public function get_group_privacy( $group_id ) {
		
		global $wpdb;
		
		return $wpdb->get_results( "SELECT privacy FROM $this->groups_table WHERE ID = $group_id" )[ 0 ]->privacy;
		
	}
	
	public function is_public( $group_id ) {
		
		global $wpdb;
		
		return intval( $wpdb->get_results( "SELECT is_public FROM $this->groups_table WHERE ID = $group_id" )[ 0 ]->is_public );
		
	}
	
	public function is_private( $group_id ) {
		
		global $wpdb;
		
		return intval( $wpdb->get_results( "SELECT is_private FROM $this->groups_table WHERE ID = $group_id" )[ 0 ]->is_private );
		
	}
	
	public function is_secret( $group_id ) {
		
		global $wpdb;
		
		return intval( $wpdb->get_results( "SELECT is_secret FROM $this->groups_table WHERE ID = $group_id" )[ 0 ]->is_secret );
		
	}
	
	public function update_user_groups( $user_id, $group_id ) {
		
		$public_groups = get_user_meta( $user_id, 'user_public_groups', TRUE );
		$private_groups = get_user_meta( $user_id, 'user_private_groups', TRUE );
		$secret_groups = get_user_meta( $user_id, 'user_secret_groups', TRUE );
		$group_privacy = $this->get_group_privacy( $group_id );
		
		$existing_public = array_search( $group_id, $public_groups );
		$existing_private = array_search( $group_id, $private_groups );
		$existing_secret = array_search( $group_id, $secret_groups );
		
		$response[ 'found' ] = $existing_public;
		$response[ 'found' ] = $existing_private;
		$response[ 'found' ] = $existing_secret;
		
		switch( $group_privacy ) {
			
			case 0:
				
				
				if( in_array( $group_id, $public_groups ) ) {
					
					unset( $public_groups[ $existing_public ] );
					
				}
				
				if( in_array( $group_id, $secret_groups ) ) {
					
					unset( $secret_groups[ $existing_secret ] );
					
				}
				
				if( is_array( $private_groups ) ) {
					
					if( !in_array( $group_id, $private_groups ) ) {
						$private_groups[] = intval( $group_id );
					}
					
				} else {
					
					$private_groups = array( intval( $group_id ) );
					
				}
				
				break;
			
			case 1:
				
				
				if( in_array( $group_id, $private_groups ) ) {
					
					unset( $private_groups[ $existing_private ] );
					
				}
				
				if( in_array( $group_id, $secret_groups ) ) {
					
					unset( $secret_groups[ $existing_secret ] );
					
				}
				
				if( is_array( $public_groups ) ) {
					
					if( !in_array( $group_id, $public_groups ) ) {
						$public_groups[] = intval( $group_id );
					}
					
				} else {
					
					$public_groups = array( intval( $group_id ) );
					
				}
				
				break;
			
			case 2:
				
				
				if( in_array( $group_id, $public_groups ) ) {
					
					unset( $public_groups[ $existing_public ] );
					
				}
				
				if( in_array( $group_id, $private_groups ) ) {
					
					unset( $private_groups[ $existing_private ] );
					
				}
				
				if( is_array( $secret_groups ) ) {
					
					if( !in_array( $group_id, $secret_groups ) ) {
						$secret_groups[] = intval( $group_id );
					}
					
				} else {
					
					$secret_groups = array( intval( $group_id ) );
					
				}
				
				break;
			
			default:
				
				return FALSE;
			/**
			 * @TODO Add error catch
			 */
			
		}
		
		$response[ 'cleared_update' ] = TRUE;
		update_user_meta( $user_id, 'user_public_groups', $public_groups );
		update_user_meta( $user_id, 'user_private_groups', $private_groups );
		update_user_meta( $user_id, 'user_secret_groups', $secret_groups );
		
		//var_dump($private_groups);
	}
	
	public function delete_user_group( $user_id, $group_id ) {
		
		$group_privacy = $this->get_group_privacy( $group_id );
		
		switch( $group_privacy ) {
			case 0:
				$meta_key = 'user_private_groups';
				break;
			case 1:
				$meta_key = 'user_public_groups';
				break;
			case 2:
				$meta_key = 'user_secret_groups';
				break;
		}
		
		$user_groups = get_user_meta( $user_id, $meta_key, TRUE );
		
		$group_key = array_search( $group_id, $user_groups );
		
		unset( $user_groups[ $group_key ] );
		
		update_user_meta( $user_id, $meta_key, $user_groups );
		
	}
	
	public function create_group( $attributes = array() ) {
		
		chumly_all_inputs( array(
			'user_type' => 'group',
			'group'     => array( 'default' ),
			'location'  => array( 'group' ),
			'echo'      => TRUE
		) );
		
		if( isset( $_POST[ 'create_group' ] ) ) {
			
			$this->save_group();
			
		}
		
	}
	
	static function edit_group( $group_id, $exclude = array() ) {
		
		$group_inputs = chumly_all_inputs( array(
			'user_type' => 'group',
			'location'  => array( 'group' ),
			'exclude'   => $exclude
		) );
		
		$input_values = self::get_data( $group_id );
		var_dump( $group_id );
		foreach( $group_inputs as $input ) {
			
			$value_key = $input->input_id;
			$value = $input_values->$value_key->value;
			//var_dump($value);
			chumly_input( $input, $value );
			
		}
		
		echo '<input type="hidden" name="group_id" value="' . $group_id . '" />';
		
	}
	
	function delete_group() {
		
		global $wpdb;
		
		$members = $this->get_group_members( $_POST[ 'group_id' ], array( 'all' ) );
		
		foreach( $members as $member ) {
			
			//$this->delete_group_member( $member->user_id, $_POST[ 'group_id' ] );
			
		}
		
		//wp_delete_post( $this->get_linked_post_id( $_POST[ 'group_id' ] ), TRUE );
		
		//$deleted_row_id = $wpdb->delete( $this->groups_table, array( 'ID' => $_POST[ 'group_id' ] ) );
		$deleted_row_id = 1;
		echo json_encode( $deleted_row_id );
		
		chumly_die();
		
	}
	
	public function save_group() {
		
		global $wpdb;
		
		if( isset( $_POST[ 'group_id' ] ) ) {
			$db_action = 'update';
		} else {
			$db_action = 'insert';
		}
		
		$response = array();
		$group_data = new stdClass();
		$group_data_array = array();
		
		foreach( $_POST as $field_key => $field_value ) {
			
			$input = chumly_get_input( array( 'id' => $field_key ) );
			
			if( $input ) {
				
				$field_data = array(
					'input' => $input,
					'value' => $field_value
				);
				
				$group_data_array[ strtolower( str_replace( ' ', '_', $field_value[ 'label' ] ) ) ] = $field_value[ 'value' ];
				
				/** Validate and sanitize the input values using a prepare function. */
				$value = apply_filters( 'chumly_process_' . $input->input_type . '_field', $field_data );
				
				if( $input->input_name == 'group_name' ) {
					
					$group_name = $value;
					
				}
				
				if( $input->input_name == 'group_privacy' ) {
					$response[ 'privacy' ] = $value;
					switch( $value ) {
						
						case 0 :
							
							$is_public = 0;
							$is_private = 1;
							$is_secret = 0;
							$privacy = 0;
							
							break;
						
						case 1:
							
							$is_public = 1;
							$is_private = 0;
							$is_secret = 0;
							$privacy = 1;
							
							break;
						
						case 2:
							
							$is_public = 0;
							$is_private = 0;
							$is_secret = 1;
							$privacy = 2;
							
							break;
						
					}
					
				}
				
				if( $input->input_name == 'group_invites' ) {
					$invited_members = chumly_serialize( array() );
				}
				
				if( !is_null( $value ) ) {
					
					$group_data->$field_key = (object)$field_value;
					$group_data->$field_key->field_id = $field_key;
					$group_data->$field_key->placement = $input->input_placement;
					$group_data->$field_key->field_type = $input->input_type;
					
				}
				
				
			}
			
		}
		
		$group_data = chumly_serialize( $group_data );
		$db_table = $wpdb->prefix . 'chumly_groups';
		
		$current_user_id = get_current_user_id();
		
		apply_filters( 'chumly_before_update_group', $_POST );
		
		$group_id = $_POST[ 'group_id' ];
		$group_timestamp = time( 'U' );
		
		switch( $db_action ) {
			
			case 'update':
				
				$wpdb->update(
					$db_table,
					array(
						'title'           => $group_name,
						'name'            => sanitize_title( $group_name ),
						'is_public'       => $is_public,
						'is_private'      => $is_private,
						'is_secret'       => $is_secret,
						'privacy'         => $privacy,
						'group_data'      => $group_data,
						'group_timestamp' => $group_timestamp
					),
					array(
						'ID' => $group_id
					)
				);
				
				$group_data_array[ 'group_id' ] = $group_id;
				
				$linked_post_id = $this->get_linked_post_id( $group_id );
				
				break;
			
			case 'insert':
				
				$wpdb->insert(
					$db_table,
					array(
						'title'           => stripslashes( $group_name ),
						'name'            => sanitize_title( $group_name ),
						'is_public'       => $is_public,
						'is_private'      => $is_private,
						'is_secret'       => $is_secret,
						'privacy'         => $privacy,
						'group_data'      => $group_data,
						'group_timestamp' => $group_timestamp
					)
				);
				
				$group_id = $wpdb->insert_id;
				
				$wpdb->insert(
					$this->members_table,
					array(
						'ID'             => NULL,
						'group_id'       => $group_id,
						'user_id'        => $this->current_user,
						'first_name'     => chumly_get_profile_field( $this->current_user, 'first_name' )->value,
						'last_name'      => chumly_get_profile_field( $this->current_user, 'last_name' )->value,
						'membership'     => 'owner',
						'banned'         => 0,
						'join_timestamp' => time()
					)
				);
				
				$linked_post_id = $wpdb->insert_id;
				
				/**
				 * @TODO Add user to group as admin
				 */
				
				$group_data_array[ 'group_id' ] = $group_id;
				
				break;
		}
		
		$response[ 'is_public' ] = $is_public;
		$response[ 'is_private' ] = $is_private;
		$response[ 'is_secret' ] = $is_secret;
		
		$members = $this->get_group_members( $group_id, array( 'any' ) );
		
		$response[ 'members' ] = $members;
		$response[ 'group_id' ] = $group_id;
		
		foreach( $members as $members_subset ) {
			
			foreach( $members_subset as $member ) {
				
				$this->update_user_groups( intval( $member->user_id ), intval( $group_id ) );
				
			}
			
		}
		
		$post_data = array(
			'ID'          => $linked_post_id,
			'post_author' => $current_user_id,
			'post_title'  => $group_name,
			'post_name'   => $group_name . '_' . $group_id,
			'post_status' => 'publish',
			'post_type'   => 'chumly_groups',
			'meta_input'  => $group_data_array
		);
		
		$group_post_id = wp_insert_post( $post_data );
		
		if( $group_post_id ) {
			
			$wpdb->update( $db_table, array( 'wp_post_id' => $group_post_id ), array( 'ID' => $group_id ) );
			
			foreach( $_FILES as $meta_key => $meta_data ) {
				
				$input = chumly_get_input( array( 'id' => $meta_key ) );
				
				/** Validate and sanitize the input values using a prepare function. */
				$data = array( 'input' => $input, 'value' => $meta_data, 'group_post_id' => $group_post_id );
				
				if( !chumly_ajax() ) {
					
					$save_file = new Chumly_Upload();
					
					
					$data[ 'attachment_id' ] = $save_file->save_file( $group_post_id, NULL, $current_user_id );
					
				}
				
				apply_filters( 'chumly_process_' . $input->input_type . '_field', $data );
				
			}
			
		}
		
		if( $group_id ) {
			wp_redirect( home_url( '/' ) . trailingslashit( chumly_get_option( 'group_archive_page' ) ) . strtolower( $group_name ) . '_' . $group_id );
		}
		
		$response[ 'linked_post_id' ] = $linked_post_id;
		
		
		if( chumly_ajax() ) {
			echo json_encode( $response );
		}
		
		chumly_die();
		
	}
	
}