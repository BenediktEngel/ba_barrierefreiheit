
    <!--  -->
    <footer class="tecxoo-footer-type-3">
      <!--  -->
      <div class="tecxoo-footer-bottom">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="tecxoo-social-icon text-left">

              <?php
                if ( has_nav_menu( 'footer_menu' ) ) {
                wp_nav_menu(array(
                    'theme_location' => 'footer_menu',
                    'menu_id' => 'footer_menu',
                    'menu_class' => 'list-style-none d-inline-flex pl-0'
                ));
                }
                ?>
                <!-- /.ul -->
              </div>
            </div>
            <div class="col-md-6">
              <div class="tecxoo-copyright-text float-right">
                <p>
                <?php if( get_theme_mod( 'footer_text_block') != "" ): 
                echo esc_html(get_theme_mod( 'footer_text_block'));
               endif;
                ?>
				
        <?php 
        
        _e('Powered By','xooblog')
        ?> <b>
       <?php 
       
       _e('TecXoo','xooblog')
       ?>
        </b>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--  -->
    </footer>
    <!--  -->

    <!--  -->
    <div class="tecxoo-to-top">
      <i class="fas fa-arrow-up"></i>
      <span>
        <?php 
        _e('Top','xooblog');
        ?>
      </span>
    </div>
    <!--  -->

<!-- footer -->
<?php wp_footer(); ?>

<!-- Fehler aus Prüfschritt 1.3.5a durch hinzufügen von des Autocomplete-Attributs behoben -->
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