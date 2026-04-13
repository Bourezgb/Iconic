<?php
/**
 * ICONIC Core Setup
 * Unified registration for CPTs, Taxonomies, and Core Logic.
 * Prevents duplication and ensures consistent slugs.
 */

if (!defined('ABSPATH')) exit;

class ICONIC_Core_Setup {

    private static $instance = null;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('init', [$this, 'register_content_types'], 10);
        add_action('init', [$this, 'register_taxonomies'], 10);
        add_filter('body_class', [$this, 'add_content_type_classes']);
        add_filter('single_template_hierarchy', [$this, 'custom_single_template_hierarchy']);
    }

    /**
     * Register Custom Post Types
     */
    public function register_content_types() {
        // 1. Interviews (مقابلات)
        register_post_type('interview', [
            'labels' => [
                'name' => __('مقابلات', 'iconic'),
                'singular_name' => __('مقابلة', 'iconic'),
                'add_new' => __('أضف مقابلة جديدة', 'iconic'),
                'add_new_item' => __('إضافة مقابلة جديدة', 'iconic'),
                'edit_item' => __('تعديل المقابلة', 'iconic'),
                'view_item' => __('عرض المقابلة', 'iconic'),
                'search_items' => __('بحث في المقابلات', 'iconic'),
            ],
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'interviews', 'with_front' => false],
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments'],
            'menu_icon' => 'dashicons-microphone',
            'show_in_rest' => true,
            'template' => [['core/paragraph'], ['core/image']],
        ]);

        // 2. Videos (فيديو)
        register_post_type('video', [
            'labels' => [
                'name' => __('فيديو', 'iconic'),
                'singular_name' => __('فيديو', 'iconic'),
                'add_new' => __('أضف فيديو جديد', 'iconic'),
                'add_new_item' => __('إضافة فيديو جديد', 'iconic'),
                'edit_item' => __('تعديل الفيديو', 'iconic'),
                'view_item' => __('عرض الفيديو', 'iconic'),
            ],
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'videos', 'with_front' => false],
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'author'],
            'menu_icon' => 'dashicons-video-alt3',
            'show_in_rest' => true,
        ]);

        // 3. Iconic Profiles (شخصيات أيقونية)
        register_post_type('iconic_profile', [
            'labels' => [
                'name' => __('شخصيات أيقونية', 'iconic'),
                'singular_name' => __('شخصية أيقونية', 'iconic'),
                'add_new' => __('أضف شخصية جديدة', 'iconic'),
                'edit_item' => __('تعديل الملف الشخصي', 'iconic'),
            ],
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'profiles', 'with_front' => false],
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
            'menu_icon' => 'dashicons-star-filled',
            'show_in_rest' => true,
        ]);

        // 4. Special Features (ملفات خاصة)
        register_post_type('special_feature', [
            'labels' => [
                'name' => __('ملفات خاصة', 'iconic'),
                'singular_name' => __('ملف خاص', 'iconic'),
                'add_new' => __('أضف ملفاً خاصاً', 'iconic'),
                'edit_item' => __('تعديل الملف الخاص', 'iconic'),
            ],
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'special-features', 'with_front' => false],
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'],
            'menu_icon' => 'dashicons-portfolio',
            'show_in_rest' => true,
        ]);
    }

    /**
     * Register Taxonomies
     */
    public function register_taxonomies() {
        $post_types = ['post', 'interview', 'video', 'special_feature', 'iconic_profile'];

        // 1. Topics (المجالات الرئيسية) - Hierarchical like Categories
        register_taxonomy('topic', $post_types, [
            'labels' => [
                'name' => __('الأقسام والمجالات', 'iconic'),
                'singular_name' => __('القسم', 'iconic'),
                'search_items' => __('بحث في الأقسام', 'iconic'),
                'all_items' => __('كل الأقسام', 'iconic'),
                'edit_item' => __('تعديل القسم', 'iconic'),
                'update_item' => __('تحديث القسم', 'iconic'),
                'add_new_item' => __('إضافة قسم جديد', 'iconic'),
                'new_item_name' => __('اسم القسم الجديد', 'iconic'),
                'parent_item' => __('القسم الأب', 'iconic'),
                'parent_item_colon' => __('القسم الأب:', 'iconic'),
            ],
            'hierarchical' => true,
            'rewrite' => ['slug' => 'topic', 'with_front' => false],
            'show_in_rest' => true,
            'show_admin_column' => true,
        ]);

        // 2. Content Format (صيغة المحتوى) - Non-hierarchical like Tags but crucial
        register_taxonomy('content_format', $post_types, [
            'labels' => [
                'name' => __('صيغة المحتوى', 'iconic'),
                'singular_name' => __('الصيغة', 'iconic'),
                'search_items' => __('بحث في الصيغ', 'iconic'),
                'all_items' => __('كل الصيغ', 'iconic'),
                'edit_item' => __('تعديل الصيغة', 'iconic'),
                'update_item' => __('تحديث الصيغة', 'iconic'),
                'add_new_item' => __('إضافة صيغة جديدة', 'iconic'),
                'new_item_name' => __('اسم الصيغة الجديدة', 'iconic'),
            ],
            'hierarchical' => false,
            'rewrite' => ['slug' => 'format', 'with_front' => false],
            'show_in_rest' => true,
            'show_admin_column' => true,
        ]);

        // 3. Projects (المشاريع والسلاسل)
        register_taxonomy('project', $post_types, [
            'labels' => [
                'name' => __('المشاريع والسلاسل', 'iconic'),
                'singular_name' => __('المشروع', 'iconic'),
                'search_items' => __('بحث في المشاريع', 'iconic'),
                'all_items' => __('كل المشاريع', 'iconic'),
                'edit_item' => __('تعديل المشروع', 'iconic'),
                'update_item' => __('تحديث المشروع', 'iconic'),
                'add_new_item' => __('إضافة مشروع جديد', 'iconic'),
                'new_item_name' => __('اسم المشروع الجديد', 'iconic'),
            ],
            'hierarchical' => true, // Allow hierarchy for seasons/series
            'rewrite' => ['slug' => 'project', 'with_front' => false],
            'show_in_rest' => true,
            'show_admin_column' => true,
        ]);
    }

    /**
     * Add CPT/Taxonomy classes to body for specific styling
     */
    public function add_content_type_classes($classes) {
        if (is_singular()) {
            global $post;
            if ($post) {
                $classes[] = 'single-type-' . $post->post_type;
                
                // Add format class
                $formats = get_the_terms($post->ID, 'content_format');
                if ($formats && !is_wp_error($formats)) {
                    foreach ($formats as $format) {
                        $classes[] = 'format-' . $format->slug;
                    }
                }
                
                // Add project class
                $projects = get_the_terms($post->ID, 'project');
                if ($projects && !is_wp_error($projects)) {
                    foreach ($projects as $project) {
                        $classes[] = 'project-' . $project->slug;
                    }
                }
            }
        }
        return $classes;
    }

    /**
     * Force specific template hierarchy for CPTs if needed
     */
    public function custom_single_template_hierarchy($templates) {
        global $post;
        if ($post && $post->post_type !== 'post' && $post->post_type !== 'page') {
            // Insert single-{post_type}.php before single.php
            array_unshift($templates, 'single-' . $post->post_type . '.php');
        }
        return $templates;
    }
}

// Initialize
ICONIC_Core_Setup::get_instance();
