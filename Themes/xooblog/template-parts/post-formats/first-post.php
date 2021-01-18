<?php
// Must be inside a loop.
$no_post_style = 'no_thumbnail';
if (has_post_thumbnail()) {
    $no_post_style = '';
} 

if (is_sticky()) {
?>

    <div <?php post_class('col-sm-12'); ?> id="post-<?php the_ID(); ?>">
        <!--  -->
        <article class="post-item <?php echo esc_attr($no_post_style);?>">
            <div class="post-header">
                <figure class="post-image">
                    <a href="<?php the_permalink(); ?>"> 
                        <?php the_post_thumbnail('xooblog_banner_image'); ?>
                    </a>
                </figure>
                <div class="post-category">
                    <?php

                    $categories = get_the_category();
                    $separator = ' ';
                    $output = '';
                    if (!empty($categories)) {
                        foreach ($categories as $category) {
                            $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" alt="' . esc_attr(sprintf(__('View all posts in %s', 'xooblog'), $category->name)) . '">' . esc_html($category->name) . '</a>' . $separator;
                        }
                        echo trim($output, $separator);
                    }
                    ?>
                </div>
            </div>
            <div class="post-content">
                <a href="<?php the_permalink(); ?>" class="post-title">
                    <h2>
                        <?php the_title(); ?>
                    </h2>
                </a>
                <div class="post-meta">
                <?php 
                $archive_year  = get_the_time( 'Y' ); 
                $archive_month = get_the_time( 'm' ); 
                $archive_day   = get_the_time( 'd' ); 
                ?>
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="post-author">
                    
                        <?php the_author(); ?>
                    </a> 
					<a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>" class="posted-on">
                        <?php echo get_the_date(); ?>
                    </a>
                </div>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" class="more-post btn">
                    <?php _e('Read More..', 'xooblog') ?>
                </a>
            </div>
        </article>
        <!--  -->
    </div>
<?php

} else { ?>


    <div <?php post_class('col-lg-12 col-md-12'); ?> id="post-<?php the_ID(); ?>">
        <!-- article -->
        <article class="post-item <?php echo esc_attr($no_post_style);?>">
            <div class="post-header">
                <figure class="post-image">
                    <a href="<?php the_permalink(); ?>"> 
                        <?php the_post_thumbnail('xooblog_banner_image'); ?>
                    </a>
                </figure>
                <div class="post-category">
                    <?php

                    $categories = get_the_category();
                    $separator = ' ';
                    $output = '';
                    if (!empty($categories)) {
                        foreach ($categories as $category) {
                            $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" alt="' . esc_attr(sprintf(__('View all posts in %s', 'xooblog'), $category->name)) . '">' . esc_html($category->name) . '</a>' . $separator;
                        }
                        echo trim($output, $separator);
                    }

                    ?>
                </div>
            </div>
            <div class="post-content">
                <a href="<?php the_permalink(); ?>" class="post-title">
                    <h2>
                        <?php the_title(); ?>
                    </h2>
                </a>
                <div class="post-meta">
                    <a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>" class="posted-on">
                    <span class="dashicons dashicons-clock"></span>
                        <?php echo get_the_date(); ?>
                    </a>
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="post-author">
                    <span class="dashicons dashicons-admin-users"></span>
                        <?php the_author(); ?>
                    </a>
                </div>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" class="more-post btn">
                    <?php _e('Read More..', 'xooblog') ?>
                </a>
            </div>
        </article>
        <!-- article -->
    </div>
<?php
}


?>