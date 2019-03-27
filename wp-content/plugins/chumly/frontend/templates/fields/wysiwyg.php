<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 2/8/18
 * Time: 12:03 PM
 */
function chumly_edit_wysiwyg_field( $input, $options = NULL, $attributes = NULL ) {
	
	echo '<div class="form__group ' . $input->input_placement . '">';
	echo '<label class="form__group__label" for="' . $input->input_name . '">' . $input->input_label . '</label>';
	
	wp_editor( $attributes[ 'value' ], $input->input_id . '_tinymce_editor', array(
		'textarea_name' => $input->input_id . '[value]',
		'editor_class'  => 'form__group__input form__group__field--multiline form__group__field--wysiwyg'
	) );

	echo '<input type="hidden" name="' . $input->input_id . '[label]' . '" value="' . $input->input_label . '" />';
	echo '<input type="hidden" name="' . $input->input_id . '[name]' . '" value="' . $input->input_name . '" />';
	
	if ( $attributes[ 'meta' ] ) {
		
		foreach ( $attributes[ 'meta' ] as $meta_key => $meta_value ) {
			echo '<input type="hidden" name="' . $input->input_id . '[' . $meta_key . ']' . '" value="' . $meta_value . '" />';
		}
		
	}
	
	echo '</div>';
	
	/*	$registration = isset( $_POST['register_user'] );
		//$value = ($registration) ? $_POST[$input->input_name] : $input_value->$value_key;
		
		
		
		if ( $registration && empty( $_POST[ $input->input_name ] ) ) {
			echo '<span class="' . $options['error_class'] . '">Please enter your ' . lcfirst( $input->input_label ) . '</span>';
		}
		*/
}


function chumly_prepare_wysiwyg_field( $data ) {

	return wp_kses_post( $data[ 'value' ][ 'value' ] );
	
}

add_filter( 'chumly_process_wysiwyg_field', 'chumly_prepare_wysiwyg_field' );


function chumly_view_wysiwyg_field( $field_data, $show_label = TRUE ){
	
	_e( '<p>' );
	
	_e( $show_label ? '<strong>' . $field_data->label . '</strong> ' : '' );
	
	_e( '<div class="wysiwyg">' . $field_data->value . '</div>' );
	
	_e( '</p>' );
	
}