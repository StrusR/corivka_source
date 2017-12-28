<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
    $mysqli -> query ("SET NAMES 'utf8'");

    $ip = $_POST['ip'];
    $new_login = $_POST['email'];
    $new_surname = $_POST['surname'];
    $new_name = $_POST['name'];
    $new_patronymic = $_POST['patronymic'];
    $new_phone = $_POST['phone'];
    $old_password = md5($_POST['oldpassword']);
    $new_password = $_POST['newpassword'];

    $SuccessReturn = array('login', 'phone', 'password');
    $SuccessReturn['login'] = true;
    $SuccessReturn['phone'] = true;
    $SuccessReturn['password'] = false;

    $data_server = $mysqli -> query("SELECT `login`, `phone` FROM `users` WHERE `login` = '".$new_login."' && `ip` != '".$ip."' || `phone` = '".$new_phone."' && `ip` != '".$ip."'");
    while (($all = $data_server->fetch_assoc()) != false) {
        if ($all['login'] == $new_login) {
                $SuccessReturn['login'] = false;
        }
        if ($all['phone'] == $new_phone) {
                $SuccessReturn['phone'] = false;
        }
    };
    $data_server = $mysqli -> query("SELECT `password` FROM `users` WHERE `ip` = '".$ip."'");
    while (($all = $data_server->fetch_assoc()) != false) {
        if ($all['password'] == $old_password) {
                $SuccessReturn['password'] = true;
        }
    };

    if ($SuccessReturn['login'] == true && $SuccessReturn['phone'] == true && $SuccessReturn['password'] == true) {
        if ($new_password) {
            $mysqli -> query("UPDATE `users` SET `login` = '".$new_login."', `name` = '".$new_name."', `surname` = '".$new_surname."', `patronymic` = '".$new_patronymic."', `password` = '".md5($new_password)."', `phone` = '".$new_phone."' WHERE `users`.`ip` = '".$ip."'");
        } else {
            $mysqli -> query("UPDATE `users` SET `login` = '".$new_login."', `name` = '".$new_name."', `surname` = '".$new_surname."', `patronymic` = '".$new_patronymic."', `phone` = '".$new_phone."' WHERE `users`.`ip` = '".$ip."'");
        }
    }
    

    echo json_encode($SuccessReturn);
    
    
    
    $mysqli->close ();
}
?>