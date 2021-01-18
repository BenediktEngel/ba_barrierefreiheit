/**
 * File customize-preview.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * Theme: composition-book
 */

( function( $ ) {
	// Site title and description.

	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	wp.customize( 'custom_logo', function( value ) {
		value.bind( function( attachmentId ) {
			const id = parseInt( attachmentId, 10 );
			const branding = $('.site-branding' );
			if (! id ){
				wp.customize( 'blogname', function(setting) {
					const name = setting.get();
					let header_textcolor = wp.customize( 'header_textcolor' ).get();
					const display_header_text = 'blank' !== header_textcolor ;
					if ( ! branding.children('h2').length && display_header_text ){
						header_textcolor = '#000000' === header_textcolor ? '#fff' : header_textcolor;
						const string = '<h2 style="font-size: 1.5em; margin: 0;' + header_textcolor + '">' +
										name + 
										'</h2>';
						branding.append( string );
					} else if ( display_header_text ) {
						branding.children('h2').text( name );
					}
					
				});
			} else {
				branding.children('h2').text('');
			} 
		});
	});


	$( function() {
		wp.customize.preview.bind( 'active', function() {
		    const bodyClass = document.querySelector('body').className;
		    const isBlog = bodyClass.indexOf( 'blog' ) > -1

		    wp.customize.preview.send( 'checkBlog', isBlog );
		} );
	});
	
} )( jQuery );
