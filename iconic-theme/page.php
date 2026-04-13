<?php
/**
 * Page Template
 */

get_header();
?>

<div class="container section-padding">
    <?php while (have_posts()) : the_post(); ?>
        <article style="max-width: 800px; margin: 0 auto;">
            <h1 class="single-title"><?php the_title(); ?></h1>
            
            <div class="single-content">
                <?php the_content(); ?>
            </div>
            
            <?php
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
        </article>
    <?php endwhile; ?>
</div>

<?php
get_footer();
