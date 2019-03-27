<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 8/2/18
 * Time: 8:46 PM
 */
?>

<div id="<?php echo $data[ 'modal_id' ]; ?>" class="modal" data-modal_template="<?php echo $data[ 'modal_template' ]; ?>" style="visibility: hidden">

<!--	<div class="modal__loader">-->
		
		<?php //chumly_icon( 'loader-bars', NULL, 'active' ); ?>
		
	
<!--	</div>-->
	
	<form class="modal__inner">

	<div class="modal__mask chumly-modal__trigger"></div>
		
		<div class="modal__footer">
			
			<div class="button-group button-group--right">
				
				<div class="button-group__item">
					
					<a href="#edit-profile-picture" class="button button--neutral chumly-modal__trigger">Close</a>
					<input type="submit" class="button button--positive <?php echo $data[ 'modal_id' ]; ?>" value="<?php echo $data[ 'submit_label' ]; ?>"/>
				
				</div>
			
			</div>
		
		</div>
	
	</form>

</div>
