<header>
<?php
    echo "<div class='logo'>";
        echo "<a href='/index.php?language=".$_GET['language']."'><div>Główna</div></a>";
    echo "</div>";
    echo "<div class = 'menuHead'>";
        echo "<a href='/contacts.php?language=".$_GET['language']."'><div>Dane kontaktowe</div></a>";
    echo "</div>";
    echo "<div class = 'menuRestoran'>";
        echo "<div class='menu'><img src='https://image.flaticon.com/icons/png/512/60/60310.png'></div>";
        
        echo "<div>";
            echo "<a href='menu.php?language=".$_GET['language']."&type=Menu' class='menuList'><div>Menu</div></a>";
            echo "<a href='menu.php?language=".$_GET['language']."&type=AlcoholMenu' class='menuList'><div>Menu alkoholu</div></a>";
            echo "<a href='menu.php?language=".$_GET['language']."&type=BanquetMenu' style='display: none;' class='menuList'><div>Menu bankietowe</div></a>";
        echo "</div>";
        echo "<div class='MenuOnClick'>";
            echo "<a href='menu.php?language=".$_GET['language']."&type=Menu'><div>Menu</div></a>";
            echo "<a href='menu.php?language=".$_GET['language']."&type=AlcoholMenu'><div>Menu alkoholu</div></a>";
            echo "<a href='menu.php?language=".$_GET['language']."&type=BanquetMenu' style='display: none;'><div>Menu bankietowe</div></a>";
        echo "</div>";
        
    echo "</div>";
?>
</header>