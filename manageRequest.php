<?php

    require('SQLconnect.php');
    session_start();
    $action = $_POST['action'];
    $status = $_POST['status'];

    switch($action){
        case "cancel":
            echo "<div class = 'alert alert-danger'>We've successfully cancelled your parking spot request</div>";

            $sql = $db->prepare("UPDATE Spots SET rUserID = NULL WHERE rUserID = ?");
            $sql->bind_param('s', $_SESSION['userID']);

            $sql->execute();
            $_SESSION['statusCode'] = 0;
            break;
        case "request":
            echo "<div class='alert alert-success'>We're submitting your request.</div>";
            $_SESSION['statusCode'] = 1;

            break;
        }
?>