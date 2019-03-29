<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 23/02/2019
 * Time: 13:03
 */

get_header(); ?>
<?php the_post(); ?>
<?php $fields = get_fields(); ?>

<?php var_dump( $fields[ 'provided_services_content' ] ); ?>

<?php $service_tags = wp_list_pluck( $fields[ 'provided_services_content' ], 'service' ); ?>
<?php $project_info = $fields[ 'provided_services_content' ]; ?>


<div class="portfolio-item">
	
	<div class="portfolio-item__hero">
		
		<?php the_post_thumbnail( 'full' ); ?>
		
		<div class="portfolio-item__hero__body">
			
			<img src="<?php echo get_template_directory_uri() . '/images/bg-project-hero.svg'; ?>"/>
			
			<div class="portfolio-item__hero__inner">
				
				<h1 class="portfolio-item__hero__title title title__secondary"><?php the_title(); ?></h1>
				
				<div class="portfolio-item__hero__content">
					
					<h2 class="portfolio-item__hero__content__heading">Scope</h2>
					
					<div class="portfolio-item__hero__content__tags tag-list">
						
						<?php $project_tags = array( 'Logo Design', 'Web Design', 'Print Design' ); ?>
						
						<?php foreach ( $service_tags as $project_tag ) { ?>
							
							<a href="<?php echo get_term_link( $project_tag[ 0 ] ); ?>"><?php echo $project_tag[ 0 ]->name; ?></a>
							<span>|</span>
						
						<?php } ?>
					
					</div>
					
					<div class="portfolio-item__hero__content__text"><?php the_content(); ?></div>
					
					<div class="portfolio-item__hero__content__services">
						
						<h3 class="">Services Provided</h3>
						
						<ul class="list">
							
							<?php foreach ( $service_tags as $service_tag ) { ?>
								
								<li class="list__item"><?php echo $service_tag[ 0 ]->name; ?></li>
							
							<?php } ?>
						
						</ul>
					
					</div>
				
				
				</div>
			
			</div>
		
		</div>
	
	</div>
	
	
	<div class="portfolio-item__wave-grid">
		
		<div class="wave-grid">
			
			<?php foreach ( $project_info as $info_box ) { ?>
				
				<div class="wave-grid__item">
					
					<div class="wave-grid__item__image">
						<img src="<?php echo $info_box[ 'service_image' ][ 'url' ]; ?>"/>
					</div>
					
					<div class="wave-grid__item__body">
						
						<h2 class="wave-grid__item__body__title"><?php echo $info_box[ 'service' ][ 0 ]->name; ?></h2>
						<div class="wave-grid__item__body__text">
							<?php echo $info_box[ 'service_content' ]; ?>
						</div>
					</div>
				
				</div>
			
			<?php } ?>
		
		</div>
	
    </div>
    

    <div class="portfolio-item__circle-image">

        <div class="circle-image">
            <div class="circle-image__inner">

                <div class="circle-image__image">
                    <img src="<?php echo get_template_directory_uri() . '/images/circle-text-img.jpg'; ?>"/>
                </div>

                <div class="circle-image__content">

                    <h2 class="title title__secondary circle-image__content__title">Lorem ipsum dolor sit amet consectet adipiscing elit</h2>

                    <p class="circle-image__content__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Curabitur et vestibulum arcu. Aenean quis orci sem. 
                        Suspendisse iaculis scelerisque purus ornare finibus. 
                        Donec maximus mauris vel interdum pharetra.</p>

                </div>

            </div>
        </div>

    </div>

    <div class="portfolio-item__device-image">

        <div class="cta">
        
            <div class="cta__background">
                <img src="<?php echo get_template_directory_uri() . '/images/row-bg-large.svg'; ?>"/>
            </div>
            
            <div class="cta__inner">
                
                <img class="cta__inner__image" src="<?php echo get_template_directory_uri() . '/images/portfolio-devices.png'; ?>"/>
            
            </div>

        </div>

    </div>

</div>

<?php get_footer(); ?>
