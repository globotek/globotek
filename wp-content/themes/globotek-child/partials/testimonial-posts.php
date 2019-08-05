<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 21/5/19
 * Time: 11:10 AM
 */
?>

<div class="wrapper">
	
	<?php $query = new WP_Query( array(
		'post_type' => 'testimonial',
		'post__in'  => wp_list_pluck( $component[ 'testimonials' ], 'post' )
	) ); ?>
	
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		
		<?php include( 'testimonial.php' ); ?>
	
	<?php endwhile; ?>

</div>
