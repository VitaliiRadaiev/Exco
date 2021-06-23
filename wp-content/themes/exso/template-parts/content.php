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