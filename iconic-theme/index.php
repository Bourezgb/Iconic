<?php
/**
 * Template Hierarchy Fallback
 * Required by WordPress
 */
get_header(); ?>

<main id="primary" class="site-main">
    <div class="container section">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                get_template_part('template-parts/content', get_post_type());
            endwhile;
            
            the_posts_navigation();
        else :
            echo '<p>' . __('لا يوجد محتوى لعرضه حالياً.', 'iconic') . '</p>';
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
