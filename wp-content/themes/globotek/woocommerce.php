<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 2/5/19
 * Time: 1:57 PM
 */

get_header(); ?>

	
	<div class="chunk">
		
		<?php the_post(); ?>
				
		<?php woocommerce_content(); ?>
			
	</div>

<?php get_footer(); ?>