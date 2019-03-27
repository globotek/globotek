<?php
function radio_admin_markup(){
	
	$input_ID = str_replace('item_', NULL, $_REQUEST['row_id']);
	$input_data = chumly_unserialize($_REQUEST['input_data']); ?>
	
	<tr class="field-type-anchor"></tr>
	
	<tr class="input-data">
		<td class="label">
			<label>Choices</label>
			<p>Enter each choice on a new line.</p><br>
			<p>For more control, you may specify both a value and label like this:</p><br>
			<p>red : Red</p>
		</td>
		
		<td class="input-wrap">
			<textarea class="input" name="input_<?php echo $input_ID; ?>[input_data][choices]" rows="6"><?php echo $input_data['choices']; ?></textarea>
		</td>
		
	</tr>
	
	<tr class="input-data">
		<td class="label">
			<label>Default Choice</label>
			<p>Copy & paste the choice you want as the default</p>
		</td>
		
		<td class="input-wrap">
			<textarea class="input" name="input_<?php echo $input_ID; ?>[input_data][default_choice]" rows="3"><?php echo $input_data['default_choice']; ?></textarea>
		</td>
		
	</tr>
	
	
	<?php
	die();
}

add_action('wp_ajax_radio_admin_markup', 'radio_admin_markup');

