<?php
/**
 * image template for displaying posts as part of an index page (index.php, archive.php)
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package composition-book
 */
?>

<article 
	id="post-<?php the_ID(); ?>" 
	<?php post_class( 'cp-post-background-image' ); ?> 
	style="background-image: url(<?php composition_book_background_image( 'small' ) ?>)"
>
	<div class="mask"> 
	<?php if ( is_sticky() && ! is_single() && ! is_paged() ): ?>
		<span class="sticky-icon">
			<span class="screen-reader-text"><?php esc_html_e( 'pinned post' , 'composition-book' ) ?></span>
			<i class="fas fa-lg fa-thumbtack"></i>
		</span>
	<?php endif; ?> 
		
		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<div class="entry-meta">
				<?php
				composition_book_posted_on();
				composition_book_posted_by();
				?>
			</div>
		</header><!-- .entry-header -->
		
	</div><!--.mask-->
</article><!-- #post-<?php the_ID(); ?> -->