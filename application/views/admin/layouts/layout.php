<!doctype html>
<html lang="ru">
<head>
    <base href="<?php echo base_url(); ?>">
    <meta charset="UTF-8">
    <title><?php echo (isset($title)) ? $title : $this->lang->line('page_title') ?></title>
    <?php echo (isset($css)) ? $css : '' ?>
    <?php echo (isset($js)) ? $js : '' ?>
    <script type="text/javascript">
        function digitalWatch() {
            var hours = moment().hour();
            var minutes = moment().minutes();
            var seconds = moment().seconds();
            var date = moment().locale('ru_RU').format('dddd, D MMMM YYYY');
            if (hours < 10) hours = "0" + hours;
            if (minutes < 10) minutes = "0" + minutes;
            if (seconds < 10) seconds = "0" + seconds;
            document.getElementById("digital_watch").innerHTML = hours + ":" + minutes + ":" + seconds;
            document.getElementById("date_time").innerHTML = date;
            setTimeout("digitalWatch()", 1000);
        }
    </script>

</head>
<body onload="digitalWatch()">
<?php echo $content; ?>
<footer class="footer">
    <div class="uk-align-right" style="margin: 5px; padding: 0; color: #fff1f0">
        Время генерации страницы: {elapsed_time}
        Потребление памяти: {memory_usage}
    </div>
</footer>
<?php echo (isset($js_append)) ? $js_append : '' ?>
</body>
</html>
