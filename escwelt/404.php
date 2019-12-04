<?php
get_header('404');

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];

$email = get_field('mail', $set);
?>


<main class="content">
    <section class="section-not-found" style="background: url(<?php echo $assets; ?>img/bg_not_found.jpg) center/cover no-repeat;">
        <div class="section_table">
            <div class="cection_cell">
                <div class="screen_content">
                    <div class="nf_content">
                        <div class="nf_title">4<span class="yellow">0</span>4</div>
                        <div class="nf_subtitle">Hoppla! Ein Fehler ist aufgetreten!</div>
                    </div>
                    <div class="main_btn_wrapper centered">
                        <a class="main_btn" href="<?php echo $url; ?>">
                            <span class="main_btn_inner">zurück</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer('404'); ?>