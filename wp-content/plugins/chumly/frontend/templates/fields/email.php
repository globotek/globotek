<?php
function chumly_edit_email_field( $input, $options = NULL, $attributes = NULL ) {
	//echo '$input';
	//var_dump($attributes);
	
	
	echo '<div class="form__group ' . $input->input_placement . '">';
	
	echo '<label class="form__group__label ' . $options['label_class'] . '" for="' . $input->input_id . '">' . $input->input_label . '</label>';
	
	echo '<input
			id="' . $input->input_id . '"
			class="form__group__input ' . $options['input_class'] . '"
			type="' . $input->input_type . '"
			name="' . $input->input_id . '[value]"
			autocapitalize="none"
			value="' . esc_attr( $attributes['value'] ) . '" ' . $attributes['attributes'] . ' ' . $attributes['required'] . ' />';
	
	echo '<input type="hidden" name="' . $input->input_id . '[label]' . '" value="' . $input->input_label . '" />';
	
	if ( $attributes['meta'] ) {
		foreach ( $attributes['meta'] as $meta_key => $meta_value ) {
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


function chumly_prepare_email_field( $data ) {
	if ( $data['input']->input_type == 'email' ) {
		
		$value = $data['value']['value'];
		
		return $value;
		
	}
}

add_action( 'chumly_process_email_field', 'chumly_prepare_email_field' );


function chumly_view_email_field( $field_data, $show_label = TRUE ) {
	
	_e( '<p>' );
	
	_e( $show_label ? '<strong>' . $field_data->label . '</strong> ' : '' );
	
	_e( '<a href="mailto:' . $field_data->value . '">' . $field_data->value . '</a>' );
	
	_e( '</p>' );
	
}

