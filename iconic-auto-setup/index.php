<?php
/**
 * The main template file
 */
get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="content-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="article-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', array('class' => 'card-image')); ?>
                            </a>
                        <?php else: ?>
                            <div class="card-image" style="background: #2a2a35;"></div>
                        <?php endif; ?>
                        
                        <div class="card-content">
                            <span class="card-category">
                                <?php $cats = get_the_category(); echo $cats[0]->name ?? 'عام'; ?>
                            </span>
                            <h2 class="card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                            <div class="card-meta">
                                <span><?php echo get_the_date(); ?></span>
                                <span><?php echo iconic_get_reading_time(get_the_content()); ?> قراءة</span>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <div class="hero-section">
                <h1 class="hero-title">مرحباً بك في ICONIC</h1>
                <p class="hero-subtitle">منصة الثقافة والفن والإعلام الراقي</p>
                <p style="color: #a0a0b0; margin-bottom: 30px;">لا توجد مقالات بعد. ابدأ بإضافة محتواك الأول!</p>
                <?php if (current_user_can('edit_posts')) : ?>
                    <a href="<?php echo admin_url('post-new.php'); ?>" class="btn-primary">أضف مقالاً جديداً</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
