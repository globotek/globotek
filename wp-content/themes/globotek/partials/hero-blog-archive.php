<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 25/01/2019
 * Time: 22:48
 */ ?>

<div class="hero">
	
	<div class="hero__background">
		
		<img class="hero__background__image" src="<?php echo get_template_directory_uri() . '/images/hero-home-bg.svg'; ?>"/>
	
	</div>
	
	<div class="hero__inner">
		
		<div class="hero__cta">
			
			<div class="hero__cta__content">
				
				<h1 class="hero__title title title__primary"><?php the_title(); ?></h1>
			
			</div>
			
			<div class="hero__cta__image">
				<img src="<?php the_post_thumbnail(); ?>"/>
			</div>
		
		</div>
	
	</div>

</div>
