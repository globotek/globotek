<?php
function chumly_field( $field, $show_label = FALSE ) {
	
	$function = 'chumly_view_' . $field->field_type . '_field';
	
	if( function_exists( $function ) ) {
		
		$function( $field, $show_label );
		
	} else {
		
		echo '<strong>Error - </strong> <i>Define a view function for the ' . $field->field_type . ' field type</i>';
		
	}
	
}


function chumly_avatar( $user_id = NULL, $source = 'profile', $class = NULL, $echo = TRUE ) {
	/**
	 * $echo TRUE = Return an HTML element.
	 * $echo FALSE = Return the URL to the image.
	 */
	if( $user_id == NULL ) {
		$user_id = chumly_explode_url()->ID;
	}
	
	if( !$user_id ) {
		$user_id = get_current_user_id();
	}
	
	$class = 'avatar__image ' . $class;
	
	
	do_action( 'chumly_avatar_conditionals', $source );
	
	if( $source == 'profile' ) {

		$image_url = wp_get_attachment_url(get_user_meta( $user_id, '_avatar_attachment_id', TRUE ) );

		if( !$image_url ) {
			$upload_dir = wp_upload_dir();
			$image_url = $upload_dir[ 'baseurl' ] . '/chumly/profile-avatars/default_placeholder.png';
		}
		
		if( $echo === FALSE ) {
			
			return $image_url;
			
		} elseif( $echo === TRUE ) {
			
			$user_data = get_userdata( $user_id );
			echo '<img class="' . $class . '" src="' . $image_url . '" alt="Avatar of ' . $user_data->first_name . ' ' . $user_data->last_name . '" title="' . $user_data->first_name . ' ' . $user_data->last_name . '"" />';
			
		}
	}
	
	
	if( $source == 'group' ) {
		
		$group_post_id = ( new Chumly_Groups )->get_linked_post_id( $user_id );
		
		$image_url = wp_get_attachment_url( get_post_meta( $group_post_id, '_thumbnail_id', TRUE ) );
		
		if( !$image_url ) {
			$upload_dir = wp_upload_dir();
			$image_url = $upload_dir[ 'baseurl' ] . '/chumly/group-avatars/default_placeholder.png';
		}
		
		
		if( $echo === FALSE ) {
			
			return $image_url;
			
		} elseif( $echo === TRUE ) {
			
			echo '<img class="' . $class . '" src="' . $image_url . '" alt="" />';
			
		}
		
	}
	
	
	if( filter_var( $source, FILTER_VALIDATE_URL ) ) {
		
		return $source;
		
	}
	
}
