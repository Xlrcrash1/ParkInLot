<?php

    session_start();
    require('SQLconnect.php');
    include('updatestatus.php');

    $spotQuery = "SELECT * FROM Spots WHERE pUserID = {$_SESSION['userID']};";
    
    $spotResult = $db->query($spotQuery);
    if ($spotRow = $spotResult->FETCH_ASSOC()){

        if ($spotRow['rUserID'] != NULL){
            echo "<div class='alert alert-info'>Trade in progress</div>";
        }
    } else{
        $statusQuery = "SELECT * FROM SpotsHistory WHERE pUserID = {$_SESSION['userID']} ORDER BY date DESC LIMIT 1;";

        if ($statusResult = $db->query($statusQuery)){
            $statusRow = $statusResult->FETCH_ASSOC();
            echo "<div class='alert alert-info'>The trade has been completed.</div>";
            $_SESSION['statusCode'] = 0;
        }
    }

    update_status($db, $_SESSION['userID'], 0);

    if ($_SESSION['statusCode'] == 2){
        echo "<div class='alert alert-danger'>The previous requester has cancelled their request. We're looking to find a new requester</div>";
    }

?>