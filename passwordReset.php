<?php 

session_start();

if ($_SESSION['active']){

    header('location: index.php'); exit();
}
else{  
    
    $token = $_GET['Token'];

    if (empty($token)){

        echo "<script> 
                                    
            alert('This link is inaccessible without a token, please request a Password Reset Token First. You will now be redirected there...');
            window.location = 'emailPasswordReset.php';
                                    
            </script><br>\n
        ";
        //echo "Token is emtpy: $token<br>\n";
    }
    else{

        //echo "Token is not empty: $token<br>\n";

        require('SQLconnect.php'); 
        $sql = "select * from passwordReset where token = '$token' limit 1";
        //echo "SQL = $sql<br>\n";

        if ($res = $db->query($sql)){

            //echo "Querying the database was successful<br>\n";
       
            if ($row = $res->FETCH_ASSOC()){

                $active = $row['active'];
                //echo "Active: $active<br>\n";

                if ($active == 0){

                    echo "<script> 
                    
                        alert('Sorry, this Link is no longer active :( Your token has expired. Request a new one');
                        window.location = 'emailPasswordReset.php';
                    
                    </script><br>\n";
                }
                else{

                    //echo "Youre link is still active<br>\n";

                    $email = $row['email'];
                    //echo "email: $email<br>\n";

                    $timeRequested = $row['timeRequested'];
                    //echo "Time Requested: $timeRequested<br>\n";

                    $timeExpires = $row['timeExpires'];
                    //echo "Time Expires: $timeExpires<br>\n";
                }
            }
        }
        else{

            echo "Querying the database failed, Alert an Administrator. Error 67 on passwordReset!<br>\n";
        }
    }
    ?>

    <!DOCTYPE  HTML>
    <html>

        <head>
            <title>Password Reset</title>

            <?php   include('./CSS/bootStrap.html');    ?>
            <link rel = 'stylesheet' type = 'text/css' href = './CSS/style.css'>
        </head>

        <body>

            <div class ='ParkInLotLogo'>

                <img src = './Images/ParkInLot.jpg' class='loginLogo'>
            </div>

            <div class = 'container'>

            <form method = "POST" class = "passwordReset">

                <div class="form-group">

                    <input type="password" class="form-control loginFormInput" id="password" placeholder="Enter New Password" name = "password">
                </div>
                <div class="form-group">

                    <input type="password" class="form-control loginFormInput" id="confirmPassword" placeholder="Confirm Password" name = "confirmPassword">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>



                <?php

                if (!empty($_POST['password']) && !empty($_POST['confirmPassword'])){

                    $password = htmlspecialchars(trim($_POST['password']));/////////////////ADD SANATIZATION
                    $confirmPassword = htmlspecialchars(trim($_POST['confirmPassword']));

                    //echo "info: $password and $confirmPassword<br>\n";

                    if($password == $confirmPassword){

                        //echo "Passwords matched<br>\n";

    
                        $getTimestamp = "select current_timestamp";

                        if ($res = $db->query($getTimestamp)){

                            //echo "queried database for time<br>\n";
                            $row = $res->FETCH_ASSOC();
                            $currentTimestamp = $row['current_timestamp'];
                            echo "Current TimeStamp: $currentTimestamp<br>\n";
                        }
                        else{

                            echo "Getting current time failed, notify an Administrator. Error code 131 on passwordReset.<br>\n";
                        }

                        //checking if current time is between requested and expired
                        if ($currentTimestamp >= $timeRequested && $currentTimestamp <= $timeExpires){

                            //echo "Time is still good, password is resetting<br>\n";
                            $passwordResetAccount = "update Users set password = '$password' where email = '$email'";
                            //echo "Password Reset for: $passwordResetAccount<br>\n";

                            $res = $db->query($passwordResetAccount);

                            $zero = 0;
                            $deactivate = "update passwordReset set active = '$zero' where token = '$token'";
                            //echo "deactivate: $deactivate<br>\n";

                            $res = $db->query($deactivate);

                            echo "<script> 
                                        
                                alert('Password has been reset successfully, try logging in now! :)');
                                window.location = 'login.php';
                                        
                            </script><br>\n";
                            exit();     
                        }
                        elseif($currentTimestamp >= $timeExpires){

                            $zero = 0;
                            $deactivate = "update passwordReset set active = '$zero' where token = '$token'";
                            //echo "deactivate: $deactivate<br>\n";

                            $res = $db->query($deactivate);
                            
                            //echo "Sorry, token expired<br>\n";/*
                            echo "<script> 
                                        
                                alert('Sorry :/  It seems that you took too long to reset your password, please request another Password Reset Token');
                                window.location = 'emailPasswordReset.php';
                                        
                            </script><br>\n";
                            exit();

                        }
                    }
                    else{

                        echo "<br><br>Hey! So Umm... Awkward... Your Passwords didn't match...<br>\n";
                    }
                }
                else{

                    //echo "Hey, you can't set your password to null, making sure there's something in those fields<br>\n";
                }   ?>

            </div>
            <?php   include('./javaScript/javaScript.html');    ?>
        </body>
    </html>

<?php 
} ?>