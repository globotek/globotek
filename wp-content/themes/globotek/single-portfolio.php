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

<?php //var_dump( $fields[ 'full_width_banner' ] ); ?>

<?php if ( $fields[ 'provided_services_content' ] ) { ?>
	
	<?php $service_tags = wp_list_pluck( $fields[ 'provided_services_content' ], 'service' ); ?>

<?php } ?>

<?php $project_info = $fields[ 'provided_services_content' ]; ?>


<div class="portfolio-item">
	
	<div class="wave-hero">
		
		<?php the_post_thumbnail( 'full' ); ?>
		
		<div class="wave-hero__body">
			
			<img src="<?php echo get_template_directory_uri() . '/images/bg-project-hero.svg'; ?>"/>
			
			<div class="wave-hero__inner">
				
				<h1 class="wave-hero__title title title__secondary"><?php the_title(); ?></h1>
				
				<div class="wave-hero__content">
					
					<h2 class="wave-hero__content__heading">Scope</h2>
					
					<div class="wave-hero__content__tags tag-list">
						
						<?php $project_tags = array( 'Logo Design', 'Web Design', 'Print Design' ); ?>
						
						<?php foreach ( $service_tags as $project_tag ) { ?>
							
							<a href="<?php echo get_term_link( $project_tag[ 0 ] ); ?>"><?php echo $project_tag[ 0 ]->name; ?></a>
							<span>|</span>
						
						<?php } ?>
					
					</div>
					
					<div class="wave-hero__content__text"><?php the_content(); ?></div>
					
					<div class="wave-hero__content__services">
						
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
					<img src="<?php echo $fields[ 'full_width_banner' ][ 'image' ][ 'url' ]; ?>"/>
				</div>
				
				<div class="circle-image__content">
					
					<h2 class="title title__secondary circle-image__content__title"><?php echo $fields[ 'full_width_banner' ][ 'title' ]; ?></h2>
					
					<p class="circle-image__content__text"><?php echo $fields[ 'full_width_banner' ][ 'content' ]; ?></p>
				
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
				
				<img class="cta__inner__image" src="<?php echo $fields[ 'banner_image' ][ 'url' ]; ?>"/>
			
			</div>
		
		</div>
	
	</div>
	
	<div class="section-title breathe--bottom-double">
		<h2 class="title__secondary">Key Features</h2>
	</div>
	
	<div class="wrapper breathe--bottom-double">
		<div class="breathe--bottom-double">
			<?php $text_grid = $fields[ 'triple_column_content' ]; ?>
			<?php include( 'partials/text-grid.php' ); ?>
		</div>
	</div>
	
	<div class="portfolio-item__contact-form">
		<?php include( 'partials/contact-form.php' ); ?>
	</div>
	
	<div class="portfolio-item__cta">
		<?php include( 'partials/related-work.php' ); ?>
	</div>

</div>

<?php get_footer(); ?>
