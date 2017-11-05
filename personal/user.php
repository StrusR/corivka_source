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
    if ($my_url == "http://corivka.com.ua/personal/user.php") {
        header("Location: http://corivka.com.ua/personal/user.php?ip=".$_SESSION['ip']);
    };
?>
<html>
    <head>
        <?php require_once "blocks/head.php" ?>
        <link rel="stylesheet" href="style/user.css">
        <script type="text/javascript" src="/personal/js/user.js"></script>
        <title>user</title>
    </head>
    <body>
        <header class="user_header">
            <div class="my_initials">
                <a href="" class="my_snp">...</a>
            </div>
            <div class="edit_page">
                <a class="exit" href="http://corivka.com.ua/personal/login.php">Вихід</a>
                <a class="my_edit_page" href="http://corivka.com.ua/personal/my_edit_page.php">Редагувати профіль</a>
                <a class="users" href="http://corivka.com.ua/personal/users.php">Працівники</a>
                <a class="calendar" href="http://corivka.com.ua/personal/calendar.php?month=<?php echo date("m")."&year=".date("Y");?>">Календар</a>
                <div class="edit_site">Редагувати сайт</div>
                <div class="edit_site_menu">
                    <a class="edit_main_page" href="http://corivka.com.ua/personal/edit_main_page.php">Редагувати "Головна"</a>
                    <a class="edit_contacts_page" href="http://corivka.com.ua/personal/edit_contacts_page.php">Редагувати "Контактні дані"</a>
                    <a class="edit_menu_page" href="http://corivka.com.ua/personal/edit_menu_page.php">Редагувати "Меню"</a>
                </div>
            </div>

        </header>
        <article class="user_article">
            <div class="user_initials">
                <a href="" class="user_snp">...</a>
            </div>
            <div class="user_phone">
                
            </div>
            <div class="user_email">
                
            </div>
            <div class="user_img">
                <img class="user_avatar" src="" alt="Фото не має">
            </div>
            <?php
                $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
                $mysqli -> query ("SET NAMES 'utf8'");
                $data_server = $mysqli -> query("SELECT `access_rights` FROM `users` WHERE `ip` = '".$_SESSION['ip']."'");
                while (($all = $data_server->fetch_assoc()) != false) {
                    if ($all['access_rights'] == 1){
                        echo "<div class='edit_access_rights_button'></div>"; 
                        echo "<div class='delete_user_button'>Видалити аккаунт</div>";
                    }
                };
            
            ?>
            
        </article>
    </body>
</html>