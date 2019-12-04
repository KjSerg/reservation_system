<?php

/* Template Name: Schlüsselseitenvorlage */

get_header('single');

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('mail', $set);

$currency = get_field('currency');

$list = get_field('list');

?>

<main
    class="content dark_content">
    <section class="section-text simple_section dark_bg">
        <div class="screen_content">
            <div class="main_title_wrapper">
                <div class="main_title"><?php the_title(); ?></div>
            </div>

            <?php if ($list): ?>

                <div class="key_blocks">

                    <?php foreach ($list as $item):

                        $img = get_the_post_thumbnail($item) ? get_the_post_thumbnail($item, 'thumbnail') : '<img src="' . $assets . 'img/key.png" alt=""/>'; ?>

                        <a href="<?php the_permalink($item); ?>" class="key_block">

                            <div class="key_block__img">
                               <?php echo $img; ?>
                            </div>
                            <div class="key_block__content">
                                <div class="key_block__head">
                                    <div class="key_block__title">
                                        <?php echo get_the_title($item); ?>
                                    </div>
                                    <div class="key_block__price">
                                        <?php if( get_field('price', $item)): ?>
                                            <strong>
                                                <?php the_field('price', $item); ?>
                                            </strong>
                                            <?php the_field('currency', $item); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="key_block__text">
                                    <?php echo apply_filters('the_content', get_post_field('post_content', $item));; ?>
                                </div>
                            </div>
                        </a>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

            <div class="simple_text larger">
                <?php the_post();the_content(); ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer('inner'); ?>
