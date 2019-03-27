<?php
function chumly_post_form( $post_type, $args = array() ) {
	
	$post_type_arg = array(
		'post_type' => $post_type
	);
	
	$data = array_merge( $post_type_arg, $args );
	
	$default_args = array(
		'target_id' => chumly_user_id()
	);
	
	$data = wp_parse_args( $data, $default_args );
	
	//var_dump($data);
	
	chumly_get_template( 'form', 'post', chumly_user_id(), $data );
	
}


function chumly_prepare_save_data() {
	
	$post_components = $_POST;
	$post_type = $_POST[ 'post_type' ];
	
	// The Regular Expression filter for detecting URLs
	$url_detection_filter = '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i';
	
	// The Text you want to filter for urls
	$post_content = stripslashes( $post_components[ 'editor' ] );
	$post_format = 'standard';
	
	$return_data = array();
	
	if( $post_content ) {
		
		if( preg_match_all( $url_detection_filter, $post_content, $url ) ) {
			
			/**
			 * We have links in our status so will use Link format so we
			 * can output the web page preview in the feed.
			 */
			$post_content = wpautop( chumly_convert_urls( $post_content ) );
			$post_format = 'link';
			
		} else {
			
			if( strlen( $post_content ) < 150 ) {
				
				/**
				 * @todo Set to Tweet length so sharing to Twitter is easy. :)
				 * Use the status post format as it is for short and sweet post statuses that don't
				 * require paragraphs etc and will output with larger font size in the feed.
				 */
				$post_content = wpautop( $post_content );
				$post_format = 'status';
				
			} else {
				
				/**
				 * Just use the standard format type, adds paragraphs where requested.
				 */
				$post_content = wpautop( $post_content );
				
			}
			
		}
		
	}
	
	if( $_POST[ 'post_format' ] != NULL ) {
		
		$post_format = $_POST[ 'post_format' ];
		
	}
	
	$post_title_name = get_current_user_id() . '-' . current_time( 'U', 0 );
	
	$components = array(
		'post_content' => $post_content,
		'post_title'   => $post_title_name,
		'post_name'    => $post_title_name,
		'post_type'    => $post_type,
		'post_status'  => 'publish',
		'meta_input'   => array(),
		'meta_data'    => array(
			'post_type'   => $post_type,
			'post_format' => $post_format
		)
	);
	
	return $components;
	
}


function chumly_process_post_save() {
	
	$current_user_id = get_current_user_id();
	$target_id = $_POST[ 'target_id' ];
	$notification = array();
	
	$post_data = $components = chumly_prepare_save_data();
	
	unset( $post_data[ 'meta_data' ] );
	
	$return_data[ 'components' ] = $components;
	$return_data[ 'post_data' ] = $post_data;
	
	$post_id = wp_insert_post( $post_data, $error = TRUE );
	chumly_set_post_format( $post_id, $components[ 'meta_data' ][ 'post_format' ] );
	
	switch( $components[ 'meta_data' ][ 'post_type' ] ) {
		
		case 'chumly_status_post':
			
			wp_set_object_terms( $post_id, $target_id, 'chumly_post_target', TRUE );
			
			if( intval( $target_id ) == $current_user_id ) {
				
				$notification = array(
					'sender_id'  => $current_user_id,
					'recipients' => chumly_get_friends(),
					'source'     => '',
					'type'       => $components[ 'meta_data' ][ 'post_type' ],
					'link'       => '/profile',
					'message'    => 'just posted on their wall'
				);
				
			} else {
				
				$notification = array(
					'sender_id'  => $current_user_id,
					'recipients' => array( $target_id ),
					'source'     => '',
					'type'       => $components[ 'meta_data' ][ 'post_type' ],
					'link'       => '/profile',
					'message'    => 'just posted on your wall'
				);
				
			}
			
			break;
		
		case 'chumly_shared':
			
			$target_ids = explode( ',', $_POST[ 'target_id' ] );
			
			if( count( $target_ids ) > 1 ) {
				
				foreach( $target_ids as $target_id ) {
					
					wp_set_object_terms( $post_id, $target_id, 'chumly_post_target', TRUE );
					
					$notification = array(
						'sender_id'  => $current_user_id,
						'recipients' => $target_ids,
						'source'     => '',
						'type'       => $components[ 'meta_data' ][ 'post_type' ],
						'link'       => '/profile',
						'message'    => 'shared a ' . $components[ 'meta_data' ][ 'post_format' ] . ' on their wall'
					);
					
				}
				
				
			} else {
				
				wp_set_object_terms( $post_id, $target_id, 'chumly_post_target', TRUE );
				
				$notification = array(
					'sender_id'  => $current_user_id,
					'recipients' => chumly_get_friends(),
					'source'     => '',
					'type'       => $components[ 'meta_data' ][ 'post_type' ],
					'link'       => '/profile',
					'message'    => 'shared a ' . $components[ 'meta_data' ][ 'post_format' ] . ' on their wall'
				);
				
			}
			
			break;
		
		case 'chumly_group_message':
			
			wp_set_object_terms( $post_id, $target_id, 'chumly_target_group', TRUE );
			
			break;
		
	}
	
	
	if( $components[ 'meta_data' ][ 'post_format' ] == 'comment' ) {
		
		wp_set_object_terms( $post_id, $target_id, 'chumly_post_target', TRUE );
		
	}
	
	if( $current_user_id != $target_id ) {
		
		wp_set_object_terms( $post_id, (string)$current_user_id, 'chumly_linked', TRUE );
		
	}
	
	$notifications = new Chumly_Notifications();
	$notifications->save_notification( $notification );
	
	update_post_meta( $post_id, 'post_source', $target_id );
	
	if( !empty( $notification ) ) {
		
		$notifications = new Chumly_Notifications();
		$notifications->save_notification( $notification );
		
	}
	
	$return_data[ 'parent_post' ] = $post_id;
	$return_data[ 'post_format' ] = $components[ 'meta_data' ][ 'post_format' ];
	$return_data[ 'post_type' ] = $components[ 'meta_data' ][ 'post_type' ];
	$return_data[ '$_POST' ] = $_POST;
	
	return $return_data;
	
}


function chumly_set_post_format( $post_id, $post_format ) {
	
	wp_set_object_terms( $post_id, $post_format, 'chumly_post_format', TRUE );
	
}


function chumly_get_post_format( $post = NULL ) {
	
	if( !$post ) {
		global $post;
	}
	
	return get_the_terms( $post->ID, 'chumly_post_format' )[ 0 ]->slug;
	
}


function chumly_save_post() {
	
	$return_data = chumly_process_post_save();
	
	echo json_encode( $return_data );
	
	chumly_die();
	
}

add_action( 'wp_ajax_chumly_save_post', 'chumly_save_post' );
add_action( 'wp_ajax_nopriv_chumly_save_post', 'chumly_save_post' );


function chumly_share_post() {
	
	$share_post = chumly_process_post_save();
	
	$share_post_id = $share_post[ 'parent_post' ];
	
	if( $share_post_id > 0 ) {
		
		$return_data = $_POST;
		
		wp_set_object_terms( $share_post_id, $_POST[ 'shared_content_id' ], 'chumly_linked', TRUE );
		
		echo json_encode( $return_data );
		
	} else {
		
		echo 'There was an error';
		
	}
	
	chumly_die();
	
}

add_action( 'wp_ajax_chumly_share_post', 'chumly_share_post' );
add_action( 'wp_ajax_nopriv_chumly_share_post', 'chumly_share_post' );


function chumly_load_feed_part() {
	
	$query = new WP_Query( array(
		'post_type' => $_POST[ 'post_type' ],
		'p'         => $_POST[ 'post_id' ]
	) );
	
	if( $_POST[ 'post_format' ] == 'standard' ) {
		$post_format = 'post';
	} else {
		$post_format = $_POST[ 'post_format' ];
	}
	
	
	while( $query->have_posts() ) : $query->the_post();
		
		chumly_get_template( 'feed', $post_format );
	
	endwhile;
	
	chumly_die();
}

add_action( 'wp_ajax_chumly_load_feed_part', 'chumly_load_feed_part' );
add_action( 'wp_ajax_nopriv_chumly_load_feed_part', 'chumly_load_feed_part' );


