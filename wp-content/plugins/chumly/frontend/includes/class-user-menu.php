<?php

/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 21/6/18
 * Time: 7:23 PM
 */
class Chumly_User_Menu {
	
	protected $user_id;
	
	public function __construct() {
		
//		add_filter( 'chumly_user_menu', array( $this, 'welcome' ), 5 );
		add_filter( 'chumly_user_menu', array( $this, 'profile' ), 10 );
		add_filter( 'chumly_user_menu', array( $this, 'friends' ), 15 );
		add_filter( 'chumly_user_menu', array( $this, 'messages' ), 20 );
		add_filter( 'chumly_user_menu', array( $this, 'notifications' ), 25 );
		add_filter( 'chumly_user_menu', array( $this, 'settings' ), 30 );
//		add_filter( 'chumly_user_menu', array( $this, 'help' ), 35 );
		
		$this->user_id = get_current_user_id();
		
	}
	
	public function welcome( $user_menu = NULL ) {
		
		$output = '<li class="user-menu__item user-menu__item--palm-fill">';
		$output .= '<a href="' . chumly_get_option( 'user_profile_page' ) . '" class="user-menu__text">Hello, ' . chumly_username( $this->user_id ) . '</a>';
		$output .= '</li>';
		
		return $user_menu . $output;
		
	}
	
	public function profile( $user_menu = NULL ) {
		
		$output = '<li class="user-menu__item">';
		$output .= '<a href="' . home_url( '/' ) . chumly_get_option( 'user_profile_page' ) . '" class="user-menu__icon"><span class="is-hidden--text">Your profile</span>' . chumly_get_icon( 'user' ) . '</a>';
		$output .= '</li>';
		
		return $user_menu . $output;
		
	}
	
	public function friends( $user_menu = NULL ) {
		
		$sub_menu_id = 'user-friends-menu';
		$friend_requests = chumly_get_received_friend_requests( $this->user_id, 5 );
		$new_requests = count($friend_requests);
		
		$output = '<li class="user-menu__item">';
		$output .= '<a href="#' . $sub_menu_id . '" class="user-menu__icon chumly-toggle__trigger"><span class="is-hidden--text">Your friend requests</span>' . chumly_get_icon( 'users' ) . '</a>';
		
		if ( $new_requests == 0 ) {
			
			$output .= '<span class="user-menu__indicator is-hidden" aria-hidden="true">' . $new_requests . '</span></a>';
			
		} else {
			
			$output .= '<span class="user-menu__indicator notifications" aria-hidden="true">' . $new_requests . '</span></a>';
			
		}
		
		$output .= '<ul class="user-menu__sub-menu chumly-toggle__target" id="' . $sub_menu_id . '">';
		
		if(!$friend_requests){
			
			$output .= '<li class="user-menu__sub-menu__item">';
			$output .= '<p>No pending requests</p>';
			$output .= '</li>';
			
		} else {
			
			foreach ( $friend_requests as $friend_request ) {
				
				$user_id = $friend_request->request_sender_id;
				
				$output .= '<li class="user-menu__sub-menu__item">';
				$output .= '<a href="' . chumly_profile_url( $user_id ) . '">' . chumly_username( $user_id ) . '</a>';
				
				$output .= '<div class="button-group">';
				$output .= '<div class="button-group__item" data-module="chumly-connect">';
				
				$check_connection = new Chumly_Member_Connections();
				
				$member_connection = $check_connection->profile_check_connection( $user_id );
				
				//var_dump( $member_connection );
				
				$connection = $member_connection[ 'accept' ];
				
				$output .= '<button class="button"
								target-user="' . $connection[ 'target_user' ] . '"
								connection-status="' . $connection[ 'status' ] . '"
								connection-id="' . $connection[ 'connection_id' ] . '"
								connection-action="' . $connection[ 'connection_action' ] . '"
								ajax-trigger="member_connection_action">';
				$output .= $connection[ 'button_label' ];
				$output .= '</button>';
				
				$output .= '</div>';
				$output .= '</div>';
				
				$output .= '</li>';
			}
			
			$output .= '<li class="user-menu__sub-menu__item user-menu__sub-menu__item--centered"><a href="' . chumly_get_option( 'user_friends_page' ) . '">See all requests</a></li>';
		
		}
		
			$output .= '<li class="user-menu__sub-menu__mask">';
			$output .= '<a href="#' . $sub_menu_id . '" class="chumly-toggle__trigger">Close menu</a>';
			$output .= '</li>';
			
			
			$output .= '</ul>';
			
			$output .= '</li>';
			
		
			
		return $user_menu . $output;
		
	}
	
	public function notifications( $user_menu = NULL ) {
		
		$notifications = new Chumly_Notifications();
		$unread_count  = $notifications->count_unread_notifications();
		
		$output = '<li class="user-menu__item">';
		$output .= '<a href="' . home_url( '/' ) . chumly_get_option( 'notifications_page' ) . '" class="user-menu__icon"><span class="is-hidden--text">Your notifications</span>' . chumly_get_icon( 'bell' );
		
		if ( $unread_count == 0 ) {
			
			$output .= '<span class="user-menu__indicator is-hidden" aria-hidden="true">' . $unread_count . '</span></a>';
			
		} else {
			
			$output .= '<span class="user-menu__indicator notifications" aria-hidden="true">' . $unread_count . '</span></a>';
			
		}
		
		$output .= '</li>';
		
		return $user_menu . $output;
		
	}
	
	public function messages( $user_menu = NULL ) {
		
		$messages     = '';
		$unread_count = '1';
		
		$output = '<li class="user-menu__item">';
		$output .= '<a href="' . home_url( '/' ) . chumly_get_option( 'messaging_page' ) . '" class="user-menu__icon"><span class="is-hidden--text">Your messages</span>' . chumly_get_icon( 'mail' );
		
		if ( $unread_count == 0 ) {
			
			$output .= '<span class="user-menu__indicator is-hidden" aria-hidden="true">' . $unread_count . '</span></a>';
			
		} else {
			
			$output .= '<span class="user-menu__indicator messages" aria-hidden="true">' . $unread_count . '</span></a>';
			
		}
		
		$output .= '</li>';
		
		return $user_menu . $output;
		
	}
	
	public function settings( $user_menu = NULL ) {
		
		$sub_menu_id = 'user-settings-menu';
		
		$output = '<li class="user-menu__item">';
		
		$output .= '<a href="#' . $sub_menu_id . '" class="user-menu__icon chumly-toggle__trigger"><span class="is-hidden--text">Your settings</span>' . chumly_get_icon( 'cog' ) . '</a>';
		
		$output .= '<ul class="user-menu__sub-menu chumly-toggle__target" id="' . $sub_menu_id . '">';
		
		$output .= $this->sub_menu_items( $sub_menu_id, apply_filters( 'chumly_settings_pages', array() ) );
		
		$output .= '</ul>';
		
		$output .= '</li>';
		
		return $user_menu . $output;
		
	}
	
	public function help( $user_menu = NULL ) {
		
		$output = '<li class="user-menu__item">';
		$output .= '<a href="' . home_url( '/' ) . chumly_get_option( 'support_page' ) . '" class="user-menu__icon"> <span class="is-hidden--text">Help and support</span>' . chumly_get_icon( 'help' ) . '</a>';
		$output .= '</li>';
		
		
		return $user_menu . $output;
		
	}
	
	private function sub_menu_items( $sub_menu_id, $menu_items ) {
		
		$output = '';
		
		foreach ( $menu_items as $menu_item ) {
			$output .= '<li class="user-menu__sub-menu__item"><a href="' . $menu_item[ 'url' ] . '">' . $menu_item[ 'title' ] . '</a></li>';
		}
		
		$output .= '<li class="user-menu__sub-menu__mask">';
		$output .= '<a href="#' . $sub_menu_id . '" class="chumly-toggle__trigger">Close menu</a>';
		
		$output .= '</li>';
		
		return $output;
		
	}
	
}