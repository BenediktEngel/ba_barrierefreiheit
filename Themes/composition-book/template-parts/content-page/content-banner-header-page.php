<?php
/**
 * Template part for displaying page content in banner-header.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package composition-book
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php composition_book_post_thumbnail() ?>
	<div class="col-80">
		<div class="col-60">
			<div class="banner-header-content-wrap"> 
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				 
				<div class="entry-content">
					<?php
					the_content();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'composition-book' ),
						'after'  => '</div>',
					) );
					?>
				</div><!-- .entry-content -->

				<?php if ( get_edit_post_link() ) : ?>
					<footer class="entry-footer">
						<?php composition_book_edit_link(); ?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>
			</div><!--.banner-header-content-wrap-->
		</div><!--.col-60-->
	</div><!--.col-80-->
</article><!-- #post-<?php the_ID(); ?> -->