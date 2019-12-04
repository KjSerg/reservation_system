<?php
/* Template Name: Feedback-Seitenvorlage. */

get_header('contacts');

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('mail', $set);
$admin_ajax = $var['admin_ajax'];

$list = get_field('list');

$number = (int)get_field('number');

$allPosts = count($list);

$counter = 0;

$page_id = get_the_ID();
?>

    <script>
        var admin_ajax = '<?php echo $admin_ajax; ?>';
    </script>

    <main
        class="content">
        <section class="section-testimonials testimonials_page_section simple_section">
            <div class="screen_content">
                <ul class="breadcrumbs_list">
                    <li><a href="<?php the_permalink($set); ?>"><?php echo get_the_title($set); ?></a></li>
                    <li><span><?php echo get_the_title(); ?></span></li>
                </ul>
                <div class="main_title_wrapper">
                    <h1 class="main_title"><?php echo get_the_title();    ?></h1>
                </div>

                <?php if($list): ?>

                    <div class="testimonial_blocks">

                        <?php foreach ($list as $item):

                            if($counter >= $number) break;

                            $img = get_the_post_thumbnail_url($item) ? get_the_post_thumbnail_url($item) : $assets . 'img/side_img3.png';
                            ?>

                            <div class="testimonial_block">
                                <div class="testimonials_slide">
                                    <div class="testimonials_img">

                                        <img src="<?php echo $img; ?>" alt="<?php echo get_the_title($item); ?>"/>

                                    </div>
                                    <div class="testimonials_content">
                                        <h3 class="testimonials_title">
                                            <?php the_field('title', $item); ?>
                                        </h3>
                                        <div class="testimonials_text">
                                            <?php echo apply_filters('the_content', get_post_field('post_content', $item)); ?>
                                        </div>
                                        <div class="testimonials_sign">
                                            <?php echo get_the_title($item); ?>
                                            <br/>
                                            <span><?php echo get_the_date(__('d.m.Y H:i'), $item); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php $counter++; ?>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

                <div class="testimonial_more_btn main_btn_wrapper righted">


                    <a <?php if($allPosts <= $number) echo 'style="display:none;"'  ?>
                            class="main_btn small bordered load-review-js"
                            data-active-length="<?php echo $counter; ?>"
                            data-length="<?php echo $number; ?>"
                            data-all-posts="<?php echo $allPosts; ?>"
                            data-page-id="<?php echo $page_id; ?>"
                            href="#">
                        <span class="main_btn_inner"><?php the_field('button_text'); ?></span>
                    </a>
                </div>


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
                                       <?php the_post_thumbnail(); ?>
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