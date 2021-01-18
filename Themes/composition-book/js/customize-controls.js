/**
 * File customize-controls.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Shows and hides certain customizer controls depending on context.
 *
 * Theme: composition-book
 */

( function( ) {
	
	const settings = { 
		panel: 'composition_book_panel_posts_', 
		textPosition: 'composition_book_panel_text_position_',
		homepage: 'composition_book_panels_homepage'
	}

	wp.customize.bind( 'ready', function(){

		wp.customize.previewer.bind( 'checkBlog', function( isBlog ){

			for ( let i = 1; i <= 4; i++ ){
				
				//if preview URL is blog page, hide or show panel controls depending on 
				//whether 'show on home page' control is checked
				wp.customize.control( settings.homepage, function( homepageControl ){
					homepageControl.setting.bind( function(value){
						wp.customize.control( settings.panel + i ).toggle( value );
						wp.customize.control( settings.textPosition + i ).toggle( 
							value && wp.customize( settings.panel +i ).get() 
						);
					} );
				} );

				//hide text position control if panel isn't set. If on blog page, also check 
				//that panels are set to display on homepage.
				wp.customize( settings.panel + i, function( setting ){
					wp.customize.control( settings.textPosition + i, function( textControl ){
						const toggleTextPos = () => textControl.toggle( showTextPos() );
						const showTextPos = () => {
							if ( isBlog ){
								return setting.get() > 0 && wp.customize( settings.homepage ).get();
							} else {
								return setting.get() > 0;
							}
						}
						toggleTextPos();
						textControl.active.validate = showTextPos;
						setting.bind( toggleTextPos );
					})
				});

			}
		})
	})
})(); 