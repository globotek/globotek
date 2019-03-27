<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 5/2/18
 * Time: 5:13 PM
 */
$default_interactions = array(
	'comment' => '
		<button class="button button--clear button--large" data-post_id="' . $post_id . '" data-interaction_action="comment">
		' . chumly_get_icon( 'paper', 'button__icon button__icon--left button__icon--large icon' ) . '
		Comment
		</button>',
	'share'   => '
		<button class="button button--clear button--large chumly-modal__trigger" data-post_id="' . $post_id . '" data-interaction_action="share">
			' . chumly_get_icon( 'signal', 'button__icon button__icon--left button__icon--large icon' ) . '
			Share
		</button>'
);

$interactions = apply_filters( 'chumly_feed_interactions', $default_interactions );

foreach ( $interactions as $interaction ) {
	echo $interaction;
}



