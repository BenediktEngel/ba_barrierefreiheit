<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @since xooblog 1.0
 */

get_header();
?>
<?php if (have_posts()) : ?>

    <div class="blog_area xooblog_section_padding_bottom section_padding_bottom" id="site-content">
        <div class="container section-padding">
			<header class="xooblog_page_header  pb-5">
				<h1 class="page-title">
					<?php _e('Search results for: ', 'xooblog'); ?>
					<span class="page-description"><?php echo get_search_query(); ?></span>
				</h1>
			</header><!-- .page-header -->
            <div class="row">
                <div class="col">
                    <div class="xooblog_blog_parent">
                        <div class="row">



                            <?php

                            // Start the Loop.
                            while (have_posts()) :
                                the_post();

                                /*
* Include the Post-Format-specific template for the content.
* If you want to override this in a child theme, then include a file
* called content-___.php (where ___ is the Post Format name) and that
* will be used instead.
*/
                                get_template_part('template-parts/post-formats/post', get_post_type());

                            endwhile;

                            ?>
                        <?php

                    else :

                        get_template_part('template-parts/post-formats/post', 'none');

                    endif;
                        ?>
                        </div>
                        <div class="row">
                                <div class="col-sm-12">
                                    <div class="xooblog_pagination_contaier">
                                        <?php xooblog_the_posts_pagination(); ?>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    get_footer();
