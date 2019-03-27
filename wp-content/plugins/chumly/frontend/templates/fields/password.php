<?php
function chumly_edit_password_field( $input, $options = NULL, $attributes = NULL ) {
	
	global $wp_query;
	
	echo '<div class="form__group ' . $input->input_placement . '">';
	echo '<label class="form__group__label ' . $options[ 'label_class' ] . '" for="' . $input->input_id . '">' . $input->input_label . '</label>';
	
	echo '<input
			class="form__group__input ' . $input->input_id . '"
			type="' . $input->input_type . '"
			name="' . $input->input_id . '[value]"
			value="" ' . $attributes[ 'attributes' ] . ' ' . ( !is_user_logged_in() ? 'required' : '' ) . ' />';
	
	echo '<input type="hidden" name="' . $input->input_id . '[label]' . '" value="' . $input->input_label . '" />';
	echo '<input type="hidden" name="' . $input->input_id . '[name]' . '" value="' . $input->input_name . '" />';
	
	if ( $attributes[ 'meta' ] ) {
		foreach ( $attributes[ 'meta' ] as $meta_key => $meta_value ) {
			//var_dump($meta_key);
			//var_dump($meta_value);
			echo '<input type="hidden" name="' . $input->input_id . '[' . $meta_key . ']' . '" value="' . $meta_value . '" />';
		}
	}
	
	if ( $input->input_instructions ) {
		echo '<p>' . $input->input_instructions . '</p>';
	}
	
	echo '</div>';
	
}


function chumly_prepare_password_field( $data ) {
	
	return md5( $data[ 'value' ][ 'value' ] );
	
}

add_filter( 'chumly_process_password_field', 'chumly_prepare_password_field' );


function chumly_view_password_field( $field_data, $show_label = TRUE ) {
	
	_e( '<p>' );
	
	_e( $show_label ? '<strong>' . $field_data->label . '</strong> ' : '' );
	
	_e( '<i>Encrypted</i>' );
	
	_e( '</p>' );
	
}
