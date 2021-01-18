<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package composition-book
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php composition_book_post_thumbnail( 'thumbnail' ); ?>
	<header class="entry-header">
		<?php 
		the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<div> <?php composition_book_posted_on(); ?><div>
			<div><?php composition_book_posted_by(); ?></div>
			<div class='tags'><?php composition_book_entry_footer(); ?></div>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	
</article><!-- #post-<?php the_ID(); ?> -->

