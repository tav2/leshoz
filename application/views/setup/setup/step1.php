База данных установлена, записать конфиг файлы?
<form action="/eidos/setup/step/2" method="post">
    <input type="hidden" name="user" value="<?php echo $user ?>">
    <input type="hidden" name="pass" value="<?php echo $pass ?>">
    <input type="hidden" name="db" value="<?php echo $db ?>">
    <input type="submit" value="записать">
</form>