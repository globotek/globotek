<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 9/1/18
 * Time: 8:47 PM
 */
function chumly_edit_privacy_field( $input, $options = NULL, $attributes = NULL ) {
	
	$input_data = chumly_unserialize( $input->input_data );
	
	if ( is_null( $attributes[ 'value' ] ) ) {
		$saved_value = intval( $input_data[ 'default_choice' ] );
	} else {
		$saved_value = intval( $attributes[ 'value' ] );
	}
		
	echo '<div class="form__group ' . $input->input_placement . '">';
	echo '<div class="form__group__radio">';
	
	echo '<label class="form__group__label ' . $options[ 'label_class' ] . '" for="' . $input->input_id . '">' . $input->input_label . '</label>';
	
	echo '<div class="button-group button-group--narrow">';
	
	foreach ( $input_data[ 'options' ] as $privacy_option ) {
		
		$option_label = $privacy_option[ 'label' ];
		$option_value = intval( $privacy_option[ 'value' ] );
		
		echo '<div class="button-group__item">';
		
		echo '<label for="' . $input->input_id . '_' . $option_value . '" class="button  ' . ( $saved_value == $option_value ? 'button--primary' : '' ) . '">' . rtrim( $option_label );
		echo '<input 
			id="' . $input->input_id . '_' . $option_value . '"
			class="' . ( intval( $saved_value ) == intval( $option_value ) ? 'active' : '' ) . '"
			type="radio"
			name="' . $input->input_id . '[value]"
			value="' . $option_value . '" ' . checked( $saved_value, $option_value, FALSE ) . '/>';
		echo '</label>';
		
		echo '</div>';
		
	}
	
	echo '</div>';
	
	echo '<input type="hidden" name="' . $input->input_id . '[label]' . '" value="' . $input->input_label . '" />';
	echo '<input type="hidden" name="' . $input->input_id . '[name]' . '" value="' . $input->input_name . '" />';
	
	if ( $attributes[ 'meta' ] ) {
		foreach ( $attributes[ 'meta' ] as $meta_key => $meta_value ) {
			echo '<input type="hidden" name="' . $input->input_id . '[' . $meta_key . ']' . '" value="' . $meta_value . '" />';
		}
	}
	
	echo '</div>';
	echo '</div>';
	
}


function chumly_prepare_privacy_field( $data ) {
	
	$value = intval( $data[ 'value' ][ 'value' ] );
	
	return $value;
	
}

add_filter( 'chumly_process_privacy_field', 'chumly_prepare_privacy_field' );


function chumly_view_privacy_field( $field_data, $show_label = TRUE ) {
	
	_e( '<p>' );
	
	_e( $show_label ? '<strong>' . $field_data->label . '</strong> ' : '' );
	
	_e( $field_data->value );
	
	_e( '</p>' );
	
}