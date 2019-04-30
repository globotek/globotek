<?php
/**
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 23/02/2019
 * Time: 13:03
 */

get_header();
the_post(); ?>

<?php $categories = wp_get_post_terms( $post->ID, 'category' ); ?>

<div class="wave-hero">
	
	<?php the_post_thumbnail( 'post-hero' ); ?>
	
	<div class="wave-hero__body blog-item__hero__body">
		
		<img src="<?php echo get_template_directory_uri() . '/images/bg-blog-hero.svg'; ?>"/>
		
		<div class="portfolio-item__hero__inner">
			
			<div class="wave-hero__inner">
			
			
			</div>
		
		</div>
	
	</div>

</div>

<div class="blog-item wrapper">
	
	<div class="blog-item__posts">
		
		<div class="blog">
            
            <div class="blog__heading">
					
                <div class="blog__heading__date">
                    <div class="post-date">
                        <span><?php the_time( 'M' ); ?></span><?php the_time( 'd' ); ?>
                    </div>
                </div>
                
                <div class="blog__heading__title">
                    <h1 class="title title__secondary"><?php the_title(); ?></h1>
                </div>
            
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
				
				<div class="blog__body__text content">
					
					<?php the_content(); ?>
				
				</div>
			
			</div>
		
		</div>
	
	</div>
	
	<?php get_sidebar( 'blog' ); ?>

</div>

<div class="blog-item__contact-form">
	<?php include( 'partials/contact-form.php' ); ?>
</div>

<div class="blog-item__cta wrapper">
	<div class="section-title">
		<h2 class="title__secondary">Related Articles</h2>
	</div>
	
	<div class="breathe--bottom-double">
		<?php include( 'partials/blog-posts.php' ); ?>
	</div>
</div>


<?php get_footer(); ?>
