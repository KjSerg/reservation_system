<?php

$games_all = getGames(false);

$game_request = int_get('game');

$now = new Datetime('now');

$var = variables();
$set = $var['setting_home'];
$assets = $var['assets'];
$url = $var['url'];
$url_home = $var['url_home'];
$email = get_field('mail', $set);
$admin_ajax = $var['admin_ajax'];
$now = new Datetime('now');


?>


<script type="text/javascript" src="<?php echo $assets; ?>js/fullcalendar-2.9.1/lib/moment.min.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>js/fullcalendar-2.9.1/fullcalendar.js"></script>
<script>
    jQuery(document).ready(function () {
        var curr_date = '<?php echo $now->format('Y-m-d'); ?>';
        jQuery('#games-calendar').fullCalendar({

            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: curr_date,
            editable: true,
            events: function (start, end, timezone, callback) {
                jQuery.ajax({
                    url: window.ajaxurl,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        game_request: <?php echo $game_request; ?>,
                        action: 'get_events',
                        start: start.format('YMMDD'),
                        end: end.format('YMMDD')
                    },
                    success: function (res) {
                        callback(res);
                    }
                });
            },
            loading: function (bool) {
                if (bool) {
                    jQuery('#loading').show();
                    jQuery('#games-calendar').css('opacity', '0');
                }
                else {
                    jQuery('#loading').hide();
                    jQuery('#games-calendar').css('opacity', '1');
                }
            },
            timeFormat: 'HH:mm'
        });
        jQuery('#game-selector').change(function () {
            jQuery(this).closest('form').submit();
        });
    });
</script>
<link rel="stylesheet" href="<?php echo $assets; ?>js/fullcalendar-2.9.1/fullcalendar.css" type="text/css">
<style>
    #games-calendar {
        max-width: 900px;
        margin: 0 auto;
        transition: 0.5s ease;
    }
</style>

<div class="wrap">
    <div id="loading" style="display:none;position:absolute;left:30%;top:10%;">
        <img src="<?php echo $assets; ?>img/loading.gif"/>
    </div>
    <h2><?php echo __('Calendar'); ?></h2>
    <form method="get" action="admin.php">
        <select id="game-selector" name="game">
            <option value="0"><?= __('All'); ?></option>
            <?php

            if ($games_all) :

                foreach ($games_all as $item) :

                    ?>

                    <option value="<?php echo $item->ID; ?>"<?php if ($item->ID == $game_request) { ?> selected<?php } ?>><?php echo get_the_title($item); ?></option>

                    <?php
                endforeach;
            endif;
            ?>
        </select>
        <input type="hidden" name="page" value="calendar"/>
    </form>
    <div class="calendar" id="games-calendar"></div>
    <table>
        <tr>
            <td>
                <div style="height:30px;width:30px;background-color:#00ff00"></div>
            </td>
            <td> <?php echo __('Bestellt') ; ?></td>
        </tr>
        <tr>
            <td>
                <div style="height:30px;width:30px;background-color:#ccc"></div>
            </td>
            <td><?php echo __('Vergangene Bestellungen') ; ?></td>
        </tr>
        <tr>
            <td>
                <div style="height:30px;width:30px;background-color:#0073aa"></div>
            </td>
            <td><?php echo __('frei') ; ?></td>
        </tr>
    </table>
</div>