<?php
/**
* Footer Widget Area
*
* @package composition-book
*/
?>

<aside role="complementary" class="row widget-area" <?php composition_book_footer_widgets_aria_label() ?>> 
	<?php dynamic_sidebar( 'footer-widgets' ) ?>	
</aside>