<?php
function number_admin_markup(){
	
	$input_ID = str_replace('item_', NULL, $_REQUEST['row_id']);  
	$input_data = chumly_unserialize($_REQUEST['input_data']); ?>

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
			<label>Minimum Number</label>
			<p>Leave blank for 0</p>
		</td>
		
		<td class="input-wrap">
			<input type="number" class="input" name="input_<?php echo $input_ID; ?>[input_data][min]" value="<?php echo $input_data['min']; ?>" />
		</td>
	</tr>
	
	<tr class="input-data">
		<td class="label">
			<label>Maximum Number</label>
			<p>Leave blank for no limit</p>
		</td>
		
		<td class="input-wrap">
			<input type="number" class="input" name="input_<?php echo $input_ID; ?>[input_data][max]" value="<?php echo $input_data['max']; ?>" />
		</td>
	</tr>
	
	<tr class="input-data">
		<td class="label">
			<label>Step Size</label>
			<p>What incremement does the number change by</p>
		</td>
		
		<td class="input-wrap">
			<input type="number" class="input" name="input_<?php echo $input_ID; ?>[input_data][step]" value="<?php echo $input_data['step']; ?>" />
		</td>
	</tr>
	
	<?php
	die();
}

add_action('wp_ajax_number_admin_markup', 'number_admin_markup');
