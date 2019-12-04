<?php

get_header('contacts');

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('mail', $set);
$admin_ajax = $var['admin_ajax'];

$thumbnail = get_the_post_thumbnail();
$gallery = get_field('gallery');

$arg = array(
    'post_type' => 'die_zimmer',
    'posts_per_page' => '4',
    'post_status' => 'publish',
    'post__not_in' => array(get_the_ID()),
);

$date = current_time('d/m/Y');
$date1 = str_replace('/', '-', $date);

$date_arr = explode('/', $date);

$m = $date_arr[1];
$y = $date_arr[2];

$start_date = get_field('start_date');
$start_date1 = str_replace('/', '-', $start_date);

$finish_date = get_field('finish_date');
$finish_date1 = str_replace('/', '-', $finish_date);

$start_date_arr = explode('/', $start_date);
$finish_date_arr = explode('/', $finish_date);


$start_date_m = $start_date_arr[1];
$finish_date_m = $finish_date_arr[1];

$start_date_y = $start_date_arr[2];
$finish_date_y = $finish_date_arr[2];

$variable_year = (strtotime($start_date1) > strtotime($date1)) ? $start_date_y : $y;

$variable_m = (strtotime($start_date1) > strtotime($date1)) ? $start_date_m : $m;

$years = (int) $finish_date_y - (int) $variable_year;

$years = ($years == 0) ? 1 : $years;

$get_max_players = get_field('max_players');
$get_min_players = get_field('min_players');

$default_lang_post = pll_get_post(get_the_ID(), pll_default_language());
$default_lang_post = ($default_lang_post) ? $default_lang_post : get_the_ID();

?>

    <script>
        var admin_ajax = '<?php echo $admin_ajax; ?>';
        var room_id = Number('<?php echo $default_lang_post; ?>');
    </script>

    <main class="content">
        <section class="section-event-order simple_section">
            <script>
                var calendarData = [];
            </script>
            <div class="screen_content">
                <ul class="breadcrumbs_list">
                    <li><a href="<?php the_permalink($set); ?>"><?php echo get_the_title($set); ?></a></li>
                    <li><span><?php echo get_the_title(); ?></span></li>
                </ul>
                <div class="main_title_wrapper">
                    <h1 class="main_title"><?php echo get_the_title(); ?></h1>
                </div>
                <div class="event_sides">
                    <div class="event_side event_side_content_wrapper">
                        <div class="event_description_content">
                            <div class="event_side_description">
                                <?php the_post();the_content(); ?>
                            </div>

                            <?php if (have_rows('list')): ?>

                                <ul class="event_features">
                                    <?php while (have_rows('list')) : the_row(); ?>
                                        <li class="event_feature">
                                            <div class="event_feature_ico"><img class="svg" src="<?php e('icon'); ?>" alt="img"/></div>
                                            <div class="event_feature_text"><?php e('text'); ?></div>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>

                            <?php endif; ?>

                            <div class="article__bottom_buttons">
                                <a class="main_btn small bordered scroll_btn" href="#calendar_container">
                                    <span class="main_btn_inner"><?php the_field('button_text_1'); ?></span>
                                </a>
                                <a class="main_btn small bordered scroll_btn-js" href="#rooms">
                                    <span class="main_btn_inner"><?php the_field('button_text_2'); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="event_side event_side_slider_wrapper">
                        <div class="event_slider">

                            <?php if($gallery): ?>

                                <?php foreach ($gallery as $item): ?>

                                    <div class="event_slide">
                                        <img src="<?php echo $item['url']; ?>" alt="<?php echo $item['alt']; ?>" />
                                    </div>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>

                <?php $reviews = get_field('reviews');
                if($reviews):
                    ?>

                    <div class="comments_slider">

                        <?php foreach ($reviews as $review): ?>

                            <div>
                                <div class="comments_slide">
                                    <div class="comments_slide__head">
                                        <div class="comments_slide__title">
                                            <?php the_field('title', $review); ?>
                                        </div>
<!--                                        <ul class="comments_slide__rate">-->
<!--                                            <li class="filled">-->
<!--                                                <img class="svg" src="--><?php //echo $assets; ?><!--img/star.svg" alt="img"/>-->
<!--                                            </li>-->
<!--                                            <li class="filled">-->
<!--                                                <img class="svg" src="--><?php //echo $assets; ?><!--img/star.svg" alt="img"/>-->
<!--                                            </li>-->
<!--                                            <li class="filled">-->
<!--                                                <img class="svg" src="--><?php //echo $assets; ?><!--img/star.svg" alt="img"/>-->
<!--                                            </li>-->
<!--                                            <li class="filled">-->
<!--                                                <img class="svg" src="--><?php //echo $assets; ?><!--img/star.svg" alt="img"/>-->
<!--                                            </li>-->
<!--                                            <li>-->
<!--                                                <img class="svg" src="--><?php //echo $assets; ?><!--img/star.svg" alt="img"/>-->
<!--                                            </li>-->
<!--                                        </ul>-->
                                    </div>
                                    <div class="comments_slide__body">
                                        <div class="comments_slide__comment">
                                            <?php echo apply_filters('the_content', get_post_field('post_content', $review)); ?>
                                        </div>
                                        <div class="comments_slide__name">
                                            <?php echo get_the_title($review); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

                <div class="calendar_container" id="calendar_container" >
                    <div class="calendar_wrapper">
                        <div class="calendar__head">
                            <div class="calendar__head_side calendar__head_left">
                                <div class="calendar_select_wrapper">
                                    <div class="select_wrapper calendar_select">

                                        <?php if ($finish_date_arr): ?>

                                            <select name="calendar">

                                                <?php $year=(int) $variable_year; for($i = 0; $i <= $years; $i++):?>

                                                    <?php

                                                    $number_of_months = ((int)$finish_date_y == (int)$start_date_y) ? $finish_date_m : 12;


                                                    if ($i == 0): ?>

                                                        <?php for($a = (int) $variable_m; $a<=(int) $number_of_months; $a++):  ?>

                                                            <option value="<?php echo $a . ', ' .$year; ?>"><?php echo __(date("F", mktime(0, 0, 0, $a, 10)));  ?></option>

                                                        <?php endfor; ?>

                                                    <?php elseif($i > 0 && $i < $years): ?>

                                                        <?php for($a = 1; $a<=$number_of_months; $a++): ?>

                                                            <option value="<?php echo $a . ', ' .$year; ?>"><?php echo __(date("F", mktime(0, 0, 0, $a, 10))); ?></option>

                                                        <?php endfor; ?>

                                                    <?php elseif($i == $years): ?>

                                                        <?php for($a = 1; $a<=$finish_date_m; $a++): ?>

                                                            <option value="<?php echo $a . ', ' .$year; ?>"><?php echo __(date("F", mktime(0, 0, 0, $a, 10))); ?></option>

                                                        <?php endfor; ?>

                                                    <?php endif; ?>

                                                <?php $year++; endfor; ?>

                                            </select>

                                        <?php endif; ?>


                                    </div>
                                </div>
                            </div>
                            <div class="calendar__head_side calendar__head_middle">
                                <div class="acalendar_arrows showed"><button class="acalendar_arrow acalendar_arrow_prev">
                                        <img class="svg" src="<?php echo $assets; ?>img/slider_left.svg" alt="img"/>
                                    </button>
                                    <div class="acalendar_arrows_ico">
                                        <img class="svg" src="<?php echo $assets; ?>img/calendar.svg" alt="img" />
                                    </div>
                                    <button class="acalendar_arrow acalendar_arrow_next">
                                        <img class="svg" src="<?php echo $assets; ?>img/slider_right.svg" alt="img"/>
                                    </button>
                                </div>
                            </div>
                            <div class="calendar__head_side calendar__head_right">
                                <div class="calendar_head_title">zu buchen</div>
                            </div>
                        </div>
                        <div class="calendar__body calendar__js" data-from="0" data-step="7"></div>
                        <div class="calendar_modal" id="order_modal">
                            <ul class="calendar_modal__head">
                                <li class="cmh_el">
                                    <div class="cmh_el_side cmh_el__left"><img class="svg" src="<?php echo $assets; ?>img/time.svg" alt="img" />
                                        <div class="cmh_el__time">16:30</div>
                                    </div>
                                    <div class="cmh_el_side cmh_el__right"><img class="svg" src="<?php echo $assets; ?>img/check.svg" alt="img" /></div>
                                </li>
                                <li class="cmh_el">
                                    <div class="cmh_el_side cmh_el__left"><img class="svg" src="<?php echo $assets; ?>img/calendar2.svg" alt="img" />
                                        <div class="cmh_el__date">27.11.2019</div>
                                    </div>
                                    <div class="cmh_el_side cmh_el__right"><img class="svg" src="<?php echo $assets; ?>img/check.svg" alt="img" /></div>
                                </li>
                            </ul>

                            <?php if (have_rows('modal_order', $set)): ?>
                                <?php while (have_rows('modal_order', $set)) : the_row(); ?>

                                    <div class="calendar_modal__body">
                                        <form class="form_send create_new_order--js" action="<?php echo $admin_ajax; ?>" method="post">

                                            <input class="" type="hidden" name="action" value="create_new_order"/>

                                            <input class="redirect-s" type="hidden" value="<?php e('redirect_s'); ?>"/>
                                            <input class="redirect-f" type="hidden" value="<?php e('redirect_f'); ?>"/>

                                            <input class="order_time" type="hidden" name="time" value=""/>

                                            <input class="order_date" type="hidden" name="date" value=""/>

                                            <input class="" type="hidden" name="name_of_game" value="<?php echo get_the_title(); ?>"/>

                                            <input class="" type="hidden" name="id_of_game" value="<?php echo $default_lang_post; ?>"/>

                                            <div class="calendar_modal__body_elements">
                                                <div class="form_elements">
                                                    <div class="form_element">
                                                        <input type="text" placeholder="<?php e('placeholder_1'); ?>" required="required" name="name"/>
                                                    </div>
                                                    <div class="form_element">
                                                        <input type="email" placeholder="<?php e('placeholder_2'); ?>" name="email"/>
                                                    </div>
                                                    <div class="form_element">
                                                        <input type="tel" placeholder="<?php e('placeholder_3'); ?>" required="required" name="phone"/>
                                                    </div>
                                                    <div class="form_element">
                                                        <input
                                                                required
                                                                id="number_of_persons--js"
                                                                data-max="<?php echo $get_max_players; ?>"
                                                                data-min="<?php echo $get_min_players; ?>"
                                                                type="text"
                                                                value="<?php echo $get_min_players; ?>"
                                                                placeholder="<?php e('placeholder_4'); ?>"
                                                                name="number_of_persons"/>
                                                    </div>

                                                </div>
                                                <div class="mfv_checker ch_block">
                                                    <label>

                                                        <input type="checkbox" name="checkbox"/>

                                                        <div class="ch_block_icon">
                                                            <img class="svg" src="<?php echo $assets; ?>img/ch.svg" alt="img"/>
                                                        </div>

                                                        <?php e('consent'); ?>

                                                    </label>
                                                </div>
                                                <div class="calendar_modal__buttons">
                                                    <a class="main_btn small bordered mdl_close" href="#">
                                                        <span class="main_btn_inner">
                                                            <?php e('button_text_1'); ?>
                                                        </span>
                                                    </a>
                                                    <button class="submit_btn main_btn small" type="submit">
                                                        <span class="main_btn_inner">
                                                            <?php e('button_text_2'); ?>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                <?php endwhile; ?>
                            <?php endif; ?>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <?php
        $posts = new WP_Query($arg);

        if ($posts->have_posts()) :

            ?>

            <section class="section-rooms simple_screen dark_bg" id="rooms"
                     style="background: url(<?php the_field('sct_bg_1'); ?>) center/cover no-repeat;">
                <div class="screen_content">
                    <div class="main_title_wrapper">
                        <h3 class="main_title">
                            <?php the_field('title_1'); ?>
                        </h3>
                    </div>


                    <div class="rooms_blocks">

                        <?php while ($posts->have_posts()) : $posts->the_post();

                            $post_img = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : $assets . 'img/rb1.jpg';

                            ?>

                            <div class="rooms_block">
                                <div class="rooms_block__frame" style="background: url(<?php echo $post_img; ?>) center/cover;">
                                    <div class="rooms_block__frame_curtain"
                                         style="background: url(<?php echo $assets; ?>img/room_curtain.png) center/contain;"></div>
                                    <a class="small main_btn bordered" href="<?php the_permalink(); ?>"><span
                                            class="main_btn_inner">Jetzt buchen</span></a></div>
                                <a class="rooms_block__title" href="<?php the_permalink(); ?>">
                                    <?php echo get_the_title(); ?>
                                </a>
                            </div>

                        <?php endwhile; ?>


                    </div>


                </div>
            </section>

        <?php endif; wp_reset_query(); ?>

    </main>

<?php get_footer('inner'); ?>