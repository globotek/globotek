<?php

/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 17/1/18
 * Time: 12:43 PM
 */
class Chumly_Notifications {
	
	protected $notifications_table, $user_id;
	
	function __construct() {
		
		add_action( 'wp_ajax_chumly_save_notification', array( $this, 'save_notification' ) );
		add_action( 'wp_ajax_nopriv_chumly_save_notification', array( $this, 'save_notification' ) );
		
		add_action( 'wp_ajax_chumly_get_notifications', array( $this, 'get_notifications' ) );
		add_action( 'wp_ajax_nopriv_chumly_get_notifications', array( $this, 'get_notifications' ) );
		
		add_action( 'wp_ajax_chumly_mark_notification_read', array( $this, 'trigger_mark_notification_read' ) );
		add_action( 'wp_ajax_nopriv_chumly_mark_notification_read', array( $this, 'trigger_mark_notification_read' ) );
		
		add_action( 'wp_ajax_chumly_delete_notification', array( $this, 'delete_notification' ) );
		add_action( 'wp_ajax_nopriv_chumly_delete_notification', array( $this, 'delete_notification' ) );
		
		
		global $wpdb;
		$this->notifications_table = $wpdb->prefix . 'chumly_notifications';
		$this->user_id             = get_current_user_id();
		
	}
	
	public function output_notification( $notification ) {
		
		$notification_sources = array();
		
		$notification_sources = apply_filters( 'chumly_notification_templates', $notification_sources );
		//var_dump($notification_sources);
		
		$sender_data = get_userdata( $notification->sender_id );
		$notification_read = ( $notification->viewed == 0 ? 'notification--unread' : '' );
		
		include( $notification_sources[ $notification->type ] );
		
	}
	
	public static function save_notification( $notification = array() ) {
		
		//$sender_id, $recipient_ids = array(), $source, $type, $message, $link = NULL
		global $wpdb;
		
		if ( $notification[ 'link' ] == NULL ) {
			global $wp;
			$notification[ 'link' ] = home_url( $wp->request );
		}
		
		foreach ( $notification[ 'recipients' ] as $recipient ) {
			
			if ( $recipient->ID ) {
				$user_id = $recipient->user_id;
			} else {
				$user_id = $recipient;
			}
			
			$wpdb->insert(
				$wpdb->prefix . 'chumly_notifications',
				array(
					'user_id'   => $user_id,
					'viewed'    => FALSE,
					'source'    => $notification[ 'source' ],
					'link'      => $notification[ 'link' ],
					'message'   => $notification[ 'message' ],
					'type'      => $notification[ 'type' ],
					'sender_id' => $notification[ 'sender_id' ],
					'timestamp' => time( 'U' )
				)
			);
			
			update_user_meta( $user_id, '_unread_notifications', TRUE );
			
		}
		
		//chumly_die();
		
	}
	
	
	public function get_notifications( $read = 'all' ) {
		
		global $wpdb;
		
		$notifications = $wpdb->get_results( "
				SELECT * FROM $this->notifications_table
				WHERE user_id = " . $this->user_id . "
				ORDER BY timestamp DESC",
			OBJECT );
		
		if ( !isset( $_REQUEST[ 'live_update' ] ) ) {
			return $notifications;
		}
		
		chumly_die();
		
	}
	
	public function count_notifications() {
		
		return count( $this->get_notifications() );
		
	}
	
	public function count_unread_notifications() {
		
		global $wpdb;
		
		return count( $wpdb->get_results( "
				SELECT * FROM $this->notifications_table
				WHERE user_id = $this->user_id 
				AND viewed = 0",
			OBJECT ) );
		
	}
	
	public function trigger_mark_notification_read() {
		
		$this->mark_notification_read( $_POST[ 'notification_id' ] );
		
		chumly_die();
		
	}
	
	public function mark_notification_read( $notification_id ) {
		global $wpdb;
		
		$wpdb->update(
			$this->notifications_table,
			array(
				'viewed' => TRUE,
			),
			array(
				'ID' => $notification_id
			)
		);
		
	}
	
	
	function delete_notification() {
		
		
	}
	
}

new Chumly_Notifications();