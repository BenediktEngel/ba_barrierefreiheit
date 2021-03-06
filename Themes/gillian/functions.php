<?php
/**
 * gillian functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package gillian
 */

if ( ! function_exists( 'gillian_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gillian_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on gillian, use a find and replace
	 * to change 'gillian' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'gillian', get_template_directory() . '/languages' );

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
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top-menu' => esc_html__( 'Top Menu (Optional)', 'gillian' ),
		'social' => esc_html__( 'Social Menu (Optional)', 'gillian' ),
		'bottom-menu' => esc_html__( 'Bottom Menu (Main)', 'gillian' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'gillian_custom_background_args', array(
		'default-color' => 'fbfbfb',
		'default-image' => '',
	) ) );
	
	// Add a custom stylesheet to the editor
	add_editor_style();
}
endif;
add_action( 'after_setup_theme', 'gillian_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gillian_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gillian_content_width', 640 );
}
add_action( 'after_setup_theme', 'gillian_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

 /* Um den Fehler aus Prüfschritt 1.3.1a zu beheben müssen alle h2-Elemente im Folgenden auf h3 umgeschreiben werden. */
function gillian_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Default Sidebar', 'gillian' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'gillian' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar (Three Columns template)', 'gillian' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'gillian' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'gillian' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here.', 'gillian' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'gillian_widgets_init' );

/**
 * Add span classes to allow styling of parentheses around 
 * post count in archive and category links.
 */
add_filter('get_archives_link', 'gillian_archive_post_count');
function gillian_archive_post_count($links) {
	$links = str_replace('</a>&nbsp;(', '&nbsp;<span class="first-paren">(</span><span class="post-count">', $links);
	$links = str_replace(')', '<span class="last-paren">)</span></span></a>', $links);
	return $links;
}

add_filter('wp_list_categories', 'gillian_categories_post_count');
function gillian_categories_post_count ($links) {
   $links = str_replace('</a> (', '<span class="post-count"> ', $links);
   $links = str_replace(')', ' </span></a>', $links);
   return $links;
}

/**
 * Enqueue scripts and styles.
 */
function gillian_scripts() {
	wp_enqueue_style( 'gillian-style', get_stylesheet_uri() );
	
	wp_enqueue_style('gillian-gf-droidsans', '//fonts.googleapis.com/css?family=Droid+Sans:400,700,300,400italic,700italic');
	
	wp_enqueue_style('gillian-gf-droidserif', '//fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700,700italic');
	
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fontawesome/css/font-awesome.min.css');
	
	wp_enqueue_script( 'gillian-masonry', get_template_directory_uri() . '/js/mymasonry.js', array('masonry'), '20160820', true );
	
	wp_enqueue_script( 'gillian-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	
	wp_enqueue_script( 'gillian-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	
	wp_enqueue_script( 'gillian-smooth-scroll', get_template_directory_uri() . '/js/smooth-scroll.js', array('jquery'), '20160820', true );
	
	wp_enqueue_script( 'gillian-widget-img-links', get_template_directory_uri() . '/js/widget-img-links.js', array('jquery'), '20160820', true );

	/* Einbinden der neuen barrierefreistyles.css um Styles für die Überarbeitungen anzuwenden. */
	wp_enqueue_style('barrierefreistyles', get_template_directory_uri() . '/barrierefreistyles.css');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gillian_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';