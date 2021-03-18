<?php

    $action = $_POST['action'];
    $status = $_POST['status'];

    $_SESSION['statusCode'] = 0;

    switch($action){
        case "cancel":
            echo "<div class = 'alert alert-danger'>We've successfully cancelled your parking spot request</div>";
            break;
        case "request":
            echo "<div class='alert alert-success'>We're submitting your request.</div>";
            break;
        }
?>