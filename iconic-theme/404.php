<?php get_header(); ?>

<div class="error-404">
    <div class="container">
        <div class="error-content">
            <h1>404</h1>
            <p><?php esc_html_e('الصفحة التي تبحث عنها غير موجودة أو تم نقلها', 'iconic'); ?></p>
            <div class="error-cta">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <?php esc_html_e('العودة للرئيسية', 'iconic'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/blog')); ?>" class="btn btn-secondary">
                    <?php esc_html_e('تصفح المقالات', 'iconic'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
