<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package composition-book
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-row-one footer-row">
			<div class="col-80">
				<div class="footer-navigation">
					<?php composition_book_footer_navs(); ?>
				</div><!--.footer-navigation-->
			</div><!--.col-80-->
		</div><!--.footer-row-one-->
		<div class="footer-row-two footer-row footer-widgets">		
			<div class="col-80">
				<?php get_sidebar( 'footer' ); ?>
			 </div><!--.row-->
		</div><!--.footer-row-three-->
		<?php if ( function_exists( 'jetpack_social_menu' ) ) : ?>	
		<div class="footer-row-three footer-row">
			<div class="col-80">
				<nav class="social-links" role='navigation' aria-label="<?php esc_attr_e( 'Social' , 'composition-book' ) ?>">
					<?php jetpack_social_menu(); ?>
				</nav>
			</div><!--.col-80-->
		</div><!--.footer-row-three-->
		<?php endif; ?>
		<div class="footer-row-four footer-row">
			<div class="site-info">
				<div class="row">
					<div class="col-80"> 
						<?php 
						composition_book_copyright();
						the_privacy_policy_link( '<span>', '</span>' ); 
						?>
					</div><!--.col-80-->
			 	</div><!--.row-->
			</div><!-- .site-info -->
		</div><!--.footer-row-three-->
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
