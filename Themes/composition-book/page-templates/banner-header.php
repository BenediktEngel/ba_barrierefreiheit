<?php
/**
 * Template Name: Banner Header
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package composition-book
 */

get_header( 'banner-header' );
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content-page/content', 'banner-header-page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
			?>
			<div class="col-80">
				<div class="col-60">
					<?php comments_template(); ?>
				</div><!--.col-60-->
			</div><!--.col-80-->
			<?php
			endif;

		endwhile; // End of the loop.
		?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();