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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="./CSS/dist/css/style.css">
        <link rel = 'stylesheet' type='text/css' href = './CSS/color_palette.css'>
        <link rel = 'stylesheet' type='text/css' href = './CSS/style.css'>
        <link rel = 'stylesheet' type='text/css' href = './CSS/type_scale.css'>
    </head>

    <body>
        <?php
            if ($_SESSION['active'] == true){
                require('SQLconnect.php');
                include('nav.php');
                include('updatestatus.php');
                update_status($db, $_SESSION['userID'], 0);
        ?>

        <div class = 'container'>
            <!-- profile image -->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <img src = <?php echo "'{$_SESSION['photo']}'";?>
                    <!-- alt='Car Photo' onerror="this.src='./Images/default.jpg';" class='profile_image'>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

            <!-- user's name -->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <h1 class="profile_title">
                        <?php echo "{$_SESSION['firstName']} {$_SESSION['lastName']}";?>
                     </h1>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>
            <!-- username -->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <h6 class="profile_subtitle">
                        <?php echo "{$_SESSION['userName']}";?>
                    </h6>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

            <!-- car description -->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <h6>
                        <?php echo "{$_SESSION['color']} {$_SESSION['year']} {$_SESSION['make']} {$_SESSION['model']}";?>
                    </h6>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

            <!-- tokens -->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <h6 class="tokens">
                        Tokens: <?php echo "{$_SESSION['tokens']}";?>
                    </h6>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

            <!-- divider -->
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <hr class="divider">
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>
        </div>

        <br>

        <div class="container">

            <?php
                if ($_SESSION['access'] == 10){
                    //This is where I will add an option to view our Database and be able to send queries and all that
            ?>



            <div class="row">
                <!-- <div id = 'Database_Query_Options'> -->
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <p>
                        Which table would you like to look at?
                    </p>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
                <!-- </div> -->
            </div>

            <form action = 'databaseQueries.php' target='_blank' method='post'>
                <div class="row">
                    <div class="col-xs-0 col-lg-4 side"></div>
                    <div class="col main">
                        <input type='radio' id='usersTable' name='databaseQuery' value='select * from Users'>
                        <label for='usersTable'>Users Table</label><br>
                        <input type='radio' id='spotHistory' name='databaseQuery' value='select * from Spots'>
                        <label for='spotHistory'>Available Spots</label><br>
                        <input type='radio' id='passwordReset' name='databaseQuery' value='select * from passwordReset'>
                        <label for='passwordReset'>Password Reset</label><br>
                        <input type='radio' id='lotLocation' name='databaseQuery' value='select * from lotLocation'>
                        <label for='lotLocation'>Lot Locations</label><br>
                        <button type ='submit' class="btn btn-primary" value = 'View Table'>
                            <!-- <i class="iconly-Paper btn_icon"></i> -->
                            View Table
                        </button>
                    </div>
                    <div class="col-xs-0 col-lg-4 side"></div>
                </div>
            </form>


            <?php
                }
                else if ($_SESSION['access'] == 1){
            ?>
            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <button type="button" class="btn btn-outline" id="btnRequest" onclick="window.location.href='./request/request.php';">
                        <!-- <i class="iconly-Location icli btn_icon"></i> -->
                        Find a Spot
                    </button>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

            <div class="row">
                <div class="col-xs-0 col-lg-4 side"></div>
                <div class="col main">
                    <button type="button" class="btn btn-primary" id="btnOffer" onclick="window.location.href='./offer/offer.php';">
                            Give a Spot
                    </button>
                </div>
                <div class="col-xs-0 col-lg-4 side"></div>
            </div>

            <?php
                }
            }
            include('./javaScript/javaScript.html')
            ?>
        </div>
    </body>
</html>
