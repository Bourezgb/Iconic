<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_attributes(); ?>>
<header style="padding: 20px; background: #111; border-bottom: 1px solid #333;">
    <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0; font-size: 24px; color: #fff;">
            <a href="<?php echo home_url(); ?>" style="color: #fff; text-decoration: none;">ICONIC</a>
        </h1>
        <nav>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'menu',
                'fallback_cb' => false
            ));
            ?>
        </nav>
    </div>
</header>
