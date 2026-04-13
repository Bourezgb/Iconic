<?php
/**
 * Front Page Template
 */
get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title"><?php bloginfo('name'); ?></h1>
                <p class="hero-subtitle"><?php _e('حيث تلتقي الثقافة بالإبداع', 'iconic'); ?></p>
            </div>
        </div>
    </section>

    <!-- Latest Articles Section -->
    <section class="section">
        <div class="container">
            <h2><?php _e('أحدث المقالات', 'iconic'); ?></h2>
            <div class="articles-grid">
                <?php
                $latest_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'post_status' => 'publish',
                );
                
                $latest_query = new WP_Query($latest_args);
                
                if ($latest_query->have_posts()) :
                    while ($latest_query->have_posts()) : $latest_query->the_post();
                        iconic_article_card();
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>' . __('لا توجد مقالات حالياً.', 'iconic') . '</p>';
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Videos Section (if CPT exists) -->
    <section class="section">
        <div class="container">
            <h2><?php _e('فيديو', 'iconic'); ?></h2>
            <div class="articles-grid">
                <?php
                $video_args = array(
                    'post_type' => 'video',
                    'posts_per_page' => 4,
                    'post_status' => 'publish',
                );
                
                $video_query = new WP_Query($video_args);
                
                if ($video_query->have_posts()) :
                    while ($video_query->have_posts()) : $video_query->the_post();
                        iconic_article_card();
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>' . __('لا توجد فيديوهات حالياً.', 'iconic') . '</p>';
                endif;
                ?>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
