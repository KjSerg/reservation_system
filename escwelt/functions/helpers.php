<?php

function e($sub_field) {

    if (get_sub_field($sub_field)) echo get_sub_field( $sub_field);

}

function g($sub_field) {

    return get_sub_field( $sub_field);

}

function variables() {

    return array(

        'url_home'          => get_bloginfo('template_url') . '/',
        'assets'            => get_bloginfo('template_url') . '/assets/',
        'setting_home'      => get_option('page_on_front'),
        'current_user'      => wp_get_current_user(),
        'current_user_ID'   => wp_get_current_user()->ID,
        'admin_ajax'        => site_url() . '/wp-admin/admin-ajax.php',
        'url'               => get_bloginfo('url'),
    );

}



function get_term_parent_id($term_id, $my_tax = 'product_cat') {

    if($term_id){
        while( $parent_id = wp_get_term_taxonomy_parent_id( $term_id, $my_tax ) ){
            $term_id = $parent_id;
        }

        if( $term_id == 5 )
            return false;
        else
            return $term_id;
    }else {
        return false;
    }

}

function escapeJavaScriptText($string) {
    return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string)$string), "\0..\37'\\")));
}

function _get_next_posts_link( $label = null, $max_page = 0 ) {
    global $paged, $wp_query;

    if ( ! $max_page ) {
        $max_page = $wp_query->max_num_pages;
    }

    if ( ! $paged ) {
        $paged = 1;
    }

    $nextpage = intval( $paged ) + 1;

    if ( null === $label ) {
        $label = __( 'Next Page &raquo;' );
    }

    if ( ! is_single() && ( $nextpage <= $max_page ) ) {
        /**
         * Filters the anchor tag attributes for the next posts page link.
         *
         * @since 2.7.0
         *
         * @param string $attributes Attributes for the anchor tag.
         */
        $attr = apply_filters( 'next_posts_link_attributes', '' );

        return '<div class="more_articles_link"><a class="articles_link" href="' . next_posts( $max_page, false ) . "\" $attr>" . 'Older Posts' . '</a></div>';
    }
}


function int_get( $name ) {

    return (int)filter_input( INPUT_GET, $name, FILTER_SANITIZE_NUMBER_INT );

}

function int_post( $name ) {

    return (int)filter_input( INPUT_POST, $name, FILTER_SANITIZE_NUMBER_INT );

}

function is_current_lang($item) {

    if($item) {

        $classes = $item->classes;


        foreach ($classes as $class) {

            if($class == 'current-lang') {

                return true;

                break;
            }

        }

    }

}