<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 25/01/2019
 * Time: 22:48
 */ ?>

<div class="hero hero--content">
	
	<div class="hero__background">
		
		<img class="hero__background__image" src="<?php echo get_template_directory_uri() . '/images/hero-home-bg.svg'; ?>"/>
	
	</div>
	
	<div class="hero__inner">
		
		<div class="hero__cta">
			
			<div class="hero__cta__content">
				
				<h1 class="hero__title title title__primary"><?php echo $hero[ 'title' ]; ?></h1>
				
				<div class="hero__text">
					<p><?php echo $hero[ 'sub-title' ]; ?></p>
				</div>
				
				<?php if ( ! empty( $hero[ 'link' ][ 'link_url' ] ) ) { ?>
					
					<a class="hero__link button button--large button--white" href="<?php echo $hero[ 'link' ][ 'link_url' ]; ?>"><?php echo $hero[ 'link' ][ 'link_text' ]; ?></a>
				
				<?php } ?>
			
			</div>
			
			<div class="hero__cta__image">
				<img src="<?php echo $hero[ 'image' ]; ?>"/>
			</div>
		
		</div>
	
	</div>

</div>
