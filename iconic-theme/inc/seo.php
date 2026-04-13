<?php
/**
 * SEO Functions
 * 
 * @package ICONIC
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Open Graph meta tags
 */
function iconic_opengraph_meta() {
    global $post;
    
    if (!is_singular()) {
        return;
    }
    
    $site_name = get_bloginfo('name');
    $title = get_the_title();
    $description = get_the_excerpt();
    $url = get_permalink();
    $image = iconic_get_featured_image_url($post->ID, 'iconic-featured');
    $type = is_singular('video') ? 'video.other' : 'article';
    
    echo "\n<!-- Open Graph -->\n";
    echo '<meta property="og:locale" content="' . esc_attr(get_locale()) . '">' . "\n";
    echo '<meta property="og:type" content="' . esc_attr($type) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
    
    if ($image) {
        echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
        echo '<meta property="og:image:width" content="1200">' . "\n";
        echo '<meta property="og:image:height" content="675">' . "\n";
    }
    
    echo "\n";
}
add_action('wp_head', 'iconic_opengraph_meta', 5);

/**
 * Add Twitter Card meta tags
 */
function iconic_twitter_card_meta() {
    global $post;
    
    if (!is_singular()) {
        return;
    }
    
    $title = get_the_title();
    $description = get_the_excerpt();
    $image = iconic_get_featured_image_url($post->ID, 'iconic-featured');
    
    echo "\n<!-- Twitter Card -->\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
    
    if ($image) {
        echo '<meta name="twitter:image" content="' . esc_url($image) . '">' . "\n";
    }
    
    echo "\n";
}
add_action('wp_head', 'iconic_twitter_card_meta', 5);

/**
 * Add article schema for single posts
 */
function iconic_article_schema() {
    if (!is_singular('post')) {
        return;
    }
    
    global $post;
    
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => get_the_title(),
        'datePublished' => get_the_date('c'),
        'dateModified' => get_the_modified_date('c'),
        'author' => array(
            '@type' => 'Person',
            'name' => get_the_author(),
        ),
        'publisher' => array(
            '@type' => 'Organization',
            'name' => get_bloginfo('name'),
            'logo' => array(
                '@type' => 'ImageObject',
                'url' => get_custom_logo() ? wp_get_attachment_image_url(get_post_thumbnail_id(get_custom_logo()), 'full') : '',
            ),
        ),
        'description' => get_the_excerpt(),
        'mainEntityOfPage' => get_permalink(),
    );
    
    if (has_post_thumbnail()) {
        $schema['image'] = array(
            iconic_get_featured_image_url($post->ID, 'iconic-featured'),
        );
    }
    
    echo '<script type="application/ld+json">' . json_encode($schema) . '</script>' . "\n";
}
add_action('wp_head', 'iconic_article_schema');

/**
 * Add breadcrumbs schema
 */
function iconic_breadcrumb_schema() {
    if (is_front_page()) {
        return;
    }
    
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array(),
    );
    
    $position = 1;
    $schema['itemListElement'][] = array(
        '@type' => 'ListItem',
        'position' => $position,
        'name' => __('Home', 'iconic'),
        'item' => home_url('/'),
    );
    $position++;
    
    if (is_category() || is_single()) {
        $categories = get_the_category();
        if (!empty($categories)) {
            $category = $categories[0];
            $schema['itemListElement'][] = array(
                '@type' => 'ListItem',
                'position' => $position,
                'name' => $category->name,
                'item' => get_category_link($category),
            );
        }
    } elseif (is_page()) {
        $schema['itemListElement'][] = array(
            '@type' => 'ListItem',
            'position' => $position,
            'name' => get_the_title(),
        );
    }
    
    echo '<script type="application/ld+json">' . json_encode($schema) . '</script>' . "\n";
}
add_action('wp_head', 'iconic_breadcrumb_schema');

/**
 * Add preconnect for performance
 */
function iconic_preconnect_hints() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action('wp_head', 'iconic_preconnect_hints', 1);
