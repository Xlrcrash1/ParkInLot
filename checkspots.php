<?php
    require('SQLconnect.php');
    session_start();
    echo "Status: {$_SESSION['statusCode']}<br>";

    if ($_SESSION['statusCode'] == 1){
        $sql = "SELECT userID, userName, parkingLot, Spots.time, carPhoto
        FROM SpotsDetails 
        INNER JOIN Spots ON userID = pUserID 
        WHERE rUserID IS NULL 
        ORDER BY time ASC
        LIMIT 1;";

        $res = $db->query($sql);

        if ($row = $res->FETCH_ASSOC()){
            echo "<div class ='alert alert-success'><strong>Parking Spot Found!</strong><br>
            User Name: {$row['userName']}<br>
            Parking Lot: {$row['parkingLot']}<br>
            <img src='{$row['carPhoto']}' alt='Car Photo'
                    style='max-width: 50%;'><br>";
            
            $_SESSION['statusCode'] = 10;
        }
        else{
            echo "<p><strong>We're looking for a spot! </strong>You have <strong>
                    {$_SESSION['tokens']} token(s)</strong> in your account.
                    <br>Please click <strong>Cancel</strong> if you would like to cancel your request</p>";
            $_SESSION['statusCode'] = 1;
        }   
    }

?>