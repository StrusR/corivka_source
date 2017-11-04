<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
    $mysqli -> query ("SET NAMES 'utf8'");
    session_start();
    $my_ip = $_SESSION['ip'];
    session_write_close();
    $ip = $_POST['ip'];
    
    $SuccessReturn = array();

    $data_server = $mysqli -> query("SELECT * FROM `users` WHERE `ip` = '".$my_ip."'");
    
    while (($all = $data_server->fetch_assoc()) != false) {
        $SuccessReturn['my_id'] = $all['id'];
        $SuccessReturn['my_login'] = $all['login'];
        $SuccessReturn['my_surname'] = $all['surname'];
        $SuccessReturn['my_name'] = $all['name'];
        $SuccessReturn['my_patronymic'] = $all['patronymic'];
        $SuccessReturn['my_phone'] = $all['phone'];
        $SuccessReturn['my_avatar'] = $all['avatar'];
        $SuccessReturn['my_reg_date'] = $all['reg_date'];
        $SuccessReturn['my_access_rights'] = $all['access_rights'];
        $SuccessReturn['my_ip'] = $all['ip'];
    };

    echo json_encode($SuccessReturn);
    $mysqli->close ();
}
?>