<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/6/19
 * Time: 12:23 PM
 */
?>

<div class="card">
	
	<?php if ( ! empty( $card[ 'logo' ] ) ) { ?>
		
		<div class="card__image">
			
			<img src="<?php echo $card[ 'logo' ][ 'url' ]; ?>" alt="<?php $card[ 'logo' ][ 'alt' ]; ?>"/>
		
		</div>
	
	<?php } ?>
	
	<?php if ( ! empty( $card[ 'title' ] ) ) { ?>
		
		<div class="card__body">
			
			<h3 class="card__heading heading__tertiary"><?php echo $card[ 'title' ]; ?></h3>
			
			<p class="card__text"><?php echo $card[ 'content' ]; ?></p>
			
			<?php if ( ! empty( $card[ 'link_title' ] ) ) { ?>
				
				<div class="card__body__link">
					<a href="<?php $card[ 'link_url' ]; ?>" class="button__text button__text--blue"><?php echo $card[ 'link_title' ]; ?></a>
				</div>
			
			<?php } ?>
		
		</div>
	
	<?php } ?>

</div>
