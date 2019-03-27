<?php
function date_picker_admin_markup() {

	$input_ID = str_replace('item_', NULL, $_REQUEST['row_id']);
	$input_data = chumly_unserialize($_REQUEST['input_data']); ?>
	
	<tr class="field-type-anchor"></tr>
	
	<tr class="input-data">
		
		<td class="label">
			<label>Date Picker Text</label>
			<p>Appears above the input</p>
		</td>
		
		<td class="input-wrap">
			<input type="text" class="input" name="input_<?php echo $input_ID; ?>[input_data][placeholder]" value="<?php echo $input_data['placeholder']; ?>" />
		</td>
	
	</tr>
	<?php
	
}

add_action( 'wp_ajax_date_picker_admin_markup', 'date_picker_admin_markup' );

