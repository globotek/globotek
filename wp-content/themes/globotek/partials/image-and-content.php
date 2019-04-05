<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 02/02/2019
 * Time: 15:32
 */ ?>

<div class="page__cta-rows wrapper">
	
	<?php foreach ( $component[ 'block' ] as $content_row ) { ?>
		
		<div class="image-content">
			
			<div class="image-content__image">
				
				<img src="<?php echo $content_row[ 'image' ]; ?>"/>
			
			</div>
			
			<div class="image-content__content">
				
				<h2 class="image-content__content__title title__secondary"><?php echo $content_row[ 'title' ]; ?></h2>
				
				<p class="image-content__content__text"><?php echo $content_row[ 'content' ]; ?></p>
				
				<div class="image-content__content__link">
					<a href="<?php echo $content_row[ 'link' ][ 'link_url' ]; ?>" class="button"><?php echo $content_row[ 'link' ][ 'link_text' ]; ?></a>
				</div>
			
			</div>
		
		</div>
	
	<?php } ?>

</div>
