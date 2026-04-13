<?php
/**
 * Search Form Template
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text"><?php _e('ابحث عن:', 'iconic'); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('بحث...', 'placeholder', 'iconic'); ?>" value="<?php echo get_search_query(); ?>" name="s">
    </label>
    <button type="submit" class="search-submit">
        <span><?php _e('بحث', 'iconic'); ?></span>
    </button>
</form>
