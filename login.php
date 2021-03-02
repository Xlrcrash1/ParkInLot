<?php 

session_start();
if ($_SESSION['active']){

    header('location: index.php'); exit();
}

require('SQLconnect.php');

echo "You're not signed in yet...";

echo "<!DOCTYPE  HTML>\n";
echo "<html>\n\n";
echo "  <head>\n";
echo "      <title>Login</title>\n";
echo "      <link rel = 'stylesheet' type = 'text/css' href = 'style.css'>\n";
echo "  </head>\n\n";
echo "  <body>\n";
//echo "      <div class = 'nav'>\n";
include_once('nav.php');
echo "      <br>\n\n";

echo "      <div class ='ParkInLotLogo'>\n";
echo "           <img src = './Images/ParkInLot.jpg' class='loginLogo'>\n";
echo "      </div>\n";

echo "      <div class = 'container'>\n";      
echo "          <form method = 'POST' class = loginForm>\n";
echo "              <input class = 'loginInput' type = 'Uname' placeholder = 'User Name or Email' name = 'Uname'>\n";
echo "              <br>\n";
echo "              <input class = 'loginInput' type = 'password' placeholder = 'Password' name = 'password'>\n";
echo "              <br>\n";
echo "              <button class = 'nav_btn' type = 'submit'>Login</button\n";
//echo "          <button type = "checkbox" checked = "checked" name = 'remeber'>Remember me
echo "      </form>\n";


if (!empty($_POST['Uname']) && !empty($_POST['password'])){

    $userName = htmlspecialchars(trim($_POST['Uname']));/////////////////ADD SANATIZATION
    $password = htmlspecialchars(trim($_POST['password']));
    echo "info: $userName and $password";
    $sql = "select * from Users where userName = '$userName' or email = '$userName'";
    if ($res = $db->query($sql)){

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

echo "      </div>\n";
echo "              <a href = 'register.php'>Register</a>\n";
echo "  </body>\n\n";
echo "</html>\n";

function check(){

    
}

?>
