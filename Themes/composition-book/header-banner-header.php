<?php
/**
 * The header for the banner-header.php page template.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package composition-book
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'banner-header' ); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'composition-book' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<nav id="site-navigation" class="main-navigation clear" role="navigation">
			<button class="search-toggle toggle" aria-pressed="false">
				<i class="fas fa-search"></i>
					<span class="screen-reader-text">
						<?php esc_html_e( 'Search', 'composition-book' ) . ' ' . bloginfo('name') ?>
					</span>
			</button>
			<?php get_search_form(); ?>
			<button class="menu-toggle toggle" aria-controls="primary-menu" aria-pressed="false">
				<i class="fas fa-bars"></i>
				<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'composition-book' ); ?></span>
			</button>	
			<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'menu_class'	 => 'clear accessible-hide nav-menu',
					'depth'			 => 3
				) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">