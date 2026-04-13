<?php
/**
 * Custom search form
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="sr-only" for="search-field"><?php esc_html_e('Search for:', 'iconic'); ?></label>
    <input 
        type="search" 
        id="search-field" 
        class="search-input" 
        placeholder="<?php esc_attr_e('ابحث عن مقالات، فيديوهات، شخصيات...', 'iconic'); ?>" 
        value="<?php echo get_search_query(); ?>" 
        name="s" 
    />
    <button type="submit" class="search-submit">
        <?php echo iconic_get_svg_icon('search'); ?>
        <span class="sr-only"><?php esc_html_e('Search', 'iconic'); ?></span>
    </button>
</form>
