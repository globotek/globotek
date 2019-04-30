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
	
	<img src="<?php echo get_template_directory_uri() . '/images/portfolio-item-bg-' . $content_background_decider . '.svg'; ?>" alt="" class="project-card__bg">
	
	<div class="project-card__inner">
		
		
		<div class="project-card__inner__title">
			
			<h2 class="title title__secondary"><?php the_title(); ?></h2>
			<div class="project-card__inner__title__tags tag-list tag-list--white">
				
				<?php $project_services = get_field( 'provided_services_content' ); ?>
				
				<?php if ( $project_services ) { ?>
					
					<?php foreach ( $project_services as $project_service ) { ?>
						
						<a href="<?php echo $project_service[ 'service_page' ]; ?>"><?php echo get_the_title( url_to_postid( $project_service[ 'service_page' ] ) ); ?></a>
						<span>|</span>
					
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

