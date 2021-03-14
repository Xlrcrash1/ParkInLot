<?php
    session_start();

    if ($_SESSION['statusCode'] == 10){
        $statusCode = 10;
    } else {
        $statusCode = 1;
    }
    echo json_encode($statusCode);
?>