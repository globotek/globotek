<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 9/1/18
 * Time: 8:47 PM
 */
function chumly_edit_radio_field( $input, $options = NULL, $attributes = NULL ) {
	
	$input_data = chumly_unserialize( $input->input_data );
	//var_dump($attributes['value']);
	if ( !$attributes[ 'value' ] ) {
		$saved_value = $input_data[ 'default_choice' ];
	} else {
		$saved_value = $attributes[ 'value' ];
	}
	//var_dump( $saved_value );
	$radio_choices = preg_split( '/\r\n|[\r\n]/', $input_data[ 'choices' ] );
	
	echo '<div class="form__group ' . $input->input_placement . '">';
	echo '<div class="form__group__radio">';
	
	echo '<label class="form__group__label ' . $options[ 'label_class' ] . '" for="' . $input->input_id . '">' . $input->input_label . '</label>';
	
	echo '<div class="button-group button-group--narrow">';

	foreach ( $radio_choices as $choice_key => $choice_values ) {
		
		$choice_data = explode( ':', $choice_values );
		$choice_label = ( $choice_data[ 1 ] ) ? $choice_data[ 1 ] : $choice_data[ 0 ];
		$value = $choice_data[ 0 ];
		
	//	var_dump( $value );
		
		echo '<div class="button-group__item">';
		
		echo '<label for="' . $input->input_id . '_' . $choice_key . '" class="button  ' . ($saved_value == $value ? 'button--primary' : '') . '">' . rtrim( $choice_label );
		echo '<input 
			id="' . $input->input_id . '_' . $choice_key . '"
			class="' .  ($saved_value == $value ? 'active' : '') . '"
			type="' . $input->input_type . '"
			name="' . $input->input_id . '[value]"
			value="' . $value . '" ' . checked( $saved_value, $value, FALSE ) . '/>';
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


function chumly_prepare_radio_field( $data ) {

	$value = $data[ 'value' ][ 'value' ];
	
	return $value;
	
}

add_filter( 'chumly_process_radio_field', 'chumly_prepare_radio_field' );


function chumly_view_radio_field( $field_data, $show_label = TRUE ){
	
	_e( '<p>' );
	
	_e( $show_label ? '<strong>' . $field_data->label . '</strong> ' : '' );
	
	_e( $field_data->value );
	
	_e( '</p>' );
	
}