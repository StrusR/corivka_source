<!DOCTYPE html>
<html>
    <head>
        <?php
            require_once "blocks/head.php";
            if ($_GET['language'] == "Ua") {
                echo "<title>Кафе \"Корівка\"</title>";
            } else if ($_GET['language'] == "En") {
                echo "<title>Main</title>";
            } else if ($_GET['language'] == "Pl") {
                echo "<title>Główna</title>";
            }
        ?>
    </head>
    <body>
        <div class="headerBefore">
            <div class="logo">
            <?php
                if ($_GET['language'] == "Ua") {
                    echo "<a href='/index.php?language=Ua' title='Головна'><img src='../img/logo.jpg' alt='Головна'></a>";
                } else if ($_GET['language'] == "En") {
                    echo "<a href='/index.php?language=En' title='Main'><img src='../img/logo.jpg' alt='Main'></a>";
                } else if ($_GET['language'] == "Pl") {
                    echo "<a href='/index.php?language=Pl' title='Główna'><img src='../img/logo.jpg' alt='Główna'></a>";
                } else {
                    header("Location: https://corivka.com.ua/index.php?language=Ua");
                }
            ?>
            </div>
            <div class="flags">
                <a href="/index.php?language=Ua"><img src="../img/ukraine.jpg" alt="ukraine language" title="Українська"></a>
                <a href="/index.php?language=En"><img src="../img/english.png" alt="english language" title="English"></a>
                <a href="/index.php?language=Pl"><img src="../img/poland.jpg" alt="poland language" title="Polski"></a>
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
                <p>Тут ви можете ознайомитись з історією нашого закладу, та дізнатись про нього більше</p>
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