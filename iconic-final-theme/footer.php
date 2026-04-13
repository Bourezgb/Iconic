<?php
/**
 * Footer Template
 */
?>
<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-column">
                <h4><?php _e('عن ICONIC', 'iconic'); ?></h4>
                <p><?php _e('منصة إعلامية ثقافية جزائرية تحتفي بالأصالة والعصرية والابتكار.', 'iconic'); ?></p>
            </div>
            
            <div class="footer-column">
                <h4><?php _e('الأقسام', 'iconic'); ?></h4>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class' => 'footer-menu',
                    'fallback_cb' => false,
                    'depth' => 1,
                ));
                ?>
            </div>
            
            <div class="footer-column">
                <h4><?php _e('تابعنا', 'iconic'); ?></h4>
                <p><?php _e('انضم إلى مجتمع ICONIC الثقافي.', 'iconic'); ?></p>
            </div>
        </div>
        
        <div class="copyright">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('جميع الحقوق محفوظة.', 'iconic'); ?></p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
