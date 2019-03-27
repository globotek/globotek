<?php
function link_admin_markup(){
	
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
			<label>URL to link to</label>
		</td>

		<td class="input-wrap">
			<input type="url" class="input" name="row_<?php /*echo $i; */?>[input_data][url_link]" value="<?php /*echo $input_data['url_link']; */?>" />
		</td>
	</tr>
-->
	<tr class="input-data">
		<td class="label">
			<label>Link Title</label>
			<p>This is what the user will see to click.</p>
			<p>Leave blank to output the raw URL.</p>
		</td>

		<td class="input-wrap">
			<input type="url" class="input" name="input_<?php echo $input_ID; ?>[input_data][link_title]" value="<?php echo $input_data['link_title']; ?>" />
		</td>
	</tr>

	<tr class="input-data">
		<td class="label">
			<label>Link Target</label>
		</td>

		<td class="input-wrap">
			<select class="input" name="input_<?php echo $input_ID; ?>[input_data][link_target]">
				<option value="_self" <?php selected($input_data['link_target']); ?>>Same tab</option>
				<option value="_blank" <?php selected($input_data['link_target']); ?>>New Tab</option>
			</select>
		</td>
	</tr>

	<tr class="input-data">
		<td class="label">
			<label>Link Image</label>
			<p>Have a visual representation of the link such as an icon.</p>
			<p><i>Go to media library and open an image to find its URL.</i></p>
		</td>

		<td class="input-wrap">
			<input type="url" class="input" name="input_<?php echo $input_ID; ?>[input_data][link_image]" value="<?php echo $input_data['link_image']; ?>" />
		</td>
	</tr>

	<?php
	die();
}

add_action('wp_ajax_link_admin_markup', 'link_admin_markup');
