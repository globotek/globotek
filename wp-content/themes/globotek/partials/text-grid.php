<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 09/02/2019
 * Time: 19:28
 */ ?>

<div class="text-grid">
	
	<?php foreach( $text_grid as $item ) { ?>
		
		<div class="text-grid__item">
			
            <div class="text-grid__body">
		
		        <h3 class="text-grid__body__heading heading heading__tertiary"><?php echo $item['title']; ?></h3>
		
                <div class="text-grid__body__text">
                    <p><?php echo $item['content']; ?></p>
                </div>
            
            </div>
		
		</div>
	
	<?php } ?>

</div>
