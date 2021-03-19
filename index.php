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

        <?php
        if ($_SESSION['active'] == true){   


            include('nav.php'); ?>


            <p>You are signed in! Cool!</p>
            <?php echo"You currently have {$_SESSION['tokens']} tokens!\n";?>
            <br>

            <?php   
            if ($_SESSION['access'] == 10){
                //This is where I will add an option to view our Database and be able to send queries and all that ?>

                <br><br>



                <div id = 'Database_Query_Options'>

                    <p>Which table would you like to look at?</p><br>
                    <form action = 'databaseQueries.php' target='_blank' method='post'>

                        <input type='radio' id='usersTable' name='usersTable' value='select * from Users'>
                        <label for='usersTable'>Users Table</label><br>
                        <input type='radio' id='spotHistory' name='spotHistory' value='select * from spotsHistory'>
                        <label for='spotHistory'>Spot History</label><br>
                        <input type ='submit' value = 'Submit'>
                    </form>
                </div>
            <?php
            } else if ($_SESSION['access'] == 1){
                ?>
                <div id = 'actions'>
                    <div id = 'request'>                
                        <button type="button" class="btn btn-outline-primary" 
                                id="btnRequest" onclick="window.location.href='request.php';">Request a Spot</button>
                    </div>

                    <div id = 'offer'>
                        <button type="button" class="btn btn-outline-secondary" 
                                id="btnOffer" onclick="window.location.href='offer.php';">Offer a Spot</button>
                    </div>
                </div>
                
                <?php
            }
        }          
        include('./javaScript/javaScript.html')  ?>
    </body>
</html>
