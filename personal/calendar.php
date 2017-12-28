<!DOCTYPE html>
<?php
    function getUrl() {
        $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
        $url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
        $url .= $_SERVER["REQUEST_URI"];
        return $url;
    };
    $my_url = getUrl();

    session_start();
    if (!$_SESSION['ip']) {
        setcookie("page","$my_url",time()+3600 * 24 * 30);
        header("Location: https://corivka.com.ua/personal/login.php");
    }
    session_write_close();

    if ($my_url == "https://corivka.com.ua:443/personal/calendar.php") {
        header("Location: https://corivka.com.ua:443/personal/calendar.php?month=".date("m")."&year=".date("Y"));
    };
    $month = $_GET['month'];
    $year = $_GET['year'];
?>
<html>
    <head>
        <?php require_once "../personal/blocks/head.php" ?>
        <link rel="stylesheet" href="style/calendar.css">
        <script type="text/javascript" src="/personal/js/calendar.js"></script>
        <link rel="stylesheet" type="text/css" href="/personal/style/print.css" media="print" />
        <title>Calendar</title>
    </head>
    <body>
        <header class="user_header">
            <div class="my_initials">
            <?php
                $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
                $mysqli -> query ("SET NAMES 'utf8'");
                $data_server = $mysqli -> query("SELECT * FROM `users` WHERE `ip` = '".$_SESSION['ip']."'");
                while (($all = $data_server->fetch_assoc()) != false) {
                    if ($all['access_rights'] == 1) {
                        echo "<a href='https://corivka.com.ua/personal/user.php?ip=".$_SESSION['ip']."' class='my_snp'>".$all['surname']." ".$all['name']." (Директор)"."</a>";
                    } else if ($all['access_rights'] == 2) {
                        echo "<a href='https://corivka.com.ua/personal/user.php?ip=".$_SESSION['ip']."' class='my_snp'>".$all['surname']." ".$all['name']." (Адміністратор)"."</a>";
                    } else {
                        echo "<a href='https://corivka.com.ua/personal/user.php?ip=".$_SESSION['ip']."' class='my_snp'>".$all['surname']." ".$all['name']."</a>";
                    }
                    
                };
                ?>
            </div>
            <div class="edit_page">
                <a class="exit" href="https://corivka.com.ua/personal/login.php">Вихід</a>
                <a class="my_edit_page" href="https://corivka.com.ua/personal/my_edit_page.php">Редагувати профіль</a>
                <a class="users" href="https://corivka.com.ua/personal/users.php">Персонал</a>
                <?php
                    $mysqli = new mysqli ("195.149.114.51", "corivkac", "gfup/kycqqs", "corivkac_admin");
                    $mysqli -> query ("SET NAMES 'utf8'");
                    $data_server = $mysqli -> query("SELECT `access_rights` FROM `users` WHERE `ip` = '".$_SESSION['ip']."'");
                    while (($all = $data_server->fetch_assoc()) != false) {
                        if ($all['access_rights'] < 3){
                            echo "<div class='edit_site'>Редагувати сайт</div>";
                            echo "<div class='edit_site_type'>";
                                echo "<a class='edit_main_page' href='https://corivka.com.ua/personal/edit_main_page.php'>Редагувати \"Головна\"</a>";
                                echo "<a class='edit_contacts_page' href='https://corivka.com.ua/personal/edit_contacts_page.php'>Редагувати \"Контактні дані\"</a>";
                                echo "<div class='edit_menu'>Редагувати меню</div>";
                                echo "<div class='edit_menu_type'>";
                                    echo "<a class='edit_menu_page' href='https://corivka.com.ua/personal/edit_menu_page.php?menu=Menu'>Редагувати \"Меню\"</a>";
                                    echo "<a class='edit_menu_page' href='https://corivka.com.ua/personal/edit_menu_page.php?menu=AlcoholMenu'>Редагувати \"Алкогольне меню\"</a>";
                                    echo "<a class='edit_menu_page' href='https://corivka.com.ua/personal/edit_menu_page.php?menu=BanquetMenu'>Редагувати \"Банкетне меню\"</a>";
                                echo "</div>";
                            echo "</div>";
                        }
                    };
                ?>
            </div>
        </header>
        <article class="calendar_article">
            <div class="edit_panel">
                <select name="month" class="selectMonth">
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
                <select name="year" class="selectYear">
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
                <?php
                    $data_server = $mysqli -> query("SELECT `access_rights` FROM `users` WHERE `ip` = '".$_SESSION['ip']."'");
                    while (($all = $data_server->fetch_assoc()) != false) {
                        if ($all['access_rights'] < 3){
                            echo "<input class='print' type='submit' value='Роздрукувати'>";
                            echo "<input class='clear_month' type='submit' value='Очистити місяць'>";
                            echo "<input class='cancel_graph' type='submit' value='Скасувати'>";
                            echo "<input class='save_graph' type='submit' value='Зберегти зміни'>";
                            echo "<input class='edit_graph' type='submit' value='Редагувати графік'>";
                        }
                    };
                ?>
                
            </div>
            <div class="days">
                <?php
                $emp = array();
                $initials;

                for ($i=1; $i <date("t", strtotime("".$year."-".$month))+1 ; $i++) { 
                    echo "<div href='https://corivka.com.ua/personal/reserv.php?day=".$i."&month=".$month."&year=".$year."' class='day'>";
                        $data_server = $mysqli -> query("SELECT `first_employee`, `second_employee`, `third_employee`, `fourth_employee`, `fifth_employee`, `sixth_employee`, `seventh_employee`, `eighth_employee` FROM `calendar` WHERE `year` = '".$year."' && `month` = '".$month."' && `day` = '".$i."'");
                        while (($all = $data_server->fetch_assoc()) != false) {
                            $emp = $all;
                        };
                        $data_server = $mysqli -> query("SELECT * FROM `weekends` WHERE `ip` = '".$_SESSION['ip']."' && `year` = '".$year."' && `month` = '".$month."' && `day` = '".$i."'");
                        if ($data_server->num_rows == 0) {
                            echo "<div class='day_header'><div class='day_number'>".date("d", strtotime("".$year."-".$month."-".$i))."<div class='week'>".date("l", strtotime("".$year."-".$month."-".$i))."</div></div><input name='weekend".$i."' type='checkbox' id='weekend".$i."' class='weekend'><label for='weekend".$i."' class='lweekend' id='lweekend".$i."'>Взяти вихідний</label></div>";
                        } else {
                            echo "<div class='day_header'><div class='day_number'>".date("d", strtotime("".$year."-".$month."-".$i))."<div class='week'>".date("l", strtotime("".$year."-".$month."-".$i))."</div></div><input checked name='weekend".$i."' type='checkbox' id='weekend".$i."' class='weekend'><label style='color: red;' for='weekend".$i."' class='lweekend' id='lweekend".$i."'>Взяти вихідний</label></div>";
                        }

                        $data_server = $mysqli -> query("SELECT `surname`, `name`, `avatar`, `ip` FROM `users`");
                        while (($all = $data_server->fetch_assoc()) != false) {
                            $initials = $all['surname']." ".$all['name'];
                            if ($initials == $emp['first_employee'] || $initials == $emp['second_employee'] || $initials == $emp['third_employee'] || $initials == $emp['fourth_employee'] || $initials == $emp['fifth_employee'] || $initials == $emp['sixth_employee'] || $initials == $emp['seventh_employee'] || $initials == $emp['eighth_employee']) {
                                if (empty($all['avatar'])) {
                                    echo "<a href='https://corivka.com.ua/personal/user.php?ip=".$all['ip']."'><img class='users_img' alt='' src='../img/logo.jpg'></img></a>";
                                } else {
                                    echo "<a href='https://corivka.com.ua/personal/user.php?ip=".$all['ip']."'><img class='users_img' alt='' src='/personal/base/avatar/".$all['avatar']."'></img></a>";
                                }
                                echo "<div class='selected_users'>";
                                echo $initials;
                                echo "</div>";
                            }
                        };

                        
                        echo"<select name='users' id='emp".$i."' multiple='multiple' size='9' class='select_users'>";
                            echo "<option value='' class='optionClear'>Очистити</option>";
                            $data_server = $mysqli -> query("SELECT `surname`, `name`, `ip` FROM `users`");
                            while (($all = $data_server->fetch_assoc()) != false) {
                                $initials = $all['surname']." ".$all['name'];
                                if ($initials == $emp['first_employee'] || $initials == $emp['second_employee'] || $initials == $emp['third_employee'] || $initials == $emp['fourth_employee'] || $initials == $emp['fifth_employee'] || $initials == $emp['sixth_employee'] || $initials == $emp['seventh_employee'] || $initials == $emp['eighth_employee']) {
                                    $dt_server = $mysqli -> query("SELECT * FROM `weekends` WHERE `ip` = '".$all['ip']."' && `year` = '".$year."' && `month` = '".$month."' && `day` = '".$i."'");
                                    if ($dt_server->num_rows == 0) {
                                        echo "<option value='".$initials."' selected='selected'>";
                                        echo $initials;
                                        echo "</option>";
                                    } else {
                                        echo "<option style=' border: 2px solid red;' value='".$initials."' selected='selected'>";
                                        echo $initials;
                                        echo "</option>";
                                    }
                                } else {
                                    $dt_server = $mysqli -> query("SELECT * FROM `weekends` WHERE `ip` = '".$all['ip']."' && `year` = '".$year."' && `month` = '".$month."' && `day` = '".$i."'");
                                    if ($dt_server->num_rows == 0) {
                                        echo "<option value='".$initials."'>";
                                        echo $initials;
                                        echo "</option>";
                                    } else {
                                        echo "<option style=' border: 2px solid red;' value='".$initials."'>";
                                        echo $initials;
                                        echo "</option>";
                                    }
                                }
                            };
                        echo "</select>";
                    echo "</div>";
                    unset($emp);
                };
                ?>
            </div>
            <div class="edit_panel">
            <?php
                $data_server = $mysqli -> query("SELECT `access_rights` FROM `users` WHERE `ip` = '".$_SESSION['ip']."'");
                while (($all = $data_server->fetch_assoc()) != false) {
                    if ($all['access_rights'] < 3){
                        echo "<input class='print' type='submit' value='Роздрукувати'>";
                        echo "<input class='clear_month' type='submit' value='Очистити місяць'>";
                        echo "<input class='cancel_graph' type='submit' value='Скасувати'>";
                        echo "<input class='save_graph' type='submit' value='Зберегти зміни'>";
                        echo "<input class='edit_graph' type='submit' value='Редагувати графік'>";
                    }
                };
            ?>
            
        </div>
        </article>
    </body>
</html>