<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 25/01/2019
 * Time: 22:48
 */ ?>

<div class="hero hero--content">
	
	<div class="hero__background">
		
		<img class="hero__background__image" src="<?php echo get_template_directory_uri() . '/images/hero-home-bg.svg'; ?>" alt="Hero Section Background"/>
	
	</div>
	
	<div class="hero__inner">
		
		<div class="hero__cta">
			
			<div class="hero__cta__content">
				
				<?php if ( is_category() ) { ?>
					
					<p class="hero__category">Category</p>
					<h1 class="hero__title title title__primary">
						<?php single_cat_title(); ?>
					</h1>
				
				<?php } elseif ( is_tax() ) { ?>
					
					<p class="hero__category">Category</p>
					<h1 class="hero__title title title__primary">
						<?php echo single_cat_title( '', FALSE ) . ' Projects'; ?>
					</h1>
				
				<?php } elseif ( is_date() ) { ?>
					
					<?php
					$archive_date = array(
						'year'  => get_query_var( 'year' ),
						'month' => get_query_var( 'monthnum' )
					);
					
					$query_args[ 'date_query' ] = $archive_date;
					
					$blog_archive_title = $GLOBALS[ 'wp_locale' ]->get_month( $archive_date[ 'month' ] ) . ' ' . $archive_date[ 'year' ]; ?>
					
					<p class="hero__category">Articles from</p>
					<h1 class="hero__title title title__primary">
						<?php echo $blog_archive_title; ?>
					</h1>
				
				<?php } elseif ( is_home() ) { ?>
					
					<h1 class="hero__title title title__primary"><?php echo single_post_title(); ?></h1>
				
				<?php } ?>
			
			</div>
			
			<div class="hero__cta__image">
				
				<?php if ( is_home() ) { ?>
					
					<?php $hero_image = get_field( 'hero', get_option( 'page_for_posts' ) ); ?>
					
					<img src="<?php echo $hero_image[ 'image' ][ 'url' ]; ?>" alt="<?php echo $hero_image[ 'image' ][ 'alt' ]; ?>"/>
				
				<?php } elseif ( is_category() || is_tax() ) { ?>
					
					<?php if ( ! empty( get_term_meta( get_queried_object_id(), 'wpsfi_tax_image_id' ) ) ) { ?>
						
						<?php echo wpsfi_display_image( get_queried_object_id(), 'full' ); ?>
					
					<?php } ?>
				
				<?php } ?>
			
			</div>
		
		</div>
	
	</div>

</div>
