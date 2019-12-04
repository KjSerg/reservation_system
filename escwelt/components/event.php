
<?php

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];

$img = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : $assets . 'img/article.jpg';

?>

<div class="article">
    <div class="article__img" style="background: url(<?php echo $img; ?>) center/cover no-repeat;"></div>
    <div class="article__main">
        <div class="article__heading">
            <h3 class="article__title"><?php the_title(); ?></h3>
        </div>
        <div class="article__content">
            <div class="article__txt">
                <?php the_excerpt(); ?>
            </div>
            <div class="article__btn">
                <a class="main_btn" href="<?php the_permalink(); ?>">
                    <span class="main_btn_inner">
                        READ MORE
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>