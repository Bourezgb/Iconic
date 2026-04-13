<?php
/**
 * ICONIC Theme - Safe Core Functions
 * 
 * @package ICONIC
 * @version 1.0.3-safe
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

define('ICONIC_VERSION', '1.0.3');
define('ICONIC_DIR', get_template_directory());
define('ICONIC_URI', get_template_directory_uri());

/**
 * Safe File Loader
 * Checks if file exists before including. Prevents Critical Errors.
 */
function iconic_include_safe($file_slug) {
    $path = ICONIC_DIR . '/inc/' . $file_slug . '.php';
    
    if (file_exists($path)) {
        require_once $path;
        return true;
    } else {
        // Log error for developer
        error_log('ICONIC Theme Warning: Missing file - ' . $path);
        
        // Show admin notice only if user can manage options
        if (is_admin() && current_user_can('manage_options')) {
            add_action('admin_notices', function() use ($file_slug, $path) {
                echo '<div class="notice notice-warning is-dismissible">';
                echo '<h3>⚠️ ICONIC Theme Setup Warning</h3>';
                echo '<p>The file <code>' . esc_html(basename($path)) . '</code> is missing.</p>';
                echo '<p>The theme will still work with basic features.</p>';
                echo '</div>';
            });
        }
        return false;
    }
}

// --- Load Core Files Safely ---
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

// --- Fallback Support if setup.php is missing ---
if (!function_exists('iconic_setup')) {
    function iconic_fallback_setup() {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'iconic'),
            'footer'  => __('Footer Menu', 'iconic'),
        ));
    }
    add_action('after_setup_theme', 'iconic_fallback_setup');
}
