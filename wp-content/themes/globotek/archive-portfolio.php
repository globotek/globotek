<?php
/**
 * Template Name: Portfolio Archive
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 18/02/2019
 * Time: 19:43
 */ ?>

<?php get_header(); ?>

<div class="archive-page wrapper">
	
	<div class="archive-page__filter filter">
		
		<h3 class="filter__title">Project Filter</h3>
		<div class="filter__buttons">
			
			<?php $project_categories = array('Ecommerce', 'Elearning', 'Blog', 'Brochure'); ?>
			
			<?php foreach($project_categories as $project_category){ ?>
			
				<a href="#" class="filter__buttons__item button"><?php echo $project_category; ?></a>
				
			<?php } ?>
			
		</div>
		
	</div>
	
	<div class="archive-page__posts">
		
		<?php $query = new WP_Query( array(
			'post_type' => 'portfolio'
		) );
		
		while( have_posts() ) : the_post(); ?>
			
			<?php $content_background_decider = rand(1, 3); ?>
		
			<div class="project-card">
				
				<?php the_post_thumbnail( 'full', array( 'class' => 'project-card__image' ) ); ?>
				
				<img src="<?php echo get_template_directory_uri() . '/images/portfolio-item-bg-' . $content_background_decider . '.png'; ?>" alt="" class="project-card__bg">
				
				<div class="project-card__inner">
					
					
					<div class="project-card__inner__title">
						
						<h2 class="title title__secondary"><?php the_title(); ?></h2>
						<div class="project-card__inner__title__tags tag-list tag-list--white">
							
							<?php $project_tags = array('Logo Design', 'Web Design', 'Print Design'); ?>
							
							<?php foreach($project_tags as $project_tag){ ?>
								
								<a href="#"><?php echo $project_tag; ?></a>
								<span>|</span>
								
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
		
		<?php endwhile; ?>
	
		
		
	</div>

</div>

<?php get_footer(); ?>
