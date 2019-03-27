<?php
function text_admin_markup(){
	
	$input_ID = str_replace('item_', NULL, $_REQUEST['row_id']);
	$input_data = chumly_unserialize($_REQUEST['input_data']);	?>
	
	<tr class="field-type-anchor"></tr>
	
	<tr class="input-data">
		<td class="label">
			<label>Placeholder Text</label>
			<p>Appears within the input</p>
		</td>
	
		<td class="input-wrap">
			<input type="text" class="input" name="input_<?php echo $input_ID; ?>[input_data][placeholder]" value="<?php echo $input_data['placeholder']; ?>" />
		</td>
	</tr>
	
	<tr class="input-data">
		<td class="label">
			<label>Character Limit</label>
			<p>Leave blank for no limit</p>
		</td>
		
		<td class="input-wrap">
			<input type="number" class="input" name="input_<?php echo $input_ID; ?>[input_data][maxlength]" value="<?php echo $input_data['limit']; ?>" />
		</td>
	</tr>
	
	<?php
	die();
	
}

add_action('wp_ajax_text_admin_markup', 'text_admin_markup');
