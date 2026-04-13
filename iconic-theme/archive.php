<?php get_header(); ?>

<main class="site-main archive-page">
    <div class="container">
        
        <!-- Archive Header -->
        <header class="archive-header">
            <?php
            the_archive_title('<h1 class="archive-title">', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
            ?>
        </header>
        
        <!-- Archive Grid -->
        <?php if (have_posts()) : ?>
            
            <div class="article-grid">
                <?php while (have_posts()) : the_post(); ?>
                    
                    <?php get_template_part('template-parts/content', get_post_type()); ?>
                    
                <?php endwhile; ?>
            </div>
            
            <?php iconic_pagination(); ?>
            
        <?php else : ?>
            
            <div class="no-results">
                <h2><?php esc_html_e('لا توجد مقالات', 'iconic'); ?></h2>
                <p><?php esc_html_e('لم يتم العثور على أي محتوى في هذا القسم.', 'iconic'); ?></p>
            </div>
            
        <?php endif; ?>
        
    </div>
</main>

<?php get_footer(); ?>
