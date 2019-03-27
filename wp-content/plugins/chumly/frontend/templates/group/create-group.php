<?php do_action( 'chumly_before_content' ); ?>
	
	<div class="wrapper chunk">
		
		<!-- FORM STARTS -->
		<?php chumly_form_header(); ?>
		
		<?php (new Chumly_Groups)->create_group(); ?>
		
		<?php chumly_form_footer( 'create_group', 'button button--positive', 'Create' ); ?>
		
		<!-- FORM ENDS -->
		<div id="saved_response">
			Response:
		</div>
		
	</div>

<?php do_action( 'chumly_after_content' ); ?>