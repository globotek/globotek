<?php
function chumly_edit_number_field( $input, $options, $attributes = NULL ) {
	
	echo '<div class="form__group ' . $input->input_placement . '">';
	
	echo '<label class="form__group__label ' . $options['label_class'] . '" for="' . $input->input_name . '">' . $input->input_label . '</label>';
	echo '<input 
			id="' . $input->input_name . '" 
			class="form__group__input" 
			type="' . $input->input_type . '" 
			name="' . $input->input_id . '[value]" 
			value="' . esc_attr( $attributes['value'] ) . '" ' . $attributes['attributes'] . $attributes['required'] . ' />';
	
	echo '<input type="hidden" name="' . $input->input_id . '[label]' . '" value="' . $input->input_label . '" />';
	
	if ( $attributes['meta'] ) {
		
		foreach ( $attributes['meta'] as $meta_key => $meta_value ) {
			//var_dump($meta_key);
			//var_dump($meta_value);
			echo '<input type="hidden" name="' . $input->input_id . '[' . $meta_key . ']' . '" value="' . $meta_value . '" />';
		}
		
	}
	
//	if ( empty( $_POST[ $input->input_name ] ) ) {
//		echo '<span class="' . $options['error_class'] . '">Please enter your ' . lcfirst( $input->input_label ) . '</span>';
//	}
	
	echo '</div>';
}


function chumly_prepare_number_field( $data ) {
	
	return $data['value']['value'];
}

add_action( 'chumly_process_number_field', 'chumly_prepare_number_field' );

function chumly_view_number_field( $field_data, $show_label = TRUE ) {
	
	_e( '<p>' );
	
	_e( $show_label ? '<strong>' . $field_data->label . '</strong> ' : '' );
	
	_e( $field_data->value );
	
	_e( '</p>' );
	
}
