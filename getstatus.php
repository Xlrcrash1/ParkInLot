<?php
    // Returns the SESSION statusCode in JSON format
    // Called by Ajax functions

    require('SQLconnect.php');
    session_start();

    include('updatestatus.php');

    $reqPage = $_POST['isOnReqPage'];

    // Query database to retrieve current status of the user
    update_status($db, $_SESSION['userID'], $reqPage);

    if ($_SESSION['statusCode'] == 0){ // User is not requesting and not offering
        $statusCode = 0;
    } else if ($_SESSION['statusCode'] == 1){ // User is requesting a parking spot
        $statusCode = 1;
    } else if ($_SESSION['statusCode'] == 10){ // User is requesting and has been matched with a spot
        $statusCode = 10;       
    } else if ($_SESSION['statusCode'] == 2){ // User is offering a parking spot
        $statusCode = 2;       
    } else if ($_SESSION['statusCode'] == 20){ // User is offering and has found a requester
        $statusCode = 20;   
    } 

    // If user is on request page, they are actively looking for a spot
    if ($reqPage == '1' && $_SESSION['statusCode'] != 2 && $_SESSION['statusCode'] != 20 && $_SESSION['statusCode'] != 10){
        $_SESSION['statusCode'] = 1;
        $statusCode = 1;
    }

    // return statusCode in json format 
    echo json_encode($statusCode);
 
?>