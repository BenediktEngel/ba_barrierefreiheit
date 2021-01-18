<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package composition-book
 */

get_header();
?>

	<div id="primary" class="content-area">
		<div class="col-80"> 
			<main id="main" class="site-main">

			<?php if ( have_posts() ) : ?>
				<header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header><!-- .page-header -->
				
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
		</div><!--.col-80-->
	</div><!-- #primary -->

<?php
get_footer();
