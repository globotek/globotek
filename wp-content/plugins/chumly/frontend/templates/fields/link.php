<?php
function chumly_edit_link_field( $input, $options, $attributes = NULL ) {
	/**
	 * $input = $input data.
	 * $options = array();
	 * $options['label_class'] = label CSS class.
	 * $options['input_class'] = input CSS class.
	 * $options['error_class'] = error CSS class.
	 */
	
	$registration = isset( $_POST[ 'register_user' ] );

//	$value = ($registration) ? $_POST[$input->input_name] : $input_value->$value_key;
	
//	var_dump( $attributes );
	echo '<div class="form__group ' . $input->input_placement . '">';
	
	echo '<label class="form__group__label ' . $options[ 'label_class' ] . '" for="' . $input->input_name . '">' . $input->input_label . '</label>';
	
	echo '<input
			class="form__group__input ' . $input->input_id . ' ' . $options[ 'input_class' ] . '"
			type="' . $input->input_type . '"
			name="' . $input->input_id . '[value]"
			value="' . esc_attr( stripslashes( $attributes[ 'value' ] ) ) . '" ' . $attributes[ 'attributes' ] . $attributes[ 'required' ] . ' />';
	
	
	echo '<input type="hidden" name="' . $input->input_id . '[label]' . '" value="' . $input->input_label . '" />';
	echo '<input type="hidden" name="' . $input->input_id . '[name]' . '" value="' . $input->input_name . '" />';
	
	if ( $attributes[ 'meta' ] ) {
		foreach ( $attributes[ 'meta' ] as $meta_key => $meta_value ) {
			//var_dump($meta_key);
			//var_dump($meta_value);
			echo '<input type="hidden" name="' . $input->input_id . '[' . $meta_key . ']' . '" value="' . $meta_value . '" />';
		}
	}
	
	if ( $registration && empty( $_POST[ $input->input_name ] ) ) {
		echo '<span class="' . $options[ 'error_class' ] . '">Please enter your ' . lcfirst( $input->input_label ) . '</span>';
	}
	
	echo '</div>';
	
}


function chumly_prepare_link_field( $data ) {
	
	$value = $data[ 'value' ][ 'value' ];
	
	return $value;
}

add_filter( 'chumly_process_link_field', 'chumly_prepare_link_field' );


function chumly_view_link_field( $field_data ){
	
}