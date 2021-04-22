<!DOCTYPE = HTML>
<html>
    <head>

        <title>Register</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="./CSS/dist/css/style.css">
        <link rel = 'stylesheet' type='text/css' href = './CSS/color_palette.css'>
        <link rel = 'stylesheet' type='text/css' href = './CSS/type_scale.css'>
        <link rel = 'stylesheet' type='text/css' href = './CSS/style.css'>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>

    <body>

        <?php
           // include('nav.php');
           require('SQLconnect.php');
           session_start();
        ?>

        <div class = 'container'>

            <!-- logo medium -->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <center>
                    <a href="./login.php">
                        <img src = './Images/ParkInLot_Logo_Blue.png' class='logo_medium'>
                    </a>
                    </center>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

            <!-- create account header -->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <h1 class="register_title">Create an account</h1>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>
            <!-- <h1>Register for ParkInLot</h1> -->
            <!-- <h4>Please complete all fields</h4> -->

            <div class = 'register_box'>

                <form method = 'POST' class="registerForm">
                    <!-- User info -->
                    <div class="row">
                        <div class="col-xs-0 col-lg-4 side"></div>
                        <div class="col main">
                            <h2 class="register_title2">User information</h2>
                        </div>
                        <div class="col-xs-0 col-lg-4 side"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-0 col-lg-4 side"></div>
                        <div class="col main">
                            <h6 class="input_title">First Name</h6>
                            <input type = 'text' class="body form-control text_input loginFormInput" placeholder = 'Enter your first name' name = 'firstName'>
                        </div>
                        <div class="col-xs-0 col-lg-4 side"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-0 col-lg-4 side"></div>
                        <div class="col main">
                            <h6 class="input_title">Last Name</h6>
                            <input type = 'text' class="body form-control text_input loginFormInput"  placeholder = 'Enter your last name' name = 'lastName'>
                        </div>
                        <div class="col-xs-0 col-lg-4 side"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-0 col-lg-4 side"></div>
                        <div class="col main">
                            <h6 class="input_title">Username</h6>
                            <input type = 'text' class="body form-control text_input loginFormInput"  placeholder = 'Enter your username' name = 'userName'>
                        </div>
                        <div class="col-xs-0 col-lg-4 side"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-0 col-lg-4 side"></div>
                        <div class="col main">
                            <h6 class="input_title">Email</h6>
                            <input type = 'email' class="body form-control text_input loginFormInput"  placeholder = 'Enter your email' name = 'email'>
                        </div>
                        <div class="col-xs-0 col-lg-4 side"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-0 col-lg-4 side"></div>
                        <div class="col main">
                            <h6 class="input_title">Password</h6>
                            <input type = 'password' class="body form-control text_input loginFormInput" placeholder = 'Enter your password' name = 'password'>
                        </div>
                        <div class="col-xs-0 col-lg-4 side"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-0 col-lg-4 side"></div>
                        <div class="col main">
                            <h6 class="input_title">Confirm Password</h6>
                            <input type = 'password' class="body form-control text_input loginFormInput" class="body form-control text_input loginFormInput" placeholder = 'Confirm your password' name = 'confirm_password'>
                        </div>
                        <div class="col-xs-0 col-lg-4 side"></div>
                    </div>

                    <!-- Car info -->
                    <div class="row">
                        <div class="col-xs-0 col-lg-4 side"></div>
                        <div class="col main">
                            <h2 class="register_title2">Car information</h2>
                        </div>
                        <div class="col-xs-0 col-lg-4 side"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-0 col-lg-4 side"></div>
                        <div class="col main">
                            <h6 class="input_title">Make</h6>
                            <input type = 'text' class="body form-control text_input loginFormInput" placeholder = "Enter make" name = 'make'>
                        </div>
                        <div class="col-xs-0 col-lg-4 side"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-0 col-lg-4 side"></div>
                        <div class="col main">
                            <h6 class="input_title">Model</h6>
                            <input type = 'text' class="body form-control text_input loginFormInput" placeholder = "Enter model" name = 'model'>
                        </div>
                        <div class="col-xs-0 col-lg-4 side"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-0 col-lg-4 side"></div>
                        <div class="col main">
                            <h6 class="input_title"> Year</h6>
                            <input type = 'number' class="body form-control text_input loginFormInput"  min="1881" max="2022" step="1"  placeholder = 'Enter year' name = 'year'>
                        </div>
                        <div class="col-xs-0 col-lg-4 side"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-0 col-lg-4 side"></div>
                        <div class="col main">
                            <h6 class="input_title">Last 4 of car's license plate</h6>
                            <input type = 'text' class="body form-control text_input loginFormInput" placeholder = 'Enter license plate' name = 'licensePlate'>
                        </div>
                        <div class="col-xs-0 col-lg-4 side"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-0 col-lg-4 side"></div>
                        <div class="col main">
                            <h6 class="input_title">Color</h6>
                            <input type = 'text' class="body form-control text_input loginFormInput" placeholder = "Enter color" name = 'color'>
                        </div>
                        <div class="col-xs-0 col-lg-4 side"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-0 col-lg-4 side"></div>
                        <div class="col main">
                            <div class='g-recaptcha' data-sitekey='6LcdvfkZAAAAANZYnLTRvlsXFYDtim_Kz33h16m5'></div>
                        </div>
                        <div class="col-xs-0 col-lg-4 side"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-0 col-lg-4 side"></div>
                        <div class="col main">
                            <button class = 'btn btn-primary' type = 'submit'>
                                <!-- <i class="iconly-Profile btn_icon"></i> -->
                                Create Account
                            </button>
                        </div>
                        <div class="col-xs-0 col-lg-4 side"></div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-xs-0 col-lg-4 side"></div>
                    <div class="col main">
                        <center>
                            <p class="caption btn-caption">Already have an account? <a href="./login.php"> Log in</a></p>
                        </center>
                    </div>
                    <div class="col-xs-0 col-lg-4 side"></div>
                </div>
            </div>
        </div>
        <?php   include("./javaScript/javaScript.html"); ?>
    </body>
</html>

<!--<script>
    function checkCaptcha(){

        var response = grecaptcha.getResponse();
        if (response.length == 0){

            alert('Please verify you are human!')
            return false;\n}
        else{

            return true;
        }
    }
</script>-->

<?php
if (($_POST["g-recaptcha-response"] != '') && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['userName']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){

    //this converts the post parameters from HTML into PHP parameters as well as we sanatize it to avoid sql queries being interjected
    $firstName = htmlspecialchars(trim($_POST['firstName']));/////////////////ADD SANATIZATION
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $userName = htmlspecialchars(trim($_POST['userName']));/////////////////ADD SANATIZATION
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));/////////////////ADD SANATIZATION
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));

    $make = htmlspecialchars(trim($_POST['make']));/////////////////ADD SANATIZATION
    $model = htmlspecialchars(trim($_POST['model']));
    $year = htmlspecialchars(trim($_POST['year']));/////////////////ADD SANATIZATION
    $licensePlate = htmlspecialchars(trim($_POST['licensePlate']));
    $color = htmlspecialchars(trim($_POST['color']));


    //echo "name: $name , lastname: $lname, userName: $userName , email: $email , password: $password , confirm: $confirm_password, Make: $make, Model = $model, Year: $year, licenseplate: $licensePlate";

    if ($password == $confirm_password){

        $sql = $db->prepare("SELECT * FROM Users WHERE userName = ? OR email = ? OR licensePlate = ?");
        $sql->bind_param('sss', $userName, $email, $licensePlate);
        $sql->execute();
        //"select * from Users where userName = '$userName' or email = '$email' or licensePlate = '$licensePlate'";
        if ($res = $sql->get_result()){

            $row = $res->FETCH_ASSOC();

            $exists = '';

            if ($row['userName'] == $userName){

                $exists .= 'UserName taken<br>';
            }
            if ($row['email'] == $email){

                $exists .= 'Email already exists<br>';
            }
            if ($row['licensePlate'] == $licensePlate){

                $exists .= 'License Plate already exists<br>';
            }
            if ($row['userName'] == $userName or $row['email'] == $email or $row['licensePlate'] == $licensePlate){

                echo $exists;
            }
            else{
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                //echo "email or userName is not taken<br>\n";
                $sql = $db->prepare("INSERT INTO Users (firstName, lastName, userName, password, email, make, model, year, color, licensePlate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $sql->bind_param('ssssssssss', $firstName, $lastName, $userName, $hashedPassword, $email, $make, $model, $year, $color, $licensePlate);
                $sql->execute();
                $sql->close();
                // $sql = "insert into Users (firstName, lastName, userName, password, email, make, model, year, color, licensePlate) values('$name','$lname','$userName','$hashedPassword','$email', '$make', '$model', '$year', '$color', '$licensePlate');";
                // $db->query($sql);

                $_SESSION['active'] = false;
                $_SESSION['firstName'] = $firstName;
                $_SESSION['lastName'] = $lastName;
                $_SESSION['access'] = "1";
                $_SESSION['email'] = $email;
                $_SESSION['userName'] = $userName;
                $_SESSION['make'] = $make;
                $_SESSION['model'] = $model;
                $_SESSION['year'] = $year;
                $_SESSION['color'] = $color;
                $_SESSION['licensePlate'] = $licensePlate;
                // header('Location: carupload.php');
                echo "<script type='text/javascript'> document.location = 'carupload.php'; </script>";


            }
        }
        //echo "passwords matched\n";
    }
    else{

        echo "Please try again, your passwords did not match\n";
    }

}
else{

    // $error = 'You forgot to enter the following:<br><br>';
    // if (empty($_POST['firstName'])){

    //     $error .= 'FirstNAME<br>';
    // }
    // if (empty($_POST['lastName'])){

    //     $error .= 'LastNAME<br>';
    // }
    // if (empty($_POST['userName'])){

    //     $error .= 'USERNAME<br>';
    // }
    // if (empty($_POST['email'])){

    //     $error .= 'EMAIL<br>';
    // }
    // if (empty($_POST['password'])){

    //     $error .= 'PASSWORD<br>';
    // }
    // if ( empty($_POST['confirm_password'])){

    //     $error .= 'CONFIRM PASSWORD<br>';
    // }
    // if (empty($_POST['make'])){

    //     $error .= 'Make<br>';
    // }
    // if (empty($_POST['model'])){

    //     $error .= 'model<br>';
    // }
    // if (empty($_POST['year'])){

    //     $error .= 'year<br>';
    // }
    // if (empty($_POST['color'])){

    //     $error .= 'color<br>';
    // }
    // if ( empty($_POST['licensePlate'])){

    //     $error .= 'LicensePlate<br>';
    // }

    //echo "TEST that is nothing is posted\n";
    // echo "$error\n";
}
?>
