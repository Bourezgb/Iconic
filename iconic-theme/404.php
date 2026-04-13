<?php
/**
 * 404 Error Page Template
 */
get_header();
?>

<main id="primary" class="site-main">
    <div class="container section" style="text-align: center; padding: 100px 0;">
        <h1 style="font-size: 8rem; color: var(--color-accent-cyan); margin-bottom: 0;">404</h1>
        <h2><?php _e('الصفحة غير موجودة', 'iconic'); ?></h2>
        <p><?php _e('عذراً، الصفحة التي تبحث عنها غير موجودة أو تم نقلها.', 'iconic'); ?></p>
        
        <div style="margin-top: 40px;">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="button" style="display: inline-block; background: linear-gradient(135deg, var(--color-accent-cyan), var(--color-accent-violet)); color: #fff; padding: 15px 40px; border-radius: 50px; text-decoration: none; font-weight: 600;">
                <?php _e('العودة للرئيسية', 'iconic'); ?>
            </a>
        </div>
    </div>
</main>

<?php
get_footer();
