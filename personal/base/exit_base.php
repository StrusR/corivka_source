<?php
    $SuccessReturn = array('ret');
    $SuccessReturn['ret'] = false;


    session_start();
    session_destroy();
    session_write_close();

    $SuccessReturn['ret'] = true;
    echo json_encode($SuccessReturn);
?>