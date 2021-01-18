<?php get_header(); 

$xooblog_layout_class = 'col-md-10 offset-md-1';
if(is_active_sidebar('sidebar-1')){
    $xooblog_layout_class = 'col-lg-8 col-md-12';
}



?>


<!--  -->
<div class="home-page">
    <div class="container section-padding">
        <div class="row">
            <div class="<?php echo esc_attr($xooblog_layout_class);?> " id="site-content">
                <div class="post-area">
                    <div class="row">

                        <?php
                        $first = true;
                        if (have_posts()) :

                            if (is_home() && !is_front_page()) :
                        ?>
                                <header>
                                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                                </header>
                            <?php
                            endif;

                            /* Start the Loop */
                            while (have_posts()) :
                                the_post();
                               if ( $first && !is_sticky() ): 
                                    get_template_part('template-parts/post-formats/first-post', get_post_type());
                                    $first = false; 
                                    else :
                                    get_template_part('template-parts/post-formats/post', get_post_type());
                                endif; 

                                /*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
                                

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
            <!--  -->
            <?php get_sidebar(); ?>
            <!--  -->
        </div>
    </div>
</div>
<!--  -->


<?php get_footer(); ?>