<?php

require('SQLconnect.php');

echo "<!DOCTYPE = HTML>\n";
echo "<html>\n";
echo "  <head>\n";
echo "      <title>REGISTER</title>\n";
echo "      <link rel = 'stylesheet' type = 'text/css' href = 'style.css'>\n";
echo "  </head>\n";
echo "  <body>\n";

include('nav.php');

echo "      <div class = 'register_box'>\n";
echo "          <form method = 'POST'>\n";
echo "              <h5>First Name: <input type = 'text' placeholder = 'Tony' name = 'name'></h5>\n";
echo "              <h5>Last Name: <input type = 'text' placeholder = 'Cervantes' name = 'lname'></h5>\n";
echo "              <h5>UserName: <input type = 'text' placeholder = 'XLR8' name = 'username'></h5>\n";
echo "              <h5>Email: <input type = 'email' placeholder = 'email@email.com' name = 'email'></h5>\n";
echo "              <h5>Password: <input type = 'password' placeholder = '*****' name = 'password'></h5>\n";
echo "              <h5>Confirm Password: <input type = 'password' placeholder = '*****' name = 'confirm_password'></h5>\n";
echo "              <button class = 'nav_btn' type = 'submit'>Create</button>\n";
echo "          </form>\n";
echo "      </div>\n";

echo "  </body>\n";
echo "</html>\n";


if (!empty($_POST['name']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){

    $name = $_POST['name'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    //echo "name: $name , username: $username , email: $email , password: $password , confirm: $confirm_password";

    if ($password == $confirm_password){

        $sql = "select * from Users where user_name = '$username' or user_email = '$email'";
        if ($res = $db->query($sql)){

            $row = $res->FETCH_ASSOC();
            
            $exists = '';
            
            if ($row['user_name'] == $username){

                $exists .= 'UserName taken<br>';
            }
            if ($row['user_email'] == $email){

                $exists .= 'Email already exists<br>';
            }
            if ($row['user_name'] == $username or $row['user_email'] == $email){

                echo $exists;
            }
            else{

                //echo "email or username is not taken<br>\n";
                $sql = "insert into ParkInLot_Users (firstName, lastname, username, password, email) values('$name','$lastname','$username','$password','$email');";
                $db->query($sql);
                header('Location: index.php');
            }
        }
        //echo "passwords matched\n";
    }
    else{

        echo "Please try again, your passwords did not match\n";
    }

}
else{

    $error = 'You forgot to enter the following:<br><br>';
    if (empty($_POST['name'])){

        $error .= 'NAME<br>';
    }
    if (empty($_POST['username'])){

        $error .= 'USERNAME<br>';
    }
    if (empty($_POST['email'])){

        $error .= 'EMAIL<br>';
    }
    if (empty($_POST['password'])){

        $error .= 'PASSWORD<br>';
    }
    if ( empty($_POST['confirm_password'])){

        $error .= 'CONFIRM PASSWORD<br>';
    }


    //echo "TEST that is nothing is posted\n";
    echo "$error\n";
}
?>
