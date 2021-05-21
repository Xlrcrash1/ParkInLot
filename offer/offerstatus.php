<?php
    require('../SQLconnect.php');
    session_start();

    include('../updatestatus.php');
    update_status($db, $_SESSION['userID'], 0); // Update SESSION statusCode variable

    if($_SESSION['statusCode'] == 20){ // If user is offering a spot and paired with a requester

        $checkOfferStatus = "SELECT * FROM RequesterDetails WHERE pUserID = {$_SESSION['userID']}"; // Query requester details

        if($offerResult = $db->query($checkOfferStatus)){ // If query successful, output details message
            $row = $offerResult->FETCH_ASSOC();
            echo "<div class='alert alert-info'><strong>Requester found for your parking spot</strong><br>
            <img src='{$row['rCarPhoto']}' alt='Car Photo' onerror=\"this.src='../Images/default.jpg';\"
            class='profile_image_small'>
            <br>
            &nbsp;<h2>{$row['rUserName']}</h2><br>
            <h4>{$row['rColor']} {$row['rYear']} {$row['rMake']} {$row['rModel']}</h4><br>
            <h4>License Plate: {$row['rLicensePlate']}</h4><br>

            <br>
            <button type='button' class='btn btn-outline' id='btnOfferDetails' onclick='offerDetails()'>View Details</button>
            <br>
            </div>";
        }
        $offerResult->close();
    } else{ // No requester found
        echo "<div class='alert alert-info'>Your parking spot has been posted and we're still looking for a requester</div>";
    }



?>
