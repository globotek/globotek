<?php
function chumly_search_members( $all_names = NULL ) {
	
	$all_names    = explode( ', ', esc_attr( $_REQUEST[ 'query' ] ) );
	$query_name   = array_slice( $all_names, -1, 1, FALSE );
	$member_name  = explode( ' ', esc_attr( $query_name[ 0 ] ) );
	$first_name   = trim( $member_name[ 0 ], ',' );
	$last_name    = trim( $member_name[ 1 ], ',' );
	$current_user = get_current_user_id();
	
	$inclusions   = array();
	$exclusions   = array();
	$exclusions[] = $current_user;
	
	if ( empty( trim( $all_names[ 0 ] ) ) ) {
		die();
	}
	
	if ( !empty( $last_name ) ) {
		$query = new WP_User_Query( array(
			'exclude'    => $exclusions,
			'include'    => $inclusions,
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key'     => 'first_name',
					'value'   => $first_name,
					'compare' => 'LIKE'
				),
				array(
					'key'     => 'last_name',
					'value'   => $last_name,
					'compare' => 'LIKE'
				),
			)
		) );
		
	} else {
		
		$query = new WP_User_Query( array(
			'exclude'    => $exclusions,
			'include'    => $inclusions,
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key'     => 'first_name',
					'value'   => $first_name,
					'compare' => 'LIKE'
				),
				array(
					'key'     => 'last_name',
					'value'   => $first_name,
					'compare' => 'LIKE'
				),
			)
		) );
	}
	
	if ( !empty( $query->results ) ) {
		
		$results = new stdClass();
		
		foreach ( $query->results as $result ) {
			$user_id                         = $result->ID;
			$results->$user_id->id           = $user_id;
			$results->$user_id->display_name = $result->data->display_name;
		}
		
		echo output_results( $_POST[ 'output_option' ], $results );
		
	} else {
		
		echo 'No Results';
		
	}
	
	chumly_die();
	
}

add_action( 'wp_ajax_chumly_search_members', 'chumly_search_members' );
add_action( 'wp_ajax_nopriv_chumly_search_members', 'chumly_search_members' );


function output_results( $output_option, $results ) {
	
	echo '<ul class="user-list">';
	
	foreach ( $results as $result ) {
		
		switch ( $output_option ) {
			
			case 'message_center' :
				
				echo '<li class="user-list__item create-conversation" receiver_id="' . $result->id . '">';
				echo '<a href="#" class="user-list__item__inner user-list__item__inner--media-icon" role="button">';
				echo '<div class="user-list__item__media user-list__item__media--small">';
				echo '<figure class="avatar">';
				chumly_avatar( $result->id );
				echo '</figure>';
				echo '</div>';
				echo '<div class="user-list__item__text"><span class="user-list__item__text--primary">' . $result->display_name . '</span></div>';
				echo '<div class="user-list__item__icon">';
				echo '<svg class="icon" aria-hidden="true">';
				chumly_icon('angle-right');
				echo '</svg>';
				echo '</div>';
				echo '</a>';
				echo '</li>';
				
				break;
			
			default:
								
				echo '<li class="user-list__item add_to_group" data-user_id="' . $result->id . '" data-group_id="' . $_POST['object_id'] . '">';
				echo '<a href="#" class="user-list__item__inner user-list__item__inner--media-icon" role="button">';
				echo '<div class="user-list__item__media">';
				echo '<figure class="avatar">';
				chumly_avatar( $result->id );
				echo '</figure>';
				echo '</div>';
				echo '<div class="user-list__item__text"><span class="user-list__text__item--primary">' . $result->display_name . '</span></div>';
				echo '<div class="user-list__item__icon">';
				echo '<svg class="icon" aria-hidden="true">';
				chumly_icon('plus');
				echo '</svg>';
				echo '</div>';
				echo '</a>';
				echo '</li>';
				
				break;
							
		}
		
	}
	
	echo '</ul>';
	
}