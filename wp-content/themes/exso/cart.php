<?php
/*
Template Name: Корзина
*/
get_header('shop');?>
<?php $lang = pll_current_language(); ?>
<div id="orderIssue" class="active">
    <div id="cart-popup">
    <div class="all-cart">
    <?php the_content();?>
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
 

<?php get_footer();?>