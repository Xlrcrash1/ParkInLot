<?php

session_start();
if ($_SESSION['active'] == false){

    header('location: login.php'); exit();
}

echo "<!DOCTYPE HTML>\n";
echo "<html>\n";
echo "  <head>\n";
echo "      <title>Final Project - Chat Support</title>\n";
echo "      <link rel = 'stylesheet' type='text/css' href = 'style.css'>\n";
echo "  </head>\n";
echo "  <body>\n";
include('nav.php');


if ($_SESSION['active'] == true){


    echo "      <div class = 'dropdown'>\n";

    echo "          <button class = 'dropbtn'>HI {$_SESSION['name']} ^</button>\n";
    echo "          <div class = 'dropdown-content'>\n";
    echo "              <a href = 'profile.php'>View Profile</a>\n";
    echo "              <a href = 'logout.php'>Log Out</a>\n";
    echo "          </div>\n";
    echo "      </div>\n";
    
    echo "You are signed in! Cool!\n";

    if ($_SESSION['access'] == 10){

        //This is where I will add an option to view our Database and be able to send queries and all that 
        echo "  This is where the text input for sql queries will take place; ";

        echo "              <h5>SQL Query: <input type = 'text' placeholder = 'Enter Query' name = 'test'></h5>\n";
    }
    

}

echo "  </body>\n";
echo "</html>\n";

?>
