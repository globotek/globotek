<?php

class Chumly_Member_Connections {
	
	protected $current_user;
	
	public function __construct() {
		
		if ( isset( $_GET[ 'member_id' ] ) && $_GET[ 'member_id' ] == NULL ) {
			return FALSE;
		}
		
		$this->current_user = get_current_user_id();
		
		add_action( 'wp_ajax_chumly_update_connection_state', array( $this, 'update_connection_state' ) );
		add_action( 'wp_ajax_nopriv_chumly_update_connection_state', array( $this, 'update_connection_state' ) );
		
	}
	
	public function profile_check_connection( $target_user = NULL ) {
		
		if ( $this->current_user && $target_user ) {
			
			global $wpdb;
			
			$member_connection = $wpdb->get_row( "
					SELECT * FROM " . $wpdb->prefix . "chumly_friends
					WHERE " . $target_user . " IN(request_receiver_id, request_sender_id)
					AND " . $this->current_user . " IN(request_receiver_id, request_sender_id)",
				OBJECT );
			
			return $this->connection_data( $member_connection, $target_user );
			
		} else {
			
			return FALSE;
			
		}
		
	}
	
	public function is_connection( $target_user = NULL ) {
		
		$connection = $this->profile_check_connection( $target_user );
		
		if ( $connection[ 'delete' ] ) {
			
			return TRUE;
			
		} else {
			
			return FALSE;
			
		}
		
		
	}
	
	private function connection_data( $member_connection, $target_user ) {
		
		$current_user = get_current_user_id();
		
		if ( $member_connection->request_receiver_id == $current_user && $member_connection->connection_status == 'pending' ) {
			
			$connection_status = array(
				'accept'  => array(
					'target_user'       => chumly_user_id(),
					'status'            => $member_connection->connection_status,
					'connection_action' => 'accept',
					'connection_id'     => $member_connection->ID,
					'css_class'         => 'button--positive',
					'button_label'      => 'Accept'
				),
				'decline' => array(
					'target_user'       => chumly_user_id(),
					'status'            => $member_connection->connection_status,
					'connection_action' => 'cancel',
					'connection_id'     => $member_connection->ID,
					'css_class'         => 'button--negative',
					'button_label'      => 'Decline'
				)
			);
			
		} elseif ( $member_connection->request_sender_id == $current_user && $member_connection->connection_status == 'pending' ) {
			
			$connection_status = array(
				'cancel' => array(
					'target_user'       => chumly_user_id(),
					'status'            => $member_connection->connection_status,
					'connection_action' => 'cancel',
					'connection_id'     => $member_connection->ID,
					'css_class'         => 'button--negative',
					'button_label'      => 'Cancel Request'
				)
			);
			
		} elseif ( $member_connection->connection_status == 'active' ) {
			
			$connection_status = array(
				'delete' => array(
					'target_user'       => chumly_user_id(),
					'status'            => $member_connection->connection_status,
					'connection_action' => 'destroy',
					'connection_id'     => $member_connection->ID,
					'css_class'         => 'button--negative',
					'button_label'      => 'Unfriend'
				)
			);
			
		} else {
			
			$connection_status = array(
				'create' => array(
					'target_user'       => chumly_user_id(),
					'status'            => 'inactive',
					'connection_action' => 'create',
					'connection_id'     => '',
					'css_class'         => 'button--positive',
					'button_label'      => 'Add Friend'
				)
			);
			
		}
		
		return $connection_status;
		
	}
	
	public function update_connection_state() {
		//var_dump( $_POST );
		$receiver_id   = intval( $_POST[ 'receiver_id' ] );
		$sender_id     = intval( $_POST[ 'sender_id' ] );
		$timestamp     = intval( $_POST[ 'timestamp' ] );
		$status        = esc_attr( $_POST[ 'status' ] );
		$connection_id = intval( $_POST[ 'connection_id' ] );
		$action        = esc_attr( $_POST[ 'connection_action' ] );
		
		
		global $wpdb;
		$db_table = $wpdb->prefix . 'chumly_friends';
		
		switch ( $action ) {
			case 'create':
				$wpdb->insert( $db_table, array(
					'request_sender_id'   => $sender_id,
					'request_receiver_id' => $receiver_id,
					'connection_status'   => 'pending',
					'connection_date'     => $timestamp
				) );
				
				
				Chumly_Notifications::save_notification( array(
					'sender_id'  => $sender_id,
					'recipients' => array( $receiver_id ),
					'source'     => 'profile',
					'type'       => 'friend_request',
					'message'    => get_userdata( $sender_id )->display_name . ' wants to connect with you',
					'link'       => home_url( '/' ) . 'profile?member_id=' . $sender_id
				) );
				
				$return_data = $this->profile_check_connection( $receiver_id );
				
				break;
			case 'cancel':
			case 'decline':
			case 'destroy':
				
				$wpdb->delete( $db_table, array( 'ID' => $connection_id ) );
				
				$return_data = $this->profile_check_connection( $receiver_id );
				
				break;
			case 'accept':
				
				$wpdb->update( $db_table, array( 'connection_status' => 'active' ), array( 'ID' => $connection_id ) );
				
				//$message = '%1$s accepted your friend request';
				//chumly_save_notification( $sender_id, $receiver_id, 'friend_request', home_url( '/' ) . 'profile?member_id=' . $sender_id, $message );
				
				$return_data = $this->profile_check_connection( $receiver_id );
				
				break;
			default:
				echo 'Something isn\'t right here...try again or contact support.';
		}
		
		foreach ( $return_data as $data ) {
			$data[ 'target_user' ] = $receiver_id;
			echo json_encode( $data );
		}
		
		
		chumly_die();
	}
}

$check_connection = new Chumly_Member_Connections();