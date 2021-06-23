	<?php $lang = pll_current_language(); ?>
	<!-- begin b-footer -->
	<footer class="b-footer">
		<div class="container">
			<div class="row">
				<div class="col-xl">
					<div class="b-footer-top">
						<div class="b-footer-item b-footer-item__nav">
							<div class="b-footer-item__top">
								<span><?php pll_e('Главная'); ?></span>
							</div>
							<?php wp_nav_menu(array('theme_location' => 'section-nav', 'container' => 'false' , 'container_class' => 'false')); ?>
						</div>
						<div class="b-footer-item">
							<div class="b-footer-item__top">
								<span><?php pll_e('Компьютерная вышивка'); ?></span>
							</div>
							<?php wp_nav_menu(array('theme_location' => 'footer-nav', 'container' => 'false' , 'container_class' => 'false')); ?>
						</div>
						<div class="b-footer-item">
							<div class="b-footer-item__top">
								<span><?php pll_e('Термопечать'); ?></span>
							</div>
							<?php wp_nav_menu(array('theme_location' => 'footer-nav2', 'container' => 'false' , 'container_class' => 'false')); ?>
						</div>
						<div class="b-footer-item">
							<div class="b-footer-item__top">
								<span><?php pll_e('Одежда'); ?></span>
							</div>
							<?php wp_nav_menu(array('theme_location' => 'footer-nav3', 'container' => 'false' , 'container_class' => 'false')); ?>
						</div>
					</div>	
					<div class="b-footer-bottom">
						<? if(get_option('copyright')){?><span class="b-copyright"><? echo get_option('copyright'); ?></span><?}?>
						<a target="_blank" href="https://www.weblancer.net/users/Bazilevskyi/" class="b-footer-block">
							<span>Created by</span>
							<i class="b-footer-block__ico"></i>
						</a>
					</div>														
				</div>
			</div>
		</div>
	</footer>
	<!-- end b-footer -->	

</div>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBv9-H5GwlZA4EkUorU0gGHrq0H4pFMPS4"></script>

<? wp_footer();?>

<script>
	jQuery(document).ready(function($) {
		$('.close-cart').on('click', function(event) {
			event.preventDefault();
			$( "#orderIssue" ).removeClass('active');
		});
		$('.cart-contents').on('click', function(event) {
			event.preventDefault();
			$( "#orderIssue" ).addClass('active');
			/*$( document ).load( document.URL, function() {
				$('.close-cart').on('click', function(event) {
					event.preventDefault();
					$('#cart-popup').remove();
					$( "#orderIssue" ).removeClass('active');
				});
			});*/
		});
		$( document.body ).on( 'added_to_cart', function(){
			$( "#orderIssue" ).addClass('active');
			/*$( "#orderIssue .all-cart" ).load( "/cart/ #cart-popup-w", function() {
				$('.close-cart').on('click', function(event) {
					event.preventDefault();
					$('#cart-popup').remove();
					$( "#orderIssue" ).removeClass('active');
				});
			});*/
		} );
		
	});

</script>
<?php if(is_cart()): ?>
<script>
	jQuery(document).ready(function($) {
		$('.close-cart').on('click', function(event) {
			event.preventDefault();
			history.go(-1);
		});
	});
</script>
<?php endif; ?>
<?php if(!is_cart()): ?>
<div id="orderIssue">
	<div id="cart-popup">
	<div class="all-cart">
		<?php echo do_shortcode( '[woocommerce_cart]' );?>
	</div>
	<div class="buttons-blocks">
		<div class="btn-back">
		<?php if ( $lang == 'ru' ): ?>
			<a href="/shop/"><?php pll_e('ct-8'); ?></a>
		<?php elseif ( $lang == 'uk' ): ?>
			<a href="/uk/katalog-tovariv/"><?php pll_e('ct-8'); ?></a>
		<?php endif; ?>
		</div>
		<div class="form">
			<?php echo do_shortcode( '[cf7form cf7key="bez-nazvaniya-2"]' ); ?>
		</div>
		<?php if ( $lang == 'ru' ): ?>
		<div class="btn-checkout"><a href="/checkout/"><?php pll_e('ct-9'); ?></a></div>
		<?php elseif ( $lang == 'uk' ): ?>
			<div class="btn-checkout"><a href="/uk/checkout-ua/"><?php pll_e('ct-9'); ?></a></div>
		<?php endif; ?>
	</div>
</div>
</div>
<?php endif; ?>
</div>
</body>
</html>