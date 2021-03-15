<?php   require('SQLconnect.php');

if ($_SESSION['active']){

header('location: index.php'); exit();
}   ?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Email Password Reset</title>
        <?php   include('./CSS/bootStrap.html');    ?>
        <link rel = 'stylesheet' type='text/css' href = './CSS/style.css'>
    </head>
    
    <body>
        <div class = "findPassword">

            <h2>Don't remember your password?</h2>
            <p>If you forgot your password, enter your email and a PasswordReset Link will be sent to you.</p>
            <p>Happen to remember that password? <a href='login.php'>Give it a try</a></p>
            
            <form method = "POST" action = "emailPasswordReset.php" class = "findUserNameForm">
                
                <div class="form-group">
                    
                    <!--<label for="Email">UserName/Email</label>-->
                    <input type="email" class="form-control" id="checkEmail" aria-describedby="userNameHelp" placeholder="Enter Email" name = "checkEmail">
                    <!--<small id="userNameHelp" class="form-text text-muted"><a href="forgotUsername.php">Forgot your username?</a></small>-->
                </div>
                <button type="submit" class="btn btn-primary" onclick = "forgotUserNameConfirm()">Submit</button>
                <p id = 'emailCheck'></p>
            </form>
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

    $sql = "Select * from Users where email = '$checkEmail'";
    //echo "SQL Statement: $sql<br>\n";

    if ($res = $db->query($sql)){

        //echo "first if statement: Successful<br>\n";
        
        if ($row = $res->FETCH_ASSOC()){

            //echo "YES, account found<br>\n";
            //echo "Row Assignition: Success<br>\n";

            $user = $row['firstName'];
            //echo "User's Name: $user<br>\n";

            $userName = $row['userName'];
            //echo "User's userName: $userName<br>\n";
            
            $token = bin2hex(random_bytes(50));
            
            $assignToken = "insert into passwordReset (email, token) values('$checkEmail','$token');";
            //assign token to user's email in passwordReset table

            $db->query($assignToken);
            //Save in Database
            

            $emailTxt = "

                <html>
                    
                    <head>

                        <title> ParkInLot - Password Reset </title>
                    </head>

                    <body>
                        Hi $user, It seeems that you forgot your password.<br><br>
                        To reset it, please click the following link to <a href = 'https://odin.cs.csub.edu/~tcervantes/SeniorSem/ParkInLot/passwordReset.php?Token=$token'>Reset It</a><br><br>
                        If you did not request the Password Reset, please <a href = 'https://odin.cs.csub.edu/~tcervantes/SeniorSem/ParkInLot/login.php'>Log In</a> to change<br>
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
                        <a href='https://odin.cs.csub.edu/~tcervantes/SeniorSem/ParkInLot/register.php'>Sign Up</a><br>
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

//header('Refresh: 5; URL=https://odin.cs.csub.edu/~tcervantes/SeniorSem/ParkInLot/login.php');

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
