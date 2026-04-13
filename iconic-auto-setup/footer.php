<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <h4>عن ICONIC</h4>
                <p style="color: #a0a0b0; line-height: 1.8;">
                    منصة إعلامية جزائرية رقمية تحتفي بالأصالة، العصرية، والابتكار.
                </p>
            </div>
            
            <div class="footer-col">
                <h4>الأقسام</h4>
                <ul>
                    <li><a href="<?php echo get_category_link(get_cat_ID('ثقافة')); ?>">ثقافة</a></li>
                    <li><a href="<?php echo get_category_link(get_cat_ID('سينما')); ?>">سينما</a></li>
                    <li><a href="<?php echo get_category_link(get_cat_ID('موسيقى')); ?>">موسيقى</a></li>
                    <li><a href="<?php echo get_category_link(get_cat_ID('مقابلات')); ?>">مقابلات</a></li>
                </ul>
            </div>
            
            <div class="footer-col">
                <h4>روابط سريعة</h4>
                <ul>
                    <li><a href="<?php echo get_page_link(get_page_by_path('about')); ?>">من نحن</a></li>
                    <li><a href="<?php echo get_page_link(get_page_by_path('contact')); ?>">اتصل بنا</a></li>
                    <li><a href="<?php echo get_page_link(get_page_by_path('privacy')); ?>">سياسة الخصوصية</a></li>
                </ul>
            </div>
        </div>
        
        <div class="copyright">
            &copy; <?php echo date('Y'); ?> ICONIC. جميع الحقوق محفوظة.
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
