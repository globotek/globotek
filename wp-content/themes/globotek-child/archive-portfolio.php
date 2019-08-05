<?php
/**
 * Template Name: Portfolio Archive
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 18/02/2019
 * Time: 19:43
 */ ?>

<?php get_header(); ?>

<?php if ( is_tax() ) { ?>
	
	<?php gtek_hero( 'hero-archive' ); ?>

<?php } else { ?>
	
	<?php gtek_hero(); ?>

<?php } ?>

<div class="archive-page wrapper">
	
	<div class="archive-page__filter filter">
		
		<h3 class="filter__title">Project Filter</h3>
		
		<div class="filter__buttons" data-module="search" data-target=".archive-page__posts">
			
			<a href="#0"
			   class="filter__buttons__item button"
			   data-post_type="portfolio"
			   data-taxonomy="site-type"
			   data-term="0"
			   data-post_limit="4" ,
			   data-action="search">
				All
			</a>
			
			<?php $project_categories = get_terms( array( 'taxonomy' => 'site-type' ) ); ?>
			
			<?php foreach ( $project_categories as $project_category ) { ?>
				
				<a href="#<?php echo $project_category->term_id; ?>"
				   class="filter__buttons__item button"
				   data-post_type="portfolio"
				   data-taxonomy="site-type"
				   data-term="<?php echo $project_category->term_id; ?>"
				   data-post_limit="4" ,
				   data-action="search">
					<?php echo $project_category->name; ?>
				</a>
			
			<?php } ?>
		
		</div>
	
	</div>

	<div class="archive-page__posts">
		
		<?php $query_args = array(
			'post_type' => 'portfolio'
		);
		
		if ( is_tax() ) {
			
			$query_args[ 'tax_query' ] = array(
				'relation' => 'OR',
				array(
					'taxonomy' => 'site-type',
					'field'    => 'term_id',
					'terms'    => get_queried_object_id()
				),
				array(
					'taxonomy' => 'services',
					'field'    => 'term_id',
					'terms'    => get_queried_object_id()
				)
			);
			
		}
		
		$query = new WP_Query( $query_args );
		
		while ( $query->have_posts() ) : $query->the_post(); ?>
			
			<?php include( 'partials/project-box.php' ); ?>
		
		<?php endwhile; ?>
	
	
	</div>

</div>

<?php get_footer(); ?>
