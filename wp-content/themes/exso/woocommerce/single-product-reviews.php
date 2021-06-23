<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<div class="comment-count__block">
			<p><?php pll_e('pr-16'); ?></p>
					<span class="woocommerce-Reviews-title">
						(
			<?php
			$count = $product->get_review_count();
			if ( $count && wc_review_ratings_enabled() ) {
				/* translators: 1: reviews count 2: product name */
				echo $count;
			} else {
				echo '0';
			}
			?>
			)
		</span>
		<a href="#"><?php pll_e('pr-17'); ?></a>
		</div>


		<?php if ( have_comments() ) : ?>
			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => '<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4.33338 9.66654C4.48915 9.66685 4.64011 9.6126 4.76005 9.51321C4.82755 9.45725 4.88336 9.38851 4.92426 9.31095C4.96516 9.23338 4.99036 9.14851 4.99841 9.06119C5.00646 8.97388 4.9972 8.88583 4.97117 8.80209C4.94514 8.71836 4.90285 8.64058 4.84672 8.57321L1.86005 4.99988L4.74005 1.41988C4.79542 1.35169 4.83678 1.27322 4.86173 1.189C4.88669 1.10477 4.89475 1.01644 4.88546 0.929091C4.87616 0.841738 4.8497 0.757084 4.80758 0.679993C4.76547 0.602902 4.70853 0.534894 4.64005 0.479879C4.57107 0.419188 4.49029 0.37341 4.40278 0.345417C4.31528 0.317424 4.22293 0.307822 4.13153 0.317212C4.04014 0.326602 3.95167 0.354782 3.87168 0.399983C3.79169 0.445184 3.72191 0.506431 3.66671 0.579879L0.446714 4.57988C0.34866 4.69917 0.295056 4.8488 0.295056 5.00321C0.295056 5.15763 0.34866 5.30726 0.446714 5.42655L3.78005 9.42655C3.84693 9.50722 3.93188 9.571 4.02802 9.6127C4.12416 9.6544 4.22878 9.67285 4.33338 9.66654Z" fill="#B0B0B0"/>
</svg>',
							'next_text' => '<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1.66662 0.333455C1.51085 0.33315 1.35989 0.387401 1.23995 0.486788C1.17245 0.542754 1.11665 0.611488 1.07574 0.689054C1.03484 0.766618 1.00965 0.851489 1.00159 0.938807C0.993544 1.02612 1.0028 1.11417 1.02883 1.19791C1.05486 1.28164 1.09715 1.35942 1.15329 1.42679L4.13995 5.00012L1.25995 8.58012C1.20458 8.64831 1.16322 8.72678 1.13827 8.811C1.11331 8.89523 1.10525 8.98356 1.11454 9.07091C1.12384 9.15826 1.1503 9.24292 1.19242 9.32001C1.23453 9.3971 1.29147 9.46511 1.35995 9.52012C1.42893 9.58081 1.50971 9.62659 1.59722 9.65458C1.68472 9.68258 1.77707 9.69218 1.86847 9.68279C1.95986 9.6734 2.04833 9.64522 2.12832 9.60002C2.20831 9.55482 2.27809 9.49357 2.33329 9.42012L5.55329 5.42012C5.65134 5.30083 5.70494 5.1512 5.70494 4.99679C5.70494 4.84237 5.65134 4.69274 5.55329 4.57345L2.21995 0.573455C2.15307 0.492777 2.06812 0.429001 1.97198 0.387301C1.87584 0.345602 1.77122 0.327154 1.66662 0.333455Z" fill="#B0B0B0"/>
</svg>',
							'type'      => 'list',
						)
					)
				);
				echo '</nav>';
			endif;
			?>
		<?php else : ?>
			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>
		<?php endif; ?>
	

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
				$commenter    = wp_get_current_commenter();
				$comment_form = array(
					/* translators: %s is product title */
					'title_reply'         => have_comments() ? esc_html__( 'Add a review', 'woocommerce' ) : sprintf( esc_html__( 'Add a review', 'woocommerce' ), get_the_title() ),
					/* translators: %s is product title */
					'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
					'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
					'title_reply_after'   => '</span>',
					'comment_notes_after' => '',
					'label_submit'        => esc_html__( 'Submit', 'woocommerce' ),
					'logged_in_as'        => '',
					'comment_field'       => '',
				);

				$name_email_required = (bool) get_option( 'require_name_email', 1 );
				$fields              = array(
					'author' => array(
						'label'    => __( 'Name', 'woocommerce' ),
						'type'     => 'text',
						'value'    => $commenter['comment_author'],
						'required' => $name_email_required,
					),
					'email'  => array(
						'label'    => __( 'Email', 'woocommerce' ),
						'type'     => 'email',
						'value'    => $commenter['comment_author_email'],
						'required' => $name_email_required,
					),
				);

				$comment_form['fields'] = array();

				foreach ( $fields as $key => $field ) {
					$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
					$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

					if ( $field['required'] ) {
						$field_html .= '&nbsp;<span class="required">*</span>';
					}

					$field_html .= '</label><input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

					$comment_form['fields'][ $key ] = $field_html;
				}

				$account_page_url = wc_get_page_permalink( 'myaccount' );
				if ( $account_page_url ) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
				}

				if ( wc_review_ratings_enabled() ) {
					$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'woocommerce' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
					</select></div>';
				}

				$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';

				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>
		</div>
	<?php else : ?>
		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
	<?php endif; ?>

	<div class="clear"></div>
</div>
