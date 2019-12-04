<?php

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];

?>

<!DOCTYPE html>
<html class="no-js  page" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries-->
    <!-- WARNING: Respond.js doesn't work if you view the page via file://-->
    <!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <title><?php wp_title(); ?></title>

    <?php wp_head(); ?>

</head>

<body>
<header class="header dark inner_page_header allways_white">
    <div class="header_main__top">
        <div class="header_top_left">
            <?php get_template_part('components/language_switcher'); ?>
        </div>
        <a class="main_logo" href="<?php echo $url; ?>">
            <img src="<?php the_field('logo', $set); ?>" alt="<?php bloginfo( 'name' ); ?>"/>
        </a>
        <div class="header_top_right">
            <?php if (have_rows('phones', $set)): ?>
                <ul class="header_phone_list">
                    <?php while (have_rows('phones', $set)) : the_row(); ?>
                        <li><a href="tel:<?php e('phone'); ?>"><?php e('phone'); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
            <?php $button1 = get_field('button_in_header_1', $set);
            if($button1): ?>
                <a class="main_btn small bordered" href="<?php echo $button1['url']; ?>">
                    <span class="main_btn_inner"><?php echo $button1['title']; ?></span>
                </a>
            <?php endif; ?>
            <?php
            $button = get_field('button_in_header', $set);
            if($button): ?>
                <a class="main_btn small" href="<?php echo $button['url']; ?>">
                    <span class="main_btn_inner"><?php echo $button['title']; ?></span>
                </a>
            <?php endif; ?>
            <a class="header_links_trigger header_links_trigger__js" href="#header_nav"><span></span><span></span><span></span></a>
        </div>
        <?php get_template_part('components/menu-in-header'); ?>
        <?php if (have_rows('socials_header', $set)): ?>
            <ul class="side_frame_social">
                <?php while (have_rows('socials_header', $set)) : the_row(); ?>
                    <li>
                        <a class="side_social_link" href="<?php e('link'); ?>" target="_blank">
                            <img class="svg" src="<?php e('icon'); ?>" alt="img"/>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </div>
</header>

<svg style="width:0;height:0;position:absolute;opacity:0;" aria-hidden="true" focusable="false"><lineargradient id="svg-gradient" x2="0" y2="1"><stop offset="0%" stop-color="#8F4E1C"></stop><stop offset="50%" stop-color="#D2AB34"></stop><stop offset="100%" stop-color="#e0b453"></stop></lineargradient></svg>