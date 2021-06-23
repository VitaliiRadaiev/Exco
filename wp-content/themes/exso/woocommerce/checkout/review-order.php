<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="shop_table woocommerce-checkout-review-order-table">

		<div class="products-top__desc">
			<div class="name"><?php pll_e('ct-1'); ?></div>
			<div class="size"><?php pll_e('ct-2'); ?></div>
			<div class="count"><?php pll_e('ct-3'); ?></div>
			<div class="price"><?php pll_e('ct-5'); ?></div>
		</div>
		<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<div class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
					<div class="product-checkout__name">
					<div class="product-checkout__img">
						<?php echo $_product->get_image('minicart');?>
					</div>
					<div class="product-name">
						<span><?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; ?></span>
						<?php echo $_product->get_attribute( 'cvet' );?> <?php pll_e('ct-10'); ?>
						Артикул <?php echo $_product->get_sku(); ?>
						
					</div>
					</div>
					<div class="product-checkout__size">
						<?php the_field('choise_size', $_product->get_id());?>
					</div>
					<div class="product-checkout__count">
						<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', '' . sprintf( '%s', $cart_item['quantity'] ) . '', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<div class="product-total">
						<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				</div>
				<?php
			}
		}

		do_action( 'woocommerce_review_order_after_cart_contents' );
		?>

		<div class="right-pay__block">
		<div class="cart-subtotal">
			<span class="s-title"><?php pll_e('ch-3'); ?>:</span>
			<span class="sum"><?php wc_cart_totals_subtotal_html(); ?></span>
		</div>





		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<div class="fee">
				<span><?php echo esc_html( $fee->name ); ?></span>
				<span><?php wc_cart_totals_fee_html( $fee ); ?></span>
			</div>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
					<div class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<span><?php echo esc_html( $tax->label ); ?></span>
						<span><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="tax-total">
					<span><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></span>
					<span><?php wc_cart_totals_taxes_total_html(); ?></span>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
		<?php foreach( WC()->session->get('shipping_for_package_0')['rates'] as $method_id => $rate ){
				if( WC()->session->get('chosen_shipping_methods')[0] == $method_id ){
		$rate_label = $rate->label; // The shipping method label name
		$rate_cost_excl_tax = floatval($rate->cost); // The cost excluding tax
		// The taxes cost
		$rate_taxes = 0;
		foreach ($rate->taxes as $rate_tax)
			$rate_taxes += floatval($rate_tax);
		// The cost including tax
		$rate_cost_incl_tax = $rate_cost_excl_tax + $rate_taxes;
		//echo $rate_cost_incl_tax;
		echo '<div class="checkout-info__delivery">
		<span class="label">Доставка: </span>
		<span class="amount"><bdi>'. $rate_cost_incl_tax .'&nbsp;<span>грн</span></bdi></span>
		</div>';
		break;
	}
}?>
		<div class="order-total">
			<span class="s-title"><?php pll_e('ct-11'); ?>:</span>
			<span class="sum"><?php wc_cart_totals_order_total_html(); ?></span>
		</div>
</div>
		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>


</div>
