<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 13/02/2019
 * Time: 23:44
 */ ?>

<?php get_header(); ?>

<?php gtek_hero(); ?>

<div class="wrapper">

	<div class="chunk">

		<?php the_post(); ?>
		
		<?php gtek_template_router(get_field('components')); ?>
	
	</div>

</div>

<?php get_footer(); ?>
