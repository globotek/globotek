<?php
function chumly_get_friends( $user_id = NULL, $limit = 12 ) {
	global $wpdb;
	
	if ( $user_id === NULL ) {
		$user_id = get_current_user_id();
	}
	
	if( !$limit ){
		$limit = 1000000;
	}
	
	$db_table = $wpdb->prefix . 'chumly_friends';
	$contacts = $wpdb->get_results( "
			SELECT * FROM $db_table
			WHERE (request_receiver_id = $user_id OR request_sender_id = $user_id) 
			AND connection_status = 'active' LIMIT 0, $limit",
		OBJECT );
	
	if ( !empty( $contacts ) ) {
		foreach ( $contacts as $contact ) {
			if ( $contact->request_sender_id != $user_id ) {
				$include_array[] = (int)$contact->request_sender_id;
			}
			
			if ( $contact->request_receiver_id != $user_id ) {
				$include_array[] = (int)$contact->request_receiver_id;
			}
		}
		
		$query = new WP_User_Query( array(
			'include' => $include_array,
			'exclude' => array( $user_id )
		) );
				
		return $query->results;
	}
	
}


function chumly_get_pending_friend_requests( $user_id = NULL, $limit = 12 ) {
	
	global $wpdb;
	
	if ( $user_id === NULL ) {
		$user_id = get_current_user_id();
	}
	
	$db_table = $wpdb->prefix . 'chumly_friends';
	$contacts = $wpdb->get_results( "
			SELECT * FROM $db_table
			WHERE request_sender_id = $user_id 
			AND connection_status = 'pending' LIMIT $limit",
		OBJECT );
	
	if ( !empty( $contacts ) ) {
		foreach ( $contacts as $contact ) {
			if ( $contact->request_sender_id != $user_id ) {
				$include_array[] = (int)$contact->request_sender_id;
			}
			
			if ( $contact->request_receiver_id != $user_id ) {
				$include_array[] = (int)$contact->request_receiver_id;
			}
		}
		
		$query = new WP_User_Query( array(
			'include' => $include_array,
			'exclude' => array( $user_id )
		) );
		
		return $query->results;
	}
	
}


function chumly_get_received_friend_requests( $user_id = NULL, $limit = 12 ) {
	
	global $wpdb;
	
	if ( $user_id === NULL ) {
		$user_id = get_current_user_id();
	}
	
	$db_table = $wpdb->prefix . 'chumly_friends';
	return $wpdb->get_results( "
			SELECT * FROM $db_table
			WHERE request_receiver_id = $user_id 
			AND connection_status = 'pending' LIMIT $limit",
		OBJECT );
	
	
/*	if ( !empty( $contacts ) ) {
		foreach ( $contacts as $contact ) {
			if ( $contact->request_sender_id != $user_id ) {
				$include_array[] = (int)$contact->request_sender_id;
			}
			
			if ( $contact->request_receiver_id != $user_id ) {
				$include_array[] = (int)$contact->request_receiver_id;
			}
		}
		
		$query = new WP_User_Query( array(
			'include' => $include_array,
			'exclude' => array( $user_id )
		) );
		
		return $query->results;
	}*/
	
}