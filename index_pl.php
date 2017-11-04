<!DOCTYPE html>
<html>
    <head>
        <?php require_once "blocks/head.php" ?>
        <title>Główna</title>
    </head>
    <body>
    <div class="headerBefore">
        <div class="logo">
            <a href="/index_pl.php" title="Główna"><img src="../img/logo.jpg" alt="Główna"></a>
        </div>
        <div class="flags">
            <a href="/index.php"><img src="../img/ukraine.jpg" alt="ukraine language" title="Українська"></a>
            <a href="/index_en.php"><img src="../img/english.png" alt="english language" title="English"></a>
            <span class="hide"><a href="/index_pl.php"><img src="../img/poland.jpg" alt="poland language" title="Polski"></a></span>
        </div>
    </div>
        <?php require_once "blocks/header_pl.php" ?>
        <article id = "wrapper">
            <div id = "leftCol">
                <p>Tutaj możesz zapoznać się z historią naszej instytucji i dowiedzieć się więcej o niej</p>
            </div>
            <?php require_once "blocks/rightCol_pl.php" ?>
        </article>
        <?php require_once "blocks/footer_pl.php" ?>
    </body>
</html>