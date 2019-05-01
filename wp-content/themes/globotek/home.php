<?php
/**
 * Template Name: Blog Archive
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 18/02/2019
 * Time: 19:43
 */ ?>

<?php get_header(); ?>

<?php gtek_hero('hero-archive'); ?>

<div class="blog-archive wrapper">
	
	<div class="blog-archive__posts">
		
		<?php
		$query_args = array(
			'post_type' => 'post'
		);
		
		if ( is_category() ) {
			$query_args[ 'category_name' ] = single_cat_title( '', FALSE );
		}
		
		$query = new WP_Query( $query_args ); ?>
		
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			
			<?php $categories = wp_get_post_terms( $post->ID, 'category' ); ?>
			
			<div class="blog blog__card">
				
				<a href="<?php the_permalink(); ?>" class="blog__image">
					<?php the_post_thumbnail( 'interior-banner' ); ?>
                </a>

                <div class="blog__card__inner">
                
                    <div class="blog__heading">
                            
                        <div class="blog__heading__date">
                            <div class="post-date">
                                <span><?php the_time( 'M' ); ?></span><?php the_time( 'd' ); ?>
                            </div>
                        </div>
                        
                        <a href="<?php the_permalink(); ?>" class="blog__heading__title">
                            <h1 class="title title__secondary"><?php the_title(); ?></h1>
                        </a>
                    
                    </div>
                    
                    <div class="blog__body">					
                        
                        <div class="blog__body__meta">
                            
                        <div class="tag-list">
                            <p>
                                <span class="tag-list__author"><?php the_author(); ?></span>
                                <?php foreach ( $categories as $category ) {
                                    echo ' | <a href="' . get_term_link( $category ) . '">' . $category->name . '</a>';
                                } ?>
                            </p>
                        </div>

                        </div>
                        
                        <div class="blog__body__text">
                            <p><?php the_excerpt(60); ?></p>
                        </div>
                        
                        <div class="blog__body__link">
                            <a href="<?php the_permalink(); ?>" class="button__text button__text--blue">Read More
                                <i class="fas fa-arrow-right"></i></a>
                        </div>
                    
                    </div>
                
                </div>
			
			</div>
		
		<?php endwhile; ?>
	
	</div>
	
	<?php get_sidebar( 'blog' ); ?>

</div>

<?php get_footer(); ?>
