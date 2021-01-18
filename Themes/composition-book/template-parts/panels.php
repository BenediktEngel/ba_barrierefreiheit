<?php
/**
 * Template part for displaying panels.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package composition-book
 */

$panels = composition_book_get_panels();
if ( $panels ) :
?>
	<div class="cp-panels">
		<div class="cp-panels-container">
			<?php 
			foreach( $panels as $panel ): 
			$image_attrs = wp_get_attachment_image_src( get_post_thumbnail_id( $panel['post'] ), 'full' );
			$bg_img = $image_attrs[0];
			?>
			<article class="cp-panel" style="background-image: url(<?php echo esc_url( $bg_img ); ?>); ">
				<div class="cp-panel-content <?php echo esc_attr( $panel['position'] ) ?>">
					<header class="entry-header">
						<h2>
							<a href="<?php echo esc_url(get_the_permalink( $panel['post'])); ?>"> 
								<?php echo wp_kses_post( get_the_title( $panel['post'] ) ); ?>
							</a>
						</h2>
					</header>
					<div class="entry-content">
						<p>
						<?php 
							echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
								'the excerpt', //phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
								get_the_excerpt( $panel['post'] )
							); 
						?>
						</p>
					</div>
				</div><!--.panel-content-->
			</article><!--.panel-->
			<?php endforeach; ?>
		</div><!--.panels-container-->
	</div><!--.panels-->
<?php endif;