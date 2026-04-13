<?php
/**
 * Theme Support Features
 * 
 * @package ICONIC
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add custom image filter for lazy loading
 */
function iconic_lazy_load_images($content) {
    $pattern = '/<img(.*?)src=[\'"](.*?)[\'"](.*?)>/i';
    $replacement = '<img$1src="$2"$3 loading="lazy">';
    return preg_replace($pattern, $replacement, $content);
}
add_filter('the_content', 'iconic_lazy_load_images', 999);

/**
 * Add responsive images support
 */
function iconic_responsive_images($sizes, $size, $image_src, $image_meta, $attachment_id) {
    if (empty($image_meta['width']) || empty($image_meta['height'])) {
        return $sizes;
    }
    
    $width = $image_meta['width'];
    $height = $image_meta['height'];
    
    if ($width <= 680) {
        $sizes = '(max-width: 768px) 100vw, 680px';
    } elseif ($width <= 1200) {
        $sizes = '(max-width: 1440px) 50vw, 1200px';
    } else {
        $sizes = '(max-width: 1440px) 100vw, 1920px';
    }
    
    return $sizes;
}
add_filter('wp_calculate_image_sizes', 'iconic_responsive_images', 10, 5);

/**
 * Custom excerpt length
 */
function iconic_excerpt_length($length) {
    if (is_admin()) {
        return $length;
    }
    return 25;
}
add_filter('excerpt_length', 'iconic_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function iconic_excerpt_more($more) {
    if (is_admin()) {
        return $more;
    }
    return '&hellip;';
}
add_filter('excerpt_more', 'iconic_excerpt_more', 999);

/**
 * Add body classes for specific pages
 */
function iconic_body_classes($classes) {
    // Add class if single post
    if (is_singular()) {
        $classes[] = 'singular';
    }
    
    // Add class if front page
    if (is_front_page()) {
        $classes[] = 'front-page-custom';
    }
    
    // Add class for RTL
    if (is_rtl()) {
        $classes[] = 'rtl-enabled';
    }
    
    // Add browser detection classes (via JS later)
    $classes[] = 'no-js';
    
    return $classes;
}
add_filter('body_class', 'iconic_body_classes');

/**
 * Remove unnecessary WordPress head elements for performance
 */
function iconic_cleanup_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
}
add_action('init', 'iconic_cleanup_head');

/**
 * Remove emoji scripts for performance
 */
function iconic_remove_emoji_scripts() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'iconic_remove_emoji_scripts');

/**
 * Add preconnect to Google Fonts
 */
function iconic_google_fonts_preconnect($html, $url) {
    if (strpos($url, 'fonts.googleapis.com') !== false) {
        $html = '<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />' . "\n" . $html;
    }
    return $html;
}
add_filter('style_loader_tag', 'iconic_google_fonts_preconnect', 10, 2);

/**
 * Custom login page styling
 */
function iconic_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'iconic_login_logo_url');

function iconic_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter('login_headertitle', 'iconic_login_logo_url_title');

/**
 * Add custom admin footer text
 */
function iconic_admin_footer_text($footer_text) {
    $footer_text = sprintf(
        __('Thank you for using <strong>ICONIC</strong> theme. | <a href="%s" target="_blank">Documentation</a>', 'iconic'),
        'https://iconic.dz/docs'
    );
    return $footer_text;
}
add_filter('admin_footer_text', 'iconic_admin_footer_text');

/**
 * Custom dashboard widget
 */
function iconic_dashboard_widget() {
    wp_add_dashboard_widget(
        'iconic_dashboard_widget',
        __('ICONIC Quick Actions', 'iconic'),
        'iconic_dashboard_widget_content'
    );
}
add_action('wp_dashboard_setup', 'iconic_dashboard_widget');

function iconic_dashboard_widget_content() {
    echo '<div style="padding: 10px;">';
    echo '<p><strong>' . __('Welcome to ICONIC Platform', 'iconic') . '</strong></p>';
    echo '<ul style="list-style: none; padding: 0;">';
    echo '<li style="margin-bottom: 8px;">📝 <a href="' . admin_url('post-new.php') . '">' . __('New Article', 'iconic') . '</a></li>';
    echo '<li style="margin-bottom: 8px;">🎬 <a href="' . admin_url('edit.php?post_type=video') . '">' . __('Manage Videos', 'iconic') . '</a></li>';
    echo '<li style="margin-bottom: 8px;">👤 <a href="' . admin_url('edit.php?post_type=interview') . '">' . __('Interviews', 'iconic') . '</a></li>';
    echo '<li style="margin-bottom: 8px;">⚙️ <a href="' . admin_url('themes.php?page=iconic-options') . '">' . __('Theme Options', 'iconic') . '</a></li>';
    echo '</ul>';
    echo '</div>';
}

/**
 * Security: Disable XML-RPC
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Security: Remove X-Powered-By header
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');

/**
 * Add reading time estimate
 */
function iconic_reading_time() {
    global $post;
    
    if (!$post) {
        return '';
    }
    
    $content = get_post_field('post_content', $post->ID);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed
    
    return sprintf(
        _n('%d minute read', '%d minutes read', $reading_time, 'iconic'),
        $reading_time
    );
}
