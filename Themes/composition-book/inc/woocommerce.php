<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package composition-book
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function composition_book_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'composition_book_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function composition_book_woocommerce_scripts() {
	wp_enqueue_style( 'composition-book-woocommerce-style', get_template_directory_uri() . '/css/woocommerce.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_style = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

		$primary = esc_attr( get_theme_mod( 'composition_book_primary_color', '#db4a00' ) );
		
		$inline_style .= "
			.woocommerce-message,
			.woocommerce-info{
				border-top-color: $primary;
			}
			
			.woocommerce span.onsale{
				background-color: $primary;
			}

			.woocommerce ul.products li.product .price,
			.woocommerce div.product p.price{
				color: $primary ;
			}

			.woocommerce button.button.alt,
			.woocommerce a.button.alt{
				background: $primary ;
			}

			.woocommerce button.button.alt:hover,
			.woocommerce a.button.alt:hover{
				background: $primary;
			}

			.woocommerce .single_add_to_cart_button.button.alt{
				border: 2px solid $primary ;
			}

			ul.site-header-cart > li{
				background: $primary ;
			}

			ul.site-header-cart > li:hover > a,
			.woocommerce .single_add_to_cart_button.button.alt:hover{
				color: $primary ;
			}
		";

	wp_add_inline_style( 'composition-book-woocommerce-style', $inline_style );
}
add_action( 'wp_enqueue_scripts', 'composition_book_woocommerce_scripts' );

/**
 * Shuffles functions off and on to various WC hooks 
 *
 * Outputs the Woocommerce UI in the right order to match with the theme.
 */

function composition_book_rearrange_hooks(){
	remove_action( 'woocommerce_after_shop_loop','woocommerce_pagination');
	add_action( 'woocommerce_after_main_content', 'woocommerce_pagination');
	
	/**
	* Theme adds its own WC sidebar to replace woocommmerce_get_sidebar.
	* @see composition_book_register_wc_sidebar
	*/
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );
	
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	add_action( 'woocommerce_archive_description', 'woocommerce_breadcrumb', 5);
	
	remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count', 20 );
	add_action( 'woocommerce_archive_description', 'woocommerce_result_count', 20);

	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
	add_action( 'woocommerce_archive_description', 'woocommerce_catalog_ordering', 30);
}

add_action( 'init' , 'composition_book_rearrange_hooks' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function composition_book_woocommerce_products_per_page() {
	return apply_filters( 'composition_book_products_per_page', 12 );
}
add_filter( 'loop_shop_per_page', 'composition_book_woocommerce_products_per_page' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function composition_book_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'composition_book_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'composition_book_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function composition_book_woocommerce_wrapper_before() {
		?>
		<div class="col-80">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
				<?php
	}
}

add_action( 'woocommerce_before_main_content', 'composition_book_woocommerce_wrapper_before' );

if ( ! function_exists( 'composition_book_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function composition_book_woocommerce_wrapper_after() {
			?>
				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!--.col-80-->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'composition_book_woocommerce_wrapper_after' );


/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
*/

if ( ! function_exists( 'composition_book_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function composition_book_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		composition_book_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'composition_book_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'composition_book_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function composition_book_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
			<i class="fas fa-shopping-cart"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Shopping cart', 'composition-book' ); ?></span>
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'composition-book' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'composition_book_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function composition_book_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart clear">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php composition_book_woocommerce_cart_link(); ?>
			</li>
			<?php 
				$instance = array(
					'title' => '',
				);
			?>
			<li>
				<?php the_widget( 'WC_Widget_Cart', $instance );  ?>
			</li>
		</ul>
		<?php
	}
}

if (! function_exists( 'composition_book_register_wc_sidebar')){
	/**
	* Registers a sidebar for WC pages in which product filters 
	* and other widgets can be placed.
	*
	* @return void
	*/

	function composition_book_register_wc_sidebar(){
			register_sidebar( array(
			'name'          => esc_html__( 'Woocommerce Sidebar', 'composition-book' ),
			'id'            => 'sidebar-3',
			'description'   => esc_html__( 'Add widgets here.', 'composition-book' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}

add_action('widgets_init', 'composition_book_register_wc_sidebar' );

if ( ! function_exists( "composition_book_load_wc_sidebar") ){
	/**
	* Adds the sidebar on WC pages.
	*
	* @return void
	*/

	function composition_book_load_wc_sidebar(){
		get_sidebar( 'shop' );
	}
}

add_action( 'woocommerce_before_shop_loop', 'composition_book_load_wc_sidebar' );