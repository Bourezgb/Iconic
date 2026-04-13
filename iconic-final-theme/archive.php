<?php
/**
 * Archive Template
 */
get_header();
?>

<main id="primary" class="site-main">
    <div class="container section">
        <header class="archive-header">
            <h1 class="archive-title">
                <?php
                if (is_category()) {
                    single_cat_title();
                } elseif (is_tag()) {
                    single_tag_title();
                } elseif (is_author()) {
                    the_author();
                } elseif (is_year()) {
                    echo get_the_date('Y');
                } elseif (is_month()) {
                    echo get_the_date('F Y');
                } elseif (is_day()) {
                    echo get_the_date('F j, Y');
                } elseif (is_post_type_archive('video')) {
                    _e('فيديو', 'iconic');
                } elseif (is_post_type_archive('interview')) {
                    _e('مقابلات', 'iconic');
                } else {
                    _e('أرشيف', 'iconic');
                }
                ?>
            </h1>
            
            <?php
            $archive_description = get_term_description(get_queried_object_id());
            if ($archive_description) :
                ?>
                <p class="archive-description"><?php echo wp_kses_post($archive_description); ?></p>
            <?php endif; ?>
        </header>

        <div class="articles-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    iconic_article_card();
                endwhile;
                
                the_posts_pagination(array(
                    'prev_text' => __('السابق', 'iconic'),
                    'next_text' => __('التالي', 'iconic'),
                ));
            else :
                echo '<p>' . __('لا يوجد محتوى في هذا الأرشيف.', 'iconic') . '</p>';
            endif;
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
