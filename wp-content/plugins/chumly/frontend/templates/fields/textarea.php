<?php
function chumly_edit_textarea_field( $input, $options = NULL, $attributes = NULL ) {
	$registration = isset( $_POST[ 'register_user' ] );
	//$value = ($registration) ? $_POST[$input->input_name] : $input_value->$value_key;
	
	echo '<div class="form__group ' . $input->input_placement . '">';
	echo '<label class="form__group__label" for="' . $input->input_name . '">' . $input->input_label . '</label>';
	echo '<textarea 
			id="' . $input->input_id . '" 
			class="form__group__input form__group__field--multiline"	
			name="' . $input->input_id . '[value]" ' . $attributes[ 'attributes' ] . $attributes[ 'required' ] . '>' . esc_textarea( stripslashes( $attributes[ 'value' ] ) ) . '</textarea>';
	
	echo '<input type="hidden" name="' . $input->input_id . '[label]' . '" value="' . $input->input_label . '" />';
	echo '<input type="hidden" name="' . $input->input_id . '[name]' . '" value="' . $input->input_name . '" />';
	
	if ( $attributes[ 'meta' ] ) {
		
		foreach ( $attributes[ 'meta' ] as $meta_key => $meta_value ) {
			echo '<input type="hidden" name="' . $input->input_id . '[' . $meta_key . ']' . '" value="' . $meta_value . '" />';
		}
		
	}
	
	if ( $registration && empty( $_POST[ $input->input_name ] ) ) {
		echo '<span class="' . $options[ 'error_class' ] . '">Please enter your ' . lcfirst( $input->input_label ) . '</span>';
	}
	echo '</div>';
}


function chumly_prepare_textarea_field( $data ) {
	
	$value = sanitize_textarea_field( $data['value']['value'] );
	
	return $value;
	
}

add_filter( 'chumly_process_textarea_field', 'chumly_prepare_textarea_field' );


function chumly_view_textarea_field( $field_data ) {
	
	_e( '<div class="wysiwyg"><strong>' . $field_data->label . '</strong> ' . wpautop( esc_textarea( $field_data->value ) ) . '</div>' );
	
}

/*function chumly_view_textarea_field( $field, $echo = TRUE ) {
	global $chumly;
	
	$field_input_data = chumly_get_input( $chumly->user->role, 'profile', $field->field_id );
	
	echo '<div class="' . $field_input_data[0]->input_placement . '">';
	
	_e( $echo === TRUE ? '<p>' . $field_input_data[0]->input_label . '</p>' : NULL );
	echo '<div class="wysiwyg">' . esc_textarea( $field->value ) . '</div>';
	
	echo '</div>';
}*/