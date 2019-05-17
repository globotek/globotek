<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 16/5/19
 * Time: 10:48 AM
 */
?>

<div class="wrapper">
	
	<?php $query = new WP_Query( array(
		'post_type' => 'portfolio',
		'post__in'  => wp_list_pluck( $component[ 'portfolio_items' ], 'post' )
	) ); ?>
	
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		
		<?php include( 'project-box.php' ); ?>
	
	<?php endwhile; ?>

</div>
