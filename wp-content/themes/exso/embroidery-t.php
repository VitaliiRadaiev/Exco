<?php
/*
Template Name: Новый шаблон страницы вышивка
Template Post Type: page
*/
?>

<?php get_header('shop');?>
					<div class="b-side side-shop">
						
						<div class="b-social__wrap">
							<a href="<?php echo get_home_url(); ?>" class="b-logo"></a>
							
						</div>
						<div class="b-social">
							<ul>
								<? if(get_option('Facebook')){?><li><a target="_blank" class="icon-facebook" href="<? echo get_option('Facebook'); ?>"></a></li><?}?>
								<? if(get_option('Instagram')){?><li><a target="_blank" class="icon-instagram" href="<? echo get_option('Instagram'); ?>"></a></li><?}?>
							</ul>
						</div>
						<div class="b-side-nav">
						<ul>
							<li><a href="#slider"></a></li>
							<li><a href="#why"></a></li>
							<li><a href="#order"></a></li>
							<li><a href="#port"></a></li>
							<li><a href="#price"></a></li>
							<li><a href="#prod"></a></li>
							<li><a href="#cont"></a></li>
						</ul>
					</div>
						<div class="shop-lang">
							<ul><?php pll_the_languages(); ?></ul>
						</div>
					</div>

	<div id="slider" class="section-em__slider">
			<div class="page-bredscrumb">
		<?php woocommerce_breadcrumb(); ?>
	</div>
			<div class="page-em__nav">
				<ul>
					<li><a href="#why">Почему мы?</a></li>
					<li><a href="#port">Примеры работ</a></li>
					<li><a href="#price">Цены</a></li>
					<li><a href="#prod">Одежда под нанесение</a></li>
				</ul>
			</div>
		<div class="section-em__slider-wrap">
			<?php while( have_rows('blocks') ): the_row();

					$image = get_sub_field('image');
					$size = 'full';
					$thumb = $image['sizes'][ $size ];
					$text = get_sub_field('text');
					$zagolovok = get_sub_field('zagolovok');
					$link = get_sub_field('link');
					?>
			<div class="section-em__slider-wrap-item">
				<div class="row flex-column-reverse flex-lg-row">
					<div class="col-12 col-lg-6 col-xl-3">
						<div class="section-em__slider-wrap-item-content">
							<div class="title">
								<?php echo $zagolovok;?>
							</div>
							<div class="text">
								<p><?php echo $text;?></p>
							</div>
							<div class="link">
								<a href="<?php echo $link;?>">Заказать</a>
							</div>
						</div>
					</div>
					<div class="col-12 col-lg-6 col-xl-9">
						<div class="section-em__slider-wrap-item-img">
							<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo $zagolovok;?>">
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
	<div id="why" class="section-em__why">
		<div class="section-em__why-wrap">
			<div class="wrap-container">
			<div class="row">
				<div class="col-12 col-lg-4 col-xl-3">
					<div class="section-em__why-wrap-content">
						<div class="title">
							<?php the_field('zagolovok-w');?>
						</div>
						<div class="text">
							<p><?php the_field('text-w');?></p>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-8 col-xl-9">
					<div class="section-em__why-wrap-blocks">
					<?php while( have_rows('blocksw') ): the_row();
						$text = get_sub_field('text');
						$zagolovok = get_sub_field('zagolovok');
					?>
					<div class="section-em__why-wrap-blocks-item">
						<div class="section-em__why-wrap-blocks-item-inner">
						<span><svg width="21" height="17" viewBox="0 0 21 17" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M8.04128 16.3448C7.84082 16.5465 7.56733 16.659 7.28323 16.659C6.99914 16.659 6.72564 16.5465 6.52518 16.3448L0.471203 10.2899C-0.157068 9.6616 -0.157068 8.64282 0.471203 8.01573L1.22925 7.25748C1.85772 6.62921 2.87532 6.62921 3.50359 7.25748L7.28323 11.0373L17.4964 0.823986C18.1248 0.195715 19.1434 0.195715 19.7707 0.823986L20.5288 1.58223C21.157 2.2105 21.157 3.22909 20.5288 3.85638L8.04128 16.3448Z" fill="white"/>
						</svg></span>
						<div class="title">
							<?php echo $zagolovok;?>
						</div>
						<div class="text">
							<p><?php echo $text;?></p>
						</div>
					</div>
					</div>
					<?php endwhile; ?>
					</div>
				</div>
		</div>
		</div>
	</div>
	</div>
	<div id="order" class="section-em__order">
		<div class="section-em__order-wrap">
			<div class="wrap-container">
			<div class="row">
				<div class="col-12 col-xl-3">
					<div class="section-em__order-wrap-content">
						<div class="title">
							<?php the_field('zagolovok-z');?>
						</div>
						<div class="text">
							<p><?php the_field('text-z');?></p>
						</div>
						<div class="link">
							<a href="<?php the_field('link-o');?>">Заказать</a>
						</div>
					</div>
				</div>
				<div class="col-12 col-xl-9">
					<?php $p = get_field('blocksz', false, false);
					$loop = new WP_Query(
						array(
							'post_type' => 'step',
							'post__in' => $p,
							'orderby' => 'menu_order'
						)); ?>
			<?php if($loop->have_posts()): ?>
			<div class="b-step-content">
				<?php $i = 1; while($loop->have_posts()): $loop->the_post();
					$image_id = get_post_thumbnail_id();
					$image_url = wp_get_attachment_image_src($image_id, 'full');
				 ?>	
				<div class="b-step-col">
					<div class="b-step-item">
						<div class="b-step-item__img <?php echo get_field('step_ico'); ?>">
							<span class="count"><?php echo get_field('number'); ?></span>
						</div>
						<div class="b-step-item__text">
							<span><?php echo get_field('step_title'); ?></span>
							<p><?php echo get_field('step_text'); ?></p>
						</div>
					</div>
				</div>
				<?php $i++; endwhile; ?>
			</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="port" class="section-em__portfolio">
	<div class="section-em__portfolio-wrap related">
		<div class="wrap-container">
			<div class="row">
				<div class="col-12">
				<div class="related-nav">
				<div class="title">Примеры работ</div>
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
				</div>
				<div class="col-12">
					<div class="gallery-wrap">
						<div class="gallery-wrap__slider">
							<?php while( have_rows('block-g') ): the_row();

								$image = get_sub_field('image');
								$size = 'gal';
								$thumb = $image['sizes'][ $size ];
								?>
							<div class="gallery-wrap__slider-item">
								<a data-fancybox="images" href="<?php echo $image['url'];?>">
									<img src="<?php echo $thumb;?>">
									<span class="icon">
										<svg width="92" height="92" viewBox="0 0 92 92" fill="none" xmlns="http://www.w3.org/2000/svg">
<g filter="url(#filter0_d)">
<circle cx="46" cy="46" r="26" fill="#F9B233"/>
</g>
<circle cx="46" cy="46" r="39.5" stroke="white"/>
<line x1="46" y1="37" x2="46" y2="55" stroke="white" stroke-width="2" stroke-linecap="round"/>
<line x1="37" y1="46" x2="55" y2="46" stroke="white" stroke-width="2" stroke-linecap="round"/>
<defs>
<filter id="filter0_d" x="0" y="0" width="92" height="92" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
<feOffset/>
<feGaussianBlur stdDeviation="10"/>
<feColorMatrix type="matrix" values="0 0 0 0 0.976471 0 0 0 0 0.698039 0 0 0 0 0.2 0 0 0 0.42 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
</filter>
</defs>
</svg>
									</span>
								</a>
								
							</div>
				<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="price" class="section-em__price">
	<div class="wrap-container">
		<div class="row">
			<div class="col-12">
				<div class="section-em__price-title">
					<div class="title">
						Цены
					</div>
					<div class="section-em__price-tab">
						<ul>
							<?php $i = 1; while( have_rows('blockp') ): the_row();
								$zagolovok = get_sub_field('zagolovok');
							?>
							<li>
								<a href="#tabBlock-<?php echo $i;?>"><?php echo $zagolovok;?></a>
							</li>
						<?php $i++; endwhile; ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="section-em__price-table">
					<?php $i = 1; while( have_rows('blockp') ): the_row();
						$table = get_sub_field('table');
					?>
						<div id="tabBlock-<?php echo $i;?>" class="section-em__price-table-item">
							<?php echo $table;?>
						</div>
					<?php $i++; endwhile; ?>
				</div>
			</div>
			<div class="col-12">
				<div class="section-em__price-link">
					<a href="<?php the_field('link-p');?>">Заказать</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="prod" class="section-em__product related">
	<div class="wrap-container">
		<div class="row">
			<div class="col-12">
				<div class="section-em__product-title">
					<div class="related-nav">
				<div class="title"><?php the_field('zagolovok-product');?></div>
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
				</div>
				</div>
			<div class="col-12">
				<?php $pr = get_field('products');
				?>
				<div class="products">
				<?php 
							$products = new WP_Query( array (
								'post_type'         => 'product',
								'post_status'       => 'publish',
								'post__in' => $pr,
					));
				if ( $products->have_posts() ) { ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>
					<?php
				} else {
					do_action( "woocommerce_shortcode_products_loop_no_results", $atts );
					echo "<p>Нет результов</p>";
				}
						woocommerce_reset_loop();
						wp_reset_postdata();
				 ?>
			</div>
			</div>
			</div>
		</div>
	</div>
	<div class="promo-text page-promo-text">
		<div class="promo-text__wrap">
			<div class="promo-text__wrap-item-big"><p><?php the_field('zagolovok-order');?></p></div>
			<?php while( have_rows('blockzp') ): the_row();

					$text = get_sub_field('text');
					?>
			<div class="promo-text__wrap-item">
				<p><?php echo $text;?></p>
			</div>
			<?php endwhile;?>
		</div>
	</div>
	<div id="cont" class="b-contacts section-em__contact">
		<div class="wrap-container">
			<div class="row">
				<div class="col-12 col-xl-4">
					<div class="section-em__why-wrap-content">
						<div class="title">
							<?php pll_e('contacts-text-1'); ?>
						</div>
						<div class="text">
							<p><?php pll_e('contacts-text-2'); ?></p>
						</div>
					</div>
				</div>
				<div class="col-12 col-xl-8">
					<div class="b-contacts-content">
						<div class="b-contacts-right">
							<div class="b-contacts-items">
								<div class="b-contacts-item">
									<div class="b-contacts-item__ico icon-phone"></div>
									<div class="b-contacts-item__text">
										<a href="tel:<?php echo get_option('tel'); ?>"><?php echo get_option('tel'); ?></a>
										<a href="tel:<?php echo get_option('tel2'); ?>"><?php echo get_option('tel2'); ?></a>
									</div>
								</div>
								<div class="b-contacts-item">
									<div class="b-contacts-item__ico icon-marker"></div>
									<div class="b-contacts-item__text">
										<span><?php pll_e('adr'); ?></span>
									</div>
								</div>
								<div class="b-contacts-item">
									<div class="b-contacts-item__ico icon-envelope"></div>
									<div class="b-contacts-item__text">
										<a href="mailto:<?php echo get_option('email'); ?>"><?php echo get_option('email'); ?></a>
									</div>
								</div>
								<div class="b-contacts-item">
									<div class="b-contacts-item__ico icon-time"></div>
									<div class="b-contacts-item__text">
										<span><?php pll_e('time'); ?></span>
									</div>
								</div>
							</div>
							<div class="b-contacts-form">
								<div class="b-form">
									<div class="b-form-title">
										<div class="title"><?php pll_e('form-title'); ?></div>
										<span><?php pll_e('form-text'); ?></span>
									</div>
									<?php echo do_shortcode( '[cf7form cf7key="kontaktnaya-forma"]' ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="map"></div>
	</div>
</div>

<?php get_footer('shop');?>