<?php
global $post;
$post_id = $post->ID;

$linked_content_id = intval( get_the_terms( $post_id, 'chumly_linked' )[ 0 ]->slug );

$shared_post_query = new WP_Query( array(
		'post_type' => 'chumly_status_post',
		'p'         => $linked_content_id
	)
);

$shared_post = $shared_post_query->get_posts()[ 0 ]; ?>

<!--SHARED CONTENT FEED ITEM-->
<li class="news-feed__item">
	<div class="news-feed__item__inner">
		
		<div class="news-feed__item__decor">
			<?php chumly_icon('share'); ?>
		</div>
		
		<div class="news-feed__item__detail">
			
			<?php do_action( 'chumly_before_feed_item_detail', get_the_ID() ); ?>
			
			<h3 class="news-feed__item__heading">
				<?php $post_source = get_post_meta( $post, 'post_source', TRUE ); ?>
				<?php $post_format = chumly_get_post_format( $shared_post ); ?>
				<?php $author_id = get_the_author_meta( 'ID' ); ?>
				<a href="<?php echo chumly_profile_url( $author_id ); ?>"><?php echo chumly_username( $author_id ); ?></a> shared <?php _e( ctype_alpha( $post_format ) && preg_match( '/^[aeiou]/i', $post_format ) ? 'an ' . $post_format : 'a ' . $post_format ); ?>
			</h3>
			<?php $post_datetime = chumly_format_datetime( get_the_ID() ); ?>
			<time class=""><?php echo $post_datetime->elapsed . ' at ' . $post_datetime->time; ?></time>
			
			<div class="news-feed__item__content">
				<div class="wysiwyg">
					
					<?php echo get_the_content(); ?>
					
					<div class="news-feed__item__share">
						
						<?php while ( $shared_post_query->have_posts() ) : $shared_post_query->the_post(); ?>
							
							<div class="news-feed__item__share__header headline">
								
								<p class="headline__subheadline">Originally posted by <a href="<?php chumly_profile_url( chumly_user_id() ); ?>"><?php the_author(); ?></a></p>
								<?php $post_datetime = chumly_format_datetime( get_the_ID() ); ?>
								<time class=""><?php echo $post_datetime->elapsed . ' at ' . $post_datetime->time; ?></time>

							</div>
							
							<?php if ( get_the_content() ) { ?>
								
								<div class="news-feed__item__share__content">
									<?php the_content(); ?>
								</div>
							
							<?php } ?>
							
							<?php if ( has_post_thumbnail() ) { ?>
								
								<div class="news-feed__item__share__embed">
									<?php the_post_thumbnail(); ?>
								</div>
							
							<?php } ?>
						
						<?php endwhile; ?>
					
					</div>
				
				</div>
			</div>
			
			<?php if ( strlen( $content ) > 300 ) { ?>
				<a href="#" class="comments__item__reply">More</a>
			<?php } ?>
			
			<?php do_action( 'chumly_after_feed_item_detail', $post_id ); ?>
		
		</div>
	</div>
	
	<?php do_action( 'chumly_after_feed_item_inner', $post_id ); ?>

</li>
<!-- SHARED CONTENT FEED ITEM -->

