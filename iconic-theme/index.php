<?php
/**
 * Main template file
 * 
 * @package ICONIC
 * @since 1.0.0
 */

get_header(); ?>

<main class="site-main">
    <div class="container">
        <?php if (have_posts()) : ?>
            
            <div class="article-grid">
                <?php while (have_posts()) : the_post(); ?>
                    
                    <?php get_template_part('template-parts/content', get_post_type()); ?>
                    
                <?php endwhile; ?>
            </div>
            
            <?php iconic_pagination(); ?>
            
        <?php else : ?>
            
            <div class="no-results">
                <h2><?php esc_html_e('No posts found', 'iconic'); ?></h2>
                <p><?php esc_html_e('It seems we can\'t find what you\'re looking for.', 'iconic'); ?></p>
            </div>
            
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
