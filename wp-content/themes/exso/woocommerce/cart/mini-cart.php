<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_mini_cart' ); ?>

<div class="shop_table cart">
<a href="#" class="close-cart"><svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="6.30103" y="7.54395" width="1.75763" height="19.3339" transform="rotate(-45 6.30103 7.54395)" fill="white"/>
<rect x="7.54395" y="21.2151" width="1.75763" height="19.3339" transform="rotate(-135 7.54395 21.2151)" fill="white"/>
</svg></a>
<div class="cart-title">
	<?php pll_e('ct-7'); ?>
</div>
<?php if ( ! WC()->cart->is_empty() ) : ?>
<form action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
	<div class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">

				<div class="cart-item_name">
			
				<span class="product-name"><?php pll_e('ct-1'); ?></span>
			<div class="cart-item_name-row">
				<span class="product-size"><?php pll_e('ct-2'); ?></span>
				<span class="product-quantity"><?php pll_e('ct-3'); ?></span>
				<span class="product-price"><?php pll_e('ct-4'); ?></span>
				<span class="product-subtotal"><?php pll_e('ct-5'); ?></span>
				<span class="product-remove"><?php pll_e('ct-6'); ?></span>
			</div>
		</div>
		<?php
			do_action( 'woocommerce_before_mini_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
					$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<div class="woocommerce-cart-form__cart-item cart_item woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
						<div class="product-thumbnail__name">
						<div class="product-thumbnail">
						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('minicart'), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
						}
						?>
						</div>

						<div class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>"><span><?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );echo wc_get_formatted_cart_item_data( $cart_item );if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) { echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
						}?></span><?php echo $_product->get_attribute( 'cvet' );?> <?php pll_e('ct-10'); ?>
						Артикул <?php echo $_product->get_sku(); ?></div>
					</div>
					<div class="cart-item_row">
						<div class="product-size">
							<?php the_field('choise_size', $_product->get_id());?>
						</div>
						<div class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
							<?php 
						if ($_product->is_sold_individually()) {
							 $product_quantity = sprintf('<input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
						 } else {
								$input_args = array(
								'input_name' => "cart[{$cart_item_key}][qty]",
								'input_value' => $cart_item['quantity'],
								'max_value' => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
								'min_value' => '0'
							);
														  
							$product_quantity = woocommerce_quantity_input($input_args, $_product, false);
							}
							echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
							?>
						</div>
						<div class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</div>
												<div class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</div>
							<div class="product-remove">
							<?php
						echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
							'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect width="24" height="24" fill="#F5F5F5"/>
								<rect x="6.3606" y="7.25391" width="1.26316" height="13.8947" transform="rotate(-45 6.3606 7.25391)" fill="#B0B0B0"/>
								<rect x="7.25391" y="17.0789" width="1.26316" height="13.8947" transform="rotate(-135 7.25391 17.0789)" fill="#B0B0B0"/>
								</svg></a>',
							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
							__( 'Remove this item', 'woocommerce' ),
							esc_attr( $product_id ),
							esc_attr( $cart_item_key ),
							esc_attr( $_product->get_sku() )
						), $cart_item_key );
						?>
						</div>
					</div>
						
					</div>
					<?php
				}
			}

			do_action( 'woocommerce_mini_cart_contents' );
		?>
	</div>
	<div class="cart-collaterals">
		<div class="upload-blocks"></div>
	<div class="cart_totals">
		<div class="order-total">
			<div><?php pll_e('ct-11'); ?>:</div>
			<div data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php echo WC()->cart->get_cart_subtotal(); ?></div>
		</div>
	</div>
	</div>
	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
</form>
	<p class="woocommerce-mini-cart__buttons buttons"><?php //do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>

<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>
</div>
<?php do_action( 'woocommerce_after_mini_cart' ); ?>
