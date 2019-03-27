<?php global $chumly; ?>

<form class="editor post">
	
	<textarea id="status_content" name="editor" class="editor__input" placeholder="Add your message"></textarea>
	
	<?php //chumly_edit_avatar_field(); ?>
	
	<div class="editor__buttons">
		<div class="editor__icon-buttons">
			<div class="editor__icon-buttons__inner">
				<!-- ICON BUTTON ITEM -->
				<label class="editor__icon-button" for="post_editor_image">
					<div class="editor__icon-button__inner">
						<div class="editor__icon-button__icon">
							<?php chumly_icon( 'image' ); ?>
						</div>
      
						<div class="editor__icon-button__text">Add Media</div>
						
						<input class="editor__icon-button__input post" id="<?php echo $data['id']; ?>" data-media_classification="<?php echo $data['media_classification']; ?>" name="editor_image" type="file" data-upload="true"/>
					
					
					</div>
				</label>
				<!-- ICON BUTTON ITEM -->
				
				<?php if ( function_exists( 'chumly_gallery' ) ) { ?>
					
					<!-- ICON BUTTON ITEM -->
					<label class="editor__icon-button" for="editor_other">
						<div class="editor__icon-button__inner">
							<div class="editor__icon-button__icon">
								<?php chumly_icon( 'layers' ); ?>
							</div>
							<div class="editor__icon-button__text">Create Gallery</div>
							<input class="editor__icon-button__input" id="editor_other" type="file" accept="jpg,png"/>
						</div>
					</label>
					<!-- ICON BUTTON ITEM -->
				
				<?php } ?>
			
			</div>
		</div>
		
		<!-- HIDDEN INPUTS FOR DATA -->
		<?php foreach ( $data as $data_key => $data_value ) { ?>
			
			<input type="hidden" name="<?php echo $data_key; ?>" id="<?php echo $data_key; ?>" value="<?php echo $data_value; ?>"/>
		
		<?php } ?>
		<!-- HIDDEN INPUTS FOR DATA -->
		
		<div class="editor__post-buttons">
			
			<!-- USING BUTTON GROUP AGAIN FOR SCALABILITY -->
			<div class="button-group button-group--right">
				<div class="button-group__item">
					<button id="status_submit" class="button button--positive" disabled="disabled">Post Message</button>
				</div>
			</div>
		</div>
		
		<span class="editor__feedback">
				
				<!-- FILE UPLOAD PREVIEW AREA -->
				
				<span class="upload__preview"></span>
				<span class="hidden_upload_fields"></span>
				
				<!-- FILE UPLOAD PREVIEW AREA -->
								
				<div class="ajax_response"></div>
			
			</span>
	
	</div>
</form>
