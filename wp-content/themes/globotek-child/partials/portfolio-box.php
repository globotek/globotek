<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 09/02/2019
 * Time: 21:06
 */ ?>

<div class="portfolio-box">
	
	<div class="portfolio-box__inner">
		
		<div class="portfolio-box__inner__body">
			
			<a href="<?php echo get_the_permalink(); ?>" class="portfolio-box__inner__body__image">
				<?php the_post_thumbnail( 'card-thumbnail' ); ?>
			</a>
			
			<div class="portfolio-box__inner__body__content">
				
				<h3 class="title title__quaternary">
					<a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
				
				<div class="portfolio-box__inner__body__tags tag-list">
					
					<?php $provided_services = get_field( 'provided_services_content' ); ?>
					
					<?php if ( $provided_services ) { ?>
						
						<?php $service_pages = wp_list_pluck( $provided_services, 'service_page' ); ?>
						
						<?php foreach ( $service_pages as $service_page ) { ?>
							
							<?php if ( $service_page ) { ?>
								
								<a href="<?php echo get_the_permalink( $service_page->ID ); ?>"><?php echo $service_page->post_title; ?></a>
								<span>|</span>
							
							<?php } ?>
						
						<?php } ?>
					
					<?php } ?>
				
				</div>
				
				<p class="portfolio-box__inner__body__content__text"><?php echo get_the_excerpt(); ?></p>
			
			</div>
		
		</div>
	
	</div>

</div>
