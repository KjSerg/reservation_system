<?php
/* Template Name: Über uns Seitenvorlage. */

get_header('about');

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

                        <section class="section-for-who section dark_bg" id="for_who" style="background: url(<?php e('screen_bg'); ?>) center/cover no-repeat;">
                            <div class="screen_content">
                                <div class="main_title_wrapper">
                                    <div class="main_subtitle"><?php e('subtitle'); ?></div>
                                    <div class="main_title"><?php e('title'); ?></div>
                                </div>

                                <?php if (have_rows('list')): ?>

                                    <div class="for_who_blocks">

                                        <?php while (have_rows('list')) : the_row(); ?>

                                            <div class="for_who_block">

                                                <div class="for_who_block__img">
                                                    <img class="svg" src="<?php e('icon'); ?>" alt="img"/>
                                                </div>

                                                <div class="for_who_block__content">
                                                    <div class="for_who_block__title">
                                                        <?php e('title'); ?>
                                                    </div>
                                                    <div class="for_who_block__text">
                                                        <?php e('text'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php endwhile; ?>

                                    </div>

                                <?php endif; ?>

                            </div>
                        </section>

                    <?php endif; ?>
                <?php elseif ( get_row_layout() == 'screen_2' ): ?>
                    <?php if (!get_sub_field('screen_off')) : ?>

                        <section class="section-how-it-works section">
                            <div class="screen_content">
                                <div class="main_title_wrapper">
                                    <div class="main_subtitle"><?php e('subtitle'); ?></div>
                                    <div class="main_title"><?php e('title'); ?></div>
                                </div>
                                <div class="hiw_wrapper">
                                    <div class="hiv_block" style="background: url(<?php e('img'); ?>) center/cover no-repeat;">
                                        <div class="side_el side_el__left"></div>
                                        <div class="side_el side_el__right"></div><a class="main_btn bordered fancybox" href="<?php e('video-link'); ?>">
                                            <span class="main_btn_inner">JETZT BUCHEN</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </section>

                    <?php endif; ?>
                <?php elseif ( get_row_layout() == 'screen_3' ): ?>
                    <?php if (!get_sub_field('screen_off')) : ?>

                        <section class="section-room-description section dark_bg" style="background: url(<?php e('screen_bg'); ?>) center/cover no-repeat;">
                            <div class="screen_content">
                                <div class="main_title_wrapper lefted">
                                    <div class="main_title"><?php e('title'); ?></div>
                                </div>
                                <div class="room_description_sides">
                                    <div class="room_description_side room_description_side_left">
                                        <div class="rd_description scroll_block">
                                            <div class="simple_text">
                                                <?php e('text'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="room_description_side room_description_side_right" style="background: url(<?php echo g('img')['url']; ?>) center/cover no-repeat;"></div>
                                </div>
                            </div>
                        </section>

                    <?php endif; ?>
                <?php elseif ( get_row_layout() == 'screen_4' ): ?>
                    <?php if (!get_sub_field('screen_off')) : ?>

                        <section class="section-team section">
                            <div class="screen_content">
                                <div class="main_title_wrapper">
                                    <div class="main_title"><?php e('title'); ?></div>
                                </div>
                                <div class="team_wrapper">
                                    <div class="team_title"><?php e('subtitle'); ?></div>

                                    <?php
                                    $list = g('list');
                                    if($list):
                                        ?>

                                        <div class="team_blocks">

                                            <?php foreach ($list as $item):
                                                $img = get_the_post_thumbnail($item);
                                                ?>

                                                <div class="team_block">
                                                    <div class="team_block__photo">
                                                        <?php if($img) echo $img; ?>
                                                    </div>
                                                    <div class="team_block__content">
                                                        <div class="team_block__title"><?php $title = get_the_title($item);

                                                        if($title){

                                                            $arr = explode(' ', $title);

                                                            echo $arr[0] . ' <br/>' . $arr[1];

                                                        }

                                                        ?></div>
                                                        <div class="team_block__description">
                                                            <?php the_field('position', $item); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endforeach; ?>

                                        </div>

                                    <?php endif; ?>

                                </div>
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