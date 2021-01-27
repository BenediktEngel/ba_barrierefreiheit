        <figure class="post-image">
            <?php the_post_thumbnail(); ?>
        </figure>

        <article class="post-item tecxoo-post-details">
            <div class="post-header">

                <h1 class="post-title">
                    <?php the_title(); ?>
                </h1>
                <div class="post-meta">
                    <div class="tecxoo-post-date-author">
                        <?php
                        $archive_year  = get_the_time('Y');
                        $archive_month = get_the_time('m');
                        $archive_day   = get_the_time('d');
                        ?>
                        <a href="<?php echo esc_url(get_day_link($archive_year, $archive_month, $archive_day)); ?>" class="posted-on">
                            <span class="dashicons dashicons-clock"></span>
                            <?php echo get_the_date(); ?>
                        </a>
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="post-author">
                        <span class="dashicons dashicons-admin-users"></span>
                            <?php the_author(); ?>
                        </a>
                    </div>
                    <div class="tecxoo-comments-like">
                        <a href="<?php echo esc_url(get_comments_link($post->ID)); ?>" class="total-comments">
                            <span class="dashicons dashicons-admin-comments"></span>
                            <?php
                            $xooblog_comment_num = get_comments_number();
                            echo esc_html($xooblog_comment_num);
                            ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="post-content">
                <?php
                the_content();
                wp_link_pages(
                    array(
                        'before' => '<div class="page-links xooblog_page_links">' . __('Pages:', 'xooblog'),
                        'after'  => '</div>',
                    )
                );
                ?>
            </div>
            <!--  -->
            <div class="tecxoo-post-share">

                <div class="post-category">
                    <span>
                        <?php

                        $categories = get_the_category();
                        $separator = ' ';
                        $output = '';
                        if (!empty($categories)) :
                            _e('Category: ', 'xooblog');
                        endif;

                        ?>
                    </span>
                    <?php

                    // Ausgabe der Kategorien angepasst, sodass der Fehler aus Prüfschritt 4.1.1a behoben wird.
                    if (!empty($categories)) {
	                    foreach ($categories as $category) {
		                    $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '"><span class="screen-reader-text">View all posts in </span>' . esc_html($category->name) . '</a>' . $separator;
	                    }
                    echo trim($output, $separator);
                    }
                    ?>
                </div>
                <div class="post-tags">
                    <span>

                        <?php
                        $post_tags = get_the_tags();
                       

                        if (!empty($post_tags)) :
                            _e('Tags: ', 'xooblog');
                        endif;

                        ?>
                    </span>
                    <?php

$post_tags = get_the_tags();
                        $separator = ' | ';
if (!empty($post_tags)) {
    foreach ($post_tags as $tag) {
        $output .= '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>' . $separator;
    }
    echo  trim($output, $separator);
}

                    ?>
                </div>
            </div>

            <!--  -->
            <!--  -->
        </article>

        <?php if (!is_singular('attachment')) : ?>
            <?php get_template_part('template-parts/post-formats/author', 'bio'); ?>
        <?php endif; ?>