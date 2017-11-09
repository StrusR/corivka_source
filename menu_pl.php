<!DOCTYPE html>
<html>
    <head>
        <?php require_once "blocks/head.php" ?>
        <link rel="stylesheet" href="style/menu.css">
        <title>Menu</title>
    </head>
    <body>
        <?php require_once "blocks/header_pl.php" ?>
        <article id = "wrapper">
            <div id = "leftCol">
                <div class="menuStyle">
                    Menu
                </div>
                <?php
                    $menuTypeHead = array();
                    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
                    $mysqli -> query ("SET NAMES 'utf8'");
                    $data_server = $mysqli -> query("SELECT `menuTypeHeadPl` FROM `Menu` ORDER BY (`globalSequence`+0) ASC");
                    while (($all = $data_server->fetch_assoc()) != false) {
                        if (!$menuTypeHead[$all['menuTypeHeadPl']]) {
                            $menuTypeHead[$all['menuTypeHeadPl']] = $all['menuTypeHeadPl'];
                        }
                    }
                    foreach ($menuTypeHead as $key => $value) {
                        echo "<div class='menuType'>";
                            echo "<div class='menuTypeHead'>";
                            echo $value;
                            echo "</div>";
                            $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
                            $mysqli -> query ("SET NAMES 'utf8'");
                            $data_server = $mysqli -> query("SELECT * FROM `Menu` WHERE `menuTypeHeadPl` = '$value' ORDER BY (`sequence`+0) ASC");
                            while (($all = $data_server->fetch_assoc()) != false) {
                            echo "<div class='menuTypeArticle'>";
                                echo "<div class='menuDishes'>";
                                    echo "<div class='menuDish'>";
                                        echo $all['menuDishPl'];
                                    echo "</div>";
                                    echo "<div class='menuIngradiends'>";
                                        echo $all['menuIngradiendsPl'];
                                    echo "</div>";
                                echo "</div>";
                                echo "<div class='menuWeight'>";
                                    echo $all['menuWeight'];
                                echo "</div>";
                                echo "<div class='menuPrice'>";
                                    echo $all['menuPrice'].".00 UAH";
                                echo "</div>";
                            echo "</div>";
                            }
                        echo "</div>";
                    }
                ?>  
            </div>    
            <?php require_once "blocks/rightCol_pl.php" ?>
        </article>
        <?php require_once "blocks/footer_pl.php" ?>
    </body>
</html>