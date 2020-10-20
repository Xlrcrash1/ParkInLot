<?php 

session_start();
if ($_SESSION['active']){

    header('location: index.php'); exit();
}

require('SQLconnect.php');

echo "You're not sign in yet...";

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

echo "  <a href = 'register.php'><button class = 'registration'>Register</button></a>\n";

if (!empty($_POST['Uname']) && !empty($_POST['password'])){

    $username = htmlspecialchars(trim($_POST['Uname']));/////////////////ADD SANATIZATION
    $password = htmlspecialchars(trim($_POST['password']));
    echo "info: $username and $password";
    $sql = "select * from ParkInLot_Users where username = '$username' or email = '$username'";
    if ($res = $db->query($sql)){

        $row = $res->FETCH_ASSOC();
    
        if ($row['password'] == $password){

            $_SESSION['active'] = true;
            $_SESSION['name'] = $row['firstName'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['access'] = $row['access'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $row['username'];
            //echo "email: {$_SESSION['email']}\n";
            //echo "<br>Session active = {$_SESSION['active']}";
            //echo "<br>Session name = {$_SESSION['name']}<br>";
            //print_r($_SESSION);
            //echo "<br>user = {$_SESSION['username']}";
            header("location: index.php");
            exit();
        }
        else{

            echo "<br><br>Invalid username, email, or password.<br>\n";
        }
    }
    else{

        echo "<br><br>Username or email does not exist.<br>\n";
        echo "Would you like to create an account?\n";
        echo "Query failed, notify Admin\n";
    }
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
