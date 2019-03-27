<?php
function chumly_edit_avatar_field( $input = NULL, $options = NULL, $attributes = NULL ) {
	
	if( !$options[ 'user_type' ] ) {
		
		global $chumly;
		
		$user_type = $chumly->user_type;
		
	} else {
		
		$user_type = $options[ 'user_type' ];
		
	}
	
	$input_data = chumly_unserialize( $input->input_data );
	
	if( $input->input_active ) {
		
		echo '<div class="form__group ' . $input->input_placement . '">';
		
		if( $options[ 'hide_label' ] != TRUE ) {
			
			echo '<label for="' . $input->input_id . '" class="form__group__label">' . $input->input_label . '</label>';
			
		}
		
		echo '<div class="form__group__file">';
		
		echo '<label for="' . $input->input_id . '" class="button  button--primary">Upload ' . $input->input_label . '</label>';
		
		echo '<span></span>';
		
		echo '<input 
			type="file"
			id="' . $input->input_id . '"
		  	class="" 
			name="' . $input->input_id . '[]" 
			data-media_classification="' . $input_data['media_classification'] . '"
			data-upload="true" 
			data-croppable="' . ( $input_data[ 'crop_enabled' ] == 1 ? 'true' : 'false' ) . '" />';
		
		echo '</div>';
		
		echo '<div class="upload__preview chunk">';
		//chumly_avatar( chumly_explode_url()->ID, $user_type );
		echo '</div>';
		
		echo '<div class="upload_status"></div>';
		
		echo '<div class="hidden_upload_fields"></div>';
		
		echo '<div class="ajax_response"></div>';
		echo '<div class="saved_response"></div>';
		
		
		echo '</div>';
		
	}
	
}


function chumly_prepare_avatar_field( $data ) {
	
	$upload_dir = wp_upload_dir();
	
	save_avatar_attachment_id( $data );
	
	return trailingslashit( $upload_dir[ 'url' ] ) . $data[ 'value' ][ 'name' ][ 0 ];
	
}

add_action( 'chumly_process_avatar_field', 'chumly_prepare_avatar_field' );


function chumly_view_avatar_field( $field_data ) {
	
	_e( '<img src="' . $field_data->value . '" />' );
	
}


function save_avatar_attachment_id( $data, $attachment_id = NULL ) {

	if( !$attachment_id ) {
		$attachment_id = $data[ 'attachment_id' ];
	}

	if( $attachment_id ) {
		
		if( $data[ 'media_classification' ] == 'profile_picture' || $data == 'profile_picture' ) {
			
			update_user_meta( get_current_user_id(), '_avatar_attachment_id', $attachment_id );
			
		} elseif( $data[ 'media_classification' ] == 'group_logo' || $data == 'group_logo' ) {

			update_post_meta( $data[ 'parent_post' ], '_avatar_attachment_id', $attachment_id);
			
		} elseif( $data[ 'user_id' ] ) {

			update_user_meta( $data[ 'user_id' ], '_avatar_attachment_id', $attachment_id );
			
		} elseif( $data[ 'group_post_id' ] ) {

			update_post_meta( $data[ 'group_post_id' ], '_avatar_attachment_id', $attachment_id );
			
		} else {
			
			return FALSE;
			
		}
		
		return $attachment_id;
		
	}
	
}

add_action( 'chumly_after_save_file', 'save_avatar_attachment_id', 10, 2 );
