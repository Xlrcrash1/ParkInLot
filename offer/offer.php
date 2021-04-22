<?php

session_start();
if ($_SESSION['active'] == false){

    header('location: ./login.php'); exit();
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
        $_SESSION['statusCode'] = 0;    // statusCode 0 - User is not offering or requesting a parking spot
    ?>
    <script src="../javaScript/offerSpots.js"></script>
    <!-- <link rel = 'stylesheet' type = 'text/css' href = '../CSS/style.css'> -->

    </head>
    <body>
        <?php
        if ($_SESSION['active'] == true){
            include('./nav.php');
            include('../updatestatus.php');
            include('../javaScript/javaScript.html');

            // echo $_SESSION['statusCode'] + "<br>";
            update_status($db, $_SESSION['userID'], 0);
            // echo $_SESSION['statusCode'] + "<br>";
            ?>

        <div class = 'container'>
        <div class="row">
            <div class="col-xs-0 col-lg-4 side"></div>
            <div class="col main">
                <h1 class="spot_title">Offer a spot</h1>
            </div>
            <div class="col-xs-0 col-lg-4 side"></div>
        </div>

        <?php
        }
        if($_SESSION['statusCode'] == 2){
            echo "<div class='row'>
                <div class='col-xs-0 col-lg-4 side'></div>
                <div class='col main'>";
            echo "<div id='offer_status'>
                    <div class='alert alert-info'>You're already offering a parking spot. We're still looking for a requester.</div>
                    </div>";
            echo "<div id='comp_status'></div>";
            echo "<script>spotCheck();</script>";
            echo "</div>
                    <div class='col-xs-0 col-lg-4 side'></div>
                    </div>";

        } elseif($_SESSION['statusCode'] == 20) {
            echo "<div class='row'>
                <div class='col-xs-0 col-lg-4 side'></div>
                <div class='col main'>";
            echo "<div id='offer_status'>
                    <div class='alert alert-info'><strong>You're already paired with a user.</strong><br><br>
                    <button type='button' class='btn btn-outline' id='btnUpdate' onclick='updateOffer()'>More Information</button>
                    </div>
                </div>";
            echo "</div>
                    <div class='col-xs-0 col-lg-4 side'></div>
                        </div>";
            echo "<div id='comp_status'></div>";

        } elseif($_SESSION['statusCode'] == 10){
            echo "<div class='row'>
                <div class='col-xs-0 col-lg-4 side'></div>
                <div class='col main'>";
            echo "<div id='offer_status'>
                <div class='alert alert-danger'>You're currently requesting a spot and paried with a user. Please cancel your request in the Spot Request page before offering a parking spot.</div>
                </div>";
            echo "</div>
                    <div class='col-xs-0 col-lg-4 side'></div>
                        </div>";
            echo "<div id='comp_status'></div>";

        }else{
        ?>

        <div class="row">
            <div class="col-xs-0 col-lg-4 side"></div>
            <div class="col main">
                <div id="offer_status">
                    <div class = "alert alert-info">
                        <h5><strong>You are not yet offering your parking spot. </strong></h5>
                        <br>Please enter your parking lot to continue or you can click <strong>Cancel</strong> if you would like to cancel your offer.
                    </div>
                </div>
            </div>
            <div class="col-xs-0 col-lg-4 side"></div>
        </div>

            <div id='comp_status'></div>

            <!-- <button type="button" class="btn btn-success" id="btnOffer" onclick="submitOffer()">Offer my Spot</button> -->
            <!-- <button type="button" class="btn btn-danger" id="btnCancel" onclick="cancelOffer()">Cancel</button> -->

        <?php
        }
        ?>

        <div class="row">
            <div class="col-xs-0 col-lg-4 side"></div>
            <div class="col main">
                <div id='lot_choice'>
                    <div class="form-group">
                        <br>
                        <label for="parking_lot">
                            <h3>Parking Lot</h3>
                        </label>
                        <select class="form-control lot-form" id="parking_lot">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                            <option value="G">G</option>
                            <option value="H">H</option>
                            <option value="I">I</option>
                            <option value="J">J</option>
                            <option value="K1">K1</option>
                            <option value="K2">K2</option>
                            <option value="L">L</option>
                            <option value="M">M</option>
                        </select>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-xs-0 col-lg-4 side"></div>
        </div>

        <div class="row">
            <div class="col-xs-0 col-lg-4 side"></div>
            <div class="col main">
                <button type="button" class="btn btn-primary" id="btnOffer" onclick="submitOffer()">Offer my spot</button>
            </div>
            <div class="col-xs-0 col-lg-4 side"></div>
        </div>

        <div class="row">
            <div class="col-xs-0 col-lg-4 side"></div>
            <div class="col main">
                <button type="button" class="btn btn-danger" id="btnCancel" onclick="cancelOffer()">Cancel</button>
            </div>
            <div class="col-xs-0 col-lg-4 side"></div>
        </div>

        <?php
            // include('./javaScript/javaScript.html');
        ?>

    </div>
    </body>
</html>
