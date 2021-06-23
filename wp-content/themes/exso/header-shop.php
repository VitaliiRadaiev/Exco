<?php if(is_cart()){header ("Location: /shop/");} $lang = pll_current_language();?>
<!DOCTYPE html>
<html lang="ru">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">

	<title>EXSO</title>
	<meta property="og:title" content="" /> 
	<meta property="og:description" content="" />
	<meta name="title" content="" /> 
	<meta name="description" content="" /> 
	

	<link href=<?php bloginfo('template_url'); ?> favicon.svg rel="shortcut icon" type=”image/x-icon”>
	<link rel="shortcut icon" href="#">
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.svg" type="image/svg" />
	<? wp_head();?>	
</head>
<body>

	<!-- modal-callback -->
	<div class="modal b-modal-callback fade" id="modal-callback" tabindex="-1" role="dialog" aria-labelledby="modal-callback" aria-hidden="true">
		<div class="modal-dialog">
			<button class="btn-close" data-dismiss="modal"></button>
			<div class="b-form">
				<div class="b-form-title">
					<b><?php pll_e('Форма обратной связи'); ?></b>
					<span><?php pll_e('Оставьте свои контактные данные
					и мы свяжемся с вами'); ?></span>
				</div>
				<?php echo do_shortcode( '[cf7form cf7key="forma-v-pop-ap"]' ); ?>
			</div>	
		</div>
	</div>


	<div class="b-container">
		
		
		<!-- begin b-header -->
		<header class="b-header animate-down header-shop">	
			<a href="<?php echo get_home_url(); ?>" class="xs-logo"></a>
			<button class="btn-menu">
				<span class="btn-menu__line"></span>
				<span class="btn-menu__line"></span>
				<span class="btn-menu__line"></span>
			</button>
			<div class="b-mobile">
				<div class="menu-icon">
					<div class="menu-icon__wrapper">
						<span class="b-menu__icon">
							<i class="b-menu__line b-menu__line_1"></i>
							<i class="b-menu__line b-menu__line_2"></i>
							<i class="b-menu__line b-menu__line_3"></i>
						</span>
					</div>
				</div> 
			</div>
			<div class="b-header-content">
				<div class="b-header__drodown">
					<?php wp_nav_menu(array('theme_location' => 'section-nav', 'container' => 'div' , 'container_class' => 'b-section-nav')); ?>
				</div>
				<?php wp_nav_menu(array('theme_location' => 'nav', 'container' => 'div' , 'container_class' => 'b-nav')); ?>
				<div class="b-header-contacts">
					<div class="b-header-contacts__item">
						<i class="icon-phone"></i>
						<? if(get_option('tel')){?>
							<a href="tel:<? echo get_option('tel'); ?>"><? echo get_option('tel'); ?></a>
							<?}?>
							<span>|</span> 
							<? if(get_option('tel2')){?>
								<a href="tel:<? echo get_option('tel2'); ?>"><? echo get_option('tel2'); ?></a>
								<?}?>
							</div>
							<? if(get_option('email')){?>
								<div class="b-header-contacts__item">
									<i class="icon-mail"></i>
									<a href="mailto:<? echo get_option('email'); ?>"><? echo get_option('email'); ?></a>
								</div>
								<?}?>
							</div>
							<button class="btn-callback" data-toggle="modal" data-target="#modal-callback"><?php pll_e('Написать нам'); ?></button>
							<div class="b-lang mini-cart">
								<a class="cart-contents" href="">
									<?php
									$item_count_text = sprintf(
										_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'agrobud' ),
										WC()->cart->get_cart_contents_count()
									);
									?>
									<span class="count">
										<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M20.7333 17.3334C22.3599 17.3334 23.0532 15.9868 23.0666 15.9601L27.7999 7.37342C28.1066 6.77342 28.0399 6.25342 27.7866 5.89342C27.5466 5.54675 27.1066 5.33342 26.6666 5.33342H6.94659L6.05325 3.42675C5.94609 3.19916 5.77632 3.0068 5.56379 2.87221C5.35127 2.73761 5.10481 2.66634 4.85325 2.66675H2.66659C1.93325 2.66675 1.33325 3.26675 1.33325 4.00008C1.33325 4.73342 1.93325 5.33342 2.66659 5.33342H3.99992L8.79992 15.4534L6.99992 18.7068C6.02659 20.4934 7.30658 22.6668 9.33325 22.6668H23.9999C24.7332 22.6668 25.3333 22.0668 25.3333 21.3334C25.3333 20.6001 24.7332 20.0001 23.9999 20.0001H9.33325L10.7999 17.3334H20.7333Z"/>
											<path d="M9.33341 29.3333C10.8062 29.3333 12.0001 28.1394 12.0001 26.6667C12.0001 25.1939 10.8062 24 9.33341 24C7.86066 24 6.66675 25.1939 6.66675 26.6667C6.66675 28.1394 7.86066 29.3333 9.33341 29.3333Z" fill="#F9B233"/>
											<path d="M22.6667 29.3333C24.1394 29.3333 25.3333 28.1394 25.3333 26.6667C25.3333 25.1939 24.1394 24 22.6667 24C21.1939 24 20 25.1939 20 26.6667C20 28.1394 21.1939 29.3333 22.6667 29.3333Z"/>
										</svg>
										<strong><?php if($item_count_text){echo esc_html( $item_count_text );}else{ echo "0";} ?></strong>
										
									</span>
									<span class="amount">
										<?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?>
									</span>
								</a>
								
							</div>
						</div>
					</header>
					<!-- end b-header -->
					<div id="orderIssue">
						<div id="cart-popup">
							<div class="all-cart">
								<div class="widget_shopping_cart">
									<div class="widget_shopping_cart_content">
										
									</div>
								</div>
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
								<div class="img-blocks"></div>
								</div>
							</div>