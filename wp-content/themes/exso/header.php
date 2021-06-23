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

	<link href=<?php bloginfo('template_url'); ?> favicon.svg rel="shortcut icon" type="image/x-icon">
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
	<header class="b-header animate-down">	
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
				<div class="b-lang">
					<ul><?php pll_the_languages(); ?></ul>
				</div>
			</div>
	</header>
	<!-- end b-header -->