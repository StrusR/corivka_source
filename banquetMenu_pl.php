<!DOCTYPE html>
<html>
    <head>
        <?php require_once "blocks/head.php" ?>
        <link rel="stylesheet" href="style/menu.css">
        <script type="text/javascript" src="JavaScript/register.js"></script>
        <title>Menu_Bankietowe</title>
    </head>
    <body>
    <div class="headerBefore">
        <div class="logo">
            <a href="/index_pl.php" title="Główna"><img src="../img/logo.jpg" alt="Główna"></a>
        </div>
        <div class="flags">
            <a href="/banquetMenu.php"><img src="../img/ukraine.jpg" alt="ukraine language" title="Українська"></a>
            <a href="/banquetMenu_en.php"><img src="../img/english.png" alt="english language" title="English"></a>
            <span class="hide"><a href="/banquetMenu_pl.php"><img src="../img/poland.jpg" alt="poland language" title="Polski"></a></span>
        </div>
    </div>
        <?php require_once "blocks/header_pl.php" ?>
        <article id = "wrapper">
            <div id = "leftCol">
                <div class="menuStyle">
                    Menu bankietowe
                </div>
                <div>
                    <div class="menuType">
                        <div class="menuTypeHead">
                            СНІДАНКИ
                        </div>
                            <div class="menuTypeArticle">
                            <div class="menuDishes">
                                <div class="menuDish">
                                    Омлет класичний або з цибулею
                                </div>
                                <div class="menuIngradiends">
                                    з двох яєць, молоко, сіль, перець ч/м
                                </div>
                            </div>
                            <div class="menuWeight">
                                100/120
                            </div>
                            <div class="menuPrice">
                                22.00
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once "blocks/rightCol_pl.php" ?>
        </article>
        <?php require_once "blocks/footer_pl.php" ?>
    </body>
</html>