<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.6.0
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if ( ! $order ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ( $show_downloads ) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}
?>
<?php $lang = pll_current_language(); ?>
<?php if ( $lang == 'ru' ): ?>
<div id="order-block" class="order-block">
	<div class="order-block__wrap">
		<div class="title">СПАСИБО ЗА ЗАКАЗ</div>
		<div class="desc">Наши менеджеры свяжутся с вами в ближайшее время.</div>
		<img class="animated zoomIn" src="<?php echo get_stylesheet_directory_uri() ;?>/images/ok.png" alt="">
		<a href="/shop/">Вернуться в магазин</a>
	</div>
</div>
<?php elseif ( $lang == 'uk' ): ?>
	<div id="order-block" class="order-block">
	<div class="order-block__wrap">
		<div class="title">Дякуємо за замовлення</div>
		<div class="desc">Наші менеджери зв'яжуться з вами найближчим часом.</div>
		<img class="animated fadeInLeft" src="<?php echo get_stylesheet_directory_uri() ;?>/images/ok.png" alt="">
		<a href="/uk/katalog-tovariv/">Повернутися в магазин</a>
	</div>
</div>
<?php endif; ?>

<?php
/**
 * Action hook fired after the order details.
 *
 * @since 4.4.0
 * @param WC_Order $order Order data.
 */
do_action( 'woocommerce_after_order_details', $order );

if ( $show_customer_details ) {
	wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}
