<?php
function chumly_get_option( $option_name ) {
	global $wpdb;
	
	return $wpdb->get_var( "SELECT option_value FROM " . $wpdb->prefix . "chumly_options WHERE option_name = '" . $option_name . "'" );
}


function chumly_set_option( $option_name, $option_value ) {
	global $wpdb;
	
	$wpdb->insert(
		$wpdb->prefix . 'chumly_options',
		array( 'option_name' => $option_name, 'option_value' => $option_value )
	);
}


function chumly_update_option( $option_name, $option_value ) {
	global $wpdb;
	
	$existing_option = chumly_get_option( $option_name );
	
	if ( $existing_option ) {
		
		$wpdb->update(
			$wpdb->prefix . 'chumly_options',
			array( 'option_value' => $option_value ),
			array( 'option_name' => $option_name )
		);
		
	} else {
		
		chumly_set_option( $option_name, $option_value );
		
	}
	
}
