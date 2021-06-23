<?php
/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) {

	echo $wrap_before;

	foreach ( $breadcrumb as $key => $crumb ) {

		echo $before;

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
		} else {
			echo esc_html( $crumb[0] );
		}

		echo $after;

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<span class="dimiter"><svg width="5" height="8" viewBox="0 0 5 8" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1.00003 7.49997C0.8832 7.5002 0.769981 7.45951 0.680025 7.38497C0.629396 7.343 0.587545 7.29144 0.556869 7.23327C0.526193 7.1751 0.507295 7.11144 0.501257 7.04596C0.495219 6.98047 0.50216 6.91443 0.521683 6.85163C0.541205 6.78883 0.572924 6.73049 0.615025 6.67997L2.85503 3.99997L0.695026 1.31497C0.653493 1.26383 0.622477 1.20498 0.603761 1.14181C0.585045 1.07864 0.578998 1.01239 0.585968 0.946879C0.592937 0.881365 0.612786 0.817874 0.644373 0.760056C0.67596 0.702237 0.718662 0.651232 0.770026 0.60997C0.821759 0.564452 0.882342 0.530118 0.947973 0.509124C1.0136 0.488129 1.08287 0.480927 1.15141 0.48797C1.21996 0.495012 1.28631 0.516147 1.3463 0.550048C1.40629 0.583949 1.45863 0.629884 1.50003 0.68497L3.91503 3.68497C3.98857 3.77444 4.02877 3.88666 4.02877 4.00247C4.02877 4.11828 3.98857 4.2305 3.91503 4.31997L1.41503 7.31997C1.36487 7.38048 1.30115 7.42831 1.22905 7.45958C1.15694 7.49086 1.07848 7.5047 1.00003 7.49997Z" fill="#B0B0B0"/>
</svg></span>';
		}
	}

	echo $wrap_after;

}
