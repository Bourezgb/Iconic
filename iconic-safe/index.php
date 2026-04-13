<?php
/**
 * The main template file.
 * Minimal fallback template.
 */

get_header();
?>

<main class="container">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>
            <article id="post-<?php the_ID(); ?>">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div><?php the_excerpt(); ?></div>
            </article>
            <hr>
            <?php
        endwhile;
    else :
        echo '<p>لا يوجد محتوى حالياً.</p>';
    endif;
    ?>
</main>

<?php
get_footer();
