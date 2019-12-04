<?php

add_action('wp_ajax_nopriv_new_review', 'new_review');
add_action('wp_ajax_new_review', 'new_review');

function new_review() {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $message = $_POST['message'];

    $post_data = array(
        'post_type'     => 'bewertungen',
        'post_title'    => $name,
        'post_status'   => 'pending',
    );

    $post_id = wp_insert_post( $post_data );
    $post = get_post($post_id);

    $my_post = array();
    $my_post['ID'] = $post_id;
    $my_post['post_content'] = $message;

    wp_update_post( wp_slash($my_post) );

    update_field( "title",$title, $post );
    update_field( "email",$email, $post );


    if (
        isset( $_POST['my_image_upload_nonce'] )
        && wp_verify_nonce( $_POST['my_image_upload_nonce'], 'my_image_upload' )
    ) {
        $attachment_id = media_handle_upload( 'my_image_upload', $post_id );
        if ( !is_wp_error( $attachment_id ) ) {
            set_post_thumbnail( $post_id, $attachment_id );
        }
    }

    die(  );
}