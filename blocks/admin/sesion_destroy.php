<?php
    session_write_close();
    function exitFuction() {
        session_start();
        session_destroy();
        session_write_close();
        header ("Location: http://corivka.com.ua/login.php");
    }
    if($_POST){
        exitFuction();
    }
?>