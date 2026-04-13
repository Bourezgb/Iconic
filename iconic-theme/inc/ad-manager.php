<?php
/**
 * Ad Manager - Safe Implementation
 * Only works if ACF is active
 */

// Register Ad Zones (only if ACF exists)
function iconic_register_ad_zones() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    
    acf_add_local_field_group(array(
        'key' => 'group_iconic_ads',
        'title' => __('مناطق الإعلانات', 'iconic'),
        'fields' => array(
            array(
                'key' => 'field_hero_banner',
                'label' => __('إعلان Hero الرئيسي', 'iconic'),
                'name' => 'hero_banner',
                'type' => 'textarea',
                'instructions' => __('أدخل كود HTML أو Script للإعلان', 'iconic'),
            ),
            array(
                'key' => 'field_article_top',
                'label' => __('إعلان أعلى المقال', 'iconic'),
                'name' => 'article_top_ad',
                'type' => 'textarea',
            ),
            array(
                'key' => 'field_article_bottom',
                'label' => __('إعلان أسفل المقال', 'iconic'),
                'name' => 'article_bottom_ad',
                'type' => 'textarea',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'theme-options',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));
}
add_action('acf/init', 'iconic_register_ad_zones');

// Display ad zone safely
if (!function_exists('iconic_display_ad')) {
    function iconic_display_ad($zone = 'hero_banner') {
        // Check if ACF exists
        if (!function_exists('get_field')) {
            return;
        }
        
        $ad_code = get_field($zone, 'option');
        
        if (!empty($ad_code)) {
            echo '<div class="ad-zone ad-' . esc_attr($zone) . '">';
            echo '<span class="ad-label">' . __('إعلان', 'iconic') . '</span>';
            echo $ad_code; // Note: Admin should only add trusted code
            echo '</div>';
        }
    }
}

// Create Options Page for ACF
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => __('خيارات القالب', 'iconic'),
        'menu_title' => __('خيارات ICONIC', 'iconic'),
        'menu_slug' => 'theme-options',
        'capability' => 'edit_theme_options',
        'redirect' => false,
    ));
}
