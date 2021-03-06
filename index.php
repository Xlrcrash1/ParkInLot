<?php

session_start();
if ($_SESSION['active'] == false){

    header('location: login.php'); exit();
}

?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>ParkInLot</title>
        <link rel = 'stylesheet' type='text/css' href = './CSS/style.css'>
    </head>
    
    <body>
    
        <div class ='appBackground'>

        <?php include('nav.php');


        if ($_SESSION['active'] == true){   ?>

            <div class = 'dropdown'>
        
                <button class = 'dropbtn'>HI <?php  echo"{$_SESSION['firstName']}" ?>^</button>
                <div class = 'dropdown-content'>
            
                    <a href = 'profile.php'>View Profile</a>
                    <a href = 'logout.php'>Log Out</a>
                </div>
            </div>
            <br>
            <p>"You are signed in! Cool!"</p>
            <br>

            <?php   
            if ($_SESSION['access'] == 10){

            //This is where I will add an option to view our Database and be able to send queries and all that ?>

            <br><br>
            <div id = 'Database_Query_Options'>

                <p>Which table would you like to look at?</p><br>
                <form action = 'database.php' target='_blank' method='post'>

                    <input type='radio' id='UsersTable' name='UsersTable' value='select * from Users;'>
                    <label for='UsersTable'>UsersTable</label><br><br>
                    <input type ='submit' value = 'Submit'>
                </form>
            </div>

                <?php    
            }
        }   ?>
        </div>
    </body>
</html>