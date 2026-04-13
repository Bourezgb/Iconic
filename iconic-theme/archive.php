<?php
/**
 * Archive Template
 */

get_header();
?>

<div class="container section-padding">
    <header style="margin-bottom: 3rem; text-align: center;">
        <?php the_archive_title('<h1 class="section-title">', '</h1>'); ?>
        <?php the_archive_description('<div style="color: #a0a0b0; max-width: 600px; margin: 1rem auto;">', '</div>'); ?>
    </header>
    
    <?php if (have_posts()) : ?>
        <div class="posts-grid">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </a>
                        </div>
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
            <?php endwhile; ?>
        </div>
        
        <?php
        the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => __('Previous', 'iconic'),
            'next_text' => __('Next', 'iconic'),
        ));
        ?>
        
    <?php else : ?>
        <div class="text-center" style="padding: 4rem 0;">
            <h2><?php _e('No posts found', 'iconic'); ?></h2>
        </div>
    <?php endif; ?>
</div>

<?php
get_footer();
