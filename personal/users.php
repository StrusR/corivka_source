<!DOCTYPE html>
<?php
    session_start();
    if (!$_SESSION['ip']) {
        header("Location: http://corivka.com.ua/personal/login.php");
    }
    session_write_close();
    function getUrl() {
        $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
        $url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
        $url .= $_SERVER["REQUEST_URI"];
        return $url;
    };
    $my_url = getUrl();
    if ($my_url != "http://corivka.com.ua/personal/users.php?ip=".$_SESSION['ip']) {
        header("Location: http://corivka.com.ua/personal/users.php?ip=".$_SESSION['ip']);
    };
?>
<html>
    <head>
        <?php require_once "blocks/head.php" ?>
        <link rel="stylesheet" href="style/users.css">
        <script type="text/javascript" src="/personal/js/users.js"></script>
        <title>Працівники</title>
    </head>
    <body>
        <header class="user_header">
            <div class="my_initials">
                <a href="" class="my_snp">...</a>
            </div>
            <div class="edit_page">
                <a class="exit" href="http://corivka.com.ua/personal/login.php">Вихід</a>
                <a class="my_edit_page" href="http://corivka.com.ua/personal/my_edit_page.php">Редагувати профіль</a>
                <a class="calendar" href="http://corivka.com.ua/personal/calendar.php?month=<?php echo date("m")."&year=".date("Y");?>">Календар</a>
                <div class="edit_site">Редагувати сайт</div>
                <div class="edit_site_menu">
                    <a class="edit_main_page" href="http://corivka.com.ua/personal/edit_main_page.php">Редагувати "Головна"</a>
                    <a class="edit_contacts_page" href="http://corivka.com.ua/personal/edit_contacts_page.php">Редагувати "Контактні дані"</a>
                    <a class="edit_menu_page" href="http://corivka.com.ua/personal/edit_menu_page.php">Редагувати "Меню"</a>
                </div>
            </div>

        </header>
        <article class="users_article">
            <div class="users">
<?php
    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
    $mysqli -> query ("SET NAMES 'utf8'");

    $data_server = $mysqli -> query("SELECT * FROM `users` WHERE `ip` != '".$_SESSION['ip']."'");
    while (($all = $data_server->fetch_assoc()) != false) {
        $access_rights;
        if ($all['access_rights'] == 1) {
            $access_rights = "(Директор)";
        } else if ($all['access_rights'] == 2) {
            $access_rights = "(Адміністрарор)";
        } else {
            $access_rights = "(Працівник)";
        }
        // echo "<a class='users_img' href='http://corivka.com.ua/personal/user.php?ip=".$all['ip']."'><img alt='Фото не має'></img></a>";
        echo "<a class='users_initials' href='http://corivka.com.ua/personal/user.php?ip=".$all['ip']."'>".$all['surname']." ".$all['name']." ".$all['patronymic']." ".$access_rights."</a>";
        echo "<br>";
    };

    $mysqli->close ();
?>
            </div>
            <div class="users_sort">

            </div>
        </article>
    </body>
</html>