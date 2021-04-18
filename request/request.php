<?php

session_start();
if ($_SESSION['active'] == false){

    header('location: ../login.php'); exit();
}

?>

<!DOCTYPE = HTML>
<html>
    <head>
    <title>ParkInLot</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/dist/css/style.css">
        <link rel = 'stylesheet' type='text/css' href = '../CSS/color_palette.css'>
        <link rel = 'stylesheet' type='text/css' href = '../CSS/style.css'>
        <link rel = 'stylesheet' type='text/css' href = '../CSS/type_scale.css'>
    <?php 
        require('../SQLconnect.php');
        include('../CSS/bootStrap.html');
    ?>
    <script src="../javaScript/requestSpots.js"></script>
    <link rel = 'stylesheet' type = 'text/css' href = '../CSS/style.css'>

    </head>
    <body>
        <?php
            if ($_SESSION['active'] == true){   
                include('./nav.php'); 
                include('../updatestatus.php');
                update_status($db, $_SESSION['userID'], 1);
        ?>

    <div id='status'>
        <?php
        if ($_SESSION['statusCode'] == 0 || $_SESSION['statusCode'] == 1 || $_SESSION['statusCode'] == 10){
            $_SESSION['statusCode'] = 1;

            if ($_SESSION['tokens'] > 0){ ?>
            
            <!-- Searching for a parking spot -->
            <div id="request_status">
                <div class="alert alert-info">
                    <strong>We're looking for a spot! </strong>You have <strong>
                        <?php echo $_SESSION['tokens']; ?> token(s)</strong> in your account.
                    <br>Please click <strong>Cancel</strong> if you would like to cancel your request
                </div>
            </div>

        <?php       
            // Check for and list available spots for debugging
            $availableSpots = "SELECT Spots.pUserID, userName, parkingLot, Spots.time 
                    FROM SpotsDetails 
                    INNER JOIN Spots ON Spots.pUserID = SpotsDetails.pUserID 
                    WHERE Spots.rUserID IS NULL 
                    ORDER BY time ASC;";

            $result = $db->query($availableSpots);
            echo "<p>Available Spots</p>";

            while($row = $result->FETCH_ASSOC()){
                echo "User Name: {$row['userName']} ---------- Parking Lot: {$row['parkingLot']}";
                echo "<br>";
            }
            $result->close();

            } else{ // No tokens on the account 
            ?>
            <div class="alert alert-info">
                <strong>Sorry you do not have any tokens in your account.</strong> You can earn tokens by offering parking spots.
            </div>

        <?php
            } 
        } elseif ($_SESSION['statusCode'] == 2 || $_SESSION['statusCode'] == 20){
        ?>
                <div class="alert alert-info">
                    Sorry it seems you're offering a spot. Please go to the Spot Offer page and Cancel your offer before requesting a parking spot.
                </div>
        <?php
            }
            
        }
            include('../javaScript/javaScript.html');  
        ?>
        </div>
        <button type="button" class="btn btn-success" id="btnRequest" onclick="submitRequest()">Request a Spot</button>
        <button type="button" class="btn btn-danger" id="btnCancel" onclick="cancelRequest()">Cancel</button>
    </body>
</html>
