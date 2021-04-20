<?php
    
session_start();

if ($_SESSION['active'] && $_SESSION['access'] > 1){    ?>

    <!Doctype html>
    <html lang = 'en'>

        <head>

            <title>DataBase Queries</title>

            <?php   include('./CSS/bootStrap.html');    ?>
            <link rel = 'stylesheet' type='text/css' href = './CSS/style.css'>
        </head>
        <body>

            <?php

            require('SQLconnect.php');

            //echo "POST: $_POST[databaseQuery]\n\n<br>";

            
            $sql = "$_POST[databaseQuery]";
            //echo "SQL Statement: $sql\n<br>";

            if ($sql == 'select * from Users'){

            if ($res = $db->query($sql)){

                //echo "succssful sql query<br>\n";
                $row = $res->FETCH_ASSOC();
                //echo "1st  Fetch Assoc successful<br>\n";

                //Sub query for max number of entries 
                $sql2 = "select max(userID) from Users;";
                //echo "SQL2 Statement: $sql2<br>\n";

                if ($res = $db->query($sql2)){

                    //echo "successful second sql query<br>\n";

                    $row = $res->FETCH_ASSOC();
                    //echo "2nd Fetch Assoc successful<br>\n";

                    $maxUsers = $row['max(userID)'];
                    //echo "maxUsers = $maxUsers<br>\n";   
                }
            }

            //echo "maxUsers right outside of loop: $maxUsers<br>\n";
            ?>
            <table class="table table-hover table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">userID</th>
                        <th scope="col">firstName</th>
                        <th scope="col">lastName</th>
                        <th scope="col">userName</th>
                        <th scope="col">password</th>
                        <th scope="col">email</th>
                        <th scope="col">access</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    for ($num = 1; $num <= $maxUsers; $num++){
                        
                        //echo "User number: $num<br>\n";
                        if ($_SESSION['access'] > 1){

                            $sql = "{$_POST['databaseQuery']} where userID=$num";
                            //echo "SQL statement inside for loop: $sql<br>\n";

                            if ($res = $db->query($sql)){

                                //echo "Successful for loop subquery<br>\n";
                                if ($row = $res->FETCH_ASSOC()){

                                //Testing row assign
                                //echo "Testing Row Assign: {$row['userID']}<br>\n";

                                echo    "<tr>\n";
                                    echo    "<th scope='row'>{$row['userID']}</th>\n";
                                    echo    "<td>{$row['firstName']}</td>\n";
                                    echo    "<td>{$row['lastName']}</td>\n";
                                    echo    "<td>{$row['userName']}</td>\n";
                                    echo    "<td>{$row['password']}</td>\n";
                                    echo    "<td>{$row['email']}</td>\n";
                                    echo    "<td>{$row['access']}</td>\n";
                                echo    "</tr>\n";
                                }
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>

            <?php   

                }elseif ($sql == 'select * from Spots'){

                    $sql = "select Spots.pUserID, SpotsDetails.userName, SpotsDetails.make, SpotsDetails.model, SpotsDetails.licensePlate, Spots.parkingLot, SpotsDetails.time, Spots.reqStat, Spots.postStat  from SpotsDetails inner join Spots on SpotsDetails.pUserID=Spots.pUserID";
                    if ($res = $db->query($sql)){

                        //echo "succssful sql query<br>\n";
                        $row = $res->FETCH_ASSOC();
                        //echo "1st  Fetch Assoc successful<br>\n";
        
                        //Sub query for max number of entries 
                        $sql2 = "select max(puserID) from Spots;";
                        //echo "SQL2 Statement: $sql2<br>\n";
        
                        if ($res = $db->query($sql2)){
        
                            //echo "successful second sql query<br>\n";
        
                            $row = $res->FETCH_ASSOC();
                            //echo "2nd Fetch Assoc successful<br>\n";
        
                            $maxUsers = $row['max(puserID)'];
                            //echo "maxUsers = $maxUsers<br>\n";   
                        }
                    }
        
                    //echo "maxUsers right outside of loop: $maxUsers<br>\n";
                    ?>
                    <table class="table table-hover table-dark">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">userName</th>
                                <th scope="col">make</th>
                                <th scope="col">model</th>
                                <th scope="col">licensePlate</th>
                                <th scope="col">parkingLot</th>
                                <th scope="col">time</th>
                                <th scope="col">reqStat</th>
                                <th scope="col">postStat</th>
                            </tr>
                        </thead>
        
                        <tbody>
                            <?php 
                            for ($num = 1; $num <= $maxUsers; $num++){
                                
                                //echo "User number: $num<br>\n";
                                if ($_SESSION['access'] > 1){
        
                                    //$sql = "{$_POST['databaseQuery']} where puserID=$num";
                                    $sql = "select Spots.pUserID, SpotsDetails.userName, SpotsDetails.make, SpotsDetails.model, SpotsDetails.licensePlate, Spots.parkingLot, SpotsDetails.time, Spots.reqStat, Spots.postStat  from SpotsDetails inner join Spots on SpotsDetails.pUserID=Spots.pUserID where Spots.pUserID=$num";
                                    //echo "SQL statement inside for loop: $sql<br>\n";
        
                                    if ($res = $db->query($sql)){
        
                                        //echo "Successful for loop subquery<br>\n";
                                        if ($row = $res->FETCH_ASSOC()){
        
                                        //Testing row assign
                                        //echo "Testing Row Assign: {$row['userID']}<br>\n";
        
                                        echo    "<tr>\n";
                                            echo    "<th scope='row'>{$row['userName']}</th>\n";
                                            echo    "<td>{$row['make']}</td>\n";
                                            echo    "<td>{$row['model']}</td>\n";
                                            echo    "<td>{$row['licensePlate']}</td>\n";
                                            echo    "<td>{$row['parkingLot']}</td>\n";
                                            echo    "<td>{$row['time']}</td>\n";
                                            echo    "<td>{$row['reqStat']}</td>\n";
                                            echo    "<td>{$row['postStat']}</td>\n";
                                        echo    "</tr>\n";
                                        }
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>        
                    <?php          
                }elseif ($sql == 'select * from passwordReset'){

                    if ($res = $db->query($sql)){
        
                        //echo "succssful sql query<br>\n";
                        $row = $res->FETCH_ASSOC();
                        //echo "1st  Fetch Assoc successful<br>\n";
        
                        //Sub query for max number of entries 
                        $sql2 = "select max(requestID) from passwordReset;";
                        //echo "SQL2 Statement: $sql2<br>\n";
        
                        if ($res = $db->query($sql2)){
        
                            //echo "successful second sql query<br>\n";
        
                            $row = $res->FETCH_ASSOC();
                            //echo "2nd Fetch Assoc successful<br>\n";
        
                            $maxUsers = $row['max(requestID)'];
                            //echo "maxUsers = $maxUsers<br>\n";   
                        }
                    }
        
                    //echo "maxUsers right outside of loop: $maxUsers<br>\n";
                    ?>
                    <table class="table table-hover table-dark">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">requestID</th>
                                <th scope="col">email</th>
                                <th scope="col">token</th>
                                <th scope="col">timeRequested</th>
                                <th scope="col">timeExpires</th>
                                <th scope="col">resetAttempts</th>
                                <th scope="col">active</th>
                            </tr>
                        </thead>
        
                        <tbody>
                            <?php 
                            for ($num = 1; $num <= $maxUsers; $num++){
                                
                                //echo "User number: $num<br>\n";
                                if ($_SESSION['access'] > 1){
        
                                    $sql = "{$_POST['databaseQuery']} where requestID=$num";
                                    //echo "SQL statement inside for loop: $sql<br>\n";
        
                                    if ($res = $db->query($sql)){
        
                                        //echo "Successful for loop subquery<br>\n";
                                        if ($row = $res->FETCH_ASSOC()){
        
                                        //Testing row assign
                                        //echo "Testing Row Assign: {$row['userID']}<br>\n";
        
                                        echo    "<tr>\n";
                                            echo    "<th scope='row'>{$row['requestID']}</th>\n";
                                            echo    "<td>{$row['email']}</td>\n";
                                            echo    "<td>{$row['token']}</td>\n";
                                            echo    "<td>{$row['timeRequested']}</td>\n";
                                            echo    "<td>{$row['timeExpires']}</td>\n";
                                            echo    "<td>{$row['resetAttempts']}</td>\n";
                                            echo    "<td>{$row['active']}</td>\n";
                                        echo    "</tr>\n";
                                        }
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>   
                <?php } 
            
            include('./javaScript/javaScript.html');    ?>
        </body>
    </html>

    <?php
}
else{

    header('location: login.php'); 
    exit();
}
?>