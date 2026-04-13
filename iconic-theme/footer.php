</main><!-- #main-content -->

<footer class="site-footer">
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> ICONIC Media. All rights reserved.</p>
        <?php if (has_nav_menu('footer')) : ?>
        <nav class="footer-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'menu_class'     => 'footer-menu',
                'container'      => false,
                'depth'          => 1,
            ));
            ?>
        </nav>
        <?php endif; ?>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
