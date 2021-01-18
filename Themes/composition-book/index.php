<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package composition-book
 */

get_header();
?>
		
	<div id="primary" class="content-area">
		<div class="col-80">
			<main id="main" class="site-main" role="main">

			<?php

			if ( is_home() && !is_paged() && get_theme_mod( 'composition_book_panels_homepage', false ) ){
				get_template_part( 'template-parts/panels' );
			}

			if ( have_posts() ) :
				if ( is_home() && ! is_front_page() ) :
					?>
					<header class="page-header">
						<h1 class="page-title"><?php single_post_title(); ?></h1>
					</header>
					<?php
				endif;

				?>
				<div id="infinite-scroll-container" class="cp-posts-wrap">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						composition_book_load_post_layout();
						
					endwhile;
					?>
				</div>
				<?php
			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

			</main><!-- #main -->
			<?php the_posts_navigation(); ?>
		</div>
	</div><!-- #primary -->

<?php
get_footer();
