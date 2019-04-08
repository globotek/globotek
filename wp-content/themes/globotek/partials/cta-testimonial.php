<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 12/02/2019
 * Time: 11:21
 */ ?>


<div class="cta">
	
	<div class="cta__background">
		<img src="<?php echo get_template_directory_uri() . '/images/cta-bg-large.png'; ?>" alt="">
	</div>
	
	<div class="cta__inner">
		
		<div class="cta__testimonials">
			
			<div class="section-title">
				<h2 class="title title__secondary">See What Our Clients Say</h2>
			</div>
			
			<div class="cta__testimonials__body">
				
				<?php $query = new WP_Query( array(
					'post_type'      => 'testimonial',
					'posts_per_page' => 1,
					'orderby'        => 'rand'
				) );
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
					
					<?php include( 'testimonial.php' ); ?>
				
				<?php endwhile; ?>
			
			</div>
		
		</div>
	
	</div>

</div>
