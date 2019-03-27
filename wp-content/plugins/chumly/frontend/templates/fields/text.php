<?php
function chumly_edit_text_field( $input, $options = NULL, $attributes = NULL ) {
	/**
	 * $input = $input data.
	 * $options = array();
	 * $options['label_class'] = label CSS class.
	 * $options['input_class'] = input CSS class.
	 * $options['error_class'] = error CSS class.
	 */
	
	echo '<div class="form__group ' . $input->input_placement . '">';
	
	echo '<label class="form__group__label ' . $options[ 'label_class' ] . '" for="' . $input->input_id . '">' . $input->input_label . '</label>';
	
	echo '<input
			class="form__group__input ' . $input->input_id . ' ' . $options[ 'input_class' ] . '"
			type="' . $input->input_type . '"
			name="' . $input->input_id . '[value]"
			value="' . esc_attr( stripslashes( $attributes[ 'value' ] ) ) . '" ' . implode($attributes[ 'attributes' ]) . ' ' . $attributes[ 'required' ] . ' />';
	
	echo '<input type="hidden" name="' . $input->input_id . '[label]' . '" value="' . $input->input_label . '" />';
	echo '<input type="hidden" name="' . $input->input_id . '[name]' . '" value="' . $input->input_name . '" />';
	
	if ( $attributes[ 'meta' ] ) {
		foreach ( $attributes[ 'meta' ] as $meta_key => $meta_value ) {
			echo '<input type="hidden" name="' . $input->input_id . '[' . $meta_key . ']' . '" value="' . $meta_value . '" />';
		}
	}
	
	if ( $input->input_instructions ) {
		echo '<p>' . $input->input_instructions . '</p>';
	}
	
	echo '</div>';
	
	/*
	 * THIS GOES WITH THE DUNNO WHAT IT'S FOR BIT - SOMETHING TO DO WITH REGISTRATION BUT MIGHT BE "LEGACY"
	 * 	if($registration && empty($_POST[$input->input_name])){
		echo '<span class="' . $options['error_class'] . '">Please enter your ' . lcfirst($input->input_label) . '</span>';
	}

	 */
	
}


function chumly_prepare_text_field( $data ) {
	
	$value = sanitize_text_field( $data[ 'value' ][ 'value' ] );
	
	return $value;
	
}

add_filter( 'chumly_process_text_field', 'chumly_prepare_text_field' );


function chumly_view_text_field( $field_data, $show_label = FALSE ) {
	
	_e( '<p>' );
	
	_e( $show_label ? '<strong>' . $field_data->label . '</strong> ' : '' );
	
	_e( stripslashes( $field_data->value ) );
	
	_e( '</p>' );
	
}
