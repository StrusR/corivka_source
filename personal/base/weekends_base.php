<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
    $mysqli -> query ("SET NAMES 'utf8'");
    session_start();
    $my_ip = $_SESSION['ip'];
    session_write_close();

    $surname;
    $name;
    $patronymic;

    $days_in_month = $_POST['days_in_month'];
    $weekends = $_POST['weekends'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    $data_server = $mysqli -> query("SELECT * FROM `users` WHERE `ip` = '".$my_ip."'");
    
    while (($all = $data_server->fetch_assoc()) != false) {
        $surname = $all['surname'];
        $name = $all['name'];
        $patronymic = $all['patronymic'];
    };


    for ($i=1; $i <= $days_in_month; $i++) {
        $data_server = $mysqli -> query("SELECT * FROM `weekends` WHERE `year` = '".$year."' && `month` = '".$month."' && `day` = '".$i."' && `ip` = '".$my_ip."'");
        if ($weekends[$i-1] == 0) {
            $mysqli -> query("DELETE FROM `weekends` WHERE `weekends`.`year` = '".$year."' && `month` = '".$month."' && `day` = '".$i."' && `ip` = '".$my_ip."'");
        } else if ($data_server->num_rows == 0) {
            $mysqli -> query("INSERT INTO `weekends` (`ip`, `year`, `month`, `day`, `surname`, `name`, `patronymic`) VALUES ('".$my_ip."', '".$year."', '".$month."', '".$i."', '".$surname."', '".$name."', '".$patronymic."')");
        } 
    }

    
    $mysqli->close ();
}
?>