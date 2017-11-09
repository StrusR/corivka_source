<!DOCTYPE html>
<html>
    <head>
        <?php require_once "blocks/head.php" ?>
        <link rel="stylesheet" href="style/menu.css">
        <script type="text/javascript" src="JavaScript/register.js"></script>
        <title>Банкетне_Меню</title>
    </head>
    <body>
        <div class="headerBefore">
            <div class="logo">
                <a href="/index.php" title="Головна"><img src="../img/logo.jpg" alt="Головна"></a>
            </div>
            <div class="flags">
                <a href="/banquetMenu.php?language=Ua"><img src="../img/ukraine.jpg" alt="ukraine language" title="Українська"></a>
                <a href="/banquetMenu.php?language=En"><img src="../img/english.png" alt="english language" title="English"></a>
                <a href="/banquetMenu.php?language=Pl"><img src="../img/poland.jpg" alt="poland language" title="Polski"></a>
            </div>
        </div>
        <?php require_once "blocks/header.php" ?>
        <article id = "wrapper">
            <div id = "leftCol">
                <div class="menuStyle">
                    Банкетне меню
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
            <?php require_once "blocks/rightCol.php" ?>
        </article>
        <?php require_once "blocks/footer.php" ?>
    </body>
</html>