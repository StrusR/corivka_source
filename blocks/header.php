<header>
<?php
    echo "<div class='logo'>";
        echo "<a href='/index.php?language=".$_GET['language']."'><div>Головна</div></a>";
    echo "</div>";
    echo "<div class = 'menuHead'>";
        echo "<a href='/contacts.php?language=".$_GET['language']."' alt='Кафе корівка контактні дані, контакти'><div>Контактні дані</div></a>";
    echo "</div>";
    echo "<div class = 'menuRestoran'>";
        echo "<div class='menu'><img src='https://image.flaticon.com/icons/png/512/60/60310.png'></div>";
        
        echo "<div>";
            echo "<a href='menu.php?language=".$_GET['language']."&type=Menu' class='menuList' alt='Кафе корівка меню'><div>Меню</div></a>";
            echo "<a href='menu.php?language=".$_GET['language']."&type=AlcoholMenu' class='menuList' alt='Кафе корівка алкогольне меню'><div>Алкогольне меню</div></a>";
            echo "<a href='menu.php?language=".$_GET['language']."&type=BanquetMenu' style='display: none;' class='menuList' alt='Кафе корівка банкетне меню'><div>Банкетне меню</div></a>";
        echo "</div>";
        echo "<div class='MenuOnClick'>";
        echo "<a href='menu.php?language=".$_GET['language']."&type=Menu' class='menuList' alt='Кафе корівка меню'><div>Меню</div></a>";
        echo "<a href='menu.php?language=".$_GET['language']."&type=AlcoholMenu' class='menuList' alt='Кафе корівка алкогольне меню'><div>Алкогольне меню</div></a>";
        echo "<a href='menu.php?language=".$_GET['language']."&type=BanquetMenu' style='display: none;' class='menuList' alt='Кафе корівка банкетне меню'><div>Банкетне меню</div></a>";
        echo "</div>";
        
    echo "</div>";
?>
</header>

