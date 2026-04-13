</main>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <h4>ICONIC</h4>
                <p style="color: #a0a0b0; font-size: 0.9rem;">
                    منصة إعلامية جزائرية رقمية تحتفي بالأصالة، العصرية، والابتكار.
                </p>
            </div>
            
            <div class="footer-col">
                <h4><?php _e('Sections', 'iconic'); ?></h4>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class'     => '',
                    'fallback_cb'    => false,
                    'depth'          => 1,
                ));
                ?>
            </div>
            
            <div class="footer-col">
                <h4><?php _e('Follow Us', 'iconic'); ?></h4>
                <div style="display: flex; gap: 1rem;">
                    <a href="#" aria-label="Facebook">F</a>
                    <a href="#" aria-label="Twitter">T</a>
                    <a href="#" aria-label="Instagram">I</a>
                    <a href="#" aria-label="YouTube">Y</a>
                </div>
            </div>
        </div>
        
        <div class="copyright-bar">
            <p>&copy; <?php echo date('Y'); ?> ICONIC. <?php _e('All rights reserved.', 'iconic'); ?></p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
