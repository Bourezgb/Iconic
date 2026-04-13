<?php
/**
 * Template part: Post Card
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium_large'); ?>
            </a>
        </div>
    <?php else : ?>
        <div class="post-thumbnail" style="background: linear-gradient(135deg, #1f1f26 0%, #0a0a0c 100%);"></div>
    <?php endif; ?>
    
    <div class="post-content">
        <h2 class="post-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        
        <div class="post-excerpt">
            <?php the_excerpt(); ?>
        </div>
        
        <div class="post-meta">
            <span><?php echo get_the_date(); ?></span>
            <span><?php echo get_the_category_list(', '); ?></span>
        </div>
    </div>
</article>
