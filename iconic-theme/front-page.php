<?php
/**
 * Front Page Template
 * Custom homepage with Hero section
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-bg"></div>
    <div class="hero-content">
        <h1 class="hero-title text-gradient">
            <?php _e('We Are Iconic', 'iconic'); ?>
        </h1>
        <p class="hero-subtitle">
            <?php _e('منصة إعلامية جزائرية رقمية تحتفي بالأصالة، العصرية، والابتكار', 'iconic'); ?>
        </p>
        <a href="#latest" class="btn-primary">
            <?php _e('اكتشف المزيد', 'iconic'); ?>
        </a>
    </div>
</section>

<!-- Latest Posts Section -->
<section id="latest" class="section-padding">
    <div class="container">
        <h2 class="section-title"><?php _e('أحدث المقالات', 'iconic'); ?></h2>
        
        <div class="posts-grid">
            <?php
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => 6,
                'ignore_sticky_posts' => true,
            );
            
            $latest_query = new WP_Query($args);
            
            if ($latest_query->have_posts()) :
                while ($latest_query->have_posts()) : $latest_query->the_post();
                    get_template_part('template-parts/content', 'card');
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>' . __('لا توجد مقالات حالياً', 'iconic') . '</p>';
            endif;
            ?>
        </div>
    </div>
</section>

<?php
get_footer();
