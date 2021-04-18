<?php
    require('../SQLconnect.php');
    session_start();

    // Check Spots table to see if the userID is already matched with a spot request
    $checkExistingRequest = "SELECT Spots.pUserID, userName, parkingLot, Spots.time, carPhoto FROM SpotsDetails 
    INNER JOIN Spots ON Spots.pUserID = SpotsDetails.pUserID 
    WHERE Spots.rUserID = {$_SESSION['userID']};";

    $res = $db->query($checkExistingRequest);

    if ($row = $res->FETCH_ASSOC()){    // If user is already matched with a spot request
        echo "<div class ='alert alert-success'><strong>You've already been paired with user {$row['userName']}</strong><br>
        User Name: {$row['userName']}<br>
        Parking Lot: {$row['parkingLot']}<br>
        <img src='{$row['carPhoto']}' alt='Car Photo'
                style='max-width: 50%;'><br>
                <button type='button' class='btn btn-success' id='btnDetails' onclick='viewDetails()'>View Details</button>
                <button type='button' class='btn btn-success' id='btnComplete' onclick='completeTrade()'>Complete Trade</button><br>
                </div>";
        
        $_SESSION['statusCode'] = 10;   // Status code 10 - User has requested and been paired with a parking spot
        $res->close();
    } elseif ($_SESSION['statusCode'] == 1){    // Status code 1 - User has requested and not been paired yet with a parking spot

        // Search for available parking spots
        // Take the oldest available spot in the Spots table
        $sql = "SELECT Spots.pUserID, userName, parkingLot, Spots.time, carPhoto
        FROM SpotsDetails 
        INNER JOIN Spots ON Spots.pUserID = SpotsDetails.pUserID 
        WHERE Spots.rUserID IS NULL 
        ORDER BY time ASC
        LIMIT 1;";

        $res = $db->query($sql);

        if ($row = $res->FETCH_ASSOC()){ // If an available spot is found.
            echo "<div class ='alert alert-success'><strong>Parking Spot Found!</strong><br>
            User Name: {$row['userName']}<br>
            Parking Lot: {$row['parkingLot']}<br>
            <img src='{$row['carPhoto']}' alt='Car Photo'
                    style='max-width: 50%;'><br>";
            
            $_SESSION['statusCode'] = 10; // Status code 10 - User has requested and been paired with a parking spot


            // SQL Query to set user's ID to rUserID in the matched parking Spot
            // Esentially pairs the user with the spot
            $stmt = $db->prepare("UPDATE Spots SET rUserID = ?, reqStat = 1 WHERE pUserID = ?");
            $stmt->bind_param('ss', $_SESSION['userID'], $row['pUserID']);
            if($stmt->execute()){
                echo "<p>You're now paired with user: {$row['userName']}</p><br>
                <button type='button' class='btn btn-success' id='btnDetails' onclick='viewDetails()'>View Details</button>
                <button type='button' class='btn btn-success' id='btnComplete' onclick='completeTrade()'>Complete Trade</button>
                </div>";
                $stmt->close();
            }
            $res->close();
        }
        else{ // If an available spot has still not been found
            echo "<div class = 'alert alert-info'><strong>We're looking for a spot! </strong>You have <strong>
                    {$_SESSION['tokens']} token(s)</strong> in your account.
                    <br>Please click <strong>Cancel</strong> if you would like to cancel your request</div>";
        }   
    } elseif ($_SESSION['statusCode'] == 0){ // Status code 0 - User is not requesting or offering a spot
        echo "<div class = 'alert alert-success'>We've successfully cancelled your parking spot request</div>";
    }

?>