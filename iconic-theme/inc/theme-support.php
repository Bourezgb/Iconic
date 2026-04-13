<?php
/**
 * Theme Support Features
 */

// Additional theme support features can be added here
function iconic_theme_support_features() {
    // Add support for custom background
    add_theme_support('custom-background', array(
        'default-color' => '0a0a0c',
    ));

    // Add support for custom header
    add_theme_support('custom-header', array(
        'default-image' => '',
        'width' => 1920,
        'height' => 400,
        'flex-height' => true,
        'flex-width' => true,
    ));

    // Add support for post formats (if needed)
    add_theme_support('post-formats', array(
        'aside',
        'gallery',
        'link',
        'image',
        'quote',
        'video',
        'audio',
    ));

    // Add support for excerpt
    add_theme_support('excerpt');
}
add_action('after_setup_theme', 'iconic_theme_support_features');
