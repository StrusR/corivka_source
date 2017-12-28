<?php
function getUrl() {
    $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
    $url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
    $url .= $_SERVER["REQUEST_URI"];
    return $url;
};
$my_url = getUrl();
    session_start();
    if (!$_SESSION['ip']) {
        setcookie("page","$my_url",time()+3600 * 24 * 30);
        header("Location: https://corivka.com.ua/personal/login.php");
    }
    session_write_close();
    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
    $mysqli -> query ("SET NAMES 'utf8'");
    $data_server = $mysqli -> query("SELECT `access_rights` FROM `users` WHERE `ip` = '".$_SESSION['ip']."'");
    while (($all = $data_server->fetch_assoc()) != false) {
        if ($all['access_rights'] > 2){
            header("Location: https://corivka.com.ua/personal/user.php?ip=".$_SESSION['ip']);
        }
    };
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once "../personal/blocks/head.php" ?>
        <link rel="stylesheet" href="style/edit_main_page.css">
        <script type="text/javascript" src="/personal/js/edit_main_page.js"></script>
        <title>edit main page</title>
    </head>
    <body>
        <header class="user_header">
            <div class="my_initials">
            <?php
                $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
                $mysqli -> query ("SET NAMES 'utf8'");
                $data_server = $mysqli -> query("SELECT * FROM `users` WHERE `ip` = '".$_SESSION['ip']."'");
                while (($all = $data_server->fetch_assoc()) != false) {
                    if ($all['access_rights'] == 1) {
                        echo "<a href='https://corivka.com.ua/personal/user.php?ip=".$_SESSION['ip']."' class='my_snp'>".$all['surname']." ".$all['name']." (Директор)"."</a>";
                    } else if ($all['access_rights'] == 2) {
                        echo "<a href='https://corivka.com.ua/personal/user.php?ip=".$_SESSION['ip']."' class='my_snp'>".$all['surname']." ".$all['name']." (Адміністратор)"."</a>";
                    } else {
                        echo "<a href='https://corivka.com.ua/personal/user.php?ip=".$_SESSION['ip']."' class='my_snp'>".$all['surname']." ".$all['name']."</a>";
                    }
                    
                };
                ?>
            </div>
            <div class="edit_page">
                <a class="exit" href="https://corivka.com.ua/personal/login.php">Вихід</a>
                <a class="my_edit_page" href="https://corivka.com.ua/personal/my_edit_page.php">Редагувати профіль</a>
                <a class="users" href="https://corivka.com.ua/personal/users.php">Персонал</a>
                <a class="calendar" href="https://corivka.com.ua/personal/calendar.php?month=<?php echo date("m")."&year=".date("Y");?>">Календар</a>
                <?php
                    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
                    $mysqli -> query ("SET NAMES 'utf8'");
                    $data_server = $mysqli -> query("SELECT `access_rights` FROM `users` WHERE `ip` = '".$_SESSION['ip']."'");
                    while (($all = $data_server->fetch_assoc()) != false) {
                        if ($all['access_rights'] < 3){
                            echo "<div class='edit_site'>Редагувати сайт</div>";
                            echo "<div class='edit_site_type'>";
                                echo "<a class='edit_main_page' href='https://corivka.com.ua/personal/edit_main_page.php'>Редагувати \"Головна\"</a>";
                                echo "<a class='edit_contacts_page' href='https://corivka.com.ua/personal/edit_contacts_page.php'>Редагувати \"Контактні дані\"</a>";
                                echo "<div class='edit_menu'>Редагувати меню</div>";
                                echo "<div class='edit_menu_type'>";
                                    echo "<a class='edit_menu_page' href='https://corivka.com.ua/personal/edit_menu_page.php?menu=Menu'>Редагувати \"Меню\"</a>";
                                    echo "<a class='edit_menu_page' href='https://corivka.com.ua/personal/edit_menu_page.php?menu=AlcoholMenu'>Редагувати \"Алкогольне меню\"</a>";
                                    echo "<a class='edit_menu_page' href='https://corivka.com.ua/personal/edit_menu_page.php?menu=BanquetMenu'>Редагувати \"Банкетне меню\"</a>";
                                echo "</div>";
                            echo "</div>";
                        }
                    };
                ?>
            </div>

        </header>
        <article class="egit_main_page_article">
            <form name='test' action='/personal/base/edit_main_page_base.php' method='post' enctype='multipart/form-data'>
                <input class='save' type='submit' value='ЗБЕРЕГТИ'><br>
                <?php
                    $data_server = $mysqli -> query("SELECT * FROM `Main` ORDER BY (`sequence`+0) ASC");
                    while (($all = $data_server->fetch_assoc()) != false) {
                        if ($all['type'] == "paragraph") {
                            echo "<input type='text' placeholder='Порядок відображення на сторінці' class='' name='sequence".$all['id']."' value='".$all['sequence']."'>";
                            echo "<textarea placeholder='Український абзац' rows='4' name='paragraphUa".$all['id']."'>".$all['paragraphUa']."</textarea>";
                            echo "<textarea placeholder='Англійський абзац' rows='4' name='paragraphEn".$all['id']."'>".$all['paragraphEn']."</textarea>";
                            echo "<textarea placeholder='Польський абзац' rows='4' name='paragraphPl".$all['id']."'>".$all['paragraphPl']."</textarea>";
                        } else {
                            echo "<input type='text' placeholder='Порядок відображення на сторінці' name='sequence".$all['id']."' value='".$all['sequence']."'>";
                            echo "<img src='/personal/base/main/".$all['image']."' alt='".$all['alt']."' class='mainImage'>";
                            echo "<input type='text' placeholder='Опис фото (Важливо для пошукових роботів таких як \"Яндекс\", \"Google\" і тд. Збільшує ймовірність відображатись першими у списку сайтів)' title='Приклад: Великий зал кафе \"Корівка\"' name='alt".$all['id']."' value='".$all['alt']."'>";
                            echo "<input type='number' placeholder='Ширина у %' name='width".$all['id']."' value='".$all['width']."'>";
                            echo "<div class='radio'>Відображати ліворуч або праворуч</div>";
                            if ($all['imageFloat'] == "left") {
                                echo "<input type='radio' name='imageFloat".$all['id']."' value='left' checked>";
                            } else {
                                echo "<input type='radio' name='imageFloat".$all['id']."' value='left'>";
                            }
                            if ($all['imageFloat'] == "right") {
                                echo "<input type='radio' name='imageFloat".$all['id']."' value='right' checked>";
                            } else {
                                echo "<input type='radio' name='imageFloat".$all['id']."' value='right'>";
                            }
                        }
                    }
                ?>
                <div class="showAddParagraph">
                    Додати абзац
                </div>
                <div class="addParagraph">
                    <input type='text' placeholder='Порядок відображення на сторінці' name='newParagraphSequence'>
                    <textarea placeholder='Український абзац' rows='4' name='newParagraphUa'></textarea>
                    <textarea placeholder='Англійський абзац' rows='4' name='newParagraphEn'></textarea>
                    <textarea placeholder='Польський абзац' rows='4' name='newParagraphPl'></textarea>
                </div>
                <div class="showAddImage">
                    Додати фотографію
                </div>
                <div class="addImage">
                    <input type='text' placeholder='Порядок відображення на сторінці' name='newImageSequence'>
                    <input type="file" name="userfile"><br>
                    <input type='text' placeholder='Опис фото (Важливо для пошукових роботів таких як "Яндекс", "Google" і тд. Збільшує ймовірність відображатись першими у списку сайтів)' title='Приклад: Великий зал кафе "Корівка"' name='newAlt'>
                    <input type='number' placeholder='Ширина у %' name='newWidth'>
                    <div class='radio'>Відображати ліворуч або праворуч</div>
                    <input type='radio' name='newImageFloat' value='left' checked>
                    <input type='radio' name='newImageFloat' value='right'>
                </div>
            </form>
        </article>
    </body>
</html>