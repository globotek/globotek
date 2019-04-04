<?php
/**
 * Created by PhpStorm.
 * User: globotek
 * Date: 02/02/2019
 * Time: 14:58
 */ ?>

<div class="tag-list">
    <p>
        <span class="blog-card__body__meta-name"><?php the_author(); ?></span>
        <?php foreach ( $categories as $category ) {
            echo ' | <a href="' . get_term_link( $category ) . '">' . $category->name . '</a>';
        } ?>
    </p>
</div>
