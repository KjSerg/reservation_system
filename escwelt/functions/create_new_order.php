<?php

add_action('wp_ajax_nopriv_create_new_order', 'create_new_order');
add_action('wp_ajax_create_new_order', 'create_new_order');

function create_new_order() {
    $res = array();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $time = $_POST['time'];
    $date = $_POST['date'];
    $number_of_persons = $_POST['number_of_persons'];

    $name_of_game = $_POST['name_of_game'];

    $id_of_game = $_POST['id_of_game'];

    if($name && $phone && $time && $date && $name_of_game) {

        $current_date = current_time('d-m-Y H:i:s');

        $_date = $date . ' ' . $time;
        $_date1 = str_replace('.', '-', $_date);

        $is_ordered = checkDateGameOrdered($id_of_game, $date . ' ' . $time);

        $is_valid_date = (strtotime($_date1) < strtotime($current_date)) ? false : true;

        if(!$is_ordered && $is_valid_date) {

            $post_data = array(
                'post_type'     => 'bestellungen',
                'post_title'    => $name . ' - ' . $name_of_game,
                'post_status'   => 'publish',
            );

            $post_id = wp_insert_post( $post_data );
            $post = get_post($post_id);

            update_field( "name", $name, $post );
            update_field( "email", $email, $post );
            update_field( "phone", $phone, $post );
            update_field( "number_of_persons", $number_of_persons, $post );
            update_field( "date_hour", $date . ' ' . $time, $post );
            update_field( "date", $date, $post );
            update_field( "hour", $time, $post );
            update_field( "name_of_game", $name_of_game, $post );
            update_field( "game", $id_of_game, $post );

            $res['type'] = 'success';

            send_massage($name, $email, $phone, $time, $date, $number_of_persons, $name_of_game, $id_of_game, $post_id);

        }else{
            $res['type'] = 'failed';
        }

    }else{
        $res['type'] = 'failed';
    }

    echo json_encode($res);

    die();
}

function send_massage($name, $email, $phone, $time, $date, $number_of_persons, $name_of_game, $id_of_game, $order_id) {

    $var = variables();
    $set = $var['setting_home'];
    $url = $var['url'];

    $admin_email = get_field('mail', $set);

    $project_name = get_bloginfo('name');


    $customer_template = get_field('customer_template', $set);
    $admin_template = get_field('admin_template', $set);

    $form_subject_customer = get_the_title($customer_template);
    $form_subject_admin = get_the_title($admin_template);

    $message_customer = apply_filters('the_content', get_post_field('post_content', $customer_template));

    $id_of_game = pll_get_post($id_of_game, pll_default_language());
    $id_of_game = ($id_of_game) ? $id_of_game : $id_of_game;

    $message_customer = str_replace('%name%', $name, $message_customer);
    $url1 = '<a href="'.get_the_permalink($id_of_game).'">'.$name_of_game.'</a>';
    $message_customer = str_replace('%game%', $url1, $message_customer);
    $message_customer = str_replace('%time%', $date . ' ' . $time, $message_customer);

    function adopt($text) {
        return '=?UTF-8?B?'.base64_encode($text).'?=';
    }

    $headers = "MIME-Version: 1.0" . PHP_EOL .
        "Content-Type: text/html; charset=utf-8" . PHP_EOL .
        'From: '.adopt($project_name).' <info@'.$_SERVER['HTTP_HOST'].'>' . PHP_EOL .
        'Reply-To: '.$admin_email.'' . PHP_EOL;

    mail($email, adopt($form_subject_customer), $message_customer, $headers );

    $message_admin = apply_filters('the_content', get_post_field('post_content', $admin_template));

    $message_admin = str_replace('%name%', $name, $message_admin);
    $url2 = '<a href="'.$url.'/wp-admin/post.php?post='.$order_id.'&action=edit">'.$name_of_game.' - '.$id_of_game.'</a>';
    $message_admin = str_replace('%id%', $url2, $message_admin);
    $message_admin = str_replace('%number%', $number_of_persons, $message_admin);
    $message_admin = str_replace('%time%', $date . ' ' . $time, $message_admin);
    $message_admin = str_replace('%email%', $email, $message_admin);
    $message_admin = str_replace('%phone%', $phone, $message_admin);

    mail($admin_email, adopt($form_subject_admin), $message_admin, $headers );
}