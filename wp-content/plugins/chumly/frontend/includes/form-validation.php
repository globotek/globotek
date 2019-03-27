<?php 
function chumly_validate_form(){
	echo '<br>chumly_validate_form()';
	$form_element_wrapper_class = 'form__group';
	
	echo '<div class="' . $form_element_wrapper_class . '">';
		if(empty($input->input_label)){
			echo '<span class="form__error-message">Please enter your ' . lcfirst($input->input_label) . '</span>';
		}
	echo '</div>';
	?>

	<script>
	jQuery(document).ready(function($){
		$('input').each(function(index,element){
			if($(this).attr('type') != 'submit' && $(this).val() == ''){
				$(this).css('border', '1px solid blue');
			}
		});
	});
	</script>

	<?php
}