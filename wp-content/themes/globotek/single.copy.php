<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 23/02/2019
 * Time: 13:03
 */

get_header();
the_post(); ?>

<?php $categories = wp_get_post_terms( $post->ID, 'category' ); ?>

<div class="wave-hero">
	
	<?php the_post_thumbnail( 'post-hero' ); ?>
	
	<div class="wave-hero__body blog-item__hero__body">
		
		<img src="<?php echo get_template_directory_uri() . '/images/bg-blog-hero.svg'; ?>"/>
		
		<div class="portfolio-item__hero__inner">
			
			<div class="wave-hero__inner">
			
			
			</div>
		
		</div>
	
	</div>

</div>

<div class="blog-item__posts">
	
	<div class="blog-card">
		
		<div class="blog-card__body">
			
			<div class="blog-card__heading">
				
				<div class="blog-card__heading__date">
					<div class="date">
						<span>Jan</span>12
					</div>
				</div>
				
				<div class="blog-card__heading__title">
					<h3 class="title title__secondary">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h3>
				</div>
			
			</div>
			
			<h1 class="blog-card__body__heading title__secondary"><?php the_title(); ?></h1>
			
			<div class="blog-card__body__meta">
				<div class="tag-list">
					<a href="#" class="tag-list__author">Author Name</a>
					<span>|</span>
					<a href="#">Category 1</a>
					<span>|</span>
					<a href="#">Category 2</a>
					<span>|</span>
					<a href="#">Category 3</a>
				</div>
			</div>
			
			<div class="blog-card__body__text">
				
				<?php the_content(); ?>
				
			</div>
		
		
		</div>
	
	</div>


</div>

<div class="blog-item__sidebar">
	
	<div class="widget">
		<h3 class="widget__heading">Categories</h3>
		
		<ul class="widget__list">
			<li class="widget__list__item"><a href="">Category 1</a></li>
			<li class="widget__list__item"><a href="">Category 2</a></li>
			<li class="widget__list__item"><a href="">Category 3</a></li>
			<li class="widget__list__item"><a href="">Category 4</a></li>
			<li class="widget__list__item"><a href="">Category 5</a></li>
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

<div class="blog-item wrapper">
	
	<div class="blog-item__posts">
		
		<div class="blog-card">
			
			<div class="blog-card__body">
				
				<div class="blog-card__body__decor">
					<span><?php the_time( 'M' ); ?></span><?php the_time( 'd' ); ?>
				</div>
				
				<h1 class="blog-card__body__heading title__secondary"><?php the_title(); ?></h1>
				
				<div class="blog-card__body__meta">
					
					<p>
						<span class="blog-card__body__meta-name"><?php the_author(); ?></span>
						<?php foreach ( $categories as $category ) {
							echo ' | <a href="' . get_term_link( $category ) . '">' . $category->name . '</a>';
						} ?>
					</p>
				
				</div>
				
				<div class="blog-card__body__text">
					
					<?php the_content(); ?>
				
				</div>
			
			
			</div>
		
		</div>
	
	
	</div>
	
	<?php get_sidebar( 'blog' ); ?>
	
	<div class="portfolio-item__contact-form">
		<?php include( 'partials/contact-form.php' ); ?>
	</div>
	
	<div class="portfolio-item__cta wrapper">
		<div class="section-title">
			<h2 class="title__secondary">Related Articles</h2>
		</div>
		
		<div class="breathe--bottom-double">
			<?php include( 'partials/card-grid.php' ); ?>
		</div>
	</div>

</div>

<?php get_footer(); ?>