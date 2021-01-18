<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package composition-book
 */

if ( ! is_active_sidebar( 'sidebar-right' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area content-sidebar sidebar-right" role="complementary">
	<?php dynamic_sidebar( 'sidebar-right' ); ?>
</aside><!-- #secondary -->
