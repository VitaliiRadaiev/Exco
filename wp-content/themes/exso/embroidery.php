<?php
/*
Template Name: Шаблон страницы вышивка
Template Post Type: page
*/
?>

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
				<li><a href="#category-section"></a></li>
				<li><a href="#advantages"></a></li>
				<li><a href="#person"></a></li>
				<li><a href="#articles-container"></a></li>
				<li><a href="#video"></a></li>
				<li><a href="#step"></a></li>
				<li><a href="#works"></a></li>
				<li><a href="#contacts"></a></li>
			</ul>
		</div>
						<div class="shop-lang">
							<ul><?php pll_the_languages(); ?></ul>
						</div>
					</div>


	<div class="b-category-block" id="category-section">
		<div class="b-category-block__image"><img class="lazy" data-original="<?php echo get_the_post_thumbnail_url('', 'full')  ?>" src="" alt="" /></div>
		<div class="b-category-block__content">
			<div class="container">
				<div class="row">
					<div class="col-xl">
						<div class="b-category-block__content__text">
							<h1><?php the_title(); ?></h1>
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
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
						<h2><?php echo get_field('title_1'); ?></h2>
					</div>
				</div>
			</div>
			<div class="b-advantages-content">
				<div class="b-advantages-item">
					<div class="b-advantages-item__img icon-adv"></div>
					<div class="b-advantages-item__text">
						<b><?php echo get_field('advantages-title'); ?></b>
						<p><?php echo get_field('advantages-text'); ?></p>
					</div>
				</div>

				<div class="b-advantages-item">
					<div class="b-advantages-item__img icon-adv2"></div>
					<div class="b-advantages-item__text">
						<b><?php echo get_field('advantages-title2'); ?></b>
						<p><?php echo get_field('advantages-text2'); ?></p>
					</div>
				</div>

				<div class="b-advantages-item">
					<div class="b-advantages-item__img icon-adv3"></div>
					<div class="b-advantages-item__text">
						<b><?php echo get_field('advantages-title3'); ?></b>
						<p><?php echo get_field('advantages-text3'); ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	
	<div class="b-person-container animate-top" id="person">
		<div class="container">
			<div class="row">
				<div class="col-xl">
					<div class="b-person">
						<div class="b-person-item">
							<a href="#emb1" class="b-dot" data-toggle="tooltip" data-placement="left" title="<?php echo get_field('dot_1'); ?>" id="part-1"></a>
							<a href="#emb2" class="b-dot" data-toggle="tooltip" data-placement="left" title="<?php echo get_field('dot_2'); ?>" id="part-2"></a>
							<a href="#emb3" class="b-dot" data-toggle="tooltip" data-placement="left" title="<?php echo get_field('dot_3'); ?>" id="part-3"></a>
							<a href="#emb4" class="b-dot" data-toggle="tooltip" data-placement="left" title="<?php echo get_field('dot_4'); ?>" id="part-4"></a>
							<img src="<?php bloginfo('template_url'); ?>/images/b-person-item__img.svg" alt="">
						</div>
						<div class="b-person-item">
							<a href="#emb5" class="b-dot" data-toggle="tooltip" data-placement="left" title="<?php echo get_field('dot_5'); ?>" id="part-5"></a>
							<a href="#emb6" class="b-dot" data-toggle="tooltip" data-placement="left" title="<?php echo get_field('dot_6'); ?>" id="part-6"></a>
							<a href="#emb7" class="b-dot" data-toggle="tooltip" data-placement="left" title="<?php echo get_field('dot_7'); ?>" id="part-7"></a>
							<img src="<?php bloginfo('template_url'); ?>/images/b-person-item__img2.svg" alt="">
						</div>					
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<div class="b-articles-container" id="articles-container">
		<section class="b-articles-block animate-top">
			<div class="container">
				<div class="row">
					<div class="col-xl">
						<div class="b-articles-row" id="emb1">
							<div class="b-articles-row__image">
								<?php 
								$image = get_field('embroidery_img');
								if( !empty($image) ): ?>
									<img class="lazy" data-original="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="b-articles-row__text">
								<b><?php echo get_field('embroidery_title'); ?></b>
								<p><?php echo get_field('embroidery_text'); ?></p>
								<div class="b-articles-row__link__wrapper">
									<a class="b-articles-row__link" href="<?php echo get_field('embroidery_url'); ?>"><?php echo get_field('embroidery_link'); ?> <i class="icon-arrow-right__long"></i></a>
								</div>
							</div>
						</div>
						<div class="b-articles-row b-articles-row__reverse" id="emb2">
							<div class="b-articles-row__image">
								<?php 
								$image = get_field('embroidery_img2');
								if( !empty($image) ): ?>
									<img class="lazy" data-original="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="b-articles-row__text">
								<b><?php echo get_field('embroidery_title2'); ?></b>
								<p><?php echo get_field('embroidery_text3'); ?></p>
								<div class="b-articles-row__link__wrapper">
									<a class="b-articles-row__link" href="<?php echo get_field('embroidery_url'); ?>"><?php echo get_field('embroidery_link'); ?> <i class="icon-arrow-right__long"></i></a>
								</div>
							</div>
						</div>					
					</div>
				</div>
			</div>
		</section>
		<section class="b-articles-block animate-top">
			<div class="container">
				<div class="row">
					<div class="col-xl">
						<div class="b-articles-row" id="emb3">
							<div class="b-articles-row__image">
								<?php 
								$image = get_field('embroidery_img3');
								if( !empty($image) ): ?>
									<img class="lazy" data-original="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="b-articles-row__text">
								<b><?php echo get_field('embroidery_title3'); ?></b>
								<p><?php echo get_field('embroidery_text3'); ?></p>
								<div class="b-articles-row__link__wrapper">
									<a class="b-articles-row__link" href="<?php echo get_field('embroidery_url'); ?>"><?php echo get_field('embroidery_link'); ?> <i class="icon-arrow-right__long"></i></a>
								</div>
							</div>
						</div>
						<div class="b-articles-row b-articles-row__reverse" id="emb4">
							<div class="b-articles-row__image">
								<?php 
								$image = get_field('embroidery_img4');
								if( !empty($image) ): ?>
									<img class="lazy" data-original="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="b-articles-row__text">
								<b><?php echo get_field('embroidery_title4'); ?></b>
								<p><?php echo get_field('embroidery_text4'); ?></p>
								<div class="b-articles-row__link__wrapper">
									<a class="b-articles-row__link" href="<?php echo get_field('embroidery_url'); ?>"><?php echo get_field('embroidery_link'); ?> <i class="icon-arrow-right__long"></i></a>
								</div>
							</div>
						</div>					
					</div>
				</div>
			</div>
		</section>
		<section class="b-articles-block animate-top">
			<div class="container">
				<div class="row">
					<div class="col-xl">
						<div class="b-articles-row" id="emb5">
							<div class="b-articles-row__image">
								<?php 
								$image = get_field('embroidery_img5');
								if( !empty($image) ): ?>
									<img class="lazy" data-original="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="b-articles-row__text">
								<b><?php echo get_field('embroidery_title5'); ?></b>
								<p><?php echo get_field('embroidery_text5'); ?></p>
								<div class="b-articles-row__link__wrapper">
									<a class="b-articles-row__link" href="<?php echo get_field('embroidery_url'); ?>"><?php echo get_field('embroidery_link'); ?> <i class="icon-arrow-right__long"></i></a>
								</div>
							</div>
						</div>
						<div class="b-articles-row b-articles-row__reverse" id="emb6">
							<div class="b-articles-row__image">
								<?php 
								$image = get_field('embroidery_img6');
								if( !empty($image) ): ?>
									<img class="lazy" data-original="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="b-articles-row__text">
								<b><?php echo get_field('embroidery_title6'); ?></b>
								<p><?php echo get_field('embroidery_text6'); ?></p>
								<div class="b-articles-row__link__wrapper">
									<a class="b-articles-row__link" href="<?php echo get_field('embroidery_url'); ?>"><?php echo get_field('embroidery_link'); ?> <i class="icon-arrow-right__long"></i></a>
								</div>
							</div>
						</div>					
					</div>
				</div>
			</div>
		</section>
		<section class="b-articles-block animate-top">
			<div class="container">
				<div class="row">
					<div class="col-xl">
						<div class="b-articles-row" id="emb7">
							<div class="b-articles-row__image">
								<?php 
								$image = get_field('embroidery_img7');
								if( !empty($image) ): ?>
									<img class="lazy" data-original="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="b-articles-row__text">
								<b><?php echo get_field('embroidery_title7'); ?></b>
								<p><?php echo get_field('embroidery_text7'); ?></p>
								<div class="b-articles-row__link__wrapper">
									<a class="b-articles-row__link" href="<?php echo get_field('embroidery_url'); ?>"><?php echo get_field('embroidery_link'); ?> <i class="icon-arrow-right__long"></i></a>
								</div>
							</div>
						</div>					
					</div>
				</div>
			</div>
		</section>												
	</div>
	
	<div class="b-video section animate-top" id="video">
		<div class="container">
			<div class="row">
				<div class="col-xl">
					<div class="b-video-container">
						<?php echo get_field('v_1'); ?>
					</div>
				</div>
			</div>
		</div>		
	</div>

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

<div class="container">
	<!--seo_text_start--><!--seo_text_end-->
</div>
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