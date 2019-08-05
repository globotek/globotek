<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 7/6/19
 * Time: 9:57 AM
 */

$logos = array();
foreach($component['logos'] as $logo_row){
	
	foreach($logo_row as $logo){
		
		$logos[] = $logo;
		
	}
	
} ?>

<div class="card-grid">
	
	<?php $box_count = count( $logos ); ?>
	<?php foreach( $logos as $card ) { ?>
		
		<?php switch( $box_count ) {
			
			case ($box_count == 2 ? $box_count : !$box_count):
				
				$box_size = 'half';
				break;
			
			case ($box_count % 4 == 0 ? $box_count : !$box_count):
				
				$box_size = 'halves';
				break;
			
			case ($box_count % 3 == 0 ? $box_count : !$box_count ):
			case ($box_count % 6 == 0 ? $box_count : !$box_count ):
				
				$box_size = 'thirds';
				break;
			
		} ?>
		
		<div class="card-grid__item card-grid__item--<?php echo $box_size; ?> centered">
			
			<?php include('card.php'); ?>
		
		</div>
	
	<?php } ?>

</div>
