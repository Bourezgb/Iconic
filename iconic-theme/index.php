<?php
/**
 * The main template file
 * 
 * @package ICONIC
 */

get_header();
?>

<div class="hero-section">
    <div class="container">
        <h1 class="hero-title"><?php bloginfo('name'); ?></h1>
        <p class="hero-subtitle"><?php bloginfo('description'); ?></p>
    </div>
</div>

<div class="container">
    <div class="content-grid">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <article class="article-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
                        </a>
                    <?php endif; ?>
                    
                    <div class="article-card-content">
                        <h2 class="article-card-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        
                        <div class="article-card-meta">
                            <?php echo get_the_date(); ?> | <?php echo get_the_category_list(', '); ?>
                        </div>
                        
                        <a href="<?php the_permalink(); ?>" class="read-more">اقرأ المزيد &larr;</a>
                    </div>
                </article>
                <?php
            endwhile;
        else :
            ?>
            <p><?php _e('No content found. Please add some posts.', 'iconic'); ?></p>
            <?php
        endif;
        ?>
    </div>
</div>

<?php
get_footer();
