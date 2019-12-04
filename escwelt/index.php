<?php
/* Template Name: Homepage-Vorlage */

get_header();

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];

$email = get_field('mail', $set);

?>

    <main class="content">

        <?php if (have_rows('screens', $set)): $scr_numb = 1; ?>

            <div class="fullpage_wrapper" id="fullpage">

                <?php while (have_rows('screens', $set)) : the_row(); ?>

                    <?php if (get_row_layout() == 'screen_1'): ?>

                        <?php if (!get_sub_field('screen_off')) : ?>

                            <section class="section-head section dark_bg" id="head"
                                     style="background: url(<?php e('screen_bg'); ?>) center/cover no-repeat;">
                                <div class="screen_content">
                                    <div class="heading_sides">
                                        <div class="heading_side heading_side_left">
                                            <div class="section_head_heading">
                                                <div class="main_title_wrapper lefted">
                                                    <h1 class="main_title">
                                                        <?php e('title'); ?>
                                                    </h1>
                                                </div>
                                                <h2 class="section_head_descr">
                                                    <?php e('subtitle'); ?>
                                                </h2>
                                            </div>
                                            <?php $button = g('button');
                                            if($button):
                                                ?>
                                                <a class="main_btn" href="<?php echo $button['url']; ?>">
                                                    <span class="main_btn_inner">
                                                        <?php echo $button['title']; ?>
                                                    </span>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="heading_side heading_side_right">
                                            <?php
                                            $list = g('list');
                                            if($list):
                                            ?>
                                                <div class="heading_slider">
                                                    <?php foreach ($list as $item):
                                                        $img = get_field('img_svg', $item); ?>
                                                        <div class="heading_slide">
                                                            <a class="heading_slide_link"
                                                               href="<?php the_permalink($item); ?>">
                                                                <div class="heading_slide_link_back">
                                                                    <img class="svg"
                                                                         src="<?php echo $assets; ?>img/splash.svg"
                                                                         alt="img"/>
                                                                </div>
                                                                <div class="heading_slide_ico">
                                                                    <?php if($img): ?>
                                                                        <img class="svg"
                                                                             src="<?php echo $img['url']; ?>"
                                                                             alt="<?php echo get_the_title($item); ?>"/>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <h4 class="heading_slide_txt">
                                                                    <?php echo get_the_title($item); ?>
                                                                </h4>
                                                                <div class="heading_slide_dot"></div>
                                                            </a>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        <?php endif; ?>
                    <?php elseif ( get_row_layout() == 'screen_2' ): ?>
                        <?php if (!get_sub_field('screen_off')) : ?>

                            <section class="section-room section">
                                <div class="screen_content">
                                    <div class="image_sides">
                                        <div class="image_side image_side__left">
                                            <div class="main_title_wrapper lefted">
                                                <h3 class="main_title"><?php e('title'); ?></h3>
                                            </div>
                                            <div class="image_side_text simple_text">
                                                <?php e('text'); ?>
                                            </div>
                                        </div>
                                        <?php

                                        $img1 = g('img');
                                        $img2 = g('img_1');

                                        ?>
                                        <div class="image_side image_side__right">
                                            <div class="image_side_frame">
                                                <div class="image_side_frame_in">
                                                    <img class="o_fit" src="<?php echo $img1['url']; ?>" alt="<?php echo $img1['alt']; ?>" />
                                                </div>
                                            </div>
                                            <div class="image_side_img">
                                                <img src="<?php echo $img2['url']; ?>" alt="<?php echo $img2['alt']; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        <?php endif; ?>
                    <?php elseif ( get_row_layout() == 'screen_3' ): ?>
                        <?php if (!get_sub_field('screen_off')) : ?>

                            <section class="section-rooms section dark_bg" id="rooms" style="background: url(<?php e('screen_bg'); ?>) center/cover no-repeat;">
                                <div class="screen_content">
                                    <div class="main_title_wrapper">
                                        <h4 class="main_subtitle"><?php e('subtitle'); ?></h4>
                                        <h3 class="main_title"><?php e('title'); ?></h3>
                                    </div>

                                    <?php
                                    $list = g('list');
                                    if ($list):
                                        ?>

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
                    <?php elseif ( get_row_layout() == 'screen_4' ): ?>
                        <?php if (!get_sub_field('screen_off')) : ?>

                            <section class="section-how-it-works section">
                                <div class="screen_content">
                                    <div class="main_title_wrapper">
                                        <div class="main_title">
                                            <?php e('title'); ?>
                                        </div>
                                    </div>
                                    <div class="hiw_wrapper">
                                        <div class="hiv_block" style="background: url(<?php e('img'); ?>) center/cover no-repeat;">
                                            <div class="side_el side_el__left"></div>
                                            <div class="side_el side_el__right"></div>
                                            <a class="main_btn bordered fancybox" href="<?php e('video_link'); ?>">
                                                <span class="main_btn_inner"><?php e('button_text'); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        <?php endif; ?>
                    <?php elseif ( get_row_layout() == 'screen_5' ): ?>
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
                                                        <img class="svg"
                                                             src="<?php e('icon'); ?>"
                                                             alt="<?php e('title'); ?>"/>
                                                    </div>
                                                    <div class="for_who_block__content">
                                                        <h5 class="for_who_block__title">
                                                            <?php e('title'); ?>
                                                        </h5>
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
                    <?php elseif ( get_row_layout() == 'screen_6' ): ?>
                        <?php if (!get_sub_field('screen_off')) : ?>

                            <section class="section-cta section">
                                <div class="screen_content">
                                    <div class="image_sides">
                                        <div class="image_side image_side__left">
                                            <div class="main_title_wrapper lefted">
                                                <h4 class="main_subtitle"><?php e('subtitle'); ?></h4>
                                                <h3 class="main_title"><?php e('title'); ?></h3>
                                            </div>
                                            <div class="image_side_text simple_text">
                                                <?php e('text'); ?>
                                            </div>
                                        </div>
                                        <div class="image_side image_side__right">
                                            <div class="image_side_frame">
                                                <div class="image_side_frame_in">
                                                    <div class="cta_inner">
                                                        <div class="cta_title"><?php e('title_1'); ?></div>
                                                        <div class="cta_phone"><?php e('text_1'); ?> <a href="tel:<?php e('phone'); ?>"><?php e('phone'); ?> </a><?php e('text_2'); ?> </div>
                                                        <?php
                                                        $button = g('button');
                                                        if($button):
                                                        ?>
                                                            <a class="main_btn" href="<?php echo $button['url']; ?>">
                                                                <span class="main_btn_inner">
                                                                    <?php echo $button['title']; ?>
                                                                </span>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="image_side_img">
                                                <img src="<?php echo g('img')['url']; ?>" alt="<?php echo g('img')['alt']; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        <?php endif; ?>
                    <?php elseif ( get_row_layout() == 'screen_7' ): ?>
                        <?php if (!get_sub_field('screen_off')) : ?>

                            <section class="section-testimonials section dark_bg" id="testimonials" style="background: url(<?php e('screen_bg'); ?>) center/cover no-repeat;">
                                <div class="screen_content">
                                    <div class="main_title_wrapper">
                                        <h4 class="main_subtitle"><?php e('subtitle'); ?></h4>
                                        <h3 class="main_title"><?php e('title'); ?></h3>
                                    </div>

                                    <?php if (g('list')): ?>

                                        <div class="testimonials_slider arrow_slider">

                                            <?php foreach (g('list') as $item) :  ?>

                                                <div>
                                                    <div class="testimonials_slide">
                                                        <?php $photo = get_the_post_thumbnail($item);
                                                        if ($photo):
                                                            ?>
                                                            <div class="testimonials_img" style="margin-right: 20px">
                                                                <?php echo $photo; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="testimonials_content">
                                                            <div class="testimonials_title">
                                                                <?php the_field('title', $item) ?>
                                                            </div>
                                                            <div class="testimonials_text">
                                                                <?php echo apply_filters('the_content', get_post_field('post_content', $item)); ?>
                                                            </div>
                                                            <div class="testimonials_sign">
                                                                <?php echo get_the_title($item); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endforeach; ?>

                                        </div>

                                    <?php endif; ?>

                                </div>
                            </section>

                        <?php endif; ?>
                    <?php elseif ( get_row_layout() == 'screen_8' ): ?>
                        <?php if (!get_sub_field('screen_off')) : ?>

                            <section class="section-faq section">
                                <div class="screen_content">
                                    <div class="main_title_wrapper">
                                        <div class="main_title"><?php e('title'); ?></div>
                                    </div>
                                    <div class="c_acc_blocks_wrapper">
                                        <?php if (have_rows('list')): $int = 1; ?>
                                            <div class="faq_blocks">

                                                <?php while (have_rows('list')) : the_row(); ?>

                                                    <div class="faq_block">
                                                        <a class="faq_block_link fancybox" href="#fbl<?php echo $int; ?>">
                                                            <div class="c_acc_link_text">
                                                                <?php e('question'); ?>
                                                            </div>
                                                            <div class="c_acc_arrow"></div>
                                                        </a>
                                                        <div class="faq_block_content" id="fbl<?php echo $int; ?>">
                                                            <?php e('answer'); ?>
                                                        </div>
                                                    </div>

                                                <?php $int++; endwhile; ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="main_btn_wrapper centered faq_router">
                                        <?php

                                        $button = g('button');

                                        if($button):

                                            ?>
                                            <a class="main_btn small" href="<?php echo $button['url']; ?>">
                                                <span class="main_btn_inner">
                                                    <?php echo $button['title']; ?>
                                                </span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="faq_sides centered">
                                        <div class="faq_side">
                                            <div class="faq_form_heading">
                                                <div class="faq_form_title"><?php e('title_1'); ?></div>
                                                <div class="faq_form_subtitle">
                                                    <?php e('text'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="faq_side">
                                            <form class="form_send" action="<?php echo $url_home; ?>mail.php" method="post">
                                                <input type="hidden" name="project_name" value="<?php bloginfo( 'name' ); ?>"/>
                                                <input type="hidden" name="admin_email" value="<?php echo $email; ?>"/>
                                                <input type="hidden" name="form_subject" value="<?php e('subject'); ?>"/>
                                                <div class="form_rss_frame">
                                                    <input
                                                            class="form_input form_input_name"
                                                            type="email"
                                                            name="E-mail"
                                                            placeholder="<?php e('placeholder'); ?>"
                                                            required=""/>
                                                    <button class="submit_btn rss_frame_button" type="submit">
                                                        <img
                                                                class="svg"
                                                                src="<?php echo $assets; ?>img/mail.svg"
                                                                alt="img"/>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <?php $img = g('img');
                                    if($img):
                                    ?>

                                    <div class="image_side_img">
                                        <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" />
                                    </div>

                                    <?php endif; ?>
                                </div>
                            </section>

                        <?php endif; ?>
                    <?php elseif ( get_row_layout() == 'screen_9' ): ?>
                        <?php if (!get_sub_field('screen_off')) : ?>

                            <section class="section-cta-description section dark_bg" id="cta_descr" style="background: url(<?php e('screen_bg'); ?>) center/cover no-repeat;">
                                <div class="screen_content">
                                    <div class="main_title_wrapper">
                                        <h4 class="main_subtitle"><?php e('subtitle'); ?></h4>
                                        <h3 class="main_title"><?php e('title'); ?></h3>
                                    </div>
                                    <div class="cta_content">
                                        <h5 class="cta_title"><?php e('text_1'); ?></h5>
                                        <h6 class="cta_text"><?php e('text_2'); ?></h6>
                                        <div class="main_btn_wrapper">
                                            <?php $button = g('button');
                                            if($button):
                                                ?>
                                                <a class="main_btn" href="<?php echo $button['url']; ?>">
                                                    <span class="main_btn_inner">
                                                        <?php echo $button['title']; ?>
                                                    </span>
                                                </a>
                                            <?php endif; ?>
                                        </div>
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