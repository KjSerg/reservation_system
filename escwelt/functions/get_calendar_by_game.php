<?php

add_action('wp_ajax_nopriv_get_calendar_json', 'get_calendar_json');
add_action('wp_ajax_get_calendar_json', 'get_calendar_json');


function get_calendar_json() {


    $id_game = $_POST['id'];
    $_date = $_POST['date'];
    $_date_arr = explode(', ', $_date);
    $_m = $_date_arr[0];
    $_y = $_date_arr[1];

    $arr = array();


    if($id_game && $_date) {

        $date = date('d/m/Y');

        $date1 = str_replace('/', '-', $date);

        $date_arr = explode('/', $date);

        $d = (int) $date_arr[0];
        $m = (int) $date_arr[1];
        $y = (int) $date_arr[2];

        $time = current_time('H:i');

        $days = date('t');

        $start_date = get_field('start_date', $id_game);
        $start_date1 = str_replace('/', '-', $start_date);

        $finish_date = get_field('finish_date', $id_game);
        $finish_date1 = str_replace('/', '-', $finish_date);

        $start_date_arr = explode('/', $start_date);
        $finish_date_arr = explode('/', $finish_date);

        $start_date_d = $start_date_arr[0];
        $finish_date_d = $finish_date_arr[0];

        $start_date_m = $start_date_arr[1];
        $finish_date_m = $finish_date_arr[1];

        $start_date_y = $start_date_arr[2];
        $finish_date_y = $finish_date_arr[2];

        $years = (int) $finish_date_y - (int) $y;

        $years = ($years == 0) ? 1 : $years;

        if(strtotime($finish_date1) >= strtotime($date1)) {

            $start_day = ($m == $_m && $y == $_y) ? $d : 1;

            if(strtotime($start_date1) > strtotime($date1) && $start_date_m == $_m) {
                $start_day = (int) $start_date_d;
            }

            $days = ($m == $_m) ? $days : date('t', mktime(0, 0, 0, $_m, 1, $_y));

            $days = ((int) $finish_date_m == (int) $start_date_m && (int) $finish_date_y == (int) $start_date_y ) ? (int) $finish_date_d : (int) $days;

            $days = ((int) $finish_date_m == (int) $_m && (int) $finish_date_y == (int) $_y ) ? $finish_date_d : $days;

            for($i = $start_day; $i <= $days; $i++) {

                $this_date = $i .'-'. $_m .'-'. $_y;

                $temp = array(
                    'date' => $i,
                    'month' => __(date("F", mktime(0, 0, 0, $_m, 10))),
                    'day' => __(date('l', strtotime($this_date))),
                    'fullDate' => $i .'.'. $_m .'.'. $_y,
                );

                $timestamps = array();

                if (have_rows('time', $id_game)):
                    while (have_rows('time', $id_game)) : the_row();

                        $_time = g('val');

                        $full_date = $_y . '-' . $_m . '-' . $i . ' ' . $_time;

                        $is_ordered = checkDateGameOrdered($id_game, $full_date);

                        if(!$is_ordered && $m == $_m && $d == $i) {
                            $is_ordered = (strtotime($_time) > strtotime($time)) ? $is_ordered : true;
                        }


                        $timestamps[] = array(
                            'time' => $_time,
                            'ordered' => $is_ordered,
                        );

                    endwhile;

                    $temp['timestamps'] = $timestamps;

                endif;

                $arr[] = $temp;

            }

        }


        echo json_encode($arr);

    }

    die();
}


function checkDateGameOrdered($id_game, $date) {

    $result = false;

    if($id_game && $date) {

        $arg = array(
            'post_type' => 'bestellungen',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'lang'           => pll_default_language()
        );

        $orders = new WP_Query($arg);

        if ($orders->have_posts()) :

            while ($orders->have_posts()) : $orders->the_post();

                $game = pll_get_post((int) get_field('game')->ID, pll_default_language());
                $game = $game ? $game : (int) get_field('game')->ID;

                if($game == (int) $id_game) {

                    $date_hour = get_field('date_hour');

                    if(strtotime($date_hour) == strtotime($date)) {

                        return true;
                        break;

                    }

                }

            endwhile;
        endif;
        wp_reset_query();

    }

    return $result;

}

function getDateGameOrdered($id_game, $date) {

    $result = false;

    if($id_game && $date) {

        $arg = array(
            'post_type' => 'bestellungen',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key'     => 'game',
                    'value'   => (int) $id_game,
                ),
            )
        );

        $orders = new WP_Query($arg);
        $posts = $orders->posts;

        foreach ($posts as $post) {
            $date_hour = get_field('date_hour', $post->ID);
            if (strtotime($date_hour) == strtotime($date)) {
                return get_the_ID();
                break;
            }
        }

    }

    return $result;

}

function _getDateGameOrdered() {

$result = false;

    $arg = array(
        'post_type' => 'bestellungen',
        'posts_per_page' => -1,
        'post_status' => 'publish',

    );

    $orders = new WP_Query($arg);
    $posts = $orders->posts;


    return $posts;

}

