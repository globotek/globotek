<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 6/4/19
 * Time: 6:11 PM
 */

$fields = get_fields(); ?>

<div class="testimonial">
	
	<img src="<?php echo get_template_directory_uri() . '/images/quote-left.png'; ?>" alt="" class="testimonial__decor--left">
	<div class="testimonial__body">
		<p class="testimonial__body__content"><?php echo get_the_content(); ?></p>
		<h4 class="testimonial__body__author title title__quaternary"><?php echo $fields[ 'reviewer' ]; ?></h4>
		<p class="testimonial__body__company"><?php echo $fields[ 'company' ]; ?></p>
	</div>
	<img src="<?php echo get_template_directory_uri() . '/images/quote-right.png'; ?>" alt="" class="testimonial__decor--right">
	
</div>