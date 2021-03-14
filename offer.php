<?php

session_start();
if ($_SESSION['active'] == false){

    header('location: login.php'); exit();
}

?>

<!DOCTYPE = HTML>
<html>
    <head>
        <title>ParkInLot</title>
    <?php 
        require('SQLconnect.php');
        include('./CSS/bootStrap.html');
    ?>
    <link rel = 'stylesheet' type = 'text/css' href = './CSS/style.css'>

    </head>
    <body>
        <?php
            if ($_SESSION['active'] == true){   
                include('nav.php'); 
            }
        ?>
        <?php 
            include('./javaScript/javaScript.html');  
        ?>
    </body>
</html>
