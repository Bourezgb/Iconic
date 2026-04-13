<?php
/**
 * Navigation Functions
 */

// Register navigation walker if needed
class ICONIC_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }
}

// Add body classes for navigation
function iconic_nav_body_classes($classes) {
    if (is_user_logged_in()) {
        $classes[] = 'logged-in';
    }
    
    if (has_nav_menu('primary')) {
        $classes[] = 'has-primary-menu';
    }
    
    return $classes;
}
add_filter('body_class', 'iconic_nav_body_classes');
