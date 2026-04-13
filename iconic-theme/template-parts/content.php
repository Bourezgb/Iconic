<?php
/**
 * Template part for displaying posts
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if (is_singular()) :
            iconic_categories_badge();
            the_title('<h1 class="entry-title">', '</h1>');
            iconic_post_meta();
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>');
        endif;

        if (has_post_thumbnail() && !is_singular()) :
            ?>
            <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('large', array('loading' => 'lazy')); ?>
                </a>
            </div>
            <?php
        endif;
        ?>
    </header>

    <div class="entry-content">
        <?php
        if (is_singular()) {
            the_content();
        } else {
            the_excerpt();
        }
        ?>
    </div>

    <?php if (is_singular()) : ?>
        <footer class="entry-footer">
            <?php
            // Post tags
            $tags = get_the_tags();
            if ($tags) {
                echo '<div class="post-tags">';
                foreach ($tags as $tag) {
                    echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="tag-link">' . esc_html($tag->name) . '</a>';
                }
                echo '</div>';
            }
            ?>
        </footer>
    <?php endif; ?>
</article>
