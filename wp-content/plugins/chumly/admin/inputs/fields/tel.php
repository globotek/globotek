<?php
function tel_admin_markup(){
	
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
	
<!--	<tr class="input-data">
		<td class="label">
			<label>Country Code</label>
		</td>
		
		<td class="input-wrap">
			<input type="checkbox" name="row_<?php /*echo $i; */?>[input_data][country_code]" <?php /*checked($input_data['country_code'], 'on'); */?> />
		</td>
	</tr>
	
	<tr class="input-data">
		<td class="label">
			<label>Area Code</label>
		</td>
		
		<td class="input-wrap">
			<input type="checkbox" name="row_<?php /*echo $i; */?>[input_data][area_code]" <?php /*checked($input_data['area_code'], 'on'); */?> />
		</td>
	</tr>
	
	<tr class="input-data">
		<td class="label">
			<label>Phone Number</label>
		</td>
		
		<td class="input-wrap">
			<input type="checkbox" name="row_<?php /*echo $i; */?>[input_data][phone_number]" <?php /*checked($input_data['phone_number'], 'on'); */?> />
		</td>
	</tr>
-->
	<?php
	die();
}

add_action('wp_ajax_tel_admin_markup', 'tel_admin_markup');
