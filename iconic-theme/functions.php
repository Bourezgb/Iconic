<?php
/**
 * ICONIC Theme Functions - SAFE CORE v3.0
 * 
 * Minimal, safe, no dependencies. Just works.
 * 
 * @package ICONIC
 * @version 3.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

define('ICONIC_VERSION', '3.0.0');
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
    }
    
    // Silently fail - no errors shown to users
    error_log('ICONIC: Optional file missing - ' . basename($path));
    return false;
}

/**
 * Basic Theme Setup (Built-in, no external files needed)
 */
function iconic_basic_setup() {
    // Core support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array(
        'comment-list',
        'comment-form', 
        'search-form',
        'gallery',
        'caption'
    ));
    
    // Custom Logo
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'iconic'),
        'footer'  => __('Footer Menu', 'iconic'),
    ));
    
    // RTL Support (Automatic in WP)
    load_theme_textdomain('iconic', ICONIC_DIR . '/languages');
}
add_action('after_setup_theme', 'iconic_basic_setup');

/**
 * Enqueue Styles & Scripts
 */
function iconic_enqueue_assets() {
    // Main stylesheet
    wp_enqueue_style(
        'iconic-style',
        get_stylesheet_uri(),
        array(),
        ICONIC_VERSION
    );
    
    // Google Fonts (Arabic First)
    wp_enqueue_style(
        'iconic-fonts',
        'https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;700&display=swap',
        array(),
        null
    );
    
    // No JS for now - pure CSS theme
}
add_action('wp_enqueue_scripts', 'iconic_enqueue_assets');

/**
 * Register Widget Areas (Optional)
 */
function iconic_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'iconic'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'iconic'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'iconic_widgets_init');

/**
 * Custom Excerpt Length
 */
function iconic_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'iconic_excerpt_length');

/**
 * Add Body Classes
 */
function iconic_body_classes($classes) {
    if (is_singular()) {
        $classes[] = 'singular';
    }
    if (is_front_page()) {
        $classes[] = 'front-page';
    }
    return $classes;
}
add_filter('body_class', 'iconic_body_classes');

/**
 * Fallback for when ACF is not active
 */
if (!function_exists('get_field')) {
    function get_field($selector, $post_id = false) {
        return false;
    }
}

// That's it! No complex includes. No critical errors.
// Future features can be added safely via iconic_include_safe()
