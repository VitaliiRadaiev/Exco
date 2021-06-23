<? get_header('shop');?>
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
				<li><a href="#category"></a></li>
				<li><a href="#advantages"></a></li>
				<li><a href="#info"></a></li>
				<li><a href="#works"></a></li>
				<li><a href="#step"></a></li>
				<li><a href="#partners"></a></li>
				<li><a href="#reviews"></a></li>
				<li><a href="#contacts"></a></li>
			</ul>
		</div>
						<div class="shop-lang">
							<ul><?php pll_the_languages(); ?></ul>
						</div>
					</div>


	<div class="b-category animate-right front-page" id="category" >
		<div class="b-category-content">
			<a href="<?php echo get_field('1_category_link'); ?>" class="b-category-item">
				<?php 

				$image = get_field('1_category_image');

				if( !empty($image) ): ?>

					<img class="lazy" data-original="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

				<?php endif; ?>
				<span class="b-category-item__text">
					<b><?php echo get_field('1_category_text'); ?></b>
				</span>
			</a>

			<a href="<?php echo get_field('2_category_link'); ?>" class="b-category-item">
				<?php 

				$image = get_field('2_category_image');

				if( !empty($image) ): ?>

					<img class="lazy" data-original="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

				<?php endif; ?>
				<span class="b-category-item__text">
					<b><?php echo get_field('2_category_text'); ?></b>
				</span>
			</a>

			<a href="<?php echo get_field('3_category_link'); ?>" class="b-category-item">
				<?php 

				$image = get_field('3_category_image');

				if( !empty($image) ): ?>

					<img class="lazy" data-original="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

				<?php endif; ?>
				<span class="b-category-item__text">
					<b><?php echo get_field('3_category_text'); ?></b>
				</span>
			</a>

			<a href="<?php echo get_field('4_category_link'); ?>" class="b-category-item">
				<?php 

				$image = get_field('4_category_image');

				if( !empty($image) ): ?>

					<img class="lazy" data-original="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

				<?php endif; ?>
				<span class="b-category-item__text">
					<b><?php echo get_field('4_category_text'); ?></b>
				</span>
			</a>

		</div>	
	</div>


	<section class="b-advantages section animate-top" id="advantages">
		<div class="b-advantages-circle b-advantages-circle__left"></div>
		<div class="b-advantages-circle2 b-advantages-circle2__left"></div>
		<div class="b-advantages-circle__right__wrapper">
			<div class="b-advantages-circle b-advantages-circle__right"></div>
		</div>
		<div class="b-advantages-circle2__right__wrapper">
			<div class="b-advantages-circle2 b-advantages-circle2__right"></div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xl">
					<div class="b-title">
						<h2><?php echo get_field('block-title__01'); ?></h2>
					</div>
				</div>
			</div>
			<div class="b-advantages-content">
				<div class="b-advantages-item">
					<div class="b-advantages-item__img icon-insurance"></div>
					<div class="b-advantages-item__text">
						<b><?php echo get_field('advantages-title'); ?></b>
						<p><?php echo get_field('advantages-text'); ?></p>
					</div>
				</div>

				<div class="b-advantages-item">
					<div class="b-advantages-item__img icon-cntr"></div>
					<div class="b-advantages-item__text">
						<b><?php echo get_field('advantages-title2'); ?></b>
						<p><?php echo get_field('advantages-text2'); ?></p>
					</div>
				</div>

				<div class="b-advantages-item">
					<div class="b-advantages-item__img icon-design"></div>
					<div class="b-advantages-item__text">
						<b><?php echo get_field('advantages-title3'); ?></b>
						<p><?php echo get_field('advantages-text3'); ?></p>
					</div>
				</div>
				<div class="b-advantages-item">
					<div class="b-advantages-item__img icon-timer"></div>
					<div class="b-advantages-item__text">
						<b><?php echo get_field('advantages-title44'); ?></b>
						<p><?php echo get_field('advantages-text44'); ?></p>
					</div>
				</div>				
			</div>
		</div>
	</section>

	<section class="b-info section animate-top" id="info">
		<div class="container">
			<div class="row">
				<div class="col-xl">
					<div class="b-title">
						<h2><?php pll_e('Почему нас выбирают'); ?></h2>
					</div>					
				</div>
			</div>
			<?php $loop = new WP_Query(array('post_type' => 'inf')); ?>
			<?php if($loop->have_posts()): ?>			
			<div class="b-info-content">				
				<div class="row">
					<?php while($loop->have_posts()): $loop->the_post();
						$image_id = get_post_thumbnail_id();
						$image_url = wp_get_attachment_image_src($image_id, 'full');
					 ?>						
					<div class="b-info-col col-xl-4 col-lg-4 col-md-6 col-sm-6">
						<div class="b-info-item">
							<div class="b-info-item__ico icon-check"></div>
							<div class="b-info-item__text">
								<b><?php echo get_field('info_title'); ?></b>
								<p><?php echo get_field('info_text'); ?></p>
							</div>
						</div>
					</div>
					<?php endwhile; ?>					
				</div>		

			</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>			
		</div>
	</section>

	<section class="b-works section animate-top" id="works">
		<div class="b-advantages-circle b-works-circle"></div>
		<div class="b-advantages-circle2 b-works-circle2"></div>
		<div class="b-works-circle__right__wrap">
			<div class="b-advantages-circle b-works-circle__right"></div>
		</div>
		<div class="b-works-circle2__right__wrap">
			<div class="b-advantages-circle2 b-works-circle2__right"></div>
		</div>					
		<div class="container">
			<div class="row">
				<div class="col-xl">
					<div class="b-works-top">
						<div class="b-title">
							<h2><?php pll_e('Наши работы'); ?></h2>
						</div>
						<div class="b-works-nav">
							<button class="b-arrow b-arrow__prev icon-arrow-left"></button>
							<button class="b-arrow b-arrow__next icon-arrow-right"></button>
						</div>
					</div>
				</div>
			</div>

			<div class="swiper-container b-works-slider">
				<div class="swiper-wrapper">
					<?php

	                $the_query = new WP_Query(
	                    array(
	                        'post_type' => 'post',
	                        'post_status' => array( 'publish' ),
	                        'posts_per_page' => -1,
	                        'order' => 'DESC',
	                    	'tax_query' => [
								[
									'taxonomy' => 'category',
									'field'    => 'id',
									'terms'    => array(18,1,14,16)
								],

							]
	                    )
	                );
	                if ( $the_query->have_posts() ) :
	                    while ($the_query->have_posts()) :
	                        $the_query->the_post();
	                        ?>
	                        <div class="b-works-col swiper-slide">
	                        	<a data-fancybox="images" href="<?php
								$thumb_id = get_post_thumbnail_id();
								$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
								echo $thumb_url[0];
								?>" class="b-works-item">
								<span class="b-works-ico"></span>
                        		<?php the_post_thumbnail('full', array('class' => 'swiper-lazy' ,'data-src'   => $src)); ?>
                        		<!-- <div class="swiper-lazy-preloader"></div> -->
	                        	</a>
	                        </div>
	                    <?php endwhile; ?>
	                <?php endif; ?>
	                <?php wp_reset_query(); ?>					
				</div>
			</div>

			
		</div>
	</section>

	<section class="b-step section animate-top" id="step">
		<div class="container">
			<div class="row">
				<div class="col-xl">
					<div class="b-title">
						<h2><?php pll_e('Как мы работаем'); ?></h2>
					</div>					
				</div>
			</div>
			<?php $loop = new WP_Query(
				array(
					'post_type' => 'step',
					'post__in'  => [ 156, 157, 159, 167],
			)); ?>
			<?php if($loop->have_posts()): ?>	
			<div class="b-step-content">
				<?php while($loop->have_posts()): $loop->the_post();
					$image_id = get_post_thumbnail_id();
					$image_url = wp_get_attachment_image_src($image_id, 'full');
				 ?>	
				<div class="b-step-col">
					<div class="b-step-item">
						<div class="b-step-item__img <?php echo get_field('step_ico'); ?>"></div>
						<div class="b-step-item__text">
							<b><?php echo get_field('step_title'); ?></b>
							<p><?php echo get_field('step_text'); ?></p>
						</div>
					</div>
				</div>
				<?php endwhile; ?>																
			</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>			
		</div>
	</section>

	<section class="b-partners section animate-top" id="partners">
		<div class="b-advantages-circle2 b-partners-circle2"></div>	
		<div class="b-partners-circle2__right__wrap">
			<div class="b-advantages-circle2 b-partners-circle2__right"></div>
		</div>		
		<div class="container">
			<div class="row">
				<div class="col-xl">
					<div class="b-title">
						<h2><?php pll_e('Наши клиенты'); ?></h2>
					</div>
					<?php $loop = new WP_Query(array('post_type' => 'partners')); ?>
						<?php if($loop->have_posts()): ?>							
					<div class="b-partners-content">
						<?php while($loop->have_posts()): $loop->the_post();
							$image_id = get_post_thumbnail_id();
							$image_url = wp_get_attachment_image_src($image_id, 'full');
						 ?>							
						<div class="b-partners-col">
							<div class="b-partners-item">
								 <?php if($image_url[0]){ ?>  <img class="lazy" data-original="<? echo $image_url[0];?>" alt=""> <?}else{(12312);}?>
							</div>
						</div>
						<?php endwhile; ?>	
					</div>
						<?php endif; ?>
					<?php wp_reset_postdata(); ?>					
				</div>
			</div>
		</div>
	</section>
<div class="container">
	<h1 style="color:#3C3C3B"></h1>
	<div class="seo_block">
		<!--seo_text_start--><!--seo_text_end-->	
	</div>
</div>	
	<section class="b-reviews section animate-top" id="reviews">
		<div class="b-advantages-circle b-reviews-circle"></div>
		<div class="container">
			<div class="row">
				<div class="col-xl">
					<?php $loop = new WP_Query(array('post_type' => 'reviews')); ?>
						<?php if($loop->have_posts()): ?>						
					<div class="swiper-container b-reviews-slider">
						<div class="swiper-wrapper">
							<?php while($loop->have_posts()): $loop->the_post();
								$image_id = get_post_thumbnail_id();
								$image_url = wp_get_attachment_image_src($image_id, 'full');
							 ?>	
							<div class="b-reviews-item swiper-slide">
								<div class="b-reviews-item__top">
									<b><?php echo get_field('reviews-name'); ?></b>
									<span><?php echo get_field('reviews-subtitle'); ?></span>
								</div>
								<div class="b-reviews-item___content">
									<div class="b-reviews-item__ico icon-quotes"></div>
									<p><?php echo get_field('reviews-text'); ?></p>
								</div>
							</div>
							<?php endwhile; ?>	
						</div>																		
					</div>
						<?php endif; ?>
					<?php wp_reset_postdata(); ?>					
					<div class="reviews-pagination"></div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="b-contacts" id="contacts">
		<div class="b-contacts-circle__wrap">
			<div class="b-advantages-circle b-contacts-circle"></div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xl">
					<div class="b-contacts-top animate-top">
						<div class="b-title">
							<h2><?php echo get_field('contacts-title'); ?></h2>
						</div>
						<div class="b-contacts-top__text">
							<p><?php echo get_field('contacts-text'); ?></p>
						</div>
					</div>
					<div class="b-contacts-content">
						<div class="b-contacts-image animate-left">
							<img class="lazy" data-original="<?php bloginfo('template_url'); ?>/images/girl.png" alt="">
						</div>
						<div class="b-contacts-right animate-right">
							<div class="b-contacts-items">
								<div class="b-contacts-item">
									<div class="b-contacts-item__ico icon-phone"></div>
									<div class="b-contacts-item__text">
										<a href="tel:<?php echo get_field('contacts-number'); ?>"><?php echo get_field('contacts-number'); ?></a>
										<a href="tel:<?php echo get_field('contacts-number2'); ?>"><?php echo get_field('contacts-number2'); ?></a>
									</div>
								</div>
								<div class="b-contacts-item">
									<div class="b-contacts-item__ico icon-marker"></div>
									<div class="b-contacts-item__text">
										<span><?php echo get_field('contacts-adress'); ?></span>
									</div>
								</div>
								<div class="b-contacts-item">
									<div class="b-contacts-item__ico icon-envelope"></div>
									<div class="b-contacts-item__text">
										<a href="mailto:<?php echo get_field('contacts-mail'); ?>"><?php echo get_field('contacts-mail'); ?></a>
									</div>
								</div>
								<div class="b-contacts-item">
									<div class="b-contacts-item__ico icon-time"></div>
									<div class="b-contacts-item__text">
										<span><?php echo get_field('contacts-time'); ?></span>
									</div>
								</div>
							</div>
							<div class="b-contacts-form">
								<div class="b-form">
									<div class="b-form-title">
										<b><?php echo get_field('form_title'); ?></b>
										<span><?php echo get_field('form_desc'); ?></span>
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
	</section>

<? get_footer('shop');?>