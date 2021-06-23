<?php
/*
Template Name: Шаблон страницы портфолио
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
				<li><a href="#portfolio"></a></li>
				<li><a href="#contacts"></a></li>
			</ul>
					</div>
						<div class="shop-lang">
							<ul><?php pll_the_languages(); ?></ul>
						</div>
					</div>


	<div class="b-portfolio" id="portfolio">
		<div class="container">
			<div class="row">
				<div class="col-xl">
					<div class="b-title">
						<h2><?php the_title(); ?></h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl">
					<div class="b-portfolio-container">
						<div class="b-products-nav animate-top">
							<ul class="nav">
								<li><a class="active" data-toggle="tab" href="#c1"><?php echo get_cat_name(pll_get_term(18)); ?></a></li>
								<li><a data-toggle="tab" href="#c2"><?php echo get_cat_name(pll_get_term(1)); ?></a></li>
								<li><a data-toggle="tab" href="#c3"><?php echo get_cat_name(pll_get_term(14)); ?></a></li>
								<li><a data-toggle="tab" href="#c4"><?php echo get_cat_name(pll_get_term(16)); ?></a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="c1">
								<div class="b-portfolio-content animate-top">
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
												'terms'    => array(18)
											],

										]
				                    )
				                );
				                if ( $the_query->have_posts() ) :
				                    while ($the_query->have_posts()) :
				                        $the_query->the_post();
				                        ?>
										<div class="b-works-col">
											<div class="b-works-item">
												<a data-fancybox="images" href="<?php
													$thumb_id = get_post_thumbnail_id();
													$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
													echo $thumb_url[0];
													?>" class="b-works-item__img">
													<span class="b-works-ico"></span>
													<?php echo get_the_post_thumbnail( $id, 'full' );  ?>
												</a>
												<div class="b-works-item__text">
													<b><?php the_title(); ?></b>
													<?php the_content(); ?>
												</div>										
											</div>
										</div>
				                    <?php endwhile; ?>
				                <?php endif; ?>
				                <?php wp_reset_query(); ?>	

								</div>
							</div>
							<div class="tab-pane" id="c2">
								<div class="b-portfolio-content">
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
												'terms'    => array(1)
											],

										]
				                    )
				                );
				                if ( $the_query->have_posts() ) :
				                    while ($the_query->have_posts()) :
				                        $the_query->the_post();
				                        ?>
										<div class="b-works-col">
											<div class="b-works-item">
												<a data-fancybox="images" href="<?php
													$thumb_id = get_post_thumbnail_id();
													$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
													echo $thumb_url[0];
													?>" class="b-works-item__img">
													<span class="b-works-ico"></span>
													<?php echo get_the_post_thumbnail( $id, 'full' );  ?>
												</a>
												<div class="b-works-item__text">
													<b><?php the_title(); ?></b>
													<?php the_content(); ?>
												</div>										
											</div>
										</div>
				                    <?php endwhile; ?>
				                <?php endif; ?>
				                <?php wp_reset_query(); ?>	

								</div>
							</div>
							<div class="tab-pane" id="c3">
								<div class="b-portfolio-content">
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
												'terms'    => array(14)
											],

										]
				                    )
				                );
				                if ( $the_query->have_posts() ) :
				                    while ($the_query->have_posts()) :
				                        $the_query->the_post();
				                        ?>
										<div class="b-works-col">
											<div class="b-works-item">
												<a data-fancybox="images" href="<?php
													$thumb_id = get_post_thumbnail_id();
													$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
													echo $thumb_url[0];
													?>" class="b-works-item__img">
													<span class="b-works-ico"></span>
													<?php echo get_the_post_thumbnail( $id, 'full' );  ?>
												</a>
												<div class="b-works-item__text">
													<b><?php the_title(); ?></b>
													<?php the_content(); ?>
												</div>										
											</div>
										</div>
				                    <?php endwhile; ?>
				                <?php endif; ?>
				                <?php wp_reset_query(); ?>	

								</div>
							</div>
							<div class="tab-pane" id="c4">
								<div class="b-portfolio-content">
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
												'terms'    => array(16)
											],

										]
				                    )
				                );
				                if ( $the_query->have_posts() ) :
				                    while ($the_query->have_posts()) :
				                        $the_query->the_post();
				                        ?>
										<div class="b-works-col">
											<div class="b-works-item">
												<a data-fancybox="images" href="<?php
													$thumb_id = get_post_thumbnail_id();
													$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
													echo $thumb_url[0];
													?>" class="b-works-item__img">
													<span class="b-works-ico"></span>
													<?php echo get_the_post_thumbnail( $id, 'full' );  ?>
												</a>
												<div class="b-works-item__text">
													<b><?php the_title(); ?></b>
													<?php the_content(); ?>
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