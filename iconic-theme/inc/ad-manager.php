<?php
/**
 * ICONIC Ad Manager
 * Manages 11+ Ad Zones via ACF Options Page.
 * Supports Image, HTML, Script, Link, and Device Targeting.
 */

if (!defined('ABSPATH')) exit;

class ICONIC_Ad_Manager {

    private static $instance = null;
    private $ad_zones = [];

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->define_zones();
        
        if (function_exists('acf_add_options_page')) {
            add_action('acf/init', [$this, 'register_ad_fields']);
        }
        
        add_shortcode('iconic_ad', [$this, 'render_ad_shortcode']);
    }

    /**
     * Define all Ad Zones
     */
    private function define_zones() {
        $this->ad_zones = [
            'hero_banner' => [
                'label' => __('بانر البطل الرئيسي', 'iconic'),
                'location' => 'Homepage Hero',
                'description' => __('يظهر مباشرة بعد قسم الهيرو في الصفحة الرئيسية', 'iconic'),
            ],
            'mid_content' => [
                'label' => __('منتصف الصفحة الرئيسية', 'iconic'),
                'location' => 'Homepage Mid',
                'description' => __('بين أقسام الصفحة الرئيسية', 'iconic'),
            ],
            'in_feed_native' => [
                'label' => __('إعلان مدمج في التغذية', 'iconic'),
                'location' => 'Homepage In-feed',
                'description' => __('داخل شبكة المقالات في الصفحة الرئيسية', 'iconic'),
            ],
            'single_top' => [
                'label' => __('أعلى المقال', 'iconic'),
                'location' => 'Single Article Top',
                'description' => __('فوق عنوان المقال مباشرة', 'iconic'),
            ],
            'single_inline' => [
                'label' => __('داخل المقال (بعد الفقرة 3)', 'iconic'),
                'location' => 'Single Article Inline',
                'description' => __('يتم حقنه تلقائياً بعد الفقرة الثالثة', 'iconic'),
            ],
            'single_bottom' => [
                'label' => __('أسفل المقال', 'iconic'),
                'location' => 'Single Article Bottom',
                'description' => __('قبل المقالات المرتبطة', 'iconic'),
            ],
            'archive_top' => [
                'label' => __('أعلى الأرشيف', 'iconic'),
                'location' => 'Archive Top',
                'description' => __('في صفحات التصنيفات والأرشيف', 'iconic'),
            ],
            'archive_in_grid' => [
                'label' => __('داخل شبكة الأرشيف', 'iconic'),
                'location' => 'Archive In-grid',
                'description' => __('يظهر كعنصر ضمن شبكة المقالات', 'iconic'),
            ],
            'sidebar_ad' => [
                'label' => __('الشريط الجانبي', 'iconic'),
                'location' => 'Sidebar',
                'description' => __('في الشريط الجانبي للمقالات والأرشيف', 'iconic'),
            ],
            'mobile_sticky' => [
                'label' => __('إعلان مثبت للجوال', 'iconic'),
                'location' => 'Mobile Sticky',
                'description' => __('يظهر مثبتاً أسفل شاشة الجوال فقط', 'iconic'),
            ],
            'video_sponsor' => [
                'label' => __('راعي قسم الفيديو', 'iconic'),
                'location' => 'Video Section',
                'description' => __('في أعلى قسم الفيديوهات', 'iconic'),
            ],
        ];
    }

    /**
     * Register ACF Fields for Ads
     */
    public function register_ad_fields() {
        if (!function_exists('acf_add_local_field_group')) return;

        // Options Page
        acf_add_options_page([
            'page_title' => __('إعدادات الإعلانات', 'iconic'),
            'menu_title' => __('الإعلانات', 'iconic'),
            'menu_slug' => 'iconic-ads',
            'capability' => 'edit_theme_options',
            'position' => 60,
            'icon_url' => 'dashicons-advertising',
        ]);

        foreach ($this->ad_zones as $key => $zone) {
            acf_add_local_field_group([
                'key' => 'group_ad_' . $key,
                'title' => $zone['label'],
                'fields' => [
                    [
                        'key' => 'field_ad_' . $key . '_enable',
                        'label' => __('تفعيل الإعلان', 'iconic'),
                        'name' => 'ad_' . $key . '_enable',
                        'type' => 'true_false',
                        'ui' => 1,
                        'default_value' => 0,
                    ],
                    [
                        'key' => 'field_ad_' . $key . '_type',
                        'label' => __('نوع الإعلان', 'iconic'),
                        'name' => 'ad_' . $key . '_type',
                        'type' => 'select',
                        'choices' => [
                            'image' => __('صورة', 'iconic'),
                            'html' => __('كود HTML/Script', 'iconic'),
                        ],
                        'conditional_logic' => [
                            [
                                [
                                    'field' => 'field_ad_' . $key . '_enable',
                                    'operator' => '==',
                                    'value' => '1',
                                ],
                            ],
                        ],
                    ],
                    [
                        'key' => 'field_ad_' . $key . '_image',
                        'label' => __('صورة الإعلان', 'iconic'),
                        'name' => 'ad_' . $key . '_image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'conditional_logic' => [
                            [
                                [
                                    'field' => 'field_ad_' . $key . '_type',
                                    'operator' => '==',
                                    'value' => 'image',
                                ],
                            ],
                        ],
                    ],
                    [
                        'key' => 'field_ad_' . $key . '_link',
                        'label' => __('رابط الإعلان (اختياري)', 'iconic'),
                        'name' => 'ad_' . $key . '_link',
                        'type' => 'url',
                        'conditional_logic' => [
                            [
                                [
                                    'field' => 'field_ad_' . $key . '_enable',
                                    'operator' => '==',
                                    'value' => '1',
                                ],
                            ],
                        ],
                    ],
                    [
                        'key' => 'field_ad_' . $key . '_code',
                        'label' => __('كود HTML أو Script', 'iconic'),
                        'name' => 'ad_' . $key . '_code',
                        'type' => 'textarea',
                        'rows' => 5,
                        'conditional_logic' => [
                            [
                                [
                                    'field' => 'field_ad_' . $key . '_type',
                                    'operator' => '==',
                                    'value' => 'html',
                                ],
                            ],
                        ],
                    ],
                    [
                        'key' => 'field_ad_' . $key . '_label',
                        'label' => __('وسم الإعلان', 'iconic'),
                        'name' => 'ad_' . $key . '_label',
                        'type' => 'select',
                        'choices' => [
                            'advertisement' => __('إعلان', 'iconic'),
                            'sponsored' => __('برعاية', 'iconic'),
                            'partner' => __('شريك', 'iconic'),
                            'none' => __('بدون وسم', 'iconic'),
                        ],
                        'default_value' => 'advertisement',
                    ],
                    [
                        'key' => 'field_ad_' . $key . '_devices',
                        'label' => __('الأجهزة المستهدفة', 'iconic'),
                        'name' => 'ad_' . $key . '_devices',
                        'type' => 'checkbox',
                        'choices' => [
                            'desktop' => __('كمبيوتر', 'iconic'),
                            'tablet' => __('لوحي', 'iconic'),
                            'mobile' => __('جوال', 'iconic'),
                        ],
                        'default_value' => ['desktop', 'tablet', 'mobile'],
                        'layout' => 'horizontal',
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'iconic-ads',
                        ],
                    ],
                ],
                'menu_order' => array_search($key, array_keys($this->ad_zones)),
                'position' => 'normal',
                'style' => 'default',
            ]);
        }
    }

    /**
     * Render Ad HTML
     */
    public function render_ad($zone_key, $args = []) {
        if (!isset($this->ad_zones[$zone_key])) return '';

        $enabled = get_field('ad_' . $zone_key . '_enable', 'option');
        if (!$enabled) return '';

        $devices = get_field('ad_' . $zone_key . '_devices', 'option') ?? ['desktop', 'tablet', 'mobile'];
        $device_class = 'ad-desktop';
        if (count($devices) === 3) $device_class = '';
        elseif (in_array('mobile', $devices) && !in_array('desktop', $devices)) $device_class = 'ad-mobile-only';
        elseif (in_array('tablet', $devices) && !in_array('desktop', $devices)) $device_class = 'ad-tablet-only';

        $type = get_field('ad_' . $zone_key . '_type', 'option') ?? 'image';
        $link = get_field('ad_' . $zone_key . '_link', 'option');
        $label_key = get_field('ad_' . $zone_key . '_label', 'option') ?? 'advertisement';
        $label_text = ($label_key !== 'none') ? $this->get_label_text($label_key) : '';

        ob_start();
        ?>
        <div class="iconic-ad-zone iconic-ad-<?php echo esc_attr($zone_key); ?> <?php echo esc_attr($device_class); ?>">
            <?php if ($label_text): ?>
                <span class="iconic-ad-label"><?php echo esc_html($label_text); ?></span>
            <?php endif; ?>
            
            <div class="iconic-ad-content">
                <?php if ($type === 'image'): 
                    $image = get_field('ad_' . $zone_key . '_image', 'option');
                    if ($image):
                        $img_html = wp_get_attachment_image($image['ID'], 'full', false, ['loading' => 'lazy']);
                        if ($link):
                            echo '<a href="' . esc_url($link) . '" target="_blank" rel="sponsored noopener">' . $img_html . '</a>';
                        else:
                            echo $img_html;
                        endif;
                    endif;
                elseif ($type === 'html'):
                    $code = get_field('ad_' . $zone_key . '_code', 'option');
                    if ($code) echo wp_kses_post($code);
                endif; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Shortcode: [iconic_ad zone="hero_banner"]
     */
    public function render_ad_shortcode($atts) {
        $atts = shortcode_atts(['zone' => 'hero_banner'], $atts);
        return $this->render_ad($atts['zone']);
    }

    private function get_label_text($key) {
        $labels = [
            'advertisement' => __('إعلان', 'iconic'),
            'sponsored' => __('برعاية', 'iconic'),
            'partner' => __('شريك', 'iconic'),
        ];
        return $labels[$key] ?? '';
    }

    /**
     * Helper to inject inline ad after paragraph 3 in single posts
     */
    public function inject_inline_ad($content) {
        if (!is_single() || !in_the_loop() || !is_main_query()) return $content;

        // Check if enabled
        $enabled = get_field('ad_single_inline_enable', 'option');
        if (!$enabled) return $content;

        // Count paragraphs and inject after 3rd
        $paragraph_count = 0;
        $new_content = '';
        $lines = explode("\n", $content);

        foreach ($lines as $line) {
            $new_content .= $line . "\n";
            if (strpos($line, '</p>') !== false) {
                $paragraph_count++;
                if ($paragraph_count === 3) {
                    $new_content .= $this->render_ad('single_inline');
                }
            }
        }

        return $new_content;
    }
}

// Initialize
$ad_manager = ICONIC_Ad_Manager::get_instance();
add_filter('the_content', [$ad_manager, 'inject_inline_ad'], 20);
