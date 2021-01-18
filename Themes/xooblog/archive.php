<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @since xooblog 1.0
 */

get_header();

$xooblog_layout_class = 'col-md-10 offset-md-1';
if(is_active_sidebar('sidebar-1')){
    $xooblog_layout_class = 'col-lg-8 col-md-12';
}



?>
<?php if (have_posts()) : ?>

    <div class="blog_area xooblog_section_padding_bottom xooblog_section_padding_top" id="site-content">
        <div class="container section-padding">
			<header class="xooblog_page_header pb-5">
				<?php
				the_archive_title('<h1 class="page-title">', '</h1>');
				?>
				<?php the_archive_description(); ?>
			</header><!-- .page-header -->
            <div class="row">
                <div class="<?php echo esc_attr($xooblog_layout_class);?>">
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
                        <div class="row">
                            <div class="col">
                                <div class="xooblog_pagination_contaier mb-100">
                                    <?php xooblog_the_posts_pagination(); ?>
                                </div>
                            </div>
                        </div>
                    <?php


                else :

                    get_template_part('template-parts/post-formats/post', 'none');

                endif;
                    ?>
                        </div>
                    </div>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>

    <?php
    get_footer();
