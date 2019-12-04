<?php $language_switcher = wp_get_nav_menu_items('Languages');
$current_language = pll_current_language('name');
?>

<?php if ($language_switcher): ?>

    <div class="lang_select_wrapper" id="lang_select_dropdown">
        <div class="lang_select_label" data-target="#lang_select_dropdown">

            <?php foreach ($language_switcher as $item): ?>
                <?php if (is_current_lang($item)): ?>

                    <div class="lang_select_label_text"><?php echo $current_language; ?></div>
                    <div class="lang_select_label_ico">
                        <?php echo $item->title; ?>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>

        </div>
        <ul class="lang_select_dropdown">
            <?php foreach ($language_switcher as $item): ?>
                <?php if (!is_current_lang($item)):  ?>
                    <li>
                        <a class="lang_item" href="<?php echo $item->url; ?>">
                            <?php echo $item->title; ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif; ?>