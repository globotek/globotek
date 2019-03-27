<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 2/8/18
 * Time: 11:59 AM
 */
function chumly_edit_file_field( $input, $options = NULL, $attributes = NULL ){
	
	echo '<div class="form__group ' . $input->input_placement . '">';
	
	echo '<label for="' . $input->input_id . '" class="form__group__label">' . $input->input_label . '</label>';
	
	echo '<div class="form__group__file">';
	
	echo '<label for="' . $input->input_id . '" class="button  button--primary">Upload ' . $input->input_label . '</label>';
	
	echo '<span></span>';
	
	echo '<input 
			type="file"
			id="' . $input->input_id . '"
		  	class="" 
			name="' . $input->input_id . '[]"
			data-target="profile_file"
			data-upload="true" />';
	
	echo '</div>';
	
	echo '<div class="upload__preview upload__preview--large chunk"></div>';
	
	echo '<div class="upload_status"></div>';
	
	echo '<div class="hidden_upload_fields"></div>';
	
	
	echo '</div>';
	
	
}


function chumly_prepare_file_field($data){
	
	$upload_dir = wp_upload_dir();
	
	return trailingslashit($upload_dir['url']) . $data['value']['name'][0];
		
}

add_filter('chumly_process_file_field', 'chumly_prepare_file_field');


function chumly_view_file_field( $field_data ){
	
	_e( '<p><strong>' . $field_data->label . '</strong> <a href="' . $field_data->value . '" download>Download</a></p>' );
	
}