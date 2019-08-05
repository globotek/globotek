<div class="comments">

    <div class="text-block">

        <h2 class="title title__tertiary title--dark text-block__title">Comments</h2>

    </div>

	<?php if (post_password_required()) : ?>
	    <p><?php _e( 'Post is password protected. Enter the password to view any comments.' ); ?></p>
    <?php return; endif; ?>

    <?php comment_form(); ?>

    <?php if (have_comments()) : ?>

        <h3 class="heading heading__primary"><?php comments_number(); ?></h3>

        <ol class="commentlist">
            <?php wp_list_comments(); ?>
        </ol>

        <div class="reply">
	        <?php $args = $depth = array(); ?>
            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>

    <?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

	    <p><?php _e( 'Comments are closed here.' ); ?></p>

    <?php endif; ?>

</div>
