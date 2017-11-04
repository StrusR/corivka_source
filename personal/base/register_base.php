<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
    $mysqli -> query ("SET NAMES 'utf8'");
    $new_login = $_POST['email'];
    $new_surname = $_POST['surname'];
    $new_name = $_POST['name'];
    $new_patronymic = $_POST['patronymic'];
    $new_phone = $_POST['phone'];
    $new_password = md5($_POST['password']);

    $SuccessReturn = array('login', 'phone', 'ip');
    $SuccessReturn['login'] = true;
    $SuccessReturn['phone'] = true;

    $data_server = $mysqli -> query("SELECT `login`, `phone` FROM `users` WHERE `login` = '".$new_login."' || `phone` = '".$new_phone."'");
    while (($all = $data_server->fetch_assoc()) != false) {
        if ($all['login'] == $new_login) {
            $SuccessReturn['login'] = false;
        } else {
            $SuccessReturn['login'] = true;
        };
        if ($all['phone'] == $new_phone) {
            $SuccessReturn['phone'] = false;
        } else {
            $SuccessReturn['phone'] = true;
        };
    };
    if ($SuccessReturn['login'] == true && $SuccessReturn['phone'] == true) {
        $mysqli -> query("INSERT INTO `users` (`login`, `surname`, `name`, `patronymic`, `password`, `phone`, `reg_date`, `access_rights`, `ip`) VALUES ('".$new_login."', '".$new_surname."', '".$new_name."', '".$new_patronymic."', '".$new_password."', '".$new_phone."', '".time()."', '3', '".time()."')");
        $data_server = $mysqli -> query("SELECT `ip` FROM `users` WHERE `login` = '".$new_login."'");
        while (($all = $data_server->fetch_assoc()) != false) {
            session_start();
            $_SESSION['ip'] = $all['ip'];
            $SuccessReturn['ip'] = $all['ip'];
            session_write_close();
        };
    }

    echo json_encode($SuccessReturn);
    
    
    
    $mysqli->close ();
}
?>