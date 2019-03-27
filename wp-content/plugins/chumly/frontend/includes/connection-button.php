<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 2/7/18
 * Time: 7:04 PM
 */

/**
 * @param null $target_user ID of user to make connection with
 */
function chumly_connection_button( $target_user = NULL ) {
	
	$output = '';
	
	$output .= '<div class="button-group">';
	$output .= '<div class="button-group__item" data-module="chumly-toggle, chumly-connect">';
	
	if ( chumly_own_profile() ) {
		
		$output .= '<a href="/' . chumly_get_option( 'user_profile_page' ) . '/edit" class="button button--primary ">Edit Profile</a>';
		
	} else {
		
		$check_connection = new Chumly_Member_Connections();
		
		$member_connection = $check_connection->profile_check_connection( $target_user );

		if ( count( $member_connection ) == 1 ) {
			
			foreach ( $member_connection as $connection ) {
				
				$output .= '<button class="button button--primary  ' . $connection[ 'css_class' ] . '"
								target-user="' . $connection[ 'target_user' ] . '"
								connection-status="' . $connection[ 'status' ] . '"
								connection-id="' . $connection[ 'connection_id' ] . '"
								connection-action="' . $connection[ 'connection_action' ] . '"
								ajax-trigger="member_connection_action">';
				$output .= $connection[ 'button_label' ];
				$output .= '</button>';
				
			}
			
		} else {
			
			$output .= '<nav class="dropdown" data-module="chumly-toggle">';
			
			$output .= '<ul class="dropdown__inner">';
			
			$output .= '<button class="button button--primary  chumly-toggle__trigger" target-user="' . $connection[ 'target_user' ] . '" href="#connection-button-menu">';
			$output .= 'Respond to Friend Request';
			$output .= chumly_get_icon( 'angle-down' );
			$output .= '</button>';
			
			$output .= '<ul class="dropdown__menu chumly-toggle__target" id="connection-button-menu">';
			
			foreach ( $member_connection as $connection ) {
				
				$output .= '<li class="dropdown__menu__item"
										target-user="' . $connection[ 'target_user' ] . '"
										connection-status="' . $connection[ 'status' ] . '"
										connection-id="' . $connection[ 'connection_id' ] . '"
										connection-action="' . $connection[ 'connection_action' ] . '"
										ajax-trigger="member_connection_action">';
				
				$output .= $connection[ 'button_label' ];
				
				$output .= '</li>';
				
			}
			
			$output .= '<span class="dropdown__menu__divider"></span>';
			
			$output .= '<li class="dropdown__menu__item">Block User</li>';
			
			$output .= '<li class="dropdown__menu__mask">';
			$output .= '<a href="#connection-button-menu" class="chumly-toggle__trigger">Close menu</a>';
			$output .= '</li>';
			
			$output .= '</ul>';
			
			
			$output .= '</ul>';
			
			$output .= '</nav>';
			
		}
	}
	
	$output .= '</div>';
	$output .= '</div>';
	
	echo $output;
	
}