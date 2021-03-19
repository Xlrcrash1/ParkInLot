<?php
    session_start();

    if ($_SESSION['statusCode'] == 0){
        $statusCode = 0;
    } else if ($_SESSION['statusCode'] == 1){
        $statusCode = 1;
    } else if ($_SESSION['statusCode'] == 10){
        $statusCode = 10;       
    } else if ($_SESSION['statusCode'] == 2){
        $statusCode = 2;       
    } else if ($_SESSION['statusCode'] == 20){
        $statusCode = 20;   
    }  
    echo json_encode($statusCode);
?>