<div class="modal__header headline">
	
	<div class="form">
		
		<form>
			
			<select class="form__group__select" name="target_select">
				
				<option value="<?php echo get_current_user_id(); ?>">
					<p class="headline__subheadline">Share on your timeline</p>
				</option>
				<option value="user-search"><p class="headline__subheadline">Share on a friend's timeline</p></option>
				<option value="group-search"><p class="headline__subheadline">Share on a group</p></option>
				
			</select>
			
			<input type="hidden" name="loaded_post_id" value=""/>
			
		</form>
		
		<div class="form__group user-search is-hidden">
			
			<?php chumly_get_template( 'global', 'user-search', NULL, array(
				'class'         => '',
				'output'        => '',
				'placeholder'   => 'Search for friends',
				'submit_button' => FALSE
			
			) ); ?>
		
		</div>
		
		<div class="form__group group-search is-hidden">
			
			<?php chumly_get_template( 'global', 'user-search', NULL, array(
				'class'         => '',
				'output'        => '',
				'placeholder'   => 'Search for groups',
				'submit_button' => FALSE
			) ); ?>
		
		</div>
	
	</div>

</div>


<div class="modal__body">
	
	<?php chumly_get_template( 'form', 'share' ); ?>
	
	<div class="modal__body__content">
		
		<?php
		global $post;
		
		$query = new WP_Query( array(
			'post_type' => get_post_type( intval( $_POST[ 'post_id' ] ) ),
			'p'         => $_POST[ 'post_id' ]
		) );
		
		while ( $query->have_posts() ) : $query->the_post(); ?>
			
			
			<div class="news-feed__item">
				<div class="news-feed__item__inner">
					
					<div class="news-feed__item__detail">
						
						<h3 class="news-feed__item__heading">
							<?php $post_source = get_post_meta( $post, 'post_source', TRUE ); ?>
							<a href="#"><?php echo get_the_author(); ?></a>
						</h3>
						
						<div class="news-feed__item__content">
							<div class="wysiwyg">
								
								<?php the_post_thumbnail(); ?>
								<?php the_content(); ?>
							
							</div>
						</div>
					
					</div>
				</div>
			
			
			</div>
		
		
		<?php endwhile; ?>
	
	</div>

</div>