<?php
/**
 * Grouped product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/grouped.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $post;

do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<form class="cart grouped_form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
	<div class="woocommerce-grouped-product-list group_table">
		
			<?php
			$quantites_required      = false;
			$previous_post           = $post;
			$grouped_product_columns = apply_filters(
				'woocommerce_grouped_product_columns',
				array(
					'quantity',
					'label',
					'price',
				),
				$product
			);
			$show_add_to_cart_button = false;

			do_action( 'woocommerce_grouped_product_list_before', $grouped_product_columns, $quantites_required, $product );

			foreach ( $grouped_products as $grouped_product_child ) {
				$post_object        = get_post( $grouped_product_child->get_id() );
				$quantites_required = $quantites_required || ( $grouped_product_child->is_purchasable() && ! $grouped_product_child->has_options() );
				$post               = $post_object; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				$size = get_field('choise_size', $post->ID);
				//print_r($size);
				setup_postdata( $post );
				

				if ( $grouped_product_child->is_in_stock() ) {
					$show_add_to_cart_button = true;
				}
				echo '<div id="product-' . esc_attr( $grouped_product_child->get_id() ) . '" class="woocommerce-grouped-product-list-item ' . esc_attr( implode( ' ', wc_get_product_class( '', $grouped_product_child ) ) ) . '">';

				// Output columns for each product.
				foreach ( $grouped_product_columns as $column_id ) {
					do_action( 'woocommerce_grouped_product_list_before_' . $column_id, $grouped_product_child );

					switch ( $column_id ) {
						case 'quantity':
							ob_start();

							if ( ! $grouped_product_child->is_purchasable() || $grouped_product_child->has_options() || ! $grouped_product_child->is_in_stock() ) {
								woocommerce_template_loop_add_to_cart();
							} elseif ( $grouped_product_child->is_sold_individually() ) {
								echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $grouped_product_child->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
							} else {
								do_action( 'woocommerce_before_add_to_cart_quantity' );

								woocommerce_quantity_input(
									array(
										'input_name'  => 'quantity[' . $grouped_product_child->get_id() . ']',
										'input_value' => '0', // phpcs:ignore WordPress.Security.NonceVerification.Missing
										'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product_child ),
										'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $grouped_product_child->get_max_purchase_quantity(), $grouped_product_child ),
										'placeholder' => '0',
									)
								);

								do_action( 'woocommerce_after_add_to_cart_quantity' );
							}

							$value = ob_get_clean();
							break;
						case 'label':
							$value  = '<label for="product-' . esc_attr( $grouped_product_child->get_id() ) . '">';
							$value .= $size;
							$value .= '</label>';
							break;
						case 'price':
							$value = $grouped_product_child->get_price_html() . wc_get_stock_html( $grouped_product_child );
							break;
						default:
							$value = '';
							break;
					}

					echo '<div class="woocommerce-grouped-product-list-item__' . esc_attr( $column_id ) . '">' . apply_filters( 'woocommerce_grouped_product_list_column_' . $column_id, $value, $grouped_product_child ) . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

					do_action( 'woocommerce_grouped_product_list_after_' . $column_id, $grouped_product_child );
				}

				echo '</div>';
			}
			$post = $previous_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			setup_postdata( $post );

			do_action( 'woocommerce_grouped_product_list_after', $grouped_product_columns, $quantites_required, $product );
			?>
		
	</div>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

	<?php if ( $quantites_required && $show_add_to_cart_button ) : ?>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<button type="submit" class="single_add_to_cart_button button alt">
			<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M20.7333 17.3334C22.3599 17.3334 23.0532 15.9868 23.0666 15.9601L27.7999 7.37342C28.1066 6.77342 28.0399 6.25342 27.7866 5.89342C27.5466 5.54675 27.1066 5.33342 26.6666 5.33342H6.94659L6.05325 3.42675C5.94609 3.19916 5.77632 3.0068 5.56379 2.87221C5.35127 2.73761 5.10481 2.66634 4.85325 2.66675H2.66659C1.93325 2.66675 1.33325 3.26675 1.33325 4.00008C1.33325 4.73342 1.93325 5.33342 2.66659 5.33342H3.99992L8.79992 15.4534L6.99992 18.7068C6.02659 20.4934 7.30658 22.6668 9.33325 22.6668H23.9999C24.7332 22.6668 25.3333 22.0668 25.3333 21.3334C25.3333 20.6001 24.7332 20.0001 23.9999 20.0001H9.33325L10.7999 17.3334H20.7333Z" fill="#fff"></path>
									<path d="M9.33341 29.3333C10.8062 29.3333 12.0001 28.1394 12.0001 26.6667C12.0001 25.1939 10.8062 24 9.33341 24C7.86066 24 6.66675 25.1939 6.66675 26.6667C6.66675 28.1394 7.86066 29.3333 9.33341 29.3333Z" fill="#fff"></path>
									<path d="M22.6667 29.3333C24.1394 29.3333 25.3333 28.1394 25.3333 26.6667C25.3333 25.1939 24.1394 24 22.6667 24C21.1939 24 20 25.1939 20 26.6667C20 28.1394 21.1939 29.3333 22.6667 29.3333Z" fill="#fff"></path>
									</svg>
			<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
				
			</button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php endif; ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
