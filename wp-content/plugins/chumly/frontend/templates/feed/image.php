<!-- DEFAULT NEWS FEED ITEM WITH MEDIA (IMAGE) -->

<?php $post_id = get_the_ID(); ?>
<?php $media = get_attached_media( '' ); ?>

<?php foreach( $media as $image ) {
	$image_url = $image->guid;
} ?>

<?php $post_parent = intval( get_the_terms( $post_id, 'chumly_post_target' )[ 0 ]->name ); ?>

<li class="news-feed__item">
    <div class="news-feed__item__inner">

        <div class="news-feed__item__decor">
			<?php chumly_icon( 'image' ); ?>
        </div>

        <div class="news-feed__item__detail">
			
			<?php do_action( 'chumly_before_feed_item_detail', $post_id ); ?>

            <h3 class="news-feed__item__heading">
				<?php $author_id = get_the_author_meta( 'ID' ); ?>
	            <a href="<?php echo chumly_profile_url( $author_id ); ?>"><?php echo chumly_username( $author_id ); ?></a> posted an image
				<?php _e( $post_parent && get_queried_object()->ID != $post_parent ? ' on <a href="' . get_the_permalink( $post_parent ) . '">' . get_the_title( $post_parent ) . '</a>' : '' ); ?>
            </h3>
			
			<?php $post_datetime = chumly_format_datetime( $post_id ); ?>
            <time class=""><?php echo $post_datetime->elapsed . ' at ' . $post_datetime->time; ?></time>
			
			<?php if( get_the_content() ) { ?>

                <div class="news-feed__item__content">
                    <div class="wysiwyg">
						<?php the_content(); ?>
                    </div>
                </div>
			
			<?php } ?>

            <a href="<?php echo $image_url; ?>" rel="prettyPhoto">
                <div class="news-feed__item__media" aria-hidden="true">
                    <div class="news-feed__item__embed" style="background-image: url(<?php echo $image_url; ?>)"></div>
                </div>
            </a>
			
			<?php do_action( 'chumly_after_feed_item_detail', $post_id ); ?>

        </div>

    </div>
	
	<?php do_action( 'chumly_after_feed_item_inner', $post_id ); ?>

</li>

<!-- DEFAULT NEWS FEED ITEM WITH MEDIA (IMAGE) -->

