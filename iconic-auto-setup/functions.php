<?php
/**
 * ICONIC Auto-Setup Theme
 * يعمل فور التفعيل - يضبط كل شيء تلقائياً
 */

if (!defined('ABSPATH')) exit;

define('ICONIC_VERSION', '4.0');

// 1. إعدادات أساسية آمنة
function iconic_auto_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-list', 'gallery', 'caption'));
    
    // تسجيل القوائم
    register_nav_menus(array(
        'primary' => __('القائمة الرئيسية', 'iconic'),
        'footer'  => __('قائمة الفوتر', 'iconic'),
    ));
}
add_action('after_setup_theme', 'iconic_auto_setup');

// 2. تحميل الخطوط والأنماط
function iconic_auto_enqueue() {
    // Google Fonts: Tajawal
    wp_enqueue_style('iconic-fonts', 'https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;700&display=swap', array(), null);
    
    // Main Style
    wp_enqueue_style('iconic-style', get_stylesheet_uri(), array('iconic-fonts'), ICONIC_VERSION);
}
add_action('wp_enqueue_scripts', 'iconic_auto_enqueue');

// 3. الضبط التلقائي عند التفعيل (السحر الحقيقي)
function iconic_auto_activate() {
    // أ. ضبط الروابط الدائمة تلقائياً
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
    $wp_rewrite->flush_rules();
    
    // ب. إنشاء الصفحات الأساسية إذا لم تكن موجودة
    $pages = array(
        'home' => 'الرئيسية',
        'about' => 'من نحن',
        'contact' => 'اتصل بنا',
        'privacy' => 'سياسة الخصوصية'
    );
    
    foreach ($pages as $slug => $title) {
        if (!get_page_by_path($slug)) {
            $page_id = wp_insert_post(array(
                'post_title'   => $title,
                'post_name'    => $slug,
                'post_content' => 'محتوى صفحة ' . $title . ' سيتم إضافته لاحقاً.',
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_author'  => 1
            ));
            
            // تعيين الصفحة الرئيسية
            if ($slug === 'home') {
                update_option('show_on_front', 'page');
                update_option('page_on_front', $page_id);
            }
        }
    }
    
    // ج. إنشاء قائمة رئيسية تلقائية
    $menu_name = 'Primary Menu';
    $menu_exists = wp_get_nav_menu_object($menu_name);
    
    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);
        
        // إضافة روابط للقائمة
        $home_page = get_page_by_path('home');
        $about_page = get_page_by_path('about');
        
        if ($home_page) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title'     => 'الرئيسية',
                'menu-item-object-id' => $home_page->ID,
                'menu-item-object'    => 'page',
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish'
            ));
        }
        
        if ($about_page) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title'     => 'من نحن',
                'menu-item-object-id' => $about_page->ID,
                'menu-item-object'    => 'page',
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish'
            ));
        }
        
        // تعيين القائمة للموقع
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
    
    // د. إنشاء تصنيفات افتراضية
    $categories = array('ثقافة', 'سينما', 'موسيقى', 'مقابلات');
    foreach ($categories as $cat) {
        if (!term_exists($cat, 'category')) {
            wp_insert_term($cat, 'category');
        }
    }
    
    // هـ. رسالة ترحيب في لوحة التحكم
    set_transient('iconic_welcome_notice', true, 5);
}
register_activation_hook(__FILE__, 'iconic_auto_activate');

// 4. عرض رسالة الترحيب
function iconic_welcome_notice() {
    if (get_transient('iconic_welcome_notice')) {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<h2>🎉 تم تفعيل ICONIC بنجاح!</h2>';
        echo '<p>تم ضبط الموقع تلقائياً:</p>';
        echo '<ul style="list-style: disc; margin-right: 20px;">';
        echo '<li>✅ الروابط الدائمة مضبوطة على "اسم المقالة"</li>';
        echo '<li>✅ الصفحة الرئيسية جاهزة</li>';
        echo '<li>✅ القائمة الرئيسية تم إنشاؤها</li>';
        echo '<li>✅ التصنيفات الأساسية متوفرة</li>';
        echo '</ul>';
        echo '<p><strong>الخطوة التالية:</strong> ابدأ بإضافة مقالاتك الأولى واستمتع بالتصميم!</p>';
        echo '</div>';
        delete_transient('iconic_welcome_notice');
    }
}
add_action('admin_notices', 'iconic_welcome_notice');

// 5. دوال مساعدة
function iconic_get_reading_time($content = '') {
    $words = str_word_count(strip_tags($content));
    $minutes = floor($words / 200);
    return ($minutes < 1) ? 'دقيقة واحدة' : $minutes . ' دقائق';
}
