<?php
/*
Template Name: Шаблон страницы продукция
Template Post Type: page
*/
?>

<? get_header('shop');?>

	<div class="b-side">
		<a href="<?php echo get_home_url(); ?>" class="b-logo"></a>
		<div class="b-side-nav">
			<ul>
				<li><a href="#category-section"></a></li>
				<li><a href="#video"></a></li>
				<li><a href="#contacts"></a></li>
			</ul>
		</div>
		<div class="b-social">
			<ul>
				<? if(get_option('Facebook')){?><li><a target="_blank" class="icon-facebook" href="<? echo get_option('Facebook'); ?>"></a></li><?}?>
				<? if(get_option('Instagram')){?><li><a target="_blank" class="icon-instagram" href="<? echo get_option('Instagram'); ?>"></a></li><?}?>
			</ul>
		</div>
	</div>
	
	<div class="b-products-page" id="category-section">
		<div class="b-products-circle__container b-products-circle__container1"><div class="b-products-circle"></div></div>
		<div class="b-products-circle__container__border b-products-circle__container__border1"><div class="b-products-circle__border"></div></div>
		<div class="b-products-circle__container b-products-circle__container2"><div class="b-products-circle"></div></div>
		<div class="b-products-circle__container__border b-products-circle__container__border2"><div class="b-products-circle__border"></div></div>
		<div class="b-category-block" id="category-block">
			<div class="b-category-block__image"><?php echo get_the_post_thumbnail( $id, 'full' );  ?></div>
			<div class="b-category-block__content">
				<div class="container">
					<div class="row">
						<div class="col-xl">
							<div class="b-category-block__content__text">
								<h1><?php the_title(); ?></h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="b-products-container">
			<div class="container">
				<div class="row">
					<div class="col-xl">
						<div class="b-products-nav animate-top">
							<ul class="nav">
								<li><a class="active" data-toggle="tab" href="#tp1"><?php echo get_cat_name(pll_get_term(75)); ?></a></li>
								<li><a data-toggle="tab" href="#tp2"><?php echo get_cat_name(pll_get_term(77)); ?></a></li>
								<li><a data-toggle="tab" href="#tp3"><?php echo get_cat_name(pll_get_term(79)); ?></a></li>
							</ul>
						</div>
						<div class="b-products-content animate-top">
							<div class="tab-content">
								<div class="tab-pane active" id="tp1">
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
													'terms'    => array(75)
												],

											]
					                    )
					                );
					                if ( $the_query->have_posts() ) :
					                    while ($the_query->have_posts()) :
					                        $the_query->the_post();
					                        ?>

										<div class="b-products-item">
											<div class="b-products-item__img">
												<?php 
												$image = get_field('product-img');
												if( !empty($image) ): ?>
													<img class="lazy" data-original="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
												<?php endif; ?>
											</div>
											<div class="b-products-item__content">
												<div class="b-products-item__color">
													<ul>
													<?php 
													$images = get_field('product-color');
													if( $images ): ?>
													    <?php foreach( $images as $image ): ?>
												            <li>
												                <img class="lazy" data-original="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
												            </li>
													    <?php endforeach; ?>
													<?php endif; ?>											
													</ul>
												</div>
												<div class="b-products-item__content__info">
													<b><?php the_title(); ?></b>
													<?php the_content(); ?>
													<div class="b-products-item__content__info__table">
														<?php echo get_field('product-table'); ?>
													</div>
												</div>
											</div>
										</div>

				                    <?php endwhile; ?>
						                <?php endif; ?>
						             <?php wp_reset_query(); ?>										
								</div>
								<div class="tab-pane" id="tp2">
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
													'terms'    => array(77)
												],

											]
					                    )
					                );
					                if ( $the_query->have_posts() ) :
					                    while ($the_query->have_posts()) :
					                        $the_query->the_post();
					                        ?>

										<div class="b-products-item">
											<div class="b-products-item__img">
												<?php 
												$image = get_field('product-img');
												if( !empty($image) ): ?>
													<img class="lazy" data-original="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
												<?php endif; ?>
											</div>
											<div class="b-products-item__content">
												<div class="b-products-item__color">
													<ul>
													<?php 
													$images = get_field('product-color');
													if( $images ): ?>
													    <?php foreach( $images as $image ): ?>
												            <li>
												                <img class="lazy" data-original="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
												            </li>
													    <?php endforeach; ?>
													<?php endif; ?>											
													</ul>
												</div>
												<div class="b-products-item__content__info">
													<b><?php the_title(); ?></b>
													<?php the_content(); ?>
													<div class="b-products-item__content__info__table">
														<?php echo get_field('product-table'); ?>
													</div>
												</div>
											</div>
										</div>

				                    <?php endwhile; ?>
						                <?php endif; ?>
						             <?php wp_reset_query(); ?>										
								</div>
								<div class="tab-pane" id="tp3">
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
													'terms'    => array(79)
												],

											]
					                    )
					                );
					                if ( $the_query->have_posts() ) :
					                    while ($the_query->have_posts()) :
					                        $the_query->the_post();
					                        ?>

										<div class="b-products-item">
											<div class="b-products-item__img">
												<?php 
												$image = get_field('product-img');
												if( !empty($image) ): ?>
													<img class="lazy" data-original="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
												<?php endif; ?>
											</div>
											<div class="b-products-item__content">
												<div class="b-products-item__color">
													<ul>
													<?php 
													$images = get_field('product-color');
													if( $images ): ?>
													    <?php foreach( $images as $image ): ?>
												            <li>
												                <img class="lazy" data-original="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
												            </li>
													    <?php endforeach; ?>
													<?php endif; ?>											
													</ul>
												</div>
												<div class="b-products-item__content__info">
													<b><?php the_title(); ?></b>
													<?php the_content(); ?>
													<div class="b-products-item__content__info__table">
														<?php echo get_field('product-table'); ?>
													</div>
												</div>
											</div>
										</div>

				                    <?php endwhile; ?>
						                <?php endif; ?>
						             <?php wp_reset_query(); ?>										
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>


	
 



	
	
	
	<div class="b-video section animate-top" id="video">
		<div class="container">
			<div class="row">
				<div class="col-xl">
					<div class="b-video-container">
						<?php echo get_field('vv-4'); ?>
					</div>
				</div>
			</div>
		</div>		
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