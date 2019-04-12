<?php
/**
 * Template Name: Comparison
 * Created by PhpStorm.
 * User: wmjc1
 * Date: 18/02/2019
 * Time: 19:43
 */ ?>

<?php get_header(); ?>

<?php gtek_hero(); ?>

<?php get_template_part('partials/hero-comparison'); ?>

<div class="comparison-page breathe--treble wrapper">
	
    <?php get_template_part('partials/comparison'); ?>

    <div class="section-title breathe--top-treble">
		<h2 class="title__secondary">Site Care Questions?</h2>
		<p class="section-title__intro">If you would like to speak to an agent, please <a href="" class="button__text button__text--blue">get in touch here</a>.</p>
    </div>

    <div class="faqs">

        <?php get_template_part('partials/faq'); ?>

        <?php get_template_part('partials/faq'); ?>

        <?php get_template_part('partials/faq'); ?>

    </div>

</div>

<?php get_footer(); ?>
