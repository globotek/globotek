<!-- STATUS NEWS FEED ITEM -->
<li class="news-feed__item">
	<div class="news-feed__item__inner">
		
		<div class="news-feed__item__decor">
			<?php echo chumly_get_icon( 'ellipsis', 'button__icon button__icon--right' ); ?>
		</div>
		
		<div class="news-feed__item__detail">
			
			<?php do_action( 'chumly_before_feed_item_detail', get_the_ID() ); ?>
			
			<h3 class="news-feed__item__heading">
				<?php $post_source = get_post_meta( $post, 'post_source', TRUE ); ?>
				
				<?php $author_id = get_the_author_meta( 'ID' ); ?>
				<a href="<?php echo chumly_profile_url( $author_id ); ?>"><?php echo chumly_username( $author_id ); ?></a>
				
				<?php //chumly_get_template( 'feed', 'menu' ); ?>
			
			</h3>
			
			<?php $post_datetime = chumly_format_datetime( get_the_ID() ); ?>
			<time class=""><?php echo $post_datetime->elapsed . ' at ' . $post_datetime->time; ?></time>
			
			<div class="news-feed__item__content">
				<div class="wysiwyg wysiwyg--large-text">
					
					<?php echo get_the_content(); ?>
				
				</div>
			</div>
			
			<?php if( strlen( $content ) > 300 ) { ?>
				<a href="#" class="comments__item__reply">More</a>
			<?php } ?>
			
			<?php do_action( 'chumly_after_feed_item_detail', get_the_ID() ); ?>
		
		</div>
	</div>
	
	<?php do_action( 'chumly_after_feed_item_inner', get_the_ID() ); ?>

</li>
<!-- STATUS NEWS FEED ITEM -->

