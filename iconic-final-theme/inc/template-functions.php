<?php
/**
 * Template Functions for Display
 */

// Display post meta
if (!function_exists('iconic_post_meta')) {
    function iconic_post_meta() {
        ?>
        <div class="post-meta">
            <span class="post-author"><?php the_author(); ?></span>
            <span class="post-date"><?php echo get_the_date(); ?></span>
            <span class="reading-time"><?php echo iconic_get_reading_time(); ?></span>
        </div>
        <?php
    }
}

// Display categories
if (!function_exists('iconic_categories_badge')) {
    function iconic_categories_badge() {
        $categories = iconic_get_categories();
        
        if (!empty($categories)) :
            ?>
            <div class="post-categories">
                <?php foreach ($categories as $category) : ?>
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="category-badge">
                        <?php echo esc_html($category->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php
        endif;
    }
}

// Display article card
if (!function_exists('iconic_article_card')) {
    function iconic_article_card($post_id = null) {
        if (!$post_id) {
            $post_id = get_the_ID();
        }
        
        setup_postdata($post_id);
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('article-card'); ?>>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo iconic_get_featured_image('medium'); ?>" alt="<?php the_title_attribute(); ?>" class="article-card-image" loading="lazy">
            </a>
            <div class="article-card-content">
                <div class="article-card-category">
                    <?php 
                    $cats = iconic_get_categories();
                    if (!empty($cats)) {
                        echo esc_html($cats[0]->name);
                    }
                    ?>
                </div>
                <h3 class="article-card-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <div class="article-card-meta">
                    <span><?php echo get_the_date(); ?></span>
                    <span><?php echo iconic_get_reading_time($post_id); ?></span>
                </div>
            </div>
        </article>
        <?php
        wp_reset_postdata();
    }
}
