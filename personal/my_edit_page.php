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
    if ($my_url != "http://corivka.com.ua/personal/my_edit_page.php?ip=".$_SESSION['ip']) {
        header("Location: http://corivka.com.ua/personal/my_edit_page.php?ip=".$_SESSION['ip']);
    };
?>
<html>
    <head>
        <?php require_once "blocks/head.php" ?>
        <link rel="stylesheet" href="style/form.css">
        <script type="text/javascript" src="/personal/js/my_edit_page.js"></script>
        <title>Настройки</title>
    </head>
    <body>
        <header class="user_header">
            <div class="my_initials">
                <a href="" class="my_snp">...</a>
            </div>
            <div class="edit_page">
                <a class="exit" href="http://corivka.com.ua/personal/login.php">Вихід</a>
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
        <article class="article_reg_log">
        <div class="display">
            Налаштування облікового запису
        </div>
        <div class="form">
            <label for="email" id="lemail">Змінити логін</label><br>
            <input type="email" id="email" name="email" placeholder="Email"><br>
            <label for="surname" id="lsurname">Змінити прізвище</label><br>
            <input type="text" id="surname" name="surname" placeholder="Surname"><br>
            <label for="name" id="lname">Змінити ім'я</label><br>
            <input type="text" id="name" name="name" placeholder="Name"><br>
            <label for="patronymic" id="lpatronymic">Змінити по батькові</label><br>
            <input type="text" id="patronymic" name="patronymic" placeholder="Patronymic"><br>
            <label for="phone" id="lphone">Змінити номер телефону</label><br>
            <input type="number" id="phone" name="phone" placeholder="Phone"><br>
            <label for="oldpassword" id="loldpassword">Пароль</label><br>
            <input type="password" id="oldpassword" name="oldpassword" placeholder="Password"><br>
            <label for="newpassword" id="lnewpassword">Новий пароль</label><br>
            <input type="password" id="newpassword" name="newpassword" placeholder="Password"><br>
            <label for="newrepassword" id="lnewrepassword">Повторіть новий пароль</label><br>
            <input type="password" id="newrepassword" name="newrepassword" placeholder="Password"><br>
            <input type="submit" name="edit_page_submit" id="edit_page_submit" class="form_submit" value="Зберегти"><br>
            <input type="submit" name="delete_user_button" id="delete_user_button" class="form_submit" value="Видалити аккаунт">
        </div>
    </article>
    </body>
</html>