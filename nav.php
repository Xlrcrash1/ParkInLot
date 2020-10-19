<?php

session_start();
if ($_SESSION['active']){

    //echo "<div class = 'center_title'>\n";
    //echo "  <h4>TEST</h4>\n";
    //echo "</div>\n";


    echo "<div class = 'nav'>\n";
    echo "  <a href = 'final.php'><button class = 'nav_btn'>Home</button></a>\n";
    echo "  <a href = 'newChat.php'><button class = 'nav_btn'>New Chat</button></a>\n";
    echo "  <a href = 'myChat.php'><button class = 'nav_btn'>Current Chat</button></a>\n";

    if ($_SESSION['access'] == 10){

        echo "<a href = 'allchats.php'><button class = 'nav_btn'>All Chats</button></a>\n";
    }

    //echo "  <a href = 'profile.php'>Profile</a>\n";

    echo "  <div class = 'sign_in'>\n";
    //echo "      <a href = 'logout.php'><button>Log out</button></a>\n";
    echo "      <div class = 'dropdown'>\n";

    echo "          <button class = 'dropbtn'>HI {$_SESSION['name']} ^</button>\n";
    echo "          <div class = 'dropdown-content'>\n";
    echo "              <a href = 'profile.php'>View Profile</a>\n";
    echo "              <a href = 'logout.php'>Log Out</a>\n";
    echo "          </div>\n";
    
    echo "      </div>\n";
    //echo "      <a href ='logout'><button>Log Out</button></a>\n";
    echo "  </div>\n";
    echo "  <br><br>\n";
    echo "</div>\n";
}
else{

    echo "<div class = 'nav'>\n";
    echo "  <a href = 'final.php'><button class = 'nav_btn'>Home</button></a>\n";
    echo "  <a href = 'chat.php'><button class = 'nav_btn'>My Chats</button></a>\n";
    echo "  <div class = 'sign_in'>\n";
    echo "      <a href = 'register.php'><button class = 'nav_btn'>Register</button></a>\n";
    echo "      <a href = 'login.php'><button class = 'nav_btn'>Sign In</button></a>\n";
    echo "  </div>\n";
    echo "  <br><br>\n";
    echo "</div>\n";
}


?>



