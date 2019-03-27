<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 10/1/18
 * Time: 3:38 PM
 */
function chumly_explode_url( $url = NULL ) {
	
	if ( $url == NULL ) {
		
		$url = $_SERVER[ 'REQUEST_URI' ];
		
		preg_match_all( '/([.\w+]+)\/([\-.\w+]+)\/?/', $url, $matches );
		
		$object_string = $matches[ 2 ][ 0 ];
		
	} else {
		
		$object_string = basename( $url );
		
	}
	//var_dump( $object_string );
	$object_name = substr( $object_string, 0, strrpos( $object_string, '_' ) );
	$object_id   = substr( $object_string, strrpos( $object_string, '_' ) + 1 );
	
	$result = new stdClass();
	
	if ( $object_id > 0 ) {
		
		$result->ID   = intval( $object_id );
		$result->name = str_replace( '_', ' ', $object_name );
		
	} else {
		
		$current_user = get_current_user_id();
		
		$result->ID   = $current_user;
		$result->name = get_user_meta( $current_user, 'first_name', TRUE ) . ' ' . get_user_meta( $current_user, 'last_name', TRUE );
	}
	
	return $result;
	
}


/**
 * @param $content
 *
 * @return mixed
 */
function chumly_convert_urls( $content ) {
	
	// Grab URL to feed into $post_content with this match pattern.
	$url_detection_filter = $pattern = "/\b(?:(?:https?):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
	
	// Remove unwanted slashes
	$content = stripslashes( $content );
	
	// Have a look at the $content and see if URLs exists
	preg_match_all( $url_detection_filter, $content, $detected_urls );
	
	if ( $detected_urls[ 0 ] ) {
		
		foreach ( $detected_urls[ 0 ] as $url ) {
			
			if ( gethostbyname( $url ) ) {
				
				$webpage = chumly_retrieve_webpage( $url )->webpage;
				
				if ( ! $webpage ) {
					
					$url_components = parse_url( $url );
					
					$url = $url_components[ 'scheme' ] . '://' . $url_components[ 'host' ];
					
					$webpage = chumly_retrieve_webpage( $url )->webpage;
					
					if ( ! $webpage ) {
						
						$url = $url_components[ 'scheme' ] . '://' . substr( $url, strpos( $url, '.' ) + 1 );
						
						$webpage = chumly_retrieve_webpage( $url )->webpage;
						
					}
					
				}
				
				preg_match( "/<title>(.+)<\/title>/siU", $webpage, $matches );
				$title = str_replace( array( "\r", "\n" ), '', $matches[ 1 ] );
				
				if ( ! $title ) {
					
					$domain = parse_url( $url )[ 'host' ];
					$title  = ucwords( strtok( $domain, '.' ) );
					
				}
				
			} else {
				
				$domain = parse_url( $url )[ 'host' ];
				$title  = ucwords( strtok( $domain, '.' ) );
				
			}
			
			if ( strpos( $content, '<a href="' . $url . '" target="_blank">' . $title . '</a>' ) == FALSE ) {
				
				$content = str_replace( $url, '<a href="' . $url . '" target="_blank">' . $title . '</a>', $content );
				
			}
			
		}
		
		return $content;
		
	} else {
		
		return $content;
		
	}
	
}


/**
 * @param $post_ID  Post ID
 * @param $datetime Y-m-d H:i:s
 *
 * @return object
 */
function chumly_format_datetime( $post_ID = NULL, $datetime = NULL ) {
	
	if ( $post_ID ) {
		
		$datetime = get_post_time( 'Y-m-d H:i:s', TRUE, $post_ID );
		
	}
	
	$date_format = get_option( 'date_format' );
	$time_format = get_option( 'time_format' );
	$timezone    = get_user_meta( get_current_user_id(), 'user_timezone', TRUE );
	
	if ( ! $timezone ) {
		$timezone = get_option( 'timezone_string' );
	}
	
	$current_time = new DateTime( '', new DateTimeZone( $timezone ) );
	$datetime     = new DateTime( $datetime, new DateTimeZone( $timezone ) );
	
	$date         = $datetime->format( $date_format );
	$time         = $datetime->format( $time_format );
	$elapsed_time = $current_time->diff( $datetime );
	
	if ( $elapsed_time->s < 60 && $elapsed_time->i == 0 ) {
		$elapsed = 'Just now';
	} elseif ( $elapsed_time->i == 1 && $elapsed_time->h == 0 ) {
		$elapsed = 'A minute ago';
	} elseif ( $elapsed_time->i < 60 && $elapsed_time->h == 0 ) {
		$elapsed = $elapsed_time->i . ' minutes ago';
	} elseif ( $elapsed_time->h < 24 && $elapsed_time->d == 0 ) {
		if ( $elapsed_time->h == 1 ) {
			$elapsed = $elapsed_time->h . ' hour ago';
		} else {
			$elapsed = $elapsed_time->h . ' hours ago';
		}
	} elseif ( $elapsed_time->d == 1 ) {
		$elapsed = 'Yesterday';
	} else {
		$elapsed = $date;
	}
	
	return (object) array(
		'date'    => $date,
		'time'    => $time,
		'elapsed' => $elapsed
	);
	
}


function chumly_icon( $svg_title, $css_class = NULL, $type = 'static' ) {
	
	global $chumly;
	
	if ( $type == 'static' ) {
		
		echo '<svg class="icon ' . $css_class . '" aria-hidden="true">';
		echo '<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="' . $chumly->plugin_uri . 'frontend/images/icons/svg-symbols.svg#' . $svg_title . '"></use>';
		echo '</svg>';
		
	} elseif ( $type == 'active' ) {
		
		echo '<img src="' . $chumly->plugin_uri . '/frontend/images/icons/' . $svg_title . '.svg">';
		
	}
	
}


function chumly_get_icon( $svg_title, $css_class = NULL, $type = 'static' ) {
	
	global $chumly;
	$string = '';
	
	if ( $type == 'static' ) {
		
		$string .= '<svg class="icon ' . $css_class . '" aria-hidden="true">';
		$string .= '<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="' . $chumly->plugin_uri . 'frontend/images/icons/svg-symbols.svg#' . $svg_title . '"></use>';
		$string .= '</svg>';
		
	} elseif ( $type == 'active' ) {
		
		$string .= '<img src="' . $chumly->plugin_uri . '/frontend/images/icons/' . $svg_title . '.svg">';
		
	}
	
	return $string;
	
}


/**
 * Retrieve a URL's source code for extracting elements.
 */
function chumly_retrieve_webpage( $url ) {
	
	$response = new stdClass();
	
	$c = curl_init( $url );
	curl_setopt( $c, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt( $c, CURLOPT_SSL_VERIFYHOST, 0 );
	curl_setopt( $c, CURLOPT_SSL_VERIFYPEER, 0 );
	//curl_setopt(... other options you want...)
	
	$response->webpage = curl_exec( $c );
	
	if ( curl_error( $c ) ) {
		die( curl_error( $c ) );
	}
	
	// Get the status code
	$response->status = curl_getinfo( $c, CURLINFO_HTTP_CODE );
	
	curl_close( $c );
	
	return $response;
	
}
