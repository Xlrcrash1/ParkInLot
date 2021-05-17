<?php
    session_start();

    // Function updates the SESSION statusCode of the user
    // Status Codes
    // 0 - Not requesting, not offering
    // 1 - Requesting a parking spot
    // 10 - Requesting and found a parking spot
    // 2 - Offering a parking spot
    // 20 - Offering and found a requester
    // 3 - Transaction completed
    function update_status($conn, $userID, $isOnReqPage) { 

        $isOffering = false;
        $isRequesting = false;

        // Check data base to see if user is offering any spots 
        $offerQuery = $conn->prepare("SELECT * FROM Spots WHERE pUserID = ?");
        $offerQuery->bind_param('s', $userID);

        $offerQuery->execute();

        // If a query result is found
        if ($offerResult = $offerQuery->get_result()){
            $row1 = $offerResult->FETCH_ASSOC();

            if($row1['rUserID'] == NULL){   // If a requester has not been found for the spot 
                $isOffering = true;
                $_SESSION['statusCode'] = 2;
            } else{                         // If a requester has been found for a spot
                $isOffering = true;
                $_SESSION['statusCode'] = 20;
            }

            if($row1 == NULL){ // If there's no query results, set isOffering flag to false
                $isOffering = false;
            }
            // echo "OFFERED<br>";
        }
        
        $offerResult->close();

        // Check data base to see if user is requesting any spots 
        $requestQuery = $conn->prepare("SELECT * FROM Spots WHERE rUserID = ?");
        $requestQuery->bind_param('s', $userID);

        $requestQuery->execute();

        if($requestResult = $requestQuery->get_result()){ 
            if($row2 = $requestResult->FETCH_ASSOC()){ // If query results are found
                $isRequesting = true;
                $_SESSION['statusCode'] = 10;
            }
        }
        
        $requestResult->close();
        if (!$isOffering && !$isRequesting){    // If user is not requesting or offering
            $_SESSION['statusCode'] = 0;
        } 

        // Extra check to see if user is actively requesting
        if ($isOnReqPage == "1" && $_SESSION['statusCode'] != 2 && $_SESSION['statusCode' != 20]){
            $_SESSION['statusCode'] = 1;
        }


        // Update user's session token values
        $tokenQuery = "SELECT * FROM Users WHERE userID = {$userID};";

        $_SESSION['tokens'] = $row3['tokens'];
        if ($tokenResult = $conn->query($tokenQuery)){
            $row3 = $tokenResult->FETCH_ASSOC();
            $_SESSION['tokens'] = $row3['tokens'];
        }

        $tokenResult->close();

    }

    ?>
