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
    // $my_url = getUrl();
    // if ($my_url == "http://corivka.com.ua/personal/calendar.php") {
    //     header("Location: http://corivka.com.ua/personal/calendar.php?moon=".date("m")."&year=".date("Y"));
    // };
    // $moon = $_GET['moon'];
    // $year = $_GET['year'];
?>
<html>
    <head>
        <?php require_once "blocks/head.php" ?>
        <link rel="stylesheet" href="style/edit_site.css">
        <script type="text/javascript" src="/personal/js/edit_site.js"></script>
        <title>Edit site</title>
    </head>
    <body>
        <header class="user_header">
            <div class="my_initials">
                <a href="" class="my_snp">...</a>
            </div>
            <div class="edit_page">
                <a class="exit" href="http://corivka.com.ua/personal/login.php">Вихід</a>
                <a class="my_edit_page" href="http://corivka.com.ua/personal/my_edit_page.php">Редагувати сторінку</a>
                <a class="users" href="http://corivka.com.ua/personal/users.php">Працівники</a>
                <a class="calendar" href="http://corivka.com.ua/personal/calendar.php?moon=<?php echo date("m")."&year=".date("Y");?>">Календар</a>
            </div>
        </header>
        <article class="calendar_article">
        
        </article>
    </body>
</html>