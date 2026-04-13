<?php
/**
 * Helper Functions
 */

// Get reading time estimate
if (!function_exists('iconic_get_reading_time')) {
    function iconic_get_reading_time($post_id = null) {
        if (!$post_id) {
            $post_id = get_the_ID();
        }
        
        $content = get_post_field('post_content', $post_id);
        $word_count = str_word_count(strip_tags($content));
        $reading_speed = 200; // words per minute
        $reading_time = ceil($word_count / $reading_speed);
        
        return sprintf(_n('%d دقيقة قراءة', '%d دقائق قراءة', $reading_time, 'iconic'), $reading_time);
    }
}

// Get post categories with links
if (!function_exists('iconic_get_categories')) {
    function iconic_get_categories($post_id = null) {
        if (!$post_id) {
            $post_id = get_the_ID();
        }
        
        $categories = get_the_category($post_id);
        if (!empty($categories)) {
            return $categories;
        }
        
        return array();
    }
}

// Check if post has specific format
if (!function_exists('iconic_has_format')) {
    function iconic_has_format($format_slug) {
        $formats = get_the_terms(get_the_ID(), 'content_format');
        
        if ($formats && !is_wp_error($formats)) {
            foreach ($formats as $format) {
                if ($format->slug === $format_slug) {
                    return true;
                }
            }
        }
        
        return false;
    }
}

// Get featured image URL or fallback
if (!function_exists('iconic_get_featured_image')) {
    function iconic_get_featured_image($size = 'large') {
        if (has_post_thumbnail()) {
            return get_the_post_thumbnail_url(get_the_ID(), $size);
        }
        
        // Fallback image
        return ICONIC_URI . '/assets/images/placeholder.jpg';
    }
}

// Safe excerpt
if (!function_exists('iconic_excerpt')) {
    function iconic_excerpt($length = 30) {
        $excerpt = get_the_excerpt();
        $words = explode(' ', $excerpt, $length + 1);
        
        if (count($words) > $length) {
            array_pop($words);
            return implode(' ', $words) . '...';
        }
        
        return $excerpt;
    }
}
