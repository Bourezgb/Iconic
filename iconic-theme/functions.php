<?php
/**
 * ICONIC Theme Functions - AUTO SETUP v4.0
 * 
 * يقوم بالإعداد التلقائي للموقع عند التفعيل:
 * - يضبط الروابط الدائمة
 * - ينشئ الصفحات الأساسية
 * - ينشئ القوائم
 * - لا يحتاج أي تدخل يدوي
 * 
 * @package ICONIC
 * @version 4.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

define('ICONIC_VERSION', '4.0.0');
define('ICONIC_DIR', get_template_directory());
define('ICONIC_URI', get_template_directory_uri());

/**
 * Safe File Loader
 */
function iconic_include_safe($file_slug) {
    $path = ICONIC_DIR . '/inc/' . $file_slug . '.php';
    if (file_exists($path)) {
        require_once $path;
        return true;
    }
    error_log('ICONIC: File missing - ' . basename($path));
    return false;
}

/**
 * Auto-Setup Wizard - يعمل مرة واحدة عند التفعيل
 */
register_activation_hook(__FILE__, 'iconic_auto_setup_wizard');

function iconic_auto_setup_wizard() {
    // 1. ضبط الروابط الدائمة (يحل مشكلة WP Popular Posts)
    update_option('permalink_structure', '/%postname%/');
    flush_rewrite_rules();
    
    // 2. إنشاء الصفحات الأساسية
    $pages = [
        ['title' => 'من نحن', 'slug' => 'about', 'content' => ''],
        ['title' => 'اتصل بنا', 'slug' => 'contact', 'content' => ''],
        ['title' => 'سياسة الخصوصية', 'slug' => 'privacy', 'content' => ''],
        ['title' => 'فريق التحرير', 'slug' => 'team', 'content' => '']
    ];
    
    foreach ($pages as $page) {
        if (!get_page_by_path($page['slug'])) {
            wp_insert_post([
                'post_title'   => $page['title'],
                'post_name'    => $page['slug'],
                'post_content' => $page['content'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_author'  => 1
            ]);
        }
    }
    
    // 3. تعيين الصفحة الرئيسية لعرض آخر المقالات (ليعمل front-page.php)
    update_option('show_on_front', 'posts');
    
    // 4. إخفاء إشعارات ووردبريس المزعجة
    update_option('dismissed_wp_pointers', ['wp460', 'wp470', 'wp480']);
}

/**
 * Basic Theme Setup
 */
function iconic_basic_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', [
        'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'
    ]);
    
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    
    register_nav_menus([
        'primary' => __('القائمة الرئيسية', 'iconic'),
        'footer'  => __('قائمة الفوتر', 'iconic'),
    ]);
    
    load_theme_textdomain('iconic', ICONIC_DIR . '/languages');
}
add_action('after_setup_theme', 'iconic_basic_setup');

/**
 * Enqueue Assets
 */
function iconic_enqueue_assets() {
    wp_enqueue_style('iconic-style', get_stylesheet_uri(), [], ICONIC_VERSION);
    
    wp_enqueue_style(
        'iconic-fonts',
        'https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;700&display=swap',
        [],
        null
    );
}
add_action('wp_enqueue_scripts', 'iconic_enqueue_assets');

/**
 * Widgets
 */
function iconic_widgets_init() {
    register_sidebar([
        'name'          => __('الشريط الجانبي', 'iconic'),
        'id'            => 'sidebar-1',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);
}
add_action('widgets_init', 'iconic_widgets_init');

/**
 * Helper Functions
 */
function iconic_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'iconic_excerpt_length');

function iconic_body_classes($classes) {
    if (is_singular()) $classes[] = 'singular';
    if (is_front_page()) $classes[] = 'front-page';
    return $classes;
}
add_filter('body_class', 'iconic_body_classes');

// Fallback for ACF
if (!function_exists('get_field')) {
    function get_field($selector, $post_id = false) {
        return false;
    }
}
