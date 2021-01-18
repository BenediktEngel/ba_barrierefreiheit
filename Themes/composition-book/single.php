<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package composition-book
 */

get_header();
?>
	<div class="col-80">
		<div id="primary" class="content-area">
			<div aria-hidden="true">
				<?php 
				/*
				Post thumbnail for sighted visitors,
				Screen reader only post thumbnail will appear within <main>
				to avoid orphaned content.
				*/
				composition_book_post_thumbnail() 
				?>
			</div>
			<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) :
				the_post();
						
				get_template_part( 'template-parts/content-post/content', 'post-single' );

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->	
		</div><!--.content-area-->
		<?php 
		get_sidebar( 'single' );
		get_template_part('template-parts/post', 'navigation' );
	
		// If comments are open or we have at least one comment, load up the comment template.
		
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif; 
		?>
	</div><!--.col-80-->

<?php
get_footer();
