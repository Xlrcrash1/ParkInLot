<?php
    require('SQLconnect.php');
    session_start();

    $parkingLot = $_POST['parkingLot'];
    $action = $_POST['action'];
    // echo "<div>{$parkingLot}</div>";

    switch ($action) {
        case "add":
            if ($_SESSION['statusCode'] == 20) {
                echo "<div class='alert alert-success'>You've been matched with a requester</div>";
            } elseif ($_SESSION['statusCode'] == 2){
                echo "<div class='alert alert-success'>Your parking spot has been posted and we're working on finding you a match</div>";
            } else {
                $_SESSION['statusCode'] = 2;
                // $sql = "SELECT userID, licensePlate FROM Users WHERE userID = {$_SESSION['userID']};";
                $sql = $db->prepare("SELECT userID, licensePlate FROM Users WHERE userID = ?");
                $sql->bind_param('s', $_SESSION['userID']);
                $sql->execute();
                if ($res = $sql->get_result()){
                    $row = $res->FETCH_ASSOC();
                    $sql2 = $db->prepare("INSERT INTO Spots (pUserID, lPlate, parkingLot) VALUES (?, ?, ?)");
                    $sql2->bind_param('sss', $_SESSION['userID'], $row['licensePlate'], $parkingLot);
        
                    if ($sql2->execute()){
                        echo "<div class='alert alert-success'>Your parking spot has been posted.</div>";
                    } else{
                        echo "<div class='alert alert-danger'>You're already offering a parking spot</div>";
                    }
                }
            }
            break;
        case "cancel":
            if ($_SESSION['statusCode'] == 2 || $_SESSION['statusCode'] == 20 || $_SESSION['statusCode'] == 0){

                $checkRequestor = $db->prepare("UPDATE Spots SET rUserID = ? WHERE pUserID = ? AND rUserID IS NULL");
                $checkRequestor->bind_param('ii', $_SESSION['userID'], $_SESSION['userID']);
                $checkRequestor->execute();

                $setStatus = $db->prepare("UPDATE Spots SET reqStat = 2 WHERE pUserID = ?");
                $setStatus->bind_param('i', $_SESSION['userID']);
                $setStatus->execute();

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
            break;
            $_SESSION['statusCode'] = 0;
    }

?>