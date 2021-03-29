<?php

    require('SQLconnect.php');
    session_start();
    $action = $_POST['action'];
    $status = $_POST['status'];

    switch($action){
        case "cancel":
            $sql = "UPDATE Spots SET rUserID = NULL, reqStat = 2 WHERE rUserID = {$_SESSION['userID']};";

            if ($db->query($sql)){
                echo "<div class = 'alert alert-danger'>We've successfully cancelled your parking spot request</div>";
            } else{
                echo "<div class = 'alert alert-danger'>Something went wrong while cancelling your request</div>";
            }
            $_SESSION['statusCode'] = 0;
            break;
        case "request":
            echo "<div class='alert alert-success'>We're submitting your request.</div>";
            $_SESSION['statusCode'] = 1;

            break;
        }
?>