<?php
/**
 * Created by PhpStorm.
 * User: matthew
 * Date: 5/2/18
 * Time: 4:06 PM
 */

function chumly_feed_interactions( $post_id ) {
	
	echo '<div class="news-feed__item__interactions breathe">';
	chumly_get_template( 'feed', 'interactions', $post_id );
	echo '</div>';
	
}

add_action( 'chumly_after_feed_item_detail', 'chumly_feed_interactions', 5 );


function chumly_feed_comment_form( $post_id ) {
	
	echo '<div class="news-feed__item__comment-form">';
	chumly_get_template( 'form', 'comment', $post_id );
	echo '</div>';
	
}

add_action( 'chumly_after_feed_item_inner', 'chumly_feed_comment_form', 15 );


function chumly_comment_feed( $post_id ) {
	
	/**
	 * Get comments that have no parent - i.e no replies
	 */
	$comments = get_comments( array(
		'post_id' => $post_id,
		'parent'  => 0,
		'order'   => 'ASC'
	) );
	
	echo '<div class="comments">';
	echo '<ol class="comments__list">';
	
	foreach( $comments as $comment ) {
		
		/**
		 * Fire the comment markup function for parent comments
		 */
		chumly_parent_comment( $post_id, $comment->comment_ID, $comment );
		
		
		/**
		 * Get all comments that have a parent, using the parent's ID
		 */
		$replies = get_comments( array( 'parent' => $comment->comment_ID, 'order' => 'ASC' ) );
		
		echo '<ol id="nested_comments_' . $comment->comment_ID . '" class="comments__list">';
		
		if( $replies ) {
			
			foreach( $replies as $reply ) {
				
				/**
				 * Fire the comment markup function for nested comments
				 */
				chumly_nested_comment( $post_id, $reply->comment_ID, $reply );
				
			}
			
		}
		
		echo '</ol>';
		
		echo '</li>';
		
	}
	
	echo '<span class="new_comment_anchor" data-comment_thread="' . $post_id . '"></span>';
	
	echo '</ol>';
	echo '</div>';
	
}

add_action( 'chumly_after_feed_item_detail', 'chumly_comment_feed', 10 );


function chumly_parent_comment( $post_id, $comment_id, $comment = NULL ) {
	
	if( $_POST ) {
		$comment = (object)$_POST;
		$comment->comment_content = chumly_convert_urls( $_POST[ 'comment_content' ] );
	}
	
	$comment_user_id = $comment->user_id;
	$comment_author = $comment->comment_author;
	$comment_content = stripslashes_deep( $comment->comment_content );
	$comment_timestamp = $comment->comment_date;
	
	echo '<li class="comments__item">';
	echo '<div class="comments__item__inner" data-module="chumly-toggle">';
	
	echo ' <div class="comments__item__avatar">';
	
	echo '<figure class="avatar avatar--medium"><img class="avatar__image" src="' . chumly_avatar( $comment_user_id, 'profile', NULL, FALSE ) . '" alt="' . $comment_author . ' profile picture" /></figure>';
	echo '</div>';
	
	echo '<div class="comments__item__content">';
	echo '<div class="comments__item__box">';
	
	echo '<div class="comments__item__header">';
	
	echo '<h3 class="comments__item__heading">';
	echo '<a href="' . chumly_profile_url( $comment_user_id ) . '">' . $comment_author . '</a>';
	echo '</h3>';

//	echo '<time datetime="MM-DD-YYYY HH:mm" class="comments__item__date">' . chumly_format_datetime( $comment_timestamp )->elapsed . '</time>';
	
	echo '</div>';
	
	echo '<div class="comments__item__body wysiwyg">';
	echo wpautop( $comment_content );
	echo '</div> ';
	
	if( function_exists( 'chumly_reactions' ) ) {
		echo '<a href="#" class="comments__item__interaction" data-comment_id="' . $comment_id . '">Like</a>';
	}
	
	echo '<a href="#reply_' . $comment_id . '" class="comments__item__interaction chumly-toggle__trigger" data-comment_id="' . $comment_id . '">Reply</a>';
	
	echo '<div id="reply_' . $comment_id . '" class="news-feed__item__comment-form comments__form--reply chumly-toggle__target" data-reply_parent="' . $comment_id . '">';
	echo chumly_get_template( 'form', 'comment', $post_id );
	echo '</div>';
	
	echo '</div>';
	echo '</div>';
	
	echo '</div>';
	
}


function chumly_nested_comment( $post_id, $comment_id, $comment = NULL ) {
	
	if( $_POST ) {
		$comment = (object)$_POST;
		$comment->comment_content = chumly_convert_urls( $_POST[ 'comment_content' ] );
	}
	
	$reply_user_id = $comment->user_id;
	$reply_author = $comment->comment_author;
	$reply_content = $comment->comment_content;
	$reply_parent = $comment->comment_parent;
	$reply_timestamp = $comment->comment_date;
	$reply_id = $comment_id;
	
	echo '<li class="comments__item">';
	echo '<div class="comments__item__inner" data-module="chumly-toggle">';
	
	echo ' <div class="comments__item__avatar--small">';
	echo '<figure class="avatar avatar--small"><img class="avatar__image" src="' . chumly_avatar( $reply_user_id, 'profile', NULL, FALSE ) . '" alt="' . $reply_author . ' profile picture" /></figure>';
	echo '</div>';
	
	echo '<div class="comments__item__content--wide">';
	echo '<div class="comments__item__box">';
	
	echo '<div class="comments__item__header">';
	
	echo '<h3 class="comments__item__heading">';
	echo '<a href="' . chumly_profile_url( $reply_user_id ) . '">' . $reply_author . '</a>';
	echo '</h3>';
	
	echo '<time datetime="MM-DD-YYYY HH:mm" class="comments__item__date">' . chumly_format_datetime( NULL, $reply_timestamp )->elapsed . '</time>';
	
	echo '</div>';
	
	echo '<div class="comments__item__body wysiwyg">';
	echo wpautop( $reply_content );
	echo '</div> ';
	
	if( function_exists( 'chumly_reactions' ) ) {
		echo '<a href="#" class="comments__item__interaction" data-comment_id="' . $reply_id . '">Like</a>';
	}

//	echo '<a href="#reply_' . $reply_id . '" class="comments__item__interaction chumly-toggle__trigger" data-comment_id="' . $reply_id . '">Reply</a>';
	
	echo '<div id="reply_' . $reply_id . '" class="news-feed__item__comment-form comments__form--reply chumly-toggle__target" data-reply_parent="' . $reply_parent . '">';
	chumly_get_template( 'form', 'comment', $post_id );
	echo '</div>';
	
	echo '</div>';
	echo '</div>';
	
	echo '</div>';
	echo '</li>';
	
}


function chumly_save_comment() {
	
	$comment_id = wp_new_comment( array(
		'comment_post_ID'  => $_POST[ 'post_id' ],
		'comment_parent'   => $_POST[ 'comment_parent' ],
		'comment_content'  => chumly_convert_urls( $_POST[ 'comment_content' ] ),
		'comment_author'   => $_POST[ 'comment_author' ],
		'user_id'          => $_POST[ 'user_id' ],
		'comment_approved' => 1
	) );
	
	if( empty( $_POST[ 'comment_parent' ] ) ) {
		
		chumly_parent_comment( $_POST[ 'post_id' ], $comment_id );
		echo '<ol id="nested_comments_' . $comment_id . '" class="comments__list"></div>';
		
	} else {
		
		chumly_nested_comment( $_POST[ 'post_id' ], $comment_id );
		
	}
	
}


function chumly_trigger_save_comment() {
	
	chumly_save_comment();
	
	chumly_die();
	
}

add_action( 'wp_ajax_chumly_trigger_save_comment', 'chumly_trigger_save_comment' );
add_action( 'wp_ajax_nopriv_chumly_trigger_save_comment', 'chumly_trigger_save_comment' );