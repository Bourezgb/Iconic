<?php get_header(); ?>

<!-- Hero Section with 3D -->
<section class="hero-section">
    <canvas class="hero-canvas" id="hero-canvas"></canvas>
    
    <div class="container">
        <div class="hero-content">
            <?php 
            $featured_args = array(
                'posts_per_page' => 1,
                'meta_key'       => '_thumbnail_id',
            );
            $featured_query = new WP_Query($featured_args);
            
            if ($featured_query->have_posts()) : 
                while ($featured_query->have_posts()) : $featured_query->the_post();
            ?>
            
            <div class="hero-badge">
                <span><?php esc_html_e('القصة المميزة', 'iconic'); ?></span>
            </div>
            
            <h1 class="hero-title"><?php the_title(); ?></h1>
            
            <p class="hero-subtitle"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
            
            <div class="hero-cta">
                <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                    <?php esc_html_e('اقرأ المقال', 'iconic'); ?>
                </a>
                <a href="#latest" class="btn btn-secondary">
                    <?php esc_html_e('اكتشف المزيد', 'iconic'); ?>
                </a>
            </div>
            
            <?php 
                endwhile;
                wp_reset_postdata();
            else :
            ?>
            
            <div class="hero-badge">
                <span><?php esc_html_e('مرحباً بكم في ICONIC', 'iconic'); ?></span>
            </div>
            
            <h1 class="hero-title"><?php esc_html_e('موطن كل ما هو استثنائي', 'iconic'); ?></h1>
            
            <p class="hero-subtitle">
                <?php esc_html_e('منصة إعلامية جزائرية رقمية تحتفي بالأصالة، العصرية، والابتكار في الثقافة والفن والإعلام', 'iconic'); ?>
            </p>
            
            <div class="hero-cta">
                <a href="#latest" class="btn btn-primary">
                    <?php esc_html_e('استكشف المحتوى', 'iconic'); ?>
                </a>
            </div>
            
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Featured Categories Strip -->
<section class="categories-strip">
    <div class="container">
        <div class="category-pills-wrapper">
            <?php
            $sections = get_terms(array(
                'taxonomy'   => 'culture_section',
                'hide_empty' => true,
                'number'     => 8,
            ));
            
            if (!empty($sections) && !is_wp_error($sections)) :
                foreach ($sections as $section) :
            ?>
            <a href="<?php echo esc_url(get_term_link($section)); ?>" class="category-pill">
                <?php echo esc_html($section->name); ?>
            </a>
            <?php 
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Latest Editorial Grid -->
<section class="latest-section" id="latest">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php esc_html_e('أحدث المقالات', 'iconic'); ?></h2>
            <a href="<?php echo esc_url(home_url('/blog')); ?>" class="section-link">
                <?php esc_html_e('عرض الكل', 'iconic'); ?>
                <?php echo iconic_get_svg_icon('arrow-right'); ?>
            </a>
        </div>
        
        <div class="article-grid">
            <?php
            $latest_args = array(
                'posts_per_page' => 6,
                'post__not_in'   => array(get_the_ID()),
            );
            $latest_query = new WP_Query($latest_args);
            
            $counter = 0;
            while ($latest_query->have_posts()) : $latest_query->the_post();
                $counter++;
                $is_featured = ($counter === 1);
            ?>
            
            <article class="article-card <?php echo $is_featured ? 'featured' : ''; ?>">
                <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>" class="card-image">
                    <?php the_post_thumbnail($is_featured ? 'iconic-featured' : 'iconic-card'); ?>
                    <span class="card-category"><?php echo iconic_get_post_categories(); ?></span>
                </a>
                <?php endif; ?>
                
                <div class="card-content">
                    <h3 class="card-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    
                    <p class="card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                    
                    <div class="card-meta">
                        <span class="card-meta-item">
                            <?php echo iconic_get_svg_icon('clock'); ?>
                            <?php echo iconic_get_reading_time(); ?>
                        </span>
                        <span class="card-meta-item">
                            <?php echo get_the_date(); ?>
                        </span>
                    </div>
                </div>
            </article>
            
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<!-- Video Section -->
<section class="video-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php esc_html_e('فيديو', 'iconic'); ?></h2>
            <a href="<?php echo esc_url(home_url('/videos')); ?>" class="section-link">
                <?php esc_html_e('كل الفيديوهات', 'iconic'); ?>
                <?php echo iconic_get_svg_icon('arrow-right'); ?>
            </a>
        </div>
        
        <div class="video-grid">
            <?php
            $video_args = array(
                'post_type'      => 'video',
                'posts_per_page' => 4,
            );
            $video_query = new WP_Query($video_args);
            
            while ($video_query->have_posts()) : $video_query->the_post();
            ?>
            
            <article class="video-card">
                <a href="<?php the_permalink(); ?>" class="card-image">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('iconic-card'); ?>
                    <?php else : ?>
                        <img src="<?php echo ICONIC_URI; ?>/assets/images/video-placeholder.jpg" alt="">
                    <?php endif; ?>
                    
                    <div class="play-overlay">
                        <div class="play-button"></div>
                    </div>
                    
                    <span class="video-duration">10:25</span>
                </a>
                
                <div class="card-content">
                    <h3 class="card-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                </div>
            </article>
            
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<!-- Manifesto Section -->
<section class="manifesto-section">
    <div class="container">
        <div class="manifesto-content">
            <blockquote class="manifesto-quote">
                <?php esc_html_e('نحن أيقونيون - نؤمن بأن الإعلام يمكن أن يكون فناً، والثقافة يمكن أن تكون ثورة', 'iconic'); ?>
            </blockquote>
            <p class="manifesto-text">
                <?php esc_html_e('منصة تجمع بين الأصالة والحداثة، بين التراث والمستقبل، لنروي قصص الجزائر والعالم بطريقة لم تُروَ من قبل', 'iconic'); ?>
            </p>
        </div>
    </div>
</section>

<?php get_footer(); ?>
