<?php global $chumly; ?>

<div class="chunk">
	<form class="editor share" data-module="chumly-upload">
		
		<textarea id="share_content" name="editor" class="editor__input" placeholder="Add your message"></textarea>
				
		<div class="editor__buttons editor__buttons--right">
			
			<div class="editor__icon-buttons">
				<div class="editor__icon-buttons__inner">
					
					<!-- ICON BUTTON ITEM -->
					<label class="editor__icon-button" for="share_editor_image">
						<div class="editor__icon-button__inner">
							<div class="editor__icon-button__icon">
								<svg class="icon" aria-hidden="true">
									<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $chumly->plugin_uri; ?>frontend/images/icons/svg-symbols.svg#image"></use>
								</svg>
							</div>
							<div class="editor__icon-button__text">Add Media</div>
							
							<input class="editor__icon-button__input share" id="share_editor_image" name="editor_image" type="file" data-upload="true"/>
						
						
						</div>
					</label>
					<!-- ICON BUTTON ITEM -->
					
				</div>
			</div>
			
			<!-- HIDDEN INPUTS FOR DATA -->
<!--			<input type="hidden" name="target_id" id="target_id" value="--><?php //echo $post_id; ?><!--"/>-->
			<input type="hidden" name="post_type" id="post_type" value="chumly_shared"/>
			<!-- HIDDEN INPUTS FOR DATA -->
						
			<span class="editor__feedback">
				
				<!-- FILE UPLOAD PREVIEW AREA -->
				
				<span class="upload__preview"></span>
				<span class="hidden_upload_fields"></span>
				
				<!-- FILE UPLOAD PREVIEW AREA -->
				
				
				<div class="ajax_response"></div>
			
			</span>
		
		</div>
	</form>
</div>