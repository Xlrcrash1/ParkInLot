<?php

session_start();

if ($_SESSION['active']){

    header('location: index.php'); exit();
}   ?>


    <head>
        <title>Log in</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="./CSS/dist/css/style.css">
        <link rel = 'stylesheet' type='text/css' href = './CSS/color_palette.css'>
        <link rel = 'stylesheet' type='text/css' href = './CSS/type_scale.css'>
        <link rel = 'stylesheet' type='text/css' href = './CSS/style.css'>
    </head>

    <body>

        <?php
            // include('nav.php');
            require('SQLconnect.php');
        ?>

        <!-- <p>You're not signed in yet...</p> -->

        <div class = 'container'>

            <!-- logo -->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <center>
                    <a href="./login.php">
                        <img src = './Images/ParkInLot_Logo_Blue.png' class='loginLogo'>
                    </a>
                    </center>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

            <!-- login header-->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <h1>Log in</h1>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

            <!-- login form -->
            <form method = "POST" class = "loginForm">
                <div class="row">
                    <div class="col-xs-0 col-lg-4 side"></div>
                    <div class="col main form-group">
                            <!--<label for="exampleInputEmail1">UserName/Email</label>-->
                        <input type="Uname" class="body form-control text_input loginFormInput" id="Uname" aria-describedby="emailHelp" placeholder="Email or Username" name = "Uname">
                        <small id="emailHelp" class="endnote form-text"><a href="forgotUsername.php">Forgot your username?</a></small>
                    </div>
                    <div class="col-xs-0 col-lg-4 side"></div>
                </div>
                <div class="row">
                    <div class="col-xs-0 col-lg-4 side"></div>
                    <div class="col main form-group">
                        <!--<label for="exampleInputPassword1">Password</label>-->
                        <input type="password" class="body form-control text_input loginFormInput" id="password" aria-describedby="passwordHelp" placeholder="Password" name = "password">
                        <small id="passwordHelp" class="endnote form-text"><a href="emailPasswordReset.php">Forgot your password?</a></small>
                    </div>
                    <div class="col-xs-0 col-lg-4 side"></div>
                </div>
                <div class="row">
                    <div class="col-xs-0 col-lg-4 side"></div>
                    <div class="col main form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember Me</label>
                    </div>
                    <div class="col-xs-0 col-lg-4 side"></div>
                </div>
                <div class="row">
                    <div class="col-xs-0 col-lg-4 side"></div>
                    <div class="col main">
                        <button type="submit" class="btn btn-primary">
                            <!-- <i class="iconly-Login btn_icon"></i> -->
                            Log In
                        </button>
                    </div>
                    <div class="col-xs-0 col-lg-4 side"></div>
                </div>
            </form>
                <div class="row">
                    <div class="col-xs-0 col-lg-4 side"></div>
                    <div class="col main">
                        <center>
                            <p class="caption btn-caption">Don't have an account? <a href="register.php"> Sign Up</a></p>
                        </center>
                    </div>
                    <div class="col-xs-0 col-lg-4 side"></div>
                </div>
        <!-- </div> -->


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
                        $_SESSION['userID'] = $row['userID'];

                        // Status Codes
                        // 0 - Not requesting, not offering
                        // 1 - Requesting a parking spot
                        // 10 - Requesting and found a parking spot
                        // 2 - Offering a parking spot
                        // 20 - Offering and found a requester
                        // 3 - Transaction completed
                        $_SESSION['statusCode'] = 0;
                        //echo "email: {$_SESSION['email']}\n";
                        //echo "<br>Session active = {$_SESSION['active']}";
                        //echo "<br>Session name = {$_SESSION['name']}<br>";
                        //print_r($_SESSION);
                        //echo "<br>user = {$_SESSION['userName']}";
                        echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
                        // header("location: index.php");
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

                // echo "<br><br>Please enter UserName/Email with Password.<br>\n";
            }
            //$_session['uname'] = 'test';
            //$_session['password'] = 'password';
        ?>

        </div>
        <?php   include('./javaScript/javaScript.html');    ?>
    </body>
</html>
