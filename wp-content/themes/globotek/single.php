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
<<<<<<< HEAD
=======
			
>>>>>>> 4e95a0b771757acde857a9dc0ce37b1a35bb89ba
			
			</div>
		
		</div>
	
	</div>
<<<<<<< HEAD
	
        <div class="blog-item__posts">
            
            <div class="blog-card">
                
                <div class="blog-card__body">

                    <div class="blog-card__heading">

                        <div class="blog-card__heading__date">
                            <div class="date">
                                <span>Jan</span>12
                            </div>
                        </div>

                        <div class="blog-card__heading__title">
                            <h3 class="title title__secondary">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h3>
                        </div>

                    </div>
                    
                    <h1 class="blog-card__body__heading title__secondary"><?php the_title(); ?></h1>
                    
                    <div class="blog-card__body__meta">
                        <div class="tag-list">
                            <a href="#" class="tag-list__author">Author Name</a>
                            <span>|</span> 
                            <a href="#">Category 1</a>
                            <span>|</span> 
                            <a href="#">Category 2</a>
                            <span>|</span> 
                            <a href="#">Category 3</a>
                        </div>
                    </div>

                    <div class="blog-card__body__text">
                        <?php the_content(); ?>
                        <!--
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse rhoncus dolor ex, at ultricies lorem pretium ac. Duis mauris turpis, condimentum vitae tristique in, semper sed elit. Praesent eu varius augue. Aenean risus quam, molestie quis magna sit amet, semper faucibus dolor. Vivamus magna magna, convallis sit amet enim vitae, consequat faucibus nulla. Pellentesque mollis massa sed tincidunt commodo. Suspendisse quis justo quis neque gravida ultrices at et erat. Sed nunc felis, maximus ac quam ut, fringilla tincidunt mauris. Etiam condimentum metus et arcu interdum mattis. Duis ullamcorper nunc vel sapien pharetra, vel semper metus commodo.</p>
                        
                        <img src="<?php /*echo get_template_directory_uri() . '/images/scraptastic-banner-min.png'; */?>" alt="">

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse rhoncus dolor ex, at ultricies lorem pretium ac. Duis mauris turpis, condimentum vitae tristique in, semper sed elit. Praesent eu varius augue. Aenean risus quam, molestie quis magna sit amet, semper faucibus dolor. Vivamus magna magna, convallis sit amet enim vitae, consequat faucibus nulla. Pellentesque mollis massa sed tincidunt commodo. Suspendisse quis justo quis neque gravida ultrices at et erat. Sed nunc felis, maximus ac quam ut, fringilla tincidunt mauris. Etiam condimentum metus et arcu interdum mattis. Duis ullamcorper nunc vel sapien pharetra, vel semper metus commodo.
                        <img src="<?php /*echo get_template_directory_uri() . '/images/scraptastic-banner-min.png'; */?>" alt="">
                        </p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse rhoncus dolor ex, at ultricies lorem pretium ac. Duis mauris turpis, condimentum vitae tristique in, semper sed elit. Praesent eu varius augue. Aenean risus quam, molestie quis magna sit amet, semper faucibus dolor. Vivamus magna magna, convallis sit amet enim vitae, consequat faucibus nulla. Pellentesque mollis massa sed tincidunt commodo. Suspendisse quis justo quis neque gravida ultrices at et erat. Sed nunc felis, maximus ac quam ut, fringilla tincidunt mauris. Etiam condimentum metus et arcu interdum mattis. Duis ullamcorper nunc vel sapien pharetra, vel semper metus commodo.</p>

                        -->
                    </div>
                    
                
                </div>
=======
>>>>>>> 4e95a0b771757acde857a9dc0ce37b1a35bb89ba

</div>

<div class="blog-item wrapper">
<<<<<<< HEAD


            
            
            
        </div>
        
        <div class="blog-item__sidebar">

            <div class="widget">
                <h3 class="widget__heading">Categories</h3>

                <ul class="widget__list">
                    <li class="widget__list__item"><a href="">Category 1</a></li>
                    <li class="widget__list__item"><a href="">Category 2</a></li>
                    <li class="widget__list__item"><a href="">Category 3</a></li>
                    <li class="widget__list__item"><a href="">Category 4</a></li>
                    <li class="widget__list__item"><a href="">Category 5</a></li>
                </ul>

            </div>

            <div class="widget">
                <h3 class="widget__heading">Archives</h3>

                <ul class="widget__list">
                    <li class="widget__list__item"><a href="">December 2018</a></li>
                    <li class="widget__list__item"><a href="">January 2019</a></li>
                    <li class="widget__list__item"><a href="">February 2019</a></li>
                    <li class="widget__list__item"><a href="">March 2019</a></li>
                </ul>

            </div>

        </div>

    </div>
=======
>>>>>>> 4e95a0b771757acde857a9dc0ce37b1a35bb89ba
	
	<div class="blog-item__posts">
		
		<div class="blog-card">
			
			
			<div class="blog-card__body">
				<div class="blog-card__heading">
					
					<div class="blog-card__heading__date">
						<div class="post-date">
							<span><?php the_time( 'M' ); ?></span><?php the_time( 'd' ); ?>
						</div>
					</div>
					
					<div class="blog-card__heading__title">
						<h1 class="title title__secondary"><?php the_title(); ?></h1>
					</div>
				
				</div>
				
				<div class="blog-card__body__meta">
					
					<p>
						<span class="blog-card__body__meta-name"><?php the_author(); ?></span>
						<?php foreach ( $categories as $category ) {
							echo ' | <a href="' . get_term_link( $category ) . '">' . $category->name . '</a>';
						} ?>
					</p>
				
				</div>
				
				<div class="blog-card__body__text">
					
					<?php the_content(); ?>
				
				</div>
				
			</div>
		
		</div>
	
	</div>
	
	<?php get_sidebar( 'blog' ); ?>

</div>

<div class="portfolio-item__contact-form">
	<?php include( 'partials/contact-form.php' ); ?>
</div>

<div class="portfolio-item__cta wrapper">
	<div class="section-title">
		<h2 class="title__secondary">Related Articles</h2>
	</div>
	
	<div class="breathe--bottom-double">
		<?php include( 'partials/card-grid.php' ); ?>
	</div>
</div>


<?php get_footer(); ?>
