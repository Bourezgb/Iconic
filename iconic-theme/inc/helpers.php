<?php
/**
 * Helper Functions
 * 
 * @package ICONIC
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get post categories with custom formatting
 */
function iconic_get_post_categories($post_id = null, $limit = 1) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $categories = get_the_category($post_id);
    
    if (empty($categories)) {
        return '';
    }
    
    $output = array();
    foreach (array_slice($categories, 0, $limit) as $category) {
        $output[] = sprintf(
            '<a href="%s" class="category-pill">%s</a>',
            esc_url(get_category_link($category->term_id)),
            esc_html($category->name)
        );
    }
    
    return implode('', $output);
}

/**
 * Get culture section terms
 */
function iconic_get_culture_sections($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $terms = get_the_terms($post_id, 'culture_section');
    
    if (empty($terms) || is_wp_error($terms)) {
        return '';
    }
    
    $output = array();
    foreach ($terms as $term) {
        $output[] = sprintf(
            '<a href="%s" class="category-pill">%s</a>',
            esc_url(get_term_link($term)),
            esc_html($term->name)
        );
    }
    
    return implode('', $output);
}

/**
 * Get estimated reading time
 */
function iconic_get_reading_time() {
    global $post;
    
    if (!$post) {
        return '';
    }
    
    $content = get_post_field('post_content', $post->ID);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    
    return sprintf(
        _n('%d دقيقة قراءة', '%d دقائق قراءة', $reading_time, 'iconic'),
        $reading_time
    );
}

/**
 * Get author avatar with fallback
 */
function iconic_get_author_avatar($author_id = null, $size = 64) {
    if (!$author_id) {
        $author_id = get_the_author_meta('ID');
    }
    
    return get_avatar($author_id, $size, '', '', array(
        'class' => 'author-avatar',
    ));
}

/**
 * Get formatted date
 */
function iconic_get_formatted_date($post_id = null, $format = 'F j, Y') {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $date = get_the_date($format, $post_id);
    return '<time datetime="' . get_the_date('Y-m-d', $post_id) . '">' . $date . '</time>';
}

/**
 * Get social share links
 */
function iconic_get_share_links($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $url = get_permalink($post_id);
    $title = get_the_title($post_id);
    $encoded_url = urlencode($url);
    $encoded_title = urlencode($title);
    
    $share_links = array(
        'facebook' => array(
            'url' => sprintf('https://www.facebook.com/sharer/sharer.php?u=%s', $encoded_url),
            'label' => __('Facebook', 'iconic'),
            'icon' => 'facebook',
        ),
        'twitter' => array(
            'url' => sprintf('https://twitter.com/intent/tweet?url=%s&text=%s', $encoded_url, $encoded_title),
            'label' => __('Twitter', 'iconic'),
            'icon' => 'twitter',
        ),
        'whatsapp' => array(
            'url' => sprintf('https://wa.me/?text=%s%%20%s', $encoded_title, $encoded_url),
            'label' => __('WhatsApp', 'iconic'),
            'icon' => 'whatsapp',
        ),
        'linkedin' => array(
            'url' => sprintf('https://www.linkedin.com/shareArticle?mini=true&url=%s&title=%s', $encoded_url, $encoded_title),
            'label' => __('LinkedIn', 'iconic'),
            'icon' => 'linkedin',
        ),
    );
    
    $output = '<div class="share-links">';
    foreach ($share_links as $platform => $data) {
        $output .= sprintf(
            '<a href="%s" target="_blank" rel="noopener noreferrer" class="share-link share-%s" aria-label="%s">%s</a>',
            esc_url($data['url']),
            esc_attr($platform),
            esc_attr($data['label']),
            esc_html($data['label'])
        );
    }
    $output .= '</div>';
    
    return $output;
}

/**
 * Get related posts
 */
function iconic_get_related_posts($post_id = null, $limit = 3) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $categories = get_the_category($post_id);
    
    if (empty($categories)) {
        return array();
    }
    
    $category_ids = wp_list_pluck($categories, 'term_id');
    
    $args = array(
        'post__not_in' => array($post_id),
        'category__in' => $category_ids,
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    );
    
    $query = new WP_Query($args);
    
    return $query->posts;
}

/**
 * Check if post has featured image
 */
function iconic_has_featured_image($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    return has_post_thumbnail($post_id);
}

/**
 * Get featured image URL
 */
function iconic_get_featured_image_url($post_id = null, $size = 'full') {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    if (!has_post_thumbnail($post_id)) {
        return ICONIC_URI . '/assets/images/placeholder.jpg';
    }
    
    $image_id = get_post_thumbnail_id($post_id);
    $image_url = wp_get_attachment_image_src($image_id, $size);
    
    return $image_url ? $image_url[0] : '';
}

/**
 * SVG Icons helper
 */
function iconic_get_svg_icon($icon_name) {
    $icons = array(
        'search' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        'menu' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>',
        'close' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
        'arrow-right' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
        'play' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>',
        'clock' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
        'user' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>',
    );
    
    return isset($icons[$icon_name]) ? $icons[$icon_name] : '';
}

/**
 * Breadcrumbs helper
 */
function iconic_breadcrumbs() {
    if (is_front_page()) {
        return;
    }
    
    echo '<nav class="breadcrumbs" aria-label="' . esc_attr__('Breadcrumb', 'iconic') . '">';
    echo '<a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'iconic') . '</a>';
    
    if (is_category() || is_single()) {
        echo ' <span class="separator">/</span> ';
        the_category(' <span class="separator">/</span> ');
        
        if (is_single()) {
            echo ' <span class="separator">/</span> ';
            the_title('<span class="current">', '</span>');
        }
    } elseif (is_page()) {
        echo ' <span class="separator">/</span> ';
        the_title('<span class="current">', '</span>');
    } elseif (is_search()) {
        echo ' <span class="separator">/</span> ';
        printf('<span class="current">%s</span>', esc_html__('Search Results', 'iconic'));
    } elseif (is_archive()) {
        echo ' <span class="separator">/</span> ';
        the_archive_title('<span class="current">', '</span>');
    }
    
    echo '</nav>';
}

/**
 * Pagination helper
 */
function iconic_pagination($max_pages = null) {
    global $wp_query;
    
    if ($max_pages === null) {
        $max_pages = $wp_query->max_num_pages;
    }
    
    if ($max_pages <= 1) {
        return;
    }
    
    echo '<div class="pagination">';
    
    echo paginate_links(array(
        'total' => $max_pages,
        'current' => max(1, get_query_var('paged')),
        'prev_text' => iconic_get_svg_icon('arrow-right') . ' ' . __('Previous', 'iconic'),
        'next_text' => __('Next', 'iconic') . ' ' . iconic_get_svg_icon('arrow-right'),
        'type' => 'list',
    ));
    
    echo '</div>';
}

/**
 * Escape output safely
 */
function iconic_esc($value, $context = 'html') {
    switch ($context) {
        case 'html':
            return esc_html($value);
        case 'url':
            return esc_url($value);
        case 'attr':
            return esc_attr($value);
        case 'js':
            return esc_js($value);
        default:
            return esc_html($value);
    }
}
