<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 19/12/18
 * Time: 5:43 PM
 */
if ( function_exists( 'acf' ) ) {
	
	function chumly_render_acf_field( $field, $input, $el = 'div', $instruction = 'label' ) {
		
		// get valid field
		$field = acf_get_valid_field( $field );
		
		// prepare field for input
		$field = acf_prepare_field( $field );
		
		$field[ 'name' ] = $input->input_id . '[value]';
		
		// bail ealry if no field
		if( !$field ) return;
		
		
		// elements
		$elements = array(
			'div'	=> 'div',
			'tr'	=> 'td',
			'ul'	=> 'li',
			'ol'	=> 'li',
			'dl'	=> 'dt',
			'td'	=> 'div' // special case for sub field!
		);
		
		
		// vars
		$el = isset($elements[ $el ]) ? $el : 'div';
		$el2 = $elements[ $el ];
		$show_label = ($el !== 'td') ? true : false;
		
		
		// wrapper
		$wrapper = array(
			'id'		=> '',
			'class'		=> 'acf-field',
			'width'		=> '',
			'style'		=> '',
			'data-name'	=> $field['_name'],
			'data-type'	=> $field['type'],
			'data-key'	=> '',
		);
		
		
		// add required
		if( $field['required'] ) {
			$wrapper['data-required'] = 1;
		}
		
		
		// add type
		$wrapper['class'] .= " acf-field-{$field['type']}";
		
		
		// add key
		if( $field['key'] ) {
			
			$wrapper['class'] .= " acf-field-{$field['key']}";
			$wrapper['data-key'] = $field['key'];
			
		}
		
		
		// replace
		$wrapper['class'] = str_replace('_', '-', $wrapper['class']);
		$wrapper['class'] = str_replace('field-field-', 'field-', $wrapper['class']);
		
		
		// wrap classes have changed (5.2.7)
		if( acf_get_compatibility('field_wrapper_class') ) {
			
			$wrapper['class'] .= " field_type-{$field['type']}";
			
			if( $field['key'] ) {
				
				$wrapper['class'] .= " field_key-{$field['key']}";
				
			}
			
		}
		
		
		// merge in atts
		$wrapper = acf_merge_atts( $wrapper, $field['wrapper'] );
		
		
		// add width
		$width = (int) acf_extract_var( $wrapper, 'width' );
		
		if( $el == 'tr' || $el == 'td' ) {
			
			// do nothing
			
		} elseif( $width > 0 && $width < 100 ) {
			
			$wrapper['data-width'] = $width;
			$wrapper['style'] .= " width:{$width}%;";
			
		}
		
		
		// remove empty attributes
		$wrapper = array_filter($wrapper);
		
		
		// conditional logic
		if( !empty($field['conditional_logic']) ) {
			$field['conditions'] = $field['conditional_logic'];
		}
		
		// conditions
		if( !empty($field['conditions']) ) {
			$wrapper['data-conditions'] = $field['conditions'];
		}
		
		
		// html
		?>
		<<?php echo $el . ' ' . acf_esc_attr( $wrapper ); ?>>
		
		<<?php echo $elements[ $el ]; ?> class="acf-input form-input__group">
		
		<?php acf_render_field( $field ); ?>
		
		</<?php echo $elements[ $el ]; ?>>
		
		</<?php echo $elements[ $el ]; ?>>
		<?php
		
	}
	
}