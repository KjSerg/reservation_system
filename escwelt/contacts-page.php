<?php
/* Template Name: Kontaktseite Vorlage. */

get_header('contacts');

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('mail', $set);
?>

    <main  class="content">
        <section class="section-contacts simple_section">

            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD41ju8fEBULLIEGvSODoqTUIGcX5nQxA4&amp;"></script>

            <div class="screen_content">


                <ul class="breadcrumbs_list">
                    <li><a href="<?php the_permalink($set); ?>"><?php echo get_the_title($set); ?></a></li>
                    <li><span><?php echo get_the_title(); ?></span></li>
                </ul>


                <div class="main_title_wrapper">
                    <h1 class="main_title">
                        <?php echo get_the_title(); ?>
                    </h1>
                </div>

                <div class="contacts_wrapper">
                    <div class="contacts_block">
                        <div class="contacts_heading">
                            <div class="contacts_col">
                                <div class="contacts_col_ico"><img class="svg" src="<?php echo $assets; ?>img/pin.svg" alt="img" /></div>
                                <div class="contacts_col_content"><?php the_field('address'); ?></div>
                            </div>
                            <?php if (have_rows('phones')): ?>
                                <div class="contacts_col">
                                    <div class="contacts_col_ico"><img class="svg" src="<?php echo $assets; ?>img/phone.svg" alt="img"/></div>
                                    <div class="contacts_col_content">
                                        <ul class="contacts_col_list">
                                            <?php while (have_rows('phones')) : the_row(); ?>
                                                <li>
                                                    <a href="tel:<?php e('phone'); ?>">
                                                        <strong>
                                                            <?php e('phone'); ?>
                                                        </strong>
                                                    </a>
                                                </li>
                                            <?php endwhile; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="contacts_col">
                                <div class="contacts_col_ico">
                                    <img class="svg" src="<?php echo $assets; ?>img/mail.svg" alt="img" />
                                </div>
                                <div class="contacts_col_content">
                                    <a class="one_line_center" href="mailto:<?php the_field('email'); ?>">
                                        <?php the_field('email'); ?>
                                    </a>
                                </div>
                            </div>
                            <?php if (have_rows('work_time')): ?>
                                <div class="contacts_col">
                                    <div class="contacts_col_ico">
                                        <img class="svg" src="<?php echo $assets; ?>img/time.svg" alt="img"/>
                                    </div>
                                    <div class="contacts_col_content">
                                        <ul class="contacts_col_list">
                                            <?php while (have_rows('work_time')) : the_row(); ?>
                                                <li>
                                                    <?php e('text'); ?>
                                                </li>
                                            <?php endwhile; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="contacts_map map"
                             id="map"
                             data-latitude="<?php the_field('latitude'); ?>"
                             data-longitude="<?php the_field('longitude'); ?>"
                             data-title="Title">
                        </div>
                    </div>
                    <div class="contact_form">
                        <div class="contact_form_sides">
                            <div class="contact_form_side contact_form_side_left">
                                <div class="contact_form_heading">
                                    <h4 class="contact_form_title">
                                        <?php the_field('title'); ?>
                                    </h4>
                                    <div class="contact_form_subtitle">
                                        <?php the_field('text'); ?>
                                    </div>
                                </div>
                                <form class="form_send" id="form_send_contact" action="<?php echo $url_home; ?>mail.php" method="post">
                                    <input type="hidden" name="project_name" value="<?php bloginfo('name'); ?>" />
                                    <input type="hidden" name="form_subject" value="<?php the_field('subject'); ?>" />
                                    <input type="hidden" name="admin_email" value="<?php echo $email; ?>" />
                                    <div class="form_element_wrapper">
                                        <div class="form_element half">
                                            <input class="form_input form_input_name" type="text" name="Name" placeholder="<?php the_field('placeholder_1'); ?>" required="" />
                                        </div>
                                        <div class="form_element half">
                                            <input class="form_input form_input_phone" type="email" name="E-mail" placeholder="<?php the_field('placeholder_2'); ?>" required="" />
                                        </div>
                                        <div class="form_element textarea_el">
                                            <textarea name="Text" placeholder="<?php the_field('placeholder_3'); ?>"></textarea>
                                        </div>
                                    </div>
                                    <div class="contact_form_bottom">
                                        <button class="submit_btn main_btn transition" type="submit">
                                            <span class="main_btn_inner">
                                               <?php the_field('button_text'); ?>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="contact_form_side contact_form_side_right">
                                <div class="contact_form_side_right_in">
                                    <img src="<?php echo get_field('build')['url']; ?>" alt="<?php echo get_field('build')['alt']; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php get_template_part('my-footer'); ?>

<?php get_footer(); ?>