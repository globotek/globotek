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
				
				<?php if ( is_category() ) { ?>
					
					<p class="title title__secondary">Category</p>
					<h1 class="hero__title title title__primary"><?php single_cat_title(); ?></h1>
				
				<?php } elseif(is_date()) { ?>
					
					<p class="title title__secondary">Articles from</p>
					<h1 class="hero__title title title__primary"><?php the_date('F Y'); ?></h1>
					
					<?php } else { ?>
					
					<h1 class="hero__title title title__primary"><?php the_title(); ?></h1>
				
				<?php } ?>
			
			</div>
			
			<div class="hero__cta__image">
				
				<?php if ( is_category() || is_date() ) { ?>
					
					<img src="<?php echo get_template_directory_uri() . '/images/people-and-books.png'; ?>"/>
					
				<?php } else { ?>
					
					<?php the_post_thumbnail(); ?>
				
				<?php } ?>
			
			</div>
		
		</div>
	
	</div>

</div>
