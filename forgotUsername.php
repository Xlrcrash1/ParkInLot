<?php   require('SQLconnect.php');  ?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Find UserName</title>
        <?php   include('./CSS/bootStrap.html');    ?>
        <link rel = 'stylesheet' type='text/css' href = './CSS/style.css'>
    </head>
    
    <body>
        <div class = "findUserName">

            <h2>Forgot Your UserName?</h2>
            <p>Did you forget your UserName? Enter the email associated with your account below and if it matches what is on file,
                an email with the UserName will be sent.
            </p>
            <p>Did you know you can just sign in with your email address as well? - <a href='login.php'>Give it a try</a></p>
            
            <form method = "POST" action = "forgotUsername.php" class = "findUserNameForm">
                
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

            $emailTxt = "

                <html>
                    
                    <head>

                        <title> ParkInLot - Forgot UserName </title>
                    </head>

                    <body>
                        Hi $user, Did you forget your UserName? It's $userName<br>\n
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
                        <a href='https://odin.cs.csub.edu/~tcervantes/SeniorSem/ParkInLot/register.php'>Sign Up</a><br>\n
                    </body>    
                </html>
            ";
            //echo "Email Txt: $emailTxt<br>\n";

            email("$checkEmail", "$emailTxt");
        }
        echo "<script> 
            
            alert('Memory is Tricky, Huh? An email has been sent to the email provided!');
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
    $subject = "ParkInLot - Forgot UserName";
    //echo "TEXT: $txt<br>\n";
   

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: ParkInLot<parkinlot.com>";
 
    mail($to,$subject,$txt,$headers);
}
?>
