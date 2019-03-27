<?php
function avatar_admin_markup(){
	
	$input_ID = str_replace('item_', NULL, $_REQUEST['row_id']);
	$input_data = chumly_unserialize($_REQUEST['input_data']);
	
	if(empty($input_data['crop_enabled'])){
		$input_data['crop_enabled'] = 0;
	}
	?>
	
	<tr class="field-type-anchor"></tr>

	<tr class="input-data">
		<td class="label"><label>Enable Image Cropping?</label></td>
		
		<td class="input-wrap">
			<ul class="radio horizontal">
				<li>
					<label>
						<input type="radio" name="input_<?php echo $input_ID; ?>[input_data][crop_enabled]" value="1" <?php checked($input_data['crop_enabled'], '1'); ?> />
						Yes
					</label>
				</li>
				
				<li>
					<label>
						<input id="" type="radio" name="input_<?php echo $input_ID; ?>[input_data][crop_enabled]" value="0" <?php checked($input_data['crop_enabled'], '0'); ?> />
						No
					</label>
				</li>
			</ul>
		</td>
	</tr>
	
	<tr class="input-data">
		<td class="label"><label>Media Classification</label></td>
		
		<td class="input-wrap">
			<input type="text" class="input" name="input_<?php echo $input_ID; ?>[input_data][media_classification]" value="<?php echo $input_data['media_classification']; ?>" />
		</td>
	</tr>
	
	<?php
	die();
	
}

add_action('wp_ajax_avatar_admin_markup', 'avatar_admin_markup');
