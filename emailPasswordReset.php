<?php   require('SQLconnect.php');

if ($_SESSION['active']){

header('location: index.php'); exit();
}   ?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Email Password Reset</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel = 'stylesheet' type='text/css' href = './CSS/color_palette.css'>
        <link rel = 'stylesheet' type='text/css' href = './CSS/type_scale.css'>
        <link rel = 'stylesheet' type='text/css' href = './CSS/style.css'>
    </head>

    <body>
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

            <!-- forgot password header -->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <h1 class="forgot_title">Forgot password</h1>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

            <!-- text -->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <p class="body forgot_text">
                        If you forgot your password, enter your email and a password reset link will be sent to you.
                    </p>
                    <br>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

            <!-- input field for email -->
            <form method = "POST" action = "emailPasswordReset.php" class = "findUserNameForm">
                <div class="row">
                    <div class="col-xs-0 col-lg-4 side"></div>
                    <div class="col main">
                        <div class="form-group">
                            <input type="email" class="form-control text_input" id="checkEmail" aria-describedby="userNameHelp" placeholder="Enter Email" name = "checkEmail">
                            <p id = 'emailCheck'></p>
                        </div>
                    </div>
                    <div class="col-xs-0 col-lg-4 side"></div>
                </div>
                <!-- submit button -->
                <div class="row">
                    <div class="col-xs-0 col-lg-4 side"></div>
                    <div class="col main">
                        <button type="submit" class="btn btn-primary" onclick = "forgotUserNameConfirm()">Submit</button>
                    </div>
                    <div class="col-xs-0 col-lg-4 side"></div>
                </div>
            </form>

            <!-- login link -->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main ">
                    <center>
                    <p class="caption btn-caption">Think you remember the password?<br><a href='./login.php'>Give it a try</a></p>
                    </center>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>
        </div>

        <!--<script>

            function forgotUserNameConfirm(){

                var txt;
                var r = confirm('Are you sure you forgot your UserName? You can also sign in with your Email Address');
                if (r == true){

                    txt = "Email has been sent!";
                    //setTimeout(location.reload.bind(location), 100000);
                }
                else{
                    txt = "UserName Search has been Cancelled.";
                }
                document.getElementById('emailCheck').innerHTML = txt;
            }
        </script>-->
    </body>
</html>

<?php
if (isset($_POST['checkEmail']) & !empty($_POST['checkEmail'])){

    $checkEmail = htmlspecialchars(trim($_POST['checkEmail']));/////////////////ADD SANATIZATION

    //echo "Email Entered: $checkEmail<br>\n";

    // $sql = "Select * from Users where email = '$checkEmail'";
    $sql = $db->prepare("SELECT * FROM Users WHERE email = ?");
    $sql->bind_param('s', $checkEmail);

    $sql->execute();
    //echo "SQL Statement: $sql<br>\n";

    // if ($res = $db->query($sql)){

    if ($res = $sql->get_result()){
        //echo "first if statement: Successful<br>\n";

        if ($row = $res->FETCH_ASSOC()){

            //echo "YES, account found<br>\n";
            //echo "Row Assignition: Success<br>\n";

            $user = $row['firstName'];
            //echo "User's Name: $user<br>\n";

            $userName = $row['userName'];
            //echo "User's userName: $userName<br>\n";

            $token = bin2hex(random_bytes(50));

            // $assignToken = "insert into passwordReset (email, token) values('$checkEmail','$token');";
            $assignToken = $db->prepare("INSERT INTO passwordReset (email, token) VALUES (?, ?)");
            $assignToken->bind_param('ss', $checkEmail, $token);

            //assign token to user's email in passwordReset table

            // $db->query($assignToken);
            $assignToken->execute();
            //Save in Database


            $emailTxt = "

                <html>

                    <head>

                        <title> ParkInLot - Password Reset </title>
                    </head>

                    <body>
                        Hi $user, It seems that you forgot your password.<br><br>
                        To reset it, please click the following link to <a href = 'https://odin.cs.csub.edu/~spstudios/ParkInLot/passwordReset.php?Token=$token'>Reset It</a><br><br>
                        If you did not request the Password Reset, please <a href = 'https://odin.cs.csub.edu/~spstudios/ParkInLot/login.php'>Log In</a> to change<br>
                        your password on your User Profile<br>


                        <img src='https://m.promofeatures.com/iwq?start_date=timed-m-yTh:m:sZ+h:m' border='0' alt='https://promofeatures.com'/>

                        \n


                    </body>
                </html>
            ";
            //echo "Email Txt: $emailTxt<br>\n";

            email("$checkEmail", "$emailTxt");
        }
        else{

            //echo "NO, account not found<br>\n";
            $user = "Guest";
            //echo "User's Name: $user<br>\n";

            $emailTxt = "

                <html>

                    <head>

                        <title> ParkInLot - Forgot UserName </title>
                    </head>

                    <body>

                        Hi $user, It doesn't seem like you have an account, would you like to
                        <a href='https://odin.cs.csub.edu/~spstudios/ParkInLot/register.php'>Sign Up</a><br>
                        Our application allows you to find Parking very easily and quickly*\n
                    </body>
                </html>
            ";
            //echo "Email Txt: $emailTxt<br>\n";

            email("$checkEmail", "$emailTxt");
        }
        echo "<script>

            alert('Memory is Tricky, Huh? Maybe you saved the password somewhere? Regardless, an email has been sent to $checkEmail!');
            window.location = 'login.php';

        </script><br>\n";
        //sleep(10);
        //header('location: login.php');
    }
}

//header('Refresh: 5; URL=https://odin.cs.csub.edu/~spstudios/ParkInLot/login.php');

//header("forgotUsername.php");

function email($to, $txt){

    //echo "<br><br><br>\n";
    //echo "TO: $to<br>\n";
    $subject = "ParkInLot - Password Reset";
    //echo "TEXT: $txt<br>\n";


    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: ParkInLot<parkinlot.com>";

    mail($to,$subject,$txt,$headers);
}
?>
