<?php
/**
 * Composition Book Theme Customizer
 * composition-book
 * @package composition-book
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
require get_template_directory() . '/inc/customizer/class-dropdown-posts-control.php';// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

function composition_book_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'custom_logo' )->transport  	= 'postMessage';
	
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'composition_book_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'composition_book_customize_partial_blogdescription',
		) );

	}

	//Colors
	$wp_customize->add_setting( 'composition_book_primary_color', array(
		'default' => '#db3a00',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'composition_book_primary_color', array(
		'label' => __( 'Primary Color', 'composition-book' ),
		'section' => 'colors',
		'settings' => 'composition_book_primary_color'
	)));
	
	$wp_customize->add_setting( 'composition_book_link_color', array(
		'default' => '#4169E1',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'composition_book_link_color', array(
		'label' => __( 'Link Color', 'composition-book' ),
		'section' => 'colors',
		'description' => __( 'The color for unvisited links in the content.' , 'composition-book' ),
		'settings' => 'composition_book_link_color'
	)));

	$wp_customize->add_setting( 'composition_book_hover_link_color', array(
		'default' => '#191970',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'composition_book_hover_link_color', array(
		'label' => __( 'Link Color', 'composition-book' ),
		'section' => 'colors',
		'description' => __( 'The color links in the content appear when hovered by the mouse.' , 'composition-book' ),
		'settings' => 'composition_book_hover_link_color'
	)));
	//Panels

	$wp_customize->add_section( 'composition_book_panels' , array(
		'title' => __( 'CB Panels' , 'composition-book' ),
		'description' => __( 
				"Set pages and posts to appear as panels at the top of the page. 
				Any posts that do not have a featured image will be skipped. ", 
				'composition-book' 
		),
		'active_callback' => 'composition_book_is_panels',
	));

	$wp_customize->add_setting( 'composition_book_panels_homepage', array(
		'default' => 0,
		'sanitize_callback' => 'composition_book_sanitize_checkbox'
	) );
	
	$wp_customize->add_control( 'composition_book_panels_homepage', array(
		'label' => __( 'Show Panels on Blog Page', 'composition-book' ),
		'type' => 'checkbox',
		'section' => 'composition_book_panels',
		'active_callback' => 'composition_book_is_home'
	));
	

	for( $count = 1; $count <= 4; $count++){
		
		/*
		allows user to set the post to include in panel page
		*/
		$wp_customize->add_setting( 'composition_book_panel_posts_' . $count, array(
			'default' => '',
			'sanitize_callback' => 'absint'
		));
 		
 		$wp_customize->add_control( new composition_book_Dropdown_Posts_Control( $wp_customize, 'composition_book_panel_posts_' . $count, array(
			/* translators:  %s: panel number.*/
			'label' => sprintf( __( 'Panel %s Content', 'composition-book' ), $count ),
			'section' => 'composition_book_panels',
			'settings' => 'composition_book_panel_posts_' . $count,
			'active_callback' => 'composition_book_show_panel_control'
		)));

		/*
		allows user to set the text position of the panel content
		*/

		$wp_customize->add_setting( 'composition_book_panel_text_position_' . $count, array(
			'default' => 'bottom-left',
			'sanitize_callback' => 'composition_book_sanitize_text_position'
		) );

		$wp_customize->add_control( 'composition_book_panel_text_position_' .  $count, array(
			/* translators: %s: panel number */
			'label' => sprintf( __( 'Panel Text %s Positioning', 'composition-book' ), $count ),
			'type' => 'select',
			'choices' => composition_book_text_position_choices(),
			'section' => 'composition_book_panels',
			'active_callback' => 'composition_book_show_panel_control'
		));
	}

	//Copyright
	$wp_customize->add_setting( 'composition_book_copyright_visible', array(
		'default' => false,
		'sanitize_callback' => 'composition_book_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'composition_book_copyright_visible', array(
		'label' => __( 'Show Copyright', 'composition-book' ),
		'type'  => 'checkbox',
		'section' => 'title_tagline',
		'priority' => 100
	));

	$wp_customize->add_setting( 'composition_book_copyright_year', array(
		'default' => date('o'),
		'sanitize_callback' => 'composition_book_sanitize_year'
	) );

	$wp_customize->add_control( 'composition_book_copyright_year', array(
		'label' => __( 'Copyright Year', 'composition-book' ),
		'type'  => 'number',
		'section' => 'title_tagline',
		'priority' => 105
	));

}
add_action( 'customize_register', 'composition_book_customize_register' );

/* enqueue customizer css for panels section */

function composition_book_enqueue_customizer_css(){
	wp_enqueue_style( 'composition-book-customizer-styles', get_template_directory_uri() . '/css/customizer.css' );
}

add_action( 'customize_controls_print_styles', 'composition_book_enqueue_customizer_css' );

/** 
*Custom Sanitization Functions
*/

/**
* Sanitize the copyright year by converting to a number
* and accepting up to four digits.
*/

function composition_book_sanitize_year( $year ){
	return absint( substr( $year, 0, 4) );
}

/**
* Sanitize a checkbox value by allowing only 0 or 1 to be saved
*/

function composition_book_sanitize_checkbox( $input ){
    return intval( $input ) > 0 ? 1 : 0;
}

/**
* Sanitizes the text-position fields in the panels pane.
*/

function composition_book_sanitize_text_position( $input ){
	$save = '';
	switch( $input ){
		case 'top-left': 
		case 'top-right':
		case 'bottom-right': 
		case 'bottom-left':
			$save = $input;
			break;
		default:
			$save = '';
	}
	return $save;
}

/* populates the options in the text-position <selects> in the panels page */

function composition_book_text_position_choices( ){
	return array(
		'bottom-left'  => __('bottom-left','composition-book'),
		'bottom-right' => __('bottom-right','composition-book'),
		'top-left'     => __('top-left', 'composition-book'),
		'top-right'	   => __('top-right', 'composition-book')
	);
}

/* 
	Checks if panels page template is being used. Alternately, 
	checks if blog page is previewed, since users can choose
	to have panels appear on blog page. 
	
	Active callback for whether to show the CP Panels section
*/

function composition_book_is_panels(){
	if ( is_page_template( 'page-templates/panel-page.php' ) || is_home() ){
		return true;
	}
}

/*
 Checks for blog page. Active callback for
 'show panels on blog page' checkbox
*/

function composition_book_is_home(){
	return is_home();
}

/*
	Checks whether panel and text position controls should appear.
	Active callback for panel and text position controls.
*/

function composition_book_show_panel_control(){
	return (
		is_home() && get_theme_mod( 'composition_book_panels_homepage', false ) || 
		is_page_template( 'page-templates/panel-page.php' )
	); 
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function composition_book_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function composition_book_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function composition_book_customize_preview_js() {
	wp_enqueue_script( 'composition-book-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'jquery', 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'composition_book_customize_preview_js' );

/**
 * Loads controls js to conditionally hide unused inputs in the panels section.
 */

function composition_book_customize_controls_js(){
	wp_enqueue_script( 'composition-book-customize-controls', get_template_directory_uri() . '/js/customize-controls.js', array( 'jquery', 'customize-controls' ), '20151215', true );

}
add_action( 'customize_controls_enqueue_scripts', 'composition_book_customize_controls_js' );
