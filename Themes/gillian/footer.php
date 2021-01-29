<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gillian
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	
		<aside id="footer-sidebar" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Footer widgets', 'gillian' ); ?>">
			<?php dynamic_sidebar( 'sidebar-3' ); ?>
		</aside>
	
		<div class="site-info">
			<p>&copy;
			<?php echo date_i18n(__('Y','gillian')) ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			
			<span class="sep"></span>
			
			<?php
			if ( function_exists( 'the_privacy_policy_link' ) ) {
				the_privacy_policy_link( '', '
				<span class="sep"></span>' );
			}
			?>
			
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'gillian' ) ); ?>"><?php printf( esc_html__( 'Powered by %s', 'gillian' ), 'WordPress' ); ?></a>
			
			<span class="sep"></span>
			
			<?php printf( esc_html__( 'Theme: %1$s', 'gillian' ), '<a href="http://wordpress.org/themes/gillian">Gillian</a>' ); ?>
		</div><!-- .site-info -->
		
		<div class="back-to-top">
			<a href="#"><i class="fa fa-chevron-up" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e('Back to top','gillian'); ?></span></a>
		</div>
		
		<div class="clearer"></div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<!-- Fehler aus Prüfschritt 1.3.5a durch hinzufügen des Autocomplete-Attributs behoben -->
<script>
  document.addEventListener('DOMContentLoaded', (event) => {
  	// Referenz zu den Textfeldern anhand der ID erstellen
  	var author = document.getElementById("author");
  	var email = document.getElementById("email");
  	var url = document.getElementById("url");
 	 	// Prüfung ob Referenz vorhanden, da diese nicht angezeigt werden wenn man eingeloggt ist oder keine Kommentare zugelassen sind. Daraufhin setzen des Autocomplete Attributs mit passendem Wert.
  	if(author != null){
    	author.setAttribute("autocomplete", "name");
  	}
  	if(email != null){
    	  email.setAttribute("autocomplete", "email");
  	}
  	if(url != null){
    	url.setAttribute("autocomplete", "url");
  	}
	})
</script>

</body>
</html>
