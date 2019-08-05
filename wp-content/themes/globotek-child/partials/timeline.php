<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 9/5/19
 * Time: 7:22 PM
 */ ?>

<div class="wrapper">
	
	<?php foreach ( $component[ 'steps' ] as $step ) { ?>
				
		<div class="timeline">
			
			<div class="timeline__step">
				
				<div class="timeline__step__image">
					
					<img src="<?php echo $step[ 'image' ][ 'url' ]; ?>" alt="<?php echo $step[ 'image' ][ 'title' ]; ?>"/>
				
				</div>
				
				<div class="timeline__step__content">
					
					<h3 class="title__secondary"><?php echo $step[ 'title' ]; ?></h3>
					<p class="timeline__step__content__text"><?php echo $step[ 'content' ]; ?></p>
				
				</div>
			
			</div>
			
			<?php if ( ! empty( $step[ 'step_duration' ] ) ) { ?>
				
				<div class="timeline__line breathe--bottom">
					
					<div class="timeline__line__background">
						
						<img src="<?php echo get_stylesheet_directory_uri() . '/images/timeline-line.svg'; ?>"/>
						
						<p class="timeline__line__time"><?php echo $step[ 'step_duration' ]; ?></p>
					
					</div>
				
				</div>
			
			<?php } ?>
		
		</div>
	
	<?php } ?>

</div>
	