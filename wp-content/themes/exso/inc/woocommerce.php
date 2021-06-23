<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package bfbtuning
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
add_action( 'wp_head' , 'custom_quantity_fields_css' );

function custom_quantity_fields_css(){
	?>
	<style>
		.quantity input::-webkit-outer-spin-button,
		.quantity input::-webkit-inner-spin-button {
			display: none;
			margin: 0;
		}
		.quantity input.qty {
			appearance: textfield;
			-webkit-appearance: none;
			-moz-appearance: textfield;
		}
	</style>
	<?php
}


add_action( 'wp_footer' , 'custom_quantity_fields_script' );
function custom_quantity_fields_script(){
	?>
	<script type='text/javascript'>
		jQuery( function( $ ) {
			if ( ! String.prototype.getDecimals ) {
				String.prototype.getDecimals = function() {
					var num = this,
					match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
					if ( ! match ) {
						return 0;
					}
					return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
				}
			}

			$( document.body ).on( 'click', '.plus, .minus', function() {
				var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
				currentVal  = parseFloat( $qty.val() ),
				max         = parseFloat( $qty.attr( 'max' ) ),
				min         = parseFloat( $qty.attr( 'min' ) ),
				step        = $qty.attr( 'step' );


				if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
				if ( max === '' || max === 'NaN' ) max = '';
				if ( min === '' || min === 'NaN' ) min = 0;
				if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;


				if ( $( this ).is( '.plus' ) ) {
					if ( max && ( currentVal >= max ) ) {
						$qty.val( max );
					} else {
						$qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
					}
				} else {
					if ( min && ( currentVal <= min ) ) {
						$qty.val( min );
					} else if ( currentVal > 0 ) {
						$qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
					}
				}


				$qty.trigger( 'change' );
				
			});
		});
	</script>
	<?php
}
function bfbtuning_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'bfbtuning_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function bfbtuning_woocommerce_scripts() {
	wp_enqueue_style( 'exso-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), '' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'exso-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'bfbtuning_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function bfbtuning_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'bfbtuning_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function bfbtuning_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 15,
		'columns'        => 1,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'bfbtuning_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'bfbtuning_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function bfbtuning_woocommerce_wrapper_before() {
		?>
		
			<main id="primary" class="site-main">
				
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'bfbtuning_woocommerce_wrapper_before' );

if ( ! function_exists( 'bfbtuning_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function bfbtuning_woocommerce_wrapper_after() {
		?>
		
			</main><!-- #main -->
			
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'bfbtuning_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'bfbtuning_woocommerce_header_cart' ) ) {
			bfbtuning_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'bfbtuning_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function bfbtuning_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		bfbtuning_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'bfbtuning_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'bfbtuning_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function bfbtuning_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="">
	<?php
									$item_count_text = sprintf(
										_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'agrobud' ),
										WC()->cart->get_cart_contents_count()
									);
									?>
										<span class="count">
											<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M20.7333 17.3334C22.3599 17.3334 23.0532 15.9868 23.0666 15.9601L27.7999 7.37342C28.1066 6.77342 28.0399 6.25342 27.7866 5.89342C27.5466 5.54675 27.1066 5.33342 26.6666 5.33342H6.94659L6.05325 3.42675C5.94609 3.19916 5.77632 3.0068 5.56379 2.87221C5.35127 2.73761 5.10481 2.66634 4.85325 2.66675H2.66659C1.93325 2.66675 1.33325 3.26675 1.33325 4.00008C1.33325 4.73342 1.93325 5.33342 2.66659 5.33342H3.99992L8.79992 15.4534L6.99992 18.7068C6.02659 20.4934 7.30658 22.6668 9.33325 22.6668H23.9999C24.7332 22.6668 25.3333 22.0668 25.3333 21.3334C25.3333 20.6001 24.7332 20.0001 23.9999 20.0001H9.33325L10.7999 17.3334H20.7333Z"/>
									<path d="M9.33341 29.3333C10.8062 29.3333 12.0001 28.1394 12.0001 26.6667C12.0001 25.1939 10.8062 24 9.33341 24C7.86066 24 6.66675 25.1939 6.66675 26.6667C6.66675 28.1394 7.86066 29.3333 9.33341 29.3333Z" fill="#F9B233"/>
									<path d="M22.6667 29.3333C24.1394 29.3333 25.3333 28.1394 25.3333 26.6667C25.3333 25.1939 24.1394 24 22.6667 24C21.1939 24 20 25.1939 20 26.6667C20 28.1394 21.1939 29.3333 22.6667 29.3333Z"/>
									</svg>
									<strong><?php if($item_count_text){echo esc_html( $item_count_text );}else{ echo "0";} ?></strong>
										
											
										</span>
										<span class="amount">
											<?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?>
										</span>

		</a>
		<?php
	}
}

if ( ! function_exists( 'bfbtuning_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function bfbtuning_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php bfbtuning_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}


// Add to Cart ajax

function ace_product_page_ajax_add_to_cart_js() {
	?><script>
		jQuery(function($) {

			$('form.cart').on('submit', function(e) {
				e.preventDefault();

				var form = $(this);
				form.block({ message: null, overlayCSS: { background: '#fff', opacity: 0.6 } });

				var formData = new FormData(form[0]);
				formData.append('add-to-cart', form.find('[name=add-to-cart]').val() );

				$.ajax({
					url: wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'ace_add_to_cart' ),
					data: formData,
					type: 'POST',
					processData: false,
					contentType: false,
					complete: function( response ) {
						response = response.responseJSON;

						if ( ! response ) {
							return;
						}

						if ( response.error && response.product_url ) {
							window.location = response.product_url;
							return;
						}


						if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
							window.location = wc_add_to_cart_params.cart_url;
							return;
						}

						var $thisbutton = form.find('.single_add_to_cart_button');

						$( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, $thisbutton ] );

						$( '.woocommerce-error, .woocommerce-message, .woocommerce-info' ).remove();

						form.closest('.product').before(response.fragments.notices_html)

						form.unblock();
					}
				});
			});
		});
	</script><?php
}
add_action( 'wp_footer', 'ace_product_page_ajax_add_to_cart_js' );

function ace_ajax_add_to_cart_handler() {
	WC_Form_Handler::add_to_cart_action();
	WC_AJAX::get_refreshed_fragments();
}
add_action( 'wc_ajax_ace_add_to_cart', 'ace_ajax_add_to_cart_handler' );
add_action( 'wc_ajax_nopriv_ace_add_to_cart', 'ace_ajax_add_to_cart_handler' );

remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

function ace_ajax_add_to_cart_add_fragments( $fragments ) {
	$all_notices  = WC()->session->get( 'wc_notices', array() );
	$notice_types = apply_filters( 'woocommerce_notice_types', array( 'error', 'success', 'notice' ) );

	ob_start();
	foreach ( $notice_types as $notice_type ) {
		if ( wc_notice_count( $notice_type ) > 0 ) {
			wc_get_template( "notices/{$notice_type}.php", array(
				'notices' => array_filter( $all_notices[ $notice_type ] ),
			) );
		}
	}
	$fragments['notices_html'] = ob_get_clean();

	wc_clear_notices();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'ace_ajax_add_to_cart_add_fragments' );


