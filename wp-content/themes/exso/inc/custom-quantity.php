<div class="quantity">
	<input type="button" value="-" class="qty_button minus">
	<input
	type="number"
	id="<?php echo esc_attr( $input_id ); ?>"
	class="input-text qty text"
	step="<?php echo esc_attr( $step ); ?>"
	min="<?php echo esc_attr( $min_value ); ?>"
	max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
	name="<?php echo esc_attr( $input_name ); ?>"
	value="<?php echo esc_attr( $input_value ); ?>"
	title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ); ?>"
	size="4"
	pattern="<?php echo esc_attr( $pattern ); ?>"
	inputmode="<?php echo esc_attr( $inputmode ); ?>"/>
	<input type="button" value="+" class="qty_button plus">

</div>

<?php 
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