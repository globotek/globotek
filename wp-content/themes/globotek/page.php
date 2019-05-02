<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 13/02/2019
 * Time: 23:44
 */ ?>

<?php get_header(); ?>

<?php gtek_hero(); ?>

<div class="chunk">
	
	<?php the_post(); ?>
	
	<?php var_dump( is_woocommerce() ); ?>
	
	<?php the_content(); ?>
	
	<?php gtek_template_router( get_field( 'components' ) ); ?>

</div>

<?php get_footer(); ?>
