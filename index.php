<?php

session_start();

echo "<!DOCTYPE HTML>\n";
echo "<html>\n";
echo "  <head>\n";
echo "      <title>Final Project - Chat Support</title>\n";
echo "      <link rel = 'stylesheet' type='text/css' href = 'style.css'>\n";
echo "  </head>\n";
echo "  <body>\n";
include('nav.php');

if ($_SESSION['active'] == true){

    echo "<div class = 'center_chat'>\n";
    echo "  <div class = 'chat_options'>\n";
    echo "      <a href = 'newChat.php'><button class = 'chat'>New Support Chat</button></a><br><br>\n";
    echo "      <a href = 'myChat.php'><button class = 'chat'>My Active Chat</button></a><br><br>\n";
    
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
