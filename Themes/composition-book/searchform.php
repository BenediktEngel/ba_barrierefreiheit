<?php

/** 
*renders a searchbar
*
* @package composition-book
*/

?>

<form method='get' class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label>
			<span class="screen-reader-text"><?php esc_html_e( 'Search for:' , 'composition-book'); ?></span>
			<input type='text' required class="search-term" placeholder="<?php esc_attr_e( 'search', 'composition-book') ?>" name='s'>
		</label>
		<button type="submit" aria-pressed="false">
			<i class="fas fa-search"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Submit search form', 'composition-book' ); ?></span>
		</button>
		<button type="button" aria-hidden="true" class="searchbar-close toggler">
			<i class="fas fa-window-close"></i>
		</button>
</form> 
