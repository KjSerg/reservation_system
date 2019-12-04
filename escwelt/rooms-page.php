<?php
/* Template Name: Seitenvorlage UNSERE ZIMMER. */

get_header('rooms');

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('mail', $set);
?>

    <main class="content">

        <?php if (have_rows('screens')): $scr_numb = 1; ?>

            <div class="fullpage_wrapper" id="fullpage">

                <?php while (have_rows('screens')) : the_row(); ?>

                    <?php if (get_row_layout() == 'screen_1'): ?>

                        <?php if (!get_sub_field('screen_off')) : ?>

                            <section class="section-rooms section dark_bg" data-anchor="rooms" id="rooms" style="background: url(<?php e('screen_bg'); ?>) center/cover no-repeat;">
                                <div class="screen_content">
                                    <div class="main_title_wrapper">
                                        <h1 class="main_title">
                                            <?php e('title'); ?>
                                        </h1>
                                    </div>
                                    <h2 class="section_title_descr">
                                        <?php e('subtitle'); ?>
                                    </h2>
                                    <?php $list = g('list');
                                    if ($list): ?>
                                        <div class="rooms_blocks">

                                            <?php foreach ($list as $item):
                                                $img = get_the_post_thumbnail_url($item) ? get_the_post_thumbnail_url($item) : $assets . 'img/rb2.jpg';
                                                ?>

                                                <div class="rooms_block">
                                                    <div class="rooms_block__frame"
                                                         style="background: url(<?php echo $img; ?>) center/cover;">
                                                        <div class="rooms_block__frame_curtain"
                                                             style="background: url(<?php echo $assets; ?>img/room_curtain.png) center/contain;"></div>
                                                        <a class="small main_btn bordered" href="<?php the_permalink($item); ?>"><span
                                                                class="main_btn_inner">Jetzt buchen</span></a></div>
                                                    <a class="rooms_block__title" href="<?php the_permalink($item); ?>">
                                                        <?php echo get_the_title($item); ?>
                                                    </a>
                                                </div>

                                            <?php endforeach; ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </section>

                        <?php endif; ?>
                    <?php elseif ( get_row_layout() == 'screen_2' ): ?>
                        <?php if (!get_sub_field('screen_off')) : ?>

                            <section class="section-challenge section">
                                <div class="screen_content">
                                    <div class="main_title_wrapper">
                                        <h4 class="main_subtitle"><?php e('subtitle'); ?></h4>
                                        <h3 class="main_title"><?php e('title'); ?></h3>
                                    </div>
                                    <div class="challenge_sides">
                                        <div class="challenge_side challenge_side_left">

                                            <?php if (have_rows('list')): ?>

                                                <div class="challenge_blocks">

                                                    <?php while (have_rows('list')) : the_row(); ?>

                                                        <div class="challenge_block">
                                                            <div class="challenge_block_ico">
                                                                <img class="svg"
                                                                     src="<?php e('icon'); ?>"
                                                                     alt="img"/></div>
                                                            <div class="challenge_block_text">
                                                                <?php e('text'); ?>
                                                            </div>
                                                        </div>

                                                    <?php endwhile; ?>

                                                </div>

                                            <?php endif; ?>

                                        </div>
                                        <div class="challenge_side challenge_side_right">
                                            <a class="challange_video fancybox" href="<?php e('video-link'); ?>" style="background: url(<?php e('img'); ?>) center/cover no-repeat;">
                                                <div class="side_el side_el__left"></div>
                                                <div class="side_el side_el__right"></div>
                                                <div class="play_circle"><img class="svg" src="<?php echo $assets; ?>img/play.svg" alt="play" /></div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        <?php endif; ?>
                    <?php elseif ( get_row_layout() == 'screen_3' ): ?>
                        <?php if (!get_sub_field('screen_off')) : ?>

                            <section class="section-for-who section dark_bg" id="for_who" style="background: url(<?php e('screen_bg'); ?>) center/cover no-repeat;">
                                <div class="screen_content">
                                    <div class="main_title_wrapper">
                                        <h4 class="main_subtitle">
                                            <?php e('subtitle'); ?>
                                        </h4>
                                        <h3 class="main_title">
                                            <?php e('title'); ?>
                                        </h3>
                                    </div>

                                    <?php if (have_rows('list')): ?>

                                        <div class="for_who_blocks">

                                            <?php while (have_rows('list')) : the_row(); ?>

                                                <div class="for_who_block">
                                                    <div class="for_who_block__img">
                                                        <img class="svg" src="<?php e('icon'); ?>" alt="img"/>
                                                    </div>
                                                    <div class="for_who_block__content">
                                                        <div class="for_who_block__title smaller">
                                                            <?php e('text'); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endwhile; ?>

                                        </div>

                                    <?php endif; ?>

                                    <?php $button = g('button');
                                    if ($button):
                                        ?>
                                        <div class="main_btn_wrapper centered">
                                            <a class="main_btn scroll_btn scroll-btn-js" href="<?php echo $button['url']; ?>">
                                                <span
                                                    class="main_btn_inner">
                                                    <?php echo $button['title']; ?>
                                                </span>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </section>

                        <?php endif; ?>

                    <?php endif; ?>

                <?php $scr_numb++; endwhile; ?>

                <?php get_template_part('my-footer'); ?>

            </div>

        <?php endif; ?>

    </main>

<?php get_footer(); ?>