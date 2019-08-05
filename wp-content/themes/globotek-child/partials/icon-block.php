<?php
/**
 * Created by PhpStorm.
 * User: globotek
 * Date: 02/02/2019
 * Time: 14:58
 */ ?>

<div class="page__icon-blocks wrapper">
	
	<?php $block_count = count($component['icons']); ?>

	<?php foreach ( $component[ 'icons' ] as $icon_block ) { ?>

		<div class="icon-block <?php _e($block_count == 3 ? 'icon-block--thirds' : '' ); ?>">
			
			<div class="icon-block__icon">
				<?php icon($icon_block['icon']); ?>
			</div>
			
			<div class="icon-block__content">
				
				<h3 class="title title__quaternary"><?php echo $icon_block['title']; ?></h3>
				<p><?php echo $icon_block['content']; ?></p>
			
			</div>
		
		</div>
	
	<?php } ?>

</div>
