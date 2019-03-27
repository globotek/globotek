<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 8/1/18
 * Time: 7:05 PM
 */
function chumly_edit_checkbox_field( $input, $options = NULL, $attributes = NULL ) {
	
	$input_data       = chumly_unserialize( $input->input_data );
	$options_string   = $input_data[ 'select_options' ];
	$checkbox_options = preg_split( '/$\R?^/m', $options_string );
	
	//var_dump( $checkbox_options );
	//var_dump( $attributes );
	
	echo '<div class="form__group ' . $input->input_placement . '">';
	
	echo '<label class="form__group__label ' . $options[ 'label_class' ] . '" for="' . $input->input_id . '">' . $input->input_label . '</label>';
	
	foreach ( $checkbox_options as $checkbox_data ) {
		
		$checkbox = explode( ' : ', $checkbox_data );
		$checkbox_label = ( $checkbox[ 1 ] ) ? $checkbox[ 1 ] : $checkbox[ 0 ];
		
		echo '<div class="form__group__checkbox">';
		
		echo '<input
			class="form__group__checkbox__input ' . $input->input_id . ' ' . $options[ 'input_class' ] . '"
			type="checkbox"
			id="' . $input->input_id . '[value][' . $checkbox[ 0 ] . ']"
			name="' . $input->input_id . '[value][' . $checkbox[ 0 ] . ']"
			value="' . esc_attr( stripslashes( $checkbox[ 0 ] ) ) . '"' . (in_array($checkbox[0], explode(', ', $attributes[ 'value' ])) ? 'checked' : '') . '/>';
		
		echo '<label class="form__group__checkbox__label ' . $options[ 'label_class' ] . '" for="' . $input->input_id . '[value][' . $checkbox[ 0 ] . ']">' . $checkbox_label . '</label>';
		
		echo '</div>';
		
	}
	
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
	
}

function chumly_prepare_checkbox_field( $data ) {
	
	$value = implode( ', ', $data[ 'value' ][ 'value' ] );
	
	return $value;
	
}

add_filter( 'chumly_process_checkbox_field', 'chumly_prepare_checkbox_field' );

function chumly_view_checkbox_field( $field_data, $show_label = TRUE ) {
		
	_e( '<p>' );
	
	_e( $show_label ? '<strong>' . $field_data->label . '</strong> ' : '' );
	
	_e( $field_data->value );
	
	_e( '</p>' );
	
	
}