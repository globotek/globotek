<?php
function wysiwyg_admin_markup(){ ?>
	
	<tr class="field-type-anchor"></tr>
	
	<tr class="input-data wysiwyg">
		<td class="label">
			<label>WYSIWYG Editor</label>
			<p>Go crazy</p>
		</td>
	
		<td>
			<textarea id="" class="input-wrap" rows="10"></textarea>
		</td>
	</tr>

<!--	<script>
	var row_id = '<?php /*echo '#' . $_REQUEST['row_id']; */?>',
		total_height = 0;
				
	jQuery(row_id + ' tr.input-data').each(function(){
		total_height += jQuery(this).outerHeight();
	});
	
	var start_height = 459,
		element_height = total_height,
		new_height = start_height + element_height;
	
	jQuery(row_id + ' .row-content').css('height', new_height);
	</script>
-->
	<?php
	die();
}

add_action('wp_ajax_wysiwyg_admin_markup', 'wysiwyg_admin_markup');
