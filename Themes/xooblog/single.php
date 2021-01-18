<?php
get_header();



$xooblog_layout_class = 'col-md-10 offset-md-1';
if(is_active_sidebar('sidebar-1')){
    $xooblog_layout_class = 'col-lg-8 col-md-12';
}

?>


<div class="blog-featured-post-container" id="site-content">
    <div class="container section-padding ">
        <div class="row">
            <div class="<?php echo esc_attr($xooblog_layout_class);?>">
                <?php

                // Start the Loop.
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content/content', get_post_type());
                ?>
                    
					<div class="row">
                        <div class="col-sm-12">
                            <?php


                            if (is_singular('attachment')) {
                                // Parent post navigation.
                                the_post_navigation(
                                    array(
                                        /* translators: %s: Parent post link. */
                                        'prev_text' => sprintf(__('<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'xooblog'), '%title'),
                                    )
                                );
                            } elseif (is_singular('post')) {
                                // Previous/next post navigation.
                                the_post_navigation(
                                    array(
                                        'next_text' => 
                                        '<span class="screen-reader-text">' . __('Next post:', 'xooblog') . '</span> ' .
                                        '<span class="meta-nav" aria-hidden="true">' . __('Next:','xooblog') .'<span class="dashicons dashicons-arrow-right-alt"></span>' . '</span> '.
                                            '<span class="post-title">%title</span>',
                                        'prev_text' => '<span class="meta-nav" aria-hidden="true">' . '<span class="dashicons dashicons-arrow-left-alt"></span>' .__('Previous:','xooblog') . '</span> ' .
                                            '<span class="screen-reader-text">' . __('Previous post:', 'xooblog') . '</span> ' .
                                            '<span class="post-title">%title</span>',
                                    )
                                );
                            }

                            // If comments are open or we have at least one comment, load up the comment template.
                            if (comments_open() || get_comments_number()) {
                                comments_template();
                            }

                            ?>
                        </div>
                    </div>
                <?php

                endwhile; // End the loop.
                ?>

            </div>
            <?php is_active_sidebar('sidebar-1') ? get_sidebar() : ''; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>