<?php // Template Name: Cropper 
get_header(); ?>
<?php
// CSS Classes
$form_element_class = 'form';
$form_element_wrapper_class = 'form__group';
$form_element_media_wrapper = 'form__media';
$form_element_media_image = 'form__media__image';
$form_element_media_content = 'form__media__content';
$form_element_file_class = 'form__file';
$form_element_label_class = 'form__label';
$form_element_input_class = 'form__field';
$form_element_input_textbox_modifier = 'form__field--multiline';
$form_element_input_error_class = 'is-error';
?>
	<?php
	echo '
	<form method="post" enctype="multipart/form-data">
		<div class="' . $form_element_wrapper_class . '">
			<div class="' . $form_element_media_wrapper . '">
				<div class="' . $form_element_media_image . '">
					<img src="http://lorempixel.com/500/500/people/" alt="" />
				</div>
				<div class="' . $form_element_media_content . '">
					<label class="' . $form_element_label_class . '">Profile Image</label>
					<p>Choose an image as your profile image. (jpg, jpeg, png only)</p>
	
					<div class="' . $form_element_file_class . '">
						<label class="button" name="profile_image">
							Choose File
							<input type="file" name="profile_image" id="profile_image" />
						</label>
					</div>
				</div>
			</div>
		</div>
	</form>
	';
	?>

	<form method="post" enctype="multipart/form-data">
		<input type='file' id="image_upload" accept="image/*" />
		<div class="media__image" style="display:none;">
			<img id="uploaded_image" src="#" class="form__media__image"/>
		</div>	
		<button id="avatar_save" class="button">Save</button>
	</form>
	
	<div id="saved_message"></div>
	<div id="saved_response"></div>
	
	<?php $upload_dir = wp_upload_dir(); ?>
	
	<script>
	/** AJAX VARIABLES */
	
	var user_id = '<?php echo esc_attr(get_current_user_id()); ?>';
	
	/** AJAX VARIABLES */
	</script>
	
	<script>
	jQuery(document).ready(function($){
		function readURL(input) {
		
			if (input.files && input.files[0]) {
				var reader = new FileReader();
		
				reader.onload = function (e) {
					$('#uploaded_image').attr('src', e.target.result);
				}
		
				reader.readAsDataURL(input.files[0]);
			}
		}
		
		$("#image_upload").on('change', function(){
			$('.media__image').css('display', 'block');
			readURL(this);
		});	
	});
	</script>
	
<div id="ajax_response"></div>
<style>
.form__media__image{
	height:130px;
	width:130px;
	overflow:hidden;
}

.form__media__image,
.jcrop-holder{
	border-radius:10px;
}
</style>
<?php get_footer(); ?>