<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php the_title(sprintf('<h2 class="section-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
    <a href="<?php echo esc_url(get_permalink()) ?>" class="entry-summary" rel="bookmark">
        <?php
        $keyword = get_search_query();
        $string = wp_strip_all_tags(strip_shortcodes(get_the_content()));
        if (preg_match("/^.*" . preg_quote($keyword, '/') . ".*$/mi", $string, $matches)) {
            $result = $matches[0];
            $regex = "/(" . preg_quote($keyword, '/') . ")/i";
            echo sprintf('<div>%s</div>', preg_replace($regex, "<span class='hfh-search-term'>$1</span>", $result));
        } else {
            echo sprintf('<div>%s</a>', get_the_excerpt(get_the_ID()));
        }
        ?>
    </a><!-- .entry-summary -->
</div><!-- #post-## -->