<?php
/**
 * SEO Functions
 */

// Add meta description
function iconic_add_meta_description() {
    if (is_singular()) {
        global $post;
        $description = '';
        
        if (has_excerpt($post->ID)) {
            $description = get_the_excerpt();
        } else {
            $description = wp_trim_words(get_the_content(), 30);
        }
        
        if (!empty($description)) {
            echo '<meta name="description" content="' . esc_attr(strip_tags($description)) . '">' . "\n";
        }
    } elseif (is_home() || is_front_page()) {
        $description = get_bloginfo('description');
        if (!empty($description)) {
            echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'iconic_add_meta_description');

// Add Open Graph tags
function iconic_add_og_tags() {
    if (is_singular()) {
        global $post;
        
        $title = get_the_title();
        $description = has_excerpt($post->ID) ? get_the_excerpt() : wp_trim_words(get_the_content(), 30);
        $image = has_post_thumbnail() ? get_the_post_thumbnail_url($post->ID, 'large') : '';
        $url = get_permalink();
        
        echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr(strip_tags($description)) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n";
        echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
        
        if ($image) {
            echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'iconic_add_og_tags');

// Add canonical URL
function iconic_add_canonical() {
    if (is_singular()) {
        echo '<link rel="canonical" href="' . esc_url(get_permalink()) . '">' . "\n";
    }
}
add_action('wp_head', 'iconic_add_canonical');
