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
			
			<a href="<?php the_permalink(); ?>" class="portfolio-box__inner__body__image">
				<?php the_post_thumbnail( 'large' ); ?>
			</a>
			
			<div class="portfolio-box__inner__body__content">
				
				<h3 class="title title__quaternary"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				
				<div class="portfolio-box__inner__body__tags tag-list">
					
					<?php $provided_services = get_field( 'provided_services_content' ); ?>
					
					<?php if ( $provided_services ) { ?>
						
						<?php $project_services = wp_list_pluck( $provided_services, 'service' ); ?>
						
						<?php foreach ( $project_services as $project_service ) { ?>
							
							<?php $service_page = get_posts( array(
								'post_type' => 'page',
								'tax_query' => array(
									array(
										'taxonomy' => 'services',
										'field'    => 'ID',
										'terms'    => $project_service[ 0 ]->term_id
									)
								)
							) )[ 0 ]; ?>
							
							<a href="<?php echo get_the_permalink( $service_page->ID ); ?>"><?php echo $project_service[ 0 ]->name; ?></a>
							<span>|</span>
						
						<?php } ?>
					
					<?php } ?>
				
				</div>
				
				<p class="portfolio-box__inner__body__content__text"><?php echo get_the_excerpt(); ?></p>
			
			</div>
		
		</div>
	
	</div>

</div>
