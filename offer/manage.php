<?php
    require('../SQLconnect.php');
    include('../updatestatus.php');

    session_start();

    update_status($db, $_SESSION['userID'], 0);

    $parkingLot = $_POST['parkingLot'];
    $action = $_POST['action'];
    // echo "<div>{$parkingLot}</div>";


    switch ($action) {
        case "add":
            if ($_SESSION['statusCode'] == 20) {
                $checkOfferStatus = "SELECT * FROM RequesterDetails WHERE pUserID = {$_SESSION['userID']}";
                if($offerResult = $db->query($checkOfferStatus)){
                    $row = $offerResult->FETCH_ASSOC();
                    echo "<div class='alert alert-success'><strong>You've already been matched with a requester</strong><br>
                    <img src='{$row['rCarPhoto']}' alt='Car Photo' onerror=\"this.src='../Images/default.jpg';\"
                    class='profile_image_small'>
                    <br>
                    &nbsp;{$row['rUserName']}<br>
                    <br>
                    <button type='button' class='btn btn-outline' id='btnOfferDetails' onclick='offerDetails()'>View Details</button>
                    <br>
                    </div>";
                }
            } elseif ($_SESSION['statusCode'] == 2){
                echo "<div class='alert alert-success'>Your parking spot has been posted and we're working on finding you a match</div>";
            } elseif ($_SESSION['statusCode'] == 10){
                echo "<div class='alert alert-danger'>You're currently requesting a parking spot and have been paired with a user. Please cancel your request before offering a parking spot.</div>";
            } else{
                $_SESSION['statusCode'] = 2;
                // $sql = "SELECT userID, licensePlate FROM Users WHERE userID = {$_SESSION['userID']};";
                $getDetails = $db->prepare("SELECT userID, licensePlate FROM Users WHERE userID = ?");
                $getDetails->bind_param('s', $_SESSION['userID']);
                $getDetails->execute();
                if ($res = $getDetails->get_result()){
                    $row = $res->FETCH_ASSOC();
                    $updateSpots = $db->prepare("INSERT INTO Spots (pUserID, lPlate, parkingLot) VALUES (?, ?, ?)");
                    $updateSpots->bind_param('sss', $_SESSION['userID'], $row['licensePlate'], $parkingLot);

                    if ($updateSpots->execute()){
                        echo "<div class='alert alert-success'>Your parking spot has been posted.<br>
                        We're looking for a requester for your spot</div>";
                    } else{
                        echo "<div class='alert alert-danger'>You're already offering a parking spot</div>";
                    }
                }
            }
            break;
        case "cancel":
            if ($_SESSION['statusCode'] == 2 || $_SESSION['statusCode'] == 20 || $_SESSION['statusCode'] == 0){

                $checkRUserID = $db->prepare("UPDATE Spots SET rUserID = ? WHERE pUserID = ? AND rUserID IS NULL");
                $checkRUserID->bind_param('ii', $_SESSION['userID'], $_SESSION['userID']);
                $checkRUserID->execute();
                $checkRUserID->close();

                $setStatus = $db->prepare("UPDATE Spots SET postStat = 2 WHERE pUserID = ?");
                $setStatus->bind_param('i', $_SESSION['userID']);
                $setStatus->execute();
                $setStatus->close();

                $cancelOffer = $db->prepare("DELETE FROM Spots WHERE pUserID = ?");
                $cancelOffer->bind_param('i', $_SESSION['userID']);

                if ($cancelOffer->execute()){
                    echo "<div class='alert alert-danger'>Parking Spot Offer has been cancelled.</div>";
                } else{
                    echo "<div class='alert alert-danger'><strong>Error.</strong> Sorry we could not cancel your offer. Please refresh the page and try again</div>";
                }
                $_SESSION['statusCode'] = 0;
            } else{
                echo "<div class='alert alert-danger'><strong>Error.</strong> Sorry we could not cancel your offer. Please refresh the page and try again!</div>";
                $_SESSION['statusCode'] = 0;
            }
            $_SESSION['statusCode'] = 0;
            break;

        case "update":
            if ($_SESSION['statusCode'] == 20){
                $checkOfferStatus = "SELECT * FROM RequesterDetails WHERE pUserID = {$_SESSION['userID']}";
                if($offerResult = $db->query($checkOfferStatus)){
                    $row = $offerResult->FETCH_ASSOC();
                    echo "<div class='alert alert-success'><strong>You've already been matched with a requester</strong><br>
                    <img src='{$row['rCarPhoto']}' alt='Car Photo' onerror=\"this.src='../Images/default.jpg';\"
                    class='profile_image_small'>
                    <br>
                    &nbsp;{$row['rUserName']}<br>
                    <br>
                    <button type='button' class='btn btn-outline' id='btnOfferDetails' onclick='offerDetails()'>View Details</button>
                    <br>
                    </div>";
                }
            }
    }

?>
