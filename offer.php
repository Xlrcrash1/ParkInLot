<?php

session_start();
if ($_SESSION['active'] == false){

    header('location: login.php'); exit();
}

?>

<!DOCTYPE = HTML>
<html>
    <head>
        <title>ParkInLot</title>
    <?php 
        require('SQLconnect.php');
        include('./CSS/bootStrap.html');
        $_SESSION['statusCode'] = 0;    // Offering parking spot & requester not found yet
    ?>
    <!-- <script src="./javaScript/offerSpots.js"></script> -->
    <link rel = 'stylesheet' type = 'text/css' href = './CSS/style.css'>

    </head>
    <body>
        <?php
        if ($_SESSION['active'] == true){   
            include('nav.php'); 
        }
            
        if($_SESSION['statusCode'] == 2){
            echo "Already Offering";
        }
        else{
        ?>

        <div id='status'>
            <div class="form-group">
                <label for="parking_lot">Parking Lot</label>
                <select class="form-control" style="width:auto;" id="parking_lot">
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
            </div>
            <div class="alert alert-info" id="offer_status">
                <strong>You are not yet offering your parking spot. </strong>
                <br>Please enter your parking lot to continue or you can click <strong>Cancel</strong> if you would like to cancel your offer.
            </div>

            <button type="button" class="btn btn-success" id="btnOffer" onclick="getParkingLot()">Offer my Spot</button>
            <button type="button" class="btn btn-danger" id="btnCancel">Cancel</button>
        </div>

        <script>
            function getParkingLot() {
                var select = document.getElementById("parking_lot");
                var parkingLot = select.value;
                console.log(typeof select);
                offerParkingSpot(parkingLot);
            };

            function offerParkingSpot(parkingLot){
                // var lotStr = JSON.stringify(lot);
                // console.log(lot)
                // console.log(typeof lot);
                $.ajax({
                    method: "POST",
                    url: "addspot.php",
                    data: {parkingLot:parkingLot},
                    dataType: "html",
                    success:function(data){
                        $("#offer_status").html(data)
                    }
                });
            }
        </script>
        <?php
        }
        ?>
        <?php 
            include('./javaScript/javaScript.html');  
        ?>
    </body>
</html>
