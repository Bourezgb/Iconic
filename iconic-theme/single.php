<?php
/**
 * Single Post Template
 */

get_header();
?>

<div class="single-post-container">
    <?php while (have_posts()) : the_post(); ?>
        
        <header class="single-header">
            <h1 class="single-title"><?php the_title(); ?></h1>
            
            <div class="single-meta">
                <span><?php echo get_the_date(); ?></span>
                <span><?php echo get_the_author(); ?></span>
                <span><?php echo get_the_category_list(', '); ?></span>
            </div>
        </header>
        
        <?php if (has_post_thumbnail()) : ?>
            <div style="width: 100%; padding-top: 56.25%; position: relative; margin-bottom: 3rem; border-radius: 12px; overflow: hidden;">
                <?php the_post_thumbnail('large', array('style' => 'position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;')); ?>
            </div>
        <?php endif; ?>
        
        <article class="single-content">
            <?php the_content(); ?>
        </article>
        
        <?php
        // Post navigation
        the_post_navigation(array(
            'prev_text' => '<span class="nav-subtitle">' . __('Previous:', 'iconic') . '</span> <span class="nav-title">%title</span>',
            'next_text' => '<span class="nav-subtitle">' . __('Next:', 'iconic') . '</span> <span class="nav-title">%title</span>',
        ));
        
        // Comments
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        
    endwhile;
?>
</div>

<?php
get_footer();
