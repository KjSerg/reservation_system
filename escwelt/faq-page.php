<?php
/* Template Name: Seitenvorlage FAQ */
get_header('contacts');

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('mail', $set);
?>

<main class="content">
    <section class="section-faq simple_section">
        <div class="screen_content">
            <ul class="breadcrumbs_list">
                <li><a href="<?php the_permalink($set); ?>"><?php echo get_the_title($set); ?></a></li>
                <li><span><?php echo get_the_title(); ?></span></li>
            </ul>
            <div class="main_title_wrapper">
                <div class="main_title"><?php the_field('title'); ?></div>
            </div>
            <div class="c_acc_blocks_wrapper">
                <div class="c_acc_blocks">

                    <?php if (have_rows('list')): ?>

                        <div class="faq_sides">

                            <div class="faq_side">
                                <?php $int = 1; while (have_rows('list')) : the_row(); $test = ($int%2)?false:true; if(!$test): ?>
                                    <div class="c_acc_block">
                                        <a class="c_acc_link" href="#cpane<?php echo $int; ?>">
                                            <div class="c_acc_link_text">
                                                <?php e('question'); ?>
                                            </div>
                                            <div class="c_acc_arrow"></div>
                                        </a>
                                        <div class="c_acc_block_body" id="cpane<?php echo $int; ?>">
                                            <div class="acc_body_in">
                                                <?php e('answer'); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; $int++; endwhile; ?>
                            </div>
                            <div class="faq_side">
                                <?php $int = 1; while (have_rows('list')) : the_row();  $test = ($int%2)?false:true; if($test): ?>
                                    <div class="c_acc_block">
                                        <a class="c_acc_link" href="#cpane<?php echo $int; ?>">
                                            <div class="c_acc_link_text">
                                                <?php e('question'); ?>
                                            </div>
                                            <div class="c_acc_arrow"></div>
                                        </a>
                                        <div class="c_acc_block_body" id="cpane<?php echo $int; ?>">
                                            <div class="acc_body_in">
                                                <?php e('answer'); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; $int++; endwhile; ?>
                            </div>

                        </div>

                    <?php endif; ?>

                </div>
                <div class="image_side_img">
                    <?php echo get_the_post_thumbnail(); ?>
                </div>
            </div>


            <?php $button = get_field('button');
            if($button): ?>
            <div class="main_btn_wrapper centered">
                <a class="main_btn" href="<?php echo $button['url']; ?>">
                    <span class="main_btn_inner">
                       <?php echo $button['title']; ?>
                    </span>
                </a>
            </div>
            <?php endif; ?>

        </div>
    </section>
</main>

<?php get_footer('inner'); ?>
