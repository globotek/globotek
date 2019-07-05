<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 9/5/19
 * Time: 4:22 PM
 */ ?>

<div class="hero hero--content">
	
	<div class="hero__background">
		
		<img class="hero__background__image" src="<?php echo get_template_directory_uri() . '/images/hero-home-bg.svg'; ?>"  alt="Hero Section Background" />
	
	</div>
	
	<div class="hero__inner">
		
		<div class="hero__cta">
			
			<div class="hero__cta__content">
				
				<h1 class="hero__title title title__primary">
					
					<?php the_title(); ?>
					
				</h1>
			
			</div>
			
			<div class="hero__cta__image">
				
				<?php the_post_thumbnail(); ?>
			
			</div>
		
		</div>
	
	</div>

</div>
