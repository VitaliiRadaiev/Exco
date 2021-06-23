jQuery( function( $ ) {
	$('.menu-item-has-children').each(function(index, el) {
		$(this).on('mouseenter', function(event) {
			$(this).addClass('active')
		});
		$(this).on('mouseleave', function(event) {
			$(this).removeClass('active');
		});
	});
	let tabs = $('#tabs');
	$('.tabs-content > .tab_content', tabs).each(function (i) {
		if (i != 0) $(this).fadeOut(0);
	});
	tabs.on('click', '.tabs li.tab a', function (e) {
		e.preventDefault();

		let tabId = $(this).attr('href');

		$('.tabs li.tab a', tabs).removeClass();
		$(this).addClass('active_tab');

		$('.tabs-content > .tab_content', tabs).fadeOut(0);
		$(tabId).fadeIn();
	});

	let timeout;

	$(document).on('change keyup mouseup', 'input.qty', function(){
		if (timeout != undefined) clearTimeout(timeout);
		if ($(this).val() == '') return;
		timeout = setTimeout(function() {
			$('[name="update_cart"]').trigger('click');
		}, 500 );
	});
	$(document).on('click', '.cat-block__title a', function(event) {
		event.preventDefault();
		$(this).toggleClass('active').parents('.cat-block').children('.categories').toggle();
	});
	$('.woocommerce-grouped-product-list-item').each(function(index, el) {
		$(this).on('click', function(event) {
			$(this).addClass('visible');
		});
	});

	function checkout(){
		$(document.body).on('click', '.woocommerce-checkout-payment', function(event) {
			$(this).addClass('opened');
		});
		$(document.body).on('click', '.del-block', function(event) {
			$(this).addClass('opened');
		});
		$('.wc_payment_methods li').each(function(index, el) {
			let inp = $(this).children('.input-radio');
			if (inp.is(':checked')){
				$(this).addClass('active');
			}
			inp.on('change', function(event) {
				$('.woocommerce-checkout-payment').removeClass('opened');
				if (inp.is(':checked')){
					$(this).parents('li').addClass('active').siblings('li').removeClass('active');
				}
			});
		});
		$('#shipping_method li').each(function(index, el) {
			let inp = $(this).children('.shipping_method');
			if (inp.is(':checked')){
				$(this).addClass('active');
			}
			inp.on('change', function(event) {
				$('.del-block').removeClass('opened');
				if (inp.is(':checked')){
					$(this).parents('li').addClass('active').siblings('li').removeClass('active');
				}
			});
		});
		$(document.body).on('click', '.checkout-btn__good', function(event) {
			event.preventDefault();
			$('.right-col__checkout #place_order').trigger('click');
		});
	}
	$( document ).on( 'updated_checkout', checkout);
	$(document).on('click', '.comment-count__block a', function(event) {
		event.preventDefault();
		$('#review_form_wrapper').fadeToggle(500);
	});


	$('.section-em__price-table > .section-em__price-table-item').each(function (index) {
		if (index != 0) $(this).fadeOut(0);
	});

	$('.section-em__price-tab ul li').each(function(index, el) {
		if(index == 0){
			$(this).children('a').addClass('active');

		}
		
		$(this).children('a').on('click', function(event) {
			event.preventDefault();
			let tabId = $(this).attr('href');
			$(this).addClass('active').parent('li').siblings().children('a').removeClass('active');
			$('.section-em__price-table > .section-em__price-table-item').fadeOut(0);
			$(tabId).fadeIn();
		});
	});
	$('.related .products').slick({
		infinite: true,
		dots: false,
		autoplay: false,
		nextArrow: '.nav-next',
		prevArrow: '.nav-prev',
		slidesToShow: 1,
		speed: 800,
		adaptiveHeight: true,
		mobileFirst: true,
		cssEase: 'linear',
		responsive: [
		{
			breakpoint: 479,
			settings: {
				slidesToShow: 1
			}
		},
		{
			breakpoint: 767,
			settings: {
				slidesToShow: 2
			}
		},
		{
			breakpoint: 991,
			settings: {
				slidesToShow: 3
			}
		},
		{
			breakpoint: 1360,
			settings: {
				slidesToShow: 4,
			}
		},
		{
			breakpoint: 1919,
			settings: {
				slidesToShow: 6,
				nextArrow: '.nav-next',
				prevArrow: '.nav-prev',
			}
		}
		]
	});
	$('.related-post-sl').slick({
		infinite: true,
		dots: false,
		autoplay: false,
		nextArrow: '.related-post .nav-next',
		prevArrow: '.related-post .nav-prev',
		slidesToShow: 1,
		speed: 800,
		mobileFirst: true,
		cssEase: 'linear',
		responsive: [
		{
			breakpoint: 479,
			settings: {
				slidesToShow: 1
			}
		},
		{
			breakpoint: 767,
			settings: {
				slidesToShow: 2
			}
		},
		{
			breakpoint: 991,
			settings: {
				slidesToShow: 3
			}
		},
		{
			breakpoint: 1360,
			settings: {
				slidesToShow: 4,
			}
		},
		{
			breakpoint: 1919,
			settings: {
				slidesToShow: 4,
				nextArrow: '.related-post .nav-next',
				prevArrow: '.related-post .nav-prev',
			}
		}
		]
	});
	$('.section-em__slider-wrap').slick({
		infinite: true,
		dots: true,
		autoplay: false,
		arrows: false,
		slidesToShow: 1,
		speed: 800,
		adaptiveHeight: true,
		mobileFirst: true,
		cssEase: 'linear',
	});
	$('.gallery-wrap__slider').slick({
		infinite: true,
		dots: false,
		slidesPerRow: 1,
		rows: 2,
		mobileFirst: true,
		nextArrow: '.section-em__portfolio .nav-next',
		prevArrow: '.section-em__portfolio .nav-prev',
		cssEase: 'linear',
		responsive: [
		{
			breakpoint: 320,
			settings: {
				slidesPerRow: 1,
				rows: 2,
			}
		},{
			breakpoint: 767,
			settings: {
				slidesPerRow: 2,
				rows: 2,
			}
		},{
			breakpoint: 991,
			settings: {
				slidesPerRow: 4,
				rows: 2,
			}
		}
		]
	});
	$('.section-em__product .products').slick({
		dots: false,
		autoplay: false,
		nextArrow: '.section-em__product .nav-next',
		prevArrow: '.section-em__product .nav-prev',
		slidesToShow: 1,
		speed: 800,
		adaptiveHeight: true,
		mobileFirst: true,
		cssEase: 'linear',
		responsive: [
		{
			breakpoint: 479,
			settings: {
				slidesToShow: 1
			}
		},
		{
			breakpoint: 767,
			settings: {
				slidesToShow: 2
			}
		},
		{
			breakpoint: 991,
			settings: {
				slidesToShow: 3
			}
		},
		{
			breakpoint: 1360,
			settings: {
				slidesToShow: 4,
			}
		},
		{
			breakpoint: 1919,
			settings: {
				slidesToShow: 6,
				nextArrow: '.nav-next',
				prevArrow: '.nav-prev',
			}
		}
		]
	});

});