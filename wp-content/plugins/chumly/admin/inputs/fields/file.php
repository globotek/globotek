<?php
function file_admin_markup(){
	$input_ID = str_replace('item_', NULL, $_REQUEST['row_id']);
	$input_data = chumly_unserialize($_REQUEST['input_data']);
	?>
	
	<tr class="field-type-anchor"></tr>
	
	
	<?php
	die();
}

add_action('wp_ajax_file_admin_markup', 'file_admin_markup');
