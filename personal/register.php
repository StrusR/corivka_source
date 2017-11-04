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
} else if ($my_url != "http://corivka.com.ua/personal/register.php") {
    header("Location: http://corivka.com.ua/personal/register.php");
}
session_write_close();
?>
<html>
    <head>
        <?php require_once "blocks/head.php" ?>
        <link rel="stylesheet" href="style/form.css">
        <title>Реєстрація</title>
    </head>
    <body>
        <header class="header_log_reg">
            <div class="login_register">
                <a href="http://corivka.com.ua/personal/login.php">Увійти</a>
            </div>
        </header>
        <article class="article_reg_log">
            <div class="display">
                Реєстрація
            </div>
            <div class="form">
                <label for="email" id="lemail">Логін</label><br>
                <input type="email" id="email" name="email" placeholder="Email"><br>
                <label for="surname" id="lsurname">Прізвище</label><br>
                <input type="text" id="surname" name="surname" placeholder="Surname"><br>
                <label for="name" id="lname">Ім'я</label><br>
                <input type="text" id="name" name="name" placeholder="Name"><br>
                <label for="patronymic" id="lpatronymic">По батькові</label><br>
                <input type="text" id="patronymic" name="patronymic" placeholder="Patronymic"><br>
                <label for="phone" id="lphone">Номер телефону</label><br>
                <input type="number" id="phone" name="phone" placeholder="Phone"><br>
                <label for="password" id="lpassword">Пароль</label><br>
                <input type="password" id="password" name="password" placeholder="Password"><br>
                <label for="repassword" id="lrepassword">Повторіть пароль</label><br>
                <input type="password" id="repassword" name="repassword" placeholder="Password"><br>
                <input type="submit" name="reg_submit" id="reg_submit" class="form_submit" value="Зареєстуватися">
            </div>
        </article>
    </body>
</html>