<?php
/**
 * Core Setup: Custom Post Types & Taxonomies
 * Safe implementation with error checking
 */

function iconic_register_post_types() {
    // Interview CPT
    register_post_type('interview', array(
        'labels' => array(
            'name' => __('مقابلات', 'iconic'),
            'singular_name' => __('مقابلة', 'iconic'),
            'add_new' => __('أضف مقابلة جديدة', 'iconic'),
            'add_new_item' => __('أضف مقابلة جديدة', 'iconic'),
            'edit_item' => __('تعديل المقابلة', 'iconic'),
            'view_item' => __('عرض المقابلة', 'iconic'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-microphone',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'interviews'),
    ));

    // Video CPT
    register_post_type('video', array(
        'labels' => array(
            'name' => __('فيديو', 'iconic'),
            'singular_name' => __('فيديو', 'iconic'),
            'add_new' => __('أضف فيديو جديد', 'iconic'),
            'add_new_item' => __('أضف فيديو جديد', 'iconic'),
            'edit_item' => __('تعديل الفيديو', 'iconic'),
            'view_item' => __('عرض الفيديو', 'iconic'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-video-alt3',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'videos'),
    ));
}
add_action('init', 'iconic_register_post_types');

function iconic_register_taxonomies() {
    // Content Format Taxonomy
    register_taxonomy('content_format', array('post', 'interview', 'video'), array(
        'labels' => array(
            'name' => __('صيغة المحتوى', 'iconic'),
            'singular_name' => __('صيغة المحتوى', 'iconic'),
            'all_items' => __('جميع الصيغ', 'iconic'),
            'edit_item' => __('تعديل الصيغة', 'iconic'),
            'update_item' => __('تحديث الصيغة', 'iconic'),
            'add_new_item' => __('أضف صيغة جديدة', 'iconic'),
        ),
        'hierarchical' => false,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'format'),
        'show_in_rest' => true,
    ));

    // Project Taxonomy
    register_taxonomy('project', array('post', 'interview', 'video'), array(
        'labels' => array(
            'name' => __('المشاريع', 'iconic'),
            'singular_name' => __('مشروع', 'iconic'),
            'all_items' => __('جميع المشاريع', 'iconic'),
            'edit_item' => __('تعديل المشروع', 'iconic'),
            'update_item' => __('تحديث المشروع', 'iconic'),
            'add_new_item' => __('أضف مشروع جديد', 'iconic'),
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'project'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'iconic_register_taxonomies');
