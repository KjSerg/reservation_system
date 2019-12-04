<?php

add_filter( 'get_the_archive_title', function( $title ){
    return preg_replace('~^[^:]+: ~', '', $title );
});


add_filter( 'excerpt_length', function(){
    return 20;
} );

add_filter('excerpt_more', function($more) {
    return '..';
});