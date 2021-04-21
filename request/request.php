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
        <link rel = 'stylesheet' type='text/css' href = '../CSS/type_scale.css'>
        <link rel = 'stylesheet' type='text/css' href = '../CSS/style.css'>
    <?php
        require('../SQLconnect.php');
        // include('../CSS/bootStrap.html');
    ?>
    <script src="../javaScript/requestSpots.js"></script>
    <!-- <link rel = 'stylesheet' type = 'text/css' href = '../CSS/style.css'> -->

    </head>
    <body>
        <?php
            if ($_SESSION['active'] == true){
                include('./nav.php');
                include('../updatestatus.php');
                update_status($db, $_SESSION['userID'], 1);
        ?>

    <div class = 'container'>
        <div id='status'>
            <?php
            if ($_SESSION['statusCode'] == 0 || $_SESSION['statusCode'] == 1 || $_SESSION['statusCode'] == 10){
                $_SESSION['statusCode'] = 1;

                if ($_SESSION['tokens'] > 0){
            ?>

            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <h1 class="spot_title">Request a spot</h1>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

                <!-- Searching for a parking spot -->
                <div class="row">
                    <div class="col-xs-0 col-lg-4 side"></div>
                    <div class="col main">
                        <div id="request_status">
                            <div class="alert alert-info">
                                <strong>We're looking for a spot! </strong>You have <strong>
                                    <?php echo $_SESSION['tokens']; ?> token(s)</strong> in your account.
                                <br>Please click <strong>Cancel</strong> if you would like to cancel your request
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-0 col-lg-4 side"></div>
                </div>


            <?php
                // Check for and list available spots for debugging
                $availableSpots = "SELECT Spots.pUserID, userName, parkingLot, Spots.time
                        FROM SpotsDetails
                        INNER JOIN Spots ON Spots.pUserID = SpotsDetails.pUserID
                        WHERE Spots.rUserID IS NULL
                        ORDER BY time ASC;";

                $result = $db->query($availableSpots);
                echo "<br><div class='row'><div class='col-xs-0 col-lg-4 side'></div><div class='col main'><h2>Available Spots</h2></div><div class='col-xs-0 col-lg-4 side'></div></div>";

                while($row = $result->FETCH_ASSOC()){
                    echo "<div class='row'><div class='col-xs-0 col-lg-4 side'></div><div class='col main'><strong>Parking Lot:</strong> {$row['parkingLot']}&emsp;&emsp;&emsp;<strong>User:</strong> {$row['userName']}</div><div class='col-xs-0 col-lg-4 side'></div></div>";
                }
                $result->close();

                } else{ // No tokens on the account
                ?>
                <div class="row">
                    <div class="col-xs-0 col-lg-4 side"></div>
                    <div class="col main">
                        <div class="alert alert-info">
                            <strong>Sorry you do not have any tokens in your account.</strong> You can earn tokens by offering parking spots.
                        </div>
                    </div>
                    <div class="col-xs-0 col-lg-4 side"></div>
                </div>

            <?php
                }
            } elseif ($_SESSION['statusCode'] == 2 || $_SESSION['statusCode'] == 20){
            ?>

            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <div class="alert alert-info">
                        Sorry it seems you're offering a spot. Please go to the Spot Offer page and Cancel your offer before requesting a parking spot.
                    </div>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

            <?php
                }

            }
                include('../javaScript/javaScript.html');
            ?>
        </div>

        <br>
        <div class="row">
            <div class="col-xs-0 col-lg-4 side"></div>
            <div class="col main">
                <button type="button" class="btn btn-primary" id="btnRequest" onclick="submitRequest()">Request a spot</button>
            </div>
            <div class="col-xs-0 col-lg-4 side"></div>
        </div>

        <div class="row">
            <div class="col-xs-0 col-lg-4 side"></div>
            <div class="col main">
                <button type="button" class="btn btn-danger" id="btnCancel" onclick="cancelRequest()">Cancel</button>
            </div>
            <div class="col-xs-0 col-lg-4 side"></div>
        </div>

    </div>
    </body>
</html>
