<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bfbtuning
 */

get_header('shop');
?>

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
                        <div class="shop-lang">
                            <ul><?php pll_the_languages(); ?></ul>
                        </div>
                    </div>
        <?php woocommerce_breadcrumb(); ?>
    
<div class="wrap-container single-post">
<div class="row">
    <div class="col-12">
        <h1><?php the_title();?></h1>
 <!--seo_text_start-->
 <?php the_content(); ?>
 <!--seo_text_end-->
</div>
<div class="col-12">
    <div class="social-block__links">
        <div class="title">Поделиться:</div>
        <div class="social-block__links-item">
            <a href=""><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle cx="15" cy="15" r="14.5" stroke="#F9B233"/>
<path d="M7.01303 15.2806L10.4616 16.5665L11.8059 20.8918C11.8644 21.184 12.2151 21.2425 12.4489 21.0671L14.3778 19.489C14.5531 19.3136 14.8454 19.3136 15.0792 19.489L18.5277 22.0023C18.7615 22.1777 19.1122 22.0608 19.1707 21.7685L21.7425 9.49399C21.8009 9.20174 21.5087 8.90949 21.2164 9.02639L7.01303 14.5207C6.66232 14.6376 6.66232 15.1637 7.01303 15.2806ZM11.6306 15.9235L18.4108 11.7735C18.5277 11.7151 18.6446 11.8905 18.5277 11.9489L12.975 17.151C12.7996 17.3263 12.6242 17.5601 12.6242 17.8524L12.4489 19.2552C12.4489 19.4305 12.1566 19.489 12.0982 19.2552L11.3968 16.6834C11.2214 16.3911 11.3384 16.0404 11.6306 15.9235Z" fill="#F9B233"/>
</svg></a>
        </div>
                <div class="social-block__links-item">
            <a href="http://twitter.com/share?text=<?php the_title();?>&amp;url=<?php the_permalink();?>" title="Поделиться ссылкой в Твиттере" onclick="window.open(this.href, this.title, 'toolbar=0, status=0, width=548, height=325'); return false" target="_parent"><svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle cx="15.5" cy="15" r="14.5" stroke="#F9B233"/>
<path d="M23.45 11.175C22.925 11.4 22.325 11.55 21.725 11.625C22.325 11.25 22.85 10.65 23.075 9.975C22.475 10.35 21.875 10.575 21.125 10.725C20.6 10.125 19.775 9.75 18.95 9.75C17.3 9.75 15.95 11.1 15.95 12.75C15.95 12.975 15.95 13.2 16.025 13.425C13.55 13.275 11.3 12.075 9.8 10.275C9.575 10.725 9.425 11.25 9.425 11.775C9.425 12.825 9.95 13.725 10.775 14.25C10.25 14.25 9.8 14.1 9.425 13.875C9.425 15.3 10.475 16.575 11.825 16.8C11.6 16.875 11.3 16.875 11 16.875C10.775 16.875 10.625 16.875 10.4 16.8C10.775 18 11.9 18.9 13.25 18.9C12.2 19.725 10.925 20.175 9.5 20.175C9.275 20.175 9.05 20.175 8.75 20.1C10.1 20.925 11.675 21.45 13.4 21.45C18.95 21.45 21.95 16.875 21.95 12.9V12.525C22.55 12.3 23.075 11.775 23.45 11.175Z" fill="#F9B233"/>
</svg></a>
        </div>
                <div class="social-block__links-item">
            <a href="https://www.facebook.com/dialog/share?&amp;app_id=527957123932456&amp;href=<?php the_permalink();?>" onclick="window.open(this.href, this.title, 'toolbar=0, status=0, width=548, height=325'); return false" title="Поделиться ссылкой на Фейсбук" target="_parent"><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle cx="15" cy="15" r="14.5" stroke="#F9B233"/>
<path d="M21.75 10.364C21.75 9.24093 20.7591 8.25 19.636 8.25H11.114C9.99093 8.25 9 9.24093 9 10.364V18.886C9 20.0091 9.99093 21 11.114 21H15.408V16.1775H13.8225V14.0635H15.408V13.2047C15.408 11.7513 16.465 10.4961 17.7863 10.4961H19.5039V12.6101H17.7863C17.5881 12.6101 17.3899 12.8083 17.3899 13.2047V14.0635H19.5039V16.1775H17.3899V21H19.636C20.7591 21 21.75 20.0091 21.75 18.886V10.364Z" fill="#F9B233"/>
</svg>
</a>
        </div>
                <div class="social-block__links-item">
            <a href=""><svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle cx="15.5" cy="15" r="14.5" stroke="#F9B233"/>
<path d="M20.4356 9H11.3144C10.2846 9 9.5 9.78462 9.5 10.8144V19.9356C9.5 20.9654 10.2846 21.75 11.3144 21.75H20.4356C21.4654 21.75 22.25 20.9654 22.25 19.9356V10.8144C22.25 9.78462 21.4654 9 20.4356 9ZM15.875 19.2C17.9837 19.2 19.7 17.5327 19.7 15.5221C19.7 15.1788 19.651 14.7865 19.5529 14.4923H20.6317V19.6904C20.6317 19.9356 20.4356 20.1808 20.1413 20.1808H11.6087C11.3635 20.1808 11.1183 19.9846 11.1183 19.6904V14.4433H12.2462C12.1481 14.7865 12.099 15.1298 12.099 15.4731C12.05 17.5327 13.7663 19.2 15.875 19.2ZM15.875 17.7288C14.5019 17.7288 13.4231 16.65 13.4231 15.326C13.4231 14.0019 14.5019 12.9231 15.875 12.9231C17.2481 12.9231 18.3269 14.0019 18.3269 15.326C18.3269 16.699 17.2481 17.7288 15.875 17.7288ZM20.5827 12.4817C20.5827 12.776 20.3375 13.0212 20.0433 13.0212H18.6702C18.376 13.0212 18.1308 12.776 18.1308 12.4817V11.1577C18.1308 10.8635 18.376 10.6183 18.6702 10.6183H20.0433C20.3375 10.6183 20.5827 10.8635 20.5827 11.1577V12.4817Z" fill="#F9B233"/>
</svg>
</a>
        </div>
    </div>
</div>
</div>
</div>
<?php if(get_field('rel')): ?>
<div class="wrap-container related-post">
    <?php 
    global $post;
    $rel = get_field('rel');
    $args = array( 
    'post_type' => 'post',
    'numberposts' => 4,
    'include'     => $rel
    );
     ?>
     <div class="row">
          <div class="col-12">
                <div class="related-nav">
                <div class="title">Похожие статьи</div>
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
    <div class="row related-post-sl">

        <?php $slider_posts = get_posts( $args ); foreach ( $slider_posts as $post ) : setup_postdata( $post ); ?>
        <div class="col-12 col-md-6 col-lg-3">
    <div class="blog-wrap__item">
        <div class="blog-wrap__item-img">
            <?php the_post_thumbnail('blog', array(
            'alt'   => trim(strip_tags( $post->post_title )),
            'title' => trim(strip_tags( $post->post_title )),
        )); ?>
        </div>
        <div class="blog-wrap__item-content">
            <div class="title">
                <?php the_title();?>
            </div>
            <div class="text">
                <?php echo kama_excerpt( array('maxchar'=>160) );?>
            </div>
            <div class="link">
                <a href="<?php the_permalink();?>">Подробнее <svg width="15" height="8" viewBox="0 0 15 8" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14.3536 4.35355C14.5488 4.15829 14.5488 3.84171 14.3536 3.64645L11.1716 0.464466C10.9763 0.269204 10.6597 0.269204 10.4645 0.464466C10.2692 0.659728 10.2692 0.976311 10.4645 1.17157L13.2929 4L10.4645 6.82843C10.2692 7.02369 10.2692 7.34027 10.4645 7.53553C10.6597 7.7308 10.9763 7.7308 11.1716 7.53553L14.3536 4.35355ZM0 4.5H14V3.5H0V4.5Z" fill="#F9B233"/>
</svg></a>
            </div>
        </div>
    </div>
</div>
    <?php endforeach; wp_reset_postdata(); ?>
    </div>
</div>
<?php endif;?>
<?php

get_footer('shop');
