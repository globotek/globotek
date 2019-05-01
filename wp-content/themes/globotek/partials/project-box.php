<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 25/4/19
 * Time: 8:55 PM
 */

$content_background_decider = rand( 1, 3 ); ?>

<div class="project-card">
	
	<a href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail( 'full', array( 'class' => 'project-card__image' ) ); ?>
	</a>
	
	<div class="project-card__body">
		
		<img class="project-card__bg" src="<?php echo get_template_directory_uri() . '/images/portfolio-item-bg-' . $content_background_decider . '.svg'; ?>" alt="">
		
		<div class="project-card__inner">
			
			
			<div class="project-card__inner__title">
				
				<h2 class="title title__secondary"><?php the_title(); ?></h2>
				<div class="project-card__inner__title__tags tag-list tag-list--white">
					
					<?php $provided_services = get_field( 'provided_services_content' ); ?>
					
					<?php if ( $provided_services ) { ?>
						
						<?php $service_pages = wp_list_pluck( $provided_services, 'service_page' ); ?>
						
						<?php shuffle($service_pages); ?>
						<?php $count = 0; ?>
						
						<?php foreach ( $service_pages as $service_page ) { ?>
							
							<?php if ( $service_page ) { ?>
								
								<a href="<?php echo get_the_permalink( $service_page->ID ); ?>"><?php echo $service_page->post_title; ?></a>
								<span>|</span>
							
							<?php } ?>
						
							<?php $count++; ?>
							
						<?php } ?>
					
					<?php } ?>
				
				</div>
			
			</div>
			
			<div class="project-card__inner__content">
				<?php the_excerpt(); ?>
			</div>
			
			<div class="project-card__inner__link">
				<a href="<?php the_permalink(); ?>" class="button button--white">View</a>
			</div>
		
		</div>
	
	</div>

</div>

