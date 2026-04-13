<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container header-inner">
        <div class="site-logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="text-gradient" style="font-size: 1.8rem; font-weight: 700;">
                    ICONIC
                </a>
            <?php endif; ?>
        </div>
        
        <button class="menu-toggle" aria-label="<?php esc_attr_e('Menu', 'iconic'); ?>">
            ☰
        </button>
        
        <nav class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => '',
                'fallback_cb'    => false,
            ));
            ?>
        </nav>
    </div>
</header>

<main id="main" class="site-main">
