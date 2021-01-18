<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @since xooblog 1.0
 */

get_header();
?>

<!-- Start Blog -->
<div class="blog_area xooblog_error_page">
    <div class="container section-padding ">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="xooblog_blog_parent text-center">

                    <div class="xooblog_single_blog">

                        <div class="xooblog_blog_content">
                            <h3 class="title-line">
                                <?php _e('Oops! That page cannot be found', 'xooblog'); ?>
                            </h3>
                            <p>
                                <?php _e('It looks like nothing was found at this location. Maybe try a search?', 'xooblog'); ?>
                            </p>
                            <div class="row">
                                <div class="col-sm-6 offset-sm-3">
                                <?php get_search_form(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog Area -->





<?php
get_footer();
