<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package uprys
 */

get_header();
?>

    <div class="b-side">
        <a href="<?php echo get_home_url(); ?>" class="b-logo"></a>
 
        <div class="b-social">
            <ul>
                <? if(get_option('Facebook')){?><li><a target="_blank" class="icon-facebook" href="<? echo get_option('Facebook'); ?>"></a></li><?}?>
                <? if(get_option('Instagram')){?><li><a target="_blank" class="icon-instagram" href="<? echo get_option('Instagram'); ?>"></a></li><?}?>
            </ul>
        </div>
    </div>
    <?php
    if ($_SERVER['REQUEST_URI']=='/konstruktor/') {
        echo '<div class="container"><h1 style="color:#3C3C3B"></h1></div>';
    }
     ?>
    <main id="primary" class="page-main">
        <div class="product-container">
        <?php
        while ( have_posts() ) :
            the_post();

            get_template_part( 'template-parts/content', 'page' );

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>
</div>
    </main><!-- #main -->

<?php

    if ($_SERVER['REQUEST_URI']=='/konstruktor/') {
        echo '<div class="container"><!--seo_text_start--><!--seo_text_end--></div>';
    }
get_footer();
