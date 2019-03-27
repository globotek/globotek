<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 09/02/2019
 * Time: 17:59
 */

$boxes = array( 1, 2, 3, 4, 5, 6); ?>

<div class="box-grid">
	
	<?php $box_count = count( $boxes ); ?>
	<?php foreach( $boxes as $box ) { ?>
		
		<?php switch( $box_count ) {
			
			case ($box_count == 2 ? $box_count : !$box_count):
				
				$box_size = 'half';
				break;
			
			case ($box_count % 4 == 0 ? $box_count : !$box_count):
				
				$box_size = 'halves';
				break;
			
			case ($box_count % 6 == 0 ? $box_count : !$box_count ):
				
				$box_size = 'thirds';
				break;
			
		} ?>
		
		<div class="box-grid__item box-grid__item--<?php echo $box_size; ?>">
			
			<?php include('box.php'); ?>
			
		</div>
		
	<?php } ?>

</div>