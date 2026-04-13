<?php
/**
 * Template part for displaying results in search pages
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
    <a href="<?php the_permalink(); ?>" class="card-image">
        <?php the_post_thumbnail('iconic-card'); ?>
    </a>
    <?php endif; ?>
    
    <div class="card-content">
        <h3 class="card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        
        <p class="card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
        
        <div class="card-meta">
            <span class="card-meta-item">
                <?php echo get_the_date(); ?>
            </span>
            <span class="card-meta-item">
                <?php echo get_the_category_list(', '); ?>
            </span>
        </div>
    </div>
</article>
