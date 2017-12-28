<!DOCTYPE html>
<html>
    <head>
        <?php
            require_once "blocks/head.php";
            if ($_GET['language'] == "Ua") {
                echo "<title>Кафе \"Корівка\"</title>";
                echo "<meta name=\"description\" content=\"Кафе \"Корівка\" Львів\">";
            } else if ($_GET['language'] == "En") {
                echo "<title>Main</title>";
                echo "<meta name=\"description\" content=\"Cafe \"Corivka\" Lviv\">";
            } else if ($_GET['language'] == "Pl") {
                echo "<title>Główna</title>";
                echo "<meta name=\"description\" content=\"Kawiarnia \"Corivka\" Lwów\">";
            }
        ?>
        <link rel="stylesheet" href="style/index.css">

    </head>
    <body>
        <div class="headerBefore">
            <div class="logo">
            <?php
                if ($_GET['language'] == "Ua") {
                    echo "<a href='/index.php?language=Ua' title='Головна'><img src='../img/logo.png' alt='Головна'></a>";
                } else if ($_GET['language'] == "En") {
                    echo "<a href='/index.php?language=En' title='Main'><img src='../img/logo.png' alt='Main'></a>";
                } else if ($_GET['language'] == "Pl") {
                    echo "<a href='/index.php?language=Pl' title='Główna'><img src='../img/logo.png alt='Główna'></a>";
                } else {
                    header("Location: https://corivka.com.ua/index.php?language=Ua");
                }
            ?>
            </div>
            <div class="flags">
                <a href="/index.php?language=Ua"><img src="../img/ukraine.jpg" alt="ukraine language" title="Українська"></a>
                <a href="/index.php?language=En"><img src="../img/english.png" alt="english language" title="English" class='hide'></a>
                <a href="/index.php?language=Pl"><img src="../img/poland.jpg" alt="poland language" title="Polski" class='hide'></a>
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
                <h2 class="menuStyle">
                    <?php
                    if ($_GET['language'] == "Ua") {
                        echo "Кафе \"Корівка\"";
                    } else if ($_GET['language'] == "En") {
                        echo "Cafe \"Corivka\"";
                    } else if ($_GET['language'] == "Pl") {
                        echo "Kawiarnia \"Corivka \"";
                    }
                    ?>
                </h2>
                <?php
                    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
                    $mysqli -> query ("SET NAMES 'utf8'");
                    $data_server = $mysqli -> query("SELECT * FROM `Main` ORDER BY (`sequence`+0) ASC");
                    while (($all = $data_server->fetch_assoc()) != false) {
                        if ($all['type'] == "paragraph") {
                            echo "<p class='paragraph'>".$all['paragraph'.$_GET['language'].'']."</p>";
                        } else {
                            echo "<img src='/personal/base/main/".$all['image']."' alt='".$all['alt']."' width='".$all['width']."%' style='float: ".$all['imageFloat'].";'>";
                        }
                    }
                ?>
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