<?php
global $wpdb;
$inputs = $wpdb->get_results( "
	SELECT * FROM " . $wpdb->prefix . "chumly_inputs
	WHERE input_location = '" . $input_location . "'
	AND input_group = '" . esc_attr( $_GET[ 'input_group' ] ) . "'
	AND user_type = '" . esc_attr( $_GET[ 'user_type' ] ) . "'
	ORDER BY input_order ASC"
);

$i = 0; ?>
	
	<ul class="inputs-list">
		
		<?php
//		$total_inputs = count( $inputs );
		$inputs_index = ( chumly_get_option( 'inputs_index' ) );
		
//		echo '<input type="hidden" id="field_count" name="field_count" value="' . $total_inputs . '">';
		echo '<input type="hidden" id="input_group" name="input_group" value="' . $_GET[ 'input_group' ] . '">';
		echo '<input type="hidden" id="user_type" name="user_type" value="' . $_GET[ 'user_type' ] . '">';
		
		if( $inputs ) {
			
			foreach( $inputs as $input ) {
				
				$i++;
				
				output_field_row( $input, $i, $input_location, $inputs_index );
				
			}
			
		} ?>
	
	</ul>

<?php if( $input_location != 'required' ) { ?>
	<li class="inputs-row">
		<input type="button" class="button-primary add-field-row" value="+ Add Row"/>
	</li>
<?php }

