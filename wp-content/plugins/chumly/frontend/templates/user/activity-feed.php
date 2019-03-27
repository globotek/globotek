<?php global $chumly, $post;

$user_id = chumly_user_id();

$query = new WP_Query( array(
	'post_type'      => array( 'chumly_status_post', 'chumly_shared' ),
	'posts_per_page' => 20,
	'tax_query'      => array(
		'relation' => 'OR',
		array(
			'taxonomy' => 'chumly_post_target',
			'field'    => 'slug',
			'terms'    => $user_id
		),
		array(
			'taxonomy' => 'chumly_linked',
			'field'    => 'slug',
			'terms'    => $user_id
		)
	)
) ); ?>
	
	
<h3 class="user-profile__sub-heading breathe--top">Latest Activity</h3>

<?php //if ( Chumly_Settings::get_setting( $user_id, 'profile_privacy' ) == 1 ) { ?>
	
	<div class="user-profile__activity__content" data-module="chumly-modal">
		
		<?php chumly_modal('share', 'share_post', 'Share'); ?>
		
		<ol class="news-feed size--one-whole">
			
			<?php
			/**
			 * Description of purposes for different feed types
			 *
			 * @param
			 */
			?>
			
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
				
				$post_format = chumly_get_post_format();
				( !$post_format ? $post_format = 'post' : $post_format );
				
				chumly_get_template( 'feed', $post_format, $post->ID );
			
			endwhile;
			else:
				
				echo '<p>There\'s no activity to show yet.</p>';
			
			endif; ?>
			
			<!--<!-- DEFAULT NEWS FEED ITEM WITH MEDIA (IMAGE) -->
			<!--<li class="news-feed__item">-->
			<!--	<div class="news-feed__item__inner">-->
			<!--		<div class="news-feed__item__decor">-->
			<!--			<svg class="button__icon button__icon--right icon" aria-hidden="true">-->
			<!--				<use xmlns:xlink="http://www.w3.org/1999/xlink"-->
			<!--					 xlink:href="--><?php //echo $chumly->plugin_uri . '/frontend/images/icons/svg-symbols.svg#image'; ?><!--"></use>-->
			<!--			</svg>-->
			<!--		</div>-->
			<!--		<div class="news-feed__item__detail">-->
			<!--			<h3 class="news-feed__item__heading">-->
			<!--				<a href="#">Person Mc Very Long Name</a> posted an <a href="#">image</a>-->
			<!--			</h3>-->
			<!--			<a href="#" class="news-feed__media">-->
			<!--				<div class="news-feed__item__media" aria-hidden="true">-->
			<!--								<div class="news-feed__item__embed" style="background-image: url(<?php /*echo $chumly->plugin_uri . '/frontend/images/temp/feature-home.jpg'; */ ?>)"></div>
							</div>
						</a>
						<div class="news-feed__item__content">
							<div class="wysiwyg">
								<p>Morbi id placerat arcu. Pellentesque egestas, justo in efficitur tristique, ex diam sagittis ante.</p>
							</div>
						</div>
						<a href="#" class="comments__item__reply">More</a>
					</div>
				</div>
			</li>
-->            <!-- DEFAULT NEWS FEED ITEM WITH MEDIA (IMAGE) -->
			
			<!-- DEFAULT NEWS FEED ITEM WITH MEDIA (VIDEO) -->
			<!--			<li class="news-feed__item">
				<div class="news-feed__item__inner">
					<div class="news-feed__item__decor">
						<svg class="button__icon button__icon--right icon" aria-hidden="true">
							<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php /*echo $chumly->plugin_uri . '/frontend/images/icons/svg-symbols.svg#video'; */ ?>"></use>
						</svg>
					</div>
					<div class="news-feed__item__detail">
						<h3 class="news-feed__item__heading">
							<a href="#">Person Mc Very Long Name</a> posted a <a href="#">video</a>
						</h3>
						<div class="news-feed__media">
							<div class="news-feed__item__media" aria-hidden="true">
								<!-- make sure you add the component class to embed iframes -->
			<!--					<iframe class="news-feed__item__embed" width="560" height="315" src="https://www.youtube.com/embed/WoZQ0ivvW7E" frameborder="0"	allowfullscreen></iframe>-->
			<!--				</div>-->
			<!--			</div>-->
			<!--			<div class="news-feed__item__content">-->
			<!--				<div class="wysiwyg">-->
			<!--					<p>Morbi id placerat arcu. Pellentesque egestas, justo in efficitur tristique, ex diam sagittis ante.</p>-->
			<!--				</div>-->
			<!--			</div>-->
			<!--			<a href="#" class="comments__item__reply">More</a>-->
			<!--		</div>-->
			<!--	</div>-->
			<!--</li>-->
			<!-- DEFAULT NEWS FEED ITEM WITH MEDIA (VIDEO) -->
			
			
			<!-- DEFAULT NEWS FEED ITEM HEADING ONLY -->
			<!--<li class="news-feed__item">-->
			<!--	<div class="news-feed__item__inner">-->
			<!--		<div class="news-feed__item__decor">-->
			<!--			<svg class="button__icon button__icon--right icon" aria-hidden="true">-->
			<!--				<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="--><?php //echo $chumly->plugin_uri . '/frontend/images/icons/svg-symbols.svg#head'; ?><!--"></use>-->
			<!--			</svg>-->
			<!--		</div>-->
			<!--		<div class="news-feed__item__detail">-->
			<!--			<h3 class="news-feed__item__heading">-->
			<!--				<a href="#">Person Mc Very Long Name</a> became friends with <a href="#">Another Person with a long name</a>-->
			<!--			</h3>-->
			<!--		</div>-->
			<!--	</div>-->
			<!--</li>-->
			<!-- DEFAULT NEWS FEED ITEM HEADING ONLY -->
		
		
		</ol>
	</div>

<?php //} else { ?>

<!--	<p class="breathe">Nothing to show</p>-->
	
<?php //} ?>