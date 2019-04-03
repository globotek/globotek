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

<div class="portfolio-item">
	
	<div class="portfolio-item__hero">
		
		<?php the_post_thumbnail( 'post-hero' ); ?>
		
		<div class="portfolio-item__hero__body blog-item__hero__body">
			
			<img src="<?php echo get_template_directory_uri() . '/images/bg-blog-hero.svg'; ?>"/>
			
			<div class="portfolio-item__hero__inner">
			
			
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
