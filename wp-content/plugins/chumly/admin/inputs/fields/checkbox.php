<?php
function checkbox_admin_markup(){
	
	$input_ID = str_replace('item_', NULL, $_REQUEST['row_id']);
	$input_data = chumly_unserialize($_REQUEST['input_data']);
	?>
	
	<tr class="field-type-anchor"></tr>
	
	<tr class="input-data">
		<td class="label">
			<label>Placeholder Text</label>
			<p>Appears above the checkbox options</p>
		</td>
		
		<td class="input-wrap">
			<input type="text" class="input" name="input_<?php echo $input_ID; ?>[input_data][placeholder]" value="<?php echo $input_data['placeholder']; ?>" />
		</td>
	</tr>
	
	<tr class="input-data">
		<td class="label">
			<label>Options</label>
			<p>Enter each choice on a new line.</p><br>
			<p>For more control, you may specify both a value and label like this:</p><br>
			<p>red : Red</p>
		</td>
		
		<td class="input-wrap">
			<textarea rows="10" class="input" name="input_<?php echo $input_ID; ?>[input_data][select_options]"><?php echo $input_data['select_options']; ?></textarea>
		</td>
	</tr>
	
	<?php
	die();
	
}

add_action('wp_ajax_checkbox_admin_markup', 'checkbox_admin_markup');
