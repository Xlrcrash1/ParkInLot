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
        $_SESSION['statusCode'] = 1;    // Requesting parking spot & offerer not found yet
    ?>
    <script src="./javaScript/checkSpots.js"></script>
    <link rel = 'stylesheet' type = 'text/css' href = './CSS/style.css'>

    </head>
    <body>
        <?php
            if ($_SESSION['active'] == true){   
                include('nav.php'); 
        ?>

    <div id='status'>
        <?php
            if ($_SESSION['tokens'] > 0){ ?>
            <div class="alert alert-info" id="request_status">
                <strong>We're looking for a spot! </strong>You have <strong>
                    <?php echo $_SESSION['tokens']; ?> token(s)</strong> in your account.
                <br>Please click <strong>Cancel</strong> if you would like to cancel your request
            </div>

            <!-- <script>
                var spotCheck = setInterval(function()
                { 
                    $.ajax({
                        method:"POST",
                        url:"checkspots.php",
                        data:{userName: "test"},
                        datatype:"html",
                        success:function(data){
                            //do something with response data
                            $("#request_status").html(data)
                        }
                    });
                }, 5000);//time in milliseconds 

                function stopCheck(){
                    clearInterval(spotCheck);
                }
            </script> -->
        <?php       
            // Check for available spot 
            $sql = "SELECT userID, userName, parkingLot, Spots.time 
                    FROM SpotsDetails 
                    INNER JOIN Spots ON userID = pUserID 
                    WHERE rUserID IS NULL 
                    ORDER BY time ASC;";

            $res = $db->query($sql);
            echo "<p>Available Spots</p>";

            while($row = $res->FETCH_ASSOC())
            {
                echo "User Name: {$row['userName']} ---------- Parking Lot: {$row['parkingLot']}";
                echo "<br>";
            }


            } else { ?>
            <div class="alert alert-info">
                <strong>Sorry you do not have any tokens in your account.</strong> You can earn tokens by offering parking spots.
            </div>
        <?php
        } ?>
    </div>
        <?php 
            }
            include('./javaScript/javaScript.html');  
        ?>
    </body>
</html>
