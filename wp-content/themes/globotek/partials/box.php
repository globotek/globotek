<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 09/02/2019
 * Time: 18:05
 */ ?>

<div class="box">
	
	<?php if ( ! empty( $box[ 'icon' ] ) ) { ?>
		
		<div class="box__icon">
			
			<?php icon( $box[ 'icon' ] ); ?>
		
		</div>
	
	<?php } ?>
	
	<h3 class="box__heading heading__tertiary"><?php echo $box[ 'title' ]; ?></h3>
	<div class="box__text"><?php echo $box[ 'content' ]; ?></div>

</div>
