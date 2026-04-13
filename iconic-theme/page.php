<?php get_header(); ?>

<main class="site-main page-single">
    <div class="container">
        
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
                
                <header class="page-header">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                </header>
                
                <?php if (has_post_thumbnail()) : ?>
                <div class="page-featured-image">
                    <?php the_post_thumbnail('iconic-featured'); ?>
                </div>
                <?php endif; ?>
                
                <div class="page-body">
                    <?php the_content(); ?>
                </div>
                
            </article>
            
        <?php endwhile; ?>
        
    </div>
</main>

<?php get_footer(); ?>
