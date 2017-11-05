<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
    $mysqli -> query ("SET NAMES 'utf8'");
    session_start();
    $my_ip = $_SESSION['ip'];
    session_write_close();
    $ip = $_POST['ip'];
    $old_password = md5($_POST['oldpassword']);

    $SuccessReturn = array();
    $SuccessReturn['password'] = false;
    $my_access_rights;

    $data_server = $mysqli -> query("SELECT `password` FROM `users` WHERE `ip` = '".$ip."'");
    while (($all = $data_server->fetch_assoc()) != false) {
        if ($all['password'] == $old_password) {
                $SuccessReturn['password'] = true;
        }
    };

    if ($SuccessReturn['password'] == true) {
        $mysqli -> query("DELETE FROM `users` WHERE `users`.`ip` = '".$ip."'");
        session_start();
        session_destroy();
        session_write_close();
    }
    echo json_encode($SuccessReturn);

    $mysqli->close (); 
}
?>