<?php
/**
 * Template Functions
 * 
 * @package ICONIC
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Display post thumbnail with fallback
 */
function iconic_post_thumbnail($size = 'full', $attr = array()) {
    if (has_post_thumbnail()) {
        the_post_thumbnail($size, $attr);
    } else {
        echo '<img src="' . esc_url(ICONIC_URI) . '/assets/images/placeholder.jpg" alt="" class="wp-post-image" />';
    }
}

/**
 * Get category color based on slug
 */
function iconic_get_category_color($slug) {
    $colors = array(
        'culture' => '#00d9ff',
        'cinema'  => '#7b2fff',
        'music'   => '#ff006e',
        'theater' => '#a855f7',
        'history' => '#f59e0b',
        'travel'  => '#10b981',
        'art'     => '#ec4899',
    );
    
    return isset($colors[$slug]) ? $colors[$slug] : '#00d9ff';
}

/**
 * Display social share buttons
 */
function iconic_share_buttons() {
    echo iconic_get_share_links();
}

/**
 * Display reading time
 */
function iconic_reading_time_display() {
    echo iconic_get_reading_time();
}

/**
 * Get site logo
 */
function iconic_site_logo() {
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        echo '<a href="' . esc_url(home_url('/')) . '" class="logo-text">' . get_bloginfo('name') . '</a>';
    }
}

/**
 * Display breadcrumbs
 */
function iconic_display_breadcrumbs() {
    iconic_breadcrumbs();
}

/**
 * Check if we're on a specific post type archive
 */
function iconic_is_video_archive() {
    return is_post_type_archive('video');
}

function iconic_is_interview_archive() {
    return is_post_type_archive('interview');
}

/**
 * Get author link
 */
function iconic_author_link($author_id = null) {
    if (!$author_id) {
        $author_id = get_the_author_meta('ID');
    }
    return get_author_posts_url($author_id);
}

/**
 * Display formatted date with icon
 */
function iconic_date_display($format = 'F j, Y') {
    echo '<span class="date-display">';
    echo iconic_get_svg_icon('clock');
    echo get_the_date($format);
    echo '</span>';
}

/**
 * Get video embed code from custom field
 */
function iconic_get_video_embed($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $video_url = get_post_meta($post_id, '_video_url', true);
    
    if (!$video_url) {
        return '';
    }
    
    // Simple YouTube embed detection
    if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
        preg_match('/(?:embed\/)([^&]+)/', $video_url, $matches);
        if (empty($matches)) {
            preg_match('/(?:v=)([^&]+)/', $video_url, $matches);
        }
        if (!empty($matches[1])) {
            return '<iframe src="https://www.youtube.com/embed/' . esc_attr($matches[1]) . '" frameborder="0" allowfullscreen></iframe>';
        }
    }
    
    return wp_oembed_get($video_url);
}

/**
 * Add body class for single post type
 */
function iconic_single_post_type_class($classes) {
    if (is_singular()) {
        $post_type = get_post_type();
        $classes[] = 'single-' . sanitize_html_class($post_type);
    }
    return $classes;
}
add_filter('body_class', 'iconic_single_post_type_class');

/**
 * Custom excerpt with read more link
 */
function iconic_excerpt_with_link($length = 25) {
    $excerpt = get_the_excerpt();
    $link = sprintf(
        '<a href="%s" class="read-more">%s</a>',
        esc_url(get_permalink()),
        esc_html__('اقرأ المزيد', 'iconic')
    );
    
    return $excerpt . ' ' . $link;
}
