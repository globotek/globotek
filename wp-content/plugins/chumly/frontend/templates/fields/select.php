<?php
function chumly_edit_select_field( $input, $options = NULL, $attributes = NULL ) {
	/**
	 * $input = $input data.
	 * $options = array();
	 * $options['label_class'] = label CSS class.
	 * $options['input_class'] = input CSS class.
	 * $options['error_class'] = error CSS class.
	 */
	
	$registration = isset( $_POST[ 'register_user' ] );
	
	$input_data     = chumly_unserialize( $input->input_data );
	$options_string = $input_data[ 'select_options' ];
	$select_options = preg_split( '/$\R?^/m', $options_string );
	
	echo '<div class="form__group ' . $input->input_placement . '">';
	
	echo '<label class="form__group__label ' . $options[ 'label_class' ] . '" for="' . $input->input_name . '">' . $input->input_label . '</label>';
	
	echo '<select class="form__group__select ' . $options[ 'input_class' ] . '" id="' . $input->input_id . '" name="' . $input->input_id . '[value]"' . $attributes[ 'required' ] . ' />';
	
	echo '<option value="" selected>' . ( $input_data[ 'placeholder' ] ? $input_data[ 'placeholder' ] : 'Select an option' ) . '</option>';
	
	foreach ( $select_options as $option_data ) {
		$option       = explode( ':', $option_data );
		$option_value = str_replace( ' ', '_', trim( $option[ 0 ] ) );
		$option_label = ( $option[ 1 ] ) ? $option[ 1 ] : $option[ 0 ];
		echo '<option value="' . $option_value . '" ' . selected( $option_value, str_replace( ' ', '_', $attributes[ 'value' ] ) ) . '">' . $option_label . '</option>';
	}
	
	echo '</select>';
	
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

function chumly_prepare_select_field( $data ) {
	
	$value = $data[ 'value' ][ 'value' ];
	
	return $value;
	
}

add_filter( 'chumly_process_select_field', 'chumly_prepare_select_field' );


function chumly_view_select_field( $field_data, $show_label = TRUE ){

	_e( '<p>' );
	
	_e( $show_label ? '<strong>' . $field_data->label . '</strong> ' : '' );
	
	_e( $field_data->value );
	
	_e( '</p>' );
	
}