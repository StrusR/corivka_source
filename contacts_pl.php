<!DOCTYPE html>
<html>
    <head>
        <?php require_once "blocks/head.php" ?>
        <link rel="stylesheet" href="style/contacts.css">
        <title>Kontakty</title>
    </head>
    <body>
    <div class="headerBefore">
        <div class="logo">
            <a href="/index_pl.php" title="Główna"><img src="../img/logo.jpg" alt="Główna"></a>
        </div>
        <div class="flags">
            <a href="/contacts.php"><img src="../img/ukraine.jpg" alt="ukraine language" title="Українська"></a>
            <a href="/contacts_en.php"><img src="../img/english.png" alt="english language" title="English"></a>
            <span class="hide"><a href="/contacts_pl.php"><img src="../img/poland.jpg" alt="poland language" title="Polski"></a></span>
        </div>
    </div>
        <?php require_once "blocks/header_pl.php" ?>
        <article id = "wrapper">
            <div id = "leftCol">
                <div class="phone">
                    <div>
                        Telefon:
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
                        Lwów, ul. Kopernik, 9
                    </div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2573.203178343053!2d24.025737100724342!3d49.838639749890866!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473add6e388ebf95%3A0x6bf9392bf7cfe0e5!2z0JzQvtC70L7Rh9C90LjQuSDQsdCw0YA!5e0!3m2!1suk!2sua!4v1507840888137" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
            <?php require_once "blocks/rightCol_pl.php" ?>
        </article>
        <?php require_once "blocks/footer_pl.php" ?>
    </body>
</html>