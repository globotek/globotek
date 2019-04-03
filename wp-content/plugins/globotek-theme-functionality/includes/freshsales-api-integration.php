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
	
	var_dump( $_POST );
	
	if($_POST[ 'lead_data' ][ 'note' ]['value']) {
		
		$note = gtek_freshsales_create_note( $_POST[ 'lead_data' ][ 'note' ][ 'value' ], $lead->lead->id, $_POST[ 'lead_data' ][ 'note' ][ 'target_type' ] );
		
		var_dump( $note );
		
	}
	
	wp_die();
	
}

add_action( 'wp_ajax_gtek_submit_to_freshsales', 'gtek_submit_to_freshsales' );
add_action( 'wp_ajax_nopriv_gtek_submit_to_freshsales', 'gtek_submit_to_freshsales' );