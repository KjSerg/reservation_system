<?php

add_action('after_setup_theme', function () {
    register_nav_menus(
        array('header_menu' => 'Menu in header')
    );
});