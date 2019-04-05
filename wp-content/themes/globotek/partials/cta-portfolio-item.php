<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 09/02/2019
 * Time: 21:06
 */ ?>

<div class="cta">
	    
    <div class="cta__background">
		<img src="<?php echo get_template_directory_uri() . '/images/cta-bg-large.svg'; ?>"/>
	</div>
	
	<div class="cta__inner">
		
		<div class="cta__portfolio-item">
			
			<div class="cta__title">
				<h2 class="title title__secondary">Recent Work</h2>
				<p class="section-title__intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus. Donec maximus mauris vel interdum pharetra.</p>
			</div>
			
			<?php include( 'partials/portfolio-item.php' ); ?>	
		
		</div>
		
		<div class="cta__portfolio-item__link">
			<a href="#" class="button">View Portfolio</a>
		</div>
	
	</div>

</div>
