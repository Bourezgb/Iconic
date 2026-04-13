<?php
/**
 * Enqueue scripts and styles
 * 
 * @package ICONIC
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('iconic_scripts')) :
    /**
     * Enqueue scripts and styles.
     */
    function iconic_scripts() {
        // Get theme version
        $theme_version = wp_get_theme()->get('Version');
        
        // Google Fonts - Arabic First Typography
        $font_args = array(
            'family' => urlencode('Tajawal:wght@400;500;700;900|Noto+Sans+Arabic:wght@300;400;500;600;700|Inter:wght@400;500;600;700'),
            'display' => 'swap',
        );
        wp_enqueue_style(
            'iconic-google-fonts',
            add_query_arg($font_args, 'https://fonts.googleapis.com/css2'),
            array(),
            null
        );
        
        // Main stylesheet
        wp_enqueue_style(
            'iconic-style',
            get_stylesheet_uri(),
            array(),
            $theme_version
        );
        
        // Three.js for 3D elements (conditional loading)
        if (is_front_page()) {
            wp_enqueue_script(
                'three-js',
                'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js',
                array(),
                'r128',
                true
            );
            
            // Custom Three.js implementation
            wp_enqueue_script(
                'iconic-three',
                ICONIC_URI . '/assets/js/three-hero.js',
                array('three-js'),
                $theme_version,
                true
            );
        }
        
        // GSAP for animations (loaded async on frontend)
        wp_enqueue_script(
            'gsap-core',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
            array(),
            '3.12.2',
            true
        );
        
        wp_enqueue_script(
            'gsap-scrolltrigger',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
            array('gsap-core'),
            '3.12.2',
            true
        );
        
        // Main JavaScript
        wp_enqueue_script(
            'iconic-main',
            ICONIC_URI . '/assets/js/main.js',
            array('gsap-core', 'gsap-scrolltrigger'),
            $theme_version,
            true
        );
        
        // Localize script with AJAX URL
        wp_localize_script('iconic-main', 'iconic_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('iconic_nonce'),
        ));
        
        // Comment reply script
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
endif;
add_action('wp_enqueue_scripts', 'iconic_scripts');

/**
 * Preload critical resources
 */
function iconic_resource_hints($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
        $urls[] = array(
            'href' => 'https://cdnjs.cloudflare.com',
            'crossorigin' => 'anonymous',
        );
    }
    
    return $urls;
}
add_filter('wp_resource_hints', 'iconic_resource_hints', 10, 2);

/**
 * Defer non-critical scripts
 */
function iconic_defer_scripts($tag, $handle, $src) {
    // Defer GSAP scripts
    if (in_array($handle, array('gsap-core', 'gsap-scrolltrigger'))) {
        return '<script src="' . esc_url($src) . '" defer="defer"></script>';
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'iconic_defer_scripts', 10, 3);
