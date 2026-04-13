<?php
/**
 * The main template file
 * Required fallback for all themes
 */
get_header(); ?>

<main id="primary" class="site-main">
    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="content-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('article-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', array('class' => 'card-image')); ?>
                            </a>
                        <?php else : ?>
                            <a href="<?php the_permalink(); ?>">
                                <div class="card-image" style="background: #222; display:flex; align-items:center; justify-content:center; color:#555;">
                                    <?php esc_html_e('ICONIC', 'iconic'); ?>
                                </div>
                            </a>
                        <?php endif; ?>
                        
                        <div class="card-content">
                            <h2 class="card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="card-meta">
                                <span><?php echo get_the_date(); ?></span>
                                <span>|</span>
                                <span><?php echo iconic_get_reading_time(); ?></span>
                            </div>
                            <div class="card-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <?php the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => __('السابق', 'iconic'),
                'next_text' => __('التالي', 'iconic'),
            )); ?>
            
        <?php else : ?>
            <div class="hero-section">
                <h1 class="hero-title"><?php esc_html_e('مرحباً بك في ICONIC', 'iconic'); ?></h1>
                <p class="hero-subtitle"><?php esc_html_e('منصة الإعلام الثقافي الراقي. لا توجد مقالات بعد، ابدأ بإضافة المحتوى من لوحة التحكم.', 'iconic'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
