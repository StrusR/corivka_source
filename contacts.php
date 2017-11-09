<!DOCTYPE html>
<html>
    <head>
        <?php
            require_once "blocks/head.php";
            if ($_GET['language'] == "Ua") {
                echo "<title>Контакти</title>";
            } else if ($_GET['language'] == "En") {
                echo "<title>Contacts</title>";
            } else if ($_GET['language'] == "Pl") {
                echo "<title>Dane kontaktowe</title>";
            }
        ?>
        <link rel="stylesheet" href="style/contacts.css">
        
    </head>
    <body>
        <div class='headerBefore'>
            <div class='logo'>
                <?php
                if ($_GET['language'] == "Ua") {
                    echo "<a href='/index.php?language=Ua' title='Головна'><img src='../img/logo.jpg' alt='Головна'></a>";
                } else if ($_GET['language'] == "En") {
                    echo "<a href='/index.php?language=Ua' title='Main'><img src='../img/logo.jpg' alt='Main'></a>";
                } else if ($_GET['language'] == "Pl") {
                    echo "<a href='/index.php?language=Ua' title='Główna'><img src='../img/logo.jpg' alt='Główna'></a>";
                } else {
                    header("Location: https://corivka.com.ua/contacts.php?language=Ua");
                }
                ?>
            </div>
            
            <div class='flags'>
                <a href='/contacts.php?language=Ua'><img src='../img/ukraine.jpg' alt='ukraine language' title='Українська'></a>
                <a href='/contacts.php?language=En'><img src='../img/english.png' alt='english language' title='English'></a>
                <a href='/contacts.php?language=Pl'><img src='../img/poland.jpg' alt='poland language' title='Polski'></a>
            </div>
        </div>
            <?php
            if ($_GET['language'] == "Ua") {
                require_once "blocks/header.php";
            } else if ($_GET['language'] == "En") {
                require_once "blocks/header_en.php";
            } else if ($_GET['language'] == "Pl") {
                require_once "blocks/header_pl.php";
            }
            ?>
        <article id = "wrapper">
            <div id = "leftCol">
                <div class="phone">
                    <div>
                        Телефон:
                    </div>
                    <div>
                        067 100 50 23
                    </div>
                </div>
                <div class="email">
                    <div>
                        Email:
                    </div>
                    <div>
                        korivka.cafe23@gmail.com
                    </div>
                </div>
                <div class="map">
                    <div class="address">
                        м. Львів, вул. Коперника, 9
                    </div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2573.203178343053!2d24.025737100724342!3d49.838639749890866!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473add6e388ebf95%3A0x6bf9392bf7cfe0e5!2z0JzQvtC70L7Rh9C90LjQuSDQsdCw0YA!5e0!3m2!1suk!2sua!4v1507840888137" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
            <?php
            if ($_GET['language'] == "Ua") {
                require_once "blocks/rightCol.php";
            } else if ($_GET['language'] == "En") {
                require_once "blocks/rightCol_en.php";
            } else if ($_GET['language'] == "Pl") {
                require_once "blocks/rightCol_pl.php";
            }
            ?>
        </article>
        <?php
        if ($_GET['language'] == "Ua") {
            require_once "blocks/footer.php";
        } else if ($_GET['language'] == "En") {
            require_once "blocks/footer_en.php";
        } else if ($_GET['language'] == "Pl") {
            require_once "blocks/footer_pl.php";
        }
        ?>
    </body>
</html>