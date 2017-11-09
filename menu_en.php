<!DOCTYPE html>
<html>
    <head>
        <?php require_once "blocks/head.php" ?>
        <link rel="stylesheet" href="style/menu.css">
        <title>Menu</title>
    </head>
    <body>
        <?php require_once "blocks/header_en.php" ?>
        <article id = "wrapper">
            <div id = "leftCol">
                <div class="menuStyle">
                    Menu
                </div>
                <?php
                    $menuTypeHead = array();
                    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
                    $mysqli -> query ("SET NAMES 'utf8'");
                    $data_server = $mysqli -> query("SELECT `menuTypeHeadEn` FROM `Menu` ORDER BY (`globalSequence`+0) ASC");
                    while (($all = $data_server->fetch_assoc()) != false) {
                        if (!$menuTypeHead[$all['menuTypeHeadEn']]) {
                            $menuTypeHead[$all['menuTypeHeadEn']] = $all['menuTypeHeadEn'];
                        }
                    }
                    foreach ($menuTypeHead as $key => $value) {
                        echo "<div class='menuType'>";
                            echo "<div class='menuTypeHead'>";
                            echo $value;
                            echo "</div>";
                            $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
                            $mysqli -> query ("SET NAMES 'utf8'");
                            $data_server = $mysqli -> query("SELECT * FROM `Menu` WHERE `menuTypeHeadEn` = '$value' ORDER BY (`sequence`+0) ASC");
                            while (($all = $data_server->fetch_assoc()) != false) {
                            echo "<div class='menuTypeArticle'>";
                                echo "<div class='menuDishes'>";
                                    echo "<div class='menuDish'>";
                                        echo $all['menuDishEn'];
                                    echo "</div>";
                                    echo "<div class='menuIngradiends'>";
                                        echo $all['menuIngradiendsEn'];
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
        </div>
            <?php require_once "blocks/rightCol_en.php" ?>
        </article>
        <?php require_once "blocks/footer_en.php" ?>
    </body>
</html>