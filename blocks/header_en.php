<header>
<?php
    echo "<div class='logo'>";
        echo "<a href='/index.php?language=".$_GET['language']."'><div>Main</div></a>";
    echo "</div>";
    echo "<div class = 'menuHead'>";
        echo "<a href='/contacts.php?language=".$_GET['language']."'><div>Contacts</div></a>";
    echo "</div>";
    echo "<div class = 'menuRestoran'>";
        echo "<div class='menu'><img src='https://image.flaticon.com/icons/png/512/60/60310.png'></div>";
        
        echo "<div>";
            echo "<a href='menu.php?language=".$_GET['language']."&type=Menu' class='menuList'><div>Menu</div></a>";
            echo "<a href='menu.php?language=".$_GET['language']."&type=AlcoholMenu' class='menuList'><div>Alcohol menu</div></a>";
            echo "<a href='menu.php?language=".$_GET['language']."&type=BanquetMenu' style='display: none;' class='menuList'><div>Banquet menu</div></a>";
        echo "</div>";
        echo "<div class='MenuOnClick'>";
            echo "<a href='menu.php?language=".$_GET['language']."&type=Menu'><div>Menu</div></a>";
            echo "<a href='menu.php?language=".$_GET['language']."&type=AlcoholMenu'><div>Alcohol menu</div></a>";
            echo "<a href='menu.php?language=".$_GET['language']."&type=BanquetMenu' style='display: none;'><div>Banquet menu</div></a>";
        echo "</div>";
        
    echo "</div>";
?>
</header>