<?php

get_header('contacts');

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('mail', $set);
?>

    <main
            class="content">
        <section class="section-news simple_section">
            <div class="screen_content">
                <ul class="breadcrumbs_list">
                    <li><a href="<?php the_permalink($set); ?>"><?php echo get_the_title($set); ?></a></li>
                    <li><span><?php echo get_the_archive_title(); ?></span></li>
                </ul>
                <div class="main_title_wrapper">
                    <h2 class="main_title"><?php echo get_the_archive_title(); ?></h2>
                </div>
                <div class="articles">


                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();  ?>

                        <?php get_template_part('components/article'); ?>

                    <?php endwhile; else : ?>
                        <p>Nicht gefunden.</p>
                    <?php endif; ?>

                </div>
                <?php echo _get_next_posts_link(); ?>
            </div>
        </section>
    </main>


<?php get_footer('inner'); ?>