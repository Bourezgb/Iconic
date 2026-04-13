<?php
/**
 * ICONIC Theme Functions
 * 
 * @package ICONIC
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define theme constants
 */
define('ICONIC_VERSION', '1.0.0');
define('ICONIC_DIR', get_template_directory());
define('ICONIC_URI', get_template_directory_uri());

/**
 * Include core files
 */
require_once ICONIC_DIR . '/inc/setup.php';
require_once ICONIC_DIR . '/inc/enqueue.php';
require_once ICONIC_DIR . '/inc/theme-support.php';
require_once ICONIC_DIR . '/inc/core-setup.php'; // Unified CPTs & Taxonomies
require_once ICONIC_DIR . '/inc/helpers.php';
require_once ICONIC_DIR . '/inc/template-functions.php';
require_once ICONIC_DIR . '/inc/seo.php';
require_once ICONIC_DIR . '/inc/ad-manager.php'; // Ad Zones Manager

/**
 * Customizer additions (optional)
 */
if (class_exists('WP_Customize_Control') && file_exists(ICONIC_DIR . '/inc/customizer.php')) {
    require_once ICONIC_DIR . '/inc/customizer.php';
}

/**
 * ACF Pro integration (if available)
 */
if (class_exists('ACF')) {
    // ACF fields are now registered in ad-manager.php and core-setup.php dynamically
    // Additional ACF field groups can be added here if needed
}

/**
 * Gutenberg blocks registration
 */
require_once ICONIC_DIR . '/inc/blocks.php';
