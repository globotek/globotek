<?php
/**
 * Template Name: Blog Archive
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 18/02/2019
 * Time: 19:43
 */ ?>

<?php get_header();
the_post(); ?>

<?php include( 'partials/hero-blog-archive.php' ); ?>

<div class="blog-archive wrapper">
	
	<div class="blog-archive__posts">
		
		<?php $query = new WP_Query( array(
			'post_type' => 'post'
		) ); ?>
		
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			
			<div class="blog-card">
				
				<div class="blog-card__image">
					<img src="<?php echo get_template_directory_uri() . '/images/scraptastic-banner-min.png'; ?>" alt="">
				</div>
				
				<div class="blog-card__body">
					
					<div class="blog-card__body__decor">
						
						<span><?php the_time( 'M' ); ?></span><?php the_time( 'j' ); ?>
					
					</div>
					
					<h2 class="blog-card__body__heading title__secondary"><?php the_title(); ?></h2>
					
					<div class="blog-card__body__meta">
						<p>
							<span class="blog-card__body__meta-name"><?php the_author(); ?></span> | Category1 | Category 2 | Category 3
						</p>
					</div>
					
					<div class="blog-card__body__text">
						<p><?php the_excerpt(); ?></p>
					</div>
					
					<div class="blog-card__body__link">
						<a href="<?php the_permalink(); ?>" class="button__text button__text--blue">Read More
							<i class="fas fa-arrow-right"></i></a>
					</div>
				
				</div>
			
			</div>
		
		<?php endwhile; ?>
	
	</div>
	
	<div class="blog-archive__sidebar">
		
		<div class="widget">
			<h3 class="widget__heading">Categories</h3>
			
			<ul class="widget__list">
				
				<?php foreach ( get_categories() as $category ) { ?>
					
					<li class="widget__list__item">
						<a href="<?php echo get_term_link( $category ); ?>"><?php echo $category->name; ?></a>
					</li>
				
				<?php } ?>
			
			</ul>
		
		</div>
		
		<div class="widget">
			<h3 class="widget__heading">Archives</h3>
			
			<ul class="widget__list">
				<li class="widget__list__item"><a href="">December 2018</a></li>
				<li class="widget__list__item"><a href="">January 2019</a></li>
				<li class="widget__list__item"><a href="">February 2019</a></li>
				<li class="widget__list__item"><a href="">March 2019</a></li>
			</ul>
		
		</div>
	
	</div>

</div>

<?php get_footer(); ?>
