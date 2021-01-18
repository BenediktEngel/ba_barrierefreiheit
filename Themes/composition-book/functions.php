<?php
/**
 * composition-book functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @copyright 2020 Peter Steele
 * @package composition-book
 *
 * A portion of this file, specifically the part of composition_book_setup which 
 * creates starter content, incorporates code from twentyseventeen theme.
 * Twentyseventeen:
 * @copyright 2016 Wordpress.org.
 * @license GPL v2
 * @link https://wordpress.org/themes/twentyseventeen/
 */

if ( !function_exists( 'composition_book_php_version_check' ) ):

	/**
	* disable theme if the php version is less than 7
	*
	* Loads the previous theme if it exists, otherwise loads first available
	* theme from the user's directory.
	*/
	function composition_book_php_version_check( $old_theme ){

		define( 'composition_book_REQUIRED_PHP_VERSION', '7.0.0' );

		if ( version_compare( phpversion(), composition_book_REQUIRED_PHP_VERSION, '<' ) ){
			
			function composition_book_php_version_notification(){
				echo '<div class="notice notice-error">';
				esc_html_e( 'Composition Book requires PHP version 7.0.', 'composition-book' );
				echo '</div>';
			}

			add_action( 'admin_notices', 'composition_book_php_version_notification' );

			if ( is_string( $old_theme ) ){
				$old_theme = wp_get_theme( str_replace(' ', '-', strtolower( $old_theme ) ) );
			}
			
			$old_theme_exists = $old_theme->exists();
				
			if ( $old_theme_exists ){
				switch_theme( $old_theme->get_stylesheet() );
			} else {
				$themes = wp_get_themes();
				foreach ( $themes as $theme ){
					if ( $theme->exists() && $theme->get_stylesheet() !== 'composition-book' ){
						switch_theme( $theme->get_stylesheet() );
					}
				}
			}
		}
	}
endif;

add_action( 'after_switch_theme', 'composition_book_php_version_check' );

if ( ! function_exists( 'composition_book_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function composition_book_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on composition book, use a find and replace
		 * to change 'composition-book' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'composition-book', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Register Nav Menus
		 *
		 * @link https://developer.wordpress.org/themes/functionality/navigation-menus/
		 */

		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'composition-book' ),
			'menu-2' => esc_html__( 'Secondary' , 'composition-book' ),
			'menu-3' => esc_html__( 'Footer Links 1' , 'composition-book' ),
			'menu-4' => esc_html__( 'Footer Links 2' , 'composition-book' ),
			'menu-5' => esc_html__( 'Footer Links 3' , 'composition-book' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'composition_book_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		* Set up starter content
		*
		* Incorporated code from twentyseventeen theme by WordPress, 
		* @copyright 2016 Wordpress.org.
		* @license GPL v2
		* @link https://wordpress.org/themes/twentyseventeen/ 
		*
		*/

		add_theme_support( 'starter-content', array(
			'widgets' => array(
		        'sidebar-footer' => array(
					'text_business_info',
				),
		    ),
		   

		   'posts'       => array(
				'home' 			   => array(
					'thumbnail' => '{{image-woods}}',
					'post_content' => '<p>' . esc_html__( 
										"Thanks for installing Composition Book! 
										Please refer to the readme.txt for information about a couple special features.",
										'composition-book'
									) . '</p>',
				),
				'about'            => array(
					'thumbnail' => '{{image-landscape}}',
				),
				'contact'          => array(
					'thumbnail' => '{{image-sunrise}}',
				),
				'blog',             
				'homepage-section',
			), 

		   'attachments' => array(
				'image-woods' => array(
					'post_title' => _x( 'Woods', 'Theme starter content', 'composition-book' ),
					'file'       => 'assets/img/woods.jpg', 
				),
				'image-landscape' => array(
					'post_title' => _x( 'Landscape', 'Theme starter content', 'composition-book' ),
					'file'       => 'assets/img/landscape-with-trees-and-fog.jpg',
				),	
				'image-sunrise' => array(
					'post_title' => _x( 'Sunrise', 'Theme starter content', 'composition-book' ),
					'file'       => 'assets/img/sunrise.jpg',
				),
			),

			'options'     => array(
				'show_on_front'  => 'page',
				'page_on_front'  => '{{home}}',
				'page_for_posts' => '{{blog}}',
			),

			// Set the front page section theme mods to the IDs of the core-registered pages.
			'theme_mods'  => array(
				'composition_book_panel_posts_1' => '{{homepage-section}}',
				'composition_book_panel_posts_2' => '{{about}}',
				'composition_book_panels_homepage' => 1,
			),

			// Set up two nav menus
			'nav_menus'   => array(
				// Assign a menu to the menu-1 location.
				'menu-1'    => array(
					'name'  => __( 'Primary Menu', 'composition-book' ),
					'items' => array(
						'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
						'page_about',
						'page_blog',
						'page_contact',
					),
				),

				// Assign a menu to the "secondary" location.
				'menu-2' => array(
					'name'  => __( 'Secondary Menu', 'composition-book' ),
					'items' => array(
						'link_yelp',
						'link_facebook',
						'link_twitter',
						'link_instagram',
						'link_email',
					),
				),
			),

		));

	}
endif;
add_action( 'after_setup_theme', 'composition_book_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function composition_book_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'composition_book_content_width', 1012 );// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
}
add_action( 'after_setup_theme', 'composition_book_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function composition_book_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'composition-book' ),
		'id'            => 'sidebar-right',
		'description'   => esc_html__( 'The sidebar for pages', 'composition-book' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'  	    => esc_html__( 'Footer Widgets', 'composition-book' ),
		'id'		    => 'footer-widgets',
		'description'   => esc_html__( 'A sidebar area for the footer.', 'composition-book' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Single Post Sidebar', 'composition-book' ),
		'id'            => 'sidebar-single',
		'description'   => esc_html__( 'The sidebar for single posts.', 'composition-book' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'composition_book_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function composition_book_scripts() {
	//fontawesome
	wp_enqueue_style( 'composition-book-fontawesome', get_stylesheet_directory_uri() . '/assets/fontawesome/css/all.css'  );
	
	//navigation js
	wp_enqueue_script( 'composition-book-navigation', esc_url( get_template_directory_uri() . '/js/navigation.js' ), array( 'jquery' ), '20151215', true );
	wp_localize_script( 'composition-book-navigation', 'template', array( 'bannerHeader' => is_page_template('page-templates/banner-header.php') ) );

	//sidebar layout
	if ( is_page_template( 'page-templates/sidebar-right.php' ) ){
		wp_enqueue_style( 'composition-book-sidebar-right-style', esc_url( get_template_directory_uri() . '/layouts/content-sidebar.css' ) );
	}

	//single post sidebar layout
	if (is_single()){
		wp_enqueue_style( 'composition-book-single-style', esc_url( get_template_directory_uri() . '/layouts/single-post-sidebar.css' ) );
	}

	//main stylesheet
	wp_enqueue_style( 'composition-book-style', get_stylesheet_uri() );
	wp_add_inline_style( 'composition-book-style', composition_book_customize_css() );
	
	//fonts
	wp_enqueue_style( 'composition-book-google-font-nunito', 'https://fonts.googleapis.com/css?family=Nunito&display=swap' );
	wp_enqueue_style( 'composition-book-google-font-permanent', "https://fonts.googleapis.com/css?family=Abel&display=swap" );

	//skip links
	wp_enqueue_script( 'composition-book-skip-link-focus-fix', esc_url( get_template_directory_uri() . '/js/skip-link-focus-fix.js' ), array(), '20151215', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'composition_book_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * TGM Plugin Activation.
 */

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

/**
 *  Woocommmerce-specific functions.
 */
if ( class_exists('WooCommerce') ){
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

if ( ! function_exists( 'wp_body_open' ) ):

	/**
	* fallback for wp_body_open.
	*/

	function wp_body_open() {// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedFunctionFound
         do_action( 'wp_body_open' );// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
    }

endif;	 

if ( ! function_exists( 'composition_book_footer_nav_class' ) ):

	/**
	* Applies a class to 'more links' navs in footer depending
	* on how many are active.
	*/

	function composition_book_footer_nav_class(){
		$footer_lists = 0;
		//count the number of navs in the footer (not including the secondary menu that shows up there on small screens)
		for ( $i = 3; $i <= 5; $i++ ){
			if ( has_nav_menu( 'menu-' . $i ) ){
				$footer_lists++;
			}
		}
		//use number of navs in a css class to help with alignment
		return 'footer-links footer-has-' . $footer_lists .'-navs';
	}
endif;

function composition_book_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'Advanced Excerpt',
			'slug'      => 'advanced-excerpt',
			'required'  => false,
		),
	);

$config = array(
		'id'           => 'composition-book',     // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.	
	);

	tgmpa( $plugins, $config );

}

add_action( 'tgmpa_register', 'composition_book_register_required_plugins' );


if ( ! function_exists( 'composition_book_customize_css' ) ):

	/**
	* Outputs styles incorporating user-chosen color settings.
	*/

	function composition_book_customize_css(){
		/* Retrieve customizer options for primary color and accent colors */
		$primary = esc_attr( get_theme_mod( "composition_book_primary_color", '#db3a00' ));
		$link = esc_attr( get_theme_mod( 'composition_book_link_color' , '#4169e1' ));
		$hover = esc_attr( get_theme_mod( 'composition_book_hover_link_color', '#191970' ) );

		$css ="
		
			a{
				color: $link;
			}

			a:visited,
			a:active{
				color: $primary;
			}

			a:hover{
				color: $hover;
			}

			body:not(.banner-header) .site-header .menu-toggle:hover,
			body:not(.banner-header) .site-header .menu-toggle:focus,
			body:not(.banner-header) .site-header .search-form button:hover,
			body:not(.banner-header) .site-header .search-form button:focus{
				border-color: $primary;
			}

			.sticky-icon i{
				color:  $primary;
			}

			.cp-post-index .entry-title a:hover,
			.cp-post-index .tags-links a:hover,
			.cp-post-index .cat-links a:hover,
			.cp-post-index .comments-link a:hover,
			.cp-post-index .edit-link a:hover,
			.byline a:hover{
				color: $hover;
			}

			.menu-toggle:hover,
			.menu-toggle:focus{
				background: $primary;
			}

			.footer-links a:hover,
			.footer-links a:focus{
				color: $primary;
			}

			.posts-navigation .nav-previous a,
			.posts-navigation .nav-next a{
				background: $primary;
				border: 2px solid $primary;
			}

			.posts-navigation .nav-previous a:hover,
			.posts-navigation .nav-previous a:focus,
			.posts-navigation .nav-next a:hover,
			.posts-navigation .nav-next a:focus{
				color: $primary;
				border: 2px solid $primary;
			}

			.bypostauthor .comment-body{
				border-top: 5px solid $primary;
			}

			@media screen and ( min-width: 650px ){
				.bypostauthor .comment-body{
					border-left: 5px solid $primary;
					border-top: none;
				}
			}

			.comment-form input[type='submit'],
			.comment-form button{
				color: $primary;
				border: 2px solid $primary;
			}

			.comment-form input[type='submit']:hover,
			.comment-form input[type='submit']:focus{
				background: $primary;
			}

			.page-numbers li a,
			.page-numbers li a:visited,
			.page-numbers li a:active{
				background: $primary;
			}

			.social-links a:hover,
			.social-links a:focus{
				color: $primary;
			}

			.privacy-policy-link:hover,
			.privacy-policy-link:focus{
				color: $primary;
			}

			.search-form button:hover,
			.search-form button:focus{
				background: $primary;
			}

			.search-results-query{
				color: $primary;
			}

		";

		return $css;
	}

endif;

if ( ! function_exists('composition_book_get_panels') ):

	/**
	* Gets pages/posts for homepage panels.
	*
	* Retrieves ids for posts/pages whose excerpts/thumbnails will be included  
	* in panels feature. Also retrieves text position location for each panel.
	*/

	function composition_book_get_panels(){
		$panels = array();
		for ( $count = 1; $count <= 4; $count++ ){
			$id = get_theme_mod( 'composition_book_panel_posts_' . $count );
			if ( $id && has_post_thumbnail( $id ) ){
				$text_position = get_theme_mod( 'composition_book_panel_text_position_' . $count, 'bottom-right');
				$panels[] = array(
					'post' => get_post( $id ),
					'position' => 'composition-book-' . $text_position
				);
			}	
		}
		return !empty( $panels ) ? $panels : false;
	}

endif;

if ( ! function_exists( 'composition_book_load_post_layout' ) ) :

	/**
	* Loads a template part for posts in archive views 
	* depending on the chosen post template.
	*/

	function composition_book_load_post_layout(){

		/*
		* Include the Post-Type-specific template for the content.
		* If you want to override this in a child theme, then include a file 
		* in 'template-parts/content-post/' called content-___.php 
		* (where ___ is the Post Type name) and that will be used instead.
		*/

		if ( get_page_template_slug() === "page-templates/background-image.php" ){
			get_template_part( 'template-parts/content-post/content', 'post-background-image' );
		} else {
			get_template_part( 'template-parts/content-post/content', get_post_type() );
		}
	}

endif;