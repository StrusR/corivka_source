<!DOCTYPE html>
<?php
    session_start();
    if (!$_SESSION['ip']) {
        header("Location: http://corivka.com.ua/personal/login.php");
    }
    session_write_close();
    function getUrl() {
        $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
        $url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
        $url .= $_SERVER["REQUEST_URI"];
        return $url;
    };
    // $my_url = getUrl();
    // if ($my_url == "http://corivka.com.ua/personal/calendar.php") {
    //     header("Location: http://corivka.com.ua/personal/calendar.php?moon=".date("m")."&year=".date("Y"));
    // };
    // $moon = $_GET['moon'];
    // $year = $_GET['year'];
?>
<html>
    <head>
        <?php require_once "blocks/head.php" ?>
        <link rel="stylesheet" href="style/edit_site.css">
        <script type="text/javascript" src="/personal/js/edit_site.js"></script>
        <title>Edit site</title>
    </head>
    <body>
        <header class="user_header">
            <div class="my_initials">
                <a href="" class="my_snp">...</a>
            </div>
            <div class="edit_page">
                <a class="exit" href="http://corivka.com.ua/personal/login.php">Вихід</a>
                <a class="my_edit_page" href="http://corivka.com.ua/personal/my_edit_page.php">Редагувати сторінку</a>
                <a class="users" href="http://corivka.com.ua/personal/users.php">Працівники</a>
                <a class="calendar" href="http://corivka.com.ua/personal/calendar.php?moon=<?php echo date("m")."&year=".date("Y");?>">Календар</a>
            </div>
        </header>
        <article class="calendar_article">
            <div class="edit_panel">
                <select name="moon" class="moon">
                    <option value="01">Січень</option>
                    <option value="02">Лютий</option>
                    <option value="03">Березень</option>
                    <option value="04">Квітень</option>
                    <option value="05">Травень</option>
                    <option value="06">Червень</option>
                    <option value="07">Липень</option>
                    <option value="08">Серпень</option>
                    <option value="09">Вересень</option>
                    <option value="10">Жовтень</option>
                    <option value="11">Листопад</option>
                    <option value="12">Грудень</option>
                </select>
                <select name="year" class="year">
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                </select>
                <input class="edit_graph" type="submit" value="Редагувати графік">
                <input class="clear_moon" type="submit" value="Очистити місяць">
                <input class="save_graph" type="submit" value="Зберегти зміни">
                <input class="cancel_graph" type="submit" value="Скасувати">
            </div>
            <div class="days">
                <?php
                $emp = array();
                $initials;

                for ($i=1; $i <date("t", strtotime("".$year."-".$moon))+1 ; $i++) { 
                    echo "<div href='http://corivka.com.ua/personal/reserv.php?day=".$i."&moon=".$moon."&year=".$year."' class='day'>";
                        $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
                        $mysqli -> query ("SET NAMES 'utf8'");
                        $data_server = $mysqli -> query("SELECT `first_employee`, `second_employee`, `third_employee`, `fourth_employee`, `fifth_employee`, `sixth_employee`, `seventh_employee`, `eighth_employee` FROM `calendar` WHERE `year` = '".$year."' && `moon` = '".$moon."' && `day` = '".$i."'");
                        while (($all = $data_server->fetch_assoc()) != false) {
                            $emp = $all;
                        };
                        $mysqli->close ();
                        echo $i."<br>";
                        echo "<div class='selected_users'>";
                        echo $emp['first_employee']."<br>";
                        echo $emp['second_employee']."<br>";
                        echo $emp['third_employee']."<br>";
                        echo $emp['fourth_employee']."<br>";
                        echo $emp['fifth_employee']."<br>";
                        echo $emp['sixth_employee']."<br>";
                        echo $emp['seventh_employee']."<br>";
                        echo $emp['eighth_employee']."<br>";
                        echo "</div>";
                        echo"<select name='users' id='emp".$i."' multiple='multiple' size='9' class='select_users'>";
                            echo "<option value='' class='optionClear'>Очистити</option>";
                            $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
                            $mysqli -> query ("SET NAMES 'utf8'");
                            $data_server = $mysqli -> query("SELECT `surname`, `name` FROM `users`");
                            while (($all = $data_server->fetch_assoc()) != false) {
                                $initials = $all['surname']." ".$all['name'];
                                if ($initials == $emp['first_employee'] || $initials == $emp['second_employee'] || $initials == $emp['third_employee'] || $initials == $emp['fourth_employee'] || $initials == $emp['fifth_employee'] || $initials == $emp['sixth_employee'] || $initials == $emp['seventh_employee'] || $initials == $emp['eighth_employee']) {
                                    echo "<option value='".$initials."' selected='selected'>";
                                    echo $initials;
                                    echo "</option>";
                                } else {
                                    echo "<option value='".$initials."'>";
                                    echo $initials;
                                    echo "</option>";
                                }
                                
                            };
                        echo "</select>";
                    echo "</div><br>";
                    unset($emp);
                };
                ?>
            </div>
            <div class="edit_panel">
                <select name="moon" class="moon">
                    <option value="01">Січень</option>
                    <option value="02">Лютий</option>
                    <option value="03">Березень</option>
                    <option value="04">Квітень</option>
                    <option value="05">Травень</option>
                    <option value="06">Червень</option>
                    <option value="07">Липень</option>
                    <option value="08">Серпень</option>
                    <option value="09">Вересень</option>
                    <option value="10">Жовтень</option>
                    <option value="11">Листопад</option>
                    <option value="12">Грудень</option>
                </select>
                <select name="year" class="year">
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                </select>
                <input class="edit_graph" type="submit" value="Редагувати графік">
                <input class="clear_moon" type="submit" value="Очистити місяць">
                <input class="save_graph" type="submit" value="Зберегти зміни">
                <input class="cancel_graph" type="submit" value="Скасувати">
            </div>
        </article>
    </body>
</html>