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

<?php $provided_services = $fields[ 'provided_services_content' ]; ?>

<div class="portfolio-item">

    <div class="hero hero--no-content">

        <div class="hero__image">

            <?php the_post_thumbnail( 'full' ); ?>

        </div>

    </div>
	
	<div class="portfolio-intro">
		
		<div class="portfolio-intro__body">
			
			<img class="portfolio-intro__body__border" src="<?php echo get_template_directory_uri() . '/images/bg-project-hero-top.svg'; ?>"/>
			
			<div class="portfolio-intro__inner">
				
				<h1 class="portfolio-intro__title title title__secondary"><?php the_title(); ?></h1>
				
				<div class="portfolio-intro__content">
					
					<h2 class="portfolio-intro__content__heading">Scope</h2>
					
					<?php if ( ! empty( $provided_services ) ) { ?>
						
						<?php $service_pages = wp_list_pluck( $provided_services, 'service_page' ); ?>
						
						<?php if ( $service_pages[ 0 ] !== FALSE ) { ?>
							
							<div class="portfolio-intro__content__tags tag-list">
								
								<?php foreach ( $service_pages as $service_page ) { ?>
									
									<?php if ( $service_page ) { ?>
										
										<a href="<?php echo get_the_permalink( $service_page->ID ); ?>"><?php echo $service_page->post_title; ?></a>
										<span>|</span>
									
									<?php } ?>
								
								<?php } ?>
							
							</div>
						
						<?php } ?>
					
					<?php } ?>
					
					<div class="portfolio-intro__content__text content"><?php the_content(); ?></div>
					
					<?php if ( ! empty( $provided_services ) ) { ?>
						
						<div class="portfolio-intro__content__services">
							
							<h3 class="">Services Provided</h3>
							
							<ul class="list">
								
								<?php $service_tags = wp_list_pluck( $provided_services, 'service' ); ?>
								
								<?php foreach ( $service_tags as $service_tag ) { ?>
									
									<li class="list__item"><?php echo $service_tag[ 0 ]->name; ?></li>
								
								<?php } ?>
							
							</ul>
						
						</div>
					
					<?php } ?>
				
				</div>
			
			</div>
			
			<img class="portfolio-intro__body__border" src="<?php echo get_template_directory_uri() . '/images/bg-project-hero-bottom.svg'; ?>"/>
		
		</div>
	
	</div>
	
	
	<div class="portfolio-item__wave-grid">
		
		<div class="wave-grid">
			
			<?php foreach ( $provided_services as $info_box ) { ?>
				
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
	
	<?php
	$related_project_terms               = array();
	$related_project_terms[ 'relation' ] = 'OR';
		
	foreach ( get_the_terms(get_the_ID(), 'site-type') as $item ) {
		
		$related_project_terms[] = array(
			'taxonomy' => 'site-type',
			'field'    => 'term_id',
			'terms'    => $item->term_id
		);
		
	}
	
	$query = new WP_Query(
		array(
			'post_type'      => 'portfolio',
			'posts_per_page' => 3,
			'post__not_in'   => array( get_the_ID() ),
			'tax_query'      => $related_project_terms
		)
	); ?>
	
	<?php if ( $query->have_posts() ) : ?>
		
		<div class="section-title">
			<h2 class="title__secondary">Related Work</h2>
			<p class="section-title__intro">Like the look of this site? Here's a few more sites we've built that are similar and we think you might like.</p>
		</div>
		
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			
			<?php include( 'partials/portfolio-box.php' ); ?>
		
		<?php endwhile; ?>
	
	<?php else: ?>
		
		<div class="section-title">
			<h2 class="title__secondary">Recent Work</h2>
			<p class="section-title__intro">Like the look of this site? Here's a few of the most recent sites we've built.</p>
		</div>
		
		<?php $query = new WP_Query(
			array(
				'post_type'      => 'portfolio',
				'posts_per_page' => 3,
				'post__not_in'   => array( $post->ID )
			)
		); ?>
		
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			
			<?php include( 'partials/portfolio-box.php' ); ?>
		
		<?php endwhile; ?>
	
	<?php endif; ?>

</div>

<?php get_footer(); ?>
