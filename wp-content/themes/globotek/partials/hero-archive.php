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
					
					<h1 class="hero__title title title__primary">
						<span class="hero__title--category">Category</span>
						<?php single_cat_title(); ?>
					</h1>
				
				<?php } elseif ( is_date() ) { ?>
					
					<p class="title title__secondary">Articles from</p>
					<h1 class="hero__title title title__primary"><?php the_date( 'F Y' ); ?></h1>
				
				<?php } elseif ( is_home() ) { ?>
					
					<h1 class="hero__title title title__primary"><?php echo single_post_title(); ?></h1>
				
				<?php } ?>
			
			</div>
			
			<div class="hero__cta__image">
				
				<?php if ( is_home() ) { ?>
					
					<?php echo get_the_post_thumbnail( get_option( 'page_for_posts' ) ); ?>
				
				<?php } elseif ( is_category() || is_date() ) { ?>
					
					<img src="<?php echo get_template_directory_uri() . '/images/people-and-books.png'; ?>"/>
				
				<?php } ?>
			
			</div>
		
		</div>
	
	</div>

</div>
