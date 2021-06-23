<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package bfbtuning
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function num_word($value, $words, $show = true) 
{
	$num = $value % 100;
	if ($num > 19) { 
		$num = $num % 10; 
	}
	
	$out = ($show) ?  $value . ' ' : '';
	switch ($num) {
		case 1:  $out .= $words[0]; break;
		case 2: 
		case 3: 
		case 4:  $out .= $words[1]; break;
		default: $out .= $words[2]; break;
	}
	
	return $out;
}

function bfbtuning_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}


	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'bfbtuning_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function bfbtuning_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'bfbtuning_pingback_header' );

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

// Size img in loop

function woocommerce_archive_gallery() {

	global $product;
	global $post;
	$post_ids = $product->get_id();

	$attachment_ids = $product->get_gallery_image_ids();
	if(get_the_post_thumbnail($post->ID)){
		echo get_the_post_thumbnail( $post->ID, 'products', array('height' => '','class'=>'', 'alt' => esc_html ( get_the_title() )) );
	}else{
		echo '<img src="'.get_stylesheet_directory_uri().'/noimg.svg">';
	}
	

}

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_archive_gallery', 10 );

// Size img in loop

add_filter('woocommerce_gallery_image_size', 'bigSingleImg');

function bigSingleImg()
{
	return 'big';
}


// Size img in product page gallery

add_filter('woocommerce_gallery_thumbnail_size', 'minSingleImg');

function minSingleImg()
{
	return 'min';
}

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
add_action( 'sort', 'woocommerce_get_sidebar', 10 );

remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

function getFilterBrand(){?>
	<div class="brand-category">
		<div class="container">
			<div class="brand-title">Популярные бренды</div><a class="open-brands" href="#">Раскрыть список
						<svg class="icon icon-open ">
							<use xlink:href="<?php echo get_stylesheet_directory_uri() ;?>/static/img/svg/symbols.svg#open"></use>
						</svg></a>
	<?php echo do_shortcode('[br_filter_single filter_id=36]'); ?>
		</div>
	</div>
	<?php
}

function getAttrBrand(){?>
	<div class="brand brand-cat">
			<div class="container">
				<div class="brand-title">Популярные бренды</div>
				<a class="open-brands" href="#"><span>Раскрыть список</span>
					<svg class="icon icon-open ">
						<use xlink:href="<?php echo get_stylesheet_directory_uri() ;?>/static/img/svg/symbols.svg#open"></use>
					</svg>
				</a>
				<div class="brand-slider swiper-container">
					<div class="swiper-wrapper">
						<?php 
						$terms = get_terms( 'pa_brend' , array( 'hide_empty' => false ) );
						foreach( $terms as $term ) :?>
							<?php //print_r($term); ?>
							<?php $foto = get_field('foto', $term->taxonomy . '_' . $term->term_id ); ?>
							<pre><?php //print_r($foto['sizes']['thumbnail']); ?></pre>
							
							<div class="brand-slider__item swiper-slide">
								<a href="/shop/?filters=brend[<?php echo $term->slug;?>]">
									<div class="brend-img"><img src="<?php echo $foto['sizes']['brand'];?>" alt="<?php echo $term->name;?>"></div>
									<div class="title"><?php echo $term->name;?></div>
								</a>
							</div>
						<?php endforeach;?>
					</div>
					<div class="slider-nav">
						<div class="swiper-prev sl-btn">
							<svg class="icon icon-arrow-left ">
								<use xlink:href="<?php echo get_stylesheet_directory_uri() ;?>/static/img/svg/symbols.svg#arrow-left"></use>
							</svg>
						</div>
						<div class="swiper-next sl-btn">
							<svg class="icon icon-arrow-right ">
								<use xlink:href="<?php echo get_stylesheet_directory_uri() ;?>/static/img/svg/symbols.svg#arrow-right"></use>
							</svg>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
}

function getProductCategory(){
	$args = array(
	'taxonomy'     => 'product_cat',
	'orderby'      => 'ID',
	'order'        => 'ASC',
	'show_count'   => true,
	'hierarchical' => 0,
	'hide_empty'   => 0,
	'exclude'      => '50',
);
echo '<div  class="categories-wrap"><ul class="categories">';

$get_all_categories = get_categories( $args );
foreach ($get_all_categories as $cat) {
	if($cat->category_parent == 0) {
		$category_id = $cat->term_id;
		echo '<li class="'.$cat->slug.'"><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name . '</a>';


		$args2 = array(
			'taxonomy'     => 'product_cat',
			'child_of'     => 0,
			'parent'       => $cat->term_id,
			'hide_empty'   => 0
		);


		$sub_cats = get_categories( $args2 );
		if($sub_cats) {
			echo '<ul>';
			foreach($sub_cats as $sub_category) {
				echo  '<li class="'.$sub_category->slug.'"><a href="'. get_term_link($sub_category->slug, 'product_cat') .'">'.$sub_category->name .'</a></li>';
			}
			echo '</ul></li>';
		}
	}
}
echo '</ul></div>';
}
add_action('woocommerce_before_shop_loop', 'containerOpen', 10);

add_action( 'template_redirect', 'filterShop' );
function filterShop() {
	if(is_shop() || is_product_category()){
		add_action('woocommerce_before_main_content', 'getFilterBrand', 20);
	}
}


add_action('woocommerce_before_shop_loop', 'getProductCategory', 10);

function containerOpen(){
echo '<div class="container shop-grid">';
}

//add_action('woocommerce_sidebar', 'containerClose', 20);

function containerClose(){?>
<div class="loader-product"><i></i></div>
</div>

<?php }


add_action('woocommerce_before_shop_loop', 'catOpen', 11);

function catOpen(){
echo '<div class="list">';
}

add_action('woocommerce_after_shop_loop', 'catClose', 15);

function catClose(){?>
	<div class="loader-product"><i></i></div>
	</div>

<?php }

// Product front container

add_action('woocommerce_before_single_product', 'containerProductOpen', 15);

function containerProductOpen(){
echo '<div class="container product-grid">';
}

add_action('woocommerce_after_single_product', 'containerProductClose', 25);

function containerProductClose(){
echo '</div>';

}

// Delete related

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// Move upsell

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 30 );


// Add to cart text

add_filter( 'woocommerce_product_add_to_cart_text', 'loopAddCartText' );
function loopAddCartText() {
		return __( 'Купить', 'woocommerce' );
}


// Sku in cart

add_action( 'woocommerce_single_product_summary', 'getSku', 6 );
function getSku(){
	global $product;
	echo '<span class="sku">Артикул: ' . $product->get_sku() . '</span>';
}


// Remove product meta

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


// Include product attribute

add_action( 'woocommerce_single_product_summary', 'getProductAttribute', 100 );
function getProductAttribute(){
	global $product;
	wc_display_product_attributes( $product );
}

// Include delevery text

add_action( 'woocommerce_single_product_summary', 'getProductTaxText', 90 );
function getProductTaxText(){
	global $product;
	$shippingClass = $product->get_shipping_class();
	$shipp_classname = get_term_by('slug',$shippingClass ,'product_shipping_class');
	if($shippingClass){
	echo '<div class="row-delevery"><span>Возможная доставка</span><p>'.$shipp_classname->name.'</p></div>';
	}

}


// Move product short description

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 120 );


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


// Remove tabs

add_filter( 'woocommerce_product_tabs', 'removeProductTabs', 98 );

function removeProductTabs( $tabs ) {

	unset( $tabs['description'] );
	unset( $tabs['reviews'] );
	unset( $tabs['additional_information'] );

	return $tabs;
}


// Replace title in loop

remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
add_action('woocommerce_shop_loop_item_title', 'ChangeProductsTitle', 10 );

function ChangeProductsTitle() {
	echo '<span class="title">' . get_the_title() . '</span>';
}


// Include product stickers

add_action('woocommerce_before_shop_loop_item', 'getProductsLoopStiker', 15 );
add_action('woocommerce_before_single_product_summary', 'getProductsLoopStiker', 10 );

function getProductsLoopStiker() {
global $product;

$bejdzhs = get_the_terms( $product->get_id(), 'pa_bejdzh');

	if($bejdzhs){
		echo '<div class="sticker">';
		foreach ( $bejdzhs as $bejdzh ) {
			if($bejdzh->term_id == 26){
				echo '<span class="new">'.$bejdzh->name.'</span>';
			}elseif($bejdzh->term_id == 27){
				echo '<span class="sale">'.$bejdzh->name.'</span>';
			}

		}
		echo "</div>";
	}
}

add_filter('home-brend', 'getAttrBrand');

add_action( 'woocommerce_shop_loop_item_title', 'loopExcerpt', 20);

function loopExcerpt(){
	global $product;
	echo '<p>'.kama_excerpt( array('maxchar'=>112) ).'</p>';

}


// Cart & Checkout



add_action( 'template_redirect', 'redirectEmptyCart' );

function redirectEmptyCart() {

if ( is_cart() && is_checkout() && 0 == WC()->cart->get_cart_contents_count() && ! is_wc_endpoint_url( 'order-pay' ) && ! is_wc_endpoint_url( 'order-received' ) ) {


wp_safe_redirect( home_url() );

exit;

}

}

add_action( 'woocommerce_before_cart', 'linkBack' );

function linkBack(){

	echo '<a class="linkback" href="/shop/">Вернуться в каталог</a><div class="cart-title">Корзина</div>';
}

// Вывел сумму скидки в подитог
function allSalePrice() {

    $savings = 0;

    foreach ( WC()->cart->get_cart() as $key => $cart_item ) {
        /** @var WC_Product $product */
        $product = $cart_item['data'];

        if ( $product->is_on_sale() && !$product->is_on_backorder()) {
            $savings += ( $product->get_regular_price() - $product->get_sale_price() ) * $cart_item['quantity'];
        }
    }

    if ( ! empty( $savings ) ) {
        ?><div class="cart_totals">
        	<div class="cart_totals-sale">
        		<span>Скидка</span>
            	<span><?php echo sprintf( __( '- %s' ), wc_price( $savings ) ); ?></span>
        	</div>
        	<div class="cart_totals-total">
        		<span>Итого</span>
        		<?php wc_cart_totals_order_total_html(); ?>
        	</div>
            
            
        </div><?php
    }

}
add_action( 'woocommerce_cart_collaterals', 'allSalePrice' );
//add_action( 'total', 'allSalePrice' );

function allSalePriceFinal() {
	global $woocommerce;
    $savings = 0;

    foreach ( WC()->cart->get_cart() as $key => $cart_item ) {
        /** @var WC_Product $product */
        $product = $cart_item['data'];

        if ( $product->is_on_sale() && !$product->is_on_backorder()) {
            $savings += ( $product->get_regular_price() - $product->get_sale_price() ) * $cart_item['quantity'];
        }
    }

    if ( ! empty( $savings ) ) {
        ?>
        <div class="checkout-all_count">
        	<span><?php echo num_word($woocommerce->cart->cart_contents_count, array('позиция', 'позиции', 'позиций')) .' в заказе'; ?></span>
        	
        </div>
        <div class="checkout_totals">
        	<div class="checkout_totals-sale">
        		<span>Скидка</span>
            	<span><?php echo sprintf( __( '- %s' ), wc_price( $savings ) ); ?></span>
        	</div>
        	<div class="checkout_totals-total">
        		<span>Итого</span>
        		<?php wc_cart_totals_order_total_html(); ?>
        	</div>
            
            
        </div><?php
    }

}

add_action( 'total', 'allSalePriceFinal' );

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
unset($fields['billing']['billing_company']);
unset($fields['billing']['billing_state']);
unset($fields['billing']['billing_address_1']);
unset($fields['billing']['billing_city']);
unset($fields['billing']['billing_address_2']);
unset($fields['billing']['billing_postcode']);
unset($fields['order']['order_comments']);
unset($fields['account']['account_username']);
unset($fields['account']['account_password']);
unset($fields['account']['account_password-2']);
    return $fields;
}

//add_filter( 'woocommerce_checkout_fields', 'checkoutFields');
function checkoutFields( $fields ) {
	$fields['billing']['billing_phone']['required'] = false;
	$fields['billing']['billing_email']['required'] = false;
	$fields['billing']['billing_first_name']['required'] = false;
	$fields['billing']['billing_last_name']['required'] = false;
	$fields['billing']['billing_address_1']['required'] = false;
	$fields['billing']['billing_city']['required'] = false;
	$fields['billing']['billing_state']['required'] = false;
	$fields['billing']['billing_postcode']['required'] = false;
	return $fields;
}

add_filter( 'get_product_search_form' , 'me_custom_product_searchform' );

// Поиск

function me_custom_product_searchform( $form ) {
	
	$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
	<input type="text" value="" name="s" id="s" placeholder="' . __( 'Поиск', 'woocommerce' ) . '">
	<button type="submit">
	<svg class="icon icon-search-icon "><use xlink:href="/wp-content/themes/bfbtuning/static/img/svg/symbols.svg#search-icon"></use></svg>
	</button>
	
	<input type="hidden" name="post_type" value="product" />
	
	</form>';
	return $form;
}
