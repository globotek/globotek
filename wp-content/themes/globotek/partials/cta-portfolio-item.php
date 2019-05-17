<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 09/02/2019
 * Time: 21:06
 */ ?>

<?php $query = new WP_Query(
	array(
		'post_type'      => 'portfolio',
		'posts_per_page' => 1
	)
); ?>

<div class="cta">
	
	<div class="cta__background">
		<img src="<?php echo get_template_directory_uri() . '/images/cta-bg-large.svg'; ?>"/>
	</div>
	
	<div class="cta__inner">
		
		<div class="cta__portfolio-item">
			
			<div class="cta__title">
				<h2 class="title title__secondary">GloboTek's Latest Project</h2>
				<p class="section-title__intro">Take a moment to checkout our latest project.</p>
			</div>
			
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				
				<?php include( 'portfolio-box.php' ); ?>
			
			<?php endwhile; ?>
		
		</div>
		
		<div class="cta__portfolio-item__link">
			<a href="<?php echo get_post_type_archive_link( 'portfolio' ); ?>" class="button">View Portfolio</a>
		</div>
	
	</div>

</div>
