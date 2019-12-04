<?php

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];

$t1 = get_field('title', $set);
$t2 = get_field('title_1', $set);
$t3 = get_field('title_2', $set);

?>

<footer class="footer section fp-auto-height dark_bg">
    <div class="screen_content">
        <div class="footer_cols">
            <div class="footer_col first_col">
                <div class="footer_col__top">
                    <div class="footer_sides">
                        <div class="footer_side footer_side__left">
                            <a class="logo" href="<?php echo $url; ?>">
                                <img src="<?php the_field('logo_in_footer', $set); ?>" alt="<?php bloginfo( 'name' ); ?>"/>
                            </a>
                        </div>
                        <div class="footer_side footer_side__right">
                            <?php if($t1): ?>
                                <div class="footer_col__title"><?php echo $t1; ?></div>
                            <?php endif; ?>

                            <?php if (have_rows('menu', $set)): ?>
                                <ul class="footer_links">
                                    <?php while (have_rows('menu', $set)) : the_row(); $l = g('link'); ?>
                                        <li><a href="<?php echo $l['url']; ?>"><?php echo $l['title']; ?></a></li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                <div class="footer_col__bottom">
                    <?php the_field('copyright_1', $set); ?>
                </div>
            </div>
            <div class="footer_col middle_col">
                <div class="footer_col__top">
                    <div class="footer_col_block">
                        <?php if($t2): ?>
                            <div class="footer_col__title"><?php echo $t2; ?></div>
                        <?php endif; ?>

                        <?php if (have_rows('socials', $set)): ?>
                            <ul class="social_list">
                                <?php while (have_rows('socials', $set)) : the_row();  ?>
                                    <li>
                                        <a target="_blank" class="soc_link" href="<?php e('link'); ?>">
                                            <img class="svg" src="<?php e('icon'); ?>" alt="img"/>
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="footer_col__bottom">
                    <p class="copyright"><?php the_field('copyright_2', $set); ?></p>
                </div>
            </div>
            <div class="footer_col last_col">
                <div class="footer_col__top">
                    <?php if($t3): ?>
                        <div class="footer_col__title"><?php echo $t3; ?></div>
                    <?php endif; ?>
                    <ul class="footer_contacts">
                        <li>
                            <a target="_blank" class="ico_link" href="<?php echo get_field('address', $set)['url']; ?>">
                                <div class="ico_link_img"><img class="svg" src="<?php echo $assets; ?>img/pin.svg" alt="img"/></div>
                                <span class="ico_link_text"><?php echo get_field('address', $set)['title']; ?></span>
                            </a>
                        </li>
                        <li>
                            <?php if (have_rows('phones_in_footer', $set)): ?>
                                <div class="ico_link">
                                    <div class="ico_link_img"><img class="svg" src="<?php echo $assets; ?>img/phone.svg"
                                                                   alt="img"/></div>
                                    <div class="ico_link_text">
                                        <?php while (have_rows('phones_in_footer', $set)) : the_row(); ?>
                                            <a href="tel:<?php e('phone'); ?>">
                                                <?php e('phone'); ?>
                                            </a>
                                        <?php endwhile; ?>
                                    </div>
                                </div>

                            <?php endif; ?>

                        </li>
                        <li>
                            <a class="ico_link" href="mailto:<?php the_field('email', $set) ?>">
                                <div class="ico_link_img">
                                    <img class="svg" src="<?php echo $assets; ?>img/mail.svg" alt="img"/>
                                </div>
                                <span class="ico_link_text"><?php the_field('email', $set)  ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="footer_col__bottom">
                    <?php if (have_rows('links', $set)): ?>
                        <ul class="fcb_list">
                            <?php while (have_rows('links', $set)) : the_row();  ?>
                                <li>
                                    <a href="<?php echo g('link')['url']; ?>">
                                        <?php echo g('link')['title']; ?>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>