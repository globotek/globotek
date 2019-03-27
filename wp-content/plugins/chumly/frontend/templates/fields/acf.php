<?php
	/**
	 * Created by PhpStorm.
	 * User: matthew
	 * Date: 19/12/18
	 * Time: 3:18 PM
	 */
	
	
	function chumly_edit_acf_field($input, $options = NULL, $attributes = NULL) {
		
		if ($input->input_active && function_exists('acf')) {
			
			echo '<div class="form__group ' . $input->input_placement . '">';
			
			echo '<label class="form__group__label ' . $options['label_class'] . '" for="' . $input->input_id . '">' . $input->input_label . '</label>';
			
			$field = acf_get_field($attributes['attributes']['acf_field_key']);
			
			$field['value'] = acf_get_value('user_' . get_current_user_id(), $field);
			
			chumly_render_acf_field($field, $input);
			
			echo '<input type="hidden" name="' . $input->input_id . '[label]' . '" value="' . $input->input_label . '" />';
			echo '<input type="hidden" name="' . $input->input_id . '[name]' . '" value="' . $input->input_name . '" />';
			
			if ($attributes['meta']) {
				foreach ($attributes['meta'] as $meta_key => $meta_value) {
					echo '<input type="hidden" name="' . $input->input_id . '[' . $meta_key . ']' . '" value="' . $meta_value . '" />';
				}
			}
			
			if ($input->input_instructions) {
				echo '<p>' . $input->input_instructions . '</p>';
			}
			
			echo '</div>';
			
		}
		
	}
	
	
	function chumly_prepare_acf_field($data) {
		
		$input_data = chumly_unserialize($data['input']->input_data);
		
		update_field($input_data['acf_field_key'], $data['value']['value'], 'user_' . $data['user_id']);
		
		foreach ($data['value']['value'] as $item) {
			
			$save_data[] = get_the_title($item);
			
		}
		
		return $save_data;
		
	}
	
	add_filter('chumly_process_acf_field', 'chumly_prepare_acf_field');
	
	
	function chumly_view_acf_field($field_data) {
		
		$value = $field_data->value;
		
		if (is_array($value)) {
			
			echo implode(', ', $value);
			
		} else {
			
			echo $field_data->value;
			
		}
		
	}