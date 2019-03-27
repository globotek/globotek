<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 29/11/18
 * Time: 12:33 AM
 */
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/wp-load.php' );

if ( ! empty( $_POST ) ) {
	
	unset( $_POST[ 'submit' ] );
	
	$chumly_settings = unserialize( get_option( 'chumly_settings' ) );
	
	foreach ( $_POST as $setting_key => $setting_value ) {
		$chumly_settings[ $setting_key ] = $setting_value;
	}
	
	update_option( 'chumly_settings', serialize( $chumly_settings ) );
	
}

header( 'Location:' . $_SERVER[ 'HTTP_REFERER' ] );
die();