<?php $post_id = get_the_ID(); ?>
<?php $post_source = get_post_meta( $post_id, 'post_source', TRUE ); ?>
<?php global $post; ?>

<!-- STATUS NEWS FEED ITEM -->
<li class="news-feed__item">
    <div class="news-feed__item__inner">

        <div class="news-feed__item__decor">
			<?php chumly_icon( 'speech-bubble', 'button__icon button__icon--right' ); ?>
        </div>

        <div class="news-feed__item__detail">
			
			<?php do_action( 'chumly_before_feed_item_detail', $post_id ); ?>
			
			<?php $post_datetime = chumly_format_datetime( get_the_ID() ); ?>
			
			<?php if( chumly_is_profile() ) { ?>

                <h3 class="news-feed__item__heading">
					<?php $author_id = get_the_author_meta( 'ID' ); ?>
	                <a href="<?php echo chumly_profile_url( $author_id ); ?>"><?php echo chumly_username( $author_id ); ?></a>
                    commented on
                    <a href="<?php echo get_the_permalink( $post_source ); ?>"><?php echo get_the_title( $post_source ); ?></a>
                </h3>

                <time class=""><?php echo $post_datetime->elapsed . ' at ' . $post_datetime->time; ?></time>
			
			<?php } else { ?>

                <h3 class="news-feed__item__heading">

                    <a href="<?php echo chumly_profile_url( $post->post_author ); ?>"><?php the_author(); ?></a>

                </h3>

                <time class=""><?php echo $post_datetime->elapsed . ' at ' . $post_datetime->time; ?></time>
			
			<?php } ?>

            <div class="news-feed__item__content">
                <div class="wysiwyg wysiwyg--large-text">
					
					<?php echo get_the_content(); ?>

                </div>
            </div>
			
			<?php if( strlen( $content ) > 300 ) { ?>
                <a href="" class="comments__item__reply">More</a>
			<?php } ?>
			
			
			
			<?php do_action( 'chumly_after_feed_item_detail', $post_id ); ?>

        </div>
    </div>
	
	<?php do_action( 'chumly_after_feed_item_inner', $post_id ); ?>

</li>
<!-- STATUS NEWS FEED ITEM -->

