<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 09/02/2019
 * Time: 19:28
 */

$cards = array( 1, 2, 3 ); ?>

<div class="card-grid">
	
	<?php foreach( $cards as $card ) { ?>
		
		<div class="card-grid__item">
			
			<?php include( 'card.php' ); ?>
		
		</div>
	
	<?php } ?>
	
	<div class="card-grid__link">
		<a href="#" class="button">More Articles</a>
	</div>

</div>
