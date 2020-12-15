<?php

session_start();
if ($_SESSION['active'] == false){

    header('location: login.php'); exit();
}

echo "<!DOCTYPE HTML>\n";
echo "<html>\n";
echo "  <head>\n";
echo "      <title>ParkInLot</title>\n";
echo "      <link rel = 'stylesheet' type='text/css' href = 'style.css'>\n";
echo "  </head>\n";
echo "  <body>\n";
include('nav.php');


if ($_SESSION['active'] == true){


    echo "      <div class = 'dropdown'>\n";

    echo "          <button class = 'dropbtn'>HI {$_SESSION['firstName']} ^</button>\n";
    echo "          <div class = 'dropdown-content'>\n";
    echo "              <a href = 'profile.php'>View Profile</a>\n";
    echo "              <a href = 'logout.php'>Log Out</a>\n";
    echo "          </div>\n";
    echo "      </div>\n";
    
    echo "You are signed in! Cool!\n";

    if ($_SESSION['access'] == 10){

        //This is where I will add an option to view our Database and be able to send queries and all that 

        echo "<br><br>\n";
        echo "              <div id = 'Database_Query_Options'>\n";
        echo "              Which table would you like to look at? \n";
        
        echo "                  <form action = ./database.php' target='_blank' method='post'>\n";
        echo "                       <input type='radio' id='male' name='gender' value='male'>\n";
        echo "                      <label for='male'>Male</label><br>\n";
        echo "                      <input type ='submit' value = 'Submit'>\n";
        echo "                  </form\n";
        echo "              </div>\n";
    }
    

}

echo "  </body>\n";
echo "</html>\n";

?>
