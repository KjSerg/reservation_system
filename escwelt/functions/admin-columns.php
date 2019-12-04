<?php


function true_add_post_columns($my_columns){
    $my_columns['phone'] = 'Kundentelefon';
    $my_columns['date_hour'] = 'Uhrzeit und Datum';
    $my_columns['link'] = 'Zimmer';
    $my_columns['number_of_persons'] = 'Anzahl der Personen';
    return $my_columns;
}

add_filter( 'manage_edit-bestellungen_columns', 'true_add_post_columns', 10, 1 );


function true_fill_post_columns( $column ) {
    global $post;
    $var = variables();
    $url = $var['url'];
    $link = '<a href="'.$url.'/wp-admin/post.php?post='.get_post_meta($post->ID, 'game', true).'&action=edit">'.get_the_title(get_post_meta($post->ID, 'game', true)).'</a>';
    switch ( $column ) {
        case 'date_hour':
            echo get_post_meta($post->ID, 'date_hour', true);
            break;
        case 'link':
            echo $link;
            break;
        case 'phone':
            echo get_post_meta($post->ID, 'phone', true);
            break;
        case 'number_of_persons':
            echo get_post_meta($post->ID, 'number_of_persons', true);
            break;
    }
}

add_action( 'manage_posts_custom_column', 'true_fill_post_columns', 10, 1 );

add_filter( 'manage_'.'edit-bestellungen'.'_sortable_columns', 'add_views_sortable_column' );

function add_views_sortable_column( $sortable_columns ){
    $sortable_columns['phone'] = [ 'phone', false ];
    $sortable_columns['link'] = [ 'link', false ];
    return $sortable_columns;
}
