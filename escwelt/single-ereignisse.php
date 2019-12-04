<?php

get_header('event');

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$admin_ajax = $var['admin_ajax'];
$email = get_field('mail', $set);

$img = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : $assets . 'img/article.jpg';

//Get post type
$post_type_obj = get_post_type_object( get_post_type() );
//Get post type's label
$title = apply_filters('post_type_archive_title', $post_type_obj->labels->name );
$archive_title = apply_filters('post_type_archive_title', $post_type_obj->labels->all_items);

$image = get_field('img');
$image1 = get_field('img_1');

require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
?>




    <main class="content">
        <section class="section-head dark_bg inner_page_heading simple_section screen-dark-bg" id="head" style="background: url(<?php echo $image1; ?>) center/cover no-repeat;">
            <div class="screen_content">
                <ul class="breadcrumbs_list">
                    <li><a href="<?php the_permalink($set); ?>"><?php echo get_the_title($set); ?></a></li>
                    <li><a href="<?php echo get_post_type_archive_link('ereignisse'); ?>"><?php echo $archive_title; ?></a></li>
                    <li><span><?php echo get_the_title(); ?></span></li>
                </ul>
                <div class="heading_sides">
                    <div class="heading_side heading_side_left">
                        <div class="section_head_heading">
                            <div class="main_title_wrapper lefted">
                                <h1 class="main_title"><?php echo get_the_title(); ?></h1>
                            </div>
                            <h2 class="section_head_descr"><?php the_field('subtitle'); ?></h2>
                        </div>
                        <?php
                        $button = get_field('button');
                        if ($button):
                            ?>
                            <a class="main_btn" href="<?php echo $button['url']; ?>">
                                <span class="main_btn_inner"><?php echo $button['title']; ?></span>
                            </a>
                        <?php endif; ?>
                    </div>

                    <?php $list = get_field('list');
                    if ($list): ?>

                        <div class="heading_side heading_side_right">
                            <div class="heading_slider">

                                <?php foreach ($list as $item): $img = get_field('img_svg', $item); ?>

                                    <div class="heading_slide">
                                        <a class="heading_slide_link" href="<?php the_permalink($item); ?>">
                                            <div class="heading_slide_link_back">
                                                <img class="svg" src="<?php echo $assets; ?>img/splash.svg"
                                                                                      alt="img"/></div>
                                            <div class="heading_slide_ico">
                                                <?php if($img): ?>
                                                    <img class="svg"
                                                         src="<?php echo $img['url']; ?>"
                                                         alt="<?php echo get_the_title($item); ?>"/>
                                                <?php endif; ?>
                                            </div>
                                            <div class="heading_slide_txt">
                                                <?php echo get_the_title($item); ?>
                                            </div>
                                            <div class="heading_slide_dot"></div>
                                        </a>
                                    </div>

                                <?php endforeach; ?>

                            </div>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </section>
        <section class="section-event-description simple_screen">
            <div class="screen_content">
                <div class="main_title_wrapper">
                    <h3 class="main_title"><?php echo get_the_title(); ?></h3>
                </div>

                <div class="event-description-text simple_text">
                   <?php the_post();the_content(); ?>
                </div>

                <?php $gallery = get_field('gallery');
                if ($gallery):
                    ?>

                    <div class="pic_slider">
                        <?php foreach ($gallery as $item): ?>
                            <div>
                                <div class="pic_slide">
                                    <img class="o_fit" title="<?php echo $item['title']; ?>" src="<?php echo $item['url']; ?>" alt="<?php echo $item['alt']; ?>"/>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php endif; ?>



                <?php if (have_rows('feedback_form', $set)): ?>
                    <?php while (have_rows('feedback_form', $set)) : the_row(); ?>

                        <div class="contact_form">
                            <div class="contact_form_sides">
                                <div class="contact_form_side contact_form_side_left">
                                    <div class="contact_form_heading">
                                        <h5 class="contact_form_title"><?php e('title'); ?></h5>
                                        <h6 class="contact_form_subtitle">
                                            <?php e('subtitle'); ?>
                                        </h6>
                                    </div>
                                    <form novalidate class="form_send" id="new_review" enctype="multipart/form-data" action="<?php echo $admin_ajax; ?>" method="post">
                                        <input type="hidden" name="action" value="new_review"/>
                                        <input type="hidden" name="redirect" value="<?php e('url') ?>"/>
                                        <?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>

                                        <div class="form_element_wrapper">
                                            <div class="form_element half">
                                                <input class="form_input form_input_name"
                                                       type="text" name="name"
                                                       placeholder="<?php e('placeholder_1'); ?>" required=""/>
                                            </div>
                                            <div class="form_element half">
                                                <input class="form_input form_input_phone"
                                                       type="email"
                                                       name="email"
                                                       data-reg="^[A-z0-9._-]+@[A-z0-9.-]+\.[A-z]{2,4}$"
                                                       placeholder="<?php e('placeholder_2'); ?>"
                                                       required=""/>
                                            </div>
                                            <div class="form_element half">
                                                <input class="form_input form_input_phone"
                                                       type="text"
                                                       name="title"
                                                       placeholder="<?php e('placeholder_5'); ?>"
                                                       required=""/>
                                            </div>
                                            <label class="form_element form_element--file half">
                                                <span class="placeholder" data-placeholder="<?php e('placeholder_4'); ?>"><?php e('placeholder_4'); ?></span>
                                                <input class="form_input form_input_file"
                                                       type="file"
                                                       name="my_image_upload" id="my_image_upload"
                                                       required=""/>
                                            </label>
                                            <div class="form_element textarea_el">
                                                <textarea name="message"
                                                          placeholder="<?php e('placeholder_3'); ?>"></textarea>
                                            </div>

                                        </div>
                                        <div class="contact_form_bottom">
                                            <button class="submit_btn main_btn transition" type="submit"><span
                                                        class="main_btn_inner"><?php e('button_text'); ?></span>
                                            </button>

                                        </div>
                                    </form>
                                </div>
                                <div class="contact_form_side contact_form_side_right">
                                    <div class="contact_form_side_right_in">
                                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endwhile; ?>
                <?php endif; ?>

            </div>
        </section>
    </main>

<?php get_footer('inner'); ?>