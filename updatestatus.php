<?php
    session_start();


    // $isOnReqPage = $_POST['isOnReqPage'];
    // echo "{$_SESSION['statusCode']}<br>";

    // update_status($db, $_SESSION['userID']);

    // echo "{$_SESSION['statusCode']}<br>";
    // echo "REQ PAGE{$isOnReqPage}<br";
    // echo gettype($isOnReqPage);
    function update_status($conn, $userID, $isOnReqPage) {
        $isOffering = false;
        $isRequesting = false;

        $offerQuery = $conn->prepare("SELECT * FROM Spots WHERE pUserID = ?");
        $offerQuery->bind_param('s', $userID);

        $offerQuery->execute();

        if ($offerResult = $offerQuery->get_result()){
            $row1 = $offerResult->FETCH_ASSOC();

            if($row1['rUserID'] == NULL){
                $isOffering = true;
                $_SESSION['statusCode'] = 2;
            } else{
                $isOffering = true;
                $_SESSION['statusCode'] = 20;
            }

            if($row1 == NULL){
                $isOffering = false;
            }
            // echo "OFFERED<br>";
        }
        
        $offerResult->close();

        $requestQuery = $conn->prepare("SELECT * FROM Spots WHERE rUserID = ?");
        $requestQuery->bind_param('s', $userID);

        $requestQuery->execute();
        if($requestResult = $requestQuery->get_result()){
            if($row2 = $requestResult->FETCH_ASSOC()){
                $isRequesting = true;
                $_SESSION['statusCode'] = 10;
            }
        }
        
        $requestResult->close();
        if (!$isOffering && !$isRequesting){
            $_SESSION['statusCode'] = 0;
        } 
        if ($isOnReqPage == "1" && $_SESSION['statusCode'] != 2 && $_SESSION['statusCode' != 20]){
            // echo "TEST";
            $_SESSION['statusCode'] = 1;
        }
        // echo "updatestatusphp <br>" . $_SESSION['statusCode'] . "<br>";
    }

    ?>
