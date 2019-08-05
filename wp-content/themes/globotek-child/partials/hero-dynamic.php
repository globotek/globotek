<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 25/01/2019
 * Time: 22:48
 */ ?>

<div class="hero hero--content">
	
	<div class="hero__background">
		
		<img class="hero__background__image" src="<?php echo get_stylesheet_directory_uri() . '/images/hero-home-bg.svg'; ?>" alt="Hero Section Background"/>
	
	</div>
	
	<div class="hero__inner">
		
		<div class="hero__cta">
			
			<div class="hero__cta__content">
				
				<h1 class="hero__title title title__primary"><?php echo $hero_template[ 'title' ]; ?></h1>
				
				<p class="hero__text"><?php echo $hero_template[ 'content' ]; ?></p>
			
			</div>
			
			<div class="hero__cta__image">
				
				<?php echo wp_get_attachment_image( $hero_template[ 'image_id' ], 'full' ); ?>
			
			</div>
		
		</div>
	
	</div>

</div>
