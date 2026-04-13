<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="site-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                ICONIC<span>.</span>
            </a>
        </div>
        
        <?php if (has_nav_menu('primary')) : ?>
        <nav class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'primary-menu',
                'container'      => false,
                'depth'          => 2,
            ));
            ?>
        </nav>
        <?php endif; ?>
    </div>
</header>

<main id="main-content" class="site-main">
