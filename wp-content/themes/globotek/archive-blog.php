<?php
/**
 * Template Name: Blog Archive
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 18/02/2019
 * Time: 19:43
 */ ?>

<?php get_header(); ?>

<?php include( 'partials/hero-blog-archive.php' ); ?>

<div class="blog-archive wrapper">
	
	<div class="blog-archive__posts">
		
		
        <div class="blog-card">
        
            <div class="blog-card__image">
                <img src="<?php echo get_template_directory_uri() . '/images/scraptastic-banner-min.png'; ?>" alt="">
            </div>

            
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
            
                
                <div class="blog-card__body__meta">
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
                </div>

                <div class="blog-card__body__text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus...</p>
                </div>
                
                <div class="blog-card__body__link">
                    <a href="#" class="button__text button__text--blue">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            
            </div>

        </div>



        <div class="blog-card">
        
            <div class="blog-card__image">
                <img src="<?php echo get_template_directory_uri() . '/images/scraptastic-banner-min.png'; ?>" alt="">
            </div>
            
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


                <div class="blog-card__body__meta">
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
                </div>
                

                <div class="blog-card__body__text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. Suspendisse iaculis scelerisque purus ornare finibus...</p>
                </div>
                
                <div class="blog-card__body__link">
                    <a href="#" class="button__text button__text--blue">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            
            </div>

        </div>
		
		
    </div>
    
    <div class="blog-archive__sidebar">

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

<?php get_footer(); ?>
