<?php

add_action('wp_ajax_nopriv_load_reviews', 'load_reviews');
add_action('wp_ajax_load_reviews', 'load_reviews');

function load_reviews() {

    $all = (int) $_POST['all'];
    $active = (int) $_POST['active'];
    $length = (int) $_POST['length'];
    $id = $_POST['id'];

    $list = get_field('list', $id);

    $var = variables();
    $assets = $var['assets'];

    if($list):

        $counter = 1; $i = 1;

        foreach ($list as $item):

            if($i > $active) :

                if($counter > $length) break;

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
                                <?php echo apply_filters('the_content', get_post_field('post_content', $item));; ?>
                            </div>
                            <div class="testimonials_sign">
                                <?php echo get_the_title($item); ?>
                                <br/>
                                <span><?php echo get_the_date(__('d.m.Y H:i'), $item); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $counter++;
            endif;
            $i++;
        endforeach;

    endif;

    die();
}