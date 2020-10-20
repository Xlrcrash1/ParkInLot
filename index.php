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

    echo "<div class = 'center_chat'>\n";
    echo "  <div class = 'chat_options'>\n";
    echo "      <a href = 'newChat.php'><button class = 'chat'>New Support Chat</button></a><br><br>\n";
    echo "      <a href = 'myChat.php'><button class = 'chat'>My Active Chat</button></a><br><br>\n";
    
    echo "You are signed in! Cool!\n";

    if ($_SESSION['access'] == 10){

        echo "  <a href = 'allchats.php'><button class = 'chat'>View All Support Chats</button></a><br><br>\n";
        echo "  <button class = 'chat'>View All Logs</button><br><br>\n";
    }
    echo "  </div>\n";
    if ($_SESSION['access'] == 10){
        echo "  <div class = 'Logs'>\n";
        echo "      TEST\n";
        echo "  </div>\n";
        echo "</div>\n";
    }

}

echo "  </body>\n";
echo "</html>\n";

?>
