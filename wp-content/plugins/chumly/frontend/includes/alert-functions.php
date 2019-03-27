<?php
function chumly_get_alert( $alert_type, $alert ) {
	
	switch ( $alert_type ) {
		case 'success' :
			$alert_type = 'alert--positive';
			break;
		
		case 'error' :
			$alert_type = 'alert--negative';
			break;
		
		case 'primary' :
			$alert_type = 'alert--primary';
			break;
		
		default:
			$alert_type = '';
	}
	
	$output = '';
	
	$output .= '<div class="alert chumly-alert__elem is-active ' . $alert_type . '" data-module="chumly-alert" role="alert">';
	//$output .= '<div class="chumly-alert__elem">';
	$output .= '<div class="alert__content">' . $alert . '</div>';
	$output .= '<button class="alert__close chumly-alert__close">';
	$output .= '<span class="is-hidden--text">Click here to close this alert</span>';
	$output .= chumly_get_icon( 'cross', 'alert__close__icon icon' );
	$output .= '</button>';
	//$output .= '</div>';
	$output .= '</div>';
	
	return $output;
	
}

function chumly_alert( $alert_type, $alerts = array() ) {
	
	echo chumly_get_alert( $alert_type, $alerts );
	
}


function chumly_alert_modal( $alert_type, $alert ) {
	
	echo '<div class="alert__modal" data-module="chumly-modal">';
	
//	echo '<div class="modal" style="visibility: hidden">';
	echo '<div class="modal is-active" style="visibility: visible">';
	
//	echo '<div class="modal__inner" style="visibility: hidden">';
	echo '<div class="modal__inner is-active" style="visibility: visible">';
	
	chumly_alert( $alert_type, $alert );
	
	echo '</div>';
	
	echo '<div class="modal__mask chumly-modal__trigger"></div>';
		
	echo '</div>';
	
	echo '</div>';
	
}


function chumly_load_alert_modal() {
	
	chumly_alert_modal( $_POST[ 'alert_type' ], $_POST[ 'message' ] );
	
	chumly_die();
	
}

add_action( 'wp_ajax_chumly_load_alert_modal', 'chumly_load_alert_modal' );
add_action( 'wp_ajax_nopriv_chumly_load_alert_modal', 'chumly_load_alert_modal' );