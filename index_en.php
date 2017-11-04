<!DOCTYPE html>
<html>
    <head>
        <?php require_once "blocks/head.php" ?>
        <title>Main</title>
    </head>
    <body>
    <div class="headerBefore">
        <div class="logo">
            <a href="/index_en.php" title="Main"><img src="../img/logo.jpg" alt="Main"></a>
        </div>
        <div class="flags">
            <a href="/index.php"><img src="../img/ukraine.jpg" alt="ukraine language" title="Українська"></a>
            <a href="/index_en.php"><img src="../img/english.png" alt="english language" title="English"></a>
            <span class="hide"><a href="/index_pl.php"><img src="../img/poland.jpg" alt="poland language" title="Polski"></a></span>
        </div>
    </div>
        <?php require_once "blocks/header_en.php" ?>
        <article id = "wrapper">
            <div id = "leftCol">
                <p>Here you can get acquainted with the history of our institution and learn more about it</p>
            </div>
            <?php require_once "blocks/rightCol_en.php" ?>
        </article>
        <?php require_once "blocks/footer_en.php" ?>
    </body>
</html>