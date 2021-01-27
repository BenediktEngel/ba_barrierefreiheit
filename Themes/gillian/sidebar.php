<?php
/**
 * Default sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gillian
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area sidebar" role="complementary" aria-label="<?php esc_attr_e( 'Default sidebar', 'gillian' ); ?>">
<!-- Überschrift für die Sidebar hinzugefügt um Fehler aus Prüfschritt 1.3.1a zu beheben. -->
<h2 class="screen-reader-text">Sidebar</h2>		
<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
