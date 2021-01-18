<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
			while ( have_posts() ) :
				the_post();
				
				get_template_part( 'template-parts/content-page/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
				?>	
					<div class="col-60"> 
						<?php comments_template(); ?>
					</div>
				<?php
				endif;

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!--.col-80-->
	</div><!-- #primary -->

<?php
get_footer();