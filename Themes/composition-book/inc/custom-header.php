<?php
/**
 * Custom Header
 *
 * @package composition-book
 */

/**
 * Set up the WordPress core custom header feature.
 */
function composition_book_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'composition_book_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'flex-width'			 => true,
		'wp-head-callback'		 => 'composition_book_header_style'
	) ) );
}
add_action( 'after_setup_theme', 'composition_book_custom_header_setup' );

if ( ! function_exists( 'composition_book_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see composition_book_custom_header_setup().
	 */
	
	function composition_book_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color || ! display_header_text() ) {
			return;
		}
		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
			h1.site-title,
			.site-header .site-branding h2.cp-logo-fallback a{
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		</style>
		<?php
	}
endif;