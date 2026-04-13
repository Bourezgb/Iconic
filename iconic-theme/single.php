<?php
/**
 * Single Post Template
 */
get_header();
?>

<main id="primary" class="site-main">
    <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
        <header class="single-post-header">
            <?php iconic_categories_badge(); ?>
            
            <h1 class="post-title"><?php the_title(); ?></h1>
            
            <?php iconic_post_meta(); ?>
            
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-featured-image">
                    <?php the_post_thumbnail('large', array('loading' => 'eager')); ?>
                </div>
            <?php endif; ?>
        </header>

        <div class="post-content">
            <?php
            // Display ad at top if exists
            iconic_display_ad('article_top_ad');
            
            the_content();
            
            // Display ad at bottom if exists
            iconic_display_ad('article_bottom_ad');
            ?>
        </div>

        <footer class="entry-footer">
            <?php
            // Tags
            $tags = get_the_tags();
            if ($tags) {
                echo '<div class="post-tags"><h3>' . __('الوسوم', 'iconic') . '</h3>';
                foreach ($tags as $tag) {
                    echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="tag-link">' . esc_html($tag->name) . '</a>';
                }
                echo '</div>';
            }
            
            // Author box
            ?>
            <div class="author-box">
                <h4><?php _e('عن الكاتب', 'iconic'); ?></h4>
                <p><?php echo get_the_author_meta('display_name'); ?></p>
                <p><?php echo get_the_author_meta('description'); ?></p>
            </div>
            
            // Related posts
            $categories = get_the_category();
            if ($categories) {
                $category_ids = array();
                foreach ($categories as $category) {
                    $category_ids[] = $category->term_id;
                }
                
                $related_args = array(
                    'category__in' => $category_ids,
                    'post__not_in' => array(get_the_ID()),
                    'posts_per_page' => 3,
                    'post_status' => 'publish',
                );
                
                $related_query = new WP_Query($related_args);
                
                if ($related_query->have_posts()) :
                    ?>
                    <div class="related-posts">
                        <h3><?php _e('مقالات ذات صلة', 'iconic'); ?></h3>
                        <div class="articles-grid">
                            <?php
                            while ($related_query->have_posts()) : $related_query->the_post();
                                iconic_article_card();
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                    <?php
                endif;
            }
            ?>
        </footer>
    </article>
    
    <?php
    // Comments
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
    ?>
</main>

<?php
get_footer();
