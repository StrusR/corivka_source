<!DOCTYPE html>
<?php
function getUrl() {
    $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
    $url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
    $url .= $_SERVER["REQUEST_URI"];
    return $url;
};
$my_url = getUrl();
session_start();
if ($_SESSION['ip']) {
    header("Location: http://corivka.com.ua/personal/user.php?ip=".$_SESSION['ip']);
} else if ($my_url != "http://corivka.com.ua/personal/login.php") {
    header("Location: http://corivka.com.ua/personal/login.php");
}
session_write_close();
?>
<html>
    <head>
        <?php require_once "blocks/head.php" ?>
        <link rel="stylesheet" href="style/form.css">
        <title>Вхід</title>
    </head>
    <body>
        <header class="header_log_reg">
            <div class="login_register">
                <a href="http://corivka.com.ua/personal/register.php">Зареєструватися</a>
            </div>
        </header>
        <article class="article_reg_log">
            <div class="display">
                Вхід
            </div>
            <div class="form">
                <label for="email_phone" id="lemail_phone">Логін</label><br>
                <input type="email" id="email_phone" name="email_phone" placeholder="Email/Phone"><br>
                <label for="password" id="lpassword">Пароль</label><br>
                <input type="password" id="password" name="password" placeholder="Password"><br>
                <input type="submit" name="log_submit" id="log_submit" class="form_submit" value="Увійти">
            </div>
        </article>
    </body>
</html>