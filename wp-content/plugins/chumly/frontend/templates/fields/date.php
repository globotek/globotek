<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 14/6/18
 * Time: 10:18 PM
 */
function chumly_edit_date_picker_field( $input, $options = NULL, $attributes = NULL ) {
	
	echo '<div class="form__group ' . $input->input_placement . '">';
	
	echo '<label class="form__group__label ' . $options[ 'label_class' ] . '" for="' . $input->input_id . '">' . $input->input_label . '</label>';
	
	echo '<input
			class="form__group__input datepicker ' . $input->input_id . ' ' . $options[ 'input_class' ] . '"
			type="text"
			name="' . $input->input_id . '[value]"
			value="' . $attributes[ 'value' ] . '" ' . $attributes[ 'attributes' ] . $attributes[ 'required' ] . ' />';
	
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


function chumly_prepare_date_picker_field( $data ) {

	return $data[ 'value' ][ 'value' ];
	
}

add_filter( 'chumly_process_date_picker_field', 'chumly_prepare_date_picker_field' );


function chumly_view_date_picker_field( $field_data, $show_label = TRUE ) {
	
	_e( '<p>' );
	
	_e( $show_label ? '<strong>' . $field_data->label . '</strong> ' : '' );
	
	_e( $field_data->value );
	
	_e( '</p>' );
	
}
