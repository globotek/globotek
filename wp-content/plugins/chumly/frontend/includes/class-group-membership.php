<?php
require( 'class-groups.php' );

class Chumly_Group_Membership extends Chumly_Groups {
	
	public function __construct() {
		
		if ( isset( $_GET[ 'member_id' ] ) && $_GET[ 'member_id' ] == NULL ) {
			
			return FALSE;
			
		}
		
		add_action( 'wp_ajax_chumly_update_membership_state', array( $this, 'update_membership_state' ) );
		add_action( 'wp_ajax_nopriv_chumly_update_membership_state', array( $this, 'update_membership_state' ) );
		
		add_action( 'wp_ajax_chumly_invite_group_member', array( $this, 'invite_group_member' ) );
		add_action( 'wp_ajax_nopriv_chumly_invite_group_member', array( $this, 'invite_group_member' ) );
		
		add_action( 'wp_ajax_chumly_approve_group_member', array( $this, 'trigger_approve_group_member' ) );
		add_action( 'wp_ajax_nopriv_chumly_approve_group_member', array( $this, 'trigger_approve_group_member' ) );
		
		add_action( 'wp_ajax_chumly_decline_group_member', array( $this, 'trigger_decline_group_member' ) );
		add_action( 'wp_ajax_nopriv_chumly_decline_group_member', array( $this, 'trigger_decline_group_member' ) );
		
		add_action( 'wp_ajax_chumly_delete_group_member', array( $this, 'delete_group_member' ) );
		add_action( 'wp_ajax_nopriv_chumly_delete_group_memeber', array( $this, 'delete_group_memeber' ) );
		
		add_action( 'wp_ajax_chumly_remove_group_member', array( $this, 'remove_group_member' ) );
		add_action( 'wp_ajax_nopriv_chumly_remove_group_memeber', array( $this, 'remove_group_memeber' ) );
		
		parent::__construct();
		
	}
	
	public function check_membership( $target_group_id = NULL, $user_id = NULL ) {
		//var_dump( $target_group_id );
		$group = $this->get_group( $target_group_id );
		if ( ! $user_id ) {
			$user_id = get_current_user_id();
		}
		
		//var_dump($group);
		return $this->membership_output( $target_group_id, $user_id );
		
	}
	
	public function membership_output( $group_id, $target_user_id ) {
		//var_dump($group_id);
		//var_dump( $target_user_id );
		$this->group_member = $this->get_group_member( $group_id, $target_user_id );
		
		//var_dump( $this->group_member );
		
		switch ( $this->group_member->membership ) {
			
			case 'member':
			case 'owner':
				
				$membership_status = array(
					'status'       => $this->group_member->membership,
					'is_active'    => 1,
					'action'       => 'leave',
					'group_id'     => $group_id,
					'css_class'    => 'button--negative',
					'button_label' => 'Leave Group'
				);
				
				break;
			
			case 'invitee':
				
				$membership_status = array(
					'status'       => 'invited',
					'is_active'    => 0,
					'action'       => 'accept',
					'group_id'     => $group_id,
					'css_class'    => 'button--positive',
					'button_label' => 'Accept Invite'
				);
				
				break;
			
			case 'applicant':
				
				$membership_status = array(
					'status'       => 'pending',
					'is_active'    => 0,
					'action'       => 'cancel',
					'group_id'     => $group_id,
					'css_class'    => 'button--negative',
					'button_label' => 'Cancel Application'
				);
				
				break;
			
			default:
				
				$membership_status = array(
					'status'       => 'non-member',
					'is_active'    => 0,
					'action'       => 'join',
					'group_id'     => $group_id,
					'css_class'    => 'button--primary',
					'button_label' => 'Join Group'
				);
				
				break;
			
		}
		
		if ( $this->group_member->membership == 'owner' || $this->group_member->membership == 'admin' ) {
			
			$membership_status[ 'is_admin' ] = 1;
			
		}
		
		if ( $this->group_member->membership == 'owner' ) {
			
			$membership_status[ 'is_owner' ] = 1;
			
		}
		
		//var_dump( $membership_status );
		
		return $membership_status;
		
	}
	
	public function add_group_member( $args = array() ) {
		
		global $wpdb;
		
		return $wpdb->insert(
			$this->members_table,
			array(
				'ID'             => NULL,
				'group_id'       => $args[ 'group_id' ],
				'user_id'        => $args[ 'user_id' ],
				'first_name'     => chumly_get_profile_field( $args[ 'user_id' ], 'first_name' )->value,
				'last_name'      => chumly_get_profile_field( $args[ 'user_id' ], 'last_name' )->value,
				'membership'     => $args[ 'membership' ],
				'banned'         => 0,
				'join_timestamp' => time()
			)
		);
		
	}
	
	public function invite_group_member( $user_id = NULL, $group_id = NULL ) {
		
		if ( isset( $_POST[ 'user_id' ] ) ) {
			$user_id  = $_POST[ 'user_id' ];
			$group_id = $_POST[ 'group_id' ];
		}
		
		$this->add_group_member( array( 'user_id' => $user_id, 'group_id' => $group_id, 'membership' => 'invitee' ) );
		
		echo json_encode( $_POST );
		
		chumly_die();
		
	}
	
	public function trigger_approve_group_member() {
		
		$this->approve_group_member( $_POST[ 'user_id' ], $_POST[ 'group_id' ] );
		
		chumly_die();
		
	}
	
	public function approve_group_member( $user_id, $group_id ) {
		
		global $wpdb;
		
		$wpdb->update( $this->members_table, array( 'membership' => 'member' ), array(
			'group_id' => $group_id,
			'user_id'  => $user_id
		) );
		
	}
	
	public function trigger_decline_group_member() {
		
		$this->decline_group_member( $_POST[ 'user_id' ], $_POST[ 'group_id' ] );
		
		chumly_die();
		
	}
	
	public function decline_group_member( $user_id, $group_id ) {
		
		$this->delete_group_member( $user_id, $group_id );
		
		chumly_die();
		
	}
	
	public function trigger_remove_group_member() {
		
		$this->remove_group_member( $_POST[ 'user_id' ], $_POST[ 'group_id' ] );
		
		chumly_die();
		
	}
	
	function remove_group_member( $user_id, $group_id ) {
		
		$this->delete_group_member( $user_id, $group_id );
		
	}
	
	public function delete_group_member( $user_id, $group_id ) {
		
		global $wpdb;
		
		$this->delete_user_group( $user_id, $group_id );
		
		$wpdb->delete( $this->members_table, array( 'user_id' => $user_id, 'group_id' => $group_id ) );
		
	}
	
	public function update_membership_state() {
		
		$user_id  = intval( $_POST[ 'current_user' ] );
		$group_id = intval( $_POST[ 'group_id' ] );
		$action   = esc_attr( $_POST[ 'connection_action' ] );
		$group    = $this->get_group( $group_id );
		
		$group_admins = $this->get_group_members( $group_id, array( 'admins' ) )->admins;
		
		//echo json_encode( $this->get_group_privacy( $group_id ) );
		//echo json_encode( $user_id );
		//echo json_encode( $group_id );
		//echo $action;
		
		switch ( $action ) {
			case 'leave':
			case 'delete':
				
				$member_count = $this->get_group_member_count( $group_id );
				
				if ( $member_count > 1 ) {
					
					$this->delete_group_member( $user_id, $group_id );
					$this->delete_user_group( $user_id, $group_id );
					
					if ( $action == 'leave' ) {
						
					} elseif ( $action == 'delete' ) {
						
					}
					
					echo json_encode( $this->check_membership( $group_id ) );
					
				}
				
				break;
			
			case 'join':
				
				if ( $this->get_group_privacy( $group_id ) == 1 ) {
					
					$this->add_group_member( array(
						'group_id'   => $group_id,
						'user_id'    => $user_id,
						'membership' => 'member'
					) );
					
					$this->update_user_groups( $user_id, $group_id );
					
					$notification = array(
						'source'     => 'profile',
						'link'       => self::get_group_url( $group_id ),
						'message'    => chumly_username( $user_id ) . ' has joined ' . $group->title,
						'type'       => 'new_group_member',
						'sender_id'  => $user_id,
						'recipients' => $group_admins
					);
					
					Chumly_Notifications::save_notification( $notification );
					
				} else {
					
					$this->add_group_member( array(
						'group_id'   => $group_id,
						'user_id'    => $user_id,
						'membership' => 'applicant'
					) );
					
					$this->update_user_groups( $user_id, $group_id );
					
					$notification = array(
						'source'     => 'profile',
						'link'       => self::get_group_url( $group_id ),
						'message'    => chumly_username( $user_id ) . ' would like to join ' . $group->title,
						'type'       => 'new_group_application',
						'sender_id'  => $user_id,
						'recipients' => $group_admins
					);
					
					Chumly_Notifications::save_notification( $notification );
					
				}
				
				
				echo json_encode( $this->check_membership( $group_id ) );
				
				break;
			
			case 'accept':
				
				$this->approve_group_member( $user_id, $group_id );
				$this->update_user_groups( $user_id, $group_id );
				
				$notification = array(
					'source'       => 'profile',
					'link'         => self::get_group_url( $group_id ),
					'message'      => chumly_username( $user_id ) . ' has joined ' . $group->name,
					'type'         => 'group_invite_accepted',
					'sender_id'    => get_current_user_id(),
					'receiver_ids' => $group_admins
				);
				
				Chumly_Notifications::save_notification( $notification );
				
				
				echo json_encode( $this->check_membership( $group_id ) );
				
				break;
			
			case 'decline':
			case 'cancel':
				
				$this->delete_group_member( $user_id, $group_id );
				//$this->delete_user_group( $user_id, $group_id );
				
				echo json_encode( $this->check_membership( $group_id ) );
				
				break;
			
			default:
				
				echo 'Something isn\'t right here...try again or contact support.';
			
		}
		
		chumly_die();
		
	}
	
}

new Chumly_Group_Membership();
