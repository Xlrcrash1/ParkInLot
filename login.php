<?php 

session_start();
if ($_SESSION['active']){

    header('location: final.php'); exit();
}

require('SQLconnect.php');

echo "<!DOCTYPE  HTML>\n";
echo "<html>\n\n";
echo "  <head>\n";
echo "      <title>Login</title>\n";
echo "      <link rel = 'stylesheet' type = 'text/css' href = 'style.css'>\n";
echo "  </head>\n\n";
echo "  <body>\n";
//echo "      <div class = 'nav'>\n";
include_once('nav.php');
//echo "      </div><br>\n\n";
echo "      <div class = 'container'>\n";      
echo "          <form method = 'POST'>\n";
echo "              <input type = 'Uname' placeholder = 'User Name or Email' name = 'Uname'>\n";
echo "              <input type = 'password' placeholder = 'Password' name = 'password'>\n";
echo "              <button class = 'nav_btn' type = 'submit'>Login</button\n";
//echo "          <button type = "checkbox" checked = "checked" name = 'remeber'>Remember me
echo "      </form>\n";



if (!empty($_POST['Uname']) && !empty($_POST['password'])){

    $username = htmlspecialchars(trim($_POST['Uname']));/////////////////ADD SANATIZATION
    $password = htmlspecialchars(trim($_POST['password']));
    echo "info: $username and $password";
    $sql = "select * from Users where user_name = '$username' or user_email = '$username'";
    if ($res = $db->query($sql)){

        $row = $res->FETCH_ASSOC();
    
        if ($row['user_password'] == $password){

            $_SESSION['active'] = true;
            $_SESSION['name'] = $row['user_fname'];
            $_SESSION['access'] = $row['user_level'];
            $_SESSION['email'] = $row['user_email'];
            $_SESSION['username'] = $row['user_name'];
            //echo "email: {$_SESSION['email']}\n";
            //echo "<br>Session active = {$_SESSION['active']}";
            //echo "<br>Session name = {$_SESSION['name']}<br>";
            //print_r($_SESSION);
            //echo "<br>user = {$_SESSION['username']}";
            header("location: final.php");
            exit();
        }
        else{

            echo "<br><br>Invalid username, email, or password.<br>\n";
        }
    }
    //else{

        //echo "<br><br>Username or email does not exist.<br>\n";
    //}
}
else{

    echo "<br><br>Please enter Username/Email with Password.<br>\n";
}

//$_session['uname'] = 'test';
//$_session['password'] = 'password';

echo "      </div>\n";
echo "  </body>\n\n";
echo "</html>\n";

function check(){

    
}




?>
