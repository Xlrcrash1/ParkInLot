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
        <?php   include('./CSS/bootStrap.html');    ?>
        <link rel = 'stylesheet' type='text/css' href = './CSS/style.css'>
    </head>
    
    <body>
    
        <div class ='appBackground'>

        <?php
        if ($_SESSION['active'] == true){   
            
            include('nav.php'); ?>

            
            <p>You are signed in! Cool!</p>
            <br>

            <?php   
            if ($_SESSION['access'] == 10){

                //This is where I will add an option to view our Database and be able to send queries and all that ?>

                <br><br>

            

                <div id = 'Database_Query_Options'>

                    <p>Which table would you like to look at?</p><br>
                    <form action = 'databaseQueries.php' target='_blank' method='post'>

                        <input type='radio' id='usersTable' name='usersTable' value='select * from Users'>
                        <label for='usersTable'>usersTable</label><br><br>
                        <input type ='submit' value = 'Submit'>
                    </form>
                </div>
                <!--<div class = "databaseQuery">
                
                    <?php include('databaseQueries.php'); ?>
                </div>-->
                <?php    
            }
        }   ?>
        </div>
        <?php   include('./javaScript/javaScript.html');    ?>
    </body>
</html>