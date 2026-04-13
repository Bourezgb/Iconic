<?php
/**
 * Theme Setup
 * 
 * @package ICONIC
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('iconic_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function iconic_setup() {
        /*
         * Make theme available for translation.
         */
        load_theme_textdomain('iconic', ICONIC_DIR . '/languages');

        /*
         * Add default posts and comments RSS feed links to head.
         */
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         */
        add_theme_support('post-thumbnails');
        
        // Custom image sizes for editorial layout
        add_image_size('iconic-hero', 1920, 1080, true);
        add_image_size('iconic-featured', 1200, 675, true);
        add_image_size('iconic-card', 680, 425, true);
        add_image_size('iconic-square', 600, 600, true);
        add_image_size('iconic-vertical', 600, 900, true);

        /*
         * Register nav menus.
         */
        register_nav_menus(array(
            'primary'   => esc_html__('Primary Menu', 'iconic'),
            'footer'    => esc_html__('Footer Menu', 'iconic'),
            'mobile'    => esc_html__('Mobile Menu', 'iconic'),
            'social'    => esc_html__('Social Links Menu', 'iconic'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ));

        /*
         * Set up the WordPress core custom background feature.
         */
        add_theme_support('custom-background', array(
            'default-color' => '0a0a0c',
        ));

        /*
         * Add theme support for selective refresh for widgets.
         */
        add_theme_support('customize-selective-refresh-widgets');

        /*
         * Add support for core custom logo.
         */
        add_theme_support('custom-logo', array(
            'height'      => 80,
            'width'       => 200,
            'flex-width'  => true,
            'flex-height' => true,
        ));

        /*
         * Add support for responsive embeds.
         */
        add_theme_support('responsive-embeds');

        /*
         * Add support for full and wide align images.
         */
        add_theme_support('align-wide');

        /*
         * Add support for editor styles.
         */
        add_theme_support('editor-styles');
        
        /*
         * Add custom editor color palette.
         */
        add_theme_support('editor-color-palette', array(
            array(
                'name'  => esc_html__('Primary Background', 'iconic'),
                'slug'  => 'primary-bg',
                'color' => '#0a0a0c',
            ),
            array(
                'name'  => esc_html__('Secondary Background', 'iconic'),
                'slug'  => 'secondary-bg',
                'color' => '#121216',
            ),
            array(
                'name'  => esc_html__('Accent Cyan', 'iconic'),
                'slug'  => 'accent-cyan',
                'color' => '#00d9ff',
            ),
            array(
                'name'  => esc_html__('Accent Blue', 'iconic'),
                'slug'  => 'accent-blue',
                'color' => '#7b2fff',
            ),
            array(
                'name'  => esc_html__('Accent Magenta', 'iconic'),
                'slug'  => 'accent-magenta',
                'color' => '#ff006e',
            ),
            array(
                'name'  => esc_html__('Text Primary', 'iconic'),
                'slug'  => 'text-primary',
                'color' => '#ffffff',
            ),
            array(
                'name'  => esc_html__('Text Secondary', 'iconic'),
                'slug'  => 'text-secondary',
                'color' => '#b8b8c0',
            ),
        ));

        /*
         * Add custom editor font sizes.
         */
        add_theme_support('editor-font-sizes', array(
            array(
                'name' => esc_html__('Small', 'iconic'),
                'size' => 14,
                'slug' => 'small',
            ),
            array(
                'name' => esc_html__('Normal', 'iconic'),
                'size' => 16,
                'slug' => 'normal',
            ),
            array(
                'name' => esc_html__('Large', 'iconic'),
                'size' => 20,
                'slug' => 'large',
            ),
            array(
                'name' => esc_html__('Huge', 'iconic'),
                'size' => 36,
                'slug' => 'huge',
            ),
        ));

        /*
         * Add support for custom line height.
         */
        add_theme_support('custom-line-height');

        /*
         * Add support for experimental link color.
         */
        add_theme_support('link-color');
    }
endif;
add_action('after_setup_theme', 'iconic_setup');

/**
 * Set the content width in pixels.
 */
function iconic_content_width() {
    $GLOBALS['content_width'] = apply_filters('iconic_content_width', 1200);
}
add_action('after_setup_theme', 'iconic_content_width', 0);

/**
 * Register widget areas.
 */
function iconic_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'iconic'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'iconic'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Column 1', 'iconic'),
        'id'            => 'footer-1',
        'description'   => esc_html__('First footer column widgets.', 'iconic'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Column 2', 'iconic'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Second footer column widgets.', 'iconic'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Column 3', 'iconic'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Third footer column widgets.', 'iconic'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'iconic_widgets_init');
