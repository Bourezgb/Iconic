<?php
/**
 * ICONIC Safe Core - functions.php
 * النسخة الآمنة تماماً: لا تحتوي على أي require_external_files
 * كل الكود موجود هنا مباشرة لضمان عدم حدوث Critical Error
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. إعدادات القالب الأساسية (موجودة هنا مباشرة)
function iconic_safe_setup() {
    // دعم العنوان الديناميكي
    add_theme_support('title-tag');
    
    // دعم الصور البارزة
    add_theme_support('post-thumbnails');
    
    // دعم HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // تسجيل القوائم
    register_nav_menus(array(
        'primary' => __('القائمة الرئيسية', 'iconic'),
        'footer'  => __('قائمة الفوتر', 'iconic'),
    ));
    
    // دعم الشعار المخصص
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'iconic_safe_setup');

// 2. تحميل ملفات CSS و JS (موجود هنا مباشرة)
function iconic_safe_scripts() {
    // تحميل ملف الستايل الرئيسي
    wp_enqueue_style('iconic-style', get_stylesheet_uri(), array(), '1.0.0-safe');
    
    // تحميل خطوط Google (Tajawal للعربية)
    wp_enqueue_style('iconic-fonts', 'https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&display=swap', array(), null);
    
    // JavaScript بسيط للتفاعلات الأساسية (موجود inline لتجنب الملفات الخارجية)
    wp_add_inline_script('jquery', '
        document.addEventListener("DOMContentLoaded", function() {
            console.log("ICONIC Safe Core Loaded Successfully");
            // إضافة أي تفاعلات بسيطة هنا مستقبلاً
        });
    ');
}
add_action('wp_enqueue_scripts', 'iconic_safe_scripts');

// 3. دوال مساعدة أساسية (موجودة هنا مباشرة)
function iconic_get_reading_time($post_id = null) {
    if (!$post_id) $post_id = get_the_ID();
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // 200 كلمة في الدقيقة
    return sprintf(_n('%d دقيقة قراءة', '%d دقائق قراءة', $reading_time, 'iconic'), $reading_time);
}

// 4. دعم Widget Areas (موجود هنا مباشرة)
function iconic_safe_widgets_init() {
    register_sidebar(array(
        'name'          => __('الشريط الجانبي', 'iconic'),
        'id'            => 'sidebar-1',
        'description'   => __('أضف الويدجات هنا', 'iconic'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'iconic_safe_widgets_init');

// 5. ملاحظة للمحرر في لوحة التحكم
function iconic_safe_admin_notice() {
    ?>
    <div class="notice notice-success is-dismissible">
        <h2>✅ تم تفعيل ICONIC Safe Core بنجاح!</h2>
        <p>الموقع يعمل الآن بالنسخة الآمنة المستقرة.</p>
        <p>هذه النسخة تحتوي على الأساسيات فقط لضمان عدم وجود أخطاء.</p>
        <p><strong>الخطوات التالية:</strong></p>
        <ul>
            <li>اذهب إلى مظهر > قوائم وأنشئ القوائم الرئيسية.</li>
            <li>اذهب إلى إعدادات > قراءة واضبط الصفحة الرئيسية.</li>
            <li>ابدأ بإضافة مقالاتك الأولى.</li>
        </ul>
    </div>
    <?php
}
add_action('admin_notices', 'iconic_safe_admin_notice');

// 6. منع الأخطاء حتى مع غياب الإضافات
// لا يوجد أي استدعاء لـ ACF أو إضافات أخرى هنا لضمان الاستقرار 100%
