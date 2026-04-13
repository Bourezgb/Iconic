<?php get_header(); ?>

<main class="site-main single-post">
    <div class="container">
        
        <?php while (have_posts()) : the_post(); ?>
            
            <!-- Post Hero -->
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>
                
                <header class="post-hero">
                    <!-- Categories -->
                    <div class="post-categories">
                        <?php echo iconic_get_culture_sections(); ?>
                    </div>
                    
                    <!-- Title -->
                    <h1 class="post-title-single"><?php the_title(); ?></h1>
                    
                    <!-- Meta -->
                    <div class="post-meta-single">
                        <span class="meta-author">
                            <?php echo iconic_get_svg_icon('user'); ?>
                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                <?php the_author(); ?>
                            </a>
                        </span>
                        <span class="meta-date">
                            <?php echo get_the_date(); ?>
                        </span>
                        <span class="meta-reading-time">
                            <?php echo iconic_get_svg_icon('clock'); ?>
                            <?php echo iconic_get_reading_time(); ?>
                        </span>
                    </div>
                </header>
                
                <!-- Featured Image -->
                <?php if (has_post_thumbnail()) : ?>
                <div class="post-featured-image">
                    <?php the_post_thumbnail('iconic-hero'); ?>
                </div>
                <?php endif; ?>
                
                <!-- Post Content -->
                <div class="post-content">
                    <?php the_content(); ?>
                    
                    <!-- Tags -->
                    <?php $tags = get_the_tags(); ?>
                    <?php if ($tags) : ?>
                    <div class="post-tags">
                        <?php foreach ($tags as $tag) : ?>
                        <a href="<?php echo esc_url(get_tag_link($tag)); ?>" class="tag-pill">
                            #<?php echo esc_html($tag->name); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Share Buttons -->
                    <div class="post-share">
                        <h4><?php esc_html_e('شارك المقال', 'iconic'); ?></h4>
                        <?php echo iconic_get_share_links(); ?>
                    </div>
                </div>
                
                <!-- Author Box -->
                <div class="author-box">
                    <div class="author-avatar">
                        <?php echo iconic_get_author_avatar(); ?>
                    </div>
                    <div class="author-info">
                        <h4><?php the_author(); ?></h4>
                        <p><?php echo get_the_author_meta('description'); ?></p>
                    </div>
                </div>
                
                <!-- Related Posts -->
                <?php 
                $related = iconic_get_related_posts(get_the_ID(), 3);
                if ($related) :
                ?>
                <section class="related-posts">
                    <h3 class="section-title"><?php esc_html_e('مقالات ذات صلة', 'iconic'); ?></h3>
                    <div class="article-grid">
                        <?php foreach ($related as $post) : setup_postdata($post); ?>
                        <article class="article-card">
                            <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="card-image">
                                <?php the_post_thumbnail('iconic-card'); ?>
                            </a>
                            <?php endif; ?>
                            <div class="card-content">
                                <h4 class="card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                            </div>
                        </article>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </section>
                <?php endif; ?>
                
                <!-- Comments -->
                <?php 
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
                
            </article>
            
        <?php endwhile; ?>
        
    </div>
</main>

<?php get_footer(); ?>
