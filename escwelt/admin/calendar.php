<?php

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('mail', $set);
$admin_ajax = $var['admin_ajax'];
$now = new Datetime('now');


function getGames($game_id)
{

    $arg = array(
        'post_type' => 'die_zimmer',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'lang'           => 'de'
    );

    if ($game_id) {
        $arg['post__in'] = array($game_id);
    }

    $posts = new WP_Query($arg);

    $temp = array();

    if ($posts->have_posts()) :
        while ($posts->have_posts()) : $posts->the_post();

            $temp[] = get_post();

        endwhile;
        wp_reset_query();
    endif;

    return $temp;

}

function getOrders()
{

    $arg = array(
        'post_type' => 'bestellungen',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );


    $posts = new WP_Query($arg);

    $temp = array();

    if ($posts->have_posts()) :
        while ($posts->have_posts()) : $posts->the_post();

            $temp[] = get_post();

        endwhile;
        wp_reset_query();
    endif;

    return $temp;

}

add_action('wp_ajax_nopriv_get_events', 'get_events');
add_action('wp_ajax_get_events', 'get_events');

function get_events()
{

    $result = array();

    $games = getGames(int_post('game_request'));

    $date = date('d-m-Y');

    $orders = _getDateGameOrdered();

    foreach ($games as $game) {

        $start_date = get_field('start_date', $game->ID);
        $start_date1 = str_replace('/', '-', $start_date);

        $finish_date = get_field('finish_date', $game->ID);
        $finish_date1 = str_replace('/', '-', $finish_date);

        $start = new Datetime($start_date1);
        $end = new Datetime($finish_date1);

        while ($start <= $end) {
            if (have_rows('time', $game->ID)):
                while (have_rows('time', $game->ID)) : the_row();

                    $_time = g('val');

                    $start_time = $start->format('Y-m-d') . ' ' . $_time;
                    $game_title = $game->post_title;

                    if (strtotime($start_time) >= strtotime($date . '00:00')) {

                        $temp = array(
                            'color' => '#0073aa',
                            'start' => $start_time,
                            'textColor' => "#fff",
                            'title' => $game_title,
                        );

                        foreach ($orders as $order) {
                            $time = strtotime(get_field('date_hour', $order));
                            $time1 = strtotime($start_time);

                            $game_id = get_field('game', $order)->ID;

                            if ($time == $time1 && $game_id == $game->ID) {
                                $temp['url'] = get_edit_post_link($order->ID, '');
                                $temp['color'] = '#00ff00';
                                $temp['textColor'] = "#000";
                            }
                        }

                        $result[] = $temp;
                    }

                endwhile;
            endif;

            $start = $start->modify('+1 day');
        }

    }

    foreach ($orders as $order) {

        $date_order = get_field('date', $order);

        $date_order1 = str_replace('/', '-', $date_order);

        if((strtotime($date_order1) < strtotime($date))) {
            $temp = array(
                'color' => '#ccc',
                'start' => get_field('date_hour', $order),
                'textColor' => "#000",
                'title' => get_the_title(get_field('game', $order)->ID),
                'url' => get_edit_post_link($order->ID, '')
            );

            $result[] = $temp;
        }



    }

    echo json_encode($result);

    die();

}

add_action('admin_menu', 'register_my_custom_menu_page');
function register_my_custom_menu_page()
{
    add_menu_page(
        __('Kalender'), __('Kalender'), 'administrator', 'calendar', 'my_custom_menu_page', 'dashicons-calendar-alt', 6
    );
}

function my_custom_menu_page()
{


    get_template_part('admin-calendar');

}


