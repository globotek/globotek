<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 13/12/18
 * Time: 1:32 PM
 */
function chumly_edit_posts_field( $input, $options = NULL, $attributes = NULL ) {
	
	if ( $input->input_active ) {
		
		echo '<div class="form-group">';
		
		echo '<label class="form__group__label ' . $options[ 'label_class' ] . '" for="' . $input->input_id . '">' . $input->input_label . '</label>';
		
		if ( ! is_admin() ) {
			
			if ( $attributes[ 'attributes' ][ 'term_variable' ] ) {
				
				$term_ids = explode( ',', $_GET[ 'term_id' ] );
				
				$query = array(
					'post_type' => $attributes[ 'attributes' ][ 'post_type' ],
					'tax_query' => array(
						array(
							'taxonomy' => $attributes[ 'attributes' ][ 'taxonomy' ],
							'field'    => 'term_id',
							'terms'    => $term_ids
						)
					)
				);
				
			} else {
				
				$query = array( 'post_type' => $attributes[ 'attributes' ][ 'post_type' ] );
				
			}
			
		} else {
			
			$query = array(
				'post_type' => $attributes[ 'attributes' ][ 'post_type' ],
				'tax_query' => array(
					array(
						'taxonomy' => $attributes[ 'attributes' ][ 'taxonomy' ],
						'field'    => 'term_id',
						'terms'    => 'XXX'
					)
				)
			);
			
		}
		
		$posts = get_posts( $query );
		
		foreach ( $posts as $post ) {
			
			echo '<input type="checkbox" name="' . $input->input_id . '[value][' . $post->ID . ']" id="' . $post->ID . '" value="' . $post->ID . '"' . checked( $post->ID, $attributes[ 'value' ][ $post->ID ], FALSE ) . '/>';
			echo '<label for="' . $post->ID . '">' . ucwords( str_replace( array(
					'_',
					'-'
				), ' ', $post->post_name ) ) . '</label>';
			
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
	
}


function chumly_prepare_posts_field( $data ) {
	
	return $data[ 'value' ][ 'value' ];
	
}

add_filter( 'chumly_process_posts_field', 'chumly_prepare_posts_field' );


function chumly_view_posts_field( $field_data, $show_label = FALSE ) {
	
	_e( '<p>' );
	
	_e( $show_label ? '<strong>' . $field_data->label . '</strong> ' : '' );
	
	_e( '<ul>' );
	
	foreach ( $field_data->value as $value ) {
		
		_e( '<li><a href="' . get_the_permalink( $value ) . '">' . stripslashes( get_post( $value )->post_title ) . '</a></li>' );
		
	}
	
	_e( '</ul>' );
	
	_e( '</p>' );
	
}