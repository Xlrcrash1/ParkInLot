<?php 

session_start();

if ($_SESSION['active']){

    header('location: index.php'); exit();
}   ?>

<!DOCTYPE  HTML>
<html>

    <head>
        <title>Login</title>

        <?php   include('./CSS/bootStrap.html');    ?>
        <link rel = 'stylesheet' type = 'text/css' href = './CSS/style.css'>
    </head>
    
    <body>
        
        <?php   include('nav.php'); 
        
        require('SQLconnect.php'); ?>
        
        <p>You're not signed in yet...</p>
        
        <div class ='ParkInLotLogo'>
            
            <img src = './Images/ParkInLot.jpg' class='loginLogo'>
        </div>
        
        <div class = 'container'>
        
        <form method = "POST" class = "loginForm">
            <div class="form-group">
                <!--<label for="exampleInputEmail1">UserName/Email</label>-->
                <input type="Uname" class="form-control loginFormInput" id="Uname" aria-describedby="emailHelp" placeholder="Enter UserName or Email" name = "Uname">
                <small id="emailHelp" class="form-text text-muted"><a href="forgotUsername.php">Forgot your username?</a></small>
            </div>
            <div class="form-group">
                <!--<label for="exampleInputPassword1">Password</label>-->
                <input type="password" class="form-control loginFormInput" id="password" aria-describedby="passwordHelp" placeholder="Password" name = "password">
                <small id="passwordHelp" class="form-text text-muted"><a href="#">Forgot your password?</a></small>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember Me</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <p>Don't have an account? <a href="register.php">Sign Up</a></p>
            

            <?php
            if (!empty($_POST['Uname']) && !empty($_POST['password'])){

                $userName = htmlspecialchars(trim($_POST['Uname']));/////////////////ADD SANATIZATION
                $password = htmlspecialchars(trim($_POST['password']));
                echo "info: $userName and $password";
                //$sql = "select * from Users where userName = '$userName' or email = '$userName'";
                $sql = $db->prepare("SELECT * FROM Users WHERE userName = ? OR email = ?");
                $sql->bind_param('ss', $userName, $userName);
                $sql->execute();
                
                // if ($res = $db->query($sql)){
                if ($res = $sql->get_result()){
                    
                    $row = $res->FETCH_ASSOC();
                    if(password_verify($password, $row['password']) OR $row['password'] == $password) {

                        // if ($row['password'] == $password){
                        $_SESSION['active'] = true;
                        $_SESSION['firstName'] = $row['firstName'];
                        $_SESSION['lastName'] = $row['lastName'];
                        $_SESSION['access'] = $row['access'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['userName'] = $row['userName'];
                        $_SESSION['make'] = $row['make'];
                        $_SESSION['model'] = $row['model'];
                        $_SESSION['year'] = $row['year'];
                        $_SESSION['color'] = $row['color'];
                        $_SESSION['licensePlate'] = $row['licensePlate'];
                        $_SESSION['photo'] = $row['carPhoto'];
                        $_SESSION['tokens'] = $row['tokens'];


                        // Status Codes
                        // 0 - Not requesting, not offering
                        // 1 - Requesting a parking spot
                        // 10 - Requesting and found a parking spot
                        // 2 - Offering a parking spot
                        // 20 - Offering and found a requester
                        $_SESSION['statusCode'] = 0;
                    
                        //echo "email: {$_SESSION['email']}\n";
                        //echo "<br>Session active = {$_SESSION['active']}";
                        //echo "<br>Session name = {$_SESSION['name']}<br>";
                        //print_r($_SESSION);
                        //echo "<br>user = {$_SESSION['userName']}";
                        header("location: index.php");
                        exit();
                    }
                    else{

                        echo "<br><br>Invalid userName, email, or password.<br>\n";
                    }
                }
                else{

                    echo "<br><br>UserName or email does not exist.<br>\n";
                    echo "Would you like to create an account?\n";
                    echo "Query failed, notify Admin\n";
                }
            }
            else{

                echo "<br><br>Please enter UserName/Email with Password.<br>\n";
            }   
            //$_session['uname'] = 'test';
            //$_session['password'] = 'password';
            ?>

        </div>
        <?php   include('./javaScript/javaScript.html');    ?>
    </body>
</html>
