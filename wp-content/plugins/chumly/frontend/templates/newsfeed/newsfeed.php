<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 29/6/18
 * Time: 1:12 PM
 */
?>

<?php do_action( 'chumly_before_content' ); ?>

<?php //$navigation = apply_filters('chumly_merge_menus', array()); ?>

	<div class="grid grid--level-heights">
		
		<div class="grid__item grid__item--palm--one-whole grid__item--lap--one-quarter grid__item--desk--two-tenths">
			
			<?php chumly_sidebar( 'main' ); ?>
		
		</div>
		
		<div class="grid__item grid__item--palm--one-whole grid__item--lap--one-half grid__item--six-tenths">
			
			<?php chumly_post_form( 'chumly_status_post', array( 'target_id' => get_current_user_id() ) ); ?>
			<?php $newsfeed = new Chumly_Newsfeed(); ?>
			
			<div class="news-feed">
				
				<?php foreach ( $newsfeed->posts as $item ) { ?>
					
					<?php global $post; ?>
					<?php setup_postdata( $GLOBALS[ 'post' ] =& get_post( $item->ID ) ); ?>
					
					<?php $post_format = chumly_get_post_format(); ?>
							
					<?php ( ! $post_format ? $post_format = 'post' : $post_format ); ?>
					
					<?php chumly_get_template( 'feed', $post_format ); ?>
				
				<?php } ?>
			
			</div>
		
		</div>
		
		<div class="grid__item grid__item--palm--one-whole grid__item--lap--one-quarter grid__item--two-tenths">
			<?php dynamic_sidebar('chumly'); ?>
		</div>
	
	</div>

<?php do_action( 'chumly_after_content' ); ?>