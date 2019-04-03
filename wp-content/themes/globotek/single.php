<?php
/**
 * Template Name: Blog Single
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 23/02/2019
 * Time: 13:03
 */

get_header(); the_post(); ?>


<div class="portfolio-item">
	
	<div class="portfolio-item__hero">
		
        <img src="<?php echo get_template_directory_uri() . '/images/scraptastic-banner-min.png'; ?>" alt="">
		
		<div class="portfolio-item__hero__body blog-item__hero__body">
			
			<img src="<?php echo get_template_directory_uri() . '/images/bg-blog-hero.svg'; ?>"/>
			
			<div class="portfolio-item__hero__inner">
				
			
			</div>
		
		</div>
	
    </div>
    

    <div class="blog-item wrapper">
	
        <div class="blog-item__posts">
            
            <div class="blog-card">
                
                <div class="blog-card__body">

                    <div class="blog-card__body__decor">
                        <span>Jan</span>12
                    </div>
                    
                    <h1 class="blog-card__body__heading title__secondary"><?php the_title(); ?></h1>
                    
                    <div class="blog-card__body__meta">
                        <p><span class="blog-card__body__meta-name">Author Name</span> | Category1 | Category 2 | Category 3</p>
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

            </div>



            
            
            
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

</div>

<?php get_footer(); ?>
