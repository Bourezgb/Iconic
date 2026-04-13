<?php
/**
 * Setup Theme Basics
 */

if (!function_exists('iconic_setup')) {
    function iconic_setup() {
        // Load text domain
        load_theme_textdomain('iconic', ICONIC_DIR . '/languages');

        // Add default posts and comments RSS feed links to head
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1200, 675, true);

        // Custom Logo
        add_theme_support('custom-logo', array(
            'height' => 100,
            'width' => 300,
            'flex-height' => true,
            'flex-width' => true,
        ));

        // HTML5 support
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ));

        // Register Navigation Menus
        register_nav_menus(array(
            'primary' => __('القائمة الرئيسية', 'iconic'),
            'footer' => __('قائمة الفوتر', 'iconic'),
            'mobile' => __('قائمة الجوال', 'iconic'),
        ));

        // Content Width
        if (!isset($content_width)) {
            $content_width = 1200;
        }
    }
    add_action('after_setup_theme', 'iconic_setup');
}

// Register Sidebars
function iconic_widgets_init() {
    register_sidebar(array(
        'name' => __('الشريط الجانبي', 'iconic'),
        'id' => 'sidebar-1',
        'description' => __('أضف ودجات هنا.', 'iconic'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'iconic_widgets_init');
