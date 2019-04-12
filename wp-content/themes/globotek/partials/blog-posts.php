<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 09/02/2019
 * Time: 19:28
 */

$cards = get_posts( array( 'posts_per_page' => 3 ) ); ?>

<div class="card-grid">
	
	<?php foreach ( $cards as $card ) { ?>
		
		<div class="card-grid__item">
			
			<?php global $post; ?>
			<?php $post = $card; ?>
			<?php setup_postdata( $card ); ?>
			
			<div class="card">
				
				<div class="card__image">
					
					<?php the_post_thumbnail('large'); ?>
					
					<div class="card__image__decor">
						<span><?php echo the_time( 'd M Y' ); ?></span>
					</div>
				
				</div>
				
				<div class="card__body">
					
					
					<h3 class="card__body__heading heading heading__tertiary"><?php echo the_title(); ?></h3>
					
					<div class="card__body__text">
						<?php the_excerpt(); ?>
					</div>
					
					<div class="card__body__link">
						<a href="<?php the_permalink(); ?>" class="button__text button__text--blue">Read More</a>
					</div>
				
				</div>
			
			</div>
		
		
		</div>
	
	<?php } ?>
	
	<div class="card-grid__link">
		<a href="<?php echo get_post_type_archive_link( 'post' ); ?>" class="button">More Articles</a>
	</div>

</div>
