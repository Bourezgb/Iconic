<?php
/**
 * Gutenberg Blocks Registration
 */

// Register custom blocks if Gutenberg is available
function iconic_register_blocks() {
    // Check if block editor is available
    if (!function_exists('register_block_type')) {
        return;
    }
    
    // Register block categories
    add_filter('block_categories_all', function($categories) {
        array_unshift($categories, array(
            'slug' => 'iconic-blocks',
            'title' => __('بلوكات ICONIC', 'iconic'),
        ));
        return $categories;
    });
}
add_action('init', 'iconic_register_blocks');

// Add custom styles to editor
function iconic_add_editor_styles() {
    add_theme_support('editor-styles');
    add_editor_style(ICONIC_URI . '/style.css');
}
add_action('after_setup_theme', 'iconic_add_editor_styles');
