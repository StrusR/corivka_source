<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
    $mysqli -> query ("SET NAMES 'utf8'");

    $days_in_moon = $_POST['days_in_moon'];
    $days = $_POST['days'];
    $moon = $_POST['moon'];
    $year = $_POST['year'];

    $SuccessReturn = array('employee');
    for ($i=1; $i <= $days_in_moon; $i++) {
        $data_server = $mysqli -> query("SELECT * FROM `calendar` WHERE `year` = '".$year."' && `moon` = '".$moon."' && `day` = '".$i."'");
        if (!$days[$i-1][0]) {
            $mysqli -> query("DELETE FROM `calendar` WHERE `calendar`.`year` = '".$year."' && `moon` = '".$moon."' && `day` = '".$i."'");
        } else if ($data_server->num_rows > 0) {
            $mysqli -> query("UPDATE `calendar` SET `first_employee` = '".$days[$i-1][0]."', `second_employee` = '".$days[$i-1][1]."', `third_employee` = '".$days[$i-1][2]."', `fourth_employee` = '".$days[$i-1][3]."', `fifth_employee` = '".$days[$i-1][4]."', `sixth_employee` = '".$days[$i-1][5]."', `seventh_employee` = '".$days[$i-1][6]."', `eighth_employee` = '".$days[$i-1][7]."' WHERE `calendar`.`year` = '".$year."' && `moon` = '".$moon."' && `day` = '".$i."'");
        } else {
            $mysqli -> query("INSERT INTO `calendar` (`day`, `moon`, `year`, `first_employee`, `second_employee`, `third_employee`, `fourth_employee`, `fifth_employee`, `sixth_employee`, `seventh_employee`, `eighth_employee`) VALUES ('".$i."', '".$moon."', '".$year."', '".$days[$i-1][0]."', '".$days[$i-1][1]."', '".$days[$i-1][2]."', '".$days[$i-1][3]."', '".$days[$i-1][4]."', '".$days[$i-1][5]."', '".$days[$i-1][6]."', '".$days[$i-1][7]."')");
        }
    }

    echo json_encode($SuccessReturn);
    
    
    
    $mysqli->close ();
}
?>