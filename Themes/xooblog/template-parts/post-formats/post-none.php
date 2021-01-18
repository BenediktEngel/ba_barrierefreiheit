<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @since xooblog 1.0
 */

get_header();
?>


<header class="xooblog_page_header ">
	<h1 class=" text-center">
		<?php _e('Nothing Found', 'xooblog'); ?>
	</h1>
</header><!-- .page-header -->
<div class="blog_area xooblog_section_padding_bottom section-padding">
	<div class="container">

		<div class="row">
			<div class="col-sm-6 offset-sm-3">
				<div class="xooblog_blog_parent text-center">
					<?php
					if (is_home() && current_user_can('publish_posts')) :

						printf(
							'<p>' . wp_kses(
								/* translators: 1: Link to WP admin new post page. */
								__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'xooblog'),
								array(
									'a' => array(
										'href' => array(),
									),
								)
							) . '</p>',
							esc_url(admin_url('post-new.php'))
						);

					elseif (is_search()) :
					?>

						<p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'xooblog'); ?></p>
					<?php
						get_search_form();

					else :
					?>

						<p><?php _e("It seems we con't  find what you&rsquo;re looking for. Perhaps searching can help.", 'xooblog'); ?></p>
					<?php
						get_search_form();

					endif;
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
