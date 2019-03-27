<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 5/2/18
 * Time: 3:54 PM
 */
?>

<form class="form comment_form" data-module="chumly-comment-form">
	
	<div class="form__group form__group__inline">
		<label for="comment" class="form__group__label"><?php _x( 'Comment', 'noun' ); ?></label>
		<textarea class="form__group__input form__group__input--singleline"
				  rows="1"
				  placeholder="Write a comment..."
				  data-post_id="<?php echo $post_id; ?>"
				  data-user_id="<?php echo get_current_user_id(); ?>"
				  data-username="<?php echo chumly_username( get_current_user_id() ); ?>"></textarea>
		<button type="submit" class="button button--positive ">Post</button>
	
	</div>

</form>
