<?php
/**
 * Gutenberg Blocks Registration
 * 
 * @package ICONIC
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register custom Gutenberg blocks
 */
function iconic_register_blocks() {
    // Register block category
    register_block_category('iconic-blocks', array(
        'title' => __('ICONIC Blocks', 'iconic'),
        'icon'  => 'star-filled',
    ));
    
    // Register server-side rendered blocks
    register_block_type('iconic/featured-posts', array(
        'editor_script'   => 'iconic-blocks-editor',
        'editor_style'    => 'iconic-blocks-editor-style',
        'render_callback' => 'iconic_render_featured_posts_block',
        'attributes'      => array(
            'postsCount' => array(
                'type'    => 'integer',
                'default' => 3,
            ),
            'category'   => array(
                'type'    => 'string',
                'default' => '',
            ),
        ),
    ));
    
    register_block_type('iconic/section-title', array(
        'render_callback' => 'iconic_render_section_title_block',
        'attributes'      => array(
            'title'      => array(
                'type'    => 'string',
                'default' => '',
            ),
            'linkText'   => array(
                'type'    => 'string',
                'default' => __('عرض الكل', 'iconic'),
            ),
            'linkUrl'    => array(
                'type'    => 'string',
                'default' => '',
            ),
        ),
    ));
    
    register_block_type('iconic/manifesto-quote', array(
        'render_callback' => 'iconic_render_manifesto_quote_block',
        'attributes'      => array(
            'quote' => array(
                'type'    => 'string',
                'default' => '',
            ),
            'text'  => array(
                'type'    => 'string',
                'default' => '',
            ),
        ),
    ));
}
add_action('init', 'iconic_register_blocks');

/**
 * Render featured posts block
 */
function iconic_render_featured_posts_block($attributes) {
    $args = array(
        'posts_per_page' => $attributes['postsCount'],
        'post_status'    => 'publish',
    );
    
    if (!empty($attributes['category'])) {
        $args['category_name'] = $attributes['category'];
    }
    
    $query = new WP_Query($args);
    
    if (!$query->have_posts()) {
        return '';
    }
    
    $output = '<div class="article-grid">';
    
    while ($query->have_posts()) {
        $query->the_post();
        $output .= get_template_part('template-parts/content', get_post_type());
    }
    
    $output .= '</div>';
    
    wp_reset_postdata();
    
    return $output;
}

/**
 * Render section title block
 */
function iconic_render_section_title_block($attributes) {
    $output = '<div class="section-header">';
    $output .= '<h2 class="section-title">' . esc_html($attributes['title']) . '</h2>';
    
    if (!empty($attributes['linkUrl'])) {
        $output .= '<a href="' . esc_url($attributes['linkUrl']) . '" class="section-link">';
        $output .= esc_html($attributes['linkText']);
        $output .= iconic_get_svg_icon('arrow-right');
        $output .= '</a>';
    }
    
    $output .= '</div>';
    
    return $output;
}

/**
 * Render manifesto quote block
 */
function iconic_render_manifesto_quote_block($attributes) {
    $output = '<section class="manifesto-section">';
    $output .= '<div class="container">';
    $output .= '<div class="manifesto-content">';
    
    if (!empty($attributes['quote'])) {
        $output .= '<blockquote class="manifesto-quote">' . esc_html($attributes['quote']) . '</blockquote>';
    }
    
    if (!empty($attributes['text'])) {
        $output .= '<p class="manifesto-text">' . esc_html($attributes['text']) . '</p>';
    }
    
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</section>';
    
    return $output;
}

/**
 * Enqueue block editor assets
 */
function iconic_blocks_editor_assets() {
    wp_enqueue_script(
        'iconic-blocks-editor',
        ICONIC_URI . '/assets/js/blocks.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components'),
        ICONIC_VERSION,
        true
    );
    
    wp_enqueue_style(
        'iconic-blocks-editor-style',
        ICONIC_URI . '/assets/css/blocks-editor.css',
        array(),
        ICONIC_VERSION
    );
}
add_action('enqueue_block_editor_assets', 'iconic_blocks_editor_assets');
