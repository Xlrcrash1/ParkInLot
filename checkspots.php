<?php
    require('SQLconnect.php');
    session_start();

    $checkExisting = "SELECT userID, userName, parkingLot, Spots.time, carPhoto FROM SpotsDetails 
    INNER JOIN Spots ON userID = pUserID 
    WHERE rUserID = {$_SESSION['userID']};";
    // $checkExisting->bind_param('s', $_SESSION['userID']);
    // $checkExisting->execute();
    $res = $db->query($checkExisting);

    if ($r = $res->FETCH_ASSOC()){

        echo "<div class ='alert alert-success'><strong>You've already been paired with user {$r['userName']}</strong><br>
        User Name: {$r['userName']}<br>
        Parking Lot: {$r['parkingLot']}<br>
        <img src='{$r['carPhoto']}' alt='Car Photo'
                style='max-width: 50%;'><br>";
        
        $_SESSION['statusCode'] = 10;
        $res->close();
    } elseif ($_SESSION['statusCode'] == 1){
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

            $stmt = $db->prepare("UPDATE Spots SET rUserID = ?, reqStat = 1 WHERE pUserID = ?");
            $stmt->bind_param('ss', $_SESSION['userID'], $row['userID']);
            if($stmt->execute()){
                echo "<p>You're now paired with user: {$row['userName']}</p>";
                $stmt->close();
            }
            $res->close();
        }
        else{
            echo "<div class = 'alert alert-info'><strong>We're looking for a spot! </strong>You have <strong>
                    {$_SESSION['tokens']} token(s)</strong> in your account.
                    <br>Please click <strong>Cancel</strong> if you would like to cancel your request</div>";
        }   
    } elseif ($_SESSION['statusCode'] == 0){
        echo "<div class = 'alert alert-success'>We've successfully cancelled your parking spot request</div>";
    }

?>