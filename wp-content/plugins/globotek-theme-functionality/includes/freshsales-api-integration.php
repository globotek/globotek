<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 2/4/19
 * Time: 8:09 PM
 */

function gtek_set_lead_source( $source_name = NULL ) {
	
	global $api_keys;
	
	$url = 'https://globotek.freshsales.io/api/selector/lead_sources';
	
	$ch = curl_init();
	
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Accept: application/json',
			'Authorization: Token token=' . $api_keys->freshsales
		)
	);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
	$response    = curl_exec( $ch );
	$http_status = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
	
	if ( $http_status != 200 ) {
		throw new Exception( "Freshsales encountered an error. CODE: " . $http_status . " Response: " . $response );
	}
	
	$lead_sources = json_decode( $response )->lead_sources;
	
	if ( $source_name ) {
		
		foreach ( $lead_sources as $lead_source ) {
			
			if ( $lead_source->name == $source_name ) {
				
				return $lead_source->id;
				
			}
			
		}
		
	} else {
		
		return FALSE;
		
	}
	
}


function gtek_freshsales_create_lead( $lead_data = array() ) {
	
	global $api_keys;
	$url = 'https://globotek.freshsales.io/api/leads';
	
	$ch = curl_init();
	
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Accept: application/json',
			'Authorization: Token token=' . $api_keys->freshsales
		)
	);
	curl_setopt( $ch, CURLOPT_POST, 1 );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $lead_data ) );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
	$response    = curl_exec( $ch );
	$http_status = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
	
	if ( $http_status != 200 ) {
		throw new Exception( "Freshsales encountered an error. CODE: " . $http_status . " Response: " . $response );
	}
	
	return json_decode( $response );
	
}


function gtek_freshsales_create_note( $note, $target_id, $target_type ) {
	
	global $api_keys;
	$url = 'https://globotek.freshsales.io/api/notes';
	
	$note_data = array(
		'note' => array(
			'description'     => $note,
			'targetable_type' => $target_type,
			'targetable_id'   => $target_id
		)
	);
	
	$ch = curl_init();
	
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Accept: application/json',
			'Authorization: Token token=' . $api_keys->freshsales
		)
	);
	curl_setopt( $ch, CURLOPT_POST, 1 );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $note_data ) );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
	$response    = curl_exec( $ch );
	$http_status = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
	
	return json_decode( $response );
	if ( $http_status != 200 ) {
		throw new Exception( "Freshsales encountered an error. CODE: " . $http_status . " Response: " . $response );
	}
	
	
}


function gtek_submit_to_freshsales() {
	
	$lead = gtek_freshsales_create_lead( $_POST[ 'lead_data' ] );
	
	if ( $_POST[ 'lead_data' ][ 'note' ][ 'value' ] ) {
		
		$note = gtek_freshsales_create_note( $_POST[ 'lead_data' ][ 'note' ][ 'value' ], $lead->lead->id, $_POST[ 'lead_data' ][ 'note' ][ 'target_type' ] );
		
	}
	
	wp_die();
	
}

add_action( 'wp_ajax_gtek_submit_to_freshsales', 'gtek_submit_to_freshsales' );
add_action( 'wp_ajax_nopriv_gtek_submit_to_freshsales', 'gtek_submit_to_freshsales' );


function gtek_get_freshsales_appointments( $filter = 'future' ) {
	
	global $api_keys;
	$url = 'https://globotek.freshsales.io/api/appointments?filter=' . $filter;
	
	$ch = curl_init();
	
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Accept: application/json',
			'Authorization: Token token=' . $api_keys->freshsales
		)
	);
	
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
	$response    = curl_exec( $ch );
	$http_status = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
	
	if ( $http_status != 200 ) {
		throw new Exception( "Freshsales encountered an error. CODE: " . $http_status . " Response: " . $response );
	}
	
	return json_decode( $response )->appointments;
	
}


function gtek_get_appointments_for_date( $date, $appointments = NULL ) {
	
	if ( is_null( $appointments ) ) {
		$appointments = gtek_get_freshsales_appointments();
	}
	
	$filtered_appointments = array();
	
	foreach ( $appointments as $appointment ) {
		
		$appointment_date = date( 'Y-m-d', strtotime( $appointment->from_date ) );
		
		if ( $appointment_date == $date ) {
			
			$filtered_appointments[] = $appointment->from_date;
			
		}
		
	}
	
	return $filtered_appointments;
	
}


function gtek_trigger_get_appointments_for_date() {
	
	echo json_encode( gtek_get_appointments_for_date( $_POST[ 'date' ] ) );
	
	wp_die();
	
}

add_action( 'wp_ajax_gtek_get_appointments_for_date', 'gtek_trigger_get_appointments_for_date' );
add_action( 'wp_ajax_nopriv_gtek_get_appointments_for_date', 'gtek_trigger_get_appointments_for_date' );


function gtek_get_available_timeslots_for_date( $date ) {
	
	$booked_appointments = gtek_get_appointments_for_date( $date );
	$date_day            = date( 'l', strtotime( $date ) );
	
	$timeslot_options = get_field( $date_day . '_appointment_slots', 'option' );
	$timeslots        = array();
	
	foreach ( $timeslot_options[ '30_minute_appointments' ] as $time_of_day => $timeslot_option ) {
		
		foreach ( $timeslot_option as $appointment ) {
			
			$appointment[ 'available' ] = TRUE;
			
			foreach ( $booked_appointments as $booked_appointment ) {
				
				if ( $appointment[ 'start_time' ] == date( 'H:i:s', strtotime( $booked_appointment ) ) ) {
					
					$appointment[ 'available' ] = FALSE;
					
				}
				
			}
			
			$timeslots[ $time_of_day ][] = $appointment;
			
		}
		
	}
	
	return $timeslots;
	
}

add_action( 'wp_ajax_gtek_get_available_timeslots_for_date', 'gtek_trigger_get_available_timeslots_for_date' );
add_action( 'wp_ajax_nopriv_gtek_get_available_timeslots_for_date', 'gtek_trigger_get_available_timeslots_for_date' );
