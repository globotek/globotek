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
	
	<?php if ( class_exists( 'woocommerce' ) ) { ?>
		
		<?php if ( is_cart() || is_checkout() || is_account_page() || is_woocommerce() ) { ?>
			
			<div class="wrapper">
				
				<?php the_content(); ?>
			
			</div>
		
		<?php } ?>
	
	<?php } ?>
	
	<?php gtek_template_router( get_field( 'components' ) ); ?>

</div>

<script>


</script>


<?php get_footer(); ?>
