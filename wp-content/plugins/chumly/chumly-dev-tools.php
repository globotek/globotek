<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 2/12/16
 * Time: 5:23 PM
 */

function time_function( $function_name ) {
	$time = microtime( TRUE ) - $_SERVER[ "REQUEST_TIME_FLOAT" ];
	echo '<strong>' . $function_name . '</strong> - <strong>' . $time . '</strong> seconds to run.<br>';
}

function inject_browser_sync_script() {
	
	if( current_user_can( 'manage_options' ) ) {
		
		global $template;
		
		echo '<strong>' . $template . '<br>Page ID: ' . get_the_ID() . '</strong>';
		
		echo '<script id="__bs_script__">
		//<![CDATA[
		document.write("<script async src=\'http://HOST:3000/browser-sync/browser-sync-client.js?v=2.18.13\'><\/script>".replace("HOST", location.hostname));
		//]]>
		</script>';
		
	}
	
}

add_action( 'wp_footer', 'inject_browser_sync_script' );
add_action( 'admin_footer', 'inject_browser_sync_script' );
