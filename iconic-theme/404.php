<?php
/**
 * 404 Error Page
 */

get_header();
?>

<div class="container" style="min-height: 60vh; display: flex; align-items: center; justify-content: center; text-align: center;">
    <div>
        <h1 class="text-gradient" style="font-size: clamp(3rem, 10vw, 8rem); margin-bottom: 1rem; line-height: 1;">404</h1>
        <h2><?php _e('Page Not Found', 'iconic'); ?></h2>
        <p style="color: #a0a0b0; font-size: 1.2rem; margin-bottom: 2rem;">
            <?php _e('The page you are looking for does not exist or has been moved.', 'iconic'); ?>
        </p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">
            <?php _e('Back to Home', 'iconic'); ?>
        </a>
    </div>
</div>

<?php
get_footer();
