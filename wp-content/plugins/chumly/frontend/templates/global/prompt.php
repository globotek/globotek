<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 16/10/18
 * Time: 9:13 PM
 */
?>

<div id="alert-modal" class="modal" style="visibility: hidden">
	
	<div class="modal__loader">
		
		<?php chumly_icon( 'loader-bars', NULL, 'active' ); ?>

</div>

<form class="modal__inner">
	
	<div class="modal__footer">
		
		<div class="button-group button-group--right">
			
			<div class="button-group__item">
				
				<a href="#edit-profile-picture" class="button button--neutral chumly-modal__trigger">Close</a>
				<input type="submit" class="button button--positive <?php echo $data[ 'modal_id' ]; ?>" value="<?php echo $data[ 'submit_label' ]; ?>"/>
			
			</div>
		
		</div>
	
	</div>

</form>

<div class="modal__mask chumly-modal__trigger"></div>

</div>
