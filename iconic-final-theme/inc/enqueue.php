<?php
/**
 * Enqueue Scripts and Styles
 */

function iconic_scripts() {
    // Main Stylesheet
    wp_enqueue_style('iconic-style', get_stylesheet_uri(), array(), ICONIC_VERSION);

    // Google Fonts (Arabic First)
    wp_enqueue_style('iconic-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;600;700&family=Tajawal:wght@400;700;800&display=swap', array(), null);

    // Main JavaScript (only if file exists)
    if (file_exists(ICONIC_DIR . '/assets/js/main.js')) {
        wp_enqueue_script('iconic-main', ICONIC_URI . '/assets/js/main.js', array(), ICONIC_VERSION, true);
    }

    // Three.js Hero (conditional - only on front page)
    if (is_front_page() && file_exists(ICONIC_DIR . '/assets/js/three-hero.js')) {
        wp_enqueue_script('three-js', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', array(), 'r128', true);
        wp_enqueue_script('iconic-three-hero', ICONIC_URI . '/assets/js/three-hero.js', array('three-js'), ICONIC_VERSION, true);
    }

    // Comment Reply Script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'iconic_scripts');
