<?php
    require('SQLconnect.php');
    session_start();

    $parkingLot = $_POST['parkingLot'];

    // echo "<div>{$parkingLot}</div>";
    if ($_SESSION['statusCode'] == 20) {
        echo "<div class='alert alert-success'>You've been matched with a requester</div>";
    } elseif ($_SESSION['statusCode'] == 2){
        echo "<div class='alert alert-success'>You've offered your parking spot and we're working on finding you a match</div>";
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
            }
        }
    }

?>