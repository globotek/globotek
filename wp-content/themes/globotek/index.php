<?php
/**
 * Template Name: Home
 * Created by PhpStorm.
 * User: matthew
 * Date: 3/4/19
 * Time: 8:07 PM
 */
get_header(); ?>

<?php gtek_hero(); ?>

<?php gtek_template_router( get_field( 'components' ) ); ?>

<?php get_footer(); ?>
