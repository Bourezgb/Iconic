<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <h3><?php esc_html_e('عن ICONIC', 'iconic'); ?></h3>
                <p style="color: #888; line-height: 1.6;">
                    <?php esc_html_e('منصة إعلامية جزائرية رقمية تحتفي بالأصالة، العصرية، والابتكار في الفن والثقافة.', 'iconic'); ?>
                </p>
            </div>
            
            <div class="footer-col">
                <h3><?php esc_html_e('الأقسام', 'iconic'); ?></h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_id'        => 'footer-menu',
                    'fallback_cb'    => false,
                    'container'      => false,
                    'depth'          => 1,
                ));
                ?>
            </div>
            
            <div class="footer-col">
                <h3><?php esc_html_e('تواصل معنا', 'iconic'); ?></h3>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 10px;">
                        <a href="mailto:contact@iconictv.tv" style="color: #888;">contact@iconictv.tv</a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="copyright">
            &copy; <?php echo date('Y'); ?> ICONIC. <?php esc_html_e('جميع الحقوق محفوظة.', 'iconic'); ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
