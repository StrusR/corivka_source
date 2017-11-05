<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
    $mysqli -> query ("SET NAMES 'utf8'");

    $email_phone = $_POST['email_phone'];
    $password = md5($_POST['password']);

    $SuccessReturn = array('login', 'ip');
    $SuccessReturn['login'] = false;

    $data_server = $mysqli -> query("SELECT `login`, `phone`, `password` FROM `users` WHERE `login` = '".$email_phone."' || `phone` = '".$email_phone."'");
    while (($all = $data_server->fetch_assoc()) != false) {
        if ($all['login'] == $email_phone && $all['password'] == $password || $all['phone'] == $email_phone && $all['password'] == $password) {
            $SuccessReturn['login'] = true;
        } else {
            $SuccessReturn['login'] = false;
        };
    };
    if ($SuccessReturn['login'] == true) {
        $data_server = $mysqli -> query("SELECT `ip` FROM `users` WHERE `login` = '".$email_phone."' || `phone` = '".$email_phone."'");
        while (($all = $data_server->fetch_assoc()) != false) {
            session_start();
            $_SESSION['ip'] = $all['ip'];
            $SuccessReturn['ip'] = $all['ip'];
            session_write_close();
        };
    };

    echo json_encode($SuccessReturn);
    
    
    
    $mysqli->close ();
}
?>