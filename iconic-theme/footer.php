<?php
/**
 * Footer template
 * 
 * @package ICONIC
 * @since 1.0.0
 */
?>

    <footer class="site-footer" id="colophon">
        <div class="container">
            
            <!-- Footer Main -->
            <div class="footer-grid">
                
                <!-- Brand Column -->
                <div class="footer-brand">
                    <div class="site-logo">
                        <?php if (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-text">
                                <?php bloginfo('name'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    
                    <p class="footer-description">
                        <?php esc_html_e('ICONIC - منصة إعلامية جزائرية رقمية تحتفي بالأصالة، العصرية، والابتكار. موطن كل ما هو استثنائي في الثقافة والفن والإعلام.', 'iconic'); ?>
                    </p>
                    
                    <!-- Social Links -->
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                        </a>
                        <a href="#" class="social-link" aria-label="Twitter">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        </a>
                        <a href="#" class="social-link" aria-label="YouTube">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="#fff"/></svg>
                        </a>
                    </div>
                </div>
                
                <!-- Navigation Column 1 -->
                <nav class="footer-nav">
                    <h4><?php esc_html_e('الأقسام', 'iconic'); ?></h4>
                    <ul>
                        <li><a href="<?php echo esc_url(get_category_link(get_cat_ID('ثقافة'))); ?>"><?php esc_html_e('ثقافة', 'iconic'); ?></a></li>
                        <li><a href="<?php echo esc_url(get_category_link(get_cat_ID('سينما'))); ?>"><?php esc_html_e('سينما', 'iconic'); ?></a></li>
                        <li><a href="<?php echo esc_url(get_category_link(get_cat_ID('موسيقى'))); ?>"><?php esc_html_e('موسيقى', 'iconic'); ?></a></li>
                        <li><a href="<?php echo esc_url(get_category_link(get_cat_ID('مسرح'))); ?>"><?php esc_html_e('مسرح', 'iconic'); ?></a></li>
                    </ul>
                </nav>
                
                <!-- Navigation Column 2 -->
                <nav class="footer-nav">
                    <h4><?php esc_html_e('المزيد', 'iconic'); ?></h4>
                    <ul>
                        <li><a href="<?php echo esc_url(get_category_link(get_cat_ID('تاريخ'))); ?>"><?php esc_html_e('تاريخ', 'iconic'); ?></a></li>
                        <li><a href="<?php echo esc_url(get_category_link(get_cat_ID('سياحة'))); ?>"><?php esc_html_e('سياحة', 'iconic'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/interviews')); ?>"><?php esc_html_e('مقابلات', 'iconic'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/videos')); ?>"><?php esc_html_e('فيديو', 'iconic'); ?></a></li>
                    </ul>
                </nav>
                
                <!-- Navigation Column 3 -->
                <nav class="footer-nav">
                    <h4><?php esc_html_e('عن ICONIC', 'iconic'); ?></h4>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/about')); ?>"><?php esc_html_e('من نحن', 'iconic'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact')); ?>"><?php esc_html_e('اتصل بنا', 'iconic'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/privacy')); ?>"><?php esc_html_e('سياسة الخصوصية', 'iconic'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/terms')); ?>"><?php esc_html_e('شروط الاستخدام', 'iconic'); ?></a></li>
                    </ul>
                </nav>
            </div>
            
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p class="copyright">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 
                    <?php esc_html_e('جميع الحقوق محفوظة.', 'iconic'); ?>
                </p>
                
                <div class="footer-bottom-links">
                    <a href="<?php echo esc_url(home_url('/manifesto')); ?>"><?php esc_html_e('بياننا', 'iconic'); ?></a>
                    <span class="separator">|</span>
                    <a href="<?php echo esc_url(home_url('/advertise')); ?>"><?php esc_html_e('إعلان', 'iconic'); ?></a>
                </div>
            </div>
        </div>
    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
