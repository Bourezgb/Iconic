<?php get_header(); ?>

<main class="site-main search-page">
    <div class="container">
        
        <!-- Search Header -->
        <header class="archive-header">
            <h1 class="archive-title">
                <?php esc_html_e('نتائج البحث عن', 'iconic'); ?> 
                <span class="text-gradient">"<?php echo get_search_query(); ?>"</span>
            </h1>
        </header>
        
        <!-- Search Form -->
        <div class="search-form-large">
            <?php get_search_form(); ?>
        </div>
        
        <!-- Results -->
        <?php if (have_posts()) : ?>
            
            <p class="search-results-count">
                <?php 
                printf(
                    esc_html(_n('%d نتيجة', '%d نتائج', $wp_query->found_posts, 'iconic')),
                    $wp_query->found_posts
                );
                ?>
            </p>
            
            <div class="article-grid">
                <?php while (have_posts()) : the_post(); ?>
                    
                    <?php get_template_part('template-parts/content', 'search'); ?>
                    
                <?php endwhile; ?>
            </div>
            
            <?php iconic_pagination(); ?>
            
        <?php else : ?>
            
            <div class="no-results">
                <h2><?php esc_html_e('لا توجد نتائج', 'iconic'); ?></h2>
                <p><?php esc_html_e('لم نتمكن من العثور على أي محتوى مطابق لبحثك. حاول استخدام كلمات مفتاحية مختلفة.', 'iconic'); ?></p>
            </div>
            
        <?php endif; ?>
        
    </div>
</main>

<?php get_footer(); ?>
