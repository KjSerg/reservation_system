<?php

get_header('single');

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('mail', $set);

?>

<main class="content dark_content">
    <section class="section-text simple_section dark_bg">
        <div class="screen_content">
            <div class="main_title_wrapper">
                <div class="main_title"><?php the_title(); ?></div>
            </div>
            <div class="simple_text larger">
               <?php the_post();the_content(); ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer('inner'); ?>
