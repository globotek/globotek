<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 25/7/17
 * Time: 11:44 PM
 */
?>

<div class="search <?php echo $data['class']; ?>" data-module="chumly-search" data-object_id="<?php echo $data[ 'object_id' ]; ?>" data-output="<?php echo $data[ 'output' ]; ?>">
	
	<form class="search__form">
		
		<input type="text" class="search__form__input search_text" placeholder="<?php echo $data['placeholder']; ?>"/>
		
		<?php if ( $data[ 'submit_button' ] ) { ?>
			
			<button class="button button--positive search__form__submit" type="submit"><?php echo chumly_icon( 'angle-right' ); ?></button>
		
		<?php } ?>
		
		<div class="search__results">
			<!-- RESULTS FROM A RECIPIENT SEARCH INJECTED HERE -->
		</div>
	
	</form>

	<div class="search__output button-group button-group--narrow"></div>
		
	<div class="search__mask"></div>

</div>
