<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bfbtuning
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area">
    <div class="cat-block">
        <div class="cat-block__title">
            <a href="#"><?php pll_e('cat-1'); ?> <span></span></a>
        </div>
        <?php wp_nav_menu(array('theme_location' => 'woo-menu', 'container' => 'div' , 'container_class' => 'categories')); ?>
    </div>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
