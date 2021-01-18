<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package composition-book
 */

get_header();
?>

	<div id="primary" class="content-area">
		<div class="col-80">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'We&rsquo;re having some trouble.', 'composition-book' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'composition-book' ); ?></p>

					<?php
					the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<h2><?php esc_html_e( 'Search', 'composition-book' ) ?></h2>
					<div class="search404"><?php get_search_form() ?></div>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'composition-book' ); ?></h2>
						<ul>
							<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
							?>
						</ul>
					</div><!-- .widget -->

					<?php
					$composition_book_archive_content = '<p>' . esc_html__( 'Try looking in the monthly archives.', 'composition-book' )  . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$composition_book_archive_content" );

					the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
		</div><!--.col-80-->
	</div><!-- #primary -->

<?php
get_footer();
