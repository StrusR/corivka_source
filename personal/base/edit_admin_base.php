<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
    $mysqli -> query ("SET NAMES 'utf8'");
    session_start();
    $my_ip = $_SESSION['ip'];
    session_write_close();
    $ip = $_POST['ip'];

    $my_access_rights;
    $access_rights;
    $data_server = $mysqli -> query("SELECT `access_rights` FROM `users` WHERE `ip` = '".$my_ip."'");
    while (($all = $data_server->fetch_assoc()) != false) {
        $my_access_rights = $all['access_rights'];
    };
    if ($my_access_rights == 1) {
        $data_server = $mysqli -> query("SELECT `access_rights` FROM `users` WHERE `ip` = '".$ip."'");
        while (($all = $data_server->fetch_assoc()) != false) {
            $access_rights = $all['access_rights'];
        };
        if ($access_rights == 2) {
            $mysqli -> query("UPDATE `users` SET `access_rights` = 3 WHERE `users`.`ip` = '".$ip."'");
        } else {
            $mysqli -> query("UPDATE `users` SET `access_rights` = 2 WHERE `users`.`ip` = '".$ip."'");
        }
    }



    $mysqli->close (); 
}
?>