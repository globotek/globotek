<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 3/5/19
 * Time: 6:51 PM
 */ ?>

<div class="wrapper">
	
	<div class="gallery gallery__packery" data-module="gallery">
		
<!--		<div class="gallery__packery--sizer"></div>-->
<!--		<div class="gallery__packery--gutter"></div>-->
		
		
		<?php foreach($component['images'] as $image){ ?>
		
			<img class="gallery__item" src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>" />
			
		<?php } ?>
		
	</div>
	
</div>
