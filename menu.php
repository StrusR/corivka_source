<?php
if ($_GET['language'] == "Ua" || $_GET['language'] == "En" || $_GET['language'] == "Pl") {
    if ($_GET['type'] == "Menu" || $_GET['type'] == "AlcoholMenu" || $_GET['type'] == "BanquetMenu") {
            
    } else {
    header("Location: https://corivka.com.ua/menu.php?language=".$_GET['language']."&type=Menu");
    }
} else{
    header("Location: https://corivka.com.ua/menu.php?language=Ua&type=".$_GET['type']);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once "blocks/head.php" ?>
        <link rel="stylesheet" href="style/menu.css">
        <?php
            echo "<title>".$_GET['type']."</title>";
        ?>
    </head>
    <body>
        <?php
            echo "<div class='headerBefore'>";
                echo "<div class='logo'>";
                    if ($_GET['language'] == "Ua") {
                        echo "<a href='/index.php?language=Ua' title='Головна'><img src='../img/logo.jpg' alt='Головна'></a>";
                    } else if ($_GET['language'] == "En") {
                        echo "<a href='/index.php?language=En' title='Main'><img src='../img/logo.jpg' alt='Main'></a>";
                    } else if ($_GET['language'] == "Pl") {
                        echo "<a href='/index.php?language=Pl' title='Główna'><img src='../img/logo.jpg' alt='Główna'></a>";
                    } else {
                        header("Location: https://corivka.com.ua/menu.php?language=Ua&type=".$_GET['type']);
                    }
                    
                echo "</div>";
                echo "<div class='flags'>";
                    echo "<a href='/menu.php?language=Ua&type=".$_GET['type']."'><img src='../img/ukraine.jpg' alt='ukraine language' title='Українська'></a>";
                    echo "<a href='/menu.php?language=En&type=".$_GET['type']."'><img src='../img/english.png' alt='english language' title='English'></a>";
                    echo "<a href='/menu.php?language=Pl&type=".$_GET['type']."'><img src='../img/poland.jpg' alt='poland language' title='Polski'></a>";
                echo "</div>";
            echo "</div>";

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
                <div class="menuStyle">
                    <?php
                    if ($_GET['language'] == "Ua") {
                        if ($_GET['type'] == "Menu") {
                            echo "Меню";
                        } else if ($_GET['type'] == "AlcoholMenu") {
                            echo "Алкогольне меню";
                        } else if ($_GET['type'] == "BanquetMenu") {
                            echo "Банкетне меню";
                        }
                    } else if ($_GET['language'] == "En") {
                        if ($_GET['type'] == "Menu") {
                            echo "Menu";
                        } else if ($_GET['type'] == "AlcoholMenu") {
                            echo "Alcohol menu";
                        } else if ($_GET['type'] == "BanquetMenu") {
                            echo "Banquet menu";
                        }
                    } else if ($_GET['language'] == "Pl") {
                        if ($_GET['type'] == "Menu") {
                            echo "Menu";
                        } else if ($_GET['type'] == "AlcoholMenu") {
                            echo "Menu alkoholu";
                        } else if ($_GET['type'] == "BanquetMenu") {
                            echo "Menu bankietowe";
                        }
                    }
                    ?>
                </div>
                <?php
                    $menuTypeHead = array();
                    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
                    $mysqli -> query ("SET NAMES 'utf8'");

                    $data_server = $mysqli -> query("SELECT `menuTypeHead".$_GET['language']."` FROM `".$_GET['type']."` ORDER BY (`globalSequence`+0) ASC");
                    while (($all = $data_server->fetch_assoc()) != false) {
                        if (!$menuTypeHead[$all['menuTypeHead'.$_GET['language']]]) {
                            $menuTypeHead[$all['menuTypeHead'.$_GET['language']]] = $all['menuTypeHead'.$_GET['language']];
                        }
                    }
                    foreach ($menuTypeHead as $key => $value) {
                        echo "<div class='menuType'>";
                            echo "<div class='menuTypeHead'>";
                            echo $value;
                            echo "</div>";
                            $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
                            $mysqli -> query ("SET NAMES 'utf8'");
                            $data_server = $mysqli -> query("SELECT * FROM `".$_GET['type']."` WHERE `menuTypeHead".$_GET['language']."` = '$value' ORDER BY (`sequence`+0) ASC");
                            while (($all = $data_server->fetch_assoc()) != false) {
                            echo "<div class='menuTypeArticle'>";
                                echo "<div class='menuDishes'>";
                                    echo "<div class='menuDish'>";
                                        echo $all['menuDish'.$_GET['language']];
                                    echo "</div>";
                                    echo "<div class='menuIngradiends'>";
                                        echo $all['menuIngradiends'.$_GET['language']];
                                    echo "</div>";
                                echo "</div>";
                                echo "<div class='menuWeight'>";
                                    echo $all['menuWeight'];
                                echo "</div>";
                                echo "<div class='menuPrice'>";
                                    echo $all['menuPrice'];
                                    if ($_GET['language'] == "Ua") {
                                        echo " грн";
                                    } else echo " UAH";
                                echo "</div>";
                            echo "</div>";
                            }
                        echo "</div>";
                    }
                ?>  
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