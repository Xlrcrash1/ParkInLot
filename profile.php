<?php
require('SQLconnect.php');
session_start();

if ($_SESSION['active'] == true){

    echo "<!DOCTYPE = html>\n";
    echo "<html>\n";
    echo "  <head>\n";
    echo "      <title>{$_SESSION['firstName']}'s Profile</title>\n";
    echo "      <link rel = 'stylesheet' type = 'text/css' href = 'style.css'>\n";
    echo "  </head>\n";
    echo "  <body>\n";
    
    echo "      <div class = 'dropdown'>\n";

    echo "          <button class = 'dropbtn'>HI {$_SESSION['firstName']} ^</button>\n";
    echo "          <div class = 'dropdown-content'>\n";
    echo "              <a href = 'index.php'>Home</a>\n";
    echo "              <a href = 'logout.php'>Log Out</a>\n";
    echo "          </div>\n";
    echo "      </div>\n";


    echo "      <form method = 'POST'>\n";
    echo "          <h3>Update your Profile {$_SESSION['firstName']}!</h3>\n";
    echo "          <h4>Updating your username will cuase chats to be deleted.\n";
    echo "          <h5> First Name: <input type = 'text' name = 'updateName' placeholder = {$_SESSION['firstName']}></input></h5>\n";
    echo "          <h5> Last Name: <input type = 'text' name = 'updatelName' placeholder = {$_SESSION['lastname']}></input></h5>\n";
    echo "          <h5> Email: <input type = 'email' name = 'updateEmail' placeholder = {$_SESSION['email']}></input></h5>\n";
    echo "          <h5> UserName: <input type = 'text' name = 'updateUserName' placeholder = {$_SESSION['userName']}></input></h5>\n";
    echo "          <button class = 'update' type = 'submit'>Update Profile</button>\n";
    //echo "          <p id = 'UpdateError'>Error Test</p>\n";
    echo "      </form>\n";

    $updateName = $_POST['updateName'];
    $updatelname = $_POST['updatelName'];
    $updateEmail = $_POST['updateEmail'];
    $updateUserName = $_POST['updateUserName'];

    //echo "updateName = $updateName and updateEmail = $updateEmail and updateUserName = $updateUserName\n";

    if (empty($_POST['updateName']) and empty($_POST['updatelName']) and empty($_POST['updateEmail']) and empty($_POST['updateUserName'])){

        //echo "Nothing to Update\n";
    }

        if (!empty($_POST['updateName'])){

            //echo "update name is set\n";
            $sql = "update Users set firstName = '{$_POST['updateName']}' where userName = '{$_SESSION['firstName']}'";
            //echo $sql;

            $db->query($sql);
            
            //echo "Name has been updated to {$_POST['updateName']}\n<br><br>";
            //echo "session name: {$_SESSION['name']}\n";
            
            $_SESSION['firstName'] = $_POST['updateName'];

            header('Location: profile.php');
            echo "Name has been updated to {$_POST['updateName']}\n<br><br>";
            
            //echo "session name: {$_SESSION['name']}\n";
        }

        if (!empty($_POST['updatelName'])){

            //echo "update name is set\n";
            $sql = "update Users set lastName = '{$_POST['updatelName']}' where userName = '{$_SESSION['userName']}'";
            //echo $sql;

            $db->query($sql);
            
            //echo "Name has been updated to {$_POST['updateName']}\n<br><br>";
            //echo "session name: {$_SESSION['name']}\n";
            
            $_SESSION['lastnName'] = $_POST['updatelName'];

            header('Location: profile.php');
            echo "Last Name has been updated to {$_POST['updatelName']}\n<br><br>";
            
            //echo "session name: {$_SESSION['name']}\n";
        }        


        if (!empty($_POST['updateEmail'])){

            //echo "update email is set\n";
            $sql = "update Users set email = '{$_POST['updateEmail']}' where userName = '{$_SESSION['userName']}'";
            //echo $sql;

            $db->query($sql);

            //echo "Email has been updated to {$_POST['updateEmail']}\n<br><br>";

            $_SESSION['email'] = $_POST['updateEmail'];
            header('Location: profile.php');
            echo "Email has been updated to {$_POST['updateEmail']}\n<br><br>";

        }


        if (!empty($_POST['updateUserName'])){

            //echo "session username= {$_SESSION['username']}\n";
            //echo "update username is set\n";
            $sql = "update Users set userName = '{$_POST['updateUserName']}' where userName = '{$_SESSION['userName']}'";
            //echo "sql statement: $sql\n";
            $db->query($sql);

            //echo "Username has been updated to {$_POST['updateUserName']}\n<br><br>";
            //header('Location: profile.php');

            $_SESSION['userName'] = $_POST['updateUserName'];
            header('Location: profile.php');
            echo "UserName has been updated to {$_POST['updateUserName']}\n<br><br>";
        }


        echo "      <div class = 'car'>\n";
        echo "          Car Information";
        echo "          <h5> Make: <input type = 'text' name = 'make' placeholder = {$_SESSION['make']}></input></h5>\n";
        echo "          <h5> Model: <input type = 'text' name = 'model' placeholder = {$_SESSION['model']}></input></h5>\n"; 
        echo "          <h5> Year: <input type = 'text' name = 'year' placeholder = {$_SESSION['year']}></input></h5>\n"; 
        echo "          <h5> Color: <input type = 'text' name = 'color' placeholder = {$_SESSION['color']}></input></h5>\n";
        echo "          <h5> Last 4 of License Plate: <input type = 'text' name = 'licenseplate' placeholder = {$_SESSION['licensePlate']}></input></h5>\n";
        echo "          <h5> Picture: <input type = 'text' name = 'pic' placeholder = {$_SESSION['photo']}></input></h5>\n";  
        echo "      </div>\n";



    echo "      <div class = 'updatePassword'>\n";
    echo "          <button class = 'accordion'>Change Password</button>\n";
    echo "              <div class = 'panel'>\n";
    echo "                  <form method = 'POST'>\n";
    echo "                      <h5>Current Password: <input type = 'password' name = 'current_password'></input>\n";
    echo "                      <h5>New Password: <input type = 'password' name = 'new_password'></input>\n";
    echo "                      <h5>Confirm Password: <input type = 'password' name = 'confirm_password'></input><br>\n"; 
    echo "                      <br>\n";
    echo "                      <button class = 'update' type = 'submit'>Update Password</button>\n";
    echo "                  </form>\n";
    echo "              </div>\n";
    echo "      </div>\n";

    //echo "currentPassword = {$_POST['current_password']} and newpassword = {$_POST['new_password']} and confirm_password = {$_POST['confirm_password']}\n";


    if (!empty($_POST['current_password']) and !empty($_POST['new_password']) and !empty($_POST['confirm_password'])){

        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
    
    //echo "currentPassword = {$_POST['current_password']} and newpassword = {$_POST['new_password']} and confirm_password = {$_POST['confirm_password']}\n";

        if ($new_password == $confirm_password){

            echo "passwords matched\n";
            $sql = "select * from Users where userName = '{$_SESSION['userName']}'";
            //echo $sql;

            if ($res = $db->query($sql)){

                //echo "sql statement query successfull\n";
                $row = $res->FETCH_ASSOC();

                $currentPassword = $row['password'];
                echo "current password: $currentPassword\n";
                
                if ($currentPassword == $current_password){

                    echo "echo password matched sql password\n";
                    $sql = "update Users set password = '$new_password' where userName = '{$_SESSION['userName']}'";
                    $db->query($sql);
                    //echo "sql: $sql";
                    header('Location: profile.php');
                    echo "password has been updated\n";
                }
                else{

                    echo "Sorry, your current password is incorrect\n";
                }
            }
        }
        else{

            echo "passwords did not match\n";
        }
    }



    echo "              <script>\n";
	echo "					var acc = document.getElementsByClassName('accordion');\n";
	echo "					var i;\n";
	
	echo "					for (i = 0; i < acc.length; i++){\n";
	echo "						acc[i].addEventListener('click', function(){\n";
	echo "/*Toggle between adding and removing the 'active' class, to highlight the button that controls the panel*/\n";
	echo "							this.classList.toggle('active');\n";
	echo "/*Toggle between hiding and showing the active panel */\n";
	echo "							var panel = this.nextElementSibling;\n";
	echo "							if (panel.style.display === 'block'){\n";
	echo "								panel.style.display = 'none';\n";
	echo "							}\n";
	echo "							else{\n";
	echo "								panel.style.display = 'block';\n";
	echo "							}\n";
	echo "						});\n";
	echo "					}\n";
    echo "              </script>\n";

    echo "      <br><br><br>\n";



    echo "      <div class = 'delete_account'>\n";
    echo "          <button class = 'delete_btn' onclick = 'deleteAccount()'>Delete Account</button>\n";
    echo "          <p id = 'delete_check'></p>\n";
    echo "      </div>\n";

    echo "<script>\n";
    echo "  function deleteAccount(){\n";
    echo "      var txt;\n";
    echo "      var r = confirm('Are you sure you want to delete your account?');\n";
    echo "      if (r == true){\n";
    $sql = "delete from Users where email = '{$_SESSION['email']}';";
    $db->query($sql);
    //$_SESSION['active'] = false;
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    //echo "          txt = $sql;\n";
    //echo "          txt = 'userName = {$_SESSION['userName']}';\n";
    echo "          txt = 'Account deleted';\n";
    echo "          setTimeout(location.reload.bind(location), 50000);"; 
    echo "      }\n";
    echo "      else{\n";
    echo "          txt = 'Account deletion aborted';\n";
    echo "      }\n";
    echo "      document.getElementById('delete_check').innerHTML = txt;\n";
    echo "  }\n";
    echo "</script>\n";



    //echo "      </form>\n";
    
    echo "  </body>\n";
    echo "</html>\n";
}
else{

    header('Location: login.php');
}


?>
