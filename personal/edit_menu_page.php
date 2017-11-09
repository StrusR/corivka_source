<?php
    session_start();
    if (!$_SESSION['ip']) {
        header("Location: https://corivka.com.ua/personal/login.php");
    }
    session_write_close();
    // function getUrl() {
    //     $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
    //     $url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
    //     $url .= $_SERVER["REQUEST_URI"];
    //     return $url;
    // };
    // $my_url = getUrl();
    // if ($my_url == "https://corivka.com.ua/personal/user.php") {
    //     header("Location: https://corivka.com.ua/personal/user.php?ip=".$_SESSION['ip']);
    // };
    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
    $mysqli -> query ("SET NAMES 'utf8'");
    $data_server = $mysqli -> query("SELECT `access_rights` FROM `users` WHERE `ip` = '".$_SESSION['ip']."'");
    while (($all = $data_server->fetch_assoc()) != false) {
        if ($all['access_rights'] > 2){
            header("Location: https://corivka.com.ua/personal/user.php?ip=".$_SESSION['ip']);
        }
    };
?>
<html>
    <head>
        <?php require_once "../personal/blocks/head.php" ?>
        <link rel="stylesheet" href="style/edit_menu_page.css">
        <script type="text/javascript" src="/personal/js/edit_menu_page.js"></script>
        <title>edit menu page</title>
    </head>
    <body>
        <header class="user_header">
            <div class="my_initials">
                <a href="" class="my_snp">...</a>
            </div>
            <div class="edit_page">
                <a class="exit" href="https://corivka.com.ua/personal/login.php">Вихід</a>
                <a class="my_edit_page" href="https://corivka.com.ua/personal/my_edit_page.php">Редагувати профіль</a>
                <a class="users" href="https://corivka.com.ua/personal/users.php">Персонал</a>
                <a class="calendar" href="https://corivka.com.ua/personal/calendar.php?month=<?php echo date("m")."&year=".date("Y");?>">Календар</a>
                <?php
                    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
                    $mysqli -> query ("SET NAMES 'utf8'");
                    $data_server = $mysqli -> query("SELECT `access_rights` FROM `users` WHERE `ip` = '".$_SESSION['ip']."'");
                    while (($all = $data_server->fetch_assoc()) != false) {
                        if ($all['access_rights'] < 3){
                            echo "<div class='edit_site'>Редагувати сайт</div>";
                            echo "<div class='edit_site_type'>";
                                echo "<a class='edit_main_page' href='https://corivka.com.ua/personal/edit_main_page.php'>Редагувати \"Головна\"</a>";
                                echo "<a class='edit_contacts_page' href='https://corivka.com.ua/personal/edit_contacts_page.php'>Редагувати \"Контактні дані\"</a>";
                                echo "<div class='edit_menu'>Редагувати меню</div>";
                                echo "<div class='edit_menu_type'>";
                                    echo "<a class='edit_menu_page' href='https://corivka.com.ua/personal/edit_menu_page.php?menu=Menu'>Редагувати \"Меню\"</a>";
                                    echo "<a class='edit_menu_page' href='https://corivka.com.ua/personal/edit_menu_page.php?menu=AlcoholMenu'>Редагувати \"Алкогольне меню\"</a>";
                                    echo "<a class='edit_menu_page' href='https://corivka.com.ua/personal/edit_menu_page.php?menu=BanquetMenu'>Редагувати \"Банкетне меню\"</a>";
                                echo "</div>";
                            echo "</div>";
                        }
                    };
                ?>
            </div>

        </header>
        <article class = "egit_menu_page_article">


            <div class="menuStyle">
                <?php 
                    if ($_GET['menu'] == "Menu") {
                        echo "МЕНЮ";
                    } else if ($_GET['menu'] == "AlcoholMenu") {
                        echo "АЛКОГОЛЬНЕ МЕНЮ";
                    } else if ($_GET['menu'] == "BanquetMenu") {
                        echo "БАНКЕТНЕ МЕНЮ";
                    } else {
                        header("Location: https://corivka.com.ua/personal/edit_menu_page.php?menu=Menu");
                    }
                ?>
            </div>
            <?php
                $menuTypeHead = array();
                $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
                $mysqli -> query ("SET NAMES 'utf8'");

                $data_server = $mysqli -> query("SELECT * FROM `".$_GET['menu']."` ORDER BY (`globalSequence`+0) ASC");
                while (($all = $data_server->fetch_assoc()) != false) {
                    if (!$menuTypeHead[$all['menuTypeHeadUa']]) {
                        $menuTypeHead[$all['menuTypeHeadUa']] = $all['menuTypeHeadUa'];
                    }
                }

                echo "<form name='test' action='/personal/base/edit_menu_page_base.php?menu=".$_GET['menu']."' method='post'>";
                    $iUa=0;
                    $iEn=0;
                    $iPl=0;
                    $ShowHide = 0;
                    echo "<div class='menuTypeHead'>";
                        foreach ($menuTypeHead as $key => $value) {
                            echo "<div class='ShowHide' data-rel='#ShowHideBlock".$ShowHide."'>".$value."</div>";
                            $ShowHide++;
                        }
                        echo "<div class='ShowHide' data-rel='#ShowHideBlock".$ShowHide."'>ДОДАТИ ПІДМЕНЮ</div>";
                        
                    echo "</div>";
                    echo "<input class='save' type='submit' value='ЗБЕРЕГТИ'>";
                    $ShowHide = 0;
                    foreach ($menuTypeHead as $key => $value) {
                    
                        echo "<div class='ShowHideBlock' id='ShowHideBlock".$ShowHide."'>";
                            $ShowHide++;
                            $data_server = $mysqli -> query("SELECT * FROM `".$_GET['menu']."` WHERE `menuTypeHeadUa` = '$value'");
                            $auditUa = true;
                            $auditEn = true;
                            $auditPl = true;
                            
                            while (($all = $data_server->fetch_assoc()) != false) {
                                if ($auditUa == true) {
                                    echo "<input type='text' placeholder='Назва підменю Українською' class='menuTypeHeadInput' name='menuTypeHeadUa".$iUa."' value='".$all['menuTypeHeadUa']."'>";
                                    $iUa++;
                                    $auditUa = false;
                                }
                                if ($auditEn == true) {
                                    echo "<input type='text' placeholder='Назва підменю Англійською' class='menuTypeHeadInput' name='menuTypeHeadEn".$iEn."' value='".$all['menuTypeHeadEn']."'>";
                                    $iEn++;
                                    $auditEn = false;
                                }
                                if ($auditPl == true) {
                                    echo "<input type='text' placeholder='Назва підменю Польською' class='menuTypeHeadInput' name='menuTypeHeadPl".$iPl."' value='".$all['menuTypeHeadPl']."'>";
                                    echo "<input type='text' placeholder='Порядок відображення підменю' class='menuTypeHeadInput' name='globalSequence".$iPl."' value='".$all['globalSequence']."'>";
                                    $iPl++;
                                    $auditPl = false;
                                }
                            }
                            $newSequenceInp;
                            $data_server = $mysqli -> query("SELECT * FROM `".$_GET['menu']."` WHERE `menuTypeHeadUa` = '$value' ORDER BY (`sequence`+0) ASC");
                            while (($all = $data_server->fetch_assoc()) != false) {
                                echo "<input type='text' placeholder='Назва страви Українською' class='menuDishInput' name='menuDishUa".$all['id']."' value='".$all['menuDishUa']."'>";
                                echo "<input type='text' placeholder='Інградієнти Українською' class='menuIngradiendsInput' name='menuIngradiendsUa".$all['id']."' value='".$all['menuIngradiendsUa']."'>";
                                echo "<input type='text' placeholder='Назва страви Англійською' class='menuDishInput' name='menuDishEn".$all['id']."' value='".$all['menuDishEn']."'>";
                                echo "<input type='text' placeholder='Інградієнти Англійською' class='menuIngradiendsInput' name='menuIngradiendsEn".$all['id']."' value='".$all['menuIngradiendsEn']."'>";
                                echo "<input type='text' placeholder='Назва страви Польською' class='menuDishInput' name='menuDishPl".$all['id']."' value='".$all['menuDishPl']."'>";
                                echo "<input type='text' placeholder='Інградієнти Польською' class='menuIngradiendsInput' name='menuIngradiendsPl".$all['id']."' value='".$all['menuIngradiendsPl']."'>";
                                echo "<input type='text' placeholder='Вихід страви' class='menuWeightInput' name='menuWeight".$all['id']."' value='".$all['menuWeight']."'>";
                                echo "<input type='text' placeholder='Ціна' class='menuPriceInput' name='menuPrice".$all['id']."' value='".$all['menuPrice']."'>";
                                echo "<input type='text' placeholder='Порядок відображення' class='SequenceInput' name='Sequence".$all['id']."' value='".$all['sequence']."'>";
                                $newSequenceInp = ($all['sequence'] + 1);
                            }
                            echo "<input type='text' placeholder='Назва страви Українською' class='menuDishInput' name='newMenuDishUa".($iUa-1)."'>";
                            echo "<input type='text' placeholder='Інградієнти Українською' class='menuIngradiendsInput' name='newMenuIngradiendsUa".($iUa-1)."'>";
                            echo "<input type='text' placeholder='Назва страви Англійською' class='menuDishInput' name='newMenuDishEn".($iUa-1)."'>";
                            echo "<input type='text' placeholder='Інградієнти Англійською' class='menuIngradiendsInput' name='newMenuIngradiendsEn".($iUa-1)."'>";
                            echo "<input type='text' placeholder='Назва страви Польською' class='menuDishInput' name='newMenuDishPl".($iUa-1)."'>";
                            echo "<input type='text' placeholder='Інградієнти Польською' class='menuIngradiendsInput' name='newMenuIngradiendsPl".($iUa-1)."'>";
                            echo "<input type='text' placeholder='Вихід страви' class='menuWeightInput' name='newMenuWeight".($iUa-1)."'>";
                            echo "<input type='text' placeholder='Ціна' class='menuPriceInput' name='newMenuPrice".($iUa-1)."'>";
                            echo "<input type='text' placeholder='Порядок відображення' class='SequenceInput' name='newSequence".($iUa-1)."' value='".$newSequenceInp."'>";

                        echo "</div>";
                        
                    }
                    echo "<div class='ShowHideBlock' style='display: block' id='ShowHideBlock".$ShowHide."'>";
                        echo "<input type='text' placeholder='Назва підменю Українською' class='menuTypeHeadInput' name='newMenuTypeHeadUa'>";
                        echo "<input type='text' placeholder='Назва підменю Англійською' class='menuTypeHeadInput' name='newMenuTypeHeadEn'>";
                        echo "<input type='text' placeholder='Назва підменю Польською' class='menuTypeHeadInput' name='newMenuTypeHeadPl'>";
                        echo "<input type='text' placeholder='Порядок відображення в підменю' class='menuTypeHeadInput' name='newGlobalSequence' value='".(count($menuTypeHead) + 1)."'>";
                        echo "<input type='text' placeholder='Назва страви Українською' class='menuDishInput' name='newMenuDishUa'>";
                        echo "<input type='text' placeholder='Інградієнти Українською' class='menuIngradiendsInput' name='newMenuIngradiendsUa'>";
                        echo "<input type='text' placeholder='Назва страви Англійською' class='menuDishInput' name='newMenuDishEn'>";
                        echo "<input type='text' placeholder='Інградієнти Англійською' class='menuIngradiendsInput' name='newMenuIngradiendsEn'>";
                        echo "<input type='text' placeholder='Назва страви Польською' class='menuDishInput' name='newMenuDishPl'>";
                        echo "<input type='text' placeholder='Інградієнти Польською' class='menuIngradiendsInput' name='newMenuIngradiendsPl'>";
                        echo "<input type='text' placeholder='Вихід страви' class='menuWeightInput' name='newMenuWeight'>";
                        echo "<input type='text' placeholder='Ціна' class='menuPriceInput' name='newMenuPrice'>";
                        echo "<input type='text' placeholder='Порядок відображення' class='SequenceInput' name='newSequence' value='1'>";
                    echo "</div>";
                    echo "<input class='save' type='submit' value='ЗБЕРЕГТИ'>";
                echo "</form>";
            ?>   
        </article>
    </body>
</html>