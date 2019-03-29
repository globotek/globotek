<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 09/02/2019
 * Time: 19:28
 */

$cards = array( 1, 2, 3 ); ?>

<div class="text-grid">
	
	<?php foreach( $cards as $card ) { ?>
		
		<div class="text-grid__item">
			
            <div class="text-grid__body">
		
		        <h3 class="text-grid__body__heading heading heading__tertiary">Lorem ipsum</h3>
		
                <div class="text-grid__body__text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus.</p>
                </div>
            
            </div>
		
		</div>
	
	<?php } ?>

</div>
