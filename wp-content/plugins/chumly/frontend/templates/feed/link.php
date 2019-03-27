<!-- DEFAULT NEWS FEED ITEM -->
<li class="news-feed__item">
	
	<div class="news-feed__item__inner">
		
		<div class="news-feed__item__decor">
			<?php echo chumly_get_icon('link', 'button__icon button__icon--right'); ?>
		</div>
		
		<div class="news-feed__item__detail">
			
			<?php do_action( 'chumly_before_feed_item_detail', get_the_ID() ); ?>
			
			<h3 class="news-feed__item__heading">
				<?php $post_source = get_post_meta($post->ID, 'post_source', TRUE); ?>
				
				<?php $author_id = get_the_author_meta( 'ID' ); ?>
				<a href="<?php echo chumly_profile_url( $author_id ); ?>"><?php echo chumly_username( $author_id ); ?></a> added a link
				
				<?php if($data['post_source']){ ?>
				on <a href="#">forum post name with a long name</a>
				<?php } ?>
			</h3>
			
			<div class="news-feed__item__content">
				
				<div class="wysiwyg">
					
					<?php echo get_the_content(); ?>
					
					<?php $attachments = get_post_meta($post->ID, 'attachments', TRUE); ?>
										
					<?php foreach($attachments as $attachment){ ?>
						
						<?php //var_dump($attachment); ?>
						<?php if($attachment['type'] == 'image'){ ?>
							<a href="<?php echo $attachment['url']; ?>" rel="prettyPhoto">
								<img src="<?php echo $attachment['url']; ?>" />
							</a>
						<?php } ?>
					
					<?php } ?>
				
				</div>
			</div>
			
			<?php if(strlen($post_content) > 300){ ?>
				<a href="#" class="comments__item__reply">More</a>
			<?php } ?>
			
			<?php do_action( 'chumly_after_feed_item_detail', get_the_ID() ); ?>
		
		</div>
	</div>
	
	<?php do_action( 'chumly_after_feed_item_inner', get_the_ID() ); ?>
	
</li>
<!-- DEFAULT NEWS FEED ITEM -->

