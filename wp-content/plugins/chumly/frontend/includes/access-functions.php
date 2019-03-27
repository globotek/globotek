<?php
function chumly_check_privacy( $target_id ) {
	
	$privacy = new Chumly_Privacy( $target_id );
	
	return $privacy->check_privacy();
	
}


function chumly_check_login( $force_redirect = FALSE ) {
	
	if ( ! is_user_logged_in() ) {
		
		$public_pages   = unserialize( get_option( 'chumly_settings' ) )[ 'visibility' ][ 'public_pages' ];
		$server_request = explode( '?', $_SERVER[ 'REQUEST_URI' ] );
		$requested_url  = trim( home_url() . $server_request[ 0 ], '/' );
		$login_url      = trim( home_url( '/' ) . chumly_get_option( 'login_page' ), '/' );
		
		if ( $requested_url != $login_url && ! in_array( get_the_ID(), $public_pages ) || $force_redirect ) {
			
			wp_redirect( $login_url . '?requested_url=' . $requested_url );
			
			exit;
			
		}
		
	} else {
		
		return TRUE;
		
	}
	
}


function chumly_login_form( $args = array() ) {
	
	$defaults = array(
		'redirect' => 'self'
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	switch ( $args[ 'redirect' ] ) {
		case 'home' :
			$redirect = home_url();
			break;
		case 'self' :
			$redirect = ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] !== 'off' ? 'https' : 'http' ) . '://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'REQUEST_URI' ];
			break;
		case 'profile' :
			$redirect = home_url() . '/profile';
			break;
		default :
			$redirect = $args[ 'redirect' ];
	}
	
	chumly_format_form_data();
	
	if ( isset( $_POST[ 'login_submit' ] ) ) {
		chumly_process_login( $redirect );
	}
	
	chumly_form_header();
	
	chumly_input( chumly_get_input( array(
		'name' => 'username'
	) ) );
	
	chumly_input( chumly_get_input( array(
		'name' => 'password_one'
	) ) );
	
	chumly_form_footer( 'login_submit', NULL, 'Login' );
	
}


function chumly_process_login( $redirect ) {
	
	if ( isset( $_POST[ 'login_submit' ] ) && ! is_user_logged_in() ) {
		$credentials = array(
			'user_login'    => esc_attr( $_POST[ 'username' ] ),
			'user_password' => esc_attr( $_POST[ 'password_one' ] )
		);
		
		$login = wp_signon( $credentials, FALSE );
		
		if ( is_wp_error( $login ) ) {
			
			foreach ( $login as $errors ) {
				
				foreach ( $errors as $error_type ) {
					
					foreach($error_type as $error) {
						
						echo chumly_alert( 'error', $error );
						
						return;
						
					}
					
				}
				
			}
			
		} else {
			
			wp_redirect( $redirect . '?logged_in=true' );
			exit;
			
		}
		
		/*		if(isset($_GET['email_invite'])){
					
					if(isset($_GET['group_id'])){
						wp_redirect(home_url('/'));
						exit;
					}
					
				}*/
	}
}


function chumly_logout() {
	
	if ( is_user_logged_in() ) {

//		wp_logout();
		wp_redirect( ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] !== 'off' ? 'https' : 'http' ) . '://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'REQUEST_URI' ] . '?logged_out=true' );
		
	}
	
	if ( ! is_user_logged_in() ) {
		
		if ( isset( $_GET[ 'logged_out' ] ) ) {
			echo chumly_alert( 'standard', array( 'You Are Now Logged Out. <a href="' . home_url() . '">Return Home?</a>' ) );
		}
		echo '<p>You\'re currently logged out, would you like to log in?</p><br>';
		chumly_login_form();
		
	} else {
		
		echo chumly_alert( 'error', array( 'An issue has occurred, you\'re still logged in.' ) );
		
	}
	
}


function chumly_login_alert() {
	
	if ( isset( $_GET[ 'logged_in' ] ) ) {
		
		echo chumly_alert( 'success', array( 'You are now logged in.' ) );
		
	}
	
}


function chumly_user_blocks() {
	
	global $chumly_user;
	
	//var_dump($chumly_user);
	
	if ( $chumly_user->dashboard_access == FALSE ) {
		//echo 'No Access';
	}
	
	if ( $chumly_user->admin_approval == FALSE ) {
		//echo 'Need Approving';
	}
	
}

add_action( 'wp_head', 'chumly_user_blocks' );