<!doctype html>
<html lang="ru">
<head>
    <base href="<?php echo base_url(); ?>">
    <meta charset="UTF-8">
    <title><?php echo (isset($title)) ? $title : $this->lang->line('page_title') ?></title>
    <?php echo (isset($css)) ? $css : '' ?>
    <?php echo (isset($js)) ? $js : '' ?>
</head>
<body>
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
