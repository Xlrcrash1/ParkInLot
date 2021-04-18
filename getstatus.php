<?php
    require('SQLconnect.php');
    session_start();

    include('updatestatus.php');

    $reqPage = $_POST['isOnReqPage'];

    update_status($db, $_SESSION['userID'], $reqPage);
    // echo gettype($reqPage);
    // echo "checkstatus php REQ {$reqPage}<br>";
    // echo $_SESSION['statusCode'] . "<br>";

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

    if ($reqPage == '1' && $_SESSION['statusCode'] != 2 && $_SESSION['statusCode'] != 20 && $_SESSION['statusCode'] != 10){
        $_SESSION['statusCode'] = 1;
        $statusCode = 1;
    }
    echo json_encode($statusCode);
 
?>