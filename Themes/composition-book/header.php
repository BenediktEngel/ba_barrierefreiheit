<?php
/**
 * The header for our theme
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

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'composition-book' ); ?></a>
	<header id="masthead" class="site-header" role="banner">
				<div class="header-row-one">
					<div class="col-80">
						<div class="row">
							<div class="site-branding">
								<?php
								if ( has_custom_logo() ) :
									the_custom_logo();
								elseif ( display_header_text() ) :
								?>
								<p class="cp-logo-fallback"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name') ?></a></p> 
								<?php endif; ?>
							</div><!-- .site-branding -->
							<div class="header secondary-menu-wrap">
								<?php if ( has_nav_menu( 'menu-2' ) ) : ?>
								<nav id="secondary-menu" class="secondary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Secondary', 'composition-book' ); ?>">
									<?php 
										wp_nav_menu( array(
											'theme_location' => 'menu-2',
											'menu_id' => 'nav-secondary-menu',
											'fallback_cb' => false,
											'depth' => 1,
										));
									?>
								</nav>
								<?php endif; ?>
							</div><!--secondary-menu-wrap-->
						</div><!--.row-->
					</div><!--.col-80-->
				</div><!--.header-row-one-->
				<div class="header-row-two">
					<div class="col-80"> 
							<div class="nav-search-container">
								<?php get_search_form(); ?>
								<button class="menu-toggle toggle" aria-controls="primary-menu" aria-pressed="false">
									<i class="fas fa-bars"></i>
									<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'composition-book' ); ?></span>
								</button>
							</div>	
							<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary', 'composition-book' ); ?>">
								<?php
								wp_nav_menu( array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
									'menu_class'	 => 'clear accessible-hide nav-menu',
									'depth' 		 => 3,
									'fallback_cb'    => 'wp_page_menu'
								) );	
								?>
							</nav><!-- #site-navigation -->	
					</div><!--.col-80-->
				</div><!--.header-row-two-->
				<?php if ( is_front_page() && is_home() ) : ?>
				<div class="header-row-three">
					<div class="col-80">
						<div class="row">
							<div class="site-info">	
							<?php composition_book_header_text(); ?>
							</div><!--.site-info-->
						</div><!--row-->
					</div><!--.col-80-->
				</div><!--.header-row-three-->
				<?php
				endif;
				if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) :
					get_template_part( 'template-parts/header', 'shop' );
				endif; 
				if ( has_header_image() ):
				?>
				<div class="custom-header-wrap">
					<?php the_header_image_tag(); ?>
				</div>
				<?php endif; ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
	