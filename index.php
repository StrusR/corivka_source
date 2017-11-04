<!DOCTYPE html>
<html>
    <head>
        <?php require_once "blocks/head.php" ?>
        <title>Кафе "Корівка"</title>
    </head>
    <body>
        <div class="headerBefore">
            <div class="logo">
                <a href="/index.php" title="Головна"><img src="../img/logo.jpg" alt="Головна"></a>
            </div>
            <div class="flags">
                <a href="/index.php"><img src="../img/ukraine.jpg" alt="ukraine language" title="Українська"></a>
                <a href="/index_en.php"><img src="../img/english.png" alt="english language" title="English"></a>
                <span class="hide"><a href="/index_pl.php"><img src="../img/poland.jpg" alt="poland language" title="Polski"></a></span>
            </div>
        </div>
        <?php require_once "blocks/header.php" ?>
        <article id = "wrapper">
            <div id = "leftCol">
                <p>Тут ви можете ознайомитись з історією нашого закладу, та дізнатись про нього більше</p>
            </div>
            <?php require_once "blocks/rightCol.php" ?>
        </article>
        <?php require_once "blocks/footer.php" ?>
    </body>
</html>