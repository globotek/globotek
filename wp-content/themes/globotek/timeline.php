<?php
/**
 * Template Name: Timeline
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 18/02/2019
 * Time: 19:43
 */ ?>

<?php get_header(); ?>

<?php gtek_hero(); ?>

<?php get_template_part('partials/hero-timeline'); ?>

<div class="timeline-page breathe--bottom-treble wrapper">
	
    <div class="section-title breathe--treble">
		<h2 class="title__secondary">Lorem ipsum dolor sit amet consectetur adipiscing elit. Curabitur et vestibulum arcu.</h2>
		<p class="section-title__intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. </p>
	</div>
	
    <div class="timeline">

        <div class="timeline__step">

            <div class="timeline__step__image">

                <img src="<?php echo get_template_directory_uri() . '/images/timeline-step-1.png'; ?>"/>

            </div>

            <div class="timeline__step__content">
                
                <h2 class="title__secondary">Goal Identification</h2>
		        <p class="section-title__intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. </p>

            </div>

        </div>

        <div class="timeline__line breathe">

            <div class="timeline__line__background">

                <img src="<?php echo get_template_directory_uri() . '/images/timeline-line.svg'; ?>"/>

                <div class="timeline__line__time">

                    1 - 2 Weeks

                </div>

            </div>

            

        </div>

    </div>

    <div class="timeline">

        <div class="timeline__step">

            <div class="timeline__step__image">

                <img src="<?php echo get_template_directory_uri() . '/images/timeline-step-2.png'; ?>"/>

            </div>

            <div class="timeline__step__content">
                
                <h2 class="title__secondary">Goal Identification</h2>
		        <p class="section-title__intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. </p>

            </div>

        </div>

        <div class="timeline__line breathe">

            <div class="timeline__line__background">

                <img src="<?php echo get_template_directory_uri() . '/images/timeline-line.svg'; ?>"/>

                <div class="timeline__line__time">

                    1 - 2 Weeks

                </div>

            </div>

            

        </div>

    </div>

    <div class="timeline">

        <div class="timeline__step">

            <div class="timeline__step__image">

                <img src="<?php echo get_template_directory_uri() . '/images/timeline-step-3.png'; ?>"/>

            </div>

            <div class="timeline__step__content">
                
                <h2 class="title__secondary">Goal Identification</h2>
		        <p class="section-title__intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et vestibulum arcu. Aenean quis orci sem. </p>

            </div>

        </div>

    </div>

</div>

<?php get_footer(); ?>
