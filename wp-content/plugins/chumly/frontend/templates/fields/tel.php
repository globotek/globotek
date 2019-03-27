<?php
function chumly_edit_tel_field( $input, $options = NULL, $attributes = NULL ) {
	
	//$registration = isset( $_POST[ 'register_user' ] );
	//var_dump( $attributes );
	//$value = ($registration) ? $_POST[$input->input_name] : $input_value->$value_key;
	
	echo '<div class="form__group ' . $input->input_placement . '">';
	
	echo '<label class="form__group__label ' . $options[ 'label_class' ] . '" for="' . $input->input_id . '">' . $input->input_label . '</label>';
	
	echo '<input 
			class="form__group__input ' . $input->input_id . ' ' . $options[ 'input_class' ] . '"
			type="' . $input->input_type . '" 
			name="' . $input->input_id . '[value]" 
			value="' . stripslashes( $attributes[ 'value' ] ) . '" ' . $attributes[ 'attributes' ] . $attributes[ 'required' ] . ' />';
	
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

//	if($registration && empty($_POST[$input->input_name])){
//		echo '<span class="' . $options['error_class'] . '">Please enter your ' . lcfirst($input->input_label) . '</span>';
//	}
	
	echo '</div>';
	
}


function chumly_prepare_tel_field( $data ) {
	
	return $data['value']['value'];
	
}

add_filter( 'chumly_process_tel_field', 'chumly_prepare_tel_field' );


function chumly_view_tel_field( $field_data, $show_label = TRUE ) {
	
	_e( '<p>' );
	
	_e( $show_label ? '<strong>' . $field_data->label . '</strong> ' : '' );
	
	_e( '<a href="tel:' . $field_data->value . '">' . $field_data->value . '</a>' );
	
	_e( '</p>' );
	
}
