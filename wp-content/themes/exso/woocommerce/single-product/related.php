<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="related products">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<div class="related-nav">
				<h2><?php echo esc_html( $heading ); ?></h2>
				<div class="slider-nav">
					<div class="slider-arrow">
						<button class="nav-next">
							<svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M7.77818 0.707107C7.38766 0.316583 6.75449 0.316583 6.36397 0.707107L0.707113 6.36396C0.316589 6.75448 0.316589 7.38765 0.707113 7.77817L6.36397 13.435C6.75449 13.8256 7.38766 13.8256 7.77818 13.435C8.1687 13.0445 8.1687 12.4113 7.77818 12.0208L2.82843 7.07107L7.77818 2.12132C8.16871 1.7308 8.16871 1.09763 7.77818 0.707107Z"/>
							</svg>
						</button>
							<button class="nav-prev">
							<svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M7.22185 13.435C7.61237 13.8256 8.24554 13.8256 8.63606 13.435L14.2929 7.77818C14.6834 7.38765 14.6834 6.75449 14.2929 6.36396L8.63606 0.707107C8.24554 0.316582 7.61237 0.316583 7.22185 0.707107C6.83132 1.09763 6.83133 1.7308 7.22185 2.12132L12.1716 7.07107L7.22185 12.0208C6.83132 12.4113 6.83132 13.0445 7.22185 13.435Z"/>
</svg>
						</button>
					</div>
				</div>
			</div>
		<?php endif; ?>
		
		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
					?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>
	<?php
endif;

wp_reset_postdata();
