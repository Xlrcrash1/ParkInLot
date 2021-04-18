<?php

    require('../SQLconnect.php');
    session_start();
    $action = $_POST['action']; // Action to perform when requesting a spot (Add, Cancel)
    $status = $_POST['status']; // Status of the user

    switch($action){
        case "cancel":  // Cancelling user's existing spot request. Checks database and cancels an paired request as well.
            $cancel = "UPDATE Spots SET rUserID = NULL, reqStat = 2 WHERE rUserID = {$_SESSION['userID']};";

            if ($db->query($cancel)){
                echo "<div class = 'alert alert-danger'>We've successfully cancelled your parking spot request</div>";
            } else{
                echo "<div class = 'alert alert-danger'>Something went wrong while cancelling your request</div>";
            }
            $_SESSION['statusCode'] = 0; // Status Code 0 - User is not requesting or offering a parking spot. 
                                         // This stops the ajax function in checkspots.js from checking for a spot
            break;
        case "request": // Re-submitting a parking spot request
            echo "<div class='alert alert-success'>We're submitting your request.</div>";
            $_SESSION['statusCode'] = 1; // Status Code 1 - User is requesting a parking spot, but has not yet been paired with a spot

            break;

        case "complete":

            $complete = "UPDATE Spots SET reqStat = 3 WHERE rUserID = {$_SESSION['userID']};";
            
            if ($db->query($complete)){
                
                $deleteSpot = "DELETE FROM Spots WHERE rUserID = {$_SESSION['userID']};";
                $db->query($deleteSpot);
                
                echo "<div class = 'alert alert-success'>The parking spot trade has successfully been completed.</div>";

            }else{
                echo "<div class = 'alert alert-success'>Something went wrong.</div>";
            }

            
            break;
        }
?>