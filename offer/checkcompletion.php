<?php
    // This file checks the status of a parking spot offer. 
    // It is called by offerSpots.js in the checkCompletion() function using ajax
    // Returns HTML statements to display an update

    session_start();
    require('../SQLconnect.php');
    include('../updatestatus.php');

    // Query spots where the user is the poster/offerer 
    $spotQuery = "SELECT * FROM Spots WHERE pUserID = {$_SESSION['userID']};";

    $spotResult = $db->query($spotQuery);
    if ($spotRow = $spotResult->FETCH_ASSOC()){

        // If Requester is still not found
        if ($spotRow['rUserID'] != NULL){
            echo "<div class='row'>
                <div class='col-xs-0 col-lg-4 side'></div>
                <div class='col main'>";
            echo "<div class='alert alert-info'>Trade in progress</div>";
            echo "</div>
                    <div class='col-xs-0 col-lg-4 side'></div>
                        </div>";
        }
    } else{ // The trade has been completed
        $statusQuery = "SELECT * FROM SpotsHistory WHERE pUserID = {$_SESSION['userID']} ORDER BY date DESC LIMIT 1;";

        // Search for the last entry in SpotsHistory and output the completion message
        if ($statusResult = $db->query($statusQuery)){
            $statusRow = $statusResult->FETCH_ASSOC();
            echo "<div class='row'>
                <div class='col-xs-0 col-lg-4 side'></div>
                <div class='col main'>";
            echo "<div class='alert alert-info'>The trade has been completed.</div>";
            echo "</div>
                    <div class='col-xs-0 col-lg-4 side'></div>
                        </div>";
            $_SESSION['statusCode'] = 0;
        }
    }

    update_status($db, $_SESSION['userID'], 0);

    // If statusCode == 2, the requester has cancelled their request
    if ($_SESSION['statusCode'] == 2){
        echo "<div class='alert alert-danger'>The previous requester has cancelled their request. We're looking to find a new requester</div>";
    }

?>
