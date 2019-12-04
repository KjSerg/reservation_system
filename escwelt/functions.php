<?php
/**
 * escwelt  functions and definitions
 *
 * @package escwelt
 */


function escwelt_scripts() {

    wp_enqueue_style( 'escwelt-style', get_stylesheet_uri() );

    wp_enqueue_style( 'escwelt-fancyapps-css', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css', array(), '1.0');

    wp_enqueue_style( 'escwelt-main-css', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0');

    wp_enqueue_style( 'escwelt-fix-css', get_template_directory_uri() . '/assets/css/fix.css', array(), '1.0');

    wp_enqueue_script( 'escwelt-jquery-scripts', get_template_directory_uri() . '/assets/js/jquery.js', array(), '1.0', true );

    wp_enqueue_script( 'escwelt-fancyapps-scripts', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array(), '1.0', true );

    wp_enqueue_script( 'escwelt-libs-scripts', get_template_directory_uri() . '/assets/js/libs.min.js', array(), '1.0', true );

    wp_enqueue_script( 'escwelt-scripts', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', true );

    wp_enqueue_script( 'escwelt-fix-scripts', get_template_directory_uri() . '/assets/js/fix.js', array(), '1.0', true );

    wp_localize_script( 'ajax-script', 'AJAX',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

}
add_action( 'wp_enqueue_scripts', 'escwelt_scripts' );


add_theme_support( 'post-thumbnails' );

get_template_part('functions/helpers');
get_template_part('functions/filters');
get_template_part('functions/actions');
get_template_part('functions/new_review');
get_template_part('functions/load_review');
get_template_part('functions/create_new_order');
get_template_part('functions/admin-columns');
get_template_part('functions/get_calendar_by_game');

get_template_part('admin/calendar');

pll_register_string('EREIGNISSE', 'EREIGNISSE');
pll_register_string('NACHRICHTEN', 'NACHRICHTEN');






