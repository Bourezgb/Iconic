<?php
/**
 * ICONIC Safe Core - Functions
 * Absolute minimal code to prevent ANY critical errors
 */

// No external file includes. Everything is here.

function iconic_safe_setup() {
    // Basic theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));
    
    // Register ONE menu
    register_nav_menus(array(
        'primary' => __('القائمة الرئيسية', 'iconic')
    ));
}
add_action('after_setup_theme', 'iconic_safe_setup');

function iconic_safe_scripts() {
    // Load only the main stylesheet
    wp_enqueue_style('iconic-style', get_stylesheet_uri(), array(), '1.0.0-safe');
}
add_action('wp_enqueue_scripts', 'iconic_safe_scripts');

// That's it. Nothing else. No CPTs, no ACF, no complex logic.
// This guarantees NO critical errors.
