<a href="<?php echo esc_url(get_permalink()) ?>" class="hfh-teaser">
    <?php if (has_post_thumbnail()) : ?>
        <div class="hfh-teaser__image">
            <img src="<?= esc_url(the_post_thumbnail_url()) ?>" alt="<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>" />
        </div>
    <?php endif; ?>
    <div class="hfh-teaser__text-container">
        <div class="hfh-teaser__title">
            <?= the_title() ?>
        </div>
        <div class="hfh-teaser__text">
            <?php
            $keyword = get_search_query();
            $output = sprintf('<div>%s</div>', get_the_excerpt(get_the_ID()));
            if (!empty($keyword)) {
                $string = wp_strip_all_tags(strip_shortcodes(get_the_content()));
                if (preg_match("/^.*" . preg_quote($keyword, '/') . ".*$/imu", $string, $matches)) {
                    $result = $matches[0];
                    $regex = "/(" . preg_quote($keyword, '/') . ")/iu";
                    $output = sprintf('<div>%s</div>', preg_replace($regex, "<span class='hfh-search-term'>$1</span>", $result));
                }
            }
            echo $output;
            ?>
        </div>
    </div>
    <svg class="hfh-icon hfh-icon--arrow hfh-teaser__arrow" width="47" height="20" viewBox="0 0 47 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M45 10H0" stroke-width="2" stroke="currentColor" />
        <path d="M36.5 1L45 10L36.5 19" stroke-width="2" stroke="currentColor" />
    </svg>
</a>