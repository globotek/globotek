<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 13/02/2019
 * Time: 23:44
 */ ?>

<?php get_header(); ?>
<div class="wrapper">

	<div class="chunk">

		<?php the_post(); ?>
		<?php the_content(); ?>
	
	</div>

</div>

<?php get_footer(); ?>
