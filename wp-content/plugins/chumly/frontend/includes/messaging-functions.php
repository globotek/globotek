<?php
function chumly_trigger_conversation() {
	global $wpdb;
	
	//var_dump( $_POST );
	
	if ( isset( $_POST[ 'thread_subject' ] ) ) {
		$thread_subject = esc_attr( $_POST[ 'thread_subject' ] );
	} else {
		$thread_subject = 'IM';
	}
	
	$check_for_conversation = $wpdb->get_row( '
		SELECT ID FROM ' . $wpdb->prefix . 'chumly_conversations
		WHERE sender_id = ' . $_POST[ 'sender_id' ] . ' AND receiver_id = ' . $_POST[ 'recipient_id' ] . '
		OR receiver_id = ' . $_POST[ 'sender_id' ] . ' AND sender_id = ' . $_POST[ 'recipient_id' ]
	);
	
	if ( $check_for_conversation == NULL ) {
		
		$wpdb->insert(
			$wpdb->prefix . 'chumly_conversations',
			array(
				'sender_id'        => $_POST[ 'sender_id' ],
				'receiver_id'      => $_POST[ 'recipient_id' ],
				'thread_subject'   => $thread_subject,
				'thread_timestamp' => time(),
				'unread_messages'  => 0
			)
		);
		
		$response[ 'new_conversation' ] = 1;
		$response[ 'messages' ]         = chumly_load_conversation( $wpdb->insert_id );
		$response[ 'thread_id' ]        = $wpdb->insert_id;
		
		
	} else {
		
		$response[ 'new_conversation' ] = 0;
		$response[ 'messages' ]         = chumly_load_conversation( $check_for_conversation->ID );
		$response[ 'thread_id' ]        = $check_for_conversation->ID;
		
	}
	
	$response[ 'timestamp' ] = date( 'd/m/y \a\t H:i', time() );;
	$response[ 'avatar_url' ] = chumly_avatar( $_POST[ 'recipient_id' ], 'profile', '', FALSE );
	$response[ 'username' ]   = get_userdata( $_POST[ 'recipient_id' ] )->display_name;
	
	echo json_encode( $response );
	
	
	die();
}

add_action( 'wp_ajax_chumly_trigger_conversation', 'chumly_trigger_conversation' );
add_action( 'wp_ajax_nopriv_chumly_trigger_conversation', 'chumly_trigger_conversation' );


function chumly_get_user_conversations() {
	
	global $wpdb;
	$current_user = get_current_user_id();
	
	$conversations = $wpdb->get_results( "
		SELECT * FROM " . $wpdb->prefix . "chumly_conversations
		WHERE receiver_id = " . $current_user . " 
		OR sender_id = " . $current_user . "
		ORDER BY thread_timestamp DESC",
		OBJECT );
	
	return $conversations;
	
}


function chumly_get_thread_by_id( $thread_id ) {
	global $wpdb;
	
	$thread = $wpdb->get_row( 'SELECT * FROM ' . $wpdb->prefix . 'chumly_conversations WHERE ID = ' . $thread_id, OBJECT );
	
	return $thread;
}


function chumly_determine_user_id( $thread ) {
	
	if ( $thread->receiver_id == get_current_user_id() ) {
		
		$user_id = $thread->sender_id;
		
	} else {
		
		$user_id = $thread->receiver_id;
		
	}
	
	return $user_id;
	
}


function chumly_load_conversation( $thread_id ) {
	
	global $wpdb;
	
	$current_user = get_current_user_id();
	
	$messages = $wpdb->get_results( '
		SELECT * FROM ' . $wpdb->prefix . 'chumly_messages
		WHERE thread_id = ' . $thread_id . '
		ORDER BY ID ASC
	' );
	
	$messages_output   = array();
	$messages_output[] = '
	<div class="message">
		<div class="message__content">
			<p>Welcome to your new conversation, let\'s get started.</p>
		</div>
	</div>';
	
	foreach ( $messages as $message ) {
		$unix_timestamp = $message->message_timestamp;
		$timestamp      = date( 'd/m/y \a\t H:i', $message->message_timestamp );
		if ( $message->sender_id != $current_user ) {
			$userdata = get_user_meta( $message->sender_id );
			$username = $userdata[ 'first_name' ][ 0 ] . ' ' . $userdata[ 'last_name' ][ 0 ];
		}
		
		$messages_output[] = chumly_output_message( $message );
		
	}
	
	if ( get_current_user_id() == $message->receiver_id ) {
		
		$wpdb->update(
			$wpdb->prefix . 'chumly_conversations',
			array(
				'unread_messages' => 0
			),
			array(
				'ID' => esc_attr( $thread_id )
			)
		);
		
	}
	
	
	return $messages_output;
	
}

add_action( 'wp_ajax_chumly_load_conversation', 'chumly_load_conversation' );
add_action( 'wp_ajax_nopriv_chumly_load_conversation', 'chumly_load_conversation' );


function chumly_output_message( $message ) {
	$output = '<div class="message" timestamp="' . $message->message_timestamp . '">
			<div class="message__media">
				<figure class="avatar">
					<img class="avatar__image" src="' . chumly_avatar( $message->sender_id, 'profile', '', FALSE ) . '">
				</figure>
			</div>
			<div class="message__content">
				<a class="message__sender" href="' . chumly_profile_url( $message->sender_id ) . '">' . get_userdata( $message->sender_id )->display_name . '</a>
				<div class="message__body wysiwyg">
					' . $message->message_content . '
				</div>
			</div>
		</div>';
	
	return $output;
}

function chumly_send_message() {
	
	global $wpdb;
	$current_user    = get_current_user_id();
	$message_content = esc_textarea( stripslashes_deep( $_POST[ 'message_content' ] ) );
	$current_time    = time();
	
	$wpdb->insert(
		$wpdb->prefix . 'chumly_messages',
		array(
			'sender_id'         => $current_user,
			'receiver_id'       => esc_attr( $_POST[ 'receiver_id' ] ),
			'thread_id'         => esc_attr( $_POST[ 'thread_id' ] ),
			'message_content'   => wpautop( $message_content ),
			'message_timestamp' => $current_time
		)
	);
	
	$wpdb->update(
		$wpdb->prefix . 'chumly_conversations',
		array(
			'thread_timestamp' => $current_time,
			'unread_messages'  => $current_user
		),
		array(
			'ID' => esc_attr( $_POST[ 'thread_id' ] )
		)
	);
	
	
	$message                    = new stdClass();
	$message->message_timestamp = $current_time;
	$message->sender_id         = $current_user;
	$message->message_content   = wpautop( $message_content );
	
	//echo chumly_output_message( $message );
	
	chumly_die();
	
}

add_action( 'wp_ajax_chumly_send_message', 'chumly_send_message' );
add_action( 'wp_ajax_nopriv_chumly_send_message', 'chumly_send_message' );


function chumly_poll_new_message() {
	global $wpdb;
	
	$thread_id = intval( $_POST[ 'thread_id' ] );
	$timestamp = intval( $_POST[ 'last_message' ] );
	
	$thread = chumly_get_thread_by_id( $thread_id );
	
	//var_dump($_POST);
	//var_dump( chumly_determine_user_id( $thread ) );
	
	if ( $thread ) {
		
		
		$new_messages = $wpdb->get_results( '
		SELECT * FROM ' . $wpdb->prefix . 'chumly_messages
		WHERE thread_id = ' . $thread_id . '
		AND sender_id = ' . chumly_determine_user_id( $thread ) . '
		AND message_timestamp > ' . $timestamp
		);
		
		
		if ( ! empty( $new_messages ) ) {
			foreach ( $new_messages as $message ) {
				echo chumly_output_message( $message );
			}
		}
		
	}
	
	chumly_die();
}

add_action( 'wp_ajax_chumly_poll_new_message', 'chumly_poll_new_message' );
add_action( 'wp_ajax_nopriv_chumly_poll_new_message', 'chumly_poll_new_message' );
