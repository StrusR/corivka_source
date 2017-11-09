<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $menuTypeHead = array();
    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
    $mysqli -> query ("SET NAMES 'utf8'");
    $data_server = $mysqli -> query("SELECT * FROM `".$_GET['menu']."` ORDER BY (`globalSequence`+0) ASC");
    while (($all = $data_server->fetch_assoc()) != false) {
        if (!$menuTypeHead[$all['menuTypeHeadUa']]) {
            $menuTypeHead[$all['menuTypeHeadUa']] = $all['menuTypeHeadUa'];
        }
    }

    $iUa=0;
    $iEn=0;
    $iPl=0;

    foreach ($menuTypeHead as $key => $value) {
        $auditUa = true;
        $auditEn = true;
        $auditPl = true;

        $menuTypeHeadUa;
        $menuTypeHeadEn;
        $menuTypeHeadPl;
        $globalSequence;

        $data_server = $mysqli -> query("SELECT * FROM `".$_GET['menu']."` WHERE `menuTypeHeadUa` = '$value'");
        while (($all = $data_server->fetch_assoc()) != false) {
            if ($auditUa == true) {
                if (!empty($_POST['menuTypeHeadUa'.$iUa])) {
                    $mysqli -> query("UPDATE `".$_GET['menu']."` SET `menuTypeHeadUa` = '".$_POST['menuTypeHeadUa'.$iUa]."' WHERE `".$_GET['menu']."`.`menuTypeHeadUa` = '".$all['menuTypeHeadUa']."'");
                    $menuTypeHeadUa = $all['menuTypeHeadUa'];
                    $iUa++;
                    $auditUa = false;
                } else {
                    $mysqli -> query("DELETE FROM `".$_GET['menu']."` WHERE `".$_GET['menu']."`.`menuTypeHeadUa` = '".$all['menuTypeHeadUa']."'");
                }
                
            }
            if ($auditEn == true) {
                if (!empty($_POST['menuTypeHeadEn'.$iEn])) {
                    $mysqli -> query("UPDATE `".$_GET['menu']."` SET `menuTypeHeadEn` = '".$_POST['menuTypeHeadEn'.$iEn]."' WHERE `".$_GET['menu']."`.`menuTypeHeadEn` = '".$all['menuTypeHeadEn']."'");
                    $menuTypeHeadEn = $all['menuTypeHeadEn'];
                    $iEn++;
                    $auditEn = false;
                } else {
                    $mysqli -> query("DELETE FROM `".$_GET['menu']."` WHERE `".$_GET['menu']."`.`menuTypeHeadEn` = '".$all['menuTypeHeadEn']."'");
                }
                
            }
            if ($auditPl == true) {
                if (!empty($_POST['menuTypeHeadPl'.$iPl])) {
                    $mysqli -> query("UPDATE `".$_GET['menu']."` SET `menuTypeHeadPl` = '".$_POST['menuTypeHeadPl'.$iPl]."' WHERE `".$_GET['menu']."`.`menuTypeHeadPl` = '".$all['menuTypeHeadPl']."'");
                    $mysqli -> query("UPDATE `".$_GET['menu']."` SET `globalSequence` = '".$_POST['globalSequence'.$iPl]."' WHERE `".$_GET['menu']."`.`menuTypeHeadUa` = '".$all['menuTypeHeadUa']."'");
                    $menuTypeHeadPl = $all['menuTypeHeadPl'];
                    $globalSequence = $all['globalSequence'];
                    $iPl++;
                    $auditPl = false;
                } else {
                    $mysqli -> query("DELETE FROM `".$_GET['menu']."` WHERE `".$_GET['menu']."`.`menuTypeHeadPl` = '".$all['menuTypeHeadPl']."'");
                }
                
            }
        }
        
        $data_server = $mysqli -> query("SELECT * FROM `".$_GET['menu']."` WHERE `menuTypeHeadUa` = '$value'");
        while (($all = $data_server->fetch_assoc()) != false) {
            if (!empty($_POST['menuDishUa'.$all['id']]) && !empty($_POST['menuDishEn'.$all['id']]) && !empty($_POST['menuDishPl'.$all['id']]) && !empty($_POST['menuPrice'.$all['id']])) {
                $mysqli -> query("UPDATE `".$_GET['menu']."` SET `menuDishUa` = '".$_POST['menuDishUa'.$all['id']]."' WHERE `".$_GET['menu']."`.`id` = '".$all['id']."'");
                $mysqli -> query("UPDATE `".$_GET['menu']."` SET `menuIngradiendsUa` = '".$_POST['menuIngradiendsUa'.$all['id']]."' WHERE `".$_GET['menu']."`.`id` = '".$all['id']."'");
                $mysqli -> query("UPDATE `".$_GET['menu']."` SET `menuDishEn` = '".$_POST['menuDishEn'.$all['id']]."' WHERE `".$_GET['menu']."`.`id` = '".$all['id']."'");
                $mysqli -> query("UPDATE `".$_GET['menu']."` SET `menuIngradiendsEn` = '".$_POST['menuIngradiendsEn'.$all['id']]."' WHERE `".$_GET['menu']."`.`id` = '".$all['id']."'");
                $mysqli -> query("UPDATE `".$_GET['menu']."` SET `menuDishPl` = '".$_POST['menuDishPl'.$all['id']]."' WHERE `".$_GET['menu']."`.`id` = '".$all['id']."'");
                $mysqli -> query("UPDATE `".$_GET['menu']."` SET `menuIngradiendsPl` = '".$_POST['menuIngradiendsPl'.$all['id']]."' WHERE `".$_GET['menu']."`.`id` = '".$all['id']."'");
                $mysqli -> query("UPDATE `".$_GET['menu']."` SET `menuWeight` = '".$_POST['menuWeight'.$all['id']]."' WHERE `".$_GET['menu']."`.`id` = '".$all['id']."'");
                $mysqli -> query("UPDATE `".$_GET['menu']."` SET `menuPrice` = '".$_POST['menuPrice'.$all['id']]."' WHERE `".$_GET['menu']."`.`id` = '".$all['id']."'");
                $mysqli -> query("UPDATE `".$_GET['menu']."` SET `sequence` = '".$_POST['Sequence'.$all['id']]."' WHERE `".$_GET['menu']."`.`id` = '".$all['id']."'");
            } else {
                $mysqli -> query("DELETE FROM `".$_GET['menu']."` WHERE `".$_GET['menu']."`.`id` = '".$all['id']."'");
            }
            
        }
        if ($_POST['newMenuDishUa'.($iUa-1)] && $_POST['newMenuDishEn'.($iUa-1)] && $_POST['newMenuDishPl'.($iUa-1)] && $_POST['newMenuWeight'.($iUa-1)] && $_POST['newMenuPrice'.($iUa-1)]) {
            $mysqli -> query("INSERT INTO `".$_GET['menu']."` (`menuTypeHeadUa`, `menuDishUa`, `menuIngradiendsUa`, `menuTypeHeadEn`, `menuDishEn`, `menuIngradiendsEn`, `menuTypeHeadPl`, `menuDishPl`, `menuIngradiendsPl`, `menuWeight`, `menuPrice`, `sequence`, `globalSequence`) VALUES ('".$menuTypeHeadUa."', '".$_POST['newMenuDishUa'.($iUa-1)]."', '".$_POST['newMenuIngradiendsUa'.($iUa-1)]."', '".$menuTypeHeadEn."', '".$_POST['newMenuDishEn'.($iUa-1)]."', '".$_POST['newMenuIngradiendsEn'.($iUa-1)]."', '".$menuTypeHeadPl."', '".$_POST['newMenuDishPl'.($iUa-1)]."', '".$_POST['newMenuIngradiendsPl'.($iUa-1)]."', '".$_POST['newMenuWeight'.($iUa-1)]."', '".$_POST['newMenuPrice'.($iUa-1)]."', '".$_POST['newSequence'.($iUa-1)]."', '".$globalSequence."')");
        }
    }
    $data_server = $mysqli -> query("SELECT * FROM `".$_GET['menu']."` WHERE `menuTypeHeadUa` = '".$_POST['newMenuTypeHeadUa']."' || `menuTypeHeadEn` = '".$_POST['newMenuTypeHeadEn']."' || `menuTypeHeadPl` = '".$_POST['newMenuTypeHeadPl']."'");
    if ($data_server->num_rows == 0) {
        if ($_POST['newMenuTypeHeadUa'] && $_POST['newMenuTypeHeadEn'] && $_POST['newMenuTypeHeadPl'] && $_POST['newMenuDishUa'] && $_POST['newMenuDishEn'] && $_POST['newMenuDishPl'] && $_POST['newMenuWeight'] && $_POST['newMenuPrice']) {
            $mysqli -> query("INSERT INTO `".$_GET['menu']."` (`menuTypeHeadUa`, `menuDishUa`, `menuIngradiendsUa`, `menuTypeHeadEn`, `menuDishEn`, `menuIngradiendsEn`, `menuTypeHeadPl`, `menuDishPl`, `menuIngradiendsPl`, `menuWeight`, `menuPrice`, `sequence`, `globalSequence`) VALUES ('".$_POST['newMenuTypeHeadUa']."', '".$_POST['newMenuDishUa']."', '".$_POST['newMenuIngradiendsUa']."', '".$_POST['newMenuTypeHeadEn']."', '".$_POST['newMenuDishEn']."', '".$_POST['newMenuIngradiendsEn']."', '".$_POST['newMenuTypeHeadPl']."', '".$_POST['newMenuDishPl']."', '".$_POST['newMenuIngradiendsPl']."', '".$_POST['newMenuWeight']."', '".$_POST['newMenuPrice']."', '".$_POST['newSequence']."', '".$_POST['newGlobalSequence']."')");
        }
    }
    

    header("Location: https://corivka.com.ua/personal/edit_menu_page.php?menu=".$_GET['menu']);
}
?>
