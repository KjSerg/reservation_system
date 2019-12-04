<?php

get_header('contacts');

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('mail', $set);

$img = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : $assets . 'img/article.jpg';

$tax = wp_get_post_terms( get_the_ID(), 'nachrichten_tags', array('fields' => 'all') );

$ids = array();
?>

    <main class="content">
        <section class="section-news simple_section">
            <div class="screen_content">
                <ul class="breadcrumbs_list">
                    <li><a href="<?php the_permalink($set); ?>"><?php echo get_the_title($set); ?></a></li>
                    <li><span><?php echo get_the_title(); ?></span></li>
                </ul>
                <div class="main_title_wrapper">
                    <h1 class="main_title"><?php echo get_the_title(); ?></h1>
                </div>
                <div class="article full_article">
                    <div class="article__img" style="background: url(<?php echo $img; ?>) center/cover no-repeat;"></div>
                    <div class="article__main">
                        <div class="article__heading">
                            <h2 class="article__title">
                                <?php the_field('subtitle'); ?>
                            </h2>
                            <div class="article__date"><img class="svg" src="<?php echo $assets; ?>img/date.svg" alt="img" /><span><?php the_date( 'j/n/Y' ); ?></span></div>
                        </div>
                        <div class="article__content">
                            <div class="article__txt simple_text">
                                <?php the_post();the_content(); ?>
                            </div>
                        </div>
                        <div class="article__bottom">

                            <?php if($tax): ?>

                                <div class="article__bottom_buttons">
                                    <?php foreach ($tax as $item):
                                        $id = $item->term_id;
                                        $ids[] = $id;
                                        $l = get_term_link( $id, $taxonomy = 'nachrichten_tags' );
                                        ?>
                                        <a class="main_btn bordered small" href="<?php echo $l; ?>">
                                            <span class="main_btn_inner"><?php echo $item->name; ?></span>
                                        </a>
                                    <?php endforeach; ?>
                                </div>

                            <?php endif; ?>

                            <div class="article_share">
                                <h5 class="article_share_title">SHARE</h5>
                                <ul class="social_list">
                                    <li><a target="_blank" class="soc_link" href="https://twitter.com/home?status=<?php the_permalink(); ?>"><img class="svg" src="<?php echo $assets; ?>img/twitter.svg" alt="img"/></a></li>
                                    <li><a target="_blank" class="soc_link" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><img class="svg" src="<?php echo $assets; ?>img/fb.svg" alt="img"/></a></li>
                                    <li><a target="_blank" class="soc_link" href="http://www.tumblr.com/share?v=3&u=<?php the_permalink(); ?>&t=<?php the_title(); ?>"><img class="svg" src="<?php echo $assets; ?>img/tumblr.svg" alt="img"/></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <?php


                if ($tax && $ids):


                    $arg = array(
                        'post_type' => 'nachrichten',
                        'posts_per_page' => '2',
                        'post_status' => 'publish',
                        'post__not_in' => array(get_the_ID()),
                        'tax_query' => array(
                            'taxonomy' => 'nachrichten_tags',
                            'field' => 'id',
                            'terms' => $ids
                        )
                    );

                    $posts = new WP_Query($arg);

                    if ($posts->have_posts()) :

                        ?>

                        <div class="related_articles">
                            <div class="main_title_wrapper">
                                <h5 class="main_title">RELATED POSTS</h5>
                            </div>
                            <div class="articles halfs">
                                <?php while ($posts->have_posts()) : $posts->the_post();

                                    $post_img = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : $assets . 'img/article.jpg';

                                ?>
                                    <div class="article">
                                        <div class="article__img"
                                             style="background: url(<?php echo $post_img; ?>) center/cover no-repeat;"></div>
                                        <div class="article__main">
                                            <div class="article__heading">
                                                <h3 class="article__title"><?php echo get_the_title(); ?></h3>
                                                <div class="article__date">
                                                    <img class="svg" src="<?php echo $assets; ?>img/date.svg"
                                                                                alt="img"/>
                                                    <span>
                                                        <?php echo get_the_date( 'j/n/Y' ); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="article__content">
                                                <div class="article__txt">
                                                    <?php the_excerpt(); ?>
                                                </div>
                                                <div class="article__btn"><a class="main_btn" href="<?php the_permalink(); ?>"><span
                                                            class="main_btn_inner">READ MORE</span></a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>

                    <?php endif; wp_reset_query(); ?>
                <?php endif; ?>

            </div>
        </section>
    </main>

<?php get_footer('inner'); ?>