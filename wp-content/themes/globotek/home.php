<?php
/**
 * Template Name: Blog Archive
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 18/02/2019
 * Time: 19:43
 */ ?>

<?php get_header(); ?>
<?php the_post(); ?>

<?php include( 'partials/hero-blog-archive.php' ); ?>

<div class="blog-archive wrapper">
	
	<div class="blog-archive__posts">
		
		<?php $query = new WP_Query( array(
			'post_type' => 'post'
		) ); ?>
		
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			
			<?php $categories = wp_get_post_terms( $post->ID, 'category' ); ?>
			
			<div class="blog-card">
				
				<a href="<?php the_permalink(); ?>" class="blog-card__image">
					<?php the_post_thumbnail( 'interior-banner' ); ?>
				</a>
				
				<div class="blog-card__body">
					
					<div class="blog-card__body__decor">
						
						<span><?php the_time( 'M' ); ?></span><?php the_time( 'd' ); ?>
					
					</div>
					
					<h2 class="blog-card__body__heading title__secondary"><?php the_title(); ?></h2>
					
					<div class="blog-card__body__meta">
						<p>
							<span class="blog-card__body__meta-name"><?php the_author(); ?></span>
							<?php foreach ( $categories as $category ) {
								echo ' | <a href="' . get_term_link( $category ) . '">' . $category->name . '</a>';
							} ?>
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
	
	<?php get_sidebar( 'blog' ); ?>

</div>

<?php get_footer(); ?>
