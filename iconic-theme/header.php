<?php
/**
 * Header template
 * 
 * @package ICONIC
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'iconic'); ?></a>

    <header class="site-header" id="masthead">
        <div class="container">
            <div class="header-inner">
                
                <!-- Logo -->
                <div class="site-logo">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-text">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Primary Navigation -->
                <nav class="primary-navigation" id="site-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'primary-menu-list',
                        'depth'          => 3,
                        'fallback_cb'    => false,
                    ));
                    ?>
                </nav>

                <!-- Header Actions -->
                <div class="header-actions">
                    
                    <!-- Search Button -->
                    <button class="icon-button search-toggle" aria-label="<?php esc_attr_e('Search', 'iconic'); ?>">
                        <?php echo iconic_get_svg_icon('search'); ?>
                    </button>
                    
                    <!-- Language Switcher Placeholder -->
                    <button class="icon-button language-switcher" aria-label="<?php esc_attr_e('Switch Language', 'iconic'); ?>">
                        <span class="lang-current">عربي</span>
                    </button>
                    
                    <!-- Mobile Menu Toggle -->
                    <button class="icon-button menu-toggle" aria-label="<?php esc_attr_e('Menu', 'iconic'); ?>" aria-expanded="false">
                        <?php echo iconic_get_svg_icon('menu'); ?>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobile-menu">
        <div class="mobile-menu-inner">
            <div class="mobile-menu-header">
                <button class="icon-button menu-close" aria-label="<?php esc_attr_e('Close Menu', 'iconic'); ?>">
                    <?php echo iconic_get_svg_icon('close'); ?>
                </button>
            </div>
            
            <nav class="mobile-menu">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'mobile',
                    'menu_id'        => 'mobile-menu-list',
                    'menu_class'     => 'mobile-menu-list',
                    'depth'          => 3,
                    'fallback_cb'    => 'wp_page_menu',
                ));
                ?>
            </nav>
            
            <!-- Mobile Social Links -->
            <div class="mobile-social-links">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'social',
                    'menu_class'     => 'social-links',
                    'depth'          => 1,
                    'fallback_cb'    => false,
                ));
                ?>
            </div>
        </div>
    </div>

    <!-- Search Overlay -->
    <div class="search-overlay" id="search-overlay">
        <div class="search-form-container">
            <button class="icon-button search-close" aria-label="<?php esc_attr_e('Close Search', 'iconic'); ?>">
                <?php echo iconic_get_svg_icon('close'); ?>
            </button>
            
            <?php get_search_form(); ?>
        </div>
    </div>
