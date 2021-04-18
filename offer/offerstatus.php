<?php
    require('../SQLconnect.php');
    session_start();

    include('../updatestatus.php');
    update_status($db, $_SESSION['userID'], 0);

    if($_SESSION['statusCode'] == 20){

        // $checkOfferStatus = $db->prepare("SELECT * FROM RequesterDetails WHERE pUserID = ?");
        // $checkOfferStatus->bind_param('s', $_SESSION['userID']);
        $checkOfferStatus = "SELECT * FROM RequesterDetails WHERE pUserID = {$_SESSION['userID']}";

        // $checkOfferStatus->execute();

        // $offerResult = $db->query($checkOfferStatus);
        // echo "Error: {$checkOfferStatus->error}";
        if($offerResult = $db->query($checkOfferStatus)){
            $row = $offerResult->FETCH_ASSOC();
            echo "<div class='alert alert-success'><strong>Requester found for your parking spot</strong><br>
            User Name: {$row['rUserName']}<br>
            <img src='{$row['rCarPhoto']}' alt='Car Photo'
            style='max-width: 50%;'><br>
            <br>
            <button type='button' class='btn btn-info' id='btnOfferDetails' onclick='offerDetails()'>View Details</button>
            <br>
            </div>";
        }
        $offerResult->close();
    } else{
        echo "<div class='alert alert-info'>Your parking spot has been posted and we're still looking for a requester</div>";
    }


                                
?>