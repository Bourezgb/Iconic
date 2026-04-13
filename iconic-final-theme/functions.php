<?php
/**
 * ICONIC Theme Functions - Safe Core
 * 
 * @package ICONIC
 * @version 1.0.2-safe
 */

if (!defined('ABSPATH')) {
    exit;
}

define('ICONIC_VERSION', '1.0.2');
define('ICONIC_DIR', get_template_directory());
define('ICONIC_URI', get_template_directory_uri());

/**
 * Safe File Loader - Prevents Critical Errors
 */
function iconic_include_safe($file_slug) {
    $path = ICONIC_DIR . '/inc/' . $file_slug . '.php';
    
    if (file_exists($path)) {
        require_once $path;
        return true;
    } else {
        error_log('ICONIC Theme: Missing file - ' . $file_slug . '.php');
        if (current_user_can('manage_options')) {
            add_action('admin_notices', function() use ($file_slug) {
                echo '<div class="notice notice-warning is-dismissible"><p><strong>ICONIC Theme:</strong> ملف <code>' . esc_html($file_slug) . '.php</code> غير موجود. سيعمل القالب بالوضع الأساسي.</p></div>';
            });
        }
        return false;
    }
}

// Load core files safely
iconic_include_safe('setup');
iconic_include_safe('enqueue');
iconic_include_safe('theme-support');
iconic_include_safe('core-setup');
iconic_include_safe('helpers');
iconic_include_safe('template-functions');
iconic_include_safe('seo');
iconic_include_safe('ad-manager');
iconic_include_safe('blocks');
iconic_include_safe('navigation');

// Fallback basic support if setup.php is missing
if (!function_exists('iconic_setup')) {
    function iconic_fallback_setup() {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('custom-logo');
        add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
        register_nav_menus(array(
            'primary' => __('القائمة الرئيسية', 'iconic'),
            'footer' => __('قائمة الفوتر', 'iconic'),
        ));
    }
    add_action('after_setup_theme', 'iconic_fallback_setup');
}
