<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
    $mysqli -> query ("SET NAMES 'utf8'");
    session_start();
    $my_ip = $_SESSION['ip'];
    session_write_close();
    $ip = $_POST['ip'];
    $old_password = md5($_POST['password']);

    $SuccessReturn = array();
    $SuccessReturn['password'] = false;

    $data_server = $mysqli -> query("SELECT `access_rights`, `password` FROM `users` WHERE `ip` = '".$my_ip."'");
    while (($all = $data_server->fetch_assoc()) != false) {
        if ($all['access_rights'] == 1 && $all['password'] == $old_password) {
            $mysqli -> query("DELETE FROM `users` WHERE `users`.`ip` = '".$ip."'");
            $SuccessReturn['password'] = true;
        }
    };
    echo json_encode($SuccessReturn);

    $mysqli->close (); 
}
?>